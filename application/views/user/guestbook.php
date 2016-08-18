<div class="single">
	  <div class="content span_1_of_2">	
			<div class="about">
				<table width="100%">
					<?php foreach($data_guest as $row):?>
					<tr>
						<td>
							<div class="company_address">
								<dl class="dl-horizontal">
									<dt>Nama Lengkap :</dt>
									<dd><?php echo $row->nama_lengkap;?></dd>
									<dt>Email :</dt>
									<dd><?php echo $row->email;?></dd>
									<dt>Tgl Pesan :</dt>
									<dd><?php echo $row->tgl_guest;?></dd>
									<dt>Pesan :</dt>
									<dd><?php echo $row->pesan;?></dd>
								</dl>
							</div>
						</td>
						<?php if($row->balasan == ''){?>
						
						<?php }else{?> 
						<td>
							<div class="company_address">
								<dl class="dl-horizontal">
									<dt>Balasan :</dt>
									<dd><?php echo $row->nama_lengkap;?></dd>
									<dt>Tgl Balas :</dt>
									<dd><?php echo $row->tgl_balas;?></dd>
									<dt>Balasan Pesan :</dt>
									<dd><?php echo $row->balasan;?></dd>
								</dl>
							</div>
						</td>
						<?php }?>	
					</tr>
					<?php endforeach;?>
				</table>
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  
					    <form method="post" id="contactform" action="<?php echo site_url('guestbook/index');?>">
					    	<div>
						    	<span><label>Nama Lengkap</label></span>
						    	<span><input name="nama_lengkap" type="text" class="textbox"placeholder="* Masukkan Nama Lengkap"></span>
								<input type="hidden" name="tgl_guest" value="<?php echo date('Y-m-d');?>" />
						    </div>
						    <div>
						    	<span><label>E-Mail</label></span>
						    	<span><input name="email" type="text" class="textbox"placeholder="* Masukkan Email Anda"></span>
						    </div>
						   	<div>
						    	<span><label>Pesan Guestbook</label></span>
						    	<span><textarea name="pesan"> </textarea></span>
						    </div>
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
