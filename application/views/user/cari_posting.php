<div class="single">
	  <div class="content span_1_of_2">	
			
			<div class="about">
				<table width="100%" border="1" class="data-table">
				<?php if(count($judul_posting->result_array())>0){
					foreach($judul_posting->result() as $row){?>
					<tr>
						<td style="vertical-align:top;">					
							 <a data-lightbox="example-1"data-title="<?php echo $row->judul_posting;?>" title="<?php echo $row->judul_posting;?>" href="<?php echo base_url().$row->image;?>">
							<img style="width:100%; height:100px;" src="<?php echo base_url().$row->image;?>" alt="<?php echo $row->judul_posting;?>"></a>
						</td>
						<td width="70%" style="vertical-align:text-top; padding-left:30px;">
						<h5><?php echo $row->judul_posting;?></h5>
						<p><?php echo word_limiter($row->isi_posting,30);?>.
						<a href="<?php echo site_url('home/detil_posting/'.$row->id_posting);?>">Read more</a>
						</p>
						
						</td>
					</tr>
					<?php }
				}else{
					echo '<tr><td colspan="6"><font color="red">Tidak ada Artikel / Berita yang sesuai</font> </td></tr>';
				}?>
				</table>
				<div class="pagination pull-right">
					<ul class="pagination no-margin">
                    	<li><?php echo $this->pagination->create_links();?></li>
                    </ul>
				</div>	
			 </div>
			<!--
		   <div class="content-bottom">
				<div class="col_1_of_3 span_2_of_1">
					<div class="banner-wrap bottom_banner color_link">
						<a href="#" class="main_link">
						<figure><img src="<?php echo base_url();?>motor/web/images/delivery.png" alt=""/></figure>
						<h5><span>Free Shipping</span><br> on orders over $99.</h5><p>This offer is valid on all our store items.</p></a>
					</div>
				</div>
				<div class="col_1_of_3 span_2_of_1">
					<div class="banner-wrap bottom_banner">
						<a href="#" class="main_link">
						<figure><img src="<?php echo base_url();?>motor/web/images/phone.png" alt=""/></figure><h5>Order online <br><span>1(800) 234-5678</span></h5><p>Hours: 8am-11pm PST M-Th; 8am-9pm PST Fri<br>
						</p></a>
					</div>
				</div>
				<div class="clear"></div> 
			</div>
			-->
		   </div>
			<div class="rightsidebar span_3_of_1">
				<div class="blog-bottom">
					<h4>Kategori</h4>
					<?php $kategori=$this->db->query("select * from tbl_kategori order by nama_kategori asc");?>
					<ul class="categories">
						<?php foreach($kategori->result() as $row):?>
						<li class="firstItem"> <a href="<?php echo site_url('home/perkategori/'.$row->id_kategori);?>">
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
								<h5><span style="color:#3366FF;"><?php echo $row->judul_posting;?></span></h5>
								<div class="about-team-left">
									<a href="#"><img src="<?php echo base_url().$row->image;?>" title="<?php echo $row->judul_posting;?>"></a>
								</div>
								<div class="about-team-right">
									
									<?php echo word_limiter($row->isi_posting,20);?>
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
					<!--
				     <div class="event-grid">
					  	<div class="event_img">
						  <img src="<?php echo base_url();?>motor/web/images/pic18.jpg" title="post1" alt=""/>
					    </div>
						<div class="event_desc">
						 <h5><span>NEQUE LIGULA</span></h5>
						  <h5>Aug 28Th, 2013</h5>
						<p>Lorem ipsum dolor sit amet consectetur dolor more normal of letters,<a href="#">[...]</a></p>
					    </div>
							<div class="clear"> </div>
				    </div>
				     <div class="event-grid">
					  	<div class="event_img">
						  <img src="<?php echo base_url();?>motor/web/images/pic19.jpg" title="post1" alt=""/>
					    </div>
						<div class="event_desc">
						 <h5><span>NEQUE LIGULA</span></h5>
						  <h5>Aug 28Th, 2013</h5>
						<p>Lorem ipsum dolor sit amet consectetur dolor more normal of letters,<a href="#">[...]</a></p>
					    </div>
							<div class="clear"> </div>
				    </div>
					-->
 			    </div>	
 			 <div class="clear"></div>
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
