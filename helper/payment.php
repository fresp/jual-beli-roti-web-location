<?php
session_start();
error_reporting(0);
include "../module/payment.php";
$db=new payment();
$aksi=$_GET["aksi"];
if($aksi=='cartselected'){
	$db->cartselected($_POST['id'],$_POST['isipesan'],$_POST['isitotal'],$_POST['payment'],$_POST['isicust']);
}
if($aksi=='addalamat'){
	$db->addalamat($_POST['alamat'],$_POST['nomer'],$_POST['penerima']);
}
if($aksi=='alamatload'){
	$db->alamatload();
}
if($aksi=='listbuy'){
	$db->listbuy();
}
if($aksi=='load_moretrx'){
	$db->load_moretrx($_POST['idakhir']);
}
if($aksi=='load_moresell'){
	$db->load_moresell($_POST['idakhir']);
}
if($aksi=='listsell'){
	$db->listsell();
}
if($aksi=='orderproses'){
	$db->orderproses($_POST['orderid'],$_POST['slctaksi'],$_POST['totbel'],$_POST['memid']);
}
if($aksi=='orderkonfirm'){
	$db->orderkonfirm($_POST['orderid']);
}
if(isset($_GET["konfid"])){
	$id=$_GET['konfid'];
	$db->konfid($id);
}
if($aksi=='konfirmasi'){
	$db->konfirmasi($_POST['inv'],$_POST['bankwm'],$_POST['bankcust'],$_POST['nama'],$_POST['norek'],$_POST['method'],$_POST['nominal'],$_POST['tgltransfer']);
}

if($aksi=='checkinv'){
	$db->checkinv($_POST['inv']);
}
?>	