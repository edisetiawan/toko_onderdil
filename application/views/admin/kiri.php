        <section class="sidebar">
          <!-- Sidebar user panel -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="<?php echo site_url('admin/home/index');?>">
                <i class="glyphicon glyphicon-home"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-file"></i>
                <span>Data Master</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  	<li><a href="<?php echo site_url('admin/biaya_kirim/index');?>"><i class="fa fa-circle-o"></i> Biaya Kirim</a></li>
			  	<?php if($this->session->userdata('id_level')== 1){?>
                <li><a href="<?php echo site_url('admin/kategori');?>"><i class="fa fa-circle-o"></i> Kategori Posting</a></li>
				<li><a href="<?php echo site_url('admin/kategori_produk');?>"><i class="fa fa-circle-o"></i> Kategori Produk</a></li>
				<?php }else{?>
				
				<?php }?>
                <li><a href="<?php echo site_url('admin/profil');?>"><i class="fa fa-circle-o"></i> Profil</a></li>
                <li><a href="<?php echo site_url('admin/pengguna');?>"><i class="fa fa-circle-o"></i> Pengguna</a></li>
				<li><a href="<?php echo site_url('admin/produk');?>"><i class="fa fa-circle-o"></i> Produk</a></li>
				<li><a href="<?php echo site_url('admin/suplier');?>"><i class="fa fa-circle-o"></i> Suplier</a></li>
              </ul>
            </li>
			<?php /*
			<li class="treeview">
              <a href="<?php echo site_url('admin/download');?>">
                <i class="fa fa-download"></i>
                <span>File Manager</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
			*/?>
            <li class="treeview">
              <a href="<?php echo site_url('admin/galeri');?>">
                <i class="glyphicon glyphicon-picture"></i>
                <span>Galeri</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo site_url('admin/posting');?>">
                <i class="glyphicon glyphicon-edit"></i> <span>Posting</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-envelope"></i>
                <span>Pesan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  	<li class="treeview">
				  <a href="<?php echo site_url('admin/guestbook');?>">
					<!--<i class="glyphicon glyphicon-inbox"></i>--> <span>Guestbook</span>
					
				  </a>
				</li>
				<li class="treeview">
				  <a href="<?php echo site_url('admin/komentar');?>">
					<!--<i class="glyphicon glyphicon-comment"></i>--> <span>Komentar</span>
					
				  </a>
				</li>
			  </ul>
			</li>
			
			<li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-shopping-cart"></i>
                <span>Transaksi</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  	<li><a href="<?php echo site_url('admin/order_pesanan');?>">Order Pesanan</a></li>
				<li><a href="<?php echo site_url('admin/pembelian/index');?>">Pembelian</a></li>
				<li><a href="<?php echo site_url('admin/pembayaran/index');?>"><!--<i class="glyphicon glyphicon-bank"></i> -->Pembayaran</a></li>
			  </ul>
			</li>
			
			<li class="treeview">
              <a href="<?php echo site_url('admin/laporan/index');?>">
                <i class="glyphicon glyphicon-list"></i>
                <span>Laporan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
			  <?php /*
              <ul class="treeview-menu">
			  	<li><a href="<?php echo site_url('admin/laporan/lap_penjualan');?>">Laporan Penjualan</a></li>
				<li><a href="<?php echo site_url('admin/laporan/lap_pembelian');?>">Laporan Pembelian</a></li>
				<li><a href="<?php echo site_url('admin/laporan/lap_pendapatan');?>">Laporan Pendapatan</a></li>
			  </ul>
			  */?>
			</li>
          </ul>
        </section>
