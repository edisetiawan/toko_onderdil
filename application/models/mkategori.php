<?php class Mkategori extends CI_Model{
	function getAll($limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT * FROM tbl_kategori 
		WHERE nama_kategori <> '' ORDER BY id_kategori DESC LIMIT ".$limit2;
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
		$this->db->order_by('tbl_kategori.id_kategori','asc');
		$result=$this->db->get('tbl_kategori');
		if ($result->num_rows() > 0 ){
			return $result->result_array();	
		}
		else{
			return array();	
		}
	}
	function tampil_kategori(){
		$this->db->order_by('nama_kategori','asc');
		$q= $this->db->get('tbl_kategori');
		return $q->result();
	}
	function pilih_kategori($id){
		$this->db->where('id_kategori',$id);
		$q=$this->db->get('tbl_kategori');
		return $q->result();
	}
	function insert(){
	
		$data =array(
			'nama_kategori'=>$this->input->post('nama_kategori'),
			);
		$this->db->insert('tbl_kategori',$data);
	}
	function select($id){
		return $this->db->get_where('tbl_kategori', array('id_kategori'=>$id))->row();
	}
	function update($id){
		$this->db->where('id_kategori',$id)->update('tbl_kategori',$_POST);
	}
	function delete($id){
		$this->db->delete('tbl_kategori', array('id_kategori'=>$id));
	}
	function tot_kategori(){
		$q=$this->db->query("SELECT * FROM tbl_kategori ORDER BY id_kategori ASC");
		return $q;
	}
	function cari_kategori($limit,$offset,$nama_kategori){
		$q=$this->db->query("SELECT * FROM tbl_kategori
			WHERE nama_kategori LIKE'%$nama_kategori%' 
			OR id_kategori LIKE'%$nama_kategori%'
			LIMIT $offset,$limit");
		return $q;
	}
}
?>