<?php
session_start();
error_reporting(0);
if($_SESSION['login'] ==""){
	$_SESSION['alert'] = 'accdenied';
	header('Location:../index.php');
}
include 'template/head.php';
?>

<script type="text/javascript">

	$(document).ready(function() {
		var dataTable = $('#listtransaksi-grid').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax":{
				url :"../data/listsaldo.php", 
				type: "post", 
				error: function(){  
					$(".listtransaksi-grid-error").html("");
					$("#listtransaksi-grid").append('<tbody class="listtransaksi-grid-error"><tr><th colspan="5">Data kosong</th></tr></tbody>');
					$("#listtransaksi-grid_processing").css("display","none");		
				}
			},
			"language": {
				"url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
				"sEmptyTable": "Tidak ada data di database"
			}
		} );
	} );

</script>

<div style="margin-top: 50px;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top" id="listtrx">
	<div style="margin-top: 3px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;">
		<div class="feed" id="feed" style="height: 50px;">
			<div style="float: left;margin: -7px 10px 0px 0px;">
				<p>Saldo Kamu : Rp.
					<?php 
					require_once '../module/saldo.php';
					$saldo = new saldo();
					$saldodata = $saldo->data(); 
					echo $saldodata;
					?>
				</p>
				<p>Pending Withdraw : Rp.
					<?php 
					require_once '../module/saldo.php';
					$saldo = new saldo();
					$datapending = $saldo->datapending(); 
					echo $datapending;
					?>
				</p>
			</div>
			<a class="btn-pesan" href="withdrawal.php">
				<span style="background: #2B838D;color: #fff; float: right;width: auto;text-align: center;font-weight: bold;padding: 5px;">LIHAT PENARIKAN</span>
			</a>
		</div>
	</div>

	<div class="search-content" style="background: #fff;padding: 0px 10px;" >
		<h3>Riwayat Saldo</h3>
		<hr>
		<div style="width: 100%;overflow: auto;">
			<table id="listtransaksi-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%" >
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Keterangan</th>
						<th>Jumlah Saldo</th>
						<th>Status</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
<?php
include 'template/footer2.php';
?>
