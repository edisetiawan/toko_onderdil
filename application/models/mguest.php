<?php class Mguest extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function getCode(){
		$data = array();
		$this->db->select_max('id_guest');
		
		$hasil = $this->db->get('tbl_guestbook');
			if($hasil->num_rows() > 0){
				return $hasil->row_array();
			}		
	}
	function tampil_data(){
		$data_guest=$this->db->query("select * from tbl_guestbook 
		join tbl_balas_guest on tbl_balas_guest.id_guest = tbl_guestbook.id_guest
		group by tbl_guestbook.id_guest
		order by tbl_guestbook.id_guest desc");
		return $data_guest->result();
	}
	function getAll($limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT tbl_guestbook.nama_lengkap, tbl_guestbook.email, tbl_guestbook.tgl_guest, tbl_guestbook.pesan, tbl_balas_guest.balasan, tbl_guestbook.id_guest
		FROM tbl_guestbook 
		JOIN tbl_balas_guest ON tbl_balas_guest.id_guest = tbl_guestbook.id_guest

		WHERE tbl_guestbook.nama_lengkap <> '' ORDER BY tbl_guestbook.id_guest DESC LIMIT ".$limit2;
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
		$data = array(
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'email' => $this->input->post('email'),
			'tgl_guest' => $this->input->post('tgl_guest'),
			'pesan' => $this->input->post('pesan'),
		);
			$this->db->insert('tbl_guestbook', $data);
	}
	function insert_balasan(){
		$data = array(
			'id_guest'	=> $this->session->userdata('id_guest'),
			
		);
		$this->db->insert('tbl_balas_guest',$data);
	}
	function select($id){
		$this->db->join('tbl_guestbook','tbl_guestbook.id_guest = tbl_balas_guest.id_guest');
		return $this->db->get_where('tbl_balas_guest', array('tbl_balas_guest.id_guest'=>$id))->row();
	}
	function update($id){
		$this->db->where('id_guest',$id)->update('tbl_balas_guest',$_POST);
	}
	function balasan(){
		$data_guest=$this->db->query("SELECT tbl_balas_guest.tgl_balas, tbl_balas_guest.balasan, 
		tbl_user.nama_lengkap
			FROM tbl_balas_guest 
			JOIN tbl_user ON tbl_user.id_user = tbl_balas_guest.id_user
			JOIN tbl_guestbook ON tbl_guestbook.id_guest = tbl_balas_guest.id_guest
			WHERE balasan <> ' '
			ORDER BY tbl_balas_guest.id_balas DESC");
		return $data_guest->result();
	}
	function hapus_guest($id){
		$this->db->where('id_guest',$id);
		$this->db->delete('tbl_guestbook');
	}
	
	function tot_guest(){
		$q=$this->db->query("SELECT * FROM tbl_guestbook ORDER BY nama_lengkap ASC");
		return $q;
	}
	function cari_guest($limit,$offset,$nama_lengkap){
		$q=$this->db->query("SELECT * FROM tbl_guestbook
			JOIN tbl_balas_guest ON tbl_balas_guest.id_guest = tbl_guestbook.id_guest
			WHERE nama_lengkap LIKE'%$nama_lengkap%' 
			LIMIT $offset,$limit");
		return $q;
	}
}
?>