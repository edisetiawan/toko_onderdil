<?php class Mgaleri extends CI_Model {
	function getAll($limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT * FROM tbl_galeri
		JOIN tbl_user ON tbl_user.id_user = tbl_galeri.id_user
		WHERE judul_galeri <> '' 
		
		ORDER BY tbl_galeri.id_galeri DESC LIMIT ".$limit2;
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
	function insert($params = array()){
	
		if (empty($params)) {
				$data = array(
				'judul_galeri' => $this->input->post('judul_galeri'),
				'tgl_posting' => $this->input->post('tgl_posting'),
				'permalink' => url_title($this->input->post('judul_galeri')),
				'id_user' => $this->input->post('id_user'),
				'keterangan' => $this->input->post('keterangan')
			);
			$this->db->insert('tbl_galeri', $data);
		} else {
			$this->db->insert('tbl_galeri', $params);
		}
	}
	function findById($id) {
		$this->db->select('tbl_galeri.*');
		$this->db->where('id_galeri', $id);
		$query = $this->db->get('tbl_galeri', 1);
		
		if ($query->num_rows() == 1) {
			return $query->row_array();
		}
	 }
	function update($id, $data) {
		if (empty($data)) {
			$data = array(
				'judul_galeri' => $this->input->post('judul_galeri'),
				'tgl_posting' => $this->input->post('tgl_posting'),
				'permalink' => url_title($this->input->post('judul_galeri')),
				'id_user' => $this->input->post('id_user'),
				'keterangan' => $this->input->post('keterangan')
			);
			$this->db->where('id_galeri', $id);
			$this->db->update('tbl_galeri', $data);
		} else {
			$this->db->where('id_galeri', $id);
			$this->db->update('tbl_galeri', $data);
		}
	}
	function delete($id){
		$this->db->where('id_galeri', $id);
		$this->db->delete('tbl_galeri');
	}
}
?>