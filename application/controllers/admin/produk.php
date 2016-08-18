<?php class Produk extends CI_Controller{
var $imagePath = 'public/media/produk/';

	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->model('Muser');
		$this->load->model('Mproduk');
		$this->load->model('Mkategori_produk');
	}

	function index(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		$data['base_url'] = base_url().'admin/produk/index/';
		$data['total_rows'] = $this->db->count_all('tbl_produk');
		$data['per_page'] = 10;
		$data['uri_segment'] = 4;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		$this->pagination->initialize($data);
		$data['produk']=$this->Mproduk->getAll($data['per_page'],$this->uri->segment(4,0));
		$data['content']='admin/produk/data_produk';
		$this->load->view('admin/template',$data);
	}
	function add_produk(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->form_validation->set_rules('nama_produk','nama_produk','required');
		$this->form_validation->set_rules('jml','jml','required|numeric');
		$this->form_validation->set_rules('harga_beli','harga_beli','required|numeric');
		$this->form_validation->set_rules('harga','harga','required|numeric');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		if ($this->form_validation->run() == TRUE) {
			$params = array(
				'nama_produk' => $this->input->post('nama_produk'),
				'produk_sku' => $this->input->post('produk_sku'),
				'permalink' => url_title($this->input->post('nama_produk')),
				'id_kategori_produk' => $this->input->post('id_kategori_produk'),
				'jml' => $this->input->post('jml'),
				'harga' => $this->input->post('harga'),
				'harga_beli' => $this->input->post('harga_beli'),
				'manufaktur' => $this->input->post('manufaktur'),
				'keterangan' => $this->input->post('keterangan'),
				'id_suplier' => $this->input->post('id_suplier')
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
			$this->Mproduk->insert($params);
			$this->session->set_flashdata('success', 'Post created');
			redirect('admin/produk');
		}
		$data['kategori']=$this->Mkategori_produk->getkategori();
		$data['content'] = 'admin/produk/add_produk';
		$this->load->view('admin/template', $data);	
	}
	function edit_produk($id = null) {
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
	
		if ($id == null) {
			$id = $this->input->post('id_produk');
		}
		$this->form_validation->set_rules('nama_produk', 'nama_produk', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('', '<br/>');
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'nama_produk' => $this->input->post('nama_produk'),
				'produk_sku' => $this->input->post('produk_sku'),
				'permalink' => url_title($this->input->post('nama_produk')),
				'id_kategori_produk' => $this->input->post('id_kategori_produk'),
				'jml' => $this->input->post('jml'),
				'harga' => $this->input->post('harga'),
				'harga_beli' => $this->input->post('harga_beli'),
				'manufaktur' => $this->input->post('manufaktur'),
				'keterangan' => $this->input->post('keterangan'),
				'id_suplier' => $this->input->post('id_suplier')
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
			$this->Mproduk->update($id, $data);
			$this->session->set_flashdata('success', 'Post edited');
			redirect('admin/produk');
		}
		$data['produk'] = $this->Mproduk->findById($id);
		$data['kategori']=$this->Mkategori_produk->getkategori();
		$data['content'] = 'admin/produk/edit_produk';
		$this->load->view('admin/template', $data);
	}
	function delete_produk($id = null) {
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		if ($id == null) {
			$this->session->set_flashdata('error', 'Invalid post');
			redirect('admin/produk');
		} else {
			$post = $this->Mproduk->findById($id);
			if (file_exists($post['image'])) {
				unlink($post['image']);
			}
			$this->Mproduk->delete($id);
			$this->session->set_flashdata('success', 'Post deleted');
			redirect('admin/produk');
		}
	}
}
?>