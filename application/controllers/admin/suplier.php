<?php class Suplier extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

		if(!$this->session->userdata('logged_in')&&!$this->session->userdata('username'))
		redirect(base_url(),'refresh');
		$this->load->model('Msuplier');
		$this->load->model('Muser');
	}
	function index(){
		$this->auth->restrict();
		$this->auth->cek_menu(2);
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		$data['base_url'] = base_url().'admin/suplier/index/';
		$data['total_rows'] = $this->db->count_all('tbl_suplier');
		$data['per_page'] = 10;
		$data['uri_segment'] = 4;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		$this->pagination->initialize($data);
		$data['suplier']=$this->Msuplier->getAll($data['per_page'],$this->uri->segment(4,0));
		$data['content']='admin/suplier/data_suplier';
		$this->load->view('admin/template',$data);
	}
	function add_suplier(){
		$this->auth->restrict();
		$this->auth->cek_menu(1);

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->form_validation->set_rules('nama_suplier','nama_suplier','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run()==FALSE){
			$data['content']='admin/suplier/add_suplier';
			$this->load->view('admin/template',$data);
			$this->session->set_flashdata('error','Data suplier gagal ditambahkan !');
		}else{
			$this->Msuplier->insert();
			$this->session->set_flashdata('success','Data suplier berhasil ditambahkan !');
			redirect ('admin/suplier/index');
		}
	}
	function edit_suplier($id){
		$this->auth->restrict();
		$this->auth->cek_menu(1);

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		$this->form_validation->set_rules('nama_suplier','nama_suplier','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run()==FALSE){
			$data['suplier']=$this->Msuplier->select($id);
			$data['content']='admin/suplier/edit_suplier';
			$this->load->view('admin/template',$data);
		}else{
			$this->Msuplier->update($id);
			$this->session->set_flashdata('message','Data suplier berhasil diperbarui !');
			redirect('admin/suplier/index');
		}
	}
	function delete_suplier($id){
		$this->auth->restrict();
		$this->auth->cek_menu(1);

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->Msuplier->delete($id);
		$this->session->set_flashdata('success','<blink>Data Berhasil dihapus !</blink>');
		redirect ('admin/suplier/index');
	}
}
?>