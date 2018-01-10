<?php
date_default_timezone_set('Asia/Jakarta');	
// buat class member
class payment {
	public function __construct() {
		require_once $_SERVER['DOCUMENT_ROOT'].'/roti/config/database.php';	
	}
	public function cartselected($id,$pesan,$total,$payment,$custid){
		$db = new database();		
		$mysqli = $db->connect();
		$lat2 = $_SESSION['lat'];
		$long2 = $_SESSION['lon'];
		$today = date('Y-m-d H:i:s');
		$iduser =$_SESSION['iduser'];
		$kalimat = "c.cart_id Like ". str_replace('-', ' OR c.cart_id Like ', $id);
		$date = date_create($today);
		if($payment == "cod"){
			$status = "lunas";
			$ostat = 'Menunggu Penjual';
		}else{
			$status = "Menunggu Pembayaran";
			$ostat = 'Menunggu Pembayaran';
			
		}
		date_add($date, date_interval_create_from_date_string('8 hours'));
		$duedate = date_format($date, 'Y-m-d H:i:s');
		$ins = "INSERT INTO invoice (inv_date, inv_duedate, mem_id, inv_totalpayment, inv_method, inv_status,cust_id,inv_note) VALUES ('$today', '$duedate', '$iduser', '$total', '$payment','$status','$custid','$pesan')";
		$insert = $mysqli->query($ins);

		if($insert){
			$sql = "SELECT max(inv_id) as invoicekamu FROM invoice WHERE mem_id ='$iduser'";
			$cek =$mysqli->query($sql);
			$hasil = $cek->fetch_array();
			if($hasil[0] != NULL){
				$invoicekamu = $hasil['invoicekamu'];
				$sql = "SELECT l.lpk_name,c.mem_id,l.lpk_id,l.lpk_username,l.lpk_freeongkir,Sum(c.cart_qty)  AS subtotal,sum(c.cart_qty *p.pro_saleprice) as hasil,(6371 * acos(cos(radians(".$lat2.")) 
				* cos(radians(l.lpk_lat)) * cos(radians(l.lpk_long) 
				- radians(".$long2.")) + sin(radians(".$lat2.")) 
				* sin(radians(lpk_lat)))) 
				AS jarak  FROM cart c JOIN produk p ON c.pro_id=p.pro_id JOIN lapak l ON l.lpk_id=p.lpk_id where c.mem_id like '$iduser' AND $kalimat GROUP BY p.lpk_id  HAVING jarak <= '5'";
				$result = $mysqli->query($sql);
				while($r = $result->fetch_array()):
					$lpk = $r[1];
				$id =  $r['lpk_id'];
				$free= $r['lpk_freeongkir'];
				$mem_id =  $r['mem_id'];
				$jarak = ceil($r['jarak'])*5000;
				if($payment == "cod"){
					$jarak = ceil($r['jarak'])*5000;
					$diskon = 0.3;
					if($free==1){
						$ongkir =0;
					}else{
						$ongkir = $jarak+($jarak*$diskon);
					}
				}else{
					$jarak = ceil($r['jarak'])*5000;
					if($free==1){
						$ongkir =0;
					}else{
						$ongkir = $jarak;
					}
					$smember = "SELECT mem_phone FROM member where mem_id like '$iduser'";
					$rmember = $mysqli->query($smember);
					$rm = $rmember->fetch_array();
					$userkey = "1xwp4q";
					$passkey = "putri11";
					$telepon= $rm['mem_phone'];
					$message="[WM]  Segera selesaikan pembelian kamu\nInvoice : #$invoicekamu\nTotal Bayar : Rp.$total\nINFO LENGKAP : http://warungmodern.co/finish.php?inv=$invoicekamu\nTerimakasih";
					$url = "https://reguler.zenziva.net/apps/smsapi.php";
					$curlHandle = curl_init();
					curl_setopt($curlHandle, CURLOPT_URL, $url);
					curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
					curl_setopt($curlHandle, CURLOPT_HEADER, 0);
					curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
					curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
					curl_setopt($curlHandle, CURLOPT_POST, 1);
					$results = curl_exec($curlHandle);
					curl_close($curlHandle);
				}
				$grand= ($r['hasil']+$ongkir);
				$ins = "INSERT INTO orders(inv_id,lpk_id,mem_id,order_shippingtotal,order_grandtotal,order_status)VALUES ('$invoicekamu','$id','$mem_id', '$ongkir','$grand','$ostat')";
				$insert = $mysqli->query($ins);
				if($insert){
					$sql = "SELECT max(order_id) as orderkamu FROM orders WHERE lpk_id ='$id' and mem_id ='$mem_id'";
					$cek =$mysqli->query($sql);
					$hasil = $cek->fetch_array();
					if($hasil[0] != NULL){
						$orderkamu = $hasil['orderkamu'];
						$sql1 = "SELECT c.cart_id,p.pro_id,p.pro_name,p.pro_saleprice,c.cart_qty,(6371 * acos(cos(radians(".$lat2.")) * cos(radians(l.lpk_lat)) * cos(radians(l.lpk_long) - radians(".$long2.")) + sin(radians(".$lat2.")) * sin(radians(lpk_lat)))) AS jarak FROM cart c JOIN produk p ON c.pro_id=p.pro_id JOIN lapak l ON l.lpk_id=p.lpk_id where c.mem_id like '$mem_id' and l.lpk_id like '$id' HAVING jarak <= '5' ";
						$result1 = $mysqli->query($sql1);
						while($r = $result1->fetch_array()):
							$tambah = $r['pro_saleprice']*$r['cart_qty'];
						$pro_id =$r['pro_id'];
						$pro_name =$r['pro_name'];
						$pro_saleprice =$r['pro_saleprice'];
						$cart_qty =$r['cart_qty'];
						$ins = "INSERT INTO order_detail(order_id,pro_id,pro_name,pro_price,dtl_qty,dtl_subtotal)VALUES ('$orderkamu','$pro_id', '$pro_name','$pro_saleprice','$cart_qty',$tambah)";
						$insert = $mysqli->query($ins);
						endwhile;
					}
				}
				$del = "DELETE c FROM cart c JOIN produk p ON c.pro_id=p.pro_id JOIN lapak l ON l.lpk_id=p.lpk_id where l.lpk_id = '$id' and c.mem_id ='$mem_id'";
				$delete = $mysqli->query($del);
				endwhile;
			}
			header('Location:../finish.php?inv='.$invoicekamu);
		}

		$mysqli->close();

	}
	function listcart($selected){
		$memid =$_SESSION['iduser'];
		$kalimat = "c.cart_id Like ". str_replace('-', ' OR c.cart_id Like ', $selected);
		$lat2 = $_SESSION['lat'];
		$long2 = $_SESSION['lon'];
		$db = new database();
		$mysqli = $db->connect(); 
		$sql = "SELECT cart_id FROM cart WHERE mem_id LIKE '$memid' GROUP BY pro_id";
		$result = $mysqli->query($sql);
		$hasil = $result->fetch_array();
		if($hasil[0] != NULL){
			?>

			<?php
			$sql = "SELECT l.lpk_name,l.lpk_id,l.lpk_username,l.lpk_freeongkir,Sum(c.cart_qty)  AS subtotal,sum(c.cart_qty *p.pro_saleprice) as hasil,(6371 * acos(cos(radians(".$lat2.")) 
			* cos(radians(l.lpk_lat)) * cos(radians(l.lpk_long) 
			- radians(".$long2.")) + sin(radians(".$lat2.")) 
			* sin(radians(lpk_lat)))) 
			AS jarak  FROM cart c JOIN produk p ON c.pro_id=p.pro_id JOIN lapak l ON l.lpk_id=p.lpk_id where c.mem_id like '$memid' AND $kalimat GROUP BY p.lpk_id  HAVING jarak <= '5'";
			$cek = $mysqli->query($sql);
			$hasil1 = $cek->fetch_array();
			$result = $mysqli->query($sql);
			if($hasil1[0] == NULL){
				?>
				<div class="search-content" style=" height: 87%; overflow-y: scroll;">	
					<p style="padding-top: 250px;font-weight: bold;">Sistem Error</p>
				</div>
				<?php
			}else{
				?>
				<div class="search-content" style=" height: 87%; overflow-y: scroll;">
					<?php
					$i= 1; 
					$subtotal = array();
					while($r = $result->fetch_array()):
						$lpk = $r[1];
					$ongkir =$r['lpk_freeongkir'];
					$subtotal[] =  $r['hasil'];
					if($ongkir=="1"){
						$jarak = 0;
					}else{
						$jarak = ceil($r['jarak'])*5000;
					}
					?>
					<div class="column-12" style="padding: 0px;">
						<div class="tab" style="margin-top: 1em;">
							<div  style="float: left; padding-right: 15px">
								<b>Penjual  : </b> <a href="<?php echo $r[2] ?>"> <?php echo $r[0];?></a>
							</div>
							<div  style="float: right;padding-left: 15px">
								
								<?php
								if($jarak=="0"){
									echo "Gratis Ongkir";
								}else{
									$angka = $jarak;
									$jumlah_desimal ="0";
									$pemisah_desimal =",";
									$pemisah_ribuan =".";
									echo "Rp. ".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
								}
								
								?> 
								<i class="fa  fa-truck"></i>
							</div>
							<div  style="float: right;padding-left: 15px;display: none" data-exval="<?php echo $i?>" class="totalongkir">
								<?php
								echo $jarak;
								?>

							</div>
						</div>
						<div class="tab">
							<?php
							$sql2 = "SELECT c.cart_id, p.pro_name,p.pro_saleprice,p.pro_image,Sum(c.cart_qty) AS total FROM cart c JOIN produk p ON c.pro_id=p.pro_id JOIN lapak l ON l.lpk_id=p.lpk_id where l.lpk_id like '$lpk' AND c.mem_id like '$memid'  GROUP by p.pro_name ";
							$result2 = $mysqli->query($sql2);
							while($r2 = $result2->fetch_array()):
								?>
							<div class="rev-content" style="height: 60px;" >
								<div class="rev-user" style="margin-left: 0px;" >
									<div class="rev-user-img" >
										<img src="http://warungmodern.co/assets/uploads/<?php echo $r2['pro_image'];?>" style="height: 50px;width: 50px;">
									</div>
								</div>
								<div class="rev-user-feed" style="width: 87%;margin-right: -20px;">
									<h6 style="background: #fff;color: #000; width: 90%;"><?php echo $r2['pro_name']; ?> </h6>
									<div class="column-6" style="padding: 4px;">
										Rp. 
										<?php
										$angka = $r2['pro_saleprice'];
										$jumlah_desimal ="0";
										$pemisah_desimal =",";
										$pemisah_ribuan =".";
										echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
										?> 


									</div>
									<div class="column-6" style="text-align:  right;margin-top: 0px">Jumlah <?php echo $r2['total'] ?> <br>


									</div>
								</div>
							</div>
							<?php

							endwhile;

							?>

							<div class="ongkir-content">
								<div class="column-6" style="text-align:  left;">Total <?php echo $r['subtotal'];?> barang<br>



								</div>
								<div class="column-6" style="text-align: right;">
									<h4 style="font-weight: bold;margin: 0px;text-align: right;">
										Rp.
										<?php
										$angka = $r['hasil'];
										$jumlah_desimal ="0";
										$pemisah_desimal =",";
										$pemisah_ribuan =".";
										echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
										?> 
									</h4>
								</div>
								<div  style="float: right;padding-left: 15px;display: none" class="subtotal">
									<?php
									echo $r['hasil'];;
									?> 
								</div>

							</div>

						</div>
					</div>
					<?php
					$i++;
					endwhile;
					?>
				</div>


				<?php
			}
		}else{
			?>
			<div class="search-content" style=" height: 87%; overflow-y: scroll;">	
				<p style="padding-top: 250px;font-weight: bold;">Sistem Error</p>
			</div>
			<?php
		}
	}

	function addalamat($alamat,$nomer,$penerima){
		$db = new database();
		$mysqli = $db->connect();
		$nerbie = $_SESSION['nerbie'];
		$lat = $_SESSION['lat'];
		$lon = $_SESSION['lon'];
		$memid =$_SESSION['iduser'];
		$sql = "INSERT INTO customer (cust_id, mem_id, cust_lat, cust_long, cust_receivedname, cust_address, cust_phone, cust_nerbie) VALUES (NULL, '$memid', '$lat', '$lon', '$penerima', '$alamat', '$nomer', '$nerbie');";
		$result = $mysqli->query($sql);       
		if ($result) {
			echo "Berhasil";
		}else {
			echo "Gagal ||".$alamat."||".$nomer."||".$penerima."||".$lat."||".$lon."||".$memid."||
			".$nerbie;
		}

		$mysqli->close();

	}
	function alamatload(){
		$db = new database();
		$mysqli = $db->connect();
		$memid =$_SESSION['iduser'];
		$nerbie = $_SESSION['nerbie'];
		$sql = "SELECT cust_receivedname,cust_address,cust_phone,cust_id FROM customer WHERE mem_id LIKE '$memid' AND cust_nerbie LIKE '$nerbie' ORDER BY cust_id  DESC";
		$result = $mysqli->query($sql);
		$hasil = $result->fetch_array();
		?>
		<span class="custid" style="font-weight: bold;display: none"><?php echo $hasil['cust_id'];?></span>

		<span style="font-weight: bold">Nama Penerima : </span> <?php echo $hasil['cust_receivedname'];?><br>
		<span style="font-weight: bold">Nomer Telepon : </span> <?php echo $hasil['cust_phone'];?><br>
		<span style="font-weight: bold">Alamat : </span><br> <?php echo $hasil['cust_address'];?><br>
		<script type="text/javascript">
			$("#isitotal").val(sum);
			var idcust =  $('.custid').text();
			$("#isicust").val(idcust);
		</script>
		<?php
	}
	function finish($inv){
		$db = new database();
		$memid =$_SESSION['iduser'];
		$mysqli = $db->connect(); 
		$sql = "SELECT inv_method,inv_totalpayment FROM invoice WHERE inv_id ='$inv' and mem_id = '$memid'";
		$result = $mysqli->query($sql);
		$hasil = $result->fetch_array();
		$mthd = $hasil['inv_method'];
		$total = $hasil['inv_totalpayment'];
		if(!$hasil){
			$_SESSION['alert']='404';
			header('Location:index.php');
		}
		?>
		<div style="margin-top: 50px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
			<div class="feed" id="feed" style="text-align: center">
				<span style="font-weight: bold;">Proses Pemesanan Selesai</span>
			</div>
		</div>
		<div style="margin-top: 3px;background: #fff;padding: 10px;" class="container container-top">
			<div class="feed" id="feed" style="text-align: center">
				<span style="">Invoice Anda</span><br>
				<span style="font-weight: bold; ">#<?php echo  $inv ?></span>
			</div>
		</div>
		<div style="margin-top: 3px;background: #fff;padding: 10px;" class="container container-top">
			<div class="feed" id="feed" style="text-align: center">
				<span style="">Anda memilih metode pembayaran</span><br>
				<?php
				if($mthd=="bca"){
					?>
					<span style="font-weight: bold; ">Transfer Bank BCA</span>
					<?php
				}elseif($mthd=="mandiri"){
					?>
					<span style="font-weight: bold; ">Transfer Bank mandiri</span>
					<?php
				}else{
					?>
					<span style="font-weight: bold; ">COD (Bayar Ditempat)</span>
					<?php
				}
				?>
				<div class="feed" id="feed" style="text-align: center">
					<h2 style="font-weight: bold;">Rp.<?php 
						$angka = $total;
						$jumlah_desimal ="0";
						$pemisah_desimal =",";
						$pemisah_ribuan =".";
						echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
						?>
						
					</h2>
				</div>

			</div>
		</div>
		<div style="margin-top: 3px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
			<div class="feed" id="feed" style="text-align: center">
				<?php
				if($mthd=="bca"){
					?>
					<span style="">Nomor Rekening Pembayaran</span><br>
					<span style="font-weight: bold;color: #2B838D">8778006455085050</span><br>
					<span style="">Bank BCA a.n. Freza Nugraha, Kode Bank (013)</span>
					<br>
					<br>
					<span style="text-align: left;"">+Mohon Transfer dalam jangka waktu 3 Jam Sejak pemesanan ini selesai untuk memastikan ketersedian stok.</span><br>
					<span style="text-align: left;">+Mohon Transfer Sesuai Dengan jumlah transfer yang tertera</span>
					<?php
				}elseif($mthd=="mandiri"){
					?>
					<span style="">Nomor Rekening Pembayaran</span><br>
					<span style="font-weight: bold;color: #2B838D">8778006455085050</span><br>
					<span style="">Bank mandiri a.n. Freza Nugraha, Kode Bank (100)</span>
					<br>
					<br>
					<span style="text-align: left;"">+Mohon Transfer dalam jangka waktu 3 Jam Sejak pemesanan ini selesai untuk memastikan ketersedian stok.</span><br>
					<span style="text-align: left;">+Mohon Transfer Sesuai Dengan jumlah transfer yang tertera</span>
					<?php
				}else{
					?>
					<span style="font-weight: bold; "></span>

					<span style="">Penjual segera memproses transaksi kamu</span>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
	function listbuy(){
		$db = new database();
		$memid =$_SESSION['iduser'];
		$mysqli = $db->connect();
		?>
		<div  id="listorder">
			<?php
			$sql = "SELECT inv_id,inv_duedate,inv_status FROM invoice where mem_id like '$memid' ORDER BY inv_id DESC LIMIT 0, 2";
			$result = $mysqli->query($sql);
			while($r = $result->fetch_array()):
				?>
			<div class="search-content" >
				<div class="column-12" style="padding: 0px;">
					<div class="tab" style="margin-top: 1em;">
						<div  style="float: left; padding-right: 15px">
							<b>Invoice  : </b> <a href="order_detail.php?invoice=<?php echo $r['inv_id']?>">#<?php echo $r['inv_id']?></a>
						</div>
						<div  style="float: right;padding-left: 15px">
							<?php 
							$today =date('Y-m-d H:i:s');
							if($today >= $r['inv_duedate'] AND $r['inv_status']== "Menunggu Pembayaran" ){
								echo "Kadarluasa";
							}else{
								echo $r['inv_status'];
							}
							?>	
							<i class="fa  fa-truck"></i>
						</div>
					</div>
					<div class="tab">
						<?php
						$a =$r['inv_id'];
						$sql1 = "SELECT o.order_id,o.inv_id,o.lpk_id,o.mem_id,o.order_shippingtotal,o.order_grandtotal,o.order_shipstat,o.order_status,l.lpk_name,l.lpk_picture  FROM orders o JOIN lapak l ON o.lpk_id=l.lpk_id  where inv_id = '$a'";
						$result1 = $mysqli->query($sql1);
						while($r1 = $result1->fetch_array()):

							?>
						<a href="order_detail.php?orderid=<?php echo $r1['order_id'] ?>" class="trxlist">
							<div class="rev-content" style="height: 60px;" >
								<div class="rev-user" style="margin-left: 0px;" >
									<div class="rev-user-img" >
										<img src="http://warungmodern.co/assets/uploads/lapak/<?php echo $r1['lpk_picture']?>" style="height: 50px;width: 50px;">
									</div>
								</div>
								<div class="rev-user-feed" style="width: 87%;margin-right: -20px;">
									<h6 style="background: #fff;color: #e41d1d; width: 90%;font-weight: unset;margin-top: -5px;">29 Juli 2017, 05 : 35 PM</h6>
									<div class="column-6" style="padding: 0px;">
										<?php echo $r1['lpk_name']?>
										<hr style="margin: 2px;">
										RP.
										<?php
										$angka = $r1['order_grandtotal'];
										$jumlah_desimal ="0";
										$pemisah_desimal =",";
										$pemisah_ribuan =".";
										echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
										?> 
									</div>
									<div class="column-6" style="text-align:  right;margin-top: 0px">
										<?php 
										if($r['inv_status']=="Menunggu Pembayaran"){
											echo "Menunggu Pembayaran";
										}elseif($r1['order_status']=="Diterima Penjual" AND $r1['order_shipstat']!="" ){
											echo $r1['order_shipstat'];
										}else{
											echo $r1['order_status'];
										}
										?>
									</div>
								</div>
							</div>
						</a>
						<?php
						endwhile;
						?>
					</div>
				</div>
			</div>

			<?php
			endwhile;
			$listbuy = $result->fetch_array();

			?>
		</div>
		<div class="facebook_style" id="facebook_style" style="margin:7px 0px 0px 0px;">
			<a id="2" href="#" class="load_moretrx" style="margin-bottom: 0px;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Lihat Lainnya
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="../assets/img/arrow1.png">
			</a>
		</div>
		<?php

	}
	function load_moretrx($idakhir){
		$db = new database();
		$memid =$_SESSION['iduser'];
		$mysqli = $db->connect();
		?>
		<div  id="listorder">
			<?php
			$sql = "SELECT inv_id,inv_duedate,inv_status FROM invoice where mem_id like '$memid' ORDER BY inv_id DESC LIMIT ".$idakhir.", 2 ";
			$result = $mysqli->query($sql);
			while($r = $result->fetch_array()):

				?>
			<div class="search-content" >
				<div class="column-12" style="padding: 0px;">
					<div class="tab" style="margin-top: 1em;">
						<div  style="float: left; padding-right: 15px">
							<b>Invoice  : </b> <a href="order_detail.php?invoice=<?php echo $r['inv_id']?>">#<?php echo $r['inv_id']?></a>
						</div>
						<div  style="float: right;padding-left: 15px">
							<?php 
							$today =date('Y-m-d H:i:s');
							if($today >= $r['inv_duedate'] AND $r['inv_status']== "Menunggu Pembayaran" ){
								echo "Kadarluasa";
							}else{
								echo $r['inv_status'];
							}
							?>	
							<i class="fa  fa-truck"></i>
						</div>
					</div>
					<div class="tab">
						<?php
						$a =$r['inv_id'];
						$sql1 = "SELECT o.order_id,o.inv_id,o.lpk_id,o.mem_id,o.order_shippingtotal,o.order_grandtotal,o.order_shipstat,o.order_status,l.lpk_name,l.lpk_picture  FROM orders o JOIN lapak l ON o.lpk_id=l.lpk_id  where inv_id = '$a'";
						$result1 = $mysqli->query($sql1);
						while($r1 = $result1->fetch_array()):

							?>
						<a href="order_detail.php?orderid=<?php echo $r1['order_id'] ?>" class="trxlist">
							<div class="rev-content" style="height: 60px;" >
								<div class="rev-user" style="margin-left: 0px;" >
									<div class="rev-user-img" >
										<img src="http://warungmodern.co/assets/uploads/lapak/<?php echo $r1['lpk_picture']?>" style="height: 50px;width: 50px;">
									</div>
								</div>
								<div class="rev-user-feed" style="width: 87%;margin-right: -20px;">
									<h6 style="background: #fff;color: #e41d1d; width: 90%;font-weight: unset;margin-top: -5px;">29 Juli 2017, 05 : 35 PM</h6>
									<div class="column-6" style="padding: 0px;">
										<?php echo $r1['lpk_name']?>
										<hr style="margin: 2px;">
										RP.
										<?php
										$angka = $r1['order_grandtotal'];
										$jumlah_desimal ="0";
										$pemisah_desimal =",";
										$pemisah_ribuan =".";
										echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
										?> 
									</div>
									<div class="column-6" style="text-align:  right;margin-top: 0px">
										<?php 
										if($r['inv_status']=="Menunggu Pembayaran"){
											echo "Menunggu Pembayaran";
										}else{
											echo $r1['order_status'];
										}
										?>
									</div>
								</div>
							</div>
						</a>
						<?php
						endwhile;
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
		endwhile;
		$sql2 = "SELECT
		( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
		l.inv_id
		FROM invoice l ,
		(SELECT @NO_URUT := 0 ) VARIABLE_URUT where mem_id like '$memid'  ORDER BY inv_id DESC ";
		$result2 = $mysqli->query($sql2);
		while($r2 = $result2->fetch_array()):
			$no2 = $r2['NO_URUT'];
		endwhile;
		if($no2 > $idakhir){ //statement if else ini akan memutuskan apakah data masih bisa ditampilkan lagi atau tidak
			$noid = $idakhir+2;
			?>

			<div class="facebook_style" id="facebook_style" style="margin:7px 0px 0px 0px;">
				<a id="<?php echo $noid; ?>"  href="#" class="load_moretrx" >
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					Lihat Lainnya
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<img src="../assets/img/arrow1.png" />
				</a>
			</div>
			<?php
		}else{
			?>
			<div class="facebook_style" id="facebook_style" style="margin:7px 0px 0px 0px;">
				<a id='end' href='#' class='load_more' >Kosong</a>
			</div>
			<?php
		}
		?>
	</div>
	<?php
}
function listsell(){
	$db = new database();
	$lpkid =$_SESSION['lpk_id'];
	$mysqli = $db->connect();
	?>
	<div  id="listorder">
		<?php
		$sql = "SELECT * FROM orders  o JOIN invoice d ON o.inv_id=d.inv_id where o.lpk_id like '$lpkid' AND  d.inv_status like 'lunas' ORDER BY o.inv_id DESC LIMIT 0, 2";
		$result = $mysqli->query($sql);
		while($r = $result->fetch_array()):
			?>
		<div class="search-content">
			<div class="column-12" style="padding: 0px;">
				<div class="tab" style="margin-top: 1em;">
					<div  style="float: left; padding-right: 15px">
						<b>No Order  : </b> 
						<?php
						if($r['order_status']=="Diterima Penjual" OR $r['inv_status']=="Menunggu Penjual" OR $r['inv_status']=="lunas"){
							?>
							<a href="order_detail.php?orderid=<?php echo $r['order_id']?>">#<?php echo $r['order_id']?></a>
							<?php
						}else{
							?>
							#<?php echo $r['order_id']?>
							<?php
						}
						?>
					</div>
					<div  style="float: right;padding-left: 15px">
						<?php 
						$today =date('Y-m-d H:i:s');
						if($today >= $r['inv_duedate'] AND $r['order_status']== "Menunggu Pembayaran" ){
							echo "Kadarluasa";
						}elseif($r['order_status']== "Menunggu Pembayaran" AND $r['order_shipstat']){
							echo $r['order_shipstat'];
						}else{
							echo $r['order_status'];
						}
						?>	
						<i class="fa  fa-truck"></i>
					</div>
				</div>
				<div class="tab">
					<?php
					$a =$r['order_id'];
					$sql1 = "SELECT *  FROM orders o JOIN order_detail d ON o.order_id=d.order_id JOIN produk p ON d.pro_id=p.pro_id  JOIN member m ON o.mem_id=m.mem_id where o.order_id = '$a'";
					$result1 = $mysqli->query($sql1);
					while($r1 = $result1->fetch_array()):

						?>

					<div class="rev-content" style="height: 60px;" >
						<div class="rev-user" style="margin-left: 0px;" >
							<div class="rev-user-img" >
								<img src="http://warungmodern.co/assets/uploads/<?php echo $r1['pro_image']?>" style="height: 50px;width: 50px;">
							</div>
						</div>
						<div class="rev-user-feed" style="width: 87%;margin-right: -20px;">

							<div class="column-6" style="padding: 0px;">
								<?php echo $r1['pro_name']?>
								<hr style="margin: 2px;">
								RP.
								<?php
								$angka = $r1['dtl_subtotal'];
								$jumlah_desimal ="0";
								$pemisah_desimal =",";
								$pemisah_ribuan =".";
								echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
								?> 
							</div>
							<div class="column-6" style="text-align:  right;margin-top: 10px">
								<?php echo $r1['mem_firstname']?> <?php echo $r1['mem_lastname']?>
							</div>
						</div>
					</div>

					<?php
					endwhile;
					?>
				</div>
			</div>
		</div>

		<?php
		endwhile;
		?>
	</div>
	<div class="facebook_style" id="facebook_style" style="margin:7px 0px 0px 0px;">
		<a id="2" href="#" class="load_moresell" style="margin-bottom: 0px;">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Lihat Lainnya
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<img src="../assets/img/arrow1.png">
		</a>
	</div>
	<?php
}
function load_moresell($idakhir){
	$db = new database();
	$lpkid =$_SESSION['lpk_id'];
	$mysqli = $db->connect();
	?>
	<div  id="listorder">
		<?php
		$sql = "SELECT * FROM orders  o JOIN invoice d ON o.inv_id=d.inv_id where o.lpk_id like '$lpkid' AND  d.inv_status like 'Menunggu Penjual' ORDER BY order_id DESC LIMIT ".$idakhir.", 2 ";
		$result = $mysqli->query($sql);
		while($r = $result->fetch_array()):

			?>
		<div class="search-content">
			<div class="column-12" style="padding: 0px;">
				<div class="tab" style="margin-top: 1em;">
					<div  style="float: left; padding-right: 15px">
						<b>No Order  : </b> <a href="order_detail.php?orderid=<?php echo $r['order_id']?>">#<?php echo $r['order_id']?></a>
					</div>
					<div  style="float: right;padding-left: 15px">
						<?php 
						$today =date('Y-m-d H:i:s');
						if($today >= $r['inv_duedate'] AND $r['order_status']== "Menunggu Pembayaran" ){
							echo "Kadarluasa";
						}else{
							echo $r['inv_status'];
						}
						?>	
						<i class="fa  fa-truck"></i>
					</div>
				</div>
				<div class="tab">
					<?php
					$a =$r['order_id'];
					$sql1 = "SELECT *  FROM orders o JOIN order_detail d ON o.order_id=d.order_id  JOIN member m ON o.mem_id=m.mem_id where o.order_id = '$a'";
					$result1 = $mysqli->query($sql1);
					while($r1 = $result1->fetch_array()):

						?>

					<div class="rev-content" style="height: 60px;" >
						<div class="rev-user" style="margin-left: 0px;" >
							<div class="rev-user-img" >
								<img src="http://warungmodern.co/assets/uploads/Resep-Kue-Kering-Lebaran.jpg" style="height: 50px;width: 50px;">
							</div>
						</div>
						<div class="rev-user-feed" style="width: 87%;margin-right: -20px;">

							<div class="column-6" style="padding: 0px;">
								<?php echo $r1['pro_name']?>
								<hr style="margin: 2px;">
								RP.
								<?php
								$angka = $r1['dtl_subtotal'];
								$jumlah_desimal ="0";
								$pemisah_desimal =",";
								$pemisah_ribuan =".";
								echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
								?> 
							</div>
							<div class="column-6" style="text-align:  right;margin-top: 10px">
								<?php echo $r1['mem_firstname']?> <?php echo $r1['mem_lastname']?>
							</div>
						</div>
					</div>

					<?php
					endwhile;
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
	endwhile;
	$sql2 = "SELECT
	( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
	i.inv_id
	FROM invoice i  JOIN orders o ON i.inv_id=o.inv_id,
	(SELECT @NO_URUT := 0 ) VARIABLE_URUT where o.lpk_id like '$lpkid' ORDER BY inv_id DESC ";
	$result2 = $mysqli->query($sql2);
	while($r2 = $result2->fetch_array()):
		$no2 = $r2['NO_URUT'];
	endwhile;
			if($no2 > $idakhir){ //statement if else ini akan memutuskan apakah data masih bisa ditampilkan lagi atau tidak
				$noid = $idakhir+2;
				?>

				<div class="facebook_style" id="facebook_style" style="margin:7px 0px 0px 0px;">
					<a id="<?php echo $noid; ?>"  href="#" class="load_moresell" >
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						Lihat Lainnya
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<img src="../assets/img/arrow1.png" />
					</a>
				</div>
				<?php
			}else{
				?>
				<div class="facebook_style" id="facebook_style" style="margin:7px 0px 0px 0px;">
					<a id='end' href='#' class='load_more' >Kosong</a>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
	function detailinv($invid){
		$db = new database();
		$memid =$_SESSION['iduser'];
		$mysqli = $db->connect();
		$sql = "SELECT i.inv_date, i.inv_status, i.inv_method, i.inv_totalpayment, i.inv_note,sum(o.order_grandtotal) as totbel,sum(o.order_shippingtotal) as shipbel,c.cust_receivedname,c.cust_address,c.cust_phone,c.cust_lat,c.cust_long FROM invoice i JOIN orders o ON i.inv_id=o.inv_id  JOIN customer c ON i.cust_id=c.cust_id where i.inv_id like '$invid'";
		$cek =$mysqli->query($sql);
		$inv = $cek->fetch_array();
		?>
		<div style="margin-top: 50px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;overflow: hidden;" class="container container-top">
			<div class="feed" id="feed" style="overflow: hidden;">
				<span style="float: left;">No. </span><span style="font-weight: bold; float: left;"> <?php echo $invid?></span>
				<span style=" float: right;"><?php echo $inv['inv_date']?></span>
			</div>
			<hr>
			<div class="column-6" style="float: left;padding-left: 0px">
				<span style="">Status Pemesanan</span><br>
				<span style="">Metode Pembayaran</span><br> 
				<span style="">Total Belanja</span><br> 
				<span style="">Biaya Pengiriman</span><br>
				<?php
				if($inv['inv_method']!="cod"){
					?>
					<span style="">Kode Unik 3 angka terakhir</span><br> 
					<?php
				}else{
					?>
					<span style="">Biaya Tambahan</span><br> 
					<?php
				}
				?>
				<span style="">Total Pembayaran</span><br>
				<span style="">Tel</span><br>     
			</div>
			<div class="column-6" style="float: left;padding-left: 0px;text-align: right;">
				<span style="">
					<?php if($inv['inv_status']=="lunas"){
						echo "Pembayaran Selesai";
					}else{
						echo "Menunggu Pembayaran ";
					}?>
				</span><br>
				<span style=""><?php if($inv['inv_method']=="cod"){ echo "Bayar Ditempat";}else{echo "Transfer ". $inv['inv_method'];}?>
					
				</span><br> 
				<span style="">Rp. <?php
					$angka = $inv['totbel']-$inv['shipbel'];
					$jumlah_desimal ="0";
					$pemisah_desimal =",";
					$pemisah_ribuan =".";
					echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
					?> 
				</span><br>
				<span style="">Rp. <?php
					if($inv['inv_method']!="cod"){
						$total = $inv['shipbel'];
						$biaya = $inv['inv_totalpayment']-($angka+$total);
					}else{
						$total = 100/(100+30) * $inv['shipbel'];
						$biaya = $total*0.3;
					}
					$angka = $total;
					$jumlah_desimal ="0";
					$pemisah_desimal =",";
					$pemisah_ribuan =".";
					echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
					?> 
				</span><br>

				<span style="">Rp.  <?php echo $biaya ?></span><br>  
				<span style="">Rp. <?php
					$angka = $inv['inv_totalpayment'];
					$jumlah_desimal ="0";
					$pemisah_desimal =",";
					$pemisah_ribuan =".";
					echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
					?>
				</span><br>
				<span style="">081212213427</span><br>       
			</div>
		</div>
		<div style="background: #fff;padding: 10px;margin-bottom: 3px;" class="container container-top">
			<div class="feed" id="feed" style="overflow: hidden;">
				<span style="font-weight: bold; float: left;">Pesan Pribadi</span>
			</div>
			<hr>
			<?php if($inv['inv_note']){
				echo $inv['inv_note'];
			}else{
				echo "Kosoong";
			}

			?>
		</div>
		<div style="background: #fff;padding: 10px;" class="container container-top">
			<div class="feed" id="feed" style="overflow: hidden;">
				<span style="font-weight: bold; float: left;">Alamat Pengiriman</span>

			</div>
			<hr>
			<span style="font-weight: bold;"><?php echo $inv['cust_receivedname'] ?></span> <br>
			<?php echo $inv['cust_address'] ?>
			<br>
			<br>

			Phone : <?php echo $inv['cust_phone'] ?>
			<hr>
		</div>


		<div style="margin-top: 7px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
			<div class="feed" id="feed">
				<span style="font-weight: bold;">Rincian Pembelian</span>
			</div>
		</div>
		<div style="background: #fff;padding: 10px;" class="container container-top">
			<div  id="listorder">
				<?php
				$sql = "SELECT * FROM orders  o JOIN invoice d ON o.inv_id=d.inv_id JOIN lapak l ON o.lpk_id=l.lpk_id where o.inv_id like '$invid'  ORDER BY o.inv_id DESC";
				$result = $mysqli->query($sql);
				while($r = $result->fetch_array()):
					?>
				<div class="search-content" style=" height: 87%; overflow-y: scroll;">
					<div class="column-12" style="padding: 0px;">
						<div class="tab" style="margin-top: 1em;">
							<div  style="float: left; padding-right: 15px">
								<b>Penjual  : </b> <?php echo $r['lpk_name']?>
							</div>
							<div  style="float: right;padding-left: 15px">
								<?php 
								$today =date('Y-m-d H:i:s');
								if($today >= $r['inv_duedate'] AND $r['inv_status']== "Menunggu Pembayaran" ){
									echo "Kadarluasa";
								}else{
									echo $r['order_status'];
								}
								?>	
								<i class="fa  fa-truck"></i>
							</div>
						</div>
						<div class="tab">
							<?php
							$a =$r['order_id'];
							$sql1 = "SELECT *  FROM orders o JOIN order_detail d ON o.order_id=d.order_id  JOIN produk p ON p.pro_id=d.pro_id JOIN lapak l ON o.lpk_id=l.lpk_id where o.order_id = '$a'";
							$result1 = $mysqli->query($sql1);
							while($r1 = $result1->fetch_array()):

								?>

							<div class="rev-content" style="height: 60px;" >
								<div class="rev-user" style="margin-left: 0px;" >
									<div class="rev-user-img" >
										<img src="http://warungmodern.co/assets/uploads/<?php echo $r1['pro_image']?>" style="height: 50px;width: 50px;">
									</div>
								</div>
								<div class="rev-user-feed" style="width: 87%;margin-right: -20px;">

									<div class="column-6" style="padding: 0px;">
										<?php echo $r1['pro_name']?> 
										<hr style="margin: 2px;">
										RP.
										<?php
										$angka = $r1['dtl_subtotal'];
										$jumlah_desimal ="0";
										$pemisah_desimal =",";
										$pemisah_ribuan =".";
										echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
										?> 
									</div>
									<div class="column-6" style="text-align:  right;margin-top: 10px">
										(<?php echo $r1['dtl_qty']?>)
									</div>
								</div>
							</div>

							<?php
							endwhile;
							?>
						</div>
					</div>
				</div>

				<?php
				endwhile;
				?>
			</div>
		</div>


		<?php
	}
	function detailorder($order){
		$db = new database();
		$memid =$_SESSION['iduser'];
		$lpkmember =$_SESSION['lpkuser'];
		$mysqli = $db->connect();
		$sql = "SELECT i.mem_id,o.order_id,o.order_status,i.inv_date,i.inv_id,m.mem_phone, i.inv_status, i.inv_method, i.inv_totalpayment, i.inv_note,sum(o.order_grandtotal) as totbel,sum(o.order_shippingtotal) as shipbel,c.cust_receivedname,c.cust_address,c.cust_phone,c.cust_lat,c.cust_long,l.lpk_lat,l.lpk_long,l.lpk_username FROM invoice i JOIN orders o ON i.inv_id=o.inv_id  JOIN member m ON i.mem_id=m.mem_id  JOIN customer c ON i.cust_id=c.cust_id JOIN lapak l ON l.lpk_id=o.lpk_id where o.order_id = '$order'";
		$cek =$mysqli->query($sql);
		$inv = $cek->fetch_array();
		$lpkuser = $inv['lpk_username'];
		?>
		<div style="margin-top: 50px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;overflow: hidden;" class="container container-top">
			<div class="feed" id="feed" style="overflow: hidden;">
				<span style="float: left;">No. </span><span style="font-weight: bold; float: left;"> <?php echo $inv['inv_id']?></span>
				<span style=" float: right;"><?php echo $inv['inv_date']?></span>
			</div>
			<hr>
			<div class="column-6" style="float: left;padding-left: 0px">
				<span style="">Status Pemesanan</span><br>
				<span style="">Metode Pembayaran</span><br> 
				<span style="">Total Belanja</span><br> 
				<span style="">Biaya Pengiriman</span><br>
				<?php
				if($inv['inv_method']=="cod"){
					echo  "<span >Biaya Tambahan</span><br>";
				}else{
					echo  "";
				}
				?>

				<span style="">Total Pembayaran</span><br>
				<span style="">Tel</span><br>     
			</div>
			<div class="column-6" style="float: left;padding-left: 0px;text-align: right;">
				<span style="">
					<?php if($inv['inv_status']=="lunas" AND $inv['order_status']=="Menunggu Penjual")
					{ echo "Sedang diproses";}
					elseif($inv['order_status']=="Diterima Penjual"){echo "Diterima Penjual";}
					else{echo "Menunggu Pembayaran ";}
					?>

				</span><br>
				<span style=""><?php if($inv['inv_method']=="cod"){ echo "Bayar Ditempat";}else{echo "Transfer ". $inv['inv_method'];}?></span><br> 
				<span style="">Rp. <?php
					$angka = $inv['totbel']-$inv['shipbel'];
					$jumlah_desimal ="0";
					$pemisah_desimal =",";
					$pemisah_ribuan =".";
					echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
					?>					
				</span><br>
				<?php
				if($inv['inv_method']!="cod"){
					$total = $inv['shipbel'];
					$biaya = $inv['shipbel'];
				}else{
					$total = 100/(100+30) * $inv['shipbel'];
					$biaya = $total*0.3;
					$angka = $total;
					$jumlah_desimal ="0";
					$pemisah_desimal =",";
					$pemisah_ribuan =".";
					echo "<span >Rp.".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</span><br>";
				}

				?> 
				
				<span style="">Rp. <?php echo $biaya ?></span><br>  
				<span style="">Rp. <?php
					$angka = $inv['totbel'];
					$jumlah_desimal ="0";
					$pemisah_desimal =",";
					$pemisah_ribuan =".";
					echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
					?> </span><br>
					<span style=""><?php echo $inv['mem_phone']?></span><br>       
				</div>
			</div>
			<div style="background: #fff;padding: 10px;margin-bottom: 3px;" class="container container-top">
				<div class="feed" id="feed" style="overflow: hidden;">
					<span style="font-weight: bold; float: left;">Pesan Pribadi</span>
				</div>
				<hr>
				<?php if($inv['inv_note']){
					echo $inv['inv_note'];
				}else{
					echo "Kosoong";
				}
				?>
				
			</div>
			<script>
				function initMap() {
					var directionsDisplay = new google.maps.DirectionsRenderer;
					var directionsService = new google.maps.DirectionsService;
					var map = new google.maps.Map(document.getElementById('map'), {
						zoom: 14,
						center: {lat: <?php echo $inv['lpk_lat'] ?>, lng: <?php echo $inv['lpk_long'] ?>}
					});
					directionsDisplay.setMap(map);

					calculateAndDisplayRoute(directionsService, directionsDisplay);
					document.getElementById('mode').addEventListener('change', function() {
						calculateAndDisplayRoute(directionsService, directionsDisplay);
					});
				}

				function calculateAndDisplayRoute(directionsService, directionsDisplay) {
					var selectedMode = document.getElementById('mode').value;
					directionsService.route({
				          origin: {lat: <?php echo $inv['lpk_lat'] ?>, lng: <?php echo $inv['lpk_long'] ?>},  // Haight.
				          destination: {lat: <?php echo $inv['cust_lat'] ?>, lng: <?php echo $inv['cust_long'] ?>},  // Ocean Beach.
				          // Note that Javascript allows us to access the constant
				          // using square brackets and a string value as its
				          // "property."
				          travelMode: google.maps.TravelMode[selectedMode]
				      }, function(response, status) {
				      	if (status == 'OK') {
				      		directionsDisplay.setDirections(response);
				      	} else {
				      		window.alert('Rute tidak ditemukan ');
				      	}
				      });
				}

			</script>

			<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9q4LR-dTaJ8avQQ82lg8Fgjqqjt6oyhU&sensor=false&language=id&callback=initMap">
		</script>
		<div style="background: #fff;padding: 10px;" class="container container-top">
			<div class="feed" id="feed" style="overflow: hidden;">
				<span style="font-weight: bold; float: left;">Alamat Pengiriman</span>

			</div>
			<hr>
			<span style="font-weight: bold;"><?php echo $inv['cust_receivedname'] ?></span> <br>
			<?php echo $inv['cust_address'] ?>
			<br>
			<br>

			Phone : <?php echo $inv['cust_phone'] ?>
			<hr>
			<?php
			if($lpkuser == $lpkmember){

				?>
				<div id="floating-panel" style="position: absolute;	z-index: 5;background-color: #fff;padding: 5px;border: 1px solid #999;text-align: center;font-family: 'Roboto','sans-serif';line-height: 30px;padding-left: 10px;">
					<b>Dengan : </b>
					<select id="mode">
						<option value="DRIVING">Mobil</option>
						<option value="WALKING">Jalan Kaki</option>
						<option value="BICYCLING">Motor</option>
					</select>
				</div>
				<div id="map" style="width: 100%; height: 200px; position: relative; overflow: hidden;""></div>
				<?php
			}
			?>
		</div>


		<div style="margin-top: 7px;background: #fff;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top">
			<div class="feed" id="feed">
				<span style="font-weight: bold;">Rincian Pembelian</span>
			</div>
		</div>
		<div style="background: #fff;padding: 10px;" class="container container-top">
			<div  id="listorder">
				<?php
				$sql = "SELECT * FROM orders  o JOIN invoice d ON o.inv_id=d.inv_id where o.order_id like '$order'  ORDER BY o.inv_id DESC";
				$result = $mysqli->query($sql);
				while($r = $result->fetch_array()):
					?>
				<div class="search-content" style=" height: 87%; overflow-y: scroll;">
					<div class="column-12" style="padding: 0px;">
						<div class="tab">
							<?php
							$a =$r['order_id'];
							$sql1 = "SELECT *  FROM orders o JOIN order_detail d ON o.order_id=d.order_id  JOIN lapak l ON o.lpk_id=l.lpk_id where o.order_id = '$a'";
							$result1 = $mysqli->query($sql1);
							while($r1 = $result1->fetch_array()):

								?>

							<div class="rev-content" style="height: 50px;" >

								<div class="rev-user-feed" style="width: 87%;margin-right: -20px;">

									<div class="column-9" style="padding: 0px;">
										<?php echo $r1['pro_name']?> 
										<hr style="margin: 2px;">
										RP.
										<?php
										$angka = $r1['dtl_subtotal'];
										$jumlah_desimal ="0";
										$pemisah_desimal =",";
										$pemisah_ribuan =".";
										echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
										?> 
									</div>
									<div class="column-3" style="text-align:  right;margin-top: 10px">
										(<?php echo $r1['dtl_qty']?>)
									</div>
								</div>
							</div>

							<?php
							endwhile;
							?>
						</div>
					</div>
				</div>

				<?php
				endwhile;
				?>
			</div>
		</div>
		<style type="text/css">
			/*Hide the radio buttons*/
			[type='radio']{
				display: none;
			}
		    /*Draw a plain border around the image so that
		    it does not move when selected */
		    label i{
		    	border: 3px solid #393030;
		    	padding: 10px;
		    	margin-bottom: 10px;
		    	cursor: pointer;
		    }
		    /*Draw a colored border around the image when the radio button 
		    adjacent to the label it is in is checked. */
		    [type='radio']:checked + label i{
		    	border: 3px solid #C63;
		    }
		</style>
		<div style="background: #fff;padding: 7px; margin-top: 7px;text-align: center;" class="container container-top">
			<?php
			if($lpkuser == $lpkmember){
				?>
				<form action="../helper/payment.php?aksi=orderproses"  method="POST">
					<input type="text" name="orderid" value="<?php echo $inv['order_id']?>" hidden>
					<?php
					if($inv['order_status']=="Diterima Penjual"){
						?>
						<div style="margin-bottom: 10px">
							<select id="slctaksi" name="slctaksi">
								<option value="Sedang Dalam Pengiriman">Sedang Dalam Pengiriman</option>
								<option value="Sampai Tujuan">Sampai Tujuan</option>
								<option value="Dibatalkan alamat Tidak diketahui">Alamat Tidak ditemukan</option>
							</select>
						</div>
						<input type="submit" value="update" class="btn-pesan" style="float: none;width: 60%;text-align: center; ">
						<?php
					}elseif($inv['order_status']=="selesai"){

					}
					else{
						?>
						<div>
							<input type="radio" name="shape" class="metode"  value="terima" id="terima"/>
							<label for="terima">
								<i class="fa fa-check" alt="terima" > Terima</i>
							</label>
							<input type="radio" name="shape" class="metode" value="tolak" id="tolak"/>
							<label for="tolak">
								<i class="fa fa-ban" alt="tolak" > Tolak</i>
							</label>
						</div>
						<div style="margin-bottom: 10px">
							<input type="hidden" name="totbel" value="<?php echo $inv['totbel']?>" >
							<input type="hidden" name="memid" value="<?php echo $inv['mem_id']?>" >
							<select id="slctaksi" name="slctaksi" style="display: none">
								<option value="Diterima Penjual">Terima</option>
								<option value="Dibatalkan stok habis">Stok Habis</option>
								<option value="Dibatalkan alamat Tidak diketahui">Alamat Ga Valid</option>
								<option value="Dibatalkan Tidak Terima Orderan">tidak terima orderan</option>
							</select>
						</div>
						<input type="submit" value="proses" class="btn-pesan" style="float: none;width: 60%;text-align: center; ">
						<?php
					}
					?>
				</form>
				<script type="text/javascript">
					$("input[type='radio']").click(function(){
						var a = $(this).attr('value');
						if(a=="tolak"){
							$('#slctaksi').show();
						}else{ 
							$("#slctaksi option:eq(0)").attr("selected","selected");
							$('#slctaksi').hide();
						}
					});
				</script>
				<?php
			}else{
				if($inv['order_status']!="Selesai"){
					?>
					<form action="../helper/payment.php?aksi=orderkonfirm"  method="POST">
						<input type="text" name="orderid" value="<?php echo $inv['order_id']?>" hidden>
						<input type="submit" value="KONFIRMASI" class="btn-pesan" style="float: none;width: 60%;text-align: center; ">
					</form>
					<script type="text/javascript">
						$("input[type='radio']").click(function(){
							var a = $(this).attr('value');
							if(a=="tolak"){
								$('#slctaksi').show();
							}else{ 
								$("#slctaksi option:eq(0)").attr("selected","selected");
								$('#slctaksi').hide();
							}
						});
					</script>
					<?php
				}
			}
			?>
		</div>


		<?php
	}
	function orderproses($orderid,$slctaksi,$totbel,$memid){
		$db = new database();
		$mysqli = $db->connect();
		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
		if($slctaksi=="Sedang Dalam Pengiriman"){
			$sql = "UPDATE orders SET order_shipstat = '$slctaksi'  where order_id = '$orderid'";
		}elseif($slctaksi=="Sampai Tujuan"){
			$sql = "UPDATE orders SET order_status = 'Menunggu Konfirmasi', order_shipstat = '$slctaksi'  where order_id = '$orderid'";
		}elseif($slctaksi=="Dibatalkan stok habis" OR $slctaksi=="Dibatalkan alamat Tidak diketahui" OR $slctaksi=="Dibatalkan Tidak Terima Orderan" ){
			$sql = "UPDATE orders SET order_status = 'BATAL', order_shipstat = '$slctaksi'  where order_id = '$orderid'";
			$saldo = $mysqli->query("INSERT INTO saldo (sld_id, mem_id, sld_desc, sld_amount, sld_status, sld_created) VALUES (NULL, '$memid', 'Refund Order #$orderid Penjual $slctaksi', '$totbel', 'Debit', '$now')");
		}
		else{
			$sql = "UPDATE orders SET order_status = '$slctaksi',order_shipstat= '' where order_id = '$orderid'";
		}
		$result =$mysqli->query($sql);
		if($result){
			$_SESSION['alert']='orderberhasil';
			echo "<script>history.go(-2);</script>";
		}else{
			$_SESSION['alert']='ordergagal';
			echo "<script>history.go(-2);</script>";
		}
	}
	function orderkonfirm($orderid){
		$db = new database();
		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
		$memid =$_SESSION['iduser'];
		$mysqli = $db->connect();
		$sql1 = "SELECT o.order_id,l.lpk_id,o.order_grandtotal,l.mem_id FROM orders o JOIN lapak l ON o.lpk_id=l.lpk_id where o.order_id = '$orderid'";
		$result1 = $mysqli->query($sql1);
		$r1 = $result1->fetch_array();
		$lpkid = $r1['lpk_id'];
		$memberid = $r1['mem_id'];
		$grandtotal = $r1['order_grandtotal'];
		$saldo = $mysqli->query("INSERT INTO saldo (sld_id, mem_id, sld_desc, sld_amount, sld_status, sld_created) VALUES (NULL, '$memberid', 'Transaksi Sukses dari No Order #$orderid', '$grandtotal', 'Debit', '$now')");
		$saldo = $mysqli->query("UPDATE orders SET order_status = 'Selesai', order_shipstat = ''  where order_id = '$orderid'");
		if($saldo){
			$_SESSION['alert']='orderkonfirmberhasil';
			echo "<script>history.go(-2);</script>";
		}else{
			$_SESSION['alert']='orderkonfirmgagal';
			echo "<script>history.go(-2);</script>";
		}

	}
	function konfid($id){
		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
		$today =date('Y-m-d H:i:s');
		$date = date_create($today);
		date_add($date, date_interval_create_from_date_string('5 hours'));
		$duedate = date_format($date, 'Y-m-d H:i:s');
		$db = new database();
		$mysqli = $db->connect();
		$sql1 = "SELECT sum(o.order_grandtotal) grandtotal,inv_totalpayment ,i.mem_id FROM orders o JOIN invoice i ON o.inv_id=i.inv_id where o.inv_id = '$id'";
		$result1 = $mysqli->query($sql1);
		$r1 = $result1->fetch_array();
		$grandtotal = $r1['grandtotal'];
		$totalpayment = $r1['inv_totalpayment'];
		$jadi = $totalpayment-$grandtotal;
		$memid =$r1['mem_id'];
		$sql = "UPDATE invoice SET inv_status = 'lunas' where inv_id = '$id'";

		$result =$mysqli->query($sql);
		$order =$mysqli->query("UPDATE orders SET order_status = 'Menunggu Penjual', order_date = '$duedate' where inv_id = '$id'");
		if($result){
			$saldo = $mysqli->query("INSERT INTO saldo (sld_id, mem_id, sld_desc, sld_amount, sld_status, sld_created) VALUES (NULL, '$memid', 'Refund Kode Unik dari Invoice #$id', '$jadi', 'Debit', '$now')");
			if($saldo){
				$_SESSION['alert']='KonfirmasiBerhasil';
				echo "<script>history.go(-2);</script>";
			}
		}
	}
	function konfirmasi($inv,$bankwm,$bankcust,$nama,$norek,$method,$nominal,$tgltransfer){
		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
		$pisah =explode("/", $tgltransfer);
		$jadi = $pisah[2]."-".$pisah[1]."-".$pisah[0]." 00:00:00";
		$db = new database();
		$mysqli = $db->connect();
		$konfirmasi = $mysqli->query("INSERT INTO confirmation (conf_id, inv_id, conf_bankwm, conf_bankcust, conf_accountname, conf_accountnumber, conf_method, conf_nominal, conf_transfer) VALUES (NULL, '$inv', '$bankwm', '$bankcust', '$nama', '$norek', '$method', '$nominal', '$jadi')");
		if($konfirmasi){
			$_SESSION['alert']='KonfirmasiBerhasil';
			echo "<script>history.go(-1);</script>";
		}else{
			$_SESSION['alert']='Konfirmasigagal';
			echo "<script>history.go(-1);</script>";
		}
	}
	public function checkinv($inv){
		$iduser =$_SESSION['iduser'];
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT count(inv_id) FROM invoice WHERE inv_id LIKE '$inv' and mem_id LIKE '$iduser'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		if($row[0]>0){
			echo 'true';
			$mysqli->close();
		}
		else{
			echo 'false';
			$mysqli->close();
		}
	}
}
?>
