<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<section class="content-header">
    <h1>
         Biaya Kirim
    </h1>
</section>

        <!-- Main content -->
<section class="content">
	<div class="row">
       <div class="col-md-12">
           <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Biaya Kirim</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			<form class="form-horizontal" action="<?php echo site_url('admin/biaya_kirim/add_biaya_kirim');?>" method="post">
                <div class="box-body">
				  	<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							  <label class="col-sm-3 control-label">Nama Kota</label>
							  <div class="col-sm-6">
						<input type="text" class="form-control" name="nama_kota">
							  <font color="#FF0000"><?php echo form_error('nama_kota');?></font>
		
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-3 control-label">Biaya</label>
							  <div class="col-sm-6">
						<input type="text" class="form-control" name="biaya">
							  <font color="#FF0000"><?php echo form_error('biaya');?></font>
		
							  </div>
							</div>
							<br />&nbsp;
							
							<div class="box-footer">
							<button type="submit" class="btn btn-primary"> Save</button>
							<a href="<?php echo site_url('admin/biaya_kirim/index');?>" class="btn btn-danger">Cancel</a>
							</div>
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
