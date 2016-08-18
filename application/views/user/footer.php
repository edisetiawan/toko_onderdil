				<?php
						$server = "localhost";	
						$username = "root";		
						$password = "";			
						$database = "toko_onderdil";		
					
						mysql_select_db($database) or die("Database tidak bisa dibuka!");
						
					  echo '<br/>';
					  $ip      = $_SERVER['REMOTE_ADDR']; 
					  $tanggal = date("Ymd"); 
					  $bulan   = date("Ym");
					  $waktu   = time();  
					
					  $s = mysql_query("SELECT * FROM tbl_counter WHERE ip='$ip' AND tanggal='$tanggal'");
					  if(mysql_num_rows($s) == 0){
						mysql_query("INSERT INTO tbl_counter(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
					  } 
					  else{
						mysql_query("UPDATE tbl_ounter SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
					  }
					
					  $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM tbl_counter WHERE tanggal='$tanggal' GROUP BY ip"));
					  $minggu 			= mysql_result(mysql_query("SELECT DATE_ADD(CURDATE(), INTERVAL 1 WEEK) as seminggu, COUNT(hits) FROM tbl_counter"), 0); 
					  $bulan       		= mysql_num_rows(mysql_query("SELECT COUNT(hits) FROM tbl_counter GROUP BY MONTH(tanggal) "));
					  $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM tbl_counter"), 0); 
					  $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM tbl_counter WHERE tanggal='$tanggal' GROUP BY tanggal")); 
					  $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM tbl_counter"), 0); 
					  $tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM tbl_counter"), 0); 
					  $bataswaktu       = time() - 100;
					  $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM tbl_counter WHERE online > '$bataswaktu'"));
					?>
					<?php 
					  $path = "images/";
					  $ext = ".png";
					
					  $tothitsgbr = sprintf("%06d", $tothitsgbr);
					  for ( $i = 0; $i <= 9; $i++ ){
						   $tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);
					  }
					?>

<div class="footer-top">
				<div class="col_1_of_3 span_1_of_3">
					<h3>INFORMATION</h3>
					<ul>
						<li><a href="#">Sigit Vespa</a></li>
						<li><a href="#">Alamat : Jalan perbatasan kota Desa Kalianyar, Kecamatan Kutoarjo, Kabupaten Purworejo,</a></li>
						<li><a href="#">No Telp : 0888 2802 2928</a></li>
						<li><a href="#">email : <span>sigit_vespa@gmail.com</span></a></li>
					</ul>
				</div>
				<div class="col_1_of_3 span_1_of_3 footer-lastgrid">
					<h3>FOLLOW US</h3>
					<ul>
						<li><a href="#">FACEBOOK</a></li>
						<li><a href="#">TWITTER</a></li>
						<li><a href="#">RSS</a></li>
					</ul>
			    </div>
				<div class="col_1_of_3 span_1_of_3">
					<h3>Visitors</h3>
					<ul>
						<li><img src=<?php echo base_url();?>counter/images/hariini.png> Hari ini : <?php echo $pengunjung ;?></li>
						<li><img src=<?php echo base_url();?>counter/images/hariini.png> Bulan ini : <?php echo $bulan ;?></li>
						<li><img src=<?php echo base_url();?>counter/images/total.png> Total Pengunjung    :<?php echo $totalpengunjung;?></li>
						<li><img src=<?php echo base_url();?>counter/images/online.png> Online: <?php echo $pengunjungonline;?></li>
					</ul>
				</div>
				
				<div class="clear"></div> 
		</div>
		<div class="copy">
			<p>Copyright <a href="#">Sigit Vespa</a></p>
		</div>
		