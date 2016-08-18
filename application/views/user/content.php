		<div class="banner">
			<?php echo $this->load->view('user/banner');?>
		</div>
		<div class="content-top">
	    	<div class="sellers">
	    		<h4><span><span>Produk</span> Terbaru</span></h4>    	
	    	</div>
    	   <div class="section group">
		   		<?php foreach($new_produk as $row):?>
				<div class="col_1_of_4 span_1_of_4">
					<div class="product-desc">
						<a data-lightbox="example-1"data-title="<?php echo $row->nama_produk;?>" title="<?php echo $row->nama_produk;?>" href="<?php echo base_url().$row->image;?>">
						<img style="height:150px; width:100%; text-align:center;" src="<?php echo base_url().$row->image;?>" alt=""/></a>
						<h5><?php echo $row->nama_produk;?></h5>
						<span>Stok : <?php if($row->jml == 0){?>
									<font color="#FF0000">Habis</font>
									<?php }else{?>
										<?php echo $row->jml;?>
									<?php }?>
							</span>
					</div>
					<div class="prod-inner">
						<span class="price"><?php echo $this->fungsi->rupiah($row->harga);?></span>
							<form action="<?php echo site_url('cart/add_cart');?>" method="post">
								<input type="hidden" name="id_produk" value="<?php echo $row->id_produk;?>" />
								<input type="hidden" name="nama_produk" value="<?php echo $row->nama_produk;?>"/>								
								<input type="hidden"name="harga" value="<?php echo $row->harga;?>" />
								<input type="hidden" name="banyak" value="1" />
							<?php if($this->session->userdata('id_level')== 3){?>
								<button type="submit" class="btn btn-mini btn-primary pull-right"><i class="glyphicon glyphicon-shopping-cart"></i> Beli</button>
							<?php }else{?>
								<?php if($row->jml == 0){?>
								
								<?php }else{?>
									<a class="btn btn-mini btn-primary pull-right" rel="nofollow" href="<?php echo site_url('member/login');?>" onclick="alert('Anda Belum login sebagai Member !')"><i class="glyphicon glyphicon-shopping-cart"></i> Beli</a>
								<?php }?>
							<?php }?>
							</form>
						<div class="clear"></div> 
					</div>
				</div>			
				<?php endforeach;?>
				<div class="clear"></div> 
			</div>
		</div>
		<div class="content-top">
	    	<div class="sellers">
	    		<h4><span><span>Featured</span> Products</span></h4>    	
	    	</div>
    	   <div class="section group">
		   		<?php foreach($produk_sejenis as $row):?>
				<div class="col_1_of_4 span_1_of_4">
					<div class="product-desc">
						<a data-lightbox="example-1"data-title="<?php echo $row->nama_produk;?>" title="<?php echo $row->nama_produk;?>" href="<?php echo base_url().$row->image;?>">
						<img style="height:150px; width:100%; text-align:center;" src="<?php echo base_url().$row->image;?>" alt=""/></a>
						<h5><?php echo $row->nama_produk;?></h5>
						<span>Stok : <?php echo $row->jml;?></span>
					</div>
					<div class="prod-inner">
						<span class="price"><?php echo $this->fungsi->rupiah($row->harga);?></span>
							<form action="<?php echo site_url('cart/add_cart');?>" method="post">
								<input type="hidden" name="id_produk" value="<?php echo $row->id_produk;?>" />
								<input type="hidden" name="nama_produk" value="<?php echo $row->nama_produk;?>"/>								
								<input type="hidden"name="harga" value="<?php echo $row->harga;?>" />
								<input type="hidden" name="banyak" value="1" />
							<?php if($this->session->userdata('id_level')== 3){?>
							<button type="submit" class="btn btn-mini btn-primary pull-right"><i class="glyphicon glyphicon-shopping-cart"></i> Beli</button>
							<?php }else{?>
								<?php if($row->jml == 0){?>
								
								<?php }else{?>
									<a class="btn btn-mini btn-primary pull-right" rel="nofollow" href="<?php echo site_url('member/login');?>" onclick="alert('Anda Belum login sebagai Member !')"><i class="glyphicon glyphicon-shopping-cart"></i> Beli</a>
								<?php }?>
							<?php }?>
							</form>
						<div class="clear"></div> 
					</div>
				</div>			
				<?php endforeach;?>
				<div class="clear"></div> 
			</div>
		</div>
		    <div class="content-bottom">
				<div class="col_1_of_3 span_1_of_3">
					<div class="banner-wrap bottom_banner color_link">
						<a href="#" class="main_link">
						<figure><img src="<?php echo base_url();?>motor/web/images/delivery.png" alt=""/></figure>
						<h5><span>Kirim Pesanan</span><br>Lihat Daftar Kota.</h5><p>Kami Melayani Pengiriman Order Maupun COD.</p></a>
					</div>
				</div>
				<div class="col_1_of_3 span_1_of_3">
					<div class="banner-wrap bottom_banner">
						<a href="#" class="main_link">
						<figure><img src="<?php echo base_url();?>motor/web/images/phone.png" alt=""/></figure><h5>Call Center <br><span>0888-2802-2928</span></h5><p>Buka Senin-Sabtu Jam 09:00 - 17:00 WIB<br>
						</p></a>
					</div>
				</div>
				<div class="col_1_of_3 span_1_of_3">
					<div class="banner-wrap bottom_banner color_dark">
						<a href="#" class="main_link">
						<figure><img src="<?php echo base_url();?>motor/web/images/gift.png" alt=""/></figure><h5>Discount</h5><p>Choose from any of our extensive range </p></a>
					</div>
				</div>
				<div class="clear"></div> 
			</div>
</div>