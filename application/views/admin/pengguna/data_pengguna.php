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
       Pengguna
   </h1>
</section>	
<section class="content">
    <div class="row">
    	<div class="col-xs-12">
        	<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pengguna</h3>
                </div><!-- /.box-header -->
                <div class="box-body">	
				 <table  id="example2" class="table table-bordered table-hover">
				  <thead>
					<tr>
					  <th style="text-align:center;">No</th>
					  <th style="text-align:center;">Nama Lengkap</th>
					  <th style="text-align:center;">Email</th>
					  <th style="text-align:center;">Username</th>
					  <th style="text-align:center;">Password</th>
					  <th style="text-align:center;">Level</th>
					  <th style="text-align:center;">Status</th>
					  <th style="text-align:center;">Aksi</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php $i=1;?>
				  <?php foreach($pengguna as $row):?>
					<tr>
					  <td><?php echo $i++;?></td>
					  <td><?php echo $row->nama_lengkap;?></td>
					  <td><?php echo $row->email;?></td>
					  <td><?php echo $row->username;?></td>
					  <td><?php echo $row->password;?></td>
					  <td><?php echo $row->level;?></td>
					  <td><?php if($row->status == 1){
					  		echo "Aktif";
							}else{
							echo "Non Aktif";
							}
						?>
						</td>
					  <td>
						  <a class="btn btn-xs btn-info" href="<?php echo site_url('admin/pengguna/edit_pengguna/'.$row->id_user);?>"><i class="glyphicon glyphicon-pencil"></i></a>
						  <a class="btn btn-xs btn-danger" href="<?php echo site_url('admin/pengguna/delete_pengguna/'.$row->id_user);?>"onclick="return confirm('Anda Yakin ?')">
						  <i class="glyphicon glyphicon-remove"></i></a>
					  </td>
					</tr>
					<?php endforeach?>
				  </tbody>
				</table>
			<a class="btn btn-success"href="<?php echo site_url('admin/pengguna/add_pengguna');?>"><i class="icon-plus"></i> Tambah</a>

				<div id="examples2_paginate" class="dataTables_paginate paging_simple_numbers">
					<ul class="pagination">
						<li class="paginate_button"><?php echo $this->pagination->create_links();?></li>
							
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
