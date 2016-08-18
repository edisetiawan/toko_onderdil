<?php class Mposting extends CI_Model{
	function getAll($limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT * FROM tbl_posting
		JOIN tbl_user ON tbl_user.id_user = tbl_posting.id_user
		WHERE judul_posting <> '' 
		GROUP BY id_posting
		ORDER BY id_posting DESC LIMIT ".$limit2;
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
	function selengkapnya($id){
		$this->db->join('tbl_kategori','tbl_kategori.id_kategori = tbl_posting.id_kategori');
		$this->db->join('tbl_user','tbl_user.id_user = tbl_posting.id_user');
		$this->db->where('id_posting',$id);
		$query=$this->db->get('tbl_posting');
		return $query->result();
	}
	function perkategori($id){
		$this->db->join('tbl_kategori','tbl_kategori.id_kategori = tbl_posting.id_kategori');
		$this->db->join('tbl_user','tbl_user.id_user = tbl_posting.id_user');
		$this->db->where('tbl_posting.id_kategori',$id);
		$query=$this->db->get('tbl_posting');
		return $query->result();
	}
	function posting_baru(){
		$this->db->join('tbl_user','tbl_user.id_user = tbl_posting.id_user');
		$this->db->order_by('id_posting','desc');
		$query = $this->db->get('tbl_posting',4);
		return $query->result();
	}
	function insert($params = array()){
	
		if (empty($params)) {
				$data = array(
				'judul_posting' => $this->input->post('judul_posting'),
				'tgl_posting' => $this->input->post('tgl_posting'),
				'permalink' => url_title($this->input->post('judul_posting')),
				'isi_posting' => $this->input->post('isi_posting'),
				'id_kategori' => $this->input->post('id_kategori'),
				'id_user' => $this->input->post('id_user')
			);
			$this->db->insert('tbl_posting', $data);
		} else {
			$this->db->insert('tbl_posting', $params);
		}
	}
	function findById($id) {
		$this->db->select('tbl_posting.*');
		$this->db->where('id_posting', $id);
		$query = $this->db->get('tbl_posting', 1);
		
		if ($query->num_rows() == 1) {
			return $query->row_array();
		}
	 }
	function update($id, $data) {
		if (empty($data)) {
			$data = array(
				'judul_posting' => $this->input->post('judul_posting'),
				'tgl_posting' => $this->input->post('tgl_posting'),
				'permalink' => url_title($this->input->post('judul_posting')),
				'isi_posting' => $this->input->post('isi_posting'),
				'id_kategori' => $this->input->post('id_kategori'),
				'id_user' => $this->input->post('id_user')
			);
			$this->db->where('id_posting', $id);
			$this->db->update('tbl_posting', $data);
		} else {
			$this->db->where('id_posting', $id);
			$this->db->update('tbl_posting', $data);
		}
	}
	function delete($id){
		$this->db->where('id_posting', $id);
		$this->db->delete('tbl_posting');
	}
	function cari_posting($limit,$offset,$judul_posting){
		$q=$this->db->query("SELECT * FROM tbl_posting
			JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_posting.id_kategori
			JOIN tbl_user ON tbl_user.id_user = tbl_posting.id_user

			WHERE judul_posting LIKE'%$judul_posting%'
			OR nama_kategori LIKE'%$judul_posting%'

			LIMIT $offset,$limit");
		return $q;
	}
	function tot_posting(){
		$q=$this->db->query("SELECT * FROM tbl_posting 
		JOIN tbl_user ON tbl_user.id_user = tbl_posting.id_user
			JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_posting.id_kategori
		ORDER BY judul_posting ASC");
		return $q;
	}
}
?>