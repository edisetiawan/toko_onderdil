<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<!--slider-->
<script src="<?php echo base_url();?>motor/web/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>motor/web/js/script.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>motor/web/js/superfish.js"></script>

    <link href="<?php echo base_url();?>AdminLTE/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>AdminLTE/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url();?>AdminLTE/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

</head>

<body onLoad="window.print()">

<div class="content-top" style="padding-left:20px;">
<?php
 $offset = 1;
    $total = 0;
?>

		<div class="sellers">
			<table width="55%">
				<tr>
					<td><img src="<?php echo base_url();?>motor/web/images/logo-sigit.png" alt=""/></td>
					<td>
						<h4><span><span>Jl Perbatasan Kota, Desa Kalianyar, <br />
						Kec. Kutoarjo, Kab. Purworejo <br />
						Telp : 085-228-099-153
						</span></span></h4>
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr color="#000000" /></td>
				</tr>
			</table>
		</div>
		
		<div class="row" style="width:55%;">
			
			<div class="col-sm-4" style="width:28%;">
				<div class="shopper-info">
					<?php foreach($pembelian as $row):?>
					<form>
						<input class="form-control"type="text" disabled="disabled" value="No Beli : <?php echo $row->no_beli;?>"><br />
						
						<input class="form-control"type="text" disabled="disabled"value="Tgl Beli : <?php echo $row->tgl_beli;?>">
					</form>
					<?php endforeach;?>
				</div>
			</div>
			<div class="col-sm-4" style="width:33%;">
				
				<div class="shopper-info">
					<?php foreach($pembelian as $row):?>
					<form>
						<?php if($row->status_beli == 1){?>
							<input class="form-control"type="text" disabled="disabled"value="Status : Barang Menunggu"><br />
							<input class="form-control"type="text" disabled="disabled"value="Tgl Diterima : -">
						<?php }elseif($row->status_beli == 2){?>
							<input class="form-control"type="text" disabled="disabled"value="Status : Barang Diterima"><br />
							<input class="form-control"type="text" disabled="disabled"value="Tgl Diterima : <?php echo $row->tgl_diterima;?>">
						<?php }else{?>
							<input class="form-control"type="text" disabled="disabled"value="Status : Pembelian Dibatalkan">
							
						<?php }?>
						
					</form>
					<?php endforeach;?>
				</div>
			</div>
			<div class="col-sm-4" style="width:39%;">
				<div class="shopper-info">
					<table style="background-color:#D7DBDC;" width="100%">
					<?php foreach($pembelian as $row):?>
						<tr>
							<td>Suplier </td><td width="5%" align="center"> : </td><td><?php echo $row->nama_suplier;?></td>
						</tr>
						<tr valign="top">
							<td>Telp </td><td width="5%" align="center"> : </td><td><?php echo $row->no_telp;?></td>
						</tr>
						<tr valign="top">
							<td>Alamat </td><td width="5%" align="center"> : </td><td><?php echo $row->alamat;?></td>
						</tr>
					<?php endforeach;?>
					</table>
				</div>
			</div>
			
		</div>	
		
		<div class="sellers">
			<h4><span><span>Detil Pembelian</span></span></h4>
		</div>
			<div class="table-responsive cart_info">
				<table id="example2" class="table table-bordered table-hover" style="width:54%;">
					<thead style="color:#FFFFFF;;background-color:#72afd2">
						<tr>
							<th style="text-align:center;"><label>NO</label></th>
							<th style="text-align:center;"><label>Item</label></th>
							<th style="text-align:center;"><label>Nama Barang</label></th>
							<th style="text-align:center;"><label>Harga</label></th>
							<th style="text-align:center;"><label>Jumlah</label></th>
							<th style="text-align:center;"><label>Sub Total</label></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;?>
						<?php foreach($detil as $row):?>
						<tr>
							<td style="text-align:center;"><?php echo $i++;?></td>
							<td class="cart_product">
								<a href=""><img style="height:60px;" src="<?php echo base_url().$row->image;?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><?php echo $row->nama_produk;?></h4>
								<p>ID: <?php echo $row->produk_sku;?></p>
							</td>
							<td style="text-align:right;">
								<p><?php echo $this->fungsi->rupiah($row->harga_beli);?></p>
							</td>
							<td style="text-align:center;">
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="text" disabled="disabled" value="<?php echo $row->jml_beli;?>"  size="2">
								</div>
							</td>
							<td class="cart_total" style="text-align:right;">
								<p class="cart_total_price">
									<?php $subtotal = $row->harga_beli * $row->jml_beli;?>
									<?php $total = $total + $subtotal;?>
									
									<?php echo $this->fungsi->rupiah($subtotal);?>
								</p>
							</td>
						</tr>
						<?php endforeach;?>
						<tr>
							<td colspan="3" style="text-align:center;">
								Petugas Penerima : <br />
								<?php echo $this->session->userdata('nama_lengkap');?><br />
								<p>&nbsp;</p>
								(_____________________)
							</td>
							<td colspan="3" style=" background-color:#D7DBDE;">
								<table class="table table-condensed total-result"style=" background-color:#D7DBDE;" >
									<tr>
										<td>Sub Total</td>
										<td style="text-align:right">
											<?php echo $this->fungsi->rupiah($total);?>
										</td>
									</tr>
									
									<tr>
										<td><h4>Total Pembelian</h4></td>
										<td style="text-align:right"><h4><?php echo $this->fungsi->rupiah($total );?></h4></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
	</div>
</div>
</body>
</html>
