<?php class Mbiaya_kirim extends CI_Model{
	var $table='tbl_biaya_kirim';
	function construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function get_kota(){
		$query = $this->db->query("SELECT * FROM tbl_biaya_kirim ORDER BY nama_kota ASC");
		return $query->result();	
	}
	function getAll($limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT * FROM tbl_biaya_kirim WHERE nama_kota <> '' ORDER BY nama_kota ASC LIMIT ".$limit2;
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
			'nama_kota'=>$this->input->post('nama_kota'),
			'biaya'=>$this->input->post('biaya'),
			);
		$this->db->insert('tbl_biaya_kirim',$data);
	}
	function biaya_kirim(){
		$id_kota=$this->session->userdata('sesi_kotakirim');
		$data = array();
		$this->db->where('id_biaya',$id_kota);
		
		$hasil = $this->db->get('tbl_biaya_kirim');
			if($hasil->num_rows() > 0){
				return $hasil->row_array();
			}		
	}
	function select($id){
		return $this->db->get_where('tbl_biaya_kirim', array('id_biaya'=>$id))->row();
	}
	function update($id){
		$this->db->where('id_biaya',$id)->update('tbl_biaya_kirim',$_POST);
	}
	function delete($id){
		$this->db->delete('tbl_biaya_kirim', array('id_biaya'=>$id));
	}
	function tot_kota(){
		$q=$this->db->query("SELECT * FROM tbl_biaya_kirim ORDER BY id_biaya ASC");
		return $q;
	}
	function cari_kota($limit,$offset,$nama_kota){
		$q=$this->db->query("SELECT * FROM tbl_biaya_kirim
			WHERE nama_kota LIKE'%$nama_kota%' 
			OR id_biaya LIKE'%$nama_kota%'
			LIMIT $offset,$limit");
		return $q;
	}

}
?>