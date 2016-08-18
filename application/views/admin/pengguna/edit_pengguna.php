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
                  <h3 class="box-title">Edit Pengguna</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			<form class="form-horizontal" action="" method="post">
                <div class="box-body">
				  	<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							  <label class="col-sm-3 control-label">Nama Lengkap</label>
							  <div class="col-sm-6">
						<input type="text" class="form-control" name="nama_lengkap" value="<?php echo $pengguna->nama_lengkap;?>">
							  <font color="#FF0000"><?php echo form_error('nama_lengkap');?></font>
		
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
							  <label class="col-sm-3 control-label">Username</label>
							  <div class="col-sm-6">
						<input type="text" class="form-control" name="username"value="<?php echo $pengguna->username;?>">
							  <font color="#FF0000"><?php echo form_error('username');?></font>
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-3 control-label">Password</label>
							  <div class="col-sm-6">
						<input type="password" class="form-control" name="password" value="<?php echo $pengguna->password;?>">
							  <font color="#FF0000"><?php echo form_error('password');?></font>
		
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-3 control-label">Level</label>
							  <div class="col-sm-6">
							  	<?php if($this->session->userdata('id_level') == 1){?>
								<select class="form-control" name="id_level">
									<option value="1"<?php if($pengguna->id_level == 1)echo 'selected';?>>Admin</option>
									<option value="2"<?php if($pengguna->id_level == 2)echo 'selected';?>>Operator</option>
									<option value="3"<?php if($pengguna->id_level == 3)echo 'selected';?>>Member</option>
								</select>
								<?php }else{?>
								<select class="form-control" name="id_level">
									
									<option value="2"<?php if($pengguna->id_level == 2)echo 'selected';?>>Operator</option>
									<option value="3"<?php if($pengguna->id_level == 3)echo 'selected';?>>Member</option>
								</select>
								<?php }?>
							  <font color="#FF0000"><?php echo form_error('id_level');?></font>
		
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-3 control-label">Status</label>
							  <div class="col-sm-6">
								<select class="form-control" name="status">
									<option value="1"<?php if($pengguna->status == 1)echo 'selected';?>>Aktif</option>
									<option value="0"<?php if($pengguna->status == 0)echo 'selected';?>>Non Aktif</option>
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
