<?php class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		
		$this->load->model('Muser');
		$this->load->helper(array('form','url'));
	}
	public function index(){
		if($this->auth->is_logged_in() == false){
			$this->login();
		}else{
			$level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($level);
			$data['content']='admin/content';
			$this->load->view('admin/template',$data);
		}
	}
	public function login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_error_delimiters(' <span style="color:#FF0000">','</span>');

		if ($this->form_validation->run() == FALSE){
				$this->load->view('admin/login');
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success){
				// lemparkan ke halaman index user
				redirect('admin/home/index');
			}else{
				$data['login_info'] = "Maaf, username dan password salah!";
				$this->load->view('admin/login',$data);
			}
		}
	}
	function logout(){
		if($this->auth->is_logged_in() == true)
		{
			// jika dia memang sudah login, destroy session
			$this->auth->do_logout();
		}
		// larikan ke halaman utama
		redirect('admin/home/login');
	}
	function chat_forum(){
		$this->auth->restrict();
		/*$this->auth->cek_menu_member(3);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

			$data['content']='admin/chat_forum';
			$this->load->view('admin/template',$data);
	}
	function kirim_chat(){
		$this->auth->restrict();
		/*$this->auth->cek_menu_member(3);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		$user=$this->input->post('user');
		$pesan=$this->input->post('pesan');
		
		mysql_query("insert into tbl_chat (user,pesan) VALUES ('$user','$pesan')");
		redirect ('admin/home/ambil_pesan');
	}
	
	function ambil_pesan(){
		$tanggal=date('Y-m-d');
		$tampil=mysql_query("select * from tbl_chat where waktu like'%$tanggal%' order by waktu asc");
		while($r=mysql_fetch_array($tampil)){
		echo "<li><b>$r[user]</b> (<i>$r[waktu]</i>) : <br> $r[pesan] </li>";
		}
	}

}
?>