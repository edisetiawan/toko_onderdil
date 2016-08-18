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
            Transaksi
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Order</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <!--<th>No</th>-->
                        <th>No Order</th>
						<th>Nama Member</th>
						<th>No Telp</th>
						<th>Alamat Kirim</th>
						<th>Tgl Order</th>
						<th>Pembayaran</th>
						<th>Status Order</th>
                        <th width="7%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
				  <?php $i=1;?>
					<?php foreach($order as $row):?>
                      <tr>
					  <!--<td><?php /*echo $i++;*/?></td>-->
                        <td><?php echo $row->no_order;?></td>
						<td><?php echo $row->nama_member;?></td>
						<td><?php echo $row->no_telp;?></td>
						<td><?php echo $row->alamat_kirim;?></td>
						<td><?php echo $row->tgl_order;?></td>
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
						<td><?php if($row->status_order == 1){?>
							<span style="text-align:center;" class="bg-warning btn-block">
								Diproses
                  			</span>
							<?php }elseif($row->status_order == 2){?>
							<span style="text-align:center;" class="bg-success btn-block">
								Dikirim
                  			</span>
							<?php }else{?>
							<span style="text-align:center;" class="bg-danger btn-block">
								Dibatalkan
                  			</span>
							<?php }?>
						</td>
                        <td style="text-align:center;">
						  <a class="btn btn-xs btn-info" title="Detil" href="<?php echo site_url('admin/order_pesanan/edit_order/'.$row->id_order);?>"><i class="glyphicon glyphicon-pencil"></i></a>
						 
						  <a class="btn btn-xs btn-success" target="_blank" title="Cetak" href="<?php echo site_url('admin/laporan/nota_order/'.$row->id_order);?>"><i class="glyphicon glyphicon-print"></i></a>
						</td>
                      </tr>
					 <?php endforeach;?>
                    </tbody>
                  </table>
				  	<table width="100%">	
						<tr>
							<td>&nbsp;		
								
							</td>
							<td align="right" valign="top">
								<ul class="pagination">
									<li class="paginate_button"><?php echo $this->pagination->create_links();?></li>
								</ul>
								
							</td>
						</tr>
					</table>	
                </div><!-- /.box-body -->
				
              </div><!-- /.box -->
			</div>
		</div>
	</section>
    <!-- DATA TABES SCRIPT -->
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
