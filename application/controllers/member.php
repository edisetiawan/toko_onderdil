<?php class Member extends CI_Controller{
var $imagePath = 'public/media/posts/';
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

		$this->load->model('Mposting');
		$this->load->model('Mprofil');
		$this->load->model('Mgaleri');
		$this->load->model('Muser');
		$this->load->model('Mkategori');
		$this->load->model('Mmember');
		$this->load->library('email');
		$this->load->helper(array('form','url'));
		session_start();
	}
	public function index(){
		if($this->auth->is_logged_in() == false  ){
			$this->login();
		}elseif( $this->session->userdata('id_level') == 1){
			redirect('home/index');
			$this->session->set_flashdata('error','Anda belum terdaftar sebagai member !');
		}else{
			$level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($level);
			session_unset();
			$data['content']='user/content';
			$this->load->view('user/template',$data);
		}
	}
	public function login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_error_delimiters(' <span style="color:#FF0000">','</span>');

		if ($this->form_validation->run() == FALSE){
				$data['content']='user/login';
				$this->load->view('user/template',$data);
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$success = $this->auth->do_login($username,$password);
			if($success){
				// lemparkan ke halaman index user
				redirect('produk/index');
			}else{
				$data['login_info'] = "Maaf, username dan password salah!";
				redirect('member/login');
			}
		}
	}
	function logout(){
		if($this->auth->is_logged_in() == true){
			// jika dia memang sudah login, destroy session
			$this->auth->do_logout();
		}
		// larikan ke halaman utama
		redirect('home/index');
	}
	function email_ada($email){
        if ($this->Muser->email_ada($email) == TRUE){
            $this->form_validation->set_message('email_ada', " Email yang anda masukkan sudah menjadi member");
            return FALSE;
        }else{          
            return TRUE;
        }
    }
	function register(){
	
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','password','required|min_length[6]');
		$this->form_validation->set_rules('email','email','required|valid_emails|callback_email_ada');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run()==FALSE){
			if(isset($_POST['btn']) ){							
				$_SESSION['pos']=$_POST;
			}
			$data['content']='member/register';
			$this->load->view('user/template',$data);
			$this->session->set_flashdata('error','Data member gagal ditambahkan !');
		}else{
			$this->Mmember->insert();
			$member=$this->Mmember->getCode();
			$this->session->set_userdata('id_member',$member['id_member']);
			
			$this->Muser->insert();
			
			$member=$this->Muser->getCode();
			$this->session->set_userdata('username',$member['username']);
			$this->session->set_userdata('password',$member['password']);
			$this->session->set_userdata('email',$member['email']);
				
			$email = $this->session->userdata('email');
			$username = $this->session->userdata('username');
			$password = $this->session->userdata('password');
	
			$this->email->from('sigit.vespa12@gmail.com', 'SIGIT VESPA');
			$this->email->to($email);
			$this->email->subject('Registrasi');
			$this->email->message('Anda telah menjadi member dengan username = '.$username. ' dan password = '.$password);
				 
			if ($this->email->send()) {
			  ?>
			  	<script type="text/javascript" language="javascript">
					alert("Thanks. Registrasi Berhasil, Silahkan cek email anda!!!");
				</script>
			<?php
				/*$this->session->set_flashdata('success','Data member berhasil ditambahkan, Silahkan cek email anda !');
				  echo 'window.location.href = '.base_url().'home/index';
				  /*redirect ('home/index');*/
				  	$data['new_produk']=$this->Mproduk->produk_terbaru();
					$data['produk_sejenis']=$this->Mproduk->produk_sejenis();
					session_unset();
					$data['content']='user/content';
					$this->load->view('user/template',$data);

			} else {
			   ?>
				  <script type="text/javascript" language="javascript">
					alert("Pesan Tidak terkirim !!");
				  </script>
			  <?php
			}
			$this->session->set_flashdata('success','Data member berhasil ditambahkan, Silahkan cek email anda !');
			redirect('home/index');
			
		}
	}
	function send_email(){
		$this->load->library('email');
		
		$config = array();
		$config['charset'] = 'iso-8859-1';
		$config['useragent'] = 'Sigit Vespa'; 
		$config['protocol']= 'smtp';
		$config['mailtype']= 'html';
		$config['smtp_host']= 'ssl://smtp.gmail.com';
		$config['smtp_port']= '465';
		$config['smtp_timeout']= '30';
		$config['smtp_user']= 'sigit.vespa12@gmail.com';
		$config['smtp_pass']= 'sigit_vespa123'; 
		$config['crlf']='\r\n'; 
		$config['newline']='\r\n'; 
		$config['wordwrap'] = TRUE;
   		$this->email->initialize($config);
		
		$member=$this->Muser->getCode();
		$this->session->set_userdata('username',$member['username']);
		$this->session->set_userdata('password',$member['password']);
		$this->session->set_userdata('email',$member['email']);
			
		$email = $this->session->userdata('email');
		$username = $this->session->userdata('username');
		$password = $this->session->userdata('password');

		$this->email->from('sigit_vespa@gmail.com', 'SIGIT VESPA');
		$this->email->to($email);
		$this->email->subject('Registrasi');
		$this->email->message('Anda telah menjadi member dengan username = '.$username. 'dan password = '.$password);
			 
		if ($this->email->send()) {
		  ?>
			<script type="text/javascript" language="javascript">
				alert("Thanks. Registrasi Berhasil, Silahkan cek email anda!!!");
			</script>
		<?php
			  $this->index();
		} else {
		   ?>
			  <script type="text/javascript" language="javascript">
				alert("Pesan Tidak terkirim !!");
			  </script>
		  <?php
		}
		redirect('home/index');

	}
	function akun(){
		$this->auth->restrict_member();
		/*$this->auth->cek_menu_member(3);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','password','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run()==FALSE){
			$data['akun']=$this->Muser->tampil_akun();
			$data['content']='member/akun';
			$this->load->view('user/template',$data);
		}else{
			$this->Muser->update_akun();
			$this->session->set_flashdata('message','Data akun berhasil diperbarui !');
			redirect('member/index');
		}
	}
}
?>