<?php class Mprofil extends CI_Model{
	function getAll($limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT * FROM tbl_profil
		JOIN tbl_user ON tbl_user.id_user = tbl_profil.id_user
		WHERE judul_profil <> '' 
		GROUP BY tbl_profil.id_profil
		ORDER BY tbl_profil.id_profil DESC LIMIT ".$limit2;
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
	function profil_id($id){
		$this->db->join('tbl_user','tbl_user.id_user = tbl_profil.id_user');
		$this->db->where('id_profil',$id);
		$query=$this->db->get('tbl_profil');
		return $query->result();
	}
	function getKontak(){
		$this->db->join('tbl_user','tbl_user.id_user = tbl_profil.id_user');
		$this->db->like('judul_profil','Kontak Kami');
		$query = $this->db->get('tbl_profil');
		return $query->result();
	}
	function tampil_peta(){
		$this->db->select('*');
		$this->db->like('judul_profil','Kontak Kami');
		$query=$this->db->get('tbl_profil');
		if($query->num_rows() > 0){
			return $query->result_array();
		}
	}
	function insert($params = array()){
	
		if (empty($params)) {
				$data = array(
				'judul_profil' => $this->input->post('judul_profil'),
				'permalink' => url_title($this->input->post('judul_profil')),
				'tgl_posting' => $this->input->post('tgl_posting'),
				/*'latitude'	=> $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),*/
				'isi_profil' => $this->input->post('isi_profil'),
				'id_user' => $this->input->post('id_user'),
			);
			$this->db->insert('tbl_profil', $data);
		} else {
			$this->db->insert('tbl_profil', $params);
		}
	}
	function findById($id) {
		$this->db->select('tbl_profil.*');
		$this->db->where('id_profil', $id);
		$query = $this->db->get('tbl_profil', 1);
		
		if ($query->num_rows() == 1) {
			return $query->row_array();
		}
	 }
	function update($id, $data) {
		if (empty($data)) {
			$data = array(
				'judul_profil' => $this->input->post('judul_profil'),
				'permalink' => url_title($this->input->post('judul_profil')),
				'tgl_posting' => $this->input->post('tgl_posting'),
				/*'latitude'	=> $this->input->post('latitude'),
				'longitude' => $this->input->post('longitude'),*/
				'isi_profil' => $this->input->post('isi_profil'),
				'id_user' => $this->input->post('id_user'),
			);
			$this->db->where('id_makanan', $id);
			$this->db->update('tbl_makanan', $data);
		} else {
			$this->db->where('id_profil', $id);
			$this->db->update('tbl_profil', $data);
		}
	}
	function delete($id){
		$this->db->where('id_profil', $id);
		$this->db->delete('tbl_profil');
	}

	function cari_profil($limit,$offset,$judul_profil){
		$q=$this->db->query("SELECT * FROM tbl_profil
			JOIN tbl_user ON tbl_user.id_user = tbl_profil.id_user
			WHERE judul_profil LIKE'%$judul_profil%'
			OR isi_profil LIKE'%$judul_profil%'
			LIMIT $offset,$limit");
		return $q;
	}
	function tot_profil(){
		$q=$this->db->query("SELECT * FROM tbl_profil ORDER BY judul_profil ASC");
		return $q;
	}
}
?>