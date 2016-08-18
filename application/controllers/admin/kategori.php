<?php class Kategori extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

		if(!$this->session->userdata('logged_in')&&!$this->session->userdata('username'))
		redirect(base_url(),'refresh');
		$this->load->model('Mkategori');
		$this->load->model('Muser');
	}
	function index(){
		$this->auth->restrict();
		$this->auth->cek_menu(1);

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$data['kategori']=$this->Mkategori->getkategori();
		$data['content']='admin/kategori/data_kategori';
		$this->load->view('admin/template',$data);
	}
	function add_kategori(){
		$this->auth->restrict();
		$this->auth->cek_menu(1);

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->form_validation->set_rules('nama_kategori','nama_kategori','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run()==FALSE){
			$data['content']='admin/kategori/add_kategori';
			$this->load->view('admin/template',$data);
			$this->session->set_flashdata('error','Data Kategori gagal ditambahkan !');
		}else{
			$this->Mkategori->insert();
			$this->session->set_flashdata('success','Data Kategori berhasil ditambahkan !');
			redirect ('admin/kategori/index');
		}
	}
	function edit_kategori($id){
		$this->auth->restrict();
		$this->auth->cek_menu(1);

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		$this->form_validation->set_rules('nama_kategori','nama_kategori','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run()==FALSE){
			$data['kategori']=$this->Mkategori->select($id);
			$data['content']='admin/kategori/edit_kategori';
			$this->load->view('admin/template',$data);
		}else{
			$this->Mkategori->update($id);
			$this->session->set_flashdata('message','Data kategori berhasil diperbarui !');
			redirect('admin/kategori/index');
		}
	}
	function delete($id){
		$this->auth->restrict();
		$this->auth->cek_menu(1);

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->Mkategori->delete($id);
		$this->session->set_flashdata('success','<blink>Data Berhasil dihapus !</blink>');
		redirect ('admin/kategori/index');
	}
}
?>