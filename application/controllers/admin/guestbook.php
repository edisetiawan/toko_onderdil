<?php class Guestbook extends CI_Controller{
var $imagePath = 'public/media/posts/';

	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->model('Muser');
		$this->load->model('Mguest','',TRUE);
	}
	function index(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
			$level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($level);
		$data['base_url'] = base_url().'admin/guestbook/index/';
		$data['total_rows'] = $this->db->count_all('tbl_guestbook');
		$data['per_page'] = 10;
		$data['uri_segment'] = 4;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		$this->pagination->initialize($data);
		
		$data['guestbook']=$this->Mguest->getAll($data['per_page'],$this->uri->segment(4,0));
		$data['content']='admin/guestbook/data_guestbook';
		$this->load->view('admin/template',$data);
	}
	
	function edit_guest($id) {
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
			$level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($level);
		$this->form_validation->set_rules('balasan', 'balasan', 'required|xss_clean');

		$this->form_validation->set_error_delimiters('', '<br/>');
		if ($this->form_validation->run() == FALSE) {
			$data['balasan'] = $this->Mguest->select($id);
			$data['content']='admin/guestbook/balas_guest';
			$this->load->view('admin/template', $data);

		}else{
			$this->Mguest->update($id);
			$this->session->set_flashdata('success', 'Post edited');
			redirect('admin/guestbook');
		}
	}
	function delete_guest($id){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
			$level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($level);
		$this->Mguest->hapus_guest($id);
		$this->session->set_flashdata('message','data berhasil dihapus');
		redirect('admin/guestbook');
	}
	
	function cari_guest(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
			$level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($level);
		$this->form_validation->set_rules('nama_lengkap','nama_lengkap','required');
		$this->form_validation->set_message('required','Anda belum mengisi data');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message2','Anda belum memasukkan kata kunci pencarian !');
			redirect('admin/guestbook');
		}else{

			$page=$this->uri->segment(4);
				$batas=10;
			if(!$page):
				$offset=0;
			else:
				$offset=$page;
			endif;
			
			$data['nama_lengkap']="";
			$postkata=$this->input->post('nama_lengkap');
			if(!empty($postkata)){
				$data['nama_lengkap']=$this->input->post('nama');
				$this->session->set_userdata('pencarian_nama',$data['nama_lengkap']);
			}else{
				$data['nama_lengkap']=$this->session->userdata('pencarian_nama');
			}
			
			$data['nama_lengkap']=$this->Mguest->cari_guest($batas,$offset,$data['nama_lengkap']);
			$tot_hal=$this->Mguest->tot_guest('tbl_guestbook','nama_lengkap',
													$data['nama_lengkap']);
			
			$config['base_url']=base_url().'admin/guestbook/cari_guest/';
			$config['per_page']=$batas;
			$config['total_rows']=$tot_hal->num_rows();
			$config['uri_segment']=4;
			$config['first_link']='First';
			$config['last_link']='Last';
			$config['next_link']='<';
			$config['next_link']='>';
			$this->pagination->initialize($config);
			$data['pagination']=$this->pagination->create_links();
	
			$data['content']='admin/guestbook/cari_guest';
			$this->load->view('admin/template', $data);
		}
	}
}
?>