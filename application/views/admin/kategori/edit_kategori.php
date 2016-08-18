<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<section class="content-header">
    <h1>
         Kategori
    </h1>
</section>

        <!-- Main content -->
<section class="content">
	<div class="row">
       <div class="col-md-12">
           <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Kategori</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			<form class="form-horizontal" action="" method="post">
                <div class="box-body">
				  	<div class="row">
						<div class="col-md-6">
							<div class="form-group">
							  <label class="col-sm-3 control-label">Kategori</label>
							  <div class="col-sm-6">
						<input type="text" class="form-control" value="<?php echo $kategori->nama_kategori;?>" name="nama_kategori">
							  <font color="#FF0000"><?php echo form_error('nama_ketegori');?></font>
		
							  </div>
							</div>
							<br />&nbsp;
							
							<div class="box-footer">
							<button type="submit" class="btn btn-primary"> Save</button>
							<a href="<?php echo site_url('admin/kategori/index');?>" class="btn btn-danger">Cancel</a>
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
