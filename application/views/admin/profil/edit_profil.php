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
         Profil Gemini Futsal
    </h1>
</section>

        <!-- Main content -->
<section class="content">
	<div class="row">
       <div class="col-md-12">
           <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Profil</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
				<?php echo form_open_multipart('admin/profil/edit_profil'); ?>
				  	<div class="row">
						<div class="col-md-8">
						
							<div class="form-group">
							  <label class="col-sm-3 control-label">Judul Profil</label>
							  <div class="col-sm-5">
						<?php echo form_input(array('name'=>'judul_profil','value'=>set_value('judul_profil',isset($profil['judul_profil']) ? $profil['judul_profil'] : ''),'class'=>'form-control')); ?>
							  <font color="#FF0000"><?php echo form_error('judul_profil');?></font>
							  </div>
							</div>
							<br />&nbsp;
							
							<div class="form-group">
							  <label class="col-sm-3 control-label">Tgl Posting</label>
							  <div class="col-sm-5">
						<input type="text" id="datepicker" value="<?php echo $profil['tgl_posting'];?>" class="form-control" name="tgl_posting">
							<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user');?>" />
							<input type="hidden" name="id_profil" value="<?php echo $profil['id_profil'];?>" />
							  <font color="#FF0000"><?php echo form_error('tgl_posting');?></font>
		
							  </div>
							</div>
							<br />&nbsp;
							<div class="form-group">
							  <label class="col-sm-3 control-label">Gambar</label>
							  <table width="50%">
							  	<tr>
							  <div class="col-sm-0">							  

									<td>
									&nbsp;&nbsp;&nbsp;
										
										<?php if($profil['image'] == ""){?>
					  
									  <?php }else{?>
									  <img src="<?php echo base_url().$profil['image'];?>"width="40" height="30" />
									  <?php }?>
									</td>
									<td valign="bottom">
							  <?php echo form_upload('image');?>	
									</td>
							  </div>
							  		
								</tr>
							</table>
							</div>			

							<div class="form-group">
							  <label class="col-sm-3 control-label">Isi Profil</label>
							  <div class="col-sm-8">
								<?php echo initialize_tinymce();?>
				<?php echo form_textarea(array('name' => 'isi_profil', 'value' => set_value('isi_profil', isset($profil['isi_profil']) ? $profil['isi_profil'] : ''),'class'=>'form-control')); ?>
							  <font color="#FF0000"><?php echo form_error('isi_profil');?></font>
								<br />&nbsp;
							  </div>
							</div>

							<br />&nbsp;
							<div class="form-group">
								<label class="col-sm-3 control-label">&nbsp;</label>
								<div class="col-sm-8">
								<button type="submit" class="btn btn-success"> Save</button>
								<a href="<?php echo site_url('admin/profil/index');?>" class="btn btn-danger">Cancel</a>
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
