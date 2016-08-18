<?php class Mkomentar extends CI_Model{
	function getAll($limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT tbl_komentar.nama_lengkap, tbl_komentar.email, tbl_komentar.tgl_komentar,		tbl_komentar.isi_komentar, tbl_komentar.id_komentar,
		tbl_balas_komen.isi_balasan, 
		tbl_posting.judul_posting
		FROM tbl_komentar
		JOIN tbl_balas_komen ON tbl_balas_komen.id_komentar = tbl_komentar.id_komentar
		JOIN tbl_posting ON tbl_posting.id_posting = tbl_komentar.id_posting
		WHERE tbl_komentar.nama_lengkap <> '' ORDER BY tbl_komentar.id_komentar DESC LIMIT ".$limit2;
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
		$this->db->join('tbl_komentar','tbl_komentar.id_komentar = tbl_balas_komen.id_komentar');
		return $this->db->get_where('tbl_balas_komen', array('tbl_balas_komen.id_komentar'=>$id))->row();
	}
	function update($id){
		$this->db->where('id_komentar',$id)->update('tbl_balas_komen',$_POST);
	}
	function hapus_komen($id){
		$this->db->where('id_komentar',$id)->delete('tbl_balas_komen');
		$this->db->where('id_komentar',$id)->delete('tbl_komentar');
	}
	

	function getCode(){
		$data = array();
		$this->db->order_by('id_komentar','desc');
		
		$hasil = $this->db->get('tbl_komentar',1);
			if($hasil->num_rows() > 0){
				return $hasil->row_array();
			}		
	}
	function tampil_komentar(){
		$idposting=$this->session->userdata('id_posting');
		$query = $this->db->query("
			SELECT * FROM tbl_komentar 
			WHERE tbl_komentar.id_posting = $idposting
			ORDER BY id_komentar DESC"
		);
		return $query->result();
	}
	function detil_posting(){
		$idposting=$this->session->userdata('id_posting');
		$query = $this->db->query("
			SELECT * FROM tbl_posting 
			WHERE tbl_posting.id_posting = $idposting
			ORDER BY id_posting DESC"
		);
		return $query->result();
	}
	function balas_komen($id){
		$query = $this->db->query("
			SELECT tbl_komentar.nama_lengkap AS nama_user, tbl_komentar.tgl_komentar, tbl_komentar.isi_komentar, tbl_komentar.email,tbl_balas_komen.isi_balasan, tbl_balas_komen.tgl_balas,tbl_balas_komen.id_user
			FROM tbl_balas_komen
			JOIN tbl_komentar ON tbl_komentar.id_komentar = tbl_balas_komen.id_komentar
			WHERE tbl_komentar.id_posting = '$id'
			AND tbl_komentar.nama_lengkap <> ''
			GROUP BY tbl_komentar.id_komentar
			ORDER BY tbl_komentar.id_komentar DESC"
		);
		return $query->result();
	}
	function balasan_komen(){
		$idposting=$this->session->userdata('id_posting');
		$idkomen=$this->session->userdata('id_komentar');
		
		$query= $this->db->query("SELECT tbl_komentar.nama_lengkap AS nama_user, tbl_komentar.email, tbl_komentar.tgl_komentar,		tbl_komentar.isi_komentar, tbl_komentar.id_komentar,tbl_balas_komen.id_user,
		tbl_balas_komen.isi_balasan, tbl_balas_komen.tgl_balas
		FROM tbl_komentar
		JOIN tbl_balas_komen ON tbl_balas_komen.id_komentar = tbl_komentar.id_komentar
		JOIN tbl_posting ON tbl_posting.id_posting = tbl_komentar.id_posting
		WHERE tbl_komentar.id_posting = $idposting
			GROUP BY tbl_komentar.id_komentar
		ORDER BY tbl_komentar.id_komentar DESC ");
		return $query->result();
	}
	function detil_komentar($id){
		$query = $this->db->query("	SELECT * FROM tbl_komentar 
			WHERE tbl_komentar.id_posting = $id	ORDER BY id_komentar DESC"
		);
		return $query->result();
	}
	function add_komentar(){
		$data=array(
			'id_posting'=> $this->input->post('id_posting'),
			'tgl_komentar'=> $this->input->post('tgl_komentar'),
			'isi_komentar'=> $this->input->post('isi_komentar'),
			'nama_lengkap'=>$this->input->post('nama_lengkap'),
			'email' => $this->input->post('email'),
		);
		$this->db->insert('tbl_komentar',$data);
	}
	function add_balas_komentar(){
		$data=array(
			'id_komentar'=>$this->session->userdata('id_komentar'),
			'tgl_balas'=>0,
			'isi_balasan'=>'',
			'id_user'=>0
		);
		$this->db->insert('tbl_balas_komen',$data);
	}
}
?>