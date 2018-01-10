<?php
session_start();
error_reporting(0);
if($_SESSION['login'] ==""){
  $_SESSION['alert'] = 'accdenied';
  header('Location:../index.php');
}
include 'template/head.php';
if($_SESSION['alert']=='orderberhasil'){
	?>
	<script type='text/javascript'>
		$(document).ready( function () {
			cheers.success({
				title: 'Selesai diproses',
				message: 'Orderan Berhasil diproses',
				alert: $('select[name="alert"]').val(),
			});
		}); 
	</script>
	<?php
	unset($_SESSION['alert']);
}
elseif($_SESSION['alert']=='orderkonfirmberhasil'){
	?>
	<script type='text/javascript'>
		$(document).ready( function () {
			cheers.success({
				title: 'Konfirmasi Berhasil',
				message: 'Terimakasih Telah Konfirmasi',
				alert: $('select[name="alert"]').val(),
			});
		}); 
	</script>
	<?php
	unset($_SESSION['alert']);
}
elseif($_SESSION['alert']=='orderkonfirmgagal'){
	?>
	<script type='text/javascript'>
		$(document).ready( function () {
			cheers.success({
				title: 'uuh Konfirmasi Gagal',
				message: 'Silahkan ulangi lagi',
				alert: $('select[name="alert"]').val(),
			});
		}); 
	</script>
	<?php
	unset($_SESSION['alert']);
}
elseif($_SESSION['alert']=='ordergagal'){
	?>
	<script type='text/javascript'>
		$(document).ready( function () {
			cheers.success({
				title: 'Proses Gagal',
				message: 'Orderan gagal diproses',
				alert: $('select[name="alert"]').val(),
			});
		}); 
	</script>
	<?php
	unset($_SESSION['alert']);
}
elseif(!$_GET['list']){
	$_SESSION['alert'] = '404';
	header('Location:../index.php');
}
?>
<div style="margin-top: 50px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top" id="listtrx">
	<?php
	require_once '../module/payment.php';
	$payment = new payment();
	if($_GET['list']=="buy"){
		$tabuy = $payment->listbuy(); 
		echo $tabuy;
	}elseif($_GET['list']=="sell"){
		$tabuy = $payment->listsell(); 
		echo $tabuy;
	}else{
		$_SESSION['alert'] = '404';
		header('Location:../index.php');

	}
	?>
</div>
<?php
include 'template/footer2.php';
?>
