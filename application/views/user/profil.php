<div class="single">
	<div class="content span_1_of_2">	
		<?php foreach($profil as $row):?>
			<div class="about">
				<h5><?php echo $row->judul_profil;?></h5>
				  <img src="<?php echo base_url().$row->image;?>" alt=""/>
				<p><?php echo $row->isi_profil;?>.</p>
			</div>
		<?php endforeach;?>
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
