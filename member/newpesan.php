<?php
session_start();
$idproduk = $_POST['idproduk'];
error_reporting(0);
include 'template/head.php';


require_once '../module/produk.php';
$produk = new produk();
$sellerData = $produk->newpesan($idproduk); 
echo $sellerData;
?>

<div style="margin-top: 3px;background: #fff;padding: 10px;text-align: center;" class="container container-top">
	<a href="add_product.php" class="btn-pesan" style="float: none;width: 60%;text-align: center; ">Tambah Produk</a>
</div>
<div style="margin-top: 3px;background: #fff;padding: 10px;border-bottom: 3px solid #eee; overflow: auto;" class="container container-top">
	<div class="column-12" style="padding: 0px;margin: 5px 0px 5px 0px">
		<div class="column-1"><i class="fa fa-envelope-o" style="font-size: 19px;"></i>
		</div>
		<a href="?aksi=hayoooo" style="width: 100%;">
			<div class="column-9"><span style="font-weight: bold;font-size: 19px;">Pesan</span><br>
			</div>
			<div class="column-1"><span style="background: #ef1313;padding: 5px;border-radius: 10px;color: #fff;">100</span>
			</div>
		</a>
	</div>
	<div class="column-12" style="padding: 0px;margin: 5px 0px 5px 0px">
		<div class="column-1"><i class="fa fa-bell-o" style="font-size: 19px;"></i>
		</div>
		<a href="?aksi=hayoooo" style="width: 100%;">
			<div class="column-9"><span style="font-weight: bold;font-size: 19px;">Notifikasi</span><br>
			</div>
			<div class="column-1"><span style="background: #ef1313;padding: 5px;border-radius: 10px;color: #fff;">100</span>
			</div>
		</a>
	</div>
	<div class="column-12" style="padding: 0px;margin: 5px 0px 5px 0px">
		<div class="column-1">
		</div>
		<div class="column-11"><hr style="width: 100%">
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
			<a href="?aksi=hayoooo" style="width: 100%;">
				<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Produk dijual</span><br>
				</div>
			</a>

		</div>
		<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
			<div class="column-1">
			</div>
			<a href="?aksi=hayoooo" style="width: 100%;">
				<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Produk tidak dijual</span><br>
				</div>
			</a>
		</div>
	</div>	
	<div class="column-12" style="padding: 0px;margin: 5px 0px 5px 0px">
		<div class="column-10">
			<button type="button" id="btnjual" class="btnnavbar" style="text-align: left;margin-top: -7px;">
				<span style="font-weight: bold;font-size: 19px;"><a href="#">Penjualan</a></span>
			</button>
		</div>
		<div class="column-1" ><i id="tooglejual" class="fa fa-angle-left" style="font-size: 19px;"></i>
		</div>
	</div>
	<script type="text/javascript">
		var button = document.getElementById('btnjual');
		button.onclick = function() {
			var div = document.getElementById('subjual');
			if (div.style.display !== 'none') {
				div.style.display = 'none';
				$("#tooglejual").removeClass("fa fa-angle-down");
				$("#tooglejual").addClass("fa fa-angle-left");
			}
			else {
				div.style.display = 'block';
				$("#tooglejual").removeClass("fa fa-angle-left");
				$("#tooglejual").addClass("fa fa-angle-down");
			}
		};
	</script>
	<div id="subjual" style="display: none;">
		<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
			<div class="column-1">
			</div>
			<a href="?aksi=hayoooo" style="width: 100%;">
				<div class="column-9"><span style="font-weight: bold;font-size: 19px;">Order Baru</span><br>
				</div>
			</a>
			<div class="column-1"><span style="background: #ef1313;padding: 5px;border-radius: 10px;color: #fff;">100</span>
			</div>
		</div>
		<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
			<div class="column-1">
			</div>
			<a href="?aksi=hayoooo" style="width: 100%;">
				<div class="column-9"><span style="font-weight: bold;font-size: 19px;">Konfirmasi Pengiriman</span><br>
				</div>
			</a>
			<div class="column-1"><span style="background: #ef1313;padding: 5px;border-radius: 10px;color: #fff;">100</span>
			</div>
		</div>
		<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
			<div class="column-1">
			</div>
			<a href="?aksi=hayoooo" style="width: 100%;">
				<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Daftar Penjualan</span><br>
				</div>
			</a>
		</div>
	</div>	
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
				<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Status Pembayaran</span><br>
				</div>
			</a>
		</div>
		<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
			<div class="column-1">
			</div>
			<a href="?aksi=hayoooo" style="width: 100%;">
				<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Status Pemesanan</span><br>
				</div>
			</a>
		</div>
		<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
			<div class="column-1">
			</div>
			<a href="?aksi=hayoooo" style="width: 100%;">
				<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Konfirmasi Penerimaan</span><br>
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
		<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
			<div class="column-1">
			</div>
			<a href="?aksi=hayoooo" style="width: 100%;">
				<div class="column-10"><span style="font-weight: bold;font-size: 19px;">Daftar Pembelian</span><br>
				</div>
			</a>
		</div>
	</div>	
</div>
<?php
include 'template/footer2.php';
?>
