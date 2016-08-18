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
<script type="text/javascript">
function tampil_barang(param){
	if(param==1)
		document.getElementById("templatebarang").style.visibility = 'visible';
	else
		document.getElementById("templatebarang").style.visibility = 'hidden';
}
</script>
<script type="text/javascript">
function addText() {
  var x = document.getElementById("cmb");
  var y = document.getElementById("txt");
  getCmb = x.value;
  y.value = getCmb;
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
			$id_beli		= $_SESSION['pos']['id_beli'];
		}else{
			$id_beli ='';
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
                  <h3 class="box-title">Tambah Pembelian</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
			<form class="form-horizontal" action="" method="post">
				  	<div class="row">
						<div class="col-md-12">
							
						</div>
					</div>
			</form>
			<p>&nbsp;</p>
					<div class="row">
						<div class="col-xs-12 table-responsive">
						<h3>Detil Pembelian</h3>
						<?php echo form_open('admin/detil_pembelian/update_keranjang'); ?>
							<table id="example2" class="table table-bordered table-hover">
								<thead style="color:#FFFFFF;;background-color:#72afd2">
									<tr>
										<th style="text-align:center;">Item</th>
										<th style="text-align:center;">Nama Barang</th>
										<th style="text-align:center;">Harga Beli</th>
										<th style="text-align:center;">Jumlah</th>
										<th style="text-align:center;">Total</th>
										<th style="text-align:center;">Hapus</th>
									</tr>
								</thead>
								<tbody>
								<?php if($this->cart->total_items() > 0): ?>
								<?php $i = 1; ?>
								<?php foreach($this->cart->contents() as $items): ?>
									<tr>
										<td class="cart_product">
											<?php $id= $items['id'];
												$kode=$this->db->query("select * from tbl_produk where id_produk = $id");?>
											<?php foreach($kode->result_array() as $row):?>
												<img style="height:60px;" src="<?php echo base_url().$row['image'];?>" alt="">
											<?php endforeach;?>
										</td>
										<td class="cart_description">
											<h4><a href=""><?php echo $items['name'];?></a></h4>
												<?php $id= $items['id'];
													$kode=$this->db->query("select * from tbl_produk where id_produk = $id");?>
													<?php foreach($kode->result_array() as $row):?>
												<p><?php echo $row['produk_sku'];?></p>
													<?php endforeach;?>
										</td>
										<td style="text-align:right;">
												<p>Rp. <?php echo $this->cart->format_number($items['price']); ?></p>
										</td>
										<td style="text-align:center;">
											<div class="cart_quantity_button">
												<?php echo form_hidden('rowid[]', $items['rowid']); ?>
													
											  <?php /*echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '2','class'=>'cart_quantity_input')); */?>
											  
												<input class="cart_quantity_input" type="text" name="qty[]" value="<?php echo $items['qty'];?>" autocomplete="off" size="2" onkeyup="this.form.submit()">
											</div>
										</td>
										<td style="text-align:right;">
											<p class="cart_total_price">Rp <?php echo $this->cart->format_number($items['subtotal']); ?></p>
										</td>
										<td style="text-align:center;">
											<a class="btn btn-xs btn-danger " onclick="return confirm('Anda Yakin ?')"href="<?php echo base_url(); ?>admin/detil_pembelian/hapus_keranjang/<?php echo $items['rowid']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
										</td>
									</tr>
									<?php $i++; ?>
									<?php endforeach; ?>
									<tr>
									<?php echo form_close()?>
									</tr>
								<?php endif;?>
									<?php if($this->cart->total_items() < 1):?>
									<tr>
										<td colspan="5">No item in your cart.</td>
									</tr>
									<?php endif;?>				
								</tbody>
							</table>
						<?php echo form_close();?>
						</div>
							<br />&nbsp;
							<form action="<?php echo site_url('admin/detil_pembelian/tambah_detil');?>" method="post">
							<?php $totalbelanja = $this->cart->total();?>
								<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user');?>" />
								<input type="text" name="id_beli" value="<?php echo $id_beli;?>" />
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
	</div>
</section>
</body>
</html>
