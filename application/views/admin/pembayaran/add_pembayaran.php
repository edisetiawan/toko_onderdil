<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
	$(function() {
		$("#datepicker2").datepicker({
			changeMonth:false,
			changeYear:false,
			minDate: 0,
			dateFormat:'yy-mm-dd'
		});
	});
</script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/themes/base/jquery.ui.all.css">

	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.datepicker.js"></script>
	<!--<script src="<?php echo base_url();?>public/js/jquery-1.8.2.js"></script>-->

</head>

<body>
<section class="main-info" style="color:#000000;">
    <div class="container">
        <div class="row-fluid">
			<div class="span8">
			<h2>Pembayaran Reservasi</h2>
			<p>&nbsp;</p>
			<form action='' method="POST">
			<table width="100%">
				<tr>
					<td>
					<fieldset>
					<div class="control-group">
					  <div class="controls">
					  		<label class="col-sm-3 control-label">No Reservasi</label>
							<div class="col-sm-3">
								<input type="text" readonly=""required="required" value="<?php echo $pembayaran->no_reservasi;?>" class="input-xlarge">							
							</div>
					  </div>
					</div>
					<div class="control-group">
					  <div class="controls">
					  		<label class="col-sm-3 control-label">Jumlah Tagihan</label>
							<div class="col-sm-3">
								<input type="text" readonly=""required="required" value="<?php echo $this->fungsi->rupiah($pembayaran->tagihan);?>" class="input-xlarge">
								<input type="hidden" name="tagihan" value="<?php echo $pembayaran->tagihan;?>" />
							
							</div>
					  </div>
					</div>
					<div class="control-group">
					  <div class="controls">
					  		<label class="col-sm-3 control-label">Jumlah Bayar</label>
							<div class="col-sm-3">
								<select name="jml_bayar" class="form-control">
										<option value="<?php echo $pembayaran->tagihan;?>"><?php echo $this->fungsi->rupiah($pembayaran->tagihan);?></option>
									</select>
								
							
							</div>
					  </div>
					</div>
					<div class="control-group">
					  <div class="controls">
					  		<label class="col-sm-3 control-label">Kekurangan</label>
							<div class="col-sm-3">
							<?php $kekurangan = $pembayaran->tagihan - $pembayaran->jml_bayar ;?>
								<input type="text" readonly=""required="required" value="<?php echo $this->fungsi->rupiah($kekurangan);?>" class="input-xlarge">
								
							
							</div>
					  </div>
					</div>
					</fieldset>
					</td>
					<td valign="top">
				<fieldset>
					<div class="control-group">
					  <div class="controls">
						<label class="col-sm-3 control-label">No Transfer</label>
							 <div class="col-sm-6">
						<input type="text" name="no_transfer"required="required" value="<?php echo $pembayaran->no_transfer;?>" placeholder="No Transfer" class="input-xlarge">
							</div>
					  </div>
					</div>
					<div class="control-group">
					  <div class="controls">
					  		<label class="col-sm-3 control-label">Tgl Transfer</label>
							<div class="col-sm-6">
						<input type="text" name="tgl_bayar"required="required" value="<?php echo $pembayaran->tgl_bayar;?>"id="datepicker2" class="input-xlarge">
						<input type="hidden" name="id_reservasi" value="<?php echo $pembayaran->id_reservasi;?>" />
						
							</div>
					  </div>
					</div>
					<?php if($pembayaran->jml_bayar == 0){?>
					<div class="control-group">
					  <div class="controls">
					  		<label class="col-sm-3 control-label">Pembayaran</label>
							<div class="col-sm-5">
							<?php $dp = ($pembayaran->tagihan * 25 / 100);?>
								<select name="jml_bayar" class="form-control">
									<option value="0"<?php if($pembayaran->jml_bayar == '0')echo 'selected';?>>--Pilih Pembayaran--</option>
									
									<option value="<?php echo $dp;?>"<?php if($dp == $pembayaran->jml_bayar)echo 'selected';?>>Uang Muka (25%) = <?php echo $this->fungsi->rupiah($dp);?></option>
									<option value="<?php echo $pembayaran->tagihan;?>"<?php if($pembayaran->tagihan == $pembayaran->jml_bayar)echo 'selected';?>>Tunai = <?php echo $this->fungsi->rupiah($pembayaran->tagihan);?></option>
								</select>
							
							</div>
					  </div>
					</div>
					<?php }else{?>
					
								<input type="hidden" name="jml_bayar"required="required" value="<?php echo $pembayaran->jml_bayar?>" class="form-control">
					<?php }?>
					
					<?php if($pembayaran->jml_bayar == 0 or $pembayaran->jml_bayar == $pembayaran->tagihan){?>
								
					<?php }else{?>
					<div class="form-group">
						<label class="col-sm-3 control-label">Pelunasan</label>
						<div class="col-sm-5">
							<?php $kekurangan = $pembayaran->tagihan - $pembayaran->jml_bayar ;?>
							<select name="pelunasan"class="form-control">
								<option value="0">--Pilih Nominal--</option>
								<option value="<?php echo $kekurangan;?>"><?php echo $this->fungsi->rupiah($kekurangan);?></option>
							</select>
						</div>
					</div>
					<br />	
					<?php }?>
				</fieldset>
					</td>
				</tr>
			</table>
					<br />&nbsp;
					
					<div class="control-group">
					  <!-- Button -->
					  <div class="controls">
						<button type="submit" class="btn btn-success btn-medium">Simpan</button>
						<a class="btn btn-medium btn-danger" href="<?php echo site_url('reservasi/index');?>">Kembali</a>
					  </div>
					</div>
			</form>

		</div>
		
		<div class="span4">
				<div class="center gap">
					<h3>Menu Spesial</h3>
					<p class="lead">Dapur Gentong Cafe memiliki menu spesial yang siap menggugah selera makan anda sekalian</p>
				</div>
		
				<div class="row-fluid">
					<?php foreach($spesial as $row):?>
						<div class="media">
							<div class="pull-left">
								<i class="icon-tag icon-medium "></i>
							</div>
							<div class="media-body">
								<h4 class="media-heading" style="color:#000000;"><?php echo $row->nama_makanan;?></h4>
								<p>
									<table width="100%">
									<tr>
										<td colspan="2">
										<img alt=" " style="height:140px; width:280px;" src="<?php echo base_url().$row->image;?>">
										<br />
										</td>
									</tr>
									<tr>
										<td valign="top">
										<h4> Harga : 
										<?php echo $this->fungsi->rupiah($row->harga);?>
										</h4>
										</td>
										<td>
										<form action="<?php echo site_url('cart_delivery/add');?>" method="post">
											<input type="hidden" name="id_makanan" value="<?php echo $row->id_makanan;?>" />
											<button type="submit" class="btn btn-success">Order</button>
										</form>
										</td>
									</tr>
									</table>
								</p>
							</div>
						</div>
					 <?php endforeach;?>
				</div>

            </div>
		</div>
	</div>
</section>

</body>
</html>
