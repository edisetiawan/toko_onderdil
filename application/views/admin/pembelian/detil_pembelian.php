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
		$("#datepicker2").datepicker({
			dateFormat:'yy-mm-dd'
		});
	});
</script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/themes/base/jquery.ui.all.css">

	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.datepicker.js"></script>

	<!--<script src="<?php echo base_url();?>public/js/jquery-1.8.2.js"></script>-->
<script type="text/javascript">
function tampil_barang(param){
	if(param==1)
		document.getElementById("templatebarang").style.visibility = 'visible';
	else
		document.getElementById("templatebarang").style.visibility = 'hidden';
}
</script>
<script language="javascript">
	var popupWindow = null;
	function centeredPopup(url,winName,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings =
	'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	popupWindow = window.open(url,winName,settings)
	}
</script>
</head>

<body>
<?php 
		if(isset($_SESSION['pos']) ){
			$tgl_beli		= $_SESSION['pos']['tgl_beli'];
			$id_suplier		= $_SESSION['pos']['id_suplier'];
			$no_beli		= $_SESSION['pos']['no_beli'];
			
		}else{
			$tgl_beli ='';
			$id_suplier		='';
			$no_beli	='';
			
		}
	?>

<?php
 $offset = 1;
    $total = 0;
?>
<section class="content-header">
    <h1>
         Pembelian
    </h1>
</section>

        <!-- Main content -->
<section class="content">
	<div class="row">
       <div class="col-md-12">
           <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Detil Pembelian</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
			<form class="form-horizontal" action="" method="post">
				  	<div class="row">
						<div class="col-md-12">
							<table width="80%">
								<tr>
								<td valign="top" width="40%">
								
								<div class="form-group">
								  <label class="col-sm-4 control-label">No Pembelian</label>
								  <div class="col-sm-5">
									<input type="text" disabled="disabled"required="required" value="<?php echo $pembelian->no_beli;?>" class="form-control">
									<input type="hidden" name="id_beli" value="<?php echo $pembelian->id_beli;?>" />
									<input type="hidden" name="no_beli" value="<?php echo $pembelian->no_beli;?>" />
									
								  <font color="#FF0000"><?php echo form_error('no_beli');?></font>
								  </div>
								</div>
								
								<div class="form-group">
								  <label class="col-sm-4 control-label">Tgl Pembelian</label>
								  <div class="col-sm-5">
									<input type="text" id="datepicker" name="tgl_beli"required="required" value="<?php echo $pembelian->tgl_beli;?>" class="form-control">
								  <font color="#FF0000"><?php echo form_error('tgl_beli');?></font>
								  </div>
								</div>
								
								<div class="form-group">
								  <label class="col-sm-4 control-label">Status Pembelian</label>
								  <div class="col-sm-5">
									<select name="status_beli" class="form-control">
										<option value="none"<?php echo set_select('id_suplier','none',true);?>>--Pilih Suplier--</option>
										<option value="1"<?php if($pembelian->status_beli == 1)echo 'selected';?>>Barang Menunggu</option>
										<option value="2"<?php if($pembelian->status_beli == 2)echo 'selected';?>>Barang Diterima</option>
										<option value="3"<?php if($pembelian->status_beli == 3)echo 'selected';?>>Pembelian Dibatalkan</option>
									</select>
								   </div>
								</div>
								
								<div class="form-group">
								  <label class="col-sm-4 control-label">Tgl Diterima</label>
								  <div class="col-sm-5">
									<input type="text" id="datepicker2" name="tgl_diterima"required="required" value="<?php echo $pembelian->tgl_diterima;?>" class="form-control">
								  <font color="#FF0000"><?php echo form_error('tgl_beli');?></font>
								  </div>
								</div>
								</td>
								<td valign="top" width="40%">
									<div class="form-group">
									  <label class="col-sm-4 control-label">Suplier</label>
									  <div class="col-sm-5">
									  <?php $suplier = $this->db->query("select * from tbl_suplier order by nama_suplier asc");?>
									  <input type="hidden"name="id_suplier" value="<?php echo $pembelian->id_suplier;?>" />
										<select class="form-control" disabled="disabled" >
											<option value="none"<?php echo set_select('id_suplier','none',true);?>>--Pilih Suplier--</option>
											<?php foreach($suplier->result() as $row):?>
											<option value="<?php echo $row->id_suplier;?>"<?php if($row->id_suplier == $pembelian->id_suplier)echo 'selected';?>><?php echo $row->nama_suplier;?></option>
											<?php endforeach;?>
										</select>
									  <font color="#FF0000"><?php echo form_error('id_Suplier');?></font>
									  </div>
									</div>
									<div class="form-group">
									  <label class="col-sm-4 control-label"></label>
									  <div class="col-sm-5">
										<a class="btn btn-primary" href="<?php echo site_url('admin/detil_pembelian/tampil_produk/'.$pembelian->id_beli);?>"onclick="centeredPopup(this.href,'myWindow','400','400','yes');return false">Pilih Barang</a>
									  </div>
									</div>
								</td>
								</tr>
							</table>
						</div>
					</div>
					
			<p>&nbsp;</p>
					<div class="row">
						<div class="col-xs-12 table-responsive">
						<h3>Detil Pembelian</h3>
						
							<table id="example2" class="table table-bordered table-hover">
								<thead style="color:#FFFFFF;;background-color:#72afd2">
									<tr>
										<th style="text-align:center;">No</th>
										<th style="text-align:center;">Gambar</th>
										<th style="text-align:center;">Nama Barang</th>
										<th style="text-align:center;">Harga Beli</th>
										<th style="text-align:center;">Jumlah</th>
										<th style="text-align:center;">Subotal</th>
										<th style="text-align:center;">Aksi</th>
									</tr>
								</thead>
								<tbody>
								
								<?php $i = 0; ?>
								<?php foreach($detil as $items): ?>
									<tr>
										<td style="text-align:center;"><?php echo $i+1;?></td>
										<td class="cart_product">
											<?php $id= $items->id_produk;
												$kode=$this->db->query("select * from tbl_produk where id_produk = $id");?>
											<?php foreach($kode->result() as $row):?>
												<img style="height:60px;" src="<?php echo base_url().$row->image;?>" alt="">
											<?php endforeach;?>
										</td>
										<td class="cart_description">
											<h4><a href=""><?php echo $items->nama_produk;?></a></h4>
												<?php $id= $items->id_produk;
													$kode=$this->db->query("select * from tbl_produk where id_produk = $id");?>
													<?php foreach($kode->result() as $row):?>
												<p><?php echo $row->produk_sku;?></p>
													<?php endforeach;?>
										</td>
										<td style="text-align:right;">
												<p>Rp. <?php echo $this->fungsi->rupiah($items->harga_beli); ?></p>
										</td>
										<td style="text-align:center;">
											<div class="cart_quantity_button">
												<?php echo form_hidden('id_produk', $items->id_produk); ?>
												<?php /*echo form_hidden('id_beli', $items->id_beli); */?>
												<?php echo form_hidden('id_detil_beli', $items->id_detil_beli); ?>
											 
												<input disabled="disabled" class="cart_quantity_input" type="text" name="jml_beli" value="<?php echo $items->jml_beli;?>" autocomplete="off" size="2">
											</div>
										</td>
										<td style="text-align:right;">
										<?php $subtotal = $items->jml_beli * $items->harga_beli;?>
											<p class="cart_total_price">Rp <?php echo $this->fungsi->rupiah($subtotal); ?></p>
										</td>
										<td style="text-align:center;">
											<a href="<?php echo site_url('admin/detil_pembelian/edit_detil/'.$items->id_detil_beli);?>" class="btn btn-xs btn-warning"onclick="centeredPopup(this.href,'myWindow','400','400','yes');return false"><i class="glyphicon glyphicon-edit"></i></a>
											<?php /*
											<a class="btn btn-xs btn-danger " onclick="return confirm('Anda Yakin ?')"href="<?php echo site_url('admin/detil_pembelian/hapus_detil/'.$items->id_detil_beli); ?>"><i class="glyphicon glyphicon-trash"></i></a>
											*/?>
										</td>
									</tr>
									<?php $i++; ?>
									
									<?php $total = $total + $subtotal;?>
									<?php endforeach; ?>
									<input type="hidden" name="total_beli" value="<?php echo $total;?>" />
									<?php $total_beli= $this->session->set_userdata('total_beli',$total);?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="5" align="right"><h4>Total Pembelian: </h4></td>
										<td style="text-align:right;"><h4><?php echo $this->fungsi->rupiah($total);?></h4></td>
									</tr>
												
								</tfoot>
							</table>
						</div>
					</div>
					<div class="form-group pull-left">
								<label class="col-sm-4 control-label">&nbsp;</label>
								<div class="col-sm-12">
									<button type="submit" class="btn btn-success"> Save</button>
									<a href="<?php echo site_url('admin/pembelian/index');?>" class="btn btn-danger">Cancel</a>
								</div>
							</div>
				</form>
				</div>
				
	        </div>
		</div>
	</div>
</section>
</body>
</html>
