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
       Pembayaran
   </h1>
</section>	
<section class="content">
    <div class="row">
    	<div class="col-xs-12">
        	<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Konfirmasi Pembayaran</h3>
                </div><!-- /.box-header -->
                <div class="box-body">	
				<?php /*
				<table align="right" width="20%">
					<form action="<?php echo site_url('admin/pembayaran/cari_pembayaran');?>" method="post">
					<tr>
						<td>
							<button class="btn btn-sm btn-info" type="submit">Cari</button>
						</td>
						<td>
							<input class="form-control" name="no_transfer" type="text" />
						</td>
					</tr>
					</form>
				</table>
				*/?>
				 <table  id="example2" class="table table-bordered table-hover">
				  <thead>
					<tr>
					  <!--<th style="text-align:center;">No</th>-->
					  <th style="text-align:center;">No Order</th>
					  <th style="text-align:center;">Atas Nama</th>
					  <th style="text-align:center;">Metode</th>
					  <th style="text-align:center;">Gambar</th>
					  <th style="text-align:center;">No Transfer</th>
					  <th style="text-align:center;">Tgl Bayar</th>
					  <th style="text-align:center;">Tagihan</th>
					  <th style="text-align:center;">JML Bayar</th>
					  <th style="text-align:center;">Kurang</th>
					  <th style="text-align:center;">Status Bayar</th>
					  <th style="text-align:center; width:7%;">Aksi</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php $i=1;?>
				  <?php foreach($pembayaran as $row):?>
					<tr>
					 <!-- <td><?php /*echo $i++;*/?></td>-->
					  <td><?php echo $row->no_order;?></td>
					  <td><?php echo $row->nama_member;?></td>
					  <td><?php if($row->metode == 1){?>
					  		<span style="text-align:center;" class="bg-warning btn-block">
								Transfer Bank
                  			</span>
						<?php }else{?>
							<span style="text-align:center;" class="bg-info btn-block">
								Bayar Ditempat
                  			</span>
						<?php }?>
					  </td>
					  <td><a data-lightbox="example-1"data-title="" title="" href="<?php echo base_url().$row->image;?>"><img style="width:50px;" src="<?php echo base_url().$row->image;?>" /></a></td>
					  <td><?php if($row->metode == 1){?>
					  		<span style="text-align:center;" class="bg-warning btn-block">
					  		<?php echo $row->no_transfer;?>
							</span>
						<?php }else{?>
							<span style="text-align:center;" class="bg-info btn-block">
								-
                  			</span>
					  	<?php }?>
					  </td>
					  <td><?php echo $row->tgl_bayar;?></td>
					  <td align="right"><?php echo $this->fungsi->rupiah($row->tagihan);?></td>
					  <td align="right"><?php echo $this->fungsi->rupiah($row->jml_bayar);?></td>
					  <td align="right">
					  	<?php 
							$tagihan = $row->tagihan;
							$kekurangan = $row->tagihan - $row->jml_bayar ;
							$jml_bayar = $row->jml_bayar;
							
							$total = $jml_bayar;
						?>
						<?php if($row->jml_bayar == $row->tagihan){?>
							<span style="text-align:center;" class="bg-success btn-block">
								-
                  			</span>
						<?php }else{?>
							<span class="bg-danger btn-block">
							<?php echo $this->fungsi->rupiah($kekurangan);?>
							</span>
						<?php }?>
					  </td>
					  <td>
					  		<?php if($row->status_bayar == "Lunas"){?>
								<span style="text-align:center;" class="bg-success btn-block">
								<?php echo $row->status_bayar;?>
					  			</span>
							<?php }else{?>
								<span style="text-align:center;" class="bg-danger btn-block">
									<?php echo $row->status_bayar;?>
								</span>
							<?php }?>
					  </td>
					  <td>
					  	<?php if($row->status_bayar == "Lunas"){?>
							<button disabled="disabled" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
						
						<?php }else{?>
						  <a title="Edit" class="btn btn-xs btn-danger" href="<?php echo site_url('admin/pembayaran/edit_pembayaran/'.$row->id_bayar);?>"><i class="glyphicon glyphicon-pencil"></i></a>
						<?php }?>
						
						
						  <a title="Cetak" target="_blank" class="btn btn-xs btn-info" href="<?php echo site_url('admin/laporan/nota_pembayaran/'.$row->id_order);?>"><i class="glyphicon glyphicon-print"></i></a>
					  </td>
					</tr>
					<?php endforeach?>
				  </tbody>
				</table>
				<?php /*
			<a class="btn btn-success"href="<?php echo site_url('admin/pembayaran/add_pembayaran');?>"><i class="icon-plus"></i> Tambah</a>*/?>

				<div class="pagination pull-right">
					<ul class="pagination">
						<li class="paginate_button">
							
								<?php echo $this->pagination->create_links();?></li>
							
					</ul>
				</div>
				
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
