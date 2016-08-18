<?php class Mlaporan extends CI_Model{
	function lap_penjualan(){
		$status = $this->input->post('status_order');
		$tgl_awal=$this->input->post('tgl_awal1');
		$tgl_akhir=$this->input->post('tgl_akhir1');
		if($status == 4){
			$query = $this->db->query("
				SELECT DATE_FORMAT(tbl_order.tgl_order,'%d-%m-%Y')AS tgl_order, 
				tbl_order.no_order, tbl_order.status_order, 
				tbl_pembayaran.tagihan, tbl_member.no_telp, tbl_member.nama_member
				FROM tbl_order
			JOIN tbl_member ON tbl_member.id_member = tbl_order.id_member
			JOIN tbl_pembayaran ON tbl_pembayaran.id_order = tbl_order.id_order
					
			WHERE tgl_order BETWEEN '$tgl_awal' AND '$tgl_akhir'
			ORDER BY tbl_order.id_order DESC
			");

		}else{
			$query = $this->db->query("
				SELECT DATE_FORMAT(tbl_order.tgl_order,'%d-%m-%Y')AS tgl_order, 
				tbl_order.no_order, tbl_order.status_order, 
				tbl_pembayaran.tagihan, tbl_member.no_telp, tbl_member.nama_member
				FROM tbl_order
			JOIN tbl_member ON tbl_member.id_member = tbl_order.id_member
			JOIN tbl_pembayaran ON tbl_pembayaran.id_order = tbl_order.id_order
					
			WHERE tgl_order BETWEEN '$tgl_awal' AND '$tgl_akhir'
			AND status_order = $status
			ORDER BY tbl_order.id_order DESC
			");
		}
		return $query->result();
	}
	function lap_pembelian(){
		$status = $this->input->post('status_beli');
		$tgl_awal=$this->input->post('tgl_awal1');
		$tgl_akhir=$this->input->post('tgl_akhir1');
		if($status == 4){
			$query = $this->db->query("
				SELECT DATE_FORMAT(tbl_pembelian.tgl_beli,'%d-%m-%Y')AS tgl_beli, 
				tbl_pembelian.no_beli, tbl_pembelian.status_beli, tbl_pembelian.total_beli,
				tbl_suplier.no_telp, tbl_suplier.nama_suplier
				FROM tbl_pembelian
			JOIN tbl_suplier ON tbl_suplier.id_suplier = tbl_pembelian.id_suplier
					
			WHERE tgl_beli BETWEEN '$tgl_awal' AND '$tgl_akhir'
			ORDER BY tbl_pembelian.id_beli DESC
			");

		}else{
			$query = $this->db->query("
				SELECT DATE_FORMAT(tbl_pembelian.tgl_beli,'%d-%m-%Y')AS tgl_beli, 
				tbl_pembelian.no_beli, tbl_pembelian.status_beli, tbl_pembelian.total_beli,
				tbl_suplier.no_telp, tbl_suplier.nama_suplier
				FROM tbl_pembelian
			JOIN tbl_suplier ON tbl_suplier.id_suplier = tbl_pembelian.id_suplier
					
			WHERE tgl_beli BETWEEN '$tgl_awal' AND '$tgl_akhir'
			AND tbl_pembelian.status_beli = $status
			ORDER BY tbl_pembelian.id_beli DESC
			");
		}
		return $query->result();
	}
	function lap_pembayaran(){
		$status = $this->input->post('status_bayar');
		$tgl_awal=$this->input->post('tgl_awal1');
		$tgl_akhir=$this->input->post('tgl_akhir1');
		if($status == "Semua"){
			$query= $this->db->query("
				SELECT DATE_FORMAT(tgl_bayar,'%d-%m-%Y')AS tgl_bayar, 
				tbl_pembayaran.jml_bayar, tbl_pembayaran.metode, tbl_pembayaran.status_bayar, tbl_pembayaran.tagihan,
				tbl_order.no_order,tbl_order.tgl_order,
				tbl_member.nama_member
				FROM tbl_pembayaran
				JOIN tbl_member ON tbl_member.id_member = tbl_pembayaran.id_member
				JOIN tbl_order ON tbl_order.id_order = tbl_pembayaran.id_order
				WHERE tbl_order.tgl_order BETWEEN '$tgl_awal' AND '$tgl_akhir'
				ORDER BY tbl_pembayaran.id_bayar DESC
			");
		}else{
			$query= $this->db->query("
				SELECT DATE_FORMAT(tgl_bayar,'%d-%m-%Y')AS tgl_bayar, 
				tbl_pembayaran.jml_bayar, tbl_pembayaran.metode, tbl_pembayaran.status_bayar, tbl_pembayaran.tagihan,
				tbl_order.no_order,tbl_order.tgl_order,
				tbl_member.nama_member
				FROM tbl_pembayaran
				JOIN tbl_member ON tbl_member.id_member = tbl_pembayaran.id_member
				JOIN tbl_order ON tbl_order.id_order = tbl_pembayaran.id_order
				WHERE tbl_order.tgl_order BETWEEN '$tgl_awal' AND '$tgl_akhir'
				AND tbl_pembayaran.status_bayar = '$status'
				ORDER BY tbl_pembayaran.id_bayar DESC
			");
		}
		return $query->result();
	}
	function nota_order($id){
		$query=$this->db->query("SELECT DATE_FORMAT(tgl_order,'%d-%m-%Y')AS tgl_order, 
		tbl_order.alamat_kirim, tbl_order.id_order, tbl_order.no_order, tbl_member.nama_member, tbl_member.no_telp
		FROM tbl_order
		JOIN tbl_member on tbl_member.id_member = tbl_order.id_member 
		JOIN tbl_pembayaran ON tbl_pembayaran.id_order = tbl_order.id_order
		WHERE tbl_order.id_order = $id");
		return $query->result();
	}

	function detil_order($id){
		$query=$this->db->query("
			SELECT * FROM tbl_detil_order 
			JOIN tbl_produk ON tbl_produk.id_produk = tbl_detil_order.id_produk
			JOIN tbl_order ON tbl_order.id_order = tbl_detil_order.id_order
			JOIN tbl_biaya_kirim ON tbl_biaya_kirim.id_biaya = tbl_order.id_biaya
			WHERE tbl_detil_order.id_order = $id
		");
		return $query->result();					
	}
	function nota_pembelian($id){
		$query=$this->db->query("SELECT DATE_FORMAT(tgl_beli,'%d-%m-%Y')AS tgl_beli, 
		DATE_FORMAT(tbl_pembelian.tgl_diterima,'%d-%m-%Y')AS tgl_diterima,
		tbl_pembelian.status_beli, tbl_pembelian.id_beli, tbl_pembelian.no_beli, 
		tbl_suplier.nama_suplier, tbl_suplier.no_telp, tbl_Suplier.alamat
		FROM tbl_pembelian
		JOIN tbl_suplier on tbl_suplier.id_suplier = tbl_pembelian.id_suplier 
		
		WHERE tbl_pembelian.id_beli = $id");
		return $query->result();
	}
	function detil_pembelian($id){
		$query=$this->db->query("
			SELECT * FROM tbl_detil_pembelian
			JOIN tbl_produk ON tbl_produk.id_produk = tbl_detil_pembelian.id_produk
			JOIN tbl_pembelian ON tbl_pembelian.id_beli = tbl_detil_pembelian.id_beli
			
			WHERE tbl_detil_pembelian.id_beli = $id
		");
		return $query->result();					
	}
	function nota_pembayaran($id){
		$query= $this->db->query("SELECT DATE_FORMAT(tgl_bayar,'%d-%m-%Y')AS tgl_bayar, tbl_pembayaran.jml_bayar, tbl_pembayaran.tagihan, tbl_pembayaran.status_bayar
		 FROM tbl_pembayaran
			JOIN tbl_order ON tbl_order.id_order = tbl_pembayaran.id_order
			JOIN tbl_member ON tbl_member.id_member = tbl_pembayaran.id_member
			WHERE tbl_pembayaran.id_order = '$id'
		");
		return $query->result();
	}
	
}
?>