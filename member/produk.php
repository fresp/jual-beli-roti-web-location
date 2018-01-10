<?php


include 'template/head.php';
$idlapak = $_SESSION['lpk_id'];
$aksi = $_GET['aksi'];
if($_SESSION['login'] ==""){
	$_SESSION['alert'] = 'accdenied';
	header('Location:../index.php');
}
if($aksi=="dijual"){
	$filter = "dijual";
	$name= "Dijual";
}elseif($aksi=="nonaktif"){
	$filter = "tidak";
	$name= "Nonaktif";
}elseif($aksi=="diblokir"){
	$filter = "diblokir";
	$name ="di diblokir";
}elseif($aksi=="tahap review"){
	$filter = "review";
	$name ="Sedang direview";
}elseif(!$aksi){
	$filter = "dijual";
	$name ="Dijual";
}else{
	echo "<script>alert('Page Not Found');</script>"; 
  	echo "<script>history.go(-1);</script>";
}

?>
<div style="margin-top: 50px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
	<?php
	if($_SESSION['alert']=='berhasildiupdate'){
		?>
		<script type='text/javascript'>
			$(document).ready( function () {
				cheers.success({
					title: 'Hapus Produk',
					message: 'Produk Berhasil dihapus',
					alert: $('select[name="alert"]').val(),
				});
			}); 
		</script>
		<?php
		unset($_SESSION['alert']);
	}
	?>
	<div class="feed" id="feed" style="height: 30px;">
		<div style="float: left;margin: -7px 10px 0px 0px;padding: 10px;">
			<p style="margin: -5px;font-weight: bold;color: #2B838D;"><a href="add_product.php" class="btn-pesan" style="text-align: center; ">Tambah Produk</a><a href="?aksi=dijual">Produk Dijual</a> || <a href="?aksi=tahap review">Sedang Direview</a> || <a href="?aksi=nonaktif">Tidak dijual</a></p>

		</div>
	</div>
</div>
<div style="margin-top: 3px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
	<div class="feed" id="feed">
        <ul class="product-list"  id="updates">
          <?php 
          require_once '../module/produk.php';
          $produk = new produk();
          $databarang = $produk->databarang($idlapak,$filter); 
          echo $databarang;
          ?>
        </ul>
       
     </div>
</div>
<?php
include 'template/footer2.php';
?>
