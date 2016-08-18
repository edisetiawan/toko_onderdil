<?php class Galeri extends CI_Controller{
var $imagePath = 'public/media/galeri/';

	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->model('Muser');
		$this->load->model('Mgaleri');
		
	}

	function index(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		$data['base_url'] = base_url().'admin/galeri/index/';
		$data['total_rows'] = $this->db->count_all('tbl_galeri');
		$data['per_page'] = 10;
		$data['uri_segment'] = 4;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		$this->pagination->initialize($data);
		$data['galeri']=$this->Mgaleri->getAll($data['per_page'],$this->uri->segment(4,0));
		$data['content']='admin/galeri/data_galeri';
		$this->load->view('admin/template',$data);
	}
	function add_galeri(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->form_validation->set_rules('judul_galeri','judul_galeri','required');
		$this->form_validation->set_rules('tgl_posting','tgll_posting','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		if ($this->form_validation->run() == TRUE) {
			$params = array(
				'judul_galeri' => $this->input->post('judul_galeri'),
				'tgl_posting' => $this->input->post('tgl_posting'),
				'permalink' => url_title($this->input->post('judul_galeri')),
				'id_user' => $this->input->post('id_user'),
				'keterangan' => $this->input->post('keterangan')
				);
			if ($_FILES['image']['error'] != 4) {
				$config['upload_path'] = $this->imagePath;
				$config['allowed_types'] = 'jpg|png|jpeg|gif';
				$config['max_size'] = '200000';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload("image")) {
					$image = $this->upload->data();
					$params['image'] = $this->imagePath . $image['file_name'];
				}
			}
			$this->Mgaleri->insert($params);
			$this->session->set_flashdata('success', 'Post created');
			redirect('admin/galeri');
		}
		$data['content'] = 'admin/galeri/add_galeri';
		$this->load->view('admin/template', $data);	
	}
	function edit_galeri($id = null) {
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
	
		if ($id == null) {
			$id = $this->input->post('id_galeri');
		}
		$this->form_validation->set_rules('judul_galeri', 'judul_galeri', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('', '<br/>');
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'judul_galeri' => $this->input->post('judul_galeri'),
				'tgl_posting' => $this->input->post('tgl_posting'),
				'permalink' => url_title($this->input->post('judul_galeri')),
				'id_user' => $this->input->post('id_user'),
				'keterangan' => $this->input->post('keterangan')
			);
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
			$this->Mgaleri->update($id, $data);
			$this->session->set_flashdata('success', 'Post edited');
			redirect('admin/galeri');
		}
		$data['galeri'] = $this->Mgaleri->findById($id);
		$data['content'] = 'admin/galeri/edit_galeri';
		$this->load->view('admin/template', $data);
	}
	function delete_galeri($id = null) {
		$this->auth->restrict();
		$this->auth->cek_menu(2);
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		if ($id == null) {
			$this->session->set_flashdata('error', 'Invalid post');
			redirect('admin/galeri');
		} else {
			$post = $this->Mgaleri->findById($id);
			if (file_exists($post['image'])) {
				unlink($post['image']);
			}
			$this->Mgaleri->delete($id);
			$this->session->set_flashdata('success', 'Post deleted');
			redirect('admin/galeri');
		}
	}
}
?>