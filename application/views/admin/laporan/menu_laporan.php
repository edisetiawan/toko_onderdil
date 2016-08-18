<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
	$(function() {
		$("#datepicker1").datepicker({
			dateFormat:'yy-mm-dd',
			changeMonth:true,
			changeYear:true,
		});
		$("#datepicker2").datepicker({
			dateFormat:'yy-mm-dd',
			changeMonth:true,
			changeYear:true,
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
<?php 
		if(isset($_SESSION['pos']) ){
			$transaksi		= $_SESSION['pos']['laporan'];
		}else{
			$transaksi ='';
		}
	?>

<section class="content-header">
    <h1>
        Laporan
    </h1>
</section>

<section class="content">
	<div class="row">
    	<div class="col-xs-12">
        	<div class="box">
            	<div class="box-header">
                	<h3 class="box-title">Laporan Transaksi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table width="65%" >
					<form action="<?php echo site_url('admin/laporan/index');?>" method="post">
					<tr>
						<td>
						
							<div class="form-group">
								<label class="col-sm-5 control-label">Pilih Transaksi</label>
								<div class="col-sm-7">
									<select name="laporan" class="form-control" onchange="this.form.submit()">
										<option value="none">--Jenis Transaksi--</option>
										<option value="1"<?php if($transaksi == 1)echo 'selected';?>>Penjualan</option>
										<option value="2"<?php if($transaksi == 2)echo 'selected';?>>Pembelian</option>
										<option value="3"<?php if($transaksi == 3)echo 'selected';?>>Pembayaran</option>
									</select>
									<font color="#FF0000"><?php echo form_error('transaksi');?></font>
								</div>
							</div>
							<br />&nbsp;
						</td>
						<td>
						
							<div class="form-group">
								<label class="col-sm-4 control-label">&nbsp;</label>
								<div class="col-sm-5">
									&nbsp;
								</div>
							</div>
							<br />&nbsp;
						</td>
					</tr>
					</form>
					
					<form class="form-horizontal"action="<?php echo site_url('admin/laporan/cetak_laporan');?>" method="post" target="_blank">
					<tr>
					<input type="hidden" name="transaksi" value="<?php echo $transaksi;?>" />
						<td>
						
							<div class="form-group">
								<label class="col-sm-5 control-label">Tgl Awal</label>
								<div class="col-sm-7">
									<input type="text" id="datepicker1" class="form-control" name="tgl_awal1">
									<font color="#FF0000"><?php echo form_error('tgl_awal1');?></font>
								</div>
							</div>
							<br />&nbsp;
							<div class="form-group">
								<label class="col-sm-5 control-label">Tgl Akhir</label>
								<div class="col-sm-7">
									<input type="text" id="datepicker2" class="form-control" name="tgl_akhir1">
									<font color="#FF0000"><?php echo form_error('tgl_akhir1');?></font>
								</div>
							</div>
							
							<br />&nbsp;
							<div class="form-group">
								<label class="col-sm-5 control-label">&nbsp;</label>
								<div class="col-sm-7">
									<button type="submit" name="btn" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Cetak</button>
								</div>
							</div>
						
						</td>
						<td valign="top" width="50%">
						
							<?php if($transaksi == 1){?>
								<div class="form-group">
									<label style="width:45%;" class="col-sm-6 control-label">Status Order</label>
									<div class="col-sm-6">
									<select name="status_order" class="form-control">
										<option value="4">--Semua Data--</option>
										<option value="1">Menunggu</option>
										<option value="2">Dikirim</option>
										<option value="3">Dibatalkan</option>
									</select>
									</div>
								</div>
							<?php }elseif($transaksi == 2){?>
								<div class="form-group">
									<label style="width:45%;"class="col-sm-6 control-label">Status Pembelian</label>
									<div class="col-sm-6">
									<select name="status_beli" class="form-control">
										<option value="4">--Semua Data--</option>
										<option value="1">Menunggu</option>
										<option value="2">Barang Diterima</option>
										<option value="3">Dibatalkan</option>
									</select>
									</div>
								</div>
							<?php }elseif($transaksi == 3){?>
								<div class="form-group">
									<label style="width:45%;"class="col-sm-5 control-label">Status Bayar</label>
									<div class="col-sm-6">
									<select name="status_bayar" class="form-control">
										<option value="Semua">--Semua Data--</option>
										<option value="Lunas">Lunas</option>
										<option value="Kurang">Kurang</option>
									</select>
									</div>
								</div>
							<?php }else{?>
							
							<?php }?>
						
						</td>
					</tr>
					</form>
					</table>
				</div>
			</div>
		</div>
		
	</div>
</section>

</body>
</html>
