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
            Suplier
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Suplier</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Suplier</th>
						<th>No Telp</th>
						<th>Alamat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
				  <?php $i=1;?>
					<?php foreach($suplier as $row):?>
                      <tr>
					  	<td><?php echo $i++;?></td>
                        <td><?php echo $row->nama_suplier;?></td>
						<td><?php echo $row->no_telp;?></td>
						<td><?php echo $row->alamat;?></td>
                        <td style="text-align:center;">
						  <a class="btn btn-xs btn-info" title="Edit" href="<?php echo site_url('admin/suplier/edit_suplier/'.$row->id_suplier);?>"><i class="glyphicon glyphicon-pencil"></i></a>
						  <a class="btn btn-xs btn-danger" title="Hapus" href="<?php echo site_url('admin/suplier/delete_suplier/'.$row->id_suplier);?>"onclick="return confirm('Anda Yakin ?')">
						  <i class="glyphicon glyphicon-remove"></i></a>
						</td>
                      </tr>
					 <?php endforeach;?>
                    </tbody>
                  </table>
				  				
				<a class="btn btn-medium btn-success" href="<?php echo site_url('admin/suplier/add_suplier');?>">Tambah</a>
					<div id="examples2_paginate" class="dataTables_paginate paging_simple_numbers">
						<ul class="pagination">
							<li class="paginate_button"><?php echo $this->pagination->create_links();?></li>
								
						</ul>
					</div>
					
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
          "autoWidth": true
        });
      });
    </script>

</body>
</html>
