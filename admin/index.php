<?php
session_start();
error_reporting(0);
if($_SESSION['loginadmin']!="YES"){
	$_SESSION['alert'] = 'logindulu';
	header('Location:../admin/login.php');
}
?>  
<!DOCTYPE html>
<html lang="id">
<head>
	<title>Dashboard | Karyawan Panel</title>
	
	<!-- meta viewport untuk membuat design responsif -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#E91E63" />
	<!-- af menload data css dari root ataupun cdn -->
	<link async='async' rel="stylesheet" async='async' type="text/css" href="assets/css/panel.css">
	<link async='async' rel="stylesheet" async='async' href="http://www.w3schools.com/lib/w3.css">
	<link async='async' rel="stylesheet" async='async' href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link async='async' href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	<link async='async' href="https://fonts.googleapis.com/css?family=Bungee" rel="stylesheet">

	<!-- af menload data js dari root ataupun cdn -->
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script async='async' type="text/javascript" src="assets/js/loadingbar.js"></script>
	<link href="../assets/css/cheers-alert.min.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="../assets/js/cheers-alert.min.js"></script>
	<!-- include summernote css/js-->
	<link async='async' href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
	<script async='async' src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>	
</head>
<body style="background-color: #ECF0F5;">
	<!-- upload logo merk via ajax -->
	<?php
	if($_SESSION['alert']=='login'){
		?>
		<script type='text/javascript'>
			$(document).ready( function () {
				cheers.success({
					title: 'Login Berhasil',
					message: 'Selamat Bekerja',
					alert: $('select[name="alert"]').val(),
				});
			}); 
		</script>
		<?php
		unset($_SESSION['alert']);
	}
	elseif($_SESSION['alert']=='paslogin'){
		?>
		<script type='text/javascript'>
			$(document).ready( function () {
				cheers.success({
					title: 'Login Gagal',
					message: 'Silahkan Ulangi Lagi',
					alert: $('select[name="alert"]').val(),
				});
			}); 
		</script>
		<?php
		unset($_SESSION['alert']);	
	}
	?>
	
	<div class="upload-image">
	</div>

	<!-- upload logo merk via ajah-->
	<div id="hidden">
		<div id="progress-bar"></div><div id="loading"></div>
	</div>
	<div id="panel-header">
		<div class="panel-nav-button">	<!-- pc -->
			<i class ="fa fa-bars"></i>
		</div>
		<div class="panel-nav-button-mobile"> <!-- mobile -->
			<i class ="fa fa-bars"></i>
		</div>
		<div class="panel-title">Dashboard</div>
		<div class="panel-name-staff" >
			
			<?php echo $_SESSION['namaadmin'];?>
		</div>
	</div>
	<div id="menu-bar" style="top: 50px;"> <!-- pc -->
		<div class="menu-bar-close">
			<i class="fa fa-arrow-left"></i>
		</div>
		<a href="../helper/member.php?aksi=logout">
			<div class="logout">
				<span style="color: #fff; font-weight: bold;">Logout</span>
			</div>
		</a>
		<nav class="menu-list">
			<ul style="margin-top: 0px;">
				<a href="index.php">
					<li><i class ="fa fa-home"></i>Dashboard</li>
				</a>
				<a href="produk.php">
					<li><i class ="fa fa-cubes"></i>Produk</li>
				</a>
				<a href="member.php">
					<li><i class="fa fa-users"></i>Member</li>
				</a>
<a href="withdrawal.php">
					<li><i class="fa fa-money"></i>Withdrawal</li>
				</a>
				<a href="lapak.php">
					<li><i class="fa fa-archive"></i>Lapak</li>
				</a>
				<a href="transaksi.php">
					<li><i class="fa  fa-shopping-cart"></i>Transaksi</li>
				</a>
				<a href="admin.php">
					<li><i class="fa fa-user-circle-o "></i>Admin</li>
				</a>
			</ul>
		</nav>
	</div>
	<div id="menu-bar-mobile"> <!-- mobile -->
		<div class="menu-bar-close-mobile">
			<i class="fa fa-arrow-left"></i>
		</div>
		<a href="../helper/member.php?aksi=logout">
			<div class="logout">
				<span>Logout</span>
			</div>
		</a>

		<nav class="menu-list">
			<ul>
				<a href="index.php">
					<li><i class ="fa fa-home"></i>Dashboard</li>
				</a>
				<a href="produk.php">
					<li><i class ="fa fa-cubes"></i>Produk</li>
				</a>
				<a href="member.php">
					<li><i class="fa fa-users"></i>Member</li>
				</a>
<a href="withdrawal.php">
					<li><i class="fa fa-money"></i>Withdrawal</li>
				</a>
				<a href="lapak.php">
					<li><i class="fa fa-archive"></i>Lapak</li>
				</a>
				<a href="transaksi.php">
					<li><i class="fa  fa-shopping-cart"></i>Transaksi</li>
				</a>
				<a href="admin.php">
					<li><i class="fa fa-user-circle-o "></i>Admin</li>
				</a>
			</ul>
		</nav>
	</div>
	<!-- sciprt js untuk menu -->
	<script async='async' type="text/javascript" src="assets/js/afpanel/menu.js"></script>
	<div id="panel-content">
		<div class="info-dashboard-hold">
			<div class="info-site" style="background: #fff;padding: 10px;margin-bottom: 10px;">
				Selamat Datang <span style="font-weight: bold"><?php echo $_SESSION['namaadmin'];?></span>
			</div>
			<div class="info-stock">
				<div class="info-value">
					<i class="fa fa-cubes"></i>
					<?php 
					require_once '../module/produk.php';
					$produk = new produk();
					$reviewData = $produk->datareview(); 
					echo $reviewData;
					?>
				</div>
				<div class="info-title">
					Produk Menunggu Review
				</div>
			</div>
			<div class="info-stock">
				<div class="info-value">
					<i class="fa fa-money"></i>
					<?php 
					require_once '../module/saldo.php';
					$saldo = new saldo();
					$pending = $saldo->pending(); 
					echo $pending;
					?>
					
				</div>
				<div class="info-title">
					Tarik Saldo
				</div>
			</div>
			<div class="info-stock">
				<div class="info-value">
					<i class="fa fa-archive"></i> 
					<?php 
					require_once '../module/seller.php';
					$seller = new seller();
					$lapak = $seller->lapak(); 
					echo $lapak;
					?>
				</div>
				<div class="info-title">
					Total Penjual
				</div>
			</div>
			
		</div>
		<div id="footer" style="     position: relative;
		width: 100%;
		height: 30px;
		z-index: 99999;
		margin-top: 34px;
		bottom: 0;">
	</div>
</div>
</body>
</html>