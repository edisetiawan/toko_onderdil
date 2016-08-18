<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
	$(function() {
		$("#datepicker").datepicker({
			dateFormat:'yy-mm-dd'
		});
	});
</script>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/themes/base/jquery.ui.all.css">

	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.datepicker.js"></script>

	<!--<script src="<?php echo base_url();?>public/js/jquery-1.8.2.js"></script>-->
	
</head>

<body>
<section class="content-header">
    <h1>
         Galeri
    </h1>
</section>

        <!-- Main content -->
<section class="content">
	<div class="row">
       <div class="col-md-12">
           <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Galeri</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
				<?php echo form_open_multipart('admin/galeri/add_galeri'); ?>
				  	<div class="row">
						<div class="col-md-8">
							<div class="form-group">
							  <label class="col-sm-3 control-label">Judul Galeri</label>
							  <div class="col-sm-9">
						<?php echo form_input(array('name'=>'judul_galeri','value'=>set_value('judul_galeri',isset($page['judul_galeri']) ? $page['judul_galeri'] : ''),'class'=>'form-control')); ?>
							  <font color="#FF0000"><?php echo form_error('judul_galeri');?></font>
		
							  </div>
							</div>
							<br />&nbsp;
							
							<div class="form-group">
							  <label class="col-sm-3 control-label">Tgl Posting</label>
							  <div class="col-sm-5">
						<input type="text" id="datepicker" class="form-control" name="tgl_posting">
							<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user');?>" />
							  <font color="#FF0000"><?php echo form_error('tgl_posting');?></font>
		
							  </div>
							</div>
							<br />&nbsp;
							<div class="form-group">
							  <label class="col-sm-3 control-label">Gambar</label>
							  <div class="col-sm-6">
									<?php echo form_upload('image');?>		
							  </div>
							</div>
							<br />&nbsp;
							<div class="form-group">
							  <label class="col-sm-3 control-label">Keterangan</label>
							  <div class="col-sm-8">
								<?php echo initialize_tinymce();?>
				<?php echo form_textarea(array('name' => 'keterangan', 'value' => set_value('keterangan', isset($page['keterangan']) ? $page['keterangan'] : ''),'class'=>'form-control')); ?>
							  <font color="#FF0000"><?php echo form_error('keterangan');?></font>
								<br />&nbsp;
							  </div>
							</div>

							<br />&nbsp;
							<div class="form-group">
								<label class="col-sm-3 control-label">&nbsp;</label>
								<div class="col-sm-8">
								<button type="submit" class="btn btn-success"> Save</button>
								<a href="<?php echo site_url('admin/galeri/index');?>" class="btn btn-danger">Cancel</a>
								</div>
							</div>
						</div>
					</div>
				<?php echo form_close(); ?>
				</div>
	        </div>
		</div>
	</div>
</section>
</body>
</html>
