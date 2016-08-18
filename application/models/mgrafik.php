<?php class Mgrafik extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function grafik_penjualan(){
		$tahun = $this->input->post('tahun');
		$q=$this->db->query("SELECT  
		YEAR(tgl_order)AS tahun,
		Sum(IF(tgl_order LIKE '%-01-%',(tbl_produk.harga * jml_order),0)) AS Jan, 
		Sum(IF(tgl_order LIKE '%-02-%',(tbl_produk.harga * jml_order),0)) AS Feb,
		Sum(IF(tgl_order LIKE '%-03-%',(tbl_produk.harga * jml_order),0)) AS Mar, 
		Sum(IF(tgl_order LIKE '%-04-%',(tbl_produk.harga * jml_order),0)) AS Apr, 
		Sum(IF(tgl_order LIKE '%-05-%',(tbl_produk.harga * jml_order),0)) AS Mei, 
		Sum(IF(tgl_order LIKE '%-06-%',(tbl_produk.harga * jml_order),0)) AS Jun,
		Sum(IF(tgl_order LIKE '%-07-%',(tbl_produk.harga * jml_order),0)) AS Jul,
		Sum(IF(tgl_order LIKE '%-08-%',(tbl_produk.harga * jml_order),0)) AS Agst, 
		Sum(IF(tgl_order LIKE '%-09-%',(tbl_produk.harga * jml_order),0)) AS Sept,
		Sum(IF(tgl_order LIKE '%-10-%',(tbl_produk.harga * jml_order),0)) AS Okt,
		Sum(IF(tgl_order LIKE '%-11-%',(tbl_produk.harga * jml_order),0)) AS Nov,
		Sum(IF(tgl_order LIKE '%-12-%',(tbl_produk.harga * jml_order),0)) AS Des
		
		FROM (tbl_detil_order)
		JOIN tbl_order ON tbl_order.id_order = tbl_detil_order.id_order
		JOIN tbl_produk ON tbl_produk.id_produk = tbl_detil_order.id_produk
		WHERE YEAR(tgl_order) = '$tahun'		
			");
		return $q->result();
	}

	function grafik_pendapatan(){
		$tahun = $this->input->post('tahun');
		$q=$this->db->query("SELECT  
		YEAR(tgl_bayar)AS tahun,
		Sum(IF(tgl_bayar LIKE '%-01-%',jml_bayar,0)) AS Jan, 
		Sum(IF(tgl_bayar LIKE '%-02-%',jml_bayar,0)) AS Feb,
		Sum(IF(tgl_bayar LIKE '%-03-%',jml_bayar,0)) AS Mar, 
		Sum(IF(tgl_bayar LIKE '%-04-%',jml_bayar,0)) AS Apr, 
		Sum(IF(tgl_bayar LIKE '%-05-%',jml_bayar,0)) AS Mei, 
		Sum(IF(tgl_bayar LIKE '%-06-%',jml_bayar,0)) AS Jun,
		Sum(IF(tgl_bayar LIKE '%-07-%',jml_bayar,0)) AS Jul,
		Sum(IF(tgl_bayar LIKE '%-08-%',jml_bayar,0)) AS Agst, 
		Sum(IF(tgl_bayar LIKE '%-09-%',jml_bayar,0)) AS Sept,
		Sum(IF(tgl_bayar LIKE '%-10-%',jml_bayar,0)) AS Okt,
		Sum(IF(tgl_bayar LIKE '%-11-%',jml_bayar,0)) AS Nov,
		Sum(IF(tgl_bayar LIKE '%-12-%',jml_bayar,0)) AS Des
				
		FROM tbl_pembayaran
		WHERE YEAR(tgl_bayar) = '$tahun'
			");
		return $q->result();
	}
	function grafik_order(){
		$q= $this->db->query("SELECT 
		Sum(IF(tgl_order LIKE '%-01-%',tagihan,0)) AS Jan,
		Sum(IF(tgl_order LIKE '%-02-%',tagihan,0)) AS Feb,
		Sum(IF(tgl_order LIKE '%-03-%',tagihan,0)) AS Mar,
		Sum(IF(tgl_order LIKE '%-04-%',tagihan,0)) AS Apr,
		Sum(IF(tgl_order LIKE '%-05-%',tagihan,0)) AS Mei,
		Sum(IF(tgl_order LIKE '%-06-%',tagihan,0)) AS Jun,
		Sum(IF(tgl_order LIKE '%-07-%',tagihan,0)) AS Jul,
		Sum(IF(tgl_order LIKE '%-08-%',tagihan,0)) AS Agst,
		Sum(IF(tgl_order LIKE '%-09-%',tagihan,0)) AS Sept,
		Sum(IF(tgl_order LIKE '%-10-%',tagihan,0)) AS Okt,
		Sum(IF(tgl_order LIKE '%-11-%',tagihan,0)) AS Nov,
		Sum(IF(tgl_order LIKE '%-12-%',tagihan,0)) AS Des
		
		FROM tbl_order
		JOIN tbl_pembayaran ON tbl_pembayaran.id_order = tbl_order.id_order
		WHERE YEAR(tgl_order) = '$tahun'
		ORDER BY tbl_order.id_order DESC 
		");
		return $q->result();
	}

}
?>