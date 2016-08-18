	

<link rel="stylesheet" href="<?php echo base_url();?>public/js/themes/base/jquery.ui.all.css">
	<script src="<?php echo base_url();?>public/js/jquery-1.8.2.js"></script>
	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.datepicker.js"></script>
	<script>
	$(function() {
		$("#datepicker").datepicker({
			dateFormat:'yy-mm-dd'
		});
	});
	</script>
<div class="content-top">
	<div class="sellers">
		<h4><span><span>Konfirmasi Pembayaran</span></span></h4>
	</div>
   
			<?php echo form_open_multipart('pembayaran/bayar_order'); ?>
                 <div class="section group">
				  	<div class="row">
						<div class="col-md-12">
						<table width="90%">
							<tr>
								<td>
								<div class="form-group">
								  <label class="col-sm-4 control-label">No Order</label>
								  <div class="col-sm-5">
								  <?php $id_order = $pembayaran['id_order'];
								  
								  $detil = $this->db->query("select * from tbl_order where id_order = '$id_order' ");?>
								  <?php foreach($detil->result() as $row):?>
									<input type="text" readonly=""required="required" value="<?php echo $row->no_order;?>" class="form-control">
								  <?php endforeach;?>
									<input type="hidden" name="id_order" value="<?php echo $pembayaran['id_order'];?>" />
									
									
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
								  <table width="50%">
									<tr>
								  <div class="col-sm-0">							  
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
								  </div>
									</tr>
								</table>
								</div>
								

								<div class="form-group">
								  <label class="col-sm-4 control-label">Tgl Transfer / Bayar</label>
								  <div class="col-sm-5">
									<input type="text" id="datepicker" name="tgl_bayar"required="required" value="<?php echo $pembayaran['tgl_bayar'];?>" class="form-control">		
									<div id="datepicker"></div>
								  </div>
								</div>
								<br />&nbsp;

								<div class="form-group">
									<label class="col-sm-4 control-label">Jml Bayar</label>
									<div class="col-sm-5">
									<?php /*<input type="text" name="jml_bayar"required="required" value="<?php echo $pembayaran['jml_bayar'];?>" class="form-control">*/?>
									<select name="jml_bayar" class="form-control">
										<option value="<?php echo $pembayaran['tagihan'];?>"><?php echo $this->fungsi->rupiah($pembayaran['tagihan']);?></option>
									</select>	
									</div>
								</div>
								<br />	&nbsp;
								<div class="form-group">
									<label class="col-sm-4 control-label"></label>
									<div class="col-sm-8">
										<span>Segera Lakukan Transfer ke Bank BRI </span><br />
											<span>No Rek : 675701000015507</span><br />
											<span>Atasnama : Sigit</span><br />
										<font color="#0000FF">Jumlah pembayaran transfer harus sesuai dengan jumlah tagihan belanja.</font>
									</div>
								</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<br />
							<button type="submit" class="btn btn-success "><i class="fa fa-save"></i> &nbsp; Simpan</button>
							<a href="<?php echo site_url('order_pesanan/index');?>" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i> Batal</a>
									
								</td>
							</tr>
						</table>
						</div>
					</div>
				</div>
			<?php form_close();?>		
				
	</div>
</div>