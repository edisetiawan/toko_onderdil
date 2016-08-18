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
					<?php foreach($order as $row):?>
					<form>
						<input class="form-control"type="text" disabled="disabled" value="No Nota : <?php echo $row->no_order;?>"><br />
						
						<input class="form-control"type="text" disabled="disabled"value="Tgl Order : <?php echo $row->tgl_order;?>">
					</form>
					<?php endforeach;?>
				</div>
			</div>
			<div class="col-sm-4" style="width:37%;">
				<div class="shopper-info">
					<?php foreach($order as $row):?>
					<form>
						<input class="form-control" type="text"disabled="disabled" value="Pemesan : <?php echo $row->nama_member;?>"><br />
						
						<input class="form-control"type="text" disabled="disabled"value="No Telp : <?php echo $row->no_telp;?>">
					</form>
					<?php endforeach;?>
				</div>
			</div>
			<div class="col-sm-4" style="width:35%;">
				Alamat COD / Pengiriman:
				<div class="shopper-info">
					<?php foreach($order as $row):?>
					<textarea style="width:248px;"class="form-control"name="message" disabled="disabled"><?php echo $row->alamat_kirim;?></textarea>
					
					<?php endforeach;?>
				</div>
			</div>
			
		</div>	
		
		<div class="sellers">
			<h4><span><span>Detil Order</span></span></h4>
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
								<p><?php echo $this->fungsi->rupiah($row->harga);?></p>
							</td>
							<td style="text-align:center;">
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="text" disabled="disabled" value="<?php echo $row->jml_order;?>"  size="2">
								</div>
							</td>
							<td class="cart_total" style="text-align:right;">
								<p class="cart_total_price">
									<?php $subtotal = $row->harga * $row->jml_order;?>
									<?php $total = $total + $subtotal;?>
									<?php $biaya = $row->biaya;?>
									<?php echo $this->fungsi->rupiah($subtotal);?>
								</p>
							</td>
						</tr>
						<?php endforeach;?>
						<tr>
							<td colspan="3">
							<?php foreach($order as $row):?>
								<?php $id_order = $row->id_order;?>
							<?php endforeach;?>
								<?php $pembayaran=$this->db->query("select metode from tbl_pembayaran where id_order = $id_order");?>
								<div class="register-req">
									<?php foreach($pembayaran->result() as $row):?>
									<p>Metode Pembayaran yang dipilih : 
										<?php if($row->metode == 1){?>
											<span>Transfer Bank </span>
										<?php }else{?>
											<span>Bayar Ditempat</span>
										<?php }?>
									</p>
									<p>
										<?php if($row->metode == 1){?>
											<span>Segera Lakukan Transfer ke Bank BRI </span><br />
											<span>No Rek : 675701000015507</span><br />
											<span>Atasnama : Sigit</span>
										<?php }else{?>
											<span>Pembayaran dilakukan apabila barang telah sampai ditempat anda</span>
										<?php }?>
									</p>
									<?php endforeach;?>
								</div>
							</td>
							<td colspan="3">
								<table class="table table-condensed total-result" style=" background-color:#D7DBDE;">
									<tr>
										<td>Sub Total</td>
										<td style="text-align:right">
											<?php echo $this->fungsi->rupiah($total);?>
										</td>
									</tr>
									<tr class="shipping-cost">
										<td>Biaya Kirim</td>
										<td style="text-align:right"><?php echo $this->fungsi->rupiah($biaya);?></td>										
									</tr>
									<tr>
										<td><span class="price">Total Belanja</span></td>
										<td style="text-align:right"><span class="price"><?php echo $this->fungsi->rupiah($total + $biaya);?></span></td>
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
