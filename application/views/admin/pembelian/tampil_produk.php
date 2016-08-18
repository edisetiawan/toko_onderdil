<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- DATA TABLES -->
    <link href="<?php echo base_url();?>AdminLTE/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<!--onbeforeunload='refreshAndClose();'-->
<body>
<section class="content-header">
   <h1>
      Produk
   </h1>
</section>	
<section class="content">
    <div class="row">
    	<div class="col-xs-12">
        	<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Produk</h3>
                </div><!-- /.box-header -->
                <div class="box-body">	
				 <table id="example2" class="table table-bordered table-hover">
				  <thead>
					<tr>
					  <th style="text-align:center;">No</th>
					  <th style="text-align:center;">Nama Produk</th>
					  <th style="text-align:center;">Kode</th>
					  <th style="text-align:center;">Image</th>
					  <th style="text-align:center;">Stok</th>
					  <th style="text-align:center;">Harga Beli</th>
					  <th style="text-align:center;">Suplier</th>
					  <th style="text-align:center; width:7%;">Aksi</th>
					</tr>
				  </thead>
				  <tbody>
				   <?php $i=1; ?>
				  <?php foreach($produk as $row):?>
					<tr>
					  <td><?php echo $i++; ?></td>
					  <td><?php echo $row->nama_produk;?></td>
					  <td><?php echo $row->produk_sku;?></td>
					  <td>
					  <?php if($row->image == ""){?>
					  
					  <?php }else{?>
					  	<img src="<?php echo base_url().$row->image;?>"width="40" height="30" />
					  <?php }?>
					  </td>
					  <td style="text-align:center;">
					  	<?php if($row->jml > 3){?>
							<span style="text-align:center;" class="bg-success btn-block">
					  			<?php echo $row->jml;?>
							</span>
						<?php }else{?>
							<span style="text-align:center;" class="bg-danger btn-block">
								<?php echo $row->jml;?>
							</span>
						<?php }?>
					  </td>
					  <td><?php echo $this->fungsi->rupiah($row->harga_beli);?></td>
					  <td><?php echo $row->nama_suplier;?></td>
					  <td>
					  	<form action="<?php echo site_url('cart_beli/add_cart');?>" method="post">
							<input type="hidden" name="id_produk" value="<?php echo $row->id_produk;?>" />
							<input type="hidden" name="harga" value="<?php echo $row->harga_beli;?>" />
							<input type="hidden" name="banyak" value="1" />
							
							<input type="hidden" name="nama_produk" value="<?php echo $row->nama_produk;?>" />
						  <button type="submit" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-plus"></i> Beli</button>
						</form>
						  
					  </td>
					</tr>
					<?php endforeach?>
				  </tbody>
				</table>
				
					
			 </div>
		</div>
	</div>
</div>
</section>	
    <script src="<?php echo base_url();?>AdminLTE/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>AdminLTE/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
</body>
</html>
