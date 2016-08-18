<div class="single">
	  <div class="content span_1_of_2">	
	  		<?php foreach($detil as $row):?>
			<div class="about">
				<h5><?php echo $row->judul_posting;?></h5>
				  <img style="width:90%;" src="<?php echo base_url().$row->image;?>" alt=""/>
				<p><?php echo $row->isi_posting;?>.</p>
				<?php $id_posting = $row->id_posting;?>
			 </div>
			<?php endforeach;?>
			<?php $i=0;?>
			<div class="about">
				<h5>Komentar</h5>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="btn btn-xs btn-primary" style="color:#FFFFFF;" data-toggle="collapse" data-parent="#accordion" href="#collapseOne-<?php echo $i;?>">List Komentar</a>
						</h4>
					</div>
					<div id="collapseOne-<?php echo $i;?>" class="panel-collapse collapse in">
						<div class="panel-body">
							<table style="width:100%;">
							<?php foreach($balas_komen as $balasan):?>
								<tr>
									<td style="width:50%;">
									<dl class="dl-horizontal">
										<dt style="width:100px;">Nama :</dt>
										<dd style="margin-left:100px;"><?php echo $balasan->nama_user;?></dd>
										<dt style="width:100px;">Email :</dt>
										<dd style="margin-left:100px;"><?php echo $balasan->email;?></dd>
										<dt style="width:100px;">Tgl Komentar :</dt>
										<dd style="margin-left:100px;"><?php echo $balasan->tgl_komentar;?></dd>
										<dt style="width:100px;">Komentar :</dt>
										<dd style="margin-left:100px;"><?php echo $balasan->isi_komentar;?></dd>
									</dl>
									</td>
									<td>
									<?php if($balasan->isi_balasan == ''){?>
									
									<?php }else{?>
									<dl class="dl-horizontal">
										<dd style="margin-left:100px;">
											<?php $id = $balasan->id_user;
												$data=$this->db->query("select * from tbl_user where id_user = $id");?>
											<?php foreach($data->result() as $row):?>
												<?php echo $row->nama_lengkap;?>
											<?php endforeach;?>
										</dd>
										<dt style="width:100px;">Tgl balas :</dt>
										<dd style="margin-left:100px;"><?php echo $balasan->tgl_balas;?></dd>
										<dt style="width:100px;">Balasan :</dt>
										<dd style="margin-left:100px;"><?php echo $balasan->isi_balasan;?></dd>
									</dl>
									<?php }?>
									</td>
								</tr>
							<?php endforeach;?>
								
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="about">	
				<div class="col span_1_of_2">
					<div class="contact-form">
						<form method="post" id="contactform" action="<?php echo site_url('home/simpan_komentar');?>">
							<div>
								<span><label>Nama Lengkap</label></span>
								<span><input name="nama_lengkap" type="text" class="textbox"placeholder="* Masukkan Nama Lengkap"></span>
								<input type="hidden" name="tgl_komentar" value="<?php echo date('Y-m-d');?>" />
								<input type="hidden" name="id_posting" value="<?php echo $id_posting;?>" />
							</div>
							<div>
								<span><label>E-Mail</label></span>
								<span><input name="email" type="text" class="textbox"placeholder="* Masukkan Email Anda"></span>
							</div>
							<div>
								<span><label>Komentar</label></span>
								<span><textarea name="isi_komentar"> </textarea></span>
							</div>
						 <button type="submit" class="button-contact">Kirim</button>
						</form>
					</div>
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
