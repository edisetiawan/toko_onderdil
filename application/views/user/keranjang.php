<?php 
		if(isset($_SESSION['pos']) ){
			$id_biaya		= $_SESSION['pos']['id_biaya'];
			$metode			= $_SESSION['pos']['metode'];
			$alamat			= $_SESSION['pos']['alamat_kirim'];
		}else{
			$id_biaya ='';
			$metode	='';
			$alamat	='';
		}
	?>
<script type="text/javascript">
function tampil_alamat(param){
	if(param==1)
		document.getElementById("templatealamat").style.visibility = 'visible';
	else
		document.getElementById("templatealamat").style.visibility = 'hidden';
}
</script>


<div class="content-top">
	<div class="sellers">
		<h4><span><span>Keranjang  Belanja</span></span></h4>
	</div>
    <div class="section group">
		<?php echo form_open('cart/update_keranjang'); ?>
		<div class="table-responsive cart_info">
			<table id="example2" class="table table-bordered table-hover">
				<thead style="color:#FFFFFF;;background-color:#72afd2">
					<tr>
						<th style="text-align:center;">Item</th>
						<th style="text-align:center;">Nama Barang</th>
						<th style="text-align:center;">Harga</th>
						<th style="text-align:center;">Jumlah</th>
						<th style="text-align:center;">Total</th>
						<th style="text-align:center;">Hapus</th>
					</tr>
				</thead>
				<tbody>
				<?php if($this->cart->total_items() > 0): ?>
				<?php $i = 1; ?>
				<?php foreach($this->cart->contents() as $items): ?>
					<tr>
						<td class="cart_product">
							<?php $id= $items['id'];
								$kode=$this->db->query("select * from tbl_produk where id_produk = $id");?>
							<?php foreach($kode->result_array() as $row):?>
								<img style="height:60px;" src="<?php echo base_url().$row['image'];?>" alt="">
								<?php echo form_hidden('jml[]', $row['jml']); ?>
							<?php endforeach;?>
						</td>
						<td class="cart_description">
							<h4><a href=""><?php echo $items['name'];?></a></h4>
								<?php $id= $items['id'];
									$kode=$this->db->query("select * from tbl_produk where id_produk = $id");?>
									<?php foreach($kode->result_array() as $row):?>
								<p><?php echo $row['produk_sku'];?></p>
									<?php endforeach;?>
						</td>
						<td style="text-align:right;">
								<p>Rp. <?php echo $this->cart->format_number($items['price']); ?></p>
						</td>
						<td style="text-align:center;">
							<div class="cart_quantity_button">
								<?php echo form_hidden('rowid[]', $items['rowid']); ?>
								
								
							  <?php /*echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '2','class'=>'cart_quantity_input')); */?>

								<input class="cart_quantity_input" type="text" name="qty[]" value="<?php echo $items['qty'];?>" autocomplete="off" size="2" onkeyup="this.form.submit()">
							</div>
						</td>
						<td style="text-align:right;">
							<p class="cart_total_price">Rp <?php echo $this->cart->format_number($items['subtotal']); ?></p>
						</td>
						<td style="text-align:center;">
							<a class="btn btn-xs btn-danger " onclick="return confirm('Anda Yakin ?')"href="<?php echo base_url(); ?>cart/hapus_keranjang/<?php echo $items['rowid']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
						</td>
					</tr>
					<?php $i++; ?>
					<?php endforeach; ?>
					<tr>
					<?php echo form_close()?>
					</tr>
				<?php endif;?>
					<?php if($this->cart->total_items() < 1):?>
					<tr>
						<td colspan="5">No item in your cart.</td>
					</tr>
					<?php endif;?>				
				</tbody>
			</table>
		</div>
		<?php echo form_close();?>
		<div class="clear"></div> 
	</div>
</div>
<div class="content-top">
	<div class="sellers">
		<h4><span><span>Ikuti Langkah Selanjutnya</span></span></h4>
	</div>
    <div class="section group">
		<label>Silahkan isi alamat pengiriman untuk pesanan anda dengan lengkap dan jelas.</label>
			
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<?php echo form_open('cart/biaya_kirim')?>
						<table style="width:100%;">
							<tr>
								<td colspan="2">
									<div class="col-sm-12">
									<label>Alamat Pengiriman</label>
										<div class="shopper-info">
											<textarea class="form-control" rows="3" name="alamat_kirim"><?php echo $alamat;?></textarea>
										</div>
									</div>
									
								</td>
							</tr>
						</table>
						<br />
						<label>Pilih metode Pembayaran </label>
						<table style="width:100%;">
							<tr>
								<td>
									<input name="metode" type="radio" value="1"<?php if($metode == 1)echo 'checked';?> onclick="tampil_alamat(1);"/><label>Transfer Bank</label>
								</td>
								<td style=" vertical-align:top;">
									<?php if($metode == 1){?>
									<fieldset id="templatealamat" >
										<label>Pilih Kota</label>
												
										<?php $query = $this->db->query("SELECT * FROM tbl_biaya_kirim WHERE id_biaya NOT IN('666') ORDER BY nama_kota ASC");?>
										<select name="id_biaya" onChange="this.form.submit()">
											<option value="">Pilih Kota Tujuan</option>
											<?php foreach($query->result() as $bk):?>
											<option value="<?php echo $bk->id_biaya;?>"
											<?php if($this->session->userdata('id_biaya') == $bk->id_biaya)echo 'selected';?> >
											<?php echo $bk->nama_kota;?>
											</option>
											<?php endforeach ?>
										</select>
									</fieldset>
									<?php }else{?>
									<fieldset id="templatealamat" style="visibility: hidden;">
										<label>Pilih Kota</label>
												
										<?php $query = $this->db->query("SELECT * FROM tbl_biaya_kirim WHERE id_biaya NOT IN('666') ORDER BY nama_kota ASC");?>
										<select name="id_biaya" onChange="this.form.submit()">
											<option value="">Pilih Kota Tujuan</option>
											<?php foreach($query->result() as $bk):?>
											<option value="<?php echo $bk->id_biaya;?>"
											<?php if($this->session->userdata('id_biaya') == $bk->id_biaya)echo 'selected';?> >
											<?php echo $bk->nama_kota;?>
											</option>
											<?php endforeach ?>
										</select>
									</fieldset>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td>
								<input name="metode" type="radio" value="2" <?php if($metode == 2)echo 'checked';?> onclick="tampil_alamat(0); this.form.submit()"/>
								<label>Pembayaran Ditempat (COD)</label>
								</td>
								<td></td>
							</tr>
						</table>
						<?php echo form_close()?>
					</div>
				</div>
				
				<div class="col-sm-6">
				<form action="<?php echo site_url('order_pesanan/add_order');?>" method="post">
					<div class="total_area" >
					  <?php if(!empty ($nota)){
								foreach($nota as $row):
									$kode = $row->no_order + 1;
								endforeach;
							}else{
								$kode = 1;
							}
							$hasil = str_pad($kode,7,"0", STR_PAD_LEFT) ;
							$no_nota = $hasil;?>
						<?php 				
							$id = $this->session->userdata('id_order');
						?>
						<ul class="categories" style=" background-color:#D7DBDE;">
							<li class="firstItem">
								<label class="col-sm-3 control-label">No Order</label>
								<span>NO-<?php echo $no_nota;?></span>
								<input name="metode" type="hidden" value="<?php echo $metode;?>" />
								<textarea name="alamat_kirim" style="display:none;"><?php echo $alamat;?></textarea>
								
								<input type="hidden" name="no_order" value="NO-<?php echo $no_nota;?>" />
							</li> 
							<li>
								<label class="col-sm-3 control-label">Sub Total </label>
								
								<span>
									<?php $totalbelanja = $this->cart->total();
										echo $this->fungsi->rupiah($totalbelanja);
									  $this->session->set_userdata('sesi_totalbelanja', $totalbelanja);
									  ?>
					  			</span>
								
							</li>
							<li>
								<label class="col-sm-3 control-label">Biaya Kirim </label>
								<?php if($metode == 2){?>
									<span>Rp. 0</span>
									<input type="hidden" name="kode_biaya" value="666" />
								<?php }else{?>
									<span><?php echo $this->fungsi->rupiah($this->session->userdata('sesi_biayakirim'));?></span>
									<input type="hidden" name="kode_biaya" value="<?php echo $this->session->userdata('id_biaya');?>" />
								<?php }?>
							</li>
							<li>
								<label class="col-sm-3 control-label">Total </label>
								<span>
									<?php $total = $this->cart->total() + $this->session->userdata('sesi_biayakirim');
										echo $this->fungsi->rupiah($total);
										$this->session->set_userdata('tot_tagihan',$total);
									?>
								</span>
								<input type="hidden" name="tagihan" value="<?php echo $total;?>" />
							</li>
						</ul>
							<a class="btn btn-primary update" href="<?php echo site_url('produk/index');?>">Lanjut Belanja</a>
							<button type="submit" class="btn btn-success check_out pull-right">Selesai Belanja</button>
							
					</div>
				</form>
			</div>
		</div>
		<div class="clear"></div> 
	</div>
</div>
	
</div>