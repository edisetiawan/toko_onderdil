<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<section class="content-header">
    <h1>
         Pengguna
    </h1>
</section>

        <!-- Main content -->
<section class="content">
	<div class="row">
       <div class="col-md-12">
           <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Pengguna</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			<form class="form-horizontal" action="<?php echo site_url('admin/pengguna/add_pengguna');?>" method="post">
                <div class="box-body">
				  	<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							  <label class="col-sm-3 control-label">Nama Lengkap</label>
							  <div class="col-sm-6">
						<input type="text" class="form-control" name="nama_lengkap">
							  <font color="#FF0000"><?php echo form_error('nama_lengkap');?></font>
		
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-3 control-label">No Telp</label>
							  <div class="col-sm-6">
						<input type="text" class="form-control" name="no_telp">
							  <font color="#FF0000"><?php echo form_error('no_telp');?></font>
		
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-3 control-label">Username</label>
							  <div class="col-sm-6">
						<input type="text" class="form-control" name="username">
							  <font color="#FF0000"><?php echo form_error('username');?></font>
		
							  </div>
							</div>

							<div class="form-group">
							  <label class="col-sm-3 control-label">Password</label>
							  <div class="col-sm-6">
						<input type="password" class="form-control" name="password">
							  <font color="#FF0000"><?php echo form_error('password');?></font>
		
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-sm-3 control-label">Level</label>
							  <div class="col-sm-6">
								<select name="id_level" class="form-control">
									<option value="none"<?php echo set_select('id_level','none',true);?>>--Pilih Level--</option>
									<option value="1">Admin</option>
									<option value="2">Operator</option>
									<option value="3">Member</option>
								</select>
							  <font color="#FF0000"><?php echo form_error('id_level');?></font>
		
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-3 control-label">Status</label>
							  <div class="col-sm-6">
								<select class="form-control" name="status">
									<option value="none"<?php echo set_select('status','none',true);?>>--Pilih Status--</option>
									<option value="1">Aktif</option>
									<option value="2">Non Aktif</option>
								</select>
							  <font color="#FF0000"><?php echo form_error('status');?></font>
		
							  </div>
							</div>
							<br />&nbsp;
							<div class="box-footer">
							<button type="submit" class="btn btn-primary"> Simpan</button>
							<a href="<?php echo site_url('admin/pengguna/index');?>" class="btn btn-danger">Batal</a>
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
