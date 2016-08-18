<div class="single">
	  <div class="content span_1_of_2">	
			<div class="about">
				<?php if($perkategori == NULL){?>
					<h4 style="color:#FF0000;">Data Masih Kosong</h4>
				<?php }else{?>
				<table width="100%" border="1" class="data-table">
				<?php foreach($perkategori as $row):?>
					
					<tr>
						<td style="vertical-align:top;">					
							 <a data-lightbox="example-1"data-title="<?php echo $row->judul_posting;?>" title="<?php echo $row->judul_posting;?>" href="<?php echo base_url().$row->image;?>">
							<img style="width:100%; height:100px;" src="<?php echo base_url().$row->image;?>" alt="<?php echo $row->judul_posting;?>"></a>
						</td>
						<td width="70%" style="vertical-align:text-top; padding-left:30px;">
						<h5><a href="<?php echo site_url('home/detil_posting/'.$row->id_posting);?>"><?php echo $row->judul_posting;?></a></h5>
						<p><?php echo word_limiter($row->isi_posting,25);?>.
						<a href="<?php echo site_url('home/detil_posting/'.$row->id_posting);?>">Read more</a>
						</p>
						
						</td>
					</tr>
					
				<?php endforeach;?>	
				</table>
				<?php }?>
				<div class="pagination pull-right">
					<ul class="pagination no-margin">
                    	<li><?php echo $this->pagination->create_links();?></li>
                    </ul>
				</div>	
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
