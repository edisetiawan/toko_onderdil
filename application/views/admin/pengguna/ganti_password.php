<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
	<?php 
		if(isset($_SESSION['pos']) ){
			$username 			= $_SESSION['pos']['username'];
			$password_lama 		= $_SESSION['pos']['password_lama'];
			$password_baru		= $_SESSION['pos']['password']; 
			$confirm_password	= $_SESSION['pos']['confirm_password'];
		}else{
			$username ='';
			$password_lama ='';
			$password_baru ='';
			$confirm_password ='';
		}
	?>

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
                  <h3 class="box-title">Ganti Password</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			<form class="form-horizontal" action="" method="post">
                <div class="box-body">
				  	<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							  <label class="col-sm-4 control-label">Username</label>
							  <div class="col-sm-6">
						<input type="text" class="form-control" name="username"value="<?php echo $pengguna->username;?>">
							  <font color="#FF0000"><?php echo form_error('username');?></font>
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-4 control-label">Password Lama</label>
							  <div class="col-sm-6">
						<input type="password" class="form-control" name="password_lama" value="<?php echo $password_lama;?>">
							  <font color="#FF0000"><?php echo form_error('password_lama');?></font>
		
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-4 control-label">Password Baru</label>
							  <div class="col-sm-6">
						<input type="password" class="form-control" name="password" value="<?php echo $password_baru;?>">
							  <font color="#FF0000"><?php echo form_error('password');?></font>
		
							  </div>
							</div>
							
							<div class="form-group">
							  <label class="col-sm-4 control-label">Confirm Password</label>
							  <div class="col-sm-6">
						<input type="password" class="form-control" name="confirm_password" value="<?php echo $confirm_password;?>">
							  <font color="#FF0000"><?php echo form_error('confirm_password');?></font>
		
							  </div>
							</div>
							
							<br />&nbsp;
							<div class="box-footer">
							<button type="submit" name="btn" class="btn btn-primary"> Simpan</button>
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
