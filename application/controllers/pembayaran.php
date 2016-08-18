<?php class Pembayaran extends CI_Controller{
var $imagePath = 'public/media/pembayaran/';

	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: '.gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->model('Mpembayaran');
		$this->load->model('Muser');
		$this->load->model('Mdorder');
		$this->load->model('Morder');
		$this->load->model('Mmember');
		$this->load->library('email');
		$this->load->helper(array('form','url'));
	}
	function bayar_order($id = null){
		$this->auth->restrict_member();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
	
		if ($id == null) {
			$id = $this->input->post('id_order');
		}
		$this->form_validation->set_rules('no_transfer', 'no_transfer', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('', '<br/>');
		if ($this->form_validation->run() == TRUE) {
			$tagihan = $this->input->post('tagihan');
			$jml_bayar = $this->input->post('jml_bayar');
			if($jml_bayar == $tagihan){
				$data = array(
					'no_transfer' => $this->input->post('no_transfer'),
					'tgl_bayar' => $this->input->post('tgl_bayar'),
					'permalink' => url_title($this->input->post('no_transfer')),
					'status_bayar' => "Lunas",
					'jml_bayar' => $this->input->post('jml_bayar'),
				);
			}else{
				$data = array(
					'no_transfer' => $this->input->post('no_transfer'),
					'tgl_bayar' => $this->input->post('tgl_bayar'),
					'permalink' => url_title($this->input->post('no_transfer')),
					'status_bayar' => "Kurang",
					'jml_bayar' => $this->input->post('jml_bayar'),
				);
			}
			if ($_FILES['image']['error'] != 4) {
				$config['upload_path'] = $this->imagePath;
				$config['allowed_types'] = 'jpg|png|jpeg|gif';
				$config['max_size'] = '200000';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload("image")) {
					$image = $this->upload->data();
					$data['image'] = $this->imagePath . $image['file_name'];
				}
			}
			$this->Mpembayaran->update($id, $data);
			
			$pembayaran=$this->Mpembayaran->getStatus();
			$this->session->set_userdata('jml_bayar',$pembayaran['jml_bayar']);
			$this->session->set_userdata('tagihan',$pembayaran['tagihan']);
			$this->session->set_userdata('status_bayar',$pembayaran['status_bayar']);
			$this->session->set_userdata('tgl_bayar',$pembayaran['tgl_bayar']);
			
			$jml_bayar=$this->session->userdata('jml_bayar');
			$tagihan=$this->session->userdata('tagihan');
			$status_bayar=$this->session->userdata('status_bayar');
			$tgl_bayar=$this->session->userdata('tgl_bayar');
			if($status_bayar == "Kurang"){
				$text = "Kekurangan Anda = ";
				$kekurangan = $tagihan - $jml_bayar;
			}else{
				$text =" ";
				$kekurangan =" ";
			}
			$transfer=$this->Mpembayaran->getCode();
			$this->session->set_userdata('metode',$transfer['metode']);
			$metode=$this->session->userdata('metode');
			if($metode == 1){
				$bayar="Transfer Bank";
				$text2="Anda telah melakukan transfer ke rek Kami = No Rek : 675701000015507 Atasnama : Sigit";
			}else{
				$bayar="Bayar Ditempat / COD";
				$text2="Pembayaran dilakukan apabila barng sudah sampai ditangan anda";
			}
			
			$member=$this->Mmember->getEmail();
			$this->session->set_userdata('email',$member['email']);
			$email=$this->session->userdata('email');
				
			$this->email->from('sigit.vespa12@gmail.com','SIGIT VESPA');
			$this->email->to($email);
			$this->email->subject('Konfirmasi Pembayaran');
			$this->email->message(
				' Anda telah melakukan konfirmasi pembayaran sebesar = '.$this->fungsi->rupiah($jml_bayar).
				' pada tanggal '.$tgl_bayar.
				' Metode pembayaran'.$bayar.' '
				.$text2.
				' Status pembayaran = '.$status_bayar.'. '
				.$text.' '
				.$kekurangan
			);
			
			if ($this->email->send()) {
				
			  ?>
				<script type="text/javascript" language="javascript">
					alert("Thanks. Transaksi anda berhasil, Silahkan cek email anda!!!");
				</script>
			<?php
				$this->session->set_flashdata('success','Konfirmasi Pembayaran Berhasil, Silahkan cek email anda !');
				redirect('order_pesanan/index');
			} else {
			   ?>
				  <script type="text/javascript" language="javascript">
					alert("Pesan Tidak terkirim !!");
				  </script>
			  <?php
			  $this->email->print_debugger();
			}
			$this->session->set_flashdata('success','Konfirmasi Pembayaran Berhasil, Silahkan cek email anda !');
			redirect('order_pesanan/index');
		}
		
		$data['pembayaran'] = $this->Mpembayaran->findById($id);
		$data['content']='user/bayar_order';
		$this->load->view('user/template', $data);
	}
	function email_konfirmasi(){
		$member=$this->Mmember->getEmail();
			$this->session->set_userdata('email',$member['email']);
			$email=$this->session->userdata('email');
				
			$this->email->from('sigit.vespa12@gmail.com','SIGIT VESPA');
			$this->email->to($email);
			$this->email->subject('Konfirmasi Order');
			$this->email->message('Anda telah berbelanja di Sigit Vespa. Total Tagihan Anda = '.$this->fungsi->rupiah($tagihan).' Metode Pembayaran yang anda pilih adalah '.$bayar.' '.$text);
			
			if ($this->email->send()) {
			  ?>
				<script type="text/javascript" language="javascript">
					alert("Thanks. Transaksi anda berhasil, Silahkan cek email anda!!!");
				</script>
			<?php
				redirect('order_pesanan/konfirmasi_order');
			} else {
			   ?>
				  <script type="text/javascript" language="javascript">
					alert("Pesan Tidak terkirim !!");
				  </script>
			  <?php
			  $this->email->print_debugger();
			}
		redirect('order_pesanan/index');
	}
}
?>