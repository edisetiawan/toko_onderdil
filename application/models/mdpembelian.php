<?php class Mdpembelian extends CI_Model{
	function insert($kode, $jum, $harga){
		$data = array(
			'id_beli' => $this->session->userdata('id_beli'),
			'id_produk' => $kode,
			'jml_beli'=> $jum,
			'harga_beli'=> $harga
		);
		$this->db->insert('tbl_detil_pembelian',$data);
	}
	function detil($id){
		$query = $this->db->query("SELECT * FROM tbl_detil_pembelian 
			JOIN tbl_produk ON tbl_produk.id_produk = tbl_detil_pembelian.id_produk
			WHERE id_beli = $id"
		);
		return $query->result();
	}
	function ambil_detil_pembelian($id){
		$this->db->where('id_beli',$id);
		
		$hasil = $this->db->get('tbl_detil_pembelian');
			if($hasil->num_rows() > 0){
				return $hasil->result();
			}		
	}
	function tambah_detil(){
		$data=array(
			'id_beli'=>$this->input->post('id_beli'),
			'id_produk'=>$this->input->post('id_produk'),
			'jml_beli'=> $this->input->post('jml_beli'),
			'harga_beli'=> $this->session->userdata('harga_beli'),
		);
		$this->db->insert('tbl_detil_pembelian',$data);
	}
	function select_detil($id){
		$this->db->join('tbl_pembelian','tbl_pembelian.id_beli = tbl_Detil_pembelian.id_beli');
		return $this->db->get_where('tbl_detil_pembelian', array('tbl_detil_pembelian.id_detil_beli'=>$id))->row();
	}
	function update_detil($id){
		$data=array(
			'id_beli'=>$this->input->post('id_beli'),
			'id_produk'=>$this->input->post('id_produk'),
			'jml_beli'=> $this->input->post('jml_beli'),
			'harga_beli'=> $this->session->userdata('harga_beli'),
		);
		$this->db->where('id_detil_beli',$id);
		$this->db->update('tbl_detil_pembelian',$data);
	}
	function delete($id){
		$this->db->delete('tbl_detil_pembelian', array('id_detil_beli'=>$id));
	}
}
?>