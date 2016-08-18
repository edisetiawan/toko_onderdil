<div class="single">
	  <div class="content span_1_of_2">	
			<div class="about">
				
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3>Login Member :</h3>
					    <form method="post" id="contactform" action="<?php echo site_url('member/login');?>">
					    	<div>
						    	<span><label>Username</label></span>
						    	<span><input name="username" type="text" class="form-control" placeholder="* MasukkanUsername"></span>
								
						    </div>
						    <div>
						    	<span><label>Password</label></span>
						    	<span><input name="password" type="password" class="form-control"placeholder="* Masukkan Password"></span>
						    </div>
						 <a href="<?php echo site_url('member/register');?>">Registrasi</a>
						 <button type="submit" class="button-contact">Kirim</button>
					    </form>
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
							<br />Phone: 085 228 099 153
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
								<div class="about-team-left">
									<a href="#"><img src="<?php echo base_url().$row->image;?>" title="<?php echo $row->judul_posting;?>"></a>
								</div>
								<div class="about-team-right">
									<h5><span style="color:#3366FF;"><?php echo $row->judul_posting;?></span></h5>
									<p><?php echo word_limiter($row->isi_posting,20);?>,</p>
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
