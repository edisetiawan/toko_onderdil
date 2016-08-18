<div class="content-top">
	<div class="sellers">
		<h4><span><span>Data Belanja</span></span></h4>
	</div>
    <div class="section group">
			<div class="table-responsive cart_info">
				<table id="example2" class="table table-bordered table-hover">
					<thead style="color:#FFFFFF;;background-color:#72afd2">
						<tr class="cart_menu">
							<th style="text-align:center;"><label>No Transaksi</label></th>
							<th style="text-align:center;"><label>Tanggal</label></th>
							<th style="text-align:center;"><label>Total Tagihan</label></th>
							<th style="text-align:center;"><label>Pembayaran</label></th>
							<th style="text-align:center;"><label>Status Pembayaran</label></th>
							<th style="text-align:center;"><label>Status Order</label></th>
							<th style="text-align:center;"><label>Aksi</label></th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;?>
						<?php foreach($order as $row):?>
						<tr>
							<td class="cart_product">
								<?php echo $row->no_order;?>
							</td>
							<td class="cart_description">
								<?php echo $row->tgl_order;?>
							</td>
							<td style="text-align:right;" class="cart_price">
								<span class="cart_total_price">
									<?php echo $this->fungsi->rupiah($row->tagihan);?></span>
							</td>
							<td class="cart_quantity">
								<?php if($row->metode == 1){?>
									<span>Transfer Bank</span>
								<?php }else{?>
									<span>Bayar Ditempat (COD)</span>
								<?php }?>
							</td>
							<td><?php if($row->status_bayar == "Kurang"){?>
									<label style="text-align:center;" class="bg-danger btn-block"><?php echo $row->status_bayar;?></label>
								<?php }else{?>
									<label style="text-align:center;" class="bg-success btn-block"><?php echo $row->status_bayar;?></label>
								<?php }?>
							</td>
							<td class="cart_total">
								<?php if($row->status_order == 1){?>
									Menunggu
								<?php }elseif($row->status_order == 2){?>
									Sudah Dikirim
								<?php }else{?>
									Batal
								<?php }?>
							</td>
							<td style="text-align:center;">
								
								<a class="btn btn-sm btn-primary" href="<?php echo site_url('order_pesanan/detil_order/'.$row->id_order);?>"><i class="glyphicon glyphicon-print"></i> Detil</a>
								
								<?php if($row->metode == 1 and $row->status_bayar == "Kurang"){?>
									&nbsp; <a class="btn btn-sm btn-danger" href="<?php echo site_url('pembayaran/bayar_order/'.$row->id_bayar);?>"><i class="glyphicon glyphicon-credit-card"></i> Bayar</a>
								<?php }elseif($row->metode == 2 and $row->status_bayar == "Kurang"){?>
									&nbsp; <button disabled="disabled" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-credit-card"></i> COD &nbsp;&nbsp;</button>
								<?php }else{?>
									&nbsp; <button disabled="disabled" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-credit-card"></i> Lunas</button>
								<?php }?>
								
							</td>
						</tr>
						<?php endforeach;?>
						
					</tbody>
				</table>
			</div>
			<div class="row">
				<ul class="pagination">
					<li><?php echo $this->pagination->create_links();?></li>
				</ul>							
			</div>
			<div class="clear"></div> 
	</div>
</div>
</div>