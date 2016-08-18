<?php class Pengguna extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		
		$this->load->model('Muser');
		$this->load->model('Mmember');
		$this->load->helper(array('form','url'));
	}
	function index(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		$data['base_url'] = base_url().'admin/pengguna/index/';
		$data['total_rows'] = $this->db->count_all('tbl_user');
		$data['per_page'] = 10;
		$data['uri_segment'] = 4;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		$this->pagination->initialize($data);
		$data['pengguna']=$this->Muser->getAll($data['per_page'],$this->uri->segment(4,0));
		$data['content']='admin/pengguna/data_pengguna';
		$this->load->view('admin/template',$data);
	}
	function add_pengguna(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run()==FALSE){
			$data['content']='admin/pengguna/add_pengguna';
			$this->load->view('admin/template',$data);
			$this->session->set_flashdata('error','Data pengguna gagal ditambahkan !');
		}else{
			$this->Muser->insert();
			$this->session->set_flashdata('success','Data pengguna berhasil ditambahkan !');
			redirect ('admin/pengguna/index');
		}
	}
	function edit_pengguna($id){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run()==FALSE){
			$data['pengguna']=$this->Muser->select_id($id);
			$data['content']='admin/pengguna/edit_pengguna';
			$this->load->view('admin/template',$data);
		}else{
			$this->Muser->update($id);
			$this->session->set_flashdata('message','Data pengguna berhasil diperbarui !');
			redirect('admin/pengguna/index');
		}
	}
	function delete_pengguna($id){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->Mpengguna->delete($id);
		$this->session->set_flashdata('success','<blink>Data Berhasil dihapus !</blink>');
		redirect ('admin/pengguna/index');
	}
	function cari_pengguna(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/

		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		

		$this->form_validation->set_rules('nama_lengkap','nama_lengkap','required');
		$this->form_validation->set_message('required','Anda belum mengisi data');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error','Anda belum memasukkan kata kunci pencarian !');
			redirect('admin/pengguna');
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
				$data['nama_lengkap']=$this->input->post('nama_lengkap');
				$this->session->set_userdata('cari_pengguna',$data['nama_lengkap']);
			}else{
				$data['nama_lengkap']=$this->session->userdata('cari_pengguna');
			}
			
			$data['nama_lengkap']=$this->Muser->cari_pengguna($batas,$offset,$data['nama_lengkap']);
			$tot_hal=$this->Muser->tot_pengguna('kategori','nama_lengkap',$data['nama_lengkap']);
			
			$config['base_url']=base_url().'admin/pengguna/cari_pengguna/';
			$config['per_page']=$batas;
			$config['total_rows']=$tot_hal->num_rows();
			$config['uri_segment']=4;
			$config['first_link']='First';
			$config['last_link']='Last';
			$config['next_link']='<';
			$config['next_link']='>';
			$this->pagination->initialize($config);
			$data['pagination']=$this->pagination->create_links();
			$data['content']='admin/pengguna/cari_pengguna';
			$this->load->view('admin/template',$data);
		}
	}
	function akun_pribadi($id){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/

		$this->form_validation->set_rules('nama_member','nama_member','required');
		$this->form_validation->set_rules('no_telp','no_telp','required|numeric');
		$this->form_validation->set_rules('email','email','required|valid_emails');
		$this->form_validation->set_message('required','Anda belum mengisi data');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');

		if($this->form_validation->run() == FALSE){
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
			$data['pengguna']=$this->Mmember->select_id($id);
			$data['level']=$this->Muser->getLevel();
			$data['content']='admin/pengguna/data_pribadi';
			$this->load->view('admin/template',$data);
		}else{
			$this->Mmember->edit_akun($id);
			$this->session->set_flashdata('success','Data pribadi berhasil diperbarui !');
			redirect('admin/home');
		}
	}
	function ganti_password($id){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/

		$this->form_validation->set_rules('username','username','required|xss_clean');
		$this->form_validation->set_rules('password','password','required|xss_clean|callback_cek_password|match[confirm_password]');
		$this->form_validation->set_rules('password_lama','password_lama','required|callback_password_lama');
		$this->form_validation->set_rules('confirm_password','confirm_password','required|xss_clean');

		$this->form_validation->set_message('required','Anda belum mengisi data');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_error_delimiters('', '</br>');

		if($this->form_validation->run() == FALSE){
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
			$data['pengguna']=$this->Muser->select_id($id);
			$data['level']=$this->Muser->getLevel();
			if(isset($_POST['btn']) ){							//* session isian data
				$_SESSION['pos']=$_POST;
			}
			$data['content']='admin/pengguna/ganti_password';
			$this->load->view('admin/template',$data);
		}else{
			$this->Muser->ganti_password($id);
			$this->session->set_flashdata('success','Data pengguna berhasil diperbarui !');
			session_unset();
			redirect('admin/home');
		}
	}

}
?>