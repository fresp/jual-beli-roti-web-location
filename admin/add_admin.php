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
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<!-- af menload data js dari root ataupun cdn -->
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script async='async' type="text/javascript" src="assets/js/loadingbar.js"></script>
	<link href="../assets/css/cheers-alert.min.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="../assets/js/cheers-alert.min.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.validate.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			jQuery.validator.addMethod("lettersonly", function(value, element) {
				return this.optional(element) || /^[a-zA-Z' .\\s]+$/i.test(value);
			}, "Only alphabetical characters");
			$('#frm-ubah').validate({
				rules: {
					username: {
						required: true,
						lettersonly: true
					},
					pass: {
						minlength:8
						
					}
				},
				messages: {
					username: {
						required: "Nama harus diisi",
						lettersonly:jQuery.format("Tolong isi hanya Huruf")
					},
					pass: {
						minlength: "Nama Depan minimal 8 karakter"
					}
				}
			});
		});
	</script>	
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
		
	}
	unset($_SESSION['alert']);
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
		<div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;width: 50%;position: relative;margin-right: auto;margin-left: auto;">
			<div class="register-form">
				<div class="register-header">
					<centeR>Tambah Admin</centeR>
					<hr>
				</div>
				<div>
					<form action="../helper/admin.php?aksi=add" method="POST" id="frm-ubah">
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input class="form-control" name="username" id="username" placeholder="Masukan username" value="<?php echo $row['adm_fullname'];?>" type="text">
						</div>
						<div class="form-group">
							<label>Password</label>
							<?php 
							require_once '../module/member.php';
							$member = new member();
							$memberdata = $member->kocok(); 
						
							?>
							<input class="form-control" name="pass" id="pass" placeholder="Password" value="<?php echo  $memberdata;?>" type="text">
						</div>
						<input type="submit" id="tombol-login" class="button" value="Ubah">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>