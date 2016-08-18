<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->library('cart');
		$this->load->library('fungsi');
		$this->load->model('Mproduk');
		$this->load->model('Morder');
		$this->load->model('Muser');
		$this->load->model('Mbiaya_kirim');
		$this->load->helper('form');
		session_start();
	}
	function index(){
		$this->view_cart();
	}
	function add_cart(){
	
		$data = array(
			'id'      => $this->input->post('id_produk'),
			'qty'     => $this->input->post('banyak'),
		    'price'   => $this->input->post('harga'),
			'name'    => $this->input->post('nama_produk'));
		$this->cart->insert($data);

		echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart/index'>";
	}
	
	function update_keranjang()
	{
		$total = $this->cart->total_items();
		$item = $this->input->post('rowid');
		$qty = $this->input->post('qty');
		$stok = $this->input->post('jml');
			
		for($i=0; $i < $total; $i++){
			$data = array(
			'rowid' => $item[$i],
			'qty'   => $qty[$i]
			);
			if($qty > $stok){
				?>
				<script type="text/javascript" language="javascript">
					alert("Stok Kurang Boss");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart/index'>";
			}else{
				$this->cart->update($data);
			}
		}
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart/index'>";
			
	}
	function biaya_kirim(){
		$this->session->set_userdata('sesi_kotakirim', $this->input->post('id_biaya'));
		$biaya = $this->Mbiaya_kirim->biaya_kirim();
		$this->session->set_userdata('id_biaya',$biaya['id_biaya']);
		$this->session->set_userdata('biaya',$biaya['biaya']);
		
		$biayakirim = $this->session->userdata('biaya');	
		$id_biaya = $this->session->userdata('id_biaya');
		$this->session->set_userdata('sesi_idbiaya',$id_biaya);
		$this->session->set_userdata('sesi_biayakirim', $biayakirim);
		$this->view_cart();
	}
	function view_cart(){
		if($this->cart->contents() == false){
			$this->cart_kosong();
		}else{
			if(isset($_POST['id_biaya']) ){							//* session isian data
				$_SESSION['pos']=$_POST;
			}
			$data['nota']=$this->Morder->autoKode();
			$data['kota']=$this->Mbiaya_kirim->get_kota();
			$data['content']='user/keranjang';
			$this->load->view('user/template',$data);	
		}

	}
	function hapus_keranjang($kode){
		$id='';		
		if ($this->uri->segment(3) === FALSE){
    		$id='';
		}else{
    		$id = $this->uri->segment(3);
		}
		$data = array(
			'rowid' => $kode,
			'qty'   => 0);
			$this->cart->update($data);
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart/index'>";
	}
	function cart_kosong(){
		$this->auth->restrict_member();			//* cek user sudah login /belum
		/*$this->auth->cek_menu(3);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);	//* cek user sudah login /belum

		$data['base_url'] = base_url().'cart/cart_kosong/';
		$data['total_rows'] = $this->db->count_all('tbl_produk');
		$data['per_page'] = 12;
		$data['uri_segment'] = 3;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		
		$this->pagination->initialize($data);
		$data['produk']=$this->Mproduk->getAll($data['per_page'],$this->uri->segment(3,0));
		$data['terbaru']=$this->Mproduk->produk_terbaru();
		$data['content']='user/data_produk';
		$this->load->view('user/template',$data);
	}

}
?>