<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cart_beli extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->library('cart');
		$this->load->library('fungsi');
		$this->load->model('Mproduk');
		$this->load->model('Mpembelian');
		$this->load->model('Muser');
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

		echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart_beli/index'>";
	}
	
	function update_keranjang()
	{
		$total = $this->cart->total_items();
		$item = $this->input->post('rowid');
		$qty = $this->input->post('qty');
		for($i=0; $i < $total; $i++)
		{
			$data = array(
			'rowid' => $item[$i],
			'qty'   => $qty[$i]
			);
			$this->cart->update($data);
		}
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart_beli/index'>";
	}
	function view_cart(){
		if($this->cart->contents() == false){
			$this->cart_kosong();
		}else{
			if(isset($_POST['id_suplier']) ){							//* session isian data
				$_SESSION['pos']=$_POST;
			}
			$data['nota']=$this->Mpembelian->autoKode();
			$data['content']='admin/pembelian/keranjang_pembelian';
			$this->load->view('admin/template',$data);
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
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart_beli/index'>";
	}
	function cart_kosong(){
		/*$this->auth->restrict();
		$this->auth->cek_menu(2);
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		if(isset($_POST['id_suplier']) ){							//* session isian data
				$_SESSION['pos']=$_POST;
			}
		$data['content']='admin/pembelian/add_pembelian';
		$this->load->view('admin/template',$data);*/
		redirect('admin/pembelian/add_beli');
	}

}
?>