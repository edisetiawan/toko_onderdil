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
                  <h3 class="box-title">Kelola Akun Pribadi</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			<form class="form-horizontal" action="" method="post">
                <div class="box-body">
				  	<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							  <label class="col-sm-3 control-label">Nama Lengkap</label>
							  <div class="col-sm-6">
								<input type="text" class="form-control" name="nama_member" value="<?php echo $pengguna->nama_member;?>">
							  <font color="#FF0000"><?php echo form_error('nama_member');?></font>
		
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-sm-3 control-label">No Telp</label>
							  <div class="col-sm-6">
								<input type="text" class="form-control" name="no_telp" value="<?php echo $pengguna->no_telp;?>">
							  <font color="#FF0000"><?php echo form_error('no_telp');?></font>
		
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-3 control-label">Email</label>
							  <div class="col-sm-6">
								<input type="text" class="form-control" name="email" value="<?php echo $pengguna->email;?>">
							  <font color="#FF0000"><?php echo form_error('email');?></font>
		
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-sm-3 control-label">Alamat</label>
							  <div class="col-sm-6">
								<textarea name="alamat" class="form-control"><?php echo $pengguna->alamat;?></textarea>
							  <font color="#FF0000"><?php echo form_error('alamat');?></font>
		
							  </div>
							</div>
							<br />&nbsp;
							<div class="box-footer">
							<button type="submit" class="btn btn-primary"> Simpan</button>
							<a href="<?php echo site_url('admin/home/index');?>" class="btn btn-danger">Batal</a>
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
