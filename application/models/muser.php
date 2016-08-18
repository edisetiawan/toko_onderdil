<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muser extends CI_Model{
	function cek_user_login($username, $password){
	
		$this->db->select('*');
		$this->db->where('username', $username);
		/*$this->db->where('password=MD5("'.$password.'")','',false);*/
		$this->db->where('password', $password);
		$this->db->where('status',1);
		$query = $this->db->get('tbl_user',1);
		
		if ($query->num_rows()==1){
			return $query->row_array();
		}
	}

	public function get_menu_for_level($id_level){
		$this->db->from('tbl_menu');
		$this->db->where_not_in('menu_nama','Peta Lokasi');
		$this->db->like('menu_allowed','+'.$id_level.'+');
		$this->db->order_by('menu_nama','asc');
		$result = $this->db->get();
		return $result;
	}
	function get_array_menu($id){
		$this->db->select('menu_allowed');
		$this->db->from('tbl_menu');
		$this->db->where('id_menu',$id);
		$data = $this->db->get();
		if($data->num_rows() > 0){
			$row = $data->row();
			$level = $row->menu_allowed;
			$arr = explode('+',$level);
			return $arr;
		}else{
			die();
		}
	}
	function getLevel(){
		$q=$this->db->get('tbl_level');
		return $q->result();
	}
	function tot_pengguna(){
		$q=$this->db->query("SELECT * FROM tbl_user ORDER BY nama_lengkap ASC");
		return $q;
	}
	function countAll() {
	$query = $this->db->get('tbl_user');
		return $query->num_rows();
	}
	function email_ada($email){
		$query = $this->db->get_where('tbl_user', 
			array('tbl_user.email' => $email)
		);
        if ($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
	}
	function cek_no_telp($no_telp){
        $query = $this->db->get_where('tbl_user', 
			array('tbl_user.no_telp' => $no_telp)
		);
        if ($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
	}
	function cek_username($username){
        $query = $this->db->get_where('tbl_user', 
			array('tbl_user.username' => $username)
		);
        if ($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
	}
	function cek_password($password){
        $query = $this->db->get_where('tbl_user', 
			array('tbl_user.password' => $password)
		);
        if ($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
	}
	function password_lama($password_lama){
        $query = $this->db->get_where('tbl_user', 
			array('tbl_user.password' => $password_lama)
		);
        if ($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
	}	

	function getCode(){
		$data = array();
		$this->db->order_by('id_user','desc');
		
		$hasil = $this->db->get('tbl_user',1);
			if($hasil->num_rows() > 0){
				return $hasil->row_array();
			}		
	}
	function getAll( $limit1='',$limit2=''){
		$data = array();
		if($this->session->userdata('id_level') == 1){
			$sql = "SELECT * FROM tbl_user 
			JOIN tbl_level ON tbl_level.id_level = tbl_user.id_level
			WHERE nama_lengkap <> '' 
			ORDER BY id_user DESC LIMIT ".$limit2;
			if($limit1){
				$sql .= ",".$limit1;
			}
			$hasil = $this->db->query($sql);
			if($hasil->num_rows() > 0){
				$data = $hasil->result();
			}
			$hasil->free_result();
			return $data;

		}else{
			$sql = "SELECT * FROM tbl_user 
			JOIN tbl_level ON tbl_level.id_level = tbl_user.id_level
			WHERE nama_lengkap <> '' 
			AND tbl_user.id_level NOT IN ('1')
			ORDER BY id_user DESC LIMIT ".$limit2;
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
	}
	function insert(){
		$data = array(
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'id_level' => $this->input->post('id_level'),			
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'email' => $this->input->post('email'),
			'status' => $this->input->post('status'),
			'id_member' => $this->session->userdata('id_member')
		);
		$input = $this->db->insert('tbl_user', $data);
		if($input){
			return true;
		}else{
			return false;
		}
	}
	function select_id($id){
		return $this->db->get_where('tbl_user', array('id_user'=>$id))->row();
	}
	function update($id){
		$data = array(
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'id_level' => $this->input->post('id_level'),			
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'no_telp' => $this->input->post('no_telp'),
			'status' => $this->input->post('status'),
		);
		$this->db->where('id_user',$id)->update('tbl_user',$data);
	}
	function delete($id){
		$this->db->delete('tbl_user', array('id_user'=>$id));
	}
	function cari_pengguna($limit,$offset,$nama_lengkap){
		$q=$this->db->query("SELECT * FROM tbl_user 
			JOIN tbl_level ON tbl_level.id_level = tbl_user.id_level
			WHERE nama_lengkap LIKE'%$nama_lengkap%'
			OR username LIKE'%$nama_lengkap%'
			OR password LIKE'%$nama_lengkap%'
			LIMIT $offset,$limit");
		return $q;
	}
	
	function ganti_password($id){
		$id_user=$this->session->userdata('id_user');
		$data=array(			
			'username'=>$this->input->post('username'),
			'password'=>$this->input->post('password')
		);
		$this->db->where('id_user',$id_user);
		$this->db->update('tbl_user',$data);
	}

}
?>