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
	<link rel="stylesheet" type="text/css" href="assets/plugins/datatables/vendor/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="assets/plugins/datatables/vendor/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" >
		$(document).ready(function() {
			var dataTable = $('#listtransaksi-grid').DataTable( {
				"processing": true,
				"serverSide": true,
				"ajax":{
						url :"../data/listtransaksi.php?page=all", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".listtransaksi-grid-error").html("");
							$("#listtransaksi-grid").append('<tbody class="listtransaksi-grid-error"><tr><th colspan="5">Data Tidak Ditemukan</th></tr></tbody>');

							$("#listtransaksi-grid_processing").css("display","none");
							
						}
					}
				} );
		} );
		
		$(document).ready(function() {
			var dataTable = $('#listtransaksinew-grid').DataTable( {
				"processing": true,
				"serverSide": true,
				"ajax":{
						url :"../data/listtransaksi.php?page=new", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".listtransaksinew-grid-error").html("");
							$("#listtransaksinew-grid").append('<tbody class="listtransaksinew-grid-error"><tr><th colspan="5">Data Tidak Ditemukan</th></tr></tbody>');

							$("#listtransaksinew-grid_processing").css("display","none");
							
						}
					}
				} );
		} );
		$(document).ready(function() {
			var dataTable = $('#listtransaksikonf-grid').DataTable( {
				"processing": true,
				"serverSide": true,
				"ajax":{
						url :"../data/listtransaksi.php?page=konfirmasimanual", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".listtransaksikonf-grid-error").html("");
							$("#listtransaksikonf-grid").append('<tbody class="listtransaksikonf-grid-error"><tr><th colspan="5">Data Tidak Ditemukan</th></tr></tbody>');

							$("#listtransaksikonf-grid_processing").css("display","none");
							
						}
					}
				} );
		} );
	</script>	
</head>
<body style="background-color: #ECF0F5;">
	<!-- upload logo merk via ajax -->
	
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
		<div class="panel-title">Transaksi List</div>
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
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">	
					<a href="transaksi.php" style="border-radius: 0%;border: 2px solid #2B838D;display: inline-block;padding: 5px;margin: 0px 5px;">
						<span class="fa fa-shopping-cart fa-3x"></span> Daftar Transaksi
					</a>
					<a href="transaksi.php?page=new"  style="border-radius: 0%;border: 2px solid #2B838D;display: inline-block;padding: 5px;margin: 0px 5px;">
						<span class="fa fa-newspaper-o fa-3x"></span> Transfer Bank
					</a>
					<a href="transaksi.php?page=konfirmasimanual"  style="border-radius: 0%;border: 2px solid #2B838D;display: inline-block;padding: 5px;margin: 0px 5px;">
						<span class="fa fa-newspaper-o fa-3x"></span> Konfirmasi Manual
					</a>
				</div>
			</div>
		</div>
		<div class="info-dashboard-hold">

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">	
						<div class="col-md-12 table-fixed" style="border: 0px">
							<?php 
							if(!$_GET['page']){
								?>
								<table id="listtransaksi-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
									<thead>
										<tr>
											<th>Invoice</th>
											<th>Pembeli</th>
											<th>Total Pembayaran</th>
											<th>Metode</th>
											<th>Tanggal Transaksi</th>
											<th>Tanggal Kadarluasa</th>
											<th>Status</th>
										</tr>
									</thead>
								</table>
								<?php 
							}elseif($_GET['page']=="new"){
								?>
								<table id="listtransaksinew-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
									<thead>
										<tr>
											<th>Invoice</th>
											<th>Pembeli</th>
											<th>Total Pembayaran</th>
											<th>Bank</th>
											<th>Tanggal Transaksi</th>
											<th>Tanggal Kadarluasa</th>
											<th>Aksi</th>
										</tr>
									</thead>
								</table>
								<?php 
							}elseif($_GET['page']=="konfirmasimanual"){
								?>
								<table id="listtransaksikonf-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
									<thead>
										<tr>
											<th>Invoice</th>
											<th>Nominal Transaksi</th>
											<th>Bank Tujuan</th>
											<th>Bank Pengirim</th>
											<th>Pemegang Rekening</th>
											<th>Nomer Rekening</th>
											<th>Metode Pembayaran</th>
											<th>Nominal Transfer</th>
											<th>Tanggal Transfer</th>
											<th>Aksi</th>

										</tr>
									</thead>
								</table>
								<?php 
							}
							?>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div id="footer" style="position: relative;width: 100%;height: 30px;z-index: 99999;margin-top: 34px;bottom: 0;"></div>
	</div>

</body>
</html>