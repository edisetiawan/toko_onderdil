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
         Pembayaran
    </h1>
</section>

        <!-- Main content -->
<section class="content">
	<div class="row">
       <div class="col-md-12">
           <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Pembayaran</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			<?php echo form_open_multipart('admin/pembayaran/edit_pembayaran'); ?>
                <div class="box-body">
				  	<div class="row">
						<div class="col-md-12">
						<table width="90%">
							<tr>
								<td>
								<div class="form-group">
								  <label class="col-sm-4 control-label">No Order</label>
								  <div class="col-sm-5">
									<input type="hidden" name="id_order" value="<?php echo $pembayaran['id_order'];?>" />
									
									<?php 
										$id_order = $pembayaran['id_order'];
										$query=$this->db->query("select * from tbl_order where id_order = $id_order");?>
									<?php foreach($query->result() as $data):?>
									<input type="text" readonly=""required="required" value="<?php echo $data->no_order;?>" class="form-control">
									<?php endforeach;?>

									
								  <font color="#FF0000"><?php echo form_error('no_order');?></font>
			
								  </div>
								</div>
								<br />&nbsp;
								
								<div class="form-group">
								  <label class="col-sm-4 control-label">Tagihan</label>
								  <div class="col-sm-5">
									<input type="text" readonly=""required="required" value="<?php echo $this->fungsi->rupiah($pembayaran['tagihan']);?>" class="form-control">
									<input type="hidden" name="tagihan" value="<?php echo $pembayaran['tagihan'];?>" />
								  <font color="#FF0000"><?php echo form_error('tagihan');?></font>
			
								  </div>
								</div>
								<br />&nbsp;
								
								<div class="form-group">
								  <label class="col-sm-4 control-label">Bayar</label>
								  <div class="col-sm-5">
									<input type="text" readonly=""required="required" value="<?php echo $this->fungsi->rupiah($pembayaran['jml_bayar']);?>" class="form-control">		
								  </div>
								</div>
								<br />&nbsp;
								
								<div class="form-group">
									<label class="col-sm-4 control-label">Kekurangan</label>
									<div class="col-sm-5">
									<?php $kekurangan = $pembayaran['tagihan'] - $pembayaran['jml_bayar'] ;?>
										<input type="text" readonly=""required="required" value="<?php echo $this->fungsi->rupiah($kekurangan);?>" class="form-control">
									</div>
								</div>
								<br />	
								</td>
								<td valign="top">
								<?php if($pembayaran['metode'] == 1){?>
								<div class="form-group">
								  <label class="col-sm-4 control-label">No Transfer / Bayar</label>
								  <div class="col-sm-5">
									<input type="text" name="no_transfer"required="required" value="<?php echo $pembayaran['no_transfer'];?>" class="form-control">
									
								  <font color="#FF0000"><?php echo form_error('no_transfer');?></font>
			
								  </div>
								</div>
								<br />&nbsp;
								
								<div class="form-group">
								  <label class="col-sm-4 control-label">Bukti Transfer</label>
								  <div class="col-sm-5">
								  	<table width="50%">
										<tr>
											<td>
											&nbsp;&nbsp;&nbsp;
											<?php if($pembayaran['image'] == ""){?>
											  <?php }else{?>
											  <img src="<?php echo base_url().$pembayaran['image'];?>"width="40" height="30" />
											  <?php }?>
											</td>
											<td valign="bottom">
									 			 <?php echo form_upload('image');?>	
											</td>
										</tr>
									</table>
								  </div>
								</div>
								<br />&nbsp;
								
								<?php }else{?>
								
								<?php }?>
								<div class="form-group">
								  <label class="col-sm-4 control-label">Tgl Transfer / Bayar</label>
								  <div class="col-sm-5">
									<input type="text" id="datepicker" name="tgl_bayar"required="required" value="<?php echo $pembayaran['tgl_bayar'];?>" class="form-control">		
								  </div>
								</div>
								<br />&nbsp;

								<div class="form-group">
									<label class="col-sm-4 control-label">Jml Bayar</label>
									<div class="col-sm-5">
									
									<select name="jml_bayar" class="form-control">
										<option value="<?php echo $pembayaran['tagihan'];?>"><?php echo $this->fungsi->rupiah($pembayaran['tagihan']);?></option>
									</select>
									</div>
								</div>
								<br />	&nbsp;
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="box-footer">
										<button type="submit" class="btn btn-primary"> Simpan</button>
										<a href="<?php echo site_url('admin/pembayaran/index');?>" class="btn btn-danger">Batal</a>
									</div>
								</td>
							</tr>
						</table>
						</div>
					</div>
				</div>
			<?php form_close();?>		
	        </div>
		</div>
	</div>
</section>
</body>
</html>
