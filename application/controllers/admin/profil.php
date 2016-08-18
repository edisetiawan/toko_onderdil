<?php class Profil extends CI_Controller{
var $imagePath = 'public/media/posts/';

	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->model('Mprofil');
		$this->load->model('Muser');
	}
	function index(){
		$this->auth->restrict();
		$this->auth->cek_menu(1);
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		$data['base_url'] = base_url().'admin/profil/index/';
		$data['total_rows'] = $this->db->count_all('tbl_profil');
		$data['per_page'] = 8;
		$data['uri_segment'] = 4;
		$data['num_links']= 4;
		$this->pagination->initialize($data);
		$data['profil']=$this->Mprofil->getAll($data['per_page'],$this->uri->segment(4,0));
		$data['content']='admin/profil/data_profil';
		$this->load->view('admin/template',$data);
	}
	function add_profil(){
		$this->auth->restrict();
		$this->auth->cek_menu(1);
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->form_validation->set_rules('judul_profil','judul_profil','required');
		$this->form_validation->set_rules('isi_profil','isi_profil','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		if ($this->form_validation->run() == TRUE) {
			$params = array(
				'judul_profil' => $this->input->post('judul_profil'),
				'permalink' => url_title($this->input->post('judul_profil')),
				'tgl_posting' => $this->input->post('tgl_posting'),
				/*'latitude'	=> $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),*/
				'isi_profil' => $this->input->post('isi_profil'),
				'id_user' => $this->input->post('id_user'),
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
			$this->Mprofil->insert($params);
			$this->session->set_flashdata('success', 'Post created');
			redirect('admin/profil');
		}
		$data['content'] = 'admin/profil/add_profil';
		$this->load->view('admin/template', $data);	
	}
	function edit_profil($id = null) {
		$this->auth->restrict();
		$this->auth->cek_menu(2);
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
	
		if ($id == null) {
			$id = $this->input->post('id_profil');
		}
		$this->form_validation->set_rules('judul_profil', 'judul_profil', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('', '<br/>');
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'judul_profil' => $this->input->post('judul_profil'),
				'permalink' => url_title($this->input->post('judul_profil')),
				'tgl_posting' => $this->input->post('tgl_posting'),
				/*'latitude'	=> $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),*/
				'isi_profil' => $this->input->post('isi_profil'),
				'id_user' => $this->input->post('id_user'),
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
			$this->Mprofil->update($id, $data);
			$this->session->set_flashdata('success', 'Post edited');
			redirect('admin/profil');
		}
		$data['profil'] = $this->Mprofil->findById($id);
		$data['content'] = 'admin/profil/edit_profil';
		$this->load->view('admin/template', $data);
	}
	function delete_profil($id = null) {
		$this->auth->restrict();
		$this->auth->cek_menu(2);
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		if ($id == null) {
			$this->session->set_flashdata('error', 'Invalid post');
			redirect('admin/profil');
		} else {
			$post = $this->Mprofil->findById($id);
			if (file_exists($post['image'])) {
				unlink($post['image']);
			}
			$this->Mprofil->delete($id);
			$this->session->set_flashdata('success', 'Post deleted');
			redirect('admin/profil');
		}
	}
}
?>