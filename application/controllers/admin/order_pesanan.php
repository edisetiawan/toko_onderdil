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
		session_start();
	}
	function index(){
		$this->auth->restrict();			//* cek user sudah login /belum
		/*$this->auth->cek_menu(3);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);	//* cek user sudah login /belum

		$data['base_url'] = base_url().'admin/order_pesanan/index/';
		$data['total_rows'] = $this->db->count_all('tbl_order');
		$data['per_page'] = 10;
		$data['uri_segment'] = 4;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		
		$this->pagination->initialize($data);
		$data['order']=$this->Morder->getAll($data['per_page'],$this->uri->segment(4,0));
		$data['content']='admin/order/data_order';
		$this->load->view('admin/template',$data);

	}
	function select_validate($selectValue){
		if($selectValue=='none'){
			$this->form_validation->set_message('select_validate','Tidak ada data yang dipilih');
			return false;
		}else{
			return true;
		}
	}
	function edit_order($id){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$this->form_validation->set_rules('id_order','id_order','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run()==FALSE){
			$level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($level);
			$data['order']=$this->Morder->select($id);
			$data['detil']=$this->Mdorder->select($id);
			$data['content']='admin/order/edit_order';
			$this->load->view('admin/template',$data);
		}else{
			$this->Morder->update_order($id);
			$this->session->set_flashdata('success','Data order berhasil diperbarui !');
			redirect('admin/order_pesanan/index');
		}

	}
}
?>