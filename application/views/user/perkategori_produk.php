<div class="single">
	<div class="content-top">
		<div class="content span_1_of_2" style="padding:1px;">	
	    	<div class="sellers">
	    		<h4><span><span>Produk</span></span></h4>    	
	    	</div>
		   		<?php foreach($produk as $row):?>
				<div class="section group">
					<div class="col_1_of_4 span_1_of_3" style="margin-right:1%;">
						<div class="product-desc">
							<a data-lightbox="example-1"data-title="<?php echo $row->nama_produk;?>, <?php echo $row->keterangan;?>" title="<?php echo $row->nama_produk;?>" href="<?php echo base_url().$row->image;?>">
							<img style="height:150px; width:100%;" src="<?php echo base_url().$row->image;?>" alt="<?php echo $row->keterangan;?>"></a>
							<h5 style="text-align:center;"><?php echo $row->nama_produk;?></h5>
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
								<?php if($row->jml == 0){?>
								
								<?php }else{?>
								<button type="submit" class="btn btn-mini btn-primary pull-right"><i class="glyphicon glyphicon-shopping-cart"></i> Beli</button>
								<?php }?>
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
				</div>	
				<?php endforeach;?>
				<div class="clear"></div> 
				
				<div class="pagination pull-right">
					<ul class="pagination no-margin">
                    	<li><?php echo $this->pagination->create_links();?></li>
                    </ul>
				</div>
		</div>
			<div class="rightsidebar span_3_of_1">
				<div class="blog-bottom">
					<h4>Kategori</h4>
					<?php $kategori=$this->db->query("select * from tbl_kategori_produk order by nama_kategori asc");?>
					<ul class="categories">
						<?php foreach($kategori->result() as $row):?>
						<li class="firstItem"> <a href="<?php echo site_url('produk/perkategori/'.$row->id_kategori_produk);?>">
						<?php echo $row->nama_kategori;?></a>
						</li>
						<?php endforeach;?>
				    </ul>
				</div>
				<div class="blog-bottom">
					<h4>Latest Post</h4>
					<div class="about-team">
						<?php $new_post=$this->db->query("select * from tbl_posting order by id_posting desc limit 3");?>
							<?php foreach($new_post->result() as $row):?>
							<div class="client">
								<h5><span style="color:#3366FF;">
									<a href="<?php echo site_url('home/detil_posting/'.$row->id_posting);?>">
										<?php echo $row->judul_posting;?></a>
								</span></h5>
								<div class="about-team-left">
									<a href="#"><img src="<?php echo base_url().$row->image;?>" title="<?php echo $row->judul_posting;?>"></a>
								</div>
								<div class="about-team-right">
									
									<?php echo word_limiter($row->isi_posting,10);?>
								</div>
								<div class="clear"> </div>
							</div>
							<?php endforeach;?>
							
						</div>
 			    </div>
 			    <div class="event-grid">
				  	<div id="datepicker"></div>
					<div class="clear"> </div>
			    </div>
			</div>	
			<div class="clear"></div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="<?php echo base_url();?>public/js/themes/base/jquery.ui.all.css">
	<!--<script src="<?php echo base_url();?>public/js/jquery-1.8.2.js"></script>-->
	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url();?>public/js/ui/jquery.ui.datepicker.js"></script>

<script type="text/javascript">
	$(function() {
		$("#datepicker").datepicker({
			dateFormat:'dd-mm-yy'
		});
	});
</script>
