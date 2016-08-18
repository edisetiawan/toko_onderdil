<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- DATA TABLES -->
    <link href="<?php echo base_url();?>AdminLTE/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->

</head>

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
					  <th style="text-align:center;">Harga</th>
					  <th style="text-align:center;">Suplier</th>
					  <th style="text-align:center;">Keterangan</th>
					  <th style="text-align:center;">Stok</th>
					  <th style="text-align:center; width:7%;">Aksi</th>
					</tr>
				  </thead>
				  <tbody>
				   <?php $offset= $this->uri->segment(4) ?>
				  <?php foreach($produk as $row):?>
					<tr>
					  <td><?php echo $offset=$offset+1 ?></td>
					  <td><?php echo $row->nama_produk;?></td>
					  <td><?php echo $row->produk_sku;?></td>
					  <td>
					  <?php if($row->image == ""){?>
					  
					  <?php }else{?>
					  <img src="<?php echo base_url().$row->image;?>"width="40" height="30" />
					  <?php }?>
					  </td>
					  <td><?php echo $this->fungsi->rupiah($row->harga);?></td>
					  <td><?php echo $row->nama_suplier;?></td>
					  <td><?php echo word_limiter($row->keterangan,5);?></td>
					  <td style="text-align:center;"><?php echo $row->jml;?></td>
					  <td>
						  <a class="btn btn-xs btn-info" href="<?php echo site_url('admin/produk/edit_produk/'.$row->id_produk);?>"><i class="glyphicon glyphicon-pencil"></i></a>
						  <a class="btn btn-xs btn-danger" href="<?php echo site_url('admin/produk/delete_produk/'.$row->id_produk);?>"onclick="return confirm('Anda Yakin ?')">
						  <i class="glyphicon glyphicon-remove"></i></a>
					  </td>
					</tr>
					<?php endforeach?>
				  </tbody>
				</table>
				
					<div class="pagination">
					<a class="btn btn-success"href="<?php echo site_url('admin/produk/add_produk');?>"><i class="icon-plus"></i> Tambah</a>
					</div>
						<ul class="pagination pull-right">
							<li class="paginate_button"><?php echo $this->pagination->create_links();?></li>
								
						</ul>
					
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
          "paging": false,
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
