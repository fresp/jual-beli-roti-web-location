<?php
session_start();
?>
<span class="fa fa-map-marker" style="color: #FF5454;">&nbsp5 KM</span> dari
<?php
			//string yang akan dipecah
$teks = $_SESSION['nerbie'];
			//pecah string berdasarkan string ","
$pecah = explode(",", $teks);
			//mencari element array 0
$hasil = $pecah[0];
			//tampilkan hasil pemecahan
echo $hasil;
?>

