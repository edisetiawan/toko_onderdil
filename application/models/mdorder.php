<?php class Mdorder extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function insert($kode, $jum){
		$data = array(
			'id_order' => $this->session->userdata('id_order'),
			'id_produk' => $kode,
			'jml_order'=> $jum
		);
		$this->db->insert('tbl_detil_order',$data);
	}
	function getCode(){
		$data = array();
		$this->db->select_max('id_detil_order');
		
		$hasil = $this->db->get('tbl_detil_order');
			if($hasil->num_rows() > 0){
				return $hasil->row_array();
			}		
	}
	function select($id){
		$this->db->join('tbl_produk','tbl_produk.id_produk = tbl_detil_order.id_produk');
		$this->db->where('id_order',$id);
		$query = $this->db->get('tbl_detil_order');
		return  $query->result();
	}
	function detil_belanja(){
		$id_order = $this->session->userdata('id_order');
		$query = $this->db->query("
			SELECT tbl_order.id_order, tbl_order.id_biaya,
				tbl_produk.nama_produk, tbl_produk.image, tbl_produk.harga, tbl_produk.produk_sku,
				tbl_detil_order.jml_order,
				tbl_pembayaran.metode,
				tbl_biaya_kirim.biaya
			FROM tbl_detil_order 
			JOIN tbl_produk ON tbl_produk.id_produk = tbl_detil_order.id_produk
			JOIN tbl_order ON tbl_order.id_order = tbl_detil_order.id_order
			JOIN tbl_pembayaran ON tbl_pembayaran.id_order = tbl_order.id_order
			JOIN tbl_biaya_kirim ON tbl_biaya_kirim.id_biaya = tbl_order.id_biaya
			WHERE tbl_detil_order.id_order = $id_order
			
			ORDER BY nama_produk ASC
		");
		return $query->result();
	}
	function detil_order($id){
		$query=$this->db->query("SELECT * FROM tbl_detil_order 
		JOIN tbl_produk ON tbl_produk.id_produk = tbl_detil_order.id_produk
			JOIN tbl_order ON tbl_order.id_order = tbl_detil_order.id_order
			JOIN tbl_biaya_kirim ON tbl_biaya_kirim.id_biaya = tbl_order.id_biaya
		WHERE tbl_detil_order.id_order = $id");
		return $query->result();
	}
}
?>