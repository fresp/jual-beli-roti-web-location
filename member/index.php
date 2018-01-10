<?php
session_start();
error_reporting(0);
if($_SESSION['login'] ==""){
	$_SESSION['alert'] = 'accdenied';
	header('Location:../index.php');
}
include 'template/head.php';
$idlapak = $_SESSION['lpk_id'];
if($_SESSION['alert']=='saveinfo'){
	?>
	<script type='text/javascript'>
		$(document).ready( function () {
			cheers.success({
				title: 'Update Berhasil',
				message: 'Data akun berhasil diperbaruhi',
				alert: $('select[name="alert"]').val(),
			});
		}); 
	</script>
	<?php
	unset($_SESSION['alert']);
}
elseif($_SESSION['alert']=='tambahproduk'){
	?>
	<script type='text/javascript'>
		$(document).ready( function () {
			cheers.success({
				title: 'Produk ditambahkan',
				message: 'Sedang tahap review',
				alert: $('select[name="alert"]').val(),
			});
		}); 
	</script>
	<?php
	unset($_SESSION['alert']);
}
elseif($_SESSION['alert']=='withdrawalsukses'){
	?>
	<script type='text/javascript'>
		$(document).ready( function () {
			cheers.success({
				title: 'Tarik Tunai Sukses',
				message: 'Sedang tahap review',
				alert: $('select[name="alert"]').val(),
			});
		}); 
	</script>
	<?php
	unset($_SESSION['alert']);
}
elseif($_SESSION['alert']=='withdrawalgagal'){
	?>
	<script type='text/javascript'>
		$(document).ready( function () {
			cheers.success({
				title: 'Tarik Tunai Gagal',
				message: 'Sedang tahap review',
				alert: $('select[name="alert"]').val(),
			});
		}); 
	</script>
	<?php
	unset($_SESSION['alert']);
}
elseif($_SESSION['alert']=='listkosong'){
	?>
	<script type='text/javascript'>
		$(document).ready( function () {
			cheers.success({
				title: 'List Pembelian',
				message: 'List Pembelian Kosong',
				alert: $('select[name="alert"]').val(),
			});
		}); 
	</script>
	<?php
	unset($_SESSION['alert']);
}
elseif($_SESSION['alert']=='updateproduk'){
	?>
	<script type='text/javascript'>
		$(document).ready( function () {
			cheers.success({
				title: 'Produk diperbaruhi',
				message: 'Produk berhasil diperbaruhi',
				alert: $('select[name="alert"]').val(),
			});
		}); 
	</script>
	<?php
	unset($_SESSION['alert']);
}elseif($_SESSION['alert']=='tokoopen'){
	?>
	<script type='text/javascript'>
		$(document).ready( function () {
			cheers.success({
				title: 'Buka Toko',
				message: 'Toko Berhasil dibuka',
				alert: $('select[name="alert"]').val(),
			});
		}); 
	</script>
	<?php
	unset($_SESSION['alert']);
}
?>

?>
<div style="margin-top: 90px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
	<div class="feed" id="feed" style="height: 50px;">
		<img src="../assets/img/default-dp.png" style="width: 50px;float: left;">
		<div style="float: left;margin: -7px 10px 0px 0px;padding: 10px;">
			<p style="margin: 3px;font-weight: bold;color: #2B838D;">Selamat Datang</p>
			<p style="margin: 3px;"><?php echo $_SESSION['email']?></p>
		</div>
	</div>
</div>
<div style="margin-top: 3px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
	<div class="feed" id="feed" style="height: 50px;">
		<div style="float: left;margin: -7px 10px 0px 0px;padding: 10px;">
			<p style="margin: 3px;font-weight: bold;color: #2B838D;">Saldo Kamu</p>
			<p style="margin: 3px;">Rp.
				<?php 
				require_once '../module/saldo.php';
				$saldo = new saldo();
				$saldodata = $saldo->data(); 
				echo $saldodata;
				?>
			</p>
		</div>
		<a href="saldo.php" class="btn-pesan">
			<span style="background: #2B838D;color: #fff; float: right;width: 100px;text-align: center;font-weight: bold;padding: 5px;">Lihat</span>
		</a>
	</div>
</div>
<div style="margin-top: 3px;background: #fff;padding: 10px;text-align: center;" class="container container-top">
	<?php
	if($idlapak){
		?>
		<a href="add_product.php" class="btn-pesan" style="float: none;width: 60%;text-align: center; ">Tambah Produk</a>
		<?php
	}else{
		?>
		<a href="joinseller.php" class="btn-pesan" style="float: none;width: 60%;text-align: center; ">Buka Toko</a>
		<?php
	}
	?>
</div>
<div style="margin-top: 3px;background: #fff;padding: 10px;border-bottom: 3px solid #eee; overflow: auto;" class="container container-top">
	
	
	<div class="column-12" style="padding: 0px;margin: 5px 0px 5px 0px">
		<div class="column-1">
		</div>
		<div class="column-11"><hr style="width: 100%">
		</div>
	</div>
	<?php
	if($idlapak){
		?>
		<div class="column-12" style="padding: 0px;margin: 5px 0px 5px 0px">
			<div class="column-10">
			<span style="font-weight: bold;font-size: 19px;"><a href="transactions.php?list=sell">Daftar Penjualan</a></span>
				
			</div>
		</div>	
		<div class="column-12" style="padding: 0px;margin: 5px 0px 5px 0px">
			<div class="column-10">
				<button type="button" id="btnbarang" class="btnnavbar" style="text-align: left;margin-top: -7px;">
					<span style="font-weight: bold;font-size: 19px;"><a href="#">Produk Saya</a></span>
				</button>
			</div>
			<div class="column-1" ><i id="tooglebarang" class="fa fa-angle-left" style="font-size: 19px;"></i>
			</div>
		</div>
		<script type="text/javascript">
			var button = document.getElementById('btnbarang');
			button.onclick = function() {
				var div = document.getElementById('subbarang');
				if (div.style.display !== 'none') {
					div.style.display = 'none';
					$("#tooglebarang").removeClass("fa fa-angle-down");
					$("#tooglebarang").addClass("fa fa-angle-left");
				}
				else {
					div.style.display = 'block';
					$("#tooglebarang").removeClass("fa fa-angle-left");
					$("#tooglebarang").addClass("fa fa-angle-down");
				}
			};
		</script>
		<div id="subbarang" style="display: none;">
			<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
				<div class="column-1">
				</div>
				<a href="produk.php?aksi=dijual" style="width: 100%;">
					<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Produk dijual</span><br>
					</div>
				</a>

			</div>
			<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
				<div class="column-1">
				</div>
				<a href="produk.php?aksi=nonaktif" style="width: 100%;">
					<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Produk tidak dijual</span><br>
					</div>
				</a>
			</div>
			<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
				<div class="column-1">
				</div>
				<a href="produk.php?aksi=diblokir" style="width: 100%;">
					<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Produk diblokir</span><br>
					</div>
				</a>
			</div>
			<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
				<div class="column-1">
				</div>
				<a href="produk.php?aksi=tahap review" style="width: 100%;">
					<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Produk Sedang Review</span><br>
					</div>
				</a>
			</div>
		</div>	
		
		
		
		<?php
	}
	?>	
	<div class="column-12" style="padding: 0px;margin: 5px 0px 5px 0px">
		<div class="column-10">
			<button type="button" id="btnbeli" class="btnnavbar" style="text-align: left;margin-top: -7px;">
				<span style="font-weight: bold;font-size: 19px;"><a href="#">Pembelian</a></span>
			</button>
		</div>
		<div class="column-1" ><i id="tooglebeli" class="fa fa-angle-left" style="font-size: 19px;"></i>
		</div>
	</div>
	<script type="text/javascript">
		var button = document.getElementById('btnbeli');
		button.onclick = function() {
			var div = document.getElementById('subbeli');
			if (div.style.display !== 'none') {
				div.style.display = 'none';
				$("#tooglebeli").removeClass("fa fa-angle-down");
				$("#tooglebeli").addClass("fa fa-angle-left");
			}
			else {
				div.style.display = 'block';
				$("#tooglebeli").removeClass("fa fa-angle-left");
				$("#tooglebeli").addClass("fa fa-angle-down");
			}
		};
	</script>
	<div id="subbeli" style="display: none;">
		<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
			<div class="column-1">
			</div>
			<a href="?aksi=hayoooo" style="width: 100%;">
				<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Daftar Pembelian</span><br>
				</div>
			</a>
		</div>
		<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
			<div class="column-1">
			</div>
			<a href="?aksi=hayoooo" style="width: 100%;">
				<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Transaksi dibatalkan</span><br>
				</div>
			</a>
		</div>

	</div>	
</div>
<?php
include 'template/footer2.php';

?>
