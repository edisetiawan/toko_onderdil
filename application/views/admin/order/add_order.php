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
         Sewa Lapangan
    </h1>
</section>

        <!-- Main content -->
<section class="content">
	<div class="row">
       <div class="col-md-12">
           <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Sewa Lapangan</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
			<form class="form-horizontal" action="<?php echo site_url('admin/sewa/add_sewa');?>" method="post">
                <div class="box-body">
				  	<div class="row">
						<div class="col-md-12">
						<table width="90%">
							<tr>
								<td>
								<?php $nota = $this->Msewa->autoKode();?>
									  <?php if(!empty ($nota )){
											foreach($nota as $row):
												$angka = $row->no_sewa + 1;
											endforeach;
										}else{
											$angka = 1;
										}
											$hasil = str_pad($angka,6,"0", STR_PAD_LEFT) ;
											$no_nota = $hasil;?>
										<?php 				
											$id = $this->session->userdata('id_sewa');
										?>
								<div class="form-group">
								  <label class="col-sm-4 control-label">No Sewa</label>
								  <div class="col-sm-5">
									<input type="text" readonly=""required="required" name="no_sewa" value="S-<?php echo $no_nota;?>" class="form-control">
								  <font color="#FF0000"><?php echo form_error('no_sewa');?></font>
								  </div>
								</div>
								<br />
								
								<div class="form-group">
								  <label class="col-sm-4 control-label">Tgl Sewa</label>
								  <div class="col-sm-5">
									<input type="text" id="datepicker" name="tgl_sewa"required="required" value="" class="form-control">
									
								  <font color="#FF0000"><?php echo form_error('tgl_sewa');?></font>
			
								  </div>
								</div>
								<br />
								
								<div class="form-group">
								  <label class="col-sm-4 control-label">Nama Tim</label>
								  <div class="col-sm-5">
									<input type="text" required="required" name="nama_tim" class="form-control">	
									<?php $waktu =  date('H:i:s');?>
												
									<?php if($waktu > '17:00:00'){?>
										<input type="hidden" name="id_tarif" value="2" />
									<?php }else{?>
										<input type="hidden" name="id_tarif" value="1" />
									<?php }?>
									<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user');?>" />	
								  </div>
								</div>
								<br />
								
								<div class="form-group">
									<label class="col-sm-4 control-label">No Telp</label>
									<div class="col-sm-5">
									<input type="text" name="no_telp" class="form-control">
									</div>
								</div>
								<br />	
								</td>
								<td valign="top">
								<div class="form-group">
								  <label class="col-sm-3 control-label">Durasi</label>
								  <div class="col-sm-5">
									<select name="durasi" class="form-control">
										<option value="none">--Pilih Durasi--</option>
										<option value="01:00:00">1 Jam</option>
										<option value="02:00:00">2 Jam</option>
										<option value="03:00:00">3 Jam</option>
									</select>
									
								  <font color="#FF0000"><?php echo form_error('durasi');?></font>
			
								  </div>
								</div>
								<br />
								
								<div class="form-group">
								  <label class="col-sm-3 control-label">Jam Sewa</label>
								  <div class="col-sm-5">
								  	<?php $waktu = date('H:i:s');?>
									
									<select name="jam_mulai" class="form-control">
										<option value="none">--Pilih Jam--</option>
										<?php foreach($jam1 as $row):?>
										<option value="<?php echo $row->jam_mulai;?>"><?php echo $row->jam_mulai;?></option>
										<?php endforeach;?>
									</select>	
									 <font color="#FF0000"><?php echo form_error('jam_mulai');?></font>
								  </div>
								</div>
								<br />
								
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Status Sewa</label>
									<div class="col-sm-5">
									
										<select name="status_sewa"class="form-control">
											<option value="0">--Pilih Status--</option>
											<option value="1">Disewa</option>
											<option value="2">Dibatalkan</option>
										</select>
										 <font color="#FF0000"><?php echo form_error('status_sewa');?></font>
									</div>
								</div>
								<br />	
								
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="box-footer">
										<button type="submit" class="btn btn-primary"> Simpan</button>
										<a href="<?php echo site_url('admin/sewa/index');?>" class="btn btn-danger">Batal</a>
									</div>
								</td>
							</tr>
						</table>
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
