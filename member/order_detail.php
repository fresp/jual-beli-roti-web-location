<?php
include 'template/head.php';
error_reporting(0);
	require_once '../module/payment.php';
	$payment = new payment();
	if($_GET['invoice']){
		$inv = $_GET['invoice'];
		$tabuy = $payment->detailinv($inv); 
		echo $tabuy;
	}elseif($_GET['orderid']){
		$order = $_GET['orderid'];
		$tabuy = $payment->detailorder($order); 
		echo $tabuy;
	}else{
		$_SESSION['alert'] = '404';
		header('Location:../index.php');
	}

include 'template/footer2.php';
?>