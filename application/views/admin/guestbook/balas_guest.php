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
        Guestbook
    </h1>
</section>

        <!-- Main content -->
<section class="content">
	<div class="row">
       <div class="col-md-12">
           <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Balas Guestbook</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			<form class="form-horizontal" action="" method="post">
                <div class="box-body">
				  	<div class="row">
						<div class="col-md-6">
						
							<div class="form-group">
								<label class="col-sm-5 control-label">Nama Pengirim</label>
								<div class="col-sm-5">
								<input type="text" value="<?php echo $balasan->nama_lengkap;?>"  class="form-control"size="50" readonly="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-5 control-label">Tgl Guestbook</label>
								<div class="col-sm-5">
									<input type="text" value="<?php echo $balasan->tgl_guest;?>"  class="form-control" readonly="">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-5 control-label">Pesan Guestbook</label>
								<div class="col-sm-5">
									<textarea class="form-control"rows="5" disabled="disabled"><?php echo $balasan->pesan;?></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-sm-3 control-label">Tgl Balas</label>
								<div class="col-sm-5">
									<input type="text" id="datepicker" name="tgl_balas" value="<?php echo $balasan->tgl_balas;?>"  class="form-control">
									<input type="hidden" value="<?php echo $this->session->userdata('id_user');?>" name="id_user" />
									<input type="hidden" value="<?php echo $balasan->id_guest;?>" name="id_guest" />
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label">Balas Guest</label>
								<div class="col-sm-7">
									<textarea name="balasan" rows="5" class="form-control"><?php echo $balasan->balasan;?></textarea>
								</div>
							</div>
							<br />&nbsp;
							
							
						</div>
					</div>
					<div class="box-footer">
							<button type="submit" class="btn btn-primary"> Save</button>
							<a href="<?php echo site_url('admin/guestbook/index');?>" class="btn btn-danger">Cancel</a>
							</div>
				</div>
			</form>
	        </div>
		</div>
	</div>
</section>
</body>
</html>
