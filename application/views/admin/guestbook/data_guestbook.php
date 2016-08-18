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
       Guestbook
   </h1>
</section>	
<section class="content">
    <div class="row">
    	<div class="col-xs-12">
        	<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Guestbook</h3>
                </div><!-- /.box-header -->
                <div class="box-body">	
				 <table id="example2" class="table table-bordered table-hover">
				  <thead>
					<tr>
					  <th style="text-align:center;">No</th>
					  <th style="text-align:center;">Nama Lengkap</th>
					  <th style="text-align:center;">Email</th>
					  <th style="text-align:center;">Pesan</th>
					  <th style="text-align:center;">Balas Pesan</th>
					  <th style="text-align:center; width:7%;">Aksi</th>
					</tr>
				  </thead>
				  <tbody>
				   <?php $offset= $this->uri->segment(4) ?>
				  <?php foreach($guestbook as $row):?>
					<tr>
					  <td><?php echo $offset=$offset+1 ?></td>
					  <td><?php echo $row->nama_lengkap; ?></td>
						<td><?php echo mailto($row->email,$row->email);?></td>
						<td><?php echo $row->pesan; ?></td>
						<td><?php echo $row->balasan; ?></td>
					  <td>
						  <a class="btn btn-xs btn-info" title="Balas" href="<?php echo site_url('admin/guestbook/edit_guest/'.$row->id_guest);?>"><i class="glyphicon glyphicon-pencil"></i></a>
						  <a class="btn btn-xs btn-danger" title="Hapus" href="<?php echo site_url('admin/guestbook/delete_guest/'.$row->id_guest);?>"onclick="return confirm('Anda Yakin ?')">
						  <i class="glyphicon glyphicon-remove"></i></a>
					  </td>
					</tr>
					<?php endforeach?>
				  </tbody>
				</table>
				<table width="100%">	
					<tr>
						<td>
					<?php /*<a class="btn btn-success"href="<?php echo site_url('admin/guestbook/add_guest');?>"><i class="icon-plus"></i> Tambah</a>*/?>
						</td>
						<td align="right" valign="top">
					<ul class="pagination">
						<li class="paginate_button"><?php echo $this->pagination->create_links();?></li>
							
					</ul>
						</td>
					</tr>
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
