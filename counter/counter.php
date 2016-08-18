<?php
  /** Konfigurasi Server Database **/
	$server = "localhost";								/** Nama Host **/
	$username = "root";									/** Username **/
	$password = "";										/** Password **/
	$database = "Database";								/** Nama Database **/

	/** Koneksi dan memilih database di server **/
	mysql_connect($server,$username,$password) or die("Koneksi gagal!");
	mysql_select_db($database) or die("Database tidak bisa dibuka!");
	
  echo '<br/>';
  $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
  $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
  $waktu   = time(); // 

  // Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini 
  $s = mysql_query("SELECT * FROM counter WHERE ip='$ip' AND tanggal='$tanggal'");
  // Kalau belum ada, simpan data user tersebut ke database
  
  echo ('<a class="credit" style="display:none;" href="http://www.santoss.web.id">By Me?</a>');
  if(mysql_num_rows($s) == 0){
    mysql_query("INSERT INTO counter(ip, tanggal, hits, online) VALUES('$ip','$tanggal','1','$waktu')");
  } 
  else{
    mysql_query("UPDATE counter SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
  }

  $pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM counter WHERE tanggal='$tanggal' GROUP BY ip"));
  $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM counter"), 0); 
  $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM counter WHERE tanggal='$tanggal' GROUP BY tanggal")); 
  $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM counter"), 0); 
  $tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM counter"), 0); 
  $bataswaktu       = time() - 100;
  $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM counter WHERE online > '$bataswaktu'"));

  $path = "images/";
  $ext = ".png";

  $tothitsgbr = sprintf("%06d", $tothitsgbr);
  for ( $i = 0; $i <= 9; $i++ ){
	   $tothitsgbr = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $tothitsgbr);
  }
 
  echo '<style>
		#statistic{
			background:transparent url(images/bg.png) repeat;
			padding:5px;
			}
		</style>';
  echo "
	  <div id=statistic>
	  <p class=aligncenter>$tothitsgbr </p>
      <img src=images/hariini.png> Today Visitor : $pengunjung <br/>
      <img src=images/total.png> Total Visitor    : $totalpengunjung <br/><br/>
      <img src=images/hariini.png> Today Hits    : $hits[hitstoday] <br/>
      <img src=images/total.png> Total Hits       : $totalhits <br/>
      <img src=images/online.png> Online: $pengunjungonline<br/><br/>
	  </div>";
?>