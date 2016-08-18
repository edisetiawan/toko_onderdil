<?php class Produk extends CI_Controller{
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

		$data['base_url'] = base_url().'produk/index/';
		$data['total_rows'] = $this->db->count_all('tbl_produk');
		$data['per_page'] = 5;
		$data['uri_segment'] = 3;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		$this->pagination->initialize($data);
		$data['produk']=$this->Mproduk->getAll($data['per_page'],$this->uri->segment(3,0));
		$data['content']='user/data_produk';
		$this->load->view('user/template',$data);
	}
	function perkategori($id){
		$sql = $this->db->query("select count(id_produk)as jml from tbl_produk where id_kategori_produk = $id ");
		$data['base_url'] = base_url().'produk/perkategori/';
		$data['total_rows'] = $sql;
		$data['per_page'] = 10;
		$data['uri_segment'] = 4;
		$data['num_links']= 3;
		$data['next_link']='<';
		$data['next_link']='>';
		$data['cur_tag_open'] = '<li class="active"><a href="">';
		$data['num_tag_open'] = '<li>';
		$this->pagination->initialize($data);
		$data['produk']=$this->Mproduk->perkategori($id,$data['per_page'],$this->uri->segment(4,0));
		$data['content']='user/perkategori_produk';
		$this->load->view('user/template',$data);
	}
}
?>