<?php
	define('FPDF_FONTPATH', 'fpdf/font/');
	require('fpdf/mc_table.php');
	$pdf=new PDF_MC_Table('L','cm',"A4");
	$pdf->Open();
	$pdf->SetMargins(1,1,1,1);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Image('public/logo-sigit.jpg', 1,1,6.2,1.8);
	
	$pdf->SetFont('helvetica','B',17);
	$pdf->Cell(6.5,1,' ',0,0,'L');
	$pdf->Cell(10,1,'Sigit Vespa & Variasi',0,0,'L');
	$pdf->Ln();
	
	$pdf->SetFont('arial','',10);
	$pdf->Cell(6.5,1,' ',0,0,'L');
 	$pdf->Cell(10,1,'Jalan perbatasan kota Desa Kalianyar, Kecamatan Kutoarjo',0,0,'L');
	$pdf->Ln();
	$pdf->Cell(6.5,1,' ',0,0,'L');
	$pdf->Cell(10,0.1,'Kabupaten Purworejo, (56283), Tlp : 085 228 099 153',0,0,'L');
	$pdf->Ln();
	
	$pdf->Line(1,3.6,28,3.6);
	$pdf->Line(1,3.65,28,3.65);

	$pdf->Ln(1);
	
	/*foreach($periode as $row){*/
	$pdf->SetFont('Times','B',14);
	$pdf->Cell(19,0.5,'Laporan Pembayaran' /*.$row->tgl_awal. ' '*/,0,0,'L');
 	$pdf->Ln();
	/*}*/
	$pdf->Ln();
	
/* setting header table */
	$pdf->Ln(0.3);
	$pdf->SetFont('Times','B',11);
	$pdf->SetWidths(array(1,2.5,4,2.5,4,2.5,2.5,2.5,2.5,3));
	$pdf->SetHeight(0.7);
	$pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C'));
	$pdf->Row(array("NO","No Order","Atas Nama","Tagihan","Metode","Tgl Bayar","JML Bayar","Kurang","Status Bayar","Subtotal"));
 	$i=0;
	$total=0;
/* generate hasil query disini */
	foreach($pembayaran as $data){
		if($data->status_bayar == "Kurang"){
			$status = "Kurang";
		}else{
			$status = "Lunas";
		}
		if($data->metode == 1){
			$metode = "Transfer Bank";
		}else{
			$metode = "Bayar Ditempat (COD)";
		}
	$kekurangan = $data->tagihan - $data->jml_bayar;
	$subtotal = $data->jml_bayar;
	
	$jml_bayar = $subtotal ;
	
    	$pdf->SetFont('Times','',10);
		$pdf->SetAligns(array('C','L','L','R','L','L','R','R','C','R'));
		$i++;
    	$pdf->Row(array(($i),$data->no_order, 
							$data->nama_member, 
							$this->fungsi->rupiah($data->tagihan),
							$metode,
							$data->tgl_bayar, 
							$this->fungsi->rupiah($data->jml_bayar),
							$this->fungsi->rupiah($kekurangan),
							$status, 
								
							$this->fungsi->rupiah($jml_bayar) 
						)
				);
		$total+= $jml_bayar;
	}
	
	$pdf->Ln(0);
	$pdf->SetFont('Times','B',11);
	$pdf->SetWidths(array(24,3));
	$pdf->SetHeight(0.7);
 	$i=0;
/* generate hasil query disini */
	/*foreach($penjualan_hari as $data){*/
    	$pdf->SetFont('Times','B',11);
		$pdf->SetAligns(array('C','R'));
		$i++;
    	$pdf->Row(array(('Total Transaksi '),$this->fungsi->rupiah($total) ));
	/*}*/
	$pdf->Ln(0.5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(3.3,0.5,'Operator ',0,'C','R');
	
	/*foreach($total as $data){*/
	$pdf->Cell(22.6,0.5,'Purworejo : '.date('d-m-Y').'',0,'C','R');
	/*}*/
 	$pdf->Ln();
	
	$pdf->Ln(0.1);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(24.7,0.5,'Manager',0,'C','R');
 	$pdf->Ln();

	$pdf->Ln(1.5);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(9.5,0.5,'(__________________)',0,'C','LR');
	$pdf->Cell(16.5,0.5,'(__________________) ',0,'C','R');
 	$pdf->Ln();

/* setting posisi footer 3 cm dari bawah */
	$pdf->SetY(-2.2);
 
/* setting font untuk footer */
	$pdf->SetFont('Times','',10);
 
/* setting cell untuk waktu pencetakan */
	$pdf->Cell(9.5, 0.1, 'Printed on : '.date('d/m/Y H:i').' | Created by : '.$this->session->userdata('nama_lengkap').' ',0,'LR','L');
 
/* setting cell untuk page number */
	$pdf->Cell(19, 0.1, 'Page '.$pdf->PageNo().'/{nb}',0,0,'R');
 
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
	$pdf->Output("Lap_reservasi.pdf","I");
?>