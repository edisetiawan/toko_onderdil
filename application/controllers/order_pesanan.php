<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order_pesanan extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->model('Mbiaya_kirim');
		$this->load->model('Mmember');
		$this->load->model('Muser');
		$this->load->model('Mproduk');
		$this->load->model('Mdorder');
		$this->load->model('Morder');
		$this->load->model('Mkategori');
		$this->load->model('Mpembayaran');
		$this->load->library('cart');
		$this->load->library('email');
		$this->load->helper(array('form','url'));
		session_start();
	}
	function index(){
		$this->auth->restrict_member();			//* cek user sudah login /belum
		/*$this->auth->cek_menu(3);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);	//* cek user sudah login /belum

		$data['base_url'] = base_url().'order_pesanan/index/';
		$data['total_rows'] = $this->db->count_all('tbl_order');
		$data['per_page'] = 12;
		$data['uri_segment'] = 3;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		
		$this->pagination->initialize($data);
		$data['order']=$this->Morder->getMember($data['per_page'],$this->uri->segment(3,0));
		$data['content']='user/data_order';
		$this->load->view('user/template',$data);

	}
	function konfirmasi_order(){
		$this->auth->restrict_member();			
		/*$this->auth->cek_menu(3);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$kdpesan = $this->Morder->getCode();
		$this->session->set_userdata('id_order', $kdpesan['id_order']);
		$this->session->set_userdata('id_member', $kdpesan['id_member']);
		
		$data['detil_belanja']=$this->Mdorder->detil_belanja();
		session_unset();
		$data['content']='user/konfirmasi_order';
		$this->load->view('user/template',$data);
	}
	function add_order(){
		
		$this->auth->restrict_member();			
		/*$this->auth->cek_menu(3);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
			
		$this->Morder->insert();
			$kdpesan = $this->Morder->getCode();
			$this->session->set_userdata('id_order', $kdpesan['id_order']);
			$this->session->set_userdata('id_member', $kdpesan['id_member']);
		$this->Mpembayaran->insert();
			
		foreach($this->cart->contents() as $items):
			$this->Mdorder->insert($items['id'], $items['qty']);
		endforeach;		
			$this->Mproduk->kurangi_stok($items['id'], $items['qty']);
		$this->cart->destroy();
			
		$pembayaran=$this->Mpembayaran->getCode();
			$this->session->set_userdata('tagihan',$pembayaran['tagihan']);
			$this->session->set_userdata('metode',$pembayaran['metode']);
			$tagihan=$this->session->userdata('tagihan');
			$metode=$this->session->userdata('metode');
			if($metode == 1){
				$bayar="Transfer Bank";
				$text="segera lakukan pembayaran ke rek BRI <br>
						No Rek : 675701000015507 <br>
						Atasnama : Sigit";
			}else{
				$bayar="Bayar Ditempat / COD";
				$text="Pembayaran dilakukan apabila barng sudah sampai ditangan anda";
			}
		$member=$this->Mmember->getEmail();
			$this->session->set_userdata('email',$member['email']);
			$email=$this->session->userdata('email');
				
			$this->email->from('sigit.vespa12@gmail.com','SIGIT VESPA');
			$this->email->to($email);
			$this->email->subject('Konfirmasi Order');
			$this->email->message(
				' Anda telah berbelanja di Sigit Vespa. Total Tagihan Anda = '.$this->fungsi->rupiah($tagihan).' '
				.' Metode Pembayaran yang anda pilih adalah '.$bayar.' '
				.$text
			);
			
			if ($this->email->send()) {
			  ?>
				<script type="text/javascript" language="javascript">
					alert("Thanks. Transaksi anda berhasil, Silahkan cek email anda!!!");
				</script>
			<?php
				$this->session->set_flashdata('success','Terimakasih telah berbelanja di Sigit Vespa, Silahkan cek email anda !');
				 /*echo 'window.location.href = '.base_url().'order_pesanan/konfirmasi_order';*
				/*redirect('order_pesanan/konfirmasi_order');*/
				$this->konfirmasi_order();
			} else {
			   ?>
				  <script type="text/javascript" language="javascript">
					alert("Pesan Tidak terkirim !!");
				  </script>
			  <?php
			  $this->email->print_debugger();
			}
		$this->session->set_flashdata('success','Terimakasih telah berbelanja di Sigit Vespa, Silahkan cek email anda !');
		redirect('order_pesanan/konfirmasi_order');
	}
	function select_validate($selectValue){
		if($selectValue=='none'){
			$this->form_validation->set_message('select_validate','Tidak ada data yang dipilih');
			return false;
		}else{
			return true;
		}
	}
	function detil_order($id){
		$this->auth->restrict_member();			//* cek user sudah login /belum
		/*$this->auth->cek_menu(3);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$data['order']=$this->Morder->detil_order($id);
		$data['detil']=$this->Mdorder->detil_order($id);
		$data['content']='user/detil_order';
		$this->load->view('user/template',$data);
	}
}
?>