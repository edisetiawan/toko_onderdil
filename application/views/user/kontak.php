<div class="single">
	  <div class="content span_1_of_2">	
			<div class="about">
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3>Peta Lokasi</h3>
					<!--<div class="map">
						<?php echo $headerjs; ?>
							<?php echo $headermap; ?>
							<?php echo $onload; ?>
							<?php echo $map; ?>
					</div>-->
					<div class="map">
						<iframe width="100%" height="375" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d740.4681875019717!2d109.90363665051402!3d-7.723240431415275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNDMnMjMuMSJTIDEwOcKwNTQnMTIuOSJF!5e0!3m2!1sen!2sus!4v1467095385858" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe><br>
						<small><a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d740.4681875019717!2d109.90363665051402!3d-7.723240431415275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNDMnMjMuMSJTIDEwOcKwNTQnMTIuOSJF!5e0!3m2!1sen!2sus!4v1467095385858" style="color:#666;text-align:left;font-size:12px">View Larger Map</a></small>
					</div>
				  </div>
  				</div>
				
				<div class="col span_1_of_3">
					<div class="company_address">
				     	<h3>Sigit Bengkel Vespa :</h3>
						<p>
							<br />Jalan perbatasan kota Desa Kalianyar, Kecamatan Kutoarjo, Kabupaten Purworejo,
							<br />Kode Pos (56283)
						</p>
						<p>  		
							<br />Phone: 0888 2802 2928
							<br />Email: <span>sigit_vespa[at]gmail.com</span>
							<br />Follow on: <span>Facebook</span>, <span>Twitter</span>
						</p>
				     </div>
				 </div>
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
