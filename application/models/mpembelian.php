<?php class Mpembelian extends CI_Model{
	function getAll($limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT * FROM tbl_pembelian
		JOIN tbl_user ON tbl_user.id_user = tbl_pembelian.id_user
		JOIN tbl_suplier ON tbl_suplier.id_suplier = tbl_pembelian.id_suplier
		WHERE id_beli <> '' 
		
		ORDER BY no_beli DESC LIMIT ".$limit2;
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
		$this->db->order_by('id_beli','desc');
		
		$hasil = $this->db->get('tbl_pembelian');
			if($hasil->num_rows() > 0){
				return $hasil->row_array();
			}		
	}
	function getStatus($id){
		$data = array();
		$this->db->where('id_beli',$id);
		
		$hasil = $this->db->get('tbl_pembelian');
			if($hasil->num_rows() > 0){
				return $hasil->row_array();
			}		
	}
	function autoKode(){
		$query=$this->db->query("SELECT RIGHT(no_beli,7)AS no_beli
		FROM tbl_pembelian
		ORDER BY no_beli DESC LIMIT 1"); 
		return $query->result();
    }
	function insert(){
		$data=array('id_user'=>$this->session->userdata('id_user'),
					'no_beli'=>$this->input->post('no_beli'),
					'tgl_beli'=>$this->input->post('tgl_beli'),
					'status_beli'=> 1,
					'id_suplier'=>$this->input->post('id_suplier'),
					'total_beli'=>$this->input->post('total_beli')
		);
		$input=$this->db->insert('tbl_pembelian',$data);
		if($input){
			return true;
		}else{
			return false;
		}
	}
	function select($id){
		return $this->db->get_where('tbl_pembelian', array('tbl_pembelian.id_beli'=>$id))->row();
	}
	function update_beli($id){
		$status = $this->input->post('status_beli');
		if($status == 2){
			$tgl_terima = $this->input->post('tgl_diterima');
		}else{
			$tgl_terima = date('Y-m-d',strtotime('0000-00-00'));
		}
		$data=array(
			'no_beli'=>$this->input->post('no_beli'),
			'tgl_beli'=>$this->input->post('tgl_beli'),
			'tgl_diterima'=> $tgl_terima,
			'status_beli'=>$this->input->post('status_beli'),
			'total_beli'=>$this->input->post('total_beli'),
			'id_suplier'=>$this->input->post('id_suplier'),
			'id_user'=>$this->session->userdata('id_user')
		);
		$this->db->where('id_beli',$id);
		$this->db->update('tbl_pembelian',$data);
	}
}
?>