<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php 
		if(isset($_SESSION['pos']) ){
			$nama_lengkap	= $_SESSION['pos']['nama_lengkap'];
			$no_telp		= $_SESSION['pos']['no_telp'];
			$email			= $_SESSION['pos']['email'];
			$alamat			= $_SESSION['pos']['alamat'];
			$username		= $_SESSION['pos']['username'];
			$password		= $_SESSION['pos']['password'];
		}else{
			$nama_lengkap 	='';
			$no_telp		='';
			$email			='';
			$alamat			='';
			$username		='';
			$password		='';
		}
	?>

<div class="single">
	<div class="content span_1_of_2">	
		<div class="sellers">
	    	<h4><span><span>Registrasi</span></span></h4>    	
	    </div>
		<div class="about">
				<form class="form-search" action="<?php echo site_url('member/register');?>" method="post">
               
				  	<div class="row">
						<div class="col-md-8">
							<div class="form-group">
							  <label class="col-sm-4 control-label">Nama Lengkap</label>
							  <div class="col-sm-8">
						<input type="text" class="form-control" name="nama_lengkap" value="<?php echo $nama_lengkap;?>">
							  <font color="#FF0000"><?php echo form_error('nama_lengkap');?></font>
		
							  </div>
							</div>
							<br />&nbsp;
							
							<div class="form-group">
							  <label class="col-sm-4 control-label">Email</label>
							  <div class="col-sm-7">
								<input type="text" class="form-control" name="email"value="<?php echo $email;?>">
								<input type="hidden" value="3" name="id_level" />
								<input type="hidden" value="1" name="status" />
							  <font color="#FF0000"><?php echo form_error('email');?></font>
		
							  </div>
							</div>
							
							<br />&nbsp;
							<div class="form-group">
							  <label class="col-sm-4 control-label">No Telp</label>
							  <div class="col-sm-5">
						<input type="text" class="form-control" name="no_telp" value="<?php echo $no_telp;?>">
							  <font color="#FF0000"><?php echo form_error('no_telp');?></font>
		
							  </div>
							</div>
							<br />&nbsp;
							
							<div class="form-group">
							  <label class="col-sm-4 control-label">Alamat</label>
							  <div class="col-sm-8">
								<textarea class="form-control" name="alamat"><?php echo $alamat;?></textarea>
							  <font color="#FF0000"><?php echo form_error('alamat');?></font>
		
							  </div>
							</div>
							<br />&nbsp;
							
							<div class="form-group">
							  <label class="col-sm-4 control-label">Username</label>
							  <div class="col-sm-6">
						<input type="text" class="form-control" name="username"value="<?php echo $username;?>">
							  <font color="#FF0000"><?php echo form_error('username');?></font>
		
							  </div>
							</div>
							<br />&nbsp;

							<div class="form-group">
							  <label class="col-sm-4 control-label">Password</label>
							  <div class="col-sm-6">
						<input type="password" class="form-control" name="password"value="<?php echo $password;?>">
							  <font color="#FF0000"><?php echo form_error('password');?></font>
		
							  </div>
							</div>
							<br />&nbsp;
							
							<div class="box-footer">
							<button name="btn" type="submit"style="background:#000099; color:#FFFFFF;" class="btn"> Save</button>
							<a href="<?php echo site_url('home/index');?>" class="btn btn-danger">Cancel</a>
							</div>
						</div>
					</div>
				
			</form>
		</div>
	</div>
	<div class="rightsidebar span_3_of_1">
				<div class="blog-bottom">
					<h4>Kategori</h4>
					<?php $kategori=$this->db->query("select * from tbl_kategori order by nama_kategori asc");?>
					<ul class="categories">
						<?php foreach($kategori->result() as $row):?>
						<li class="firstItem"> <a href="<?php echo site_url('home/perkategori/'.$row->id_kategori);?>">
						<?php echo $row->nama_kategori;?></a>
						</li>
						<?php endforeach;?>
				    </ul>
				</div>
				<div class="blog-bottom">
					<h4>Latest Post</h4>
					<div class="about-team">
						<?php $new_post=$this->db->query("select * from tbl_posting order by id_posting desc limit 3");?>
							<?php foreach($new_post->result() as $row):?>
							<div class="client">
								<h5><span style="color:#3366FF;"><?php echo $row->judul_posting;?></span></h5>
								<div class="about-team-left">
									<a href="#"><img src="<?php echo base_url().$row->image;?>" title="<?php echo $row->judul_posting;?>"></a>
								</div>
								<div class="about-team-right">
									
									<?php echo word_limiter($row->isi_posting,20);?>
								</div>
								<div class="clear"> </div>
							</div>
							<?php endforeach;?>
						</div>
 			    </div>
 			        <div class="event-grid">
					  	<div id="datepicker"></div>
							<div class="clear"> </div>
				    </div>
 			    </div>	
 			 <div class="clear"></div>
		</div>
</div>

</body>
</html>
