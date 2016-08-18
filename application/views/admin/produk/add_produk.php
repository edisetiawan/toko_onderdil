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
         Produk
    </h1>
</section>

        <!-- Main content -->
<section class="content">
	<div class="row">
       <div class="col-md-12">
           <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Produk</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
				<?php echo form_open_multipart('admin/produk/add_produk'); ?>
				  	<div class="row">
						<div class="col-md-12">
							<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <label class="col-sm-3 control-label">Kategori</label>
								  <div class="col-sm-6">
									<select name="id_kategori_produk" class="form-control">
										<option value="none">--Pilih Kategori--</option>
										<?php foreach($kategori as $row):?>
										<option value="<?php echo $row['id_kategori_produk'];?>"><?php echo $row['nama_kategori'];?></option>
										<?php endforeach;?>
									</select>
								  </div>
								</div>
								<br />&nbsp;
								<div class="form-group">
								  <label class="col-sm-3 control-label">Nama Produk</label>
								  <div class="col-sm-6">
							<?php echo form_input(array('name'=>'nama_produk','value'=>set_value('nama_produk',isset($page['nama_produk']) ? $page['nama_produk'] : ''),'class'=>'form-control')); ?>
								  <font color="#FF0000"><?php echo form_error('nama_produk');?></font>
			
								  </div>
								</div>
								<br />&nbsp;
								
								<div class="form-group">
								  <label class="col-sm-3 control-label">Kode Produk</label>
								  <div class="col-sm-4">
									<input type="text"  class="form-control" name="produk_sku">
								  <font color="#FF0000"><?php echo form_error('produk_sku');?></font>
			
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
								  <label class="col-sm-3 control-label">JML Stok</label>
								  <div class="col-sm-3">
									<input type="text"  class="form-control" name="jml">
								  <font color="#FF0000"><?php echo form_error('jml');?></font>
			
								  </div>
								</div>
								<br />&nbsp;
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label class="col-sm-3 control-label">Suplier</label>
								  <div class="col-sm-6">
									<?php $suplier = $this->db->query("select * from tbl_suplier order by nama_Suplier asc");?>
									<select name="id_suplier" class="form-control">
										<option value="none">--Pilih Suplier--</option>
										<?php foreach($suplier->result() as $row):?>
										<option value="<?php echo $row->id_suplier;?>"><?php echo $row->nama_suplier;?></option>
										<?php endforeach;?>
									</select>
								  <font color="#FF0000"><?php echo form_error('suplier');?></font>
			
								  </div>
								</div>
								<br />&nbsp;
								<div class="form-group">
								  <label class="col-sm-3 control-label">Manufaktur</label>
								  <div class="col-sm-6">
									<input type="text"  class="form-control" name="manufaktur">
								  <font color="#FF0000"><?php echo form_error('manufaktur');?></font>
			
								  </div>
								</div>
								
								<br />&nbsp;
								<div class="form-group">
								  <label class="col-sm-3 control-label">Harga Beli</label>
								  <div class="col-sm-4">
									<input type="text"  class="form-control" name="harga_beli">
								  <font color="#FF0000"><?php echo form_error('harga_beli');?></font>
			
								  </div>
								</div>
								<br />&nbsp;
								<div class="form-group">
								  <label class="col-sm-3 control-label">Harga Jual</label>
								  <div class="col-sm-4">
									<input type="text"  class="form-control" name="harga">
								  <font color="#FF0000"><?php echo form_error('harga');?></font>
			
								  </div>
								</div>
								<br />&nbsp;
							</div>
							</div>
							
							<div class="row">
							<div class="col-md-6">
								
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
									<a href="<?php echo site_url('admin/produk/index');?>" class="btn btn-danger">Cancel</a>
									</div>
								</div>
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
