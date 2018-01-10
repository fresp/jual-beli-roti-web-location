<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8"/>
	<link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon"/>
	<meta name="robots" content="noindex"/>
	<title>Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="../public/css/bootstrap/css/bootstrap.css" type="text/css">
	<link href="../assets/boostrap/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="../assets/css/style-admin.css" type="text/css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">	
	<link href="https://linebot.fadilus.com/assets/css/morris.css" rel="stylesheet"/>
</head>
<body>
	<div class="row affix-row">
		<div class="col-sm-3 col-md-2 affix-sidebar">
			<div class="sidebar-nav">
				<div class="navbar navbar-default" role="navigation">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
							<span class="sr-only">Menu</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<span class="visible-xs navbar-brand">Warung Modern</span>
					</div>
					<div class="navbar-collapse collapse sidebar-navbar-collapse">
						<ul class="nav navbar-nav" id="navmenu">
							<li style="background-color:#222D32;">
								<a href="javascript:;" data-toggle="collapse" data-target="#tg0" data-parent="#navmenu" class="collapsed">
									<div style="float: left !important;">
										<img src="http://localhost/gota1/public/img/orang.jpg" class="img-circle" style="height: 50px;width: 50px;"/>
									</div>
									<div style="margin :-5px 0px 0px 60px;">
										<h4>
											<span update-id="admin_name" style="top : -10px;"><?php echo $_SESSION['namaadmin'];?></span>
											<span class="caret"></span>
											<br>
											<small>
												<span update-id="admin_email">Administrator</span>

											</small>							
										</h4>
									</div>
								</a>
								<div class="collapse" id="tg0" style="height: 0px;">
									<ul class="nav nav-list">
										<li nav-id="user_change-password"><a href="https://linebot.fadilus.com/account/change-password">Ganti Kata Sandi</a></li>
										<li><a href="https://linebot.fadilus.com/auth/logout">Keluar</a></li>
									</ul>
								</div>
							</li>
							<li  class="active" style="background-color:#222D32;" nav-id="dashboard"><a href="https://linebot.fadilus.com/dashboard"><span class="fa fa-dashboard"></span> Dasbor</a></li>
							<li style="background-color:#222D32;" nav-id="linebot">
								<a href="javascript:;" data-toggle="collapse" data-target="#linebot" data-parent="#navmenu" class="collapsed">
									<span class="fa fa-inbox"></span> Data Master<small><span class="caret"></span></small></a>
								</a>
								<div class="collapse" id="linebot" style="height: 0px;">
									<ul class="nav nav-list">
										<li nav-id="bot_auto-like-line">
										<a href="javascript:;" data-toggle="collapse" data-target="#produk" data-parent="#navmenu" class="collapsed">
											<span style="margin-left : 6px;"></span>
											<span class="fa fa-inbox"></span> Produk<small><span class="caret"></span></small></a>
										</a>
											<div class="collapse" id="produk" style="height: 0px; ">
												<ul class="nav nav-list">
													<li nav-id="bot_auto-like-line"><a href="https://linebot.fadilus.com/auto-like-line"><span style="margin-left : 20px;"></span>
														<i class="fa fa-circle-o"></i> Produk</a>
													</li>
													<li nav-id="bot_auto-like-timeline">
														<a href="https://linebot.fadilus.com/auto-like-line"><span style="margin-left : 20px;"></span>
														<i class="fa fa-circle-o"></i> Produk</a>
													</li>
												</ul>
											</div>
										</li>
										<li nav-id="bot_auto-like-timeline"><a href="https://linebot.fadilus.com/bot/auto-like-timeline">Member</a></li>
										
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-9 col-md-10 affix-content">
			<div class="container">
				<div class="page-header"><h3><span class="fa fa-dashboard"></span> Dashboard</h3></div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-aqua">
			            <div class="inner">
			              <h3>150</h3>
			              <p>New Orders</p>
			            </div>
			            <div class="icon">
			              <i class="ion ion-bag"></i>
			            </div>
			            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			        </div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-aqua">
			            <div class="inner">
			              <h3>150</h3>
			              <p>New Orders</p>
			            </div>
			            <div class="icon">
			              <i class="ion ion-bag"></i>
			            </div>
			            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			        </div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-aqua">
			            <div class="inner">
			              <h3>150</h3>
			              <p>New Orders</p>
			            </div>
			            <div class="icon">
			              <i class="ion ion-bag"></i>
			            </div>
			            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			        </div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-aqua">
			            <div class="inner">
			              <h3>150</h3>
			              <p>New Orders</p>
			            </div>
			            <div class="icon">
			              <i class="ion ion-bag"></i>
			            </div>
			            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			        </div>
				</div>
			</div>
		</div>
	</div>
		<script>
	$(document).ready(function() {
		$('#example').dataTable( {
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "data.php",
			"aoColumns": [
			  null,
			  null,
			  null,
			  {
				"mData": "0", <!-- Ini adalah untuk Link ID urutan kolom seperti table mulai dari 0 untuk data pertama -->
				"mRender": function ( data, type, full ) {
					return '<a href="#" onclick="alert(\'ID adalah = '+data+'\')"><span class="label label-primary">Link ID<span></a>';
				  }
			  }
			]
		} );
	} );
	</script>
	<script src="https://linebot.fadilus.com/assets/js/jquery-2.1.4.min.js"></script>
	<script src="https://linebot.fadilus.com/assets/js/bootstrap.min.js"></script>
	<script src="https://linebot.fadilus.com/assets/js/raphael.min.js"></script>
	<script src="https://linebot.fadilus.com/assets/js/morris.min.js"></script>


	<script src="../assets/boostrap/js/jquery.dataTables.min.js"></script>
	<script src="../assets/boostrap/js/dataTables.bootstrap.min.js"></script>
</body>
</html>