<?php class Pembelian extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->model('Muser');
		$this->load->model('Mproduk');
		$this->load->model('Mpembelian');
		$this->load->model('Mdpembelian');
		$this->load->library('cart');
		session_start();
	}
	function index(){
		$this->auth->restrict();
		$this->auth->cek_menu(2);
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		$data['base_url'] = base_url().'admin/pembelian/index/';
		$data['total_rows'] = $this->db->count_all('tbl_pembelian');
		$data['per_page'] = 10;
		$data['uri_segment'] = 4;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		$this->pagination->initialize($data);
		$data['pembelian']=$this->Mpembelian->getAll($data['per_page'],$this->uri->segment(4,0));
		session_unset();
		$this->cart->destroy();
		$data['content']='admin/pembelian/data_pembelian';
		$this->load->view('admin/template',$data);
	}
	function select_validate($selectValue){
		if($selectValue=='none'){
			$this->form_validation->set_message('select_validate','Tidak ada data yang dipilih');
			return false;
		}else{
			return true;
		}
	}	
	function tampil_produk($id){
		$data['produk']=$this->Mproduk->produkSuplier($id);
		$data['content']='admin/pembelian/tampil_produk';
		$this->load->view('admin/template',$data);
	}
	function add_beli(){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$id_level = $this->session->userdata('id_level');
		$data['menu'] = $this->Muser->get_menu_for_level($id_level);
		
		$this->form_validation->set_rules('no_beli','no_beli','required');
		$this->form_validation->set_rules('total_beli','total_beli','required');
		$this->form_validation->set_rules('id_suplier','id_suplier','callback_select_validate');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_error_delimiters('', '</br>');

		if($this->form_validation->run()==FALSE){
			if(isset($_POST['id_suplier']) ){							
				$_SESSION['pos']=$_POST;
			}
			$data['content']='admin/pembelian/add_pembelian';
			$this->load->view('admin/template',$data);
		}else{
			$this->Mpembelian->insert();
			$kdbeli = $this->Mpembelian->getCode();
			$this->session->set_userdata('id_beli', $kdpesan['id_beli']);
				
			foreach($this->cart->contents() as $items):
				$this->Mdpembelian->insert($items['id'], $items['qty']);
			endforeach;		
				/*$this->Mproduk->tambah_stok($items['id'], $items['qty']);*/
			$this->cart->destroy();
			$this->session->set_flashdata('success','Data Pembelian berhasil ditambahkan !');
			redirect('admin/pembelian/index');
		}
	}
	function simpan_beli(){
		$this->Mpembelian->insert();
		$kdbeli = $this->Mpembelian->getCode();
		$this->session->set_userdata('id_beli', $kdbeli['id_beli']);
			
		foreach($this->cart->contents() as $items):
			$this->Mdpembelian->insert($items['id'], $items['qty'], $items['price']);
		endforeach;		
			/*$this->Mproduk->tambah_stok($items['id'], $items['qty']);*/
		$this->cart->destroy();
		$this->session->set_flashdata('success','Data Pembelian berhasil ditambahkan !');
		redirect('admin/pembelian/index');

	}
	function edit_beli($id){
		$this->auth->restrict();
		/*$this->auth->cek_menu(2);*/
		$this->form_validation->set_rules('no_beli','no_beli','required');
		$this->form_validation->set_message('required','* Harus diisi');
		$this->form_validation->set_message('numeric','* Hanya boleh diisi angka');
		$this->form_validation->set_message('min_length[6]','* Minimal diisi 6 karakter');
		$this->form_validation->set_message('alpha_numeric','* Harus diisi kombinasi huruf dan angka');
		$this->form_validation->set_message('valid_emails','* Format email tidak valid');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run()==FALSE){
			$level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($level);
			$data['pembelian']=$this->Mpembelian->select($id);
			$data['detil']=$this->Mdpembelian->detil($id);
			$data['content']='admin/pembelian/detil_pembelian';
			$this->load->view('admin/template',$data);
		}else{
			$this->Mpembelian->update_beli($id);
			
			$kdstatus=$this->Mpembelian->getStatus($id);
				$this->session->set_userdata('id_beli', $kdstatus['id_beli']);
				$this->session->set_userdata('status_beli', $kdstatus['status_beli']);
				
			$id_beli = $this->session->userdata('id_beli');
			$status_beli = $this->session->userdata('status_beli');
			
			$detil_beli=$this->Mdpembelian->ambil_detil_pembelian($id);
			foreach($detil_beli as $items):
				if($status_beli == 2){
					$this->Mproduk->tambah_stok($items->id_produk, $items->jml_beli);
				}else{
					$kd_brg=$items->id_produk;
					$this->Mproduk->stok_awal($kd_brg);
				}
			endforeach;	
			
			$this->session->set_flashdata('success','Data pembelian berhasil diperbarui !');
			redirect('admin/pembelian/index');
		}

	}
}
?>