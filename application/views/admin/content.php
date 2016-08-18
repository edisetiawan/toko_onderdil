        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <section class="content">
          <div class="row">
		  	<div class="col-lg-4 col-xs-3">
              <div class="small-box bg-aqua">
                <div class="inner">
                  <?php $query=$this->db->query("Select Count(tgl_order)AS jml_order From tbl_order where tgl_order = CURDATE()");?>
				<?php foreach($query->result() as $row):?>
                  <h3><?php echo $row->jml_order;?></h3>
				<?php endforeach;?>
                  <p>Order Baru</p>
                </div>
                <div class="icon">
                  <i class="glyphicon glyphicon-shopping-cart"></i>
                </div>
                <a href="<?php echo site_url('admin/order_pesanan/index');?>" class="small-box-footer">Detil <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
			
            <div class="col-lg-4 col-xs-3">
              <div class="small-box bg-green">
                <div class="inner">
                 <?php $query=
				 		$this->db->query("Select Count(tgl_bayar)AS jml_pembayar 
							From tbl_pembayaran where tgl_bayar = CURDATE()");?>
				<?php foreach($query->result() as $row):?>
                  <h3><?php echo $row->jml_pembayar;?></h3>
				<?php endforeach;?>
                  <p>Pembayaran</p>
                </div>
                <div class="icon">
                  <i class="glyphicon glyphicon-credit-card"></i>
                </div>
                <a href="<?php echo site_url('admin/pembayaran/index');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
			
            <div class="col-lg-4 col-sm-3">
              <div class="small-box bg-red">
                <div class="inner">
                  <?php $query=$this->db->query("Select Count(tgl_registrasi)AS jml_member From tbl_member where tgl_registrasi = CURDATE()");?>
				<?php foreach($query->result() as $row):?>
                  <h3><?php echo $row->jml_member;?></h3>
				<?php endforeach;?>
                  <p>Member Baru</p>
                </div>
                <div class="icon">
                  <i class="glyphicon glyphicon-user"></i>
                </div>
                <a href="<?php echo site_url('admin/pengguna/index');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			
          </div>
		  
		  <div class="row">
		  	<section class="col-lg-6">
				<div class="box ">
					<div class="box-header box-solid bg-blue-gradient">
						<h3 class="box-title"><i class="glyphicon glyphicon-bell"></i> Stok Minimum</h3>
					</div>
					<div class="box-body ">
						<?php $stok=$this->db->query("select * from tbl_produk where jml <= 5");?>
						<table id="example2" class="table table-bordered table-hover">
						<thead>
						  <tr>
							<th>No</th>
							<th>Kode Produk</th>
							<th>Nama Produk</th>
							<th>JML Stok</th>
						  </tr>
						</thead>
						<tbody>
					  <?php $i=1;?>
						<?php foreach($stok->result() as $row):?>
						  <tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $row->produk_sku;?></td>
							<td><?php echo $row->nama_produk;?></td>
							<td style="text-align:center;">
							  <?php echo $row->jml;?>
							</td>
						  </tr>
						 <?php endforeach;?>
						</tbody>
					  </table>
					</div>
				</div>
				
				<div class="box ">
					<div class="box-header box-solid bg-blue-gradient">
						<h3 class="box-title"><i class="glyphicon glyphicon-bell"></i> Pembelian</h3>
					</div>
					<div class="box-body ">
						<?php $beli=$this->db->query("select * from tbl_pembelian join tbl_suplier on tbl_suplier.id_suplier = tbl_pembelian.id_suplier where status_beli = 1");?>
						<table class="table" style="width:50%;">
							<tr>
								<td>Status Beli </td><td>=</td>
								<td><span style="text-align:center;" class="bg-warning btn-block">Barang Menunggu</span></td>
							</tr>
						</table>
						<br />
						<table id="example2" class="table table-bordered table-hover">
						<thead>
						  <tr>
							<th>No</th>
							<th>No Beli</th>
							<th>Suplier</th>
							<th>Telp</th>
							<th>Alamat</th>
						  </tr>
						</thead>
						<tbody>
					  <?php $i=1;?>
						<?php foreach($beli->result() as $row):?>
						  <tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $row->no_beli;?></td>
							<td><?php echo $row->nama_suplier;?></td>
							<td><?php echo $row->no_telp;?></td>
							<td><?php echo $row->alamat;?></td>
						  </tr>
						 <?php endforeach;?>
						</tbody>
					  </table>
					</div>
				</div>
			</section>
			
			<section class="col-lg-6">
				<div class="box ">
					<div class="box-header box-solid bg-blue-gradient">
						<h3 class="box-title">
							<i class="glyphicon glyphicon-bell"></i> Pengiriman Order 
						</h3>
					</div>
					<div class="box-body">
						<?php $kirim=$this->db->query("select * from tbl_order 
							join tbl_pembayaran on tbl_pembayaran.id_order = tbl_order.id_order
							join tbl_member on tbl_member.id_member = tbl_order.id_member
							where status_order = 1 
							and tbl_pembayaran.metode = 1
							and status_bayar LIKE'%Lunas%'
							");?>
						<table class="table" style="width:40%;">
							<tr>
								<td>Status Bayar </td><td>=</td>
								<td><span style="text-align:center;" class="bg-success btn-block"> Lunas </span></td>
							</tr>
							<tr>
								<td>Status Order </td><td>=</td>
								<td><span style="text-align:center;" class="bg-warning btn-block"> Diproses </span></td>
							</tr>
						</table>
						<br />
						<table id="example2" class="table table-bordered table-hover">
						<thead>
						  <tr>
							<th>No</th>
							<th>No Order</th>
							<th>Pemesan</th>
							<th>Telp</th>
							<th>Alamat Kirim</th>
						  </tr>
						</thead>
						<tbody>
					  <?php $i=1;?>
						<?php foreach($kirim->result() as $row):?>
						  <tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $row->no_order;?></td>
							<td><?php echo $row->nama_member;?></td>
							<td><?php echo $row->no_telp;?></td>
							<td><?php echo $row->alamat_kirim;?></td>
						  </tr>
						 <?php endforeach;?>
						</tbody>
					  </table>
					</div>
				</div>
			</section>
		  </div>

        </section><!-- /.content -->
