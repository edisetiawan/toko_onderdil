<?php class Laporan extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		
		$this->load->model('Muser');
		$this->load->helper(array('form','url'));
		$this->load->model('Mlaporan');
		$this->load->model('Morder');
		$this->load->model('Mdorder');
		session_start();
	}
	function index(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
			if(isset($_POST['laporan']) ){							//* session isian data
				$_SESSION['pos']=$_POST;
			}
		$data['content']='admin/laporan/menu_laporan';
		$this->load->view('admin/template',$data);
	}
	function cetak_laporan(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$transaksi=$this->input->post('transaksi');
		$status_order = $this->input->post('status_order');
		$status_beli = $this->input->post('status_beli');
		if($transaksi == 1 and $status_order > 0){
			$this->lap_penjualan();
		}elseif($transaksi == 2 and $status_beli > 0){
			$this->lap_pembelian();
		}else{
			$this->lap_pembayaran();
		}
	}
	function lap_penjualan(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
			
		$data['order']=$this->Mlaporan->lap_penjualan();
		if($data['order']==null){
			$this->session->set_flashdata('error','Data masih kosong ');
			redirect('admin/laporan');
		}else{
			$this->load->view('admin/laporan/lap_penjualan',$data);
		}
	}
	function lap_pembelian(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
			
		$data['pembelian']=$this->Mlaporan->lap_pembelian();
		if($data['pembelian']==null){
			$this->session->set_flashdata('error','Data masih kosong ');
			redirect('admin/laporan');
		}else{
			$this->load->view('admin/laporan/lap_pembelian',$data);
		}
	}
	function lap_pembayaran(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
			
		$data['pembayaran']=$this->Mlaporan->lap_pembayaran();
		if($data['pembayaran']==null){
			$this->session->set_flashdata('error','Data masih kosong ');
			redirect('admin/laporan');
		}else{
			$this->load->view('admin/laporan/lap_pembayaran',$data);
		}
	}
	function nota_order($id){
		$this->auth->restrict();
		/*$this->auth->cek_menu(3);*/

			$id_level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($id_level);
			$data['order']=$this->Mlaporan->nota_order($id);
			$data['detil']=$this->Mlaporan->detil_order($id);
			$this->load->view('admin/laporan/nota_order',$data);
	}
	function nota_pembayaran($id){
		$this->auth->restrict();
		/*$this->auth->cek_menu(3);*/

			$id_level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($id_level);
			$data['nota_order']= $this->Mlaporan->nota_order($id);
			$data['detil_order']=$this->Mlaporan->detil_order($id);
			$data['nota_pembayaran']= $this->Mlaporan->nota_pembayaran($id);
			$this->load->view('admin/laporan/nota_pembayaran',$data);
	}
	function nota_pembelian($id){
		$this->auth->restrict();
		/*$this->auth->cek_menu(3);*/

			$id_level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($id_level);
			$data['pembelian']=$this->Mlaporan->nota_pembelian($id);
			$data['detil']=$this->Mlaporan->detil_pembelian($id);
			$this->load->view('admin/laporan/nota_pembelian',$data);
	}
}
?>