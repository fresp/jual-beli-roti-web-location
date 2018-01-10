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
	<?php if($_GET['idp']){
		?>
		<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
		<?php
	}
	?>
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/plugins/datatables/vendor/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="assets/plugins/datatables/vendor/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" >
		$(document).ready(function() {
			var dataTable = $('#listproduk-grid').DataTable( {
				"processing": true,
				"serverSide": true,
				"ajax":{
						url :"../data/listproduk.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".listproduk-grid-error").html("");
							$("#listproduk-grid").append('<tbody class="listproduk-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#listproduk-grid").append('<tbody ><tr class="odd"><td colspan="5" class="dataTables_empty" valign="top">Data Tidak ditemukan</td></tr></tbody>');
							$("#listproduk-grid_processing").css("display","none");
							
						}
					}
				} );
		} );
	</script>	
</head>
<body style="background-color: #ECF0F5;">
	<!-- upload logo merk via ajax -->
	<?php
	if($_SESSION['alert']=='berhasildiupdate'){
		?>
		<script type='text/javascript'>
			$(document).ready( function () {
				cheers.success({
					title: 'berhasil update',
					message: 'Berhasil di Update',
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
		<?php if($_GET['idp']){
			$idp =$_GET['idp'];
			require_once '../module/produk.php';
			$produk = new produk();
			$memberdata = $produk->lihatproduk($idp); 
		}else{
			?>
			<div class="info-dashboard-hold">

				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">	
							<div class="col-md-12 table-fixed" style="border: 0px">
								<table id="listproduk-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
									<thead>
										<tr>
											<th>Penjual</th>
											<th>Nama Produk</th>
											<th>Deskripsi</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
			<?php 
		}
		?>
		<div id="footer" style="position: relative;width: 100%;height: 30px;z-index: 99999;margin-top: 34px;bottom: 0;"></div>
	</div>

</body>
</html>