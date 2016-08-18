<?php class Guestbook extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

		$this->load->model('Mguest','',TRUE);
		$this->load->model('Mprofil');
		$this->load->model('Mposting');
		$this->load->model('Mkategori');
	}
	function index(){
		$this->form_validation->set_rules('nama_lengkap','nama_lengkap','required');
		$this->form_validation->set_rules('email','email','required|valid_emails');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		if ($this->form_validation->run() == FALSE) {
		
			$data['data_guest']=$this->Mguest->tampil_data();
			$data['jawab_guest']=$this->Mguest->balasan();
			$data['content'] = 'user/guestbook';
			$this->load->view('user/template', $data);	
		
		}else{
			$this->Mguest->insert();
			$id_gb = $this->Mguest->getCode();
			$this->session->set_userdata('id_guest', $id_gb['id_guest']);
			$this->Mguest->insert_balasan();
			$this->session->set_flashdata('success', 'Post created');
			redirect('guestbook');
		}
	}
}
?>
