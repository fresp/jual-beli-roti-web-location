<?php
session_start();
?>
<div class="search-content" style=" height: 89%; overflow-y: scroll;">
	<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/roti/config/database.php';	
	$memid =$_SESSION['iduser'];

	$db = new database();
	$mysqli = $db->connect(); 
	$sql = "SELECT l.lpk_name,l.lpk_id,Sum(c.cart_qty)  AS subtotal,sum(c.cart_qty *p.pro_saleprice) as hasil FROM cart c JOIN produk p ON c.pro_id=p.pro_id JOIN lapak l ON l.lpk_id=p.lpk_id where c.mem_id like '$memid' GROUP BY p.lpk_id ";

	$result = $mysqli->query($sql);
	$i= 1; 
	while($r = $result->fetch_array()):
		$lpk = $r[1];
	?>
	<div class="column-12">
		<div class="tab" style="margin-top: 1em;">
			<div  style="float: left;">
				<b>Penjual  : </b> <a href="../<?php echo $r[0] ?>"> <?php echo $r[0];?></a>
			</div>
			<div style="float: right;">
				Rp5.000 : <b>Ongkir </b>
			</div>
		</div>
		<div class="tab">
			<?php
			$sql2 = "SELECT c.cart_id, p.pro_name,p.pro_saleprice,Sum(c.cart_qty) AS total FROM cart c JOIN produk p ON c.pro_id=p.pro_id JOIN lapak l ON l.lpk_id=p.lpk_id where l.lpk_id like '$lpk' GROUP by p.pro_name ";
			$result2 = $mysqli->query($sql2);

			while($r2 = $result2->fetch_array()):



				?>
			<div class="rev-content" >
				<div class="rev-user" style="margin-left: -20px;" >
					<div class="rev-user-img" >
						<img src="http://warungmodern.co/assets/img/default-dp.png" style="height: 50px;width: 50px;">
					</div>
				</div>
				<div class="rev-user-feed" style="width: 87%;margin-right: -20px;">
					<h6 style="background: #fff;color: #000; width: 90%;"><?php echo $r2['pro_name']; ?> </h6>
					<div class="column-3" style="padding: 4px;">
						Rp. 
						<?php
						$angka = $r2['pro_saleprice'];
						$jumlah_desimal ="0";
						$pemisah_desimal =",";
						$pemisah_ribuan =".";
						echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
						?> 


					</div>
					<div class="column-9">
						<span style="font-style: italic;font-size: 11px;">
							<form  id="frm-cart<?php echo $r2['cart_id']; ?>" method="POST">
								<input step="1"  min="1" max="" name="quantity" value="<?php echo $r2['total'] ?>" title="Qty" class="product-qty" size="4" pattern="[0-9]*" inputmode="numeric" type="number">
								<input type="text" name="id" value="<?php echo $r2['cart_id']; ?>" hidden>

								<a id="del" class="btn-pesan del" style="background: #CD220C;;">Delete</a> 
								<a id="update" name="<?php echo $r2['cart_id']; ?>" class="btn-pesan update" style="background: #0CC0D4;;">Update</a> 
							</form>
						</span>
					</div>
				</div>
			</div>
			<?php

			endwhile;

			?>

			<div class="ongkir-content">
				<div class="column-6" style="text-align:  left;">Total <?php echo $r['subtotal'];?> barang<br>
					Rp. 
					<?php
					$angka = $r['hasil'];
					$jumlah_desimal ="0";
					$pemisah_desimal =",";
					$pemisah_ribuan =".";
					echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
					?> 

				</div>
				<div class="column-6" style="text-align: right;">
					<a class="btn-pesan" style="width: 120px;text-align: center;">Bayar</a> 
				</div>

			</div>

		</div>
	</div>
	<?php
	$i++;
	endwhile;
	?>
</div>
<footer style="border-top: 2px solid #d2d2d2;box-shadow: 2px 0 0 rgba(0, 0, 0, .13);display: inline-block;width: 100%;padding: 7px;margin-top: 10px;">
	<div class="column-6" style="text-align: left;">
		Total 
		<?php
		$sql3 = "SELECT Sum(c.cart_qty) AS total,sum(c.cart_qty *p.pro_saleprice) as hasil FROM cart c JOIN produk p ON c.pro_id=p.pro_id JOIN lapak l ON l.lpk_id=p.lpk_id where c.mem_id like '1' limit 1  ";
		$result = $mysqli->query($sql3);
		$i= 1; 
		while($r3 = $result->fetch_array()):
			echo $r3['total'];

		?>
		barang<br>
		Rp. <?php
		$angka = $r3['hasil'];
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		endwhile;
		?>
	</div>
	<div class="column-6">
		<a class="btn-pesan">Bayar Semua</a> 
	</div>
</footer>
