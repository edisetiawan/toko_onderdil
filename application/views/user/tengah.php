<div class="single">
	  <div class="content span_1_of_2">	
			<div class="about">
				<h5>Selamat Datang</h5>
				  <img style="height:50%;" src="<?php echo base_url();?>public/bengkel3.jpg" alt=""/>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing.</p>		
			 </div>
		   <div class="content-bottom">
				<!--
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
				<div class="col_1_of_3 span_1_of_3">
					<div class="banner-wrap bottom_banner color_dark">
						<a href="#" class="main_link">
						<figure><img src="<?php echo base_url();?>motor/web/images/gift.png" alt=""/></figure><h5>Discount</h5><p>Choose from any of our extensive range </p></a>
					</div>
				</div>-->
				<div class="clear"></div> 
			</div>
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
								<div class="about-team-right" style="vertical-align:top;">
									<?php echo word_limiter($row->isi_posting,20);?>.
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
