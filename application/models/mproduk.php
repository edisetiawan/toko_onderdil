<?php class Mproduk extends CI_Model{
	function construct(){
		parent::__construct();
		$this->load->database();
	}
	function produk_terbaru(){
		$this->db->order_by('id_produk','desc');
		$q=$this->db->get('tbl_produk','4');
		return $q->result();
	}
	function getCode($id_pro){
		$data = array();
		$this->db->where('id_produk',$id_pro);
		
		$hasil = $this->db->get('tbl_produk');
			if($hasil->num_rows() > 0){
				return $hasil->row_array();
			}		
	}
	function tampil_produk(){
		$this->db->join('tbl_suplier','tbl_suplier.id_suplier = tbl_produk.id_suplier');
		$q=$this->db->get('tbl_produk');
		return $q->result();
	}
	function produkSuplier($id){
		$this->db->join('tbl_suplier','tbl_suplier.id_suplier = tbl_produk.id_suplier');
		$this->db->where('tbl_produk.id_suplier',$id);
		$q=$this->db->get('tbl_produk');
		return $q->result();
	}
	function produk_bySuplier($id){
		$this->db->join('tbl_suplier','tbl_suplier.id_suplier = tbl_produk.id_suplier');
		$this->db->join('tbl_detil_pembelian','tbl_detil_pembelian.id_produk = tbl_produk.id_produk');
		$this->db->where('tbl_detil_pembelian.id_beli',$id);
		$q=$this->db->get('tbl_produk');
		return $q->result();
	}
	function produk_sejenis(){
		$query = $this->db->query("select * from tbl_produk group by id_kategori_produk ");
		return $query->result();
	}
	function perkategori($id, $limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT * FROM tbl_produk
		JOIN tbl_kategori_produk ON tbl_kategori_produk.id_kategori_produk = tbl_produk.id_kategori_produk
		JOIN tbl_suplier ON tbl_suplier.id_suplier = tbl_produk.id_suplier
		WHERE nama_produk <> '' 
		AND tbl_produk.id_kategori_produk = $id
		ORDER BY tbl_produk.id_produk DESC LIMIT ".$limit2;
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
	function getAll($limit1='',$limit2=''){
		$data = array();
		$sql = "SELECT * FROM tbl_produk
		JOIN tbl_kategori_produk ON tbl_kategori_produk.id_kategori_produk = tbl_produk.id_kategori_produk
		JOIN tbl_suplier ON tbl_suplier.id_suplier = tbl_produk.id_suplier
		WHERE nama_produk <> '' 
		
		ORDER BY tbl_produk.id_produk DESC LIMIT ".$limit2;
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
				'nama_produk' => $this->input->post('nama_produk'),
				'produk_sku' => $this->input->post('produk_sku'),
				'permalink' => url_title($this->input->post('nama_produk')),
				'id_kategori_produk' => $this->input->post('id_kategori_produk'),
				'jml' => $this->input->post('jml'),
				'harga' => $this->input->post('harga'),
				'harga_beli' => $this->input->post('harga_beli'),
				'manufaktur' => $this->input->post('manufaktur'),
				'keterangan' => $this->input->post('keterangan'),
				'id_suplier' => $this->input->post('id_suplier')
			);
			$this->db->insert('tbl_produk', $data);
		} else {
			$this->db->insert('tbl_produk', $params);
		}
	}
	function findById($id) {
		$this->db->select('tbl_produk.*');
		$this->db->where('id_produk', $id);
		$query = $this->db->get('tbl_produk', 1);
		
		if ($query->num_rows() == 1) {
			return $query->row_array();
		}
	 }
	function detil_produk(){
		$id=$this->input->post('id_produk');
	 	$this->db->where('id_produk',$id);
		$query=$this->db->get('tbl_produk');
		return $query->result();
	}
	function update($id, $data) {
		if (empty($data)) {
			$data = array(
				'nama_produk' => $this->input->post('nama_produk'),
				'produk_sku' => $this->input->post('produk_sku'),
				'permalink' => url_title($this->input->post('nama_produk')),
				'id_kategori_produk' => $this->input->post('id_kategori_produk'),
				'jml' => $this->input->post('jml'),
				'harga' => $this->input->post('harga'),
				'harga_beli' => $this->input->post('harga_beli'),
				'manufaktur' => $this->input->post('manufaktur'),
				'keterangan' => $this->input->post('keterangan'),
				'id_suplier' => $this->input->post('id_suplier')
			);
			$this->db->where('id_produk', $id);
			$this->db->update('tbl_produk', $data);
		} else {
			$this->db->where('id_produk', $id);
			$this->db->update('tbl_produk', $data);
		}
	}
	function delete($id){
		$this->db->where('id_produk', $id);
		$this->db->delete('tbl_produk');	
	}
	function cari_produk($limit,$offset,$nama_produk){
		$q=$this->db->query("SELECT * FROM tbl_produk 
			WHERE id_kategori_produk = '2'
			AND nama_produk LIKE'%$nama_produk%'
			OR manufaktur LIKE'%$nama_produk%'
			LIMIT $offset,$limit");
		return $q;
	}
	function tot_produk(){
		$q=$this->db->query("SELECT * FROM tbl_produk WHERE id_kategori_produk = '2' ORDER BY nama_produk ASC");
		return $q;
	}
	function stok_awal($kd_brg){
		$this->db->select('jml');
		$this->db->from('tbl_produk');
		$this->db->where('id_produk', $kd_brg);
		$hasil = $this->db->get();
		if($hasil->num_rows() > 0){
			return $hasil->row_array(); //return row sebagai associative array
		}			
	}
	// Pengurangan stok barang, stok awal dikurangi jumlah pesanan
	function kurangi_stok($kd_brg, $jum){
		$stok_awal = $this->stok_awal($kd_brg);
		$stok = $stok_awal['jml'] - $jum;
		$data = array(
			'jml' => $stok
		);
		$this->db->where('id_produk', $kd_brg);
		$this->db->update('tbl_produk', $data);		
	}
	
	function tambah_stok($kd_brg, $jum){
		$stok_awal = $this->stok_awal($kd_brg);
		$stok = $stok_awal['jml'] + $jum;
		$data = array(
			'jml' => $stok
		);
		$this->db->where('id_produk', $kd_brg);
		$this->db->update('tbl_produk', $data);		
	}
}
?>