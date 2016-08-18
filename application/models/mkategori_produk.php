<?php class Mkategori_produk extends CI_Model{
	function getAll($limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT * FROM tbl_kategori_produk 
		WHERE nama_kategori <> '' ORDER BY id_kategori_produk DESC LIMIT ".$limit2;
		if($limit1){
			$sql .= ",".$limit1;
		}
		$hasil = $this->db->query($sql);
		if($hasil->num_rows() > 0){
			$data = $hasil->result();
		}
		$hasil->free_result();
		return $data;
	}
	function getkategori(){
		$result=$this->db->query("SELECT * FROM tbl_kategori_produk ORDER BY nama_kategori ASC");
		if ($result->num_rows() > 0 ){
			return $result->result_array();	
		}
		else{
			return array();	
		}
	}
	function pilih_kategori($id){
		$this->db->where('id_kategori_produk',$id);
		$q=$this->db->get('tbl_kategori_produk');
		return $q->result();
	}
	function insert(){
	
		$data =array(
			'nama_kategori'=>$this->input->post('nama_kategori'),
			);
		$this->db->insert('tbl_kategori_produk',$data);
	}
	function select($id){
		return $this->db->get_where('tbl_kategori_produk', array('id_kategori_produk'=>$id))->row();
	}
	function update($id){
		$this->db->where('id_kategori_produk',$id)->update('tbl_kategori_produk',$_POST);
	}
	function delete($id){
		$this->db->delete('tbl_kategori_produk', array('id_kategori_produk'=>$id));
	}
	function tot_kategori_produk(){
		$q=$this->db->query("SELECT * FROM tbl_kategori_produk ORDER BY id_kategori_produk ASC");
		return $q;
	}
	function cari_kategori_produk($limit,$offset,$nama_kategori){
		$q=$this->db->query("SELECT * FROM tbl_kategori_produk
			WHERE nama_kategori LIKE'%$nama_kategori%' 
			OR id_kategori_produk LIKE'%$nama_kategori%'
			LIMIT $offset,$limit");
		return $q;
	}
}
?>