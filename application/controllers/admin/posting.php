<?php class Posting extends CI_Controller{
var $imagePath = 'public/media/posts/';

	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->model('Mposting');
		$this->load->model('Mkategori');
		$this->load->model('Muser');
		
	}
	function index(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		$data['base_url'] = base_url().'admin/posting/index/';
		$data['total_rows'] = $this->db->count_all('tbl_posting');
		$data['per_page'] = 10;
		$data['uri_segment'] = 4;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		$this->pagination->initialize($data);
		$data['posting']=$this->Mposting->getAll($data['per_page'],$this->uri->segment(4,0));
		$data['kategori']=$this->Mkategori->getkategori();
		$data['content']='admin/posting/data_posting';
		$this->load->view('admin/template',$data);
	}
	function add_posting(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->form_validation->set_rules('judul_posting','judul_posting','required');
		$this->form_validation->set_rules('isi_posting','isi_posting','required');
		$this->form_validation->set_rules('tgl_posting','tgll_posting','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		if ($this->form_validation->run() == TRUE) {
			$params = array(
				'judul_posting' => $this->input->post('judul_posting'),
				'tgl_posting' => $this->input->post('tgl_posting'),
				'permalink' => url_title($this->input->post('judul_posting')),
				'isi_posting' => $this->input->post('isi_posting'),
				'id_user' => $this->input->post('id_user'),
				'id_kategori' => $this->input->post('id_kategori')
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
			$this->Mposting->insert($params);
			$this->session->set_flashdata('success', 'Post created');
			redirect('admin/posting');
		}
		$data['kategori'] = $this->Mkategori->getkategori();
		$data['content'] = 'admin/posting/add_posting';
		$this->load->view('admin/template', $data);	
	}
	function edit_posting($id = null) {
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
	
		if ($id == null) {
			$id = $this->input->post('id_posting');
		}
		$this->form_validation->set_rules('judul_posting', 'judul_posting', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('', '<br/>');
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'judul_posting' => $this->input->post('judul_posting'),
				'tgl_posting' => $this->input->post('tgl_posting'),
				'permalink' => url_title($this->input->post('judul_posting')),
				'isi_posting' => $this->input->post('isi_posting'),
				'id_user' => $this->input->post('id_user'),
				'id_kategori' => $this->input->post('id_kategori')
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
			$this->Mposting->update($id, $data);
			$this->session->set_flashdata('success', 'Post edited');
			redirect('admin/posting');
		}
		$data['kategori'] = $this->Mkategori->getkategori();
		$data['posting'] = $this->Mposting->findById($id);
		$data['content'] = 'admin/posting/edit_posting';
		$this->load->view('admin/template', $data);
	}
	function delete_posting($id = null) {
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		if ($id == null) {
			$this->session->set_flashdata('error', 'Invalid post');
			redirect('admin/posting');
		} else {
			$post = $this->Mposting->findById($id);
			if (file_exists($post['image'])) {
				unlink($post['image']);
			}
			$this->Mposting->delete($id);
			$this->session->set_flashdata('success', 'Post deleted');
			redirect('admin/posting');
		}
	}
	
	function cari_posting(){
		$this->auth->restrict();
		$this->auth->cek_menu(2);
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
	
		$this->form_validation->set_rules('judul_posting','judul_posting','required');
		$this->form_validation->set_message('required','Anda belum mengisi data');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error','Anda belum memasukkan kata kunci pencarian !');
			redirect('admin/posting/index');
		}else{
			$page=$this->uri->segment(4);
				$batas=10;
			if(!$page):
				$offset=0;
			else:
				$offset=$page;
			endif;
			
			$data['judul_posting']="";
			$postkata=$this->input->post('judul_posting');
			if(!empty($postkata)){
				$data['judul_posting']=$this->input->post('judul_posting');
				$this->session->set_userdata('cari_posting',$data['judul_posting']);
			}else{
				$data['judul_posting']=$this->session->userdata('judul_posting');
			}
			
			$data['judul_posting']=$this->Mposting->cari_posting($batas,$offset,$data['judul_posting']);
			$tot_hal=$this->Mposting->tot_posting('tbl_posting','judul_posting',$data['judul_posting']);
			
			$config['base_url']=base_url().'admin/posting/';
			$config['per_page']=$batas;
			$config['total_rows']=$tot_hal->num_rows();
			$config['uri_segment']=4;
			$config['first_link']='First';
			$config['last_link']='Last';
			$config['next_link']='<';
			$config['next_link']='>';
			$this->pagination->initialize($config);
			$data["pagination"]=$this->pagination->create_links();
			$data['content']='admin/posting/cari_posting';
			$this->load->view('admin/template',$data);
		}
	}
}
?>