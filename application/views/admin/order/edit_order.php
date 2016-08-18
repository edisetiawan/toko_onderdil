<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
	$(function() {
		$("#datepicker").datepicker({
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
<?php
 $offset = 1;
    $total = 0;
?>
<section class="content-header">
    <h1>
         Order Pesanan
    </h1>
</section>

        <!-- Main content -->
<section class="content">
	<div class="row">
       <div class="col-md-12">
           <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Detil Order</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			<form class="form-horizontal" action="" method="post">
                <div class="box-body">
				  	<div class="row">
						<div class="col-md-12">
							<table width="100%">
								<tr>
								<td valign="top" width="40%">
								<div class="form-group">
								  <label class="col-sm-4 control-label">No Order</label>
								  <div class="col-sm-5">
									<input type="text" disabled="disabled"required="required" value="<?php echo $order->no_order;?>" class="form-control">
									<input type="hidden" name="id_order" value="<?php echo $order->id_order;?>" />
									<input type="hidden" name="id_member" value="<?php echo $order->id_member;?>" />
									<input type="hidden" name="id_biaya" value="<?php echo $order->id_biaya;?>" />
									<input type="hidden" name="no_order" value="<?php echo $order->no_order;?>" />
									<input type="hidden" name="tgl_order" value="<?php echo $order->tgl_order;?>" />
									
								  <font color="#FF0000"><?php echo form_error('no_order');?></font>
								  </div>
								</div>
								
								<div class="form-group">
								  <label class="col-sm-4 control-label">Tgl Order</label>
								  <div class="col-sm-5">
									<input type="text" disabled="disabled" id="datepicker" name="tgl_order"required="required" value="<?php echo $order->tgl_order;?>" class="form-control">
								  <font color="#FF0000"><?php echo form_error('tgl_order');?></font>
								  </div>
								</div>
								
								<div class="form-group">
								  <label class="col-sm-4 control-label">Status Order</label>
								  <div class="col-sm-5">
									<select name="status_order" class="form-control">
										<option value="none">--Pilih Status--</option>
										<option value="1"<?php if($order->status_order == "1")echo 'selected';?>>Menunggu</option>
										<option value="2"<?php if($order->status_order == "2")echo 'selected';?>>Dikirim</option>
										<option value="3"<?php if($order->status_order == "3")echo 'selected';?>>Dibatalkan</option>
									</select>
								  <font color="#FF0000"><?php echo form_error('status_order');?></font>
								  </div>
								</div>
								</td>
								<td>
								<div class="form-group">
								  <label class="col-sm-4 control-label">Nama Pemesan</label>
								  <div class="col-sm-5">
									<input type="text" readonly="" required="required" value="<?php echo $order->nama_member;?>" class="form-control">		
								  </div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-4 control-label">No Telp</label>
									<div class="col-sm-5">
									<input type="text" readonly="" value="<?php echo $order->no_telp;?>" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-4 control-label">Alamat</label>
									<div class="col-sm-6">
									<textarea disabled="disabled" class="form-control"><?php echo $order->alamat_kirim;?></textarea>
									<textarea name="alamat_kirim" style="display:none;"  class="form-control"><?php echo $order->alamat_kirim;?></textarea>
									</div>
								</div>
								</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 table-responsive">
						  <table class="table table-striped">
							<thead>
							  <tr>
								<th>Qty</th>
								<th>Produk</th>
								<th>Kode Produk</th>
								<th>Harga</th>
								<th>Subtotal</th>
							  </tr>
							</thead>
							<tbody>
							  <?php $i=1;?>
							  <?php foreach($detil as $row):?>
							  <tr>
								<td><?php echo $row->jml_order;?></td>
								<td><?php echo $row->nama_produk;?></td>
								<td><?php echo $row->produk_sku;?></td>
								<td><?php echo $this->fungsi->rupiah($row->harga);?></td>
								<td><?php $subtotal = $row->harga * $row->jml_order;?>
									<?php $total = $total + $subtotal;?>
									<?php echo $this->fungsi->rupiah($subtotal);?>
								</td>
							  </tr>
							  <?php endforeach;?>
							</tbody>
						  </table>
						</div><!-- /.col -->
					  </div>
					<div class="row">
						<div class="col-xs-6">
						  <p class="lead">Metode Pembayaran:</p>
						  <img src="<?php echo base_url();?>AdminLTE/dist/img/credit/visa.png" alt="Visa"/>
						  <img src="<?php echo base_url();?>AdminLTE/dist/img/credit/mastercard.png" alt="Mastercard"/>
						  <img src="<?php echo base_url();?>AdminLTE/dist/img/credit/american-express.png" alt="American Express"/>
						  <img src="<?php echo base_url();?>AdminLTE/dist/img/credit/paypal2.png" alt="Paypal"/>
						  <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
								Keterangan : <br />
								Metode Pembayaran : 
								<?php if($order->metode == 1){?>
									<span>Transfer Bank</span><br />
									<span>Bank : BRI</span><br />
									<span>No Rek : 675701000015507</span><br />
									<span>Atasnama : Sigit</span>
								<?php }else{?>
									<span>Bayar Ditempat</span>
								<?php }?>
								<br />
								
						  </p>
						</div><!-- /.col -->
						<div class="col-xs-6">
						  <p class="lead">Kota Pengiriman : <?php echo $order->nama_kota;?></p>
						  <div class="table-responsive">
							<table class="table">
							  <tr>
								<th style="width:50%">Subtotal:</th>
								<td><?php echo $this->fungsi->rupiah($total);?></td>
							  </tr>
							  <tr>
								<th>Biaya Kirim:</th>
								<td><?php echo $this->fungsi->rupiah($order->biaya);?></td>
							  </tr>
							  <tr>
								<th>Total Tagihan:</th>
								<td>
									<?php $tagihan = $order->biaya + $total;?>
									<?php echo $this->fungsi->rupiah($tagihan);?>
								</td>
							  </tr>
							</table>
						  </div>
						</div><!-- /.col -->
					</div>
					<div class="row no-print">
						<div class="col-xs-12">
						  <a href="<?php echo site_url('admin/laporan/nota_order/'.$order->id_order);?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
						  <button type="submit" class="btn btn-success pull-right"> Simpan</button>
						  <a href="<?php echo site_url('admin/order_pesanan/index');?>" class="btn btn-danger pull-right" style="margin-right: 5px;">Batal</a>
						</div>
					</div>
				</div>
				
			</form>
	        </div>
		</div>
	</div>
</section>
</body>
</html>
