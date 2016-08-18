<?php class Detil_pembelian extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->model('Muser');
		$this->load->model('Mproduk');
		$this->load->model('Mpembelian');
		$this->load->model('Mdpembelian');
		$this->load->library('cart');
		$this->load->library('fungsi');
		session_start();
	}
	function index(){
		$this->view_cart();
	}
	function tampil_produk($id){
		
		$data['suplier']=$this->Mproduk->produk_bySuplier($id);
		$this->load->view('admin/detil_pembelian/tampil_produk',$data);
	}
	function tambah_detil(){
		$id_pro = $this->input->post('id_produk');
		
		$produk=$this->Mproduk->getCode($id_pro);
			$this->session->set_userdata('harga_beli',$produk['harga_beli']);
		/*foreach($produk as $row):
			$id_produk = $row->id_produk;
			$harga_beli = $row->harga_beli;
		endforeach;*/
		
		$hrg_beli = $this->session->set_userdata('harga_beli',$harga_beli);
			
		$this->Mdpembelian->tambah_detil();
		
		/*foreach($this->cart->contents() as $items):
			$this->Mdpembelian->insert($items['id'], $items['qty'], $item['price']);
		endforeach;		
			$this->Mproduk->tambah_stok($items['id'], $items['qty']);*/
		echo 'sukses';
	}
	function edit_detil($id){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$this->form_validation->set_rules('id_detil_beli','id_detil_beli','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run()==FALSE){
			$data['detil']=$this->Mdpembelian->select_detil($id);
			$this->load->view('admin/detil_pembelian/edit_detil_pembelian',$data);
		}else{
			$id_pro = $this->input->post('id_produk');
			$produk=$this->Mproduk->getCode($id_pro);
			$this->session->set_userdata('harga_beli',$produk['harga_beli']);
			/*foreach($produk as $row):
				$id_produk = $row->id_produk;
				$harga_beli = $row->harga_beli;
			endforeach;*/
			$this->Mdpembelian->update_detil($id);
		}
	}
	function hapus_detil($id){
		$this->auth->restrict();
		$this->auth->cek_menu(2);

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->Mdpembelian->delete($id);
		$this->session->set_flashdata('success','<blink>Data Berhasil dihapus !</blink>');
		redirect ('admin/pembelian/edit_beli');
	}
}
?>