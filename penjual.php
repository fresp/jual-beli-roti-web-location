<?php
  require_once 'module/seller.php';
  $seller = new seller();
  $user=$_GET["username"];
  
  $produkData = $seller->cek($user);
  
?>
