<?php
session_start();
error_reporting(0);
$id = $_SESSION['iduser'];

if($_SESSION['login'] !=""){
  include 'template/head.php';
  ?>
      <?php 
      require_once '../module/member.php';
      $member = new member();
      $memberData = $member->tampilmember($id); 
      echo $memberData;
      ?>
  <?php
  include 'template/footer2.php';
}elseif($_SESSION['login'] ==""){
  $_SESSION['alert'] = 'accdenied';
  header('Location:../index.php');
}
?>