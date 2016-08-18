<?php class Mmember extends CI_Model{
	function countAll() {
	$query = $this->db->get('tbl_member');
		return $query->num_rows();
	}
	function tampil_member($limit=null, $offset=null, $q=null){
		$this->db->select('tbl_member.*,tbl_user.id_user, tbl_level.level');
		$this->db->join('tbl_user','tbl_user.id_user = tbl_member.id_user');
		$this->db->join('tbl_level','tbl_level.id_level = tbl_user.id_level');
		if($q!=null){
			$this->db->like('tbl_member.id_user',$q);
		}
		$this->db->limit($limit, $offset);
		$this->db->order_by('tbl_member.nama_lengkap', 'asc');
		$query = $this->db->get('tbl_member');
		
		if ($query->num_rows() > 0) {
			 return $query->result_array();
		}
	}
	function getCode(){
		$data = array();
		$this->db->order_by('id_member','desc');
		
		$hasil = $this->db->get('tbl_member',1);
			if($hasil->num_rows() > 0){
				return $hasil->row_array();
			}		
	}
	function getEmail(){
		$data = array();
		$id_member=$this->session->userdata('id_member');
		$this->db->where('id_member',$id_member);
		$hasil = $this->db->get('tbl_member');
		if($hasil->num_rows() > 0){
			return $hasil->row_array(); //return row sebagai associative array
		}
	}
	function insert(){
		$data = array(
			'nama_member' => $this->input->post('nama_lengkap'),
			'alamat' => $this->input->post('alamat'),
			'tgl_registrasi' => date('Y-m-d'),
			'no_telp' => $this->input->post('no_telp'),
			'email' => $this->input->post('email')
		);
		$this->db->insert('tbl_member', $data);
	}
	function email_ada($email){
		$this->db->join('tbl_user','tbl_user.email = tbl_member.email');
        $query = $this->db->get_where('tbl_member', 
		array('tbl_member.email' => $email,
				'tbl_user.email' => $email));
        if ($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
	}	
	function insert_user(){
		$data = array(
			'id_member'	=> $this->session->userdata('id_member'),
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'id_level' => $this->input->post('id_level'),	
			'email'	   => $this->input->post('email'),		
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
		);
		$this->db->insert('tbl_user',$data);
	}
	function lupa_password(){
		$email=$this->input->post('email');
		
		$data = array(
			'password' => md5($this->input->post('password'))
		);
		$this->db->where('email',$email);
		$this->db->update('tbl_user',$data);
	}
	function ganti_password(){
		$id_user=$this->session->userdata('id_user');
		
		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
		);
		$this->db->where('id_user',$id_user);
		$this->db->update('tbl_user',$data);
	}
	function select_id($id){
		return $this->db->get_where('tbl_member', array('id_member'=>$id))->row();
	}
	function edit_akun($id){
		$id_member=$this->session->userdata('id_member');

		$data = array(
			'nama_member' => $this->input->post('nama_member'),
			'email' => $this->input->post('email'),			
			'no_telp' => $this->input->post('no_telp'),
			'alamat' => $this->input->post('alamat')
		);
		$this->db->where('id_member',$id_member);
		$this->db->update('tbl_member',$data);
	}
	function delete_member($id){
		$this->db->delete('tbl_member', array('id_member'=>$id));
	}
	function cari_member($limit,$offset,$nama_lengkap){
		$q=$this->db->query("SELECT * FROM tbl_member 
			WHERE nama_lengkap LIKE'%$nama_lengkap%'
			OR nama_band LIKE'%$nama_lengkap%'
			OR email LIKE'%$nama_lengkap%'
			LIMIT $offset,$limit");
		return $q;
	}
}
?>