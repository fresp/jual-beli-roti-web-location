<?php
session_start();
?>
<div class="column-12">
	<label>Lokasi</label>
	<div class="search_style" id="search_style">
		<a href="#loginmodal" id="modaltrigger" style="background: #d8e932;">
			<span class="fa fa-map-marker" style="color: #FF5454;">
				<?php
				if($_SESSION['lpknerbie']==""){
					echo "</span> Tentukan Lokasimu";
				}
				else{
					$teks = $_SESSION['lpknerbie'];
						              //pecah string berdasarkan string ","
					$pecah = explode(",", $teks);
						              //mencari element array 0
					$hasil = $pecah[0];
						              //tampilkan hasil pemecahan

					echo "5 KM </span> dari ".$hasil;
				}
				?>
		</a>
	</div>
</div>
<input class="kb-input" name="lpklon" style="" value="<?php echo $_SESSION['lpklon']?>" placeholder="Nama Produk" type="hidden">
<input name="lpknerbie" value="<?php echo $_SESSION['lpknerbie']?>" type="hidden">
<input name="lpklat" value="<?php echo $_SESSION['lpklat']?>" type="hidden">