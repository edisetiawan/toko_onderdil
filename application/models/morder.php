<?php class Morder extends CI_Model{
	function getAll($limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT * FROM tbl_order
		JOIN tbl_member ON tbl_member.id_member = tbl_order.id_member
		JOIN tbl_pembayaran ON tbl_pembayaran.id_order = tbl_order.id_order
		WHERE no_order <> '' 
		
		ORDER BY tbl_order.no_order DESC LIMIT ".$limit2;
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
	function getMember($limit1='',$limit2=''){
		$data = array();
		$id_member = $this->session->userdata('id_member');
		$sql = "SELECT DATE_FORMAT(tbl_order.tgl_order,'%d-%m-%Y')AS tgl_order, tbl_order.no_order, tbl_order.id_order, tbl_order.status_order, tbl_pembayaran.tagihan, tbl_pembayaran.status_bayar, tbl_pembayaran.id_bayar, tbl_pembayaran.metode
		FROM tbl_order
		JOIN tbl_member ON tbl_member.id_member = tbl_order.id_member
		JOIN tbl_pembayaran ON tbl_pembayaran.id_order = tbl_order.id_order
		WHERE no_order <> '' 
		AND tbl_order.id_member = $id_member
		
		ORDER BY tbl_order.no_order DESC LIMIT ".$limit2;
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

	function getCode(){
		$data = array();
		$this->db->order_by('id_order','desc');
		
		$hasil = $this->db->get('tbl_order');
			if($hasil->num_rows() > 0){
				return $hasil->row_array();
			}		
	}
	function autoKode(){
		$query=$this->db->query("SELECT RIGHT(no_order,6)AS no_order
		FROM tbl_order
		ORDER BY no_order DESC LIMIT 1"); 
		return $query->result();
    }
	function new_order(){
		$q=$this->db->query("SELECT COUNT(tgl_psn) AS total FROM pesan WHERE tgl_psn=CURDATE() AND status = 'sedang diproses' ");
		return $q->result();
	}
	function insert(){
		$data=array('id_member'=>$this->session->userdata('id_member'),
					'no_order'=>$this->input->post('no_order'),
					'id_biaya'=>$this->input->post('kode_biaya'),
					'tgl_order'=>date('Y-m-d'),
					'status_order'=> 1,
					'alamat_kirim'=>$this->input->post('alamat_kirim')
		);
		$input=$this->db->insert('tbl_order',$data);
		if($input){
			return true;
		}else{
			return false;
		}
	}
	function select($id){
		$this->db->join('tbl_member','tbl_member.id_member = tbl_order.id_member');
		$this->db->join('tbl_biaya_kirim','tbl_biaya_kirim.id_biaya = tbl_order.id_biaya');
		$this->db->join('tbl_pembayaran','tbl_pembayaran.id_order = tbl_order.id_order');
		return $this->db->get_where('tbl_order', array('tbl_order.id_order'=>$id))->row();
	}
	function update_order($id){
		$data=array(
			'no_order'=>$this->input->post('no_order'),
			'tgl_order'=>$this->input->post('tgl_order'),
			'status_order'=>$this->input->post('status_order'),
			'id_member' =>$this->input->post('id_member'),
			'id_biaya'=>$this->input->post('id_biaya'),
			'alamat_kirim'=>$this->input->post('alamat_kirim')
			);
		$this->db->where('id_order',$id)->update('tbl_order',$data);
	}
	function delete($id){
		$this->db->delete('tbl_order',array('id_order'=>$id));
		$this->db->delete('tbl_detil_order',array('id_order'=>$id) );
	}
	function findList() { 
		$query = $this->db->get($this->table); 
		$data = array(); 
		if ($query->num_rows() > 0) { 
			foreach ($query->result_array() as $row) { 
				$data[$row['id_order']] = $row['tbl_order']; 
			}
		} 
		return $data; 
	}
	function detil_order($id){
		$query=$this->db->query("SELECT DATE_FORMAT(tbl_order.tgl_order,'%d-%m-%Y')AS tgl_order, 
		tbl_order.no_order, tbl_order.id_order, tbl_order.status_order, tbl_order.alamat_kirim,
		 tbl_pembayaran.tagihan, tbl_pembayaran.status_bayar, tbl_pembayaran.id_bayar, tbl_pembayaran.metode, 
		 tbl_member.nama_member, tbl_member.no_telp
		FROM tbl_order
		JOIN tbl_member on tbl_member.id_member = tbl_order.id_member 
		JOIN tbl_pembayaran ON tbl_pembayaran.id_order = tbl_order.id_order
		WHERE tbl_order.id_order = $id");
		return $query->result();
	}
}
?>