    <script src="<?php echo base_url();?>AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js"></script>

<div class="header">
			<div class="header-bot">
				<div class="logo">
					<a href="#"><img src="<?php echo base_url();?>motor/web/images/logo-sigit.png" alt=""/></a>
				</div>
				<div class="f-right">
					<p class="welcome-msg">Servis, Modifikasi dan Jual Beli Onderdil Vespa </p>
					<div class="clear"></div>
					<ul class="links">
						<?php if($this->session->userdata('id_level')== 3){?>
                        <li class=" last"><a href="<?php echo site_url('order_pesanan/index');?>" title="Tagihan"><i class="glyphicon glyphicon-credit-card"></i> Tagihan</a></li>
                        <li class=" last"><a href="<?php echo site_url('cart/index');?>" title="Keranjang" class="top-link-cart"><i class="glyphicon glyphicon-shopping-cart"></i> Keranjang</a></li>
						<?php }else{?>
						<li class=" last"><a href="<?php echo site_url('member/login');?>" onclick="alert('Anda Belum login sebagai Member !')"title="Tagihan"><i class="glyphicon glyphicon-credit-card"></i> Tagihan</a></li>
						<li class=" last"><a href="<?php echo site_url('member/login');?>"onclick="alert('Anda Belum login sebagai Member !')"><i class="glyphicon glyphicon-shopping-cart"></i> Keranjang</a>
						<?php }?>
						<?php if($this->session->userdata('id_level') == 3){?>
                        <li class="first">
							<a href="#" title="My Account"><i class="glyphicon glyphicon-user"></i> <?php echo $this->session->userdata('nama_lengkap');?></a>
						</li>
							<li class=" last"><a href="<?php echo site_url('member/logout');?>" title="Log In"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
						<?php }else{?>
							<li><a href="<?php echo site_url('member/register');?>" title="Log In"><i class="glyphicon glyphicon-user"></i> Register</a></li>
							<li class="pull-right"><a href="<?php echo site_url('member/login');?>" title="Log In"><i class="glyphicon glyphicon-lock"></i> Login</a></li>
						<?php }?>
						
           			</ul>
				</div>
				<div class="clear"></div> 
			</div>
		</div>	

		<div class="header_bottom">
			  <div class="menu">
			     	<ul>
					   	<li class="active"><a href="<?php echo site_url('home/index');?>">Home</a></li>
						<li><a href="<?php echo site_url('produk/index');?>">Produk</a></li>
					   	<li><a href="<?php echo site_url('home/posting');?>">Posting</a></li>
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Profil</a>
						<?php $profil=$this->db->query("select * from tbl_profil order by id_profil asc");?>
							<ul class="dropdown-menu" style="background-color:#333333; ">
								<?php foreach($profil->result() as $row):?>
								<li><a style="color:#FFFFFF; border-right:none; padding:10% 10%;" href="<?php echo site_url('home/profil/'.$row->id_profil);?>"><?php echo $row->judul_profil;?></a></li>
								<?php endforeach;?>
							</ul>
						</li>
					   	<li><a href="<?php echo site_url('home/galeri');?>">Galeri</a></li>
					    <li><a href="<?php echo site_url('home/kontak');?>">Kontak</a></li>
						<li><a href="<?php echo site_url('guestbook/index');?>">Guestbook</a></li>
						<li>
							<?php /*if($this->session->userdata('id_level') == 3){?>
							<a href="<?php echo site_url('forum/forum_home');?>">Forum</a>
							<?php }else{?>
							<a onClick="alert('Anda Belum login sebagai Member !')" href="<?php echo site_url('member/login');?>">Forum</a>
							<?php }*/?>
						</li>
					    <div class="clear"></div>
		     		</ul>
			    </div>
			    <div class="search_box">
			     	<form action="<?php echo site_url('home/cari_posting');?>" method="post">
			     		<input name="judul_posting" type="text" value="Search" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
			     	</form>
			    </div>
	     	<div class="clear"></div>
	     </div>