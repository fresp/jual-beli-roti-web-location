<?php
session_start();
include "../module/saldo.php";
$db=new saldo();
$aksi=$_GET["aksi"];
if($aksi=='checksaldo'){
	$db->checksaldo($_POST['jmlhsaldo']);
}
if($aksi=='savewithdrawal'){
	$db->savewithdrawal($_POST['optbank'],$_POST['atsnama'],$_POST['jmlhsaldo'],$_POST['norek']);

}
if($aksi=='terima'){
	$db->ubahstatus($_GET['aksi'],$_GET['idw']);
}
if($aksi=='tolak'){
	$db->ubahstatus($_GET['aksi'],$_GET['idw']);
}
?>