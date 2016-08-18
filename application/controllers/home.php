<?php class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		$this->load->model('Mposting');
		$this->load->model('Mgaleri');
		$this->load->model('Mkategori');
		$this->load->model('Mprofil');
		$this->load->model('Mproduk');
		$this->load->model('Mkomentar');
		$this->load->model('Mlokasi');
		$this->load->model('Mproduk');
	}
	function index(){
		$data['new_produk']=$this->Mproduk->produk_terbaru();
		$data['produk_sejenis']=$this->Mproduk->produk_sejenis();
		session_unset();
		$data['content']='user/content';
		$this->load->view('user/template',$data);
	}
	function posting(){
		$data['base_url'] = base_url().'home/posting/';
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
		$data['content']='user/data_posting';
		$this->load->view('user/template',$data);
	}
	function detil_posting($id){
		$data['detil']=$this->Mposting->selengkapnya($id);
		$data['komentar']=$this->Mkomentar->detil_komentar($id);
		$data['balas_komen']=$this->Mkomentar->balas_komen($id);
		$data['content']='user/detil_posting';
		$this->load->view('user/template',$data);
	}
	function simpan_komentar(){
		$idposting=$this->input->post('id_posting');
		$isi=$this->input->post('isi_komentar');
		if($isi==''){
			$data['flashdata']="ISI KOMENTAR TIDAK BOLEH KOSONG";
			$data['content']='user/detil_posting';
			$this->load->view('user/template',$data);
		} else {
			$this->Mkomentar->add_komentar();
			$id_komen = $this->Mkomentar->getCode(); 									
			$this->session->set_userdata('id_komentar', $id_komen['id_komentar']);
			$this->Mkomentar->add_balas_komentar();
		}
		redirect('home/tampil_komentar');
	}
	function tampil_komentar(){
		$kd_komen=$this->Mkomentar->getCode();
			$this->session->set_userdata('id_komentar',$kd_komen['id_komentar']);
			$this->session->set_userdata('id_posting',$kd_komen['id_posting']);
			
		$data['komentar']=$this->Mkomentar->tampil_komentar();
		$data['detil']=$this->Mkomentar->detil_posting();
		$data['balas_komen']=$this->Mkomentar->balasan_komen();
		$data['content']='user/detil_posting';
		$this->load->view('user/template',$data);
	}

	function perkategori($id){
		$data['kategori']=$this->Mkategori->tampil_kategori();
		$data['new_post']=$this->Mposting->posting_baru();
		$data['perkategori']=$this->Mposting->perkategori($id);
		
		$data['content']='user/perkategori';
		$this->load->view('user/template',$data);
	}
	function galeri(){
		$data['base_url'] = base_url().'home/galeri/';
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
		$data['content']='user/data_galeri';
		$this->load->view('user/template',$data);
	}
	function kontak(){
		$this->load->library('GMap');
		$this->gmap->GoogleMapAPI();
		$this->gmap->setMapType('hybird');
			
			$data['place']=$this->Mlokasi->tampil_peta();
				foreach ($data['place'] as $places):
				$this->gmap->addMarkerByCoords($places ['longitude'], 
												$places['latitude'], 
												$places['nama_lokasi'], 
												$places['keterangan'], 
												$tooltip = '', 
												$icon_filename ='', 
												$icon_shadow_filename ='1');
												
				endforeach;
			
			$data['headerjs']= $this->gmap->getHeaderJS();
			$data['headermap']= $this->gmap->getMapJS();
			$data['onload']= $this->gmap->printOnload();
			$data['map']= $this->gmap->printMap();
			
			$data['sidebar']= $this->gmap->printSidebar();		

		$data['content']='user/kontak';
		$this->load->view('user/template',$data);
	}
	function profil($id){
		$data['profil']=$this->Mprofil->profil_id($id);
		$data['content']='user/profil';
		$this->load->view('user/template',$data);
	}
	function cari_posting(){
		$this->form_validation->set_rules('judul_posting','judul_posting','required');
		$this->form_validation->set_message('required','Anda belum mengisi data');
		$this->form_validation->set_error_delimiters('', '</br>');
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error','Anda belum memasukkan kata kunci pencarian !');
			redirect('home/index');
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
				$data['judul_posting']=$this->session->userdata('cari_posting');
			}
			
			$data['judul_posting'] = $this->Mposting->cari_posting($batas,$offset,$data['judul_posting']);
			$tot_hal = $this->Mposting->tot_posting('tbl_posting','judul_posting',$data['judul_posting']);
			
			$config['base_url']=base_url().'home/cari_posting/';
			$config['per_page']=$batas;
			$config['total_rows']=$tot_hal->num_rows();
			$config['uri_segment']=4;
			$config['first_link']='First';
			$config['last_link']='Last';
			$config['next_link']='<';
			$config['next_link']='>';
			$this->pagination->initialize($config);
			$data["pagination"]=$this->pagination->create_links();
			$data['content']='user/cari_posting';
			$this->load->view('user/template',$data);
		}
	}
}
?>