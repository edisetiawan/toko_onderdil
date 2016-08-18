
<div class="content-top">
<?php
 $offset = 1;
    $total = 0;
?>

	<div class="sellers">
		<h4><span><span>Konfirmasi Order</span></span></h4>
	</div>
		<div class="register-req">
			<p>Order anda akan segera kami proses, segera lakukan pembayaran sesuai metode pembayaran yang anda pilih</p>
		</div>
		<div class="sellers">
			<h4><span><span>Detil Order</span></span></h4>
		</div>
			<div class="table-responsive cart_info">
				<table id="example2" class="table table-bordered table-hover">
					<thead style="color:#FFFFFF;;background-color:#72afd2">
						<tr>
							<th style="text-align:center;"><label>NO</label></th>
							<th style="text-align:center;"><label>Item</label></th>
							<th style="text-align:center;"><label>Nama Barang</label></th>
							<th style="text-align:center;"><label>Harga</label></th>
							<th style="text-align:center;"><label>Jumlah</label></th>
							<th style="text-align:center;"><label>Sub Total</label></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;?>
						<?php foreach($detil_belanja as $row):?>
						<tr>
							<td style="text-align:center;"><?php echo $i++;?></td>
							<td class="cart_product">
								<a href=""><img style="height:60px;" src="<?php echo base_url().$row->image;?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $row->nama_produk;?></a></h4>
								<p>ID: <?php echo $row->produk_sku;?></p>
							</td>
							<td style="text-align:right;">
								<p><?php echo $this->fungsi->rupiah($row->harga);?></p>
							</td>
							<td style="text-align:center;">
								<div class="cart_quantity_button">
									<input class="cart_quantity_input" type="text" disabled="disabled" name="quantity" value="<?php echo $row->jml_order;?>" autocomplete="off" size="2">
								</div>
							</td>
							<td style="text-align:right;">
								<p class="cart_total_price">
									<?php $subtotal = $row->harga * $row->jml_order;?>
									<?php $total = $total + $subtotal;?>
									<?php if($row->metode = 1){?>
										<?php $biaya = $row->biaya;?>
									<?php }else{?>
										<?php $biaya = 0;?>
									<?php }?>
									<?php echo $this->fungsi->rupiah($subtotal);?>
								</p>
							</td>
						</tr>
						<?php endforeach;?>
						
						<tr>
							<td colspan="3">
								<?php $pembayaran=$this->db->query("SELECT metode FROM tbl_pembayaran ORDER BY id_order DESC LIMIT 1");?>
								<div class="register-req">
									<?php foreach($pembayaran->result() as $row):?>
									<p>Metode Pembayaran yang dipilih : 
										<?php if($row->metode == 1){?>
											<span>Transfer Bank </span>
										<?php }else{?>
											<span>Bayar Ditempat</span>
										<?php }?>
									</p>
									<p>
										<?php if($row->metode == 1){?>
											<span>Segera Lakukan Transfer ke Bank BRI </span><br />
											<span>No Rek : 675701000015507</span><br />
											<span>Atasnama : Sigit</span>
										<?php }else{?>
											<span>Pembayaran dilakukan apabila barang telah sampai ditempat anda <br />
												<font color="#0000FF">Jumlah pembayaran transfer harus sesuai dengan jumlah tagihan belanja.</font>
											</span>
										<?php }?>
									</p>
									<?php $metode = $row->metode;?>
									<?php endforeach;?>
								</div>
							</td>
							<td colspan="3">
								<table class="table table-condensed total-result" style=" background-color:#D7DBDE;">
									<tr>
										<td>Sub Total</td>
										<td>
											<?php echo $this->fungsi->rupiah($total);?>
										</td>
									</tr>
									<tr class="shipping-cost">
										<td>Biaya Kirim</td>
										<td><?php if($metode == 1){?>
											<?php echo $this->fungsi->rupiah($biaya);?>
											<?php }else{?>
												Rp. 0
											<?php }?>
										</td>										
									</tr>
									<tr>
										<td>Total Belanja</td>
										<td><span><?php echo $this->fungsi->rupiah($total + $biaya);?></span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
	</div>
</div>
