<?php class Msuplier extends CI_Model{
	function getAll($limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT * FROM tbl_suplier WHERE nama_suplier <> '' ORDER BY nama_suplier ASC LIMIT ".$limit2;
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

	function insert(){
		$data =array(
			'nama_suplier'=>$this->input->post('nama_suplier'),
			'no_telp'=>$this->input->post('no_telp'),
			'alamat'=>$this->input->post('alamat'),
			);
		$this->db->insert('tbl_suplier',$data);
	}
	function select($id){
		return $this->db->get_where('tbl_suplier', array('id_suplier'=>$id))->row();
	}
	function update($id){
		$this->db->where('id_suplier',$id)->update('tbl_suplier',$_POST);
	}
	function delete($id){
		$this->db->delete('tbl_suplier', array('id_suplier'=>$id));
	}
	function tot_suplier(){
		$q=$this->db->query("SELECT * FROM tbl_suplier ORDER BY id_suplier ASC");
		return $q;
	}
	function cari_suplier($limit,$offset,$nama_suplier){
		$q=$this->db->query("SELECT * FROM tbl_suplier
			WHERE nama_suplier LIKE'%$nama_suplier%' 
			OR no_telp LIKE'%$nama_suplier%'
			LIMIT $offset,$limit");
		return $q;
	}

}
?>