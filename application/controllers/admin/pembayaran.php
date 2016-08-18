<?php class Pembayaran extends CI_Controller{
var $imagePath = 'public/media/pembayaran/';

	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->model('Muser');
		$this->load->model('Mpembayaran');
		
	}
	function index(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		$data['base_url'] = base_url().'admin/pembayaran/index/';
		$data['total_rows'] = $this->db->count_all('tbl_pembayaran');
		$data['per_page'] = 10;
		$data['uri_segment'] = 4;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		$this->pagination->initialize($data);
		$data['pembayaran']=$this->Mpembayaran->getAll($data['per_page'],$this->uri->segment(4,0));
		$data['content']='admin/pembayaran/data_pembayaran';
		$this->load->view('admin/template',$data);
	}
	function edit_pembayaran($id = null){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($level);
		if ($id == null) {
			$id = $this->input->post('id_order');
		}
		$this->form_validation->set_rules('id_order', 'id_order', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('', '<br/>');
		if ($this->form_validation->run() == TRUE) {
			$tagihan = $this->input->post('tagihan');
			$jml_bayar = $this->input->post('jml_bayar');
			if($jml_bayar == $tagihan){
				$data = array(
					'no_transfer' => $this->input->post('no_transfer'),
					'tgl_bayar' => $this->input->post('tgl_bayar'),
					'permalink' => url_title($this->input->post('no_transfer')),
					'status_bayar' => "Lunas",
					'jml_bayar' => $this->input->post('jml_bayar'),
				);
			}else{
				$data = array(
					'no_transfer' => $this->input->post('no_transfer'),
					'tgl_bayar' => $this->input->post('tgl_bayar'),
					'permalink' => url_title($this->input->post('no_transfer')),
					'status_bayar' => "Kurang",
					'jml_bayar' => $this->input->post('jml_bayar'),
				);
			}
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
			$this->Mpembayaran->update($id, $data);
			$this->session->set_flashdata('success', 'Post edited');
			redirect('admin/pembayaran/index');
		}
		
		$data['pembayaran'] = $this->Mpembayaran->findById($id);
		$data['content']='admin/pembayaran/edit_pembayaran';
		$this->load->view('admin/template',$data);
	}
}
?>