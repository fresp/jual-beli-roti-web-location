<?php
  session_start();
  error_reporting(0);
  $name=$_GET["name"];
  require_once 'module/produk.php';
  $produk = new produk();
  $produkData = $produk->detail($name);
  
?>
