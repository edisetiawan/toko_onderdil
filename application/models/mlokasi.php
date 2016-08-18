<?php class Mlokasi extends CI_Model{
	function tampil_peta(){
		$this->db->select('*');
		$query=$this->db->get('tbl_lokasi');
		if($query->num_rows() > 0){
			return $query->result_array();
		}
	}
	function getAll( $limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT * FROM tbl_lokasi WHERE nama_lokasi <> '' ORDER BY nama_lokasi ASC LIMIT ".$limit2;
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
	function select($id){
		return $this->db->get_where('tbl_lokasi', array('id_lokasi'=>$id))->row();
	}	
	function insert(){
	
		$data =array(
			'nama_lokasi'=>$this->input->post('nama_lokasi'),
			'latitude'=>$this->input->post('latitude'),
			'longitude'=>$this->input->post('longitude'),
			'keterangan'=>$this->input->post('keterangan'),
			'id_user'=>$this->input->post('id_user')
			);
			
		$this->db->insert('tbl_lokasi',$data);
	}	
	
	function update($id){
		$this->db->where('id_lokasi',$id)->update('tbl_lokasi',$_POST);
	}
	function delete($id){
		$this->db->where('id_lokasi', $id);
		$this->db->delete('tbl_lokasi');
	}
}
?>