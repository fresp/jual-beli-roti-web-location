<?php
date_default_timezone_set('Asia/Jakarta');	
// buat class member
class seller {
	public function __construct() {
		require_once $_SERVER['DOCUMENT_ROOT'].'/roti/config/database.php';

	}
	function lapak(){
		$memid =$_SESSION['iduser'];
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT COUNT(lpk_id) FROM lapak ";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		echo $row[0];
	}
	public function cekseller($username){
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT count(lpk_username) FROM lapak WHERE lpk_username LIKE '$username'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		if($row[0]>0){
			echo 'false';
			$mysqli->close();
		}
		else{
			echo 'true';
			$mysqli->close();
		}
	}
	public function cek($user){
		session_start();
		error_reporting(0);
		$db = new database();		
		$mysqli = $db->connect();
		$lat2 = $_SESSION['lat'];
		$long2 = $_SESSION['lon'];
		if($lat2 =="" & $long2 ==""){
			header('Location: index.php');
			$_SESSION['alert'] = 'nerbielost';
		}else{
			$sql = "SELECT count(lpk_username) FROM lapak WHERE lpk_username LIKE '$user'";
			$result = $mysqli->query($sql);
			$row= $result->fetch_array();
			if($row[0]>0){
				include 'template/head.php'; 
				$sql2 = "SELECT l.lpk_id, m.mem_id, l.lpk_name, m.mem_lastlogin, l.lpk_activehour FROM lapak l INNER JOIN member m ON l.mem_id=m.mem_id where l.lpk_username  LIKE '$user'  limit 1";
				$result2 = $mysqli->query($sql2);
				$row2= $result2->fetch_array();
				$llogin = $row2['mem_lastlogin'];
				$idlapak = $row2['lpk_id'];
				$iduser = $row2['mem_id'];
				$sekarang = date("H:i");
				$jam = $row2['lpk_activehour'];

				$pecah = explode("-", $jam);
				$pecahjambuka = $pecah[0];
				$pecahjamtutup = $pecah[1];
				if($_SESSION['alert']=='berhasildiupdate'){
					?>
					<script type='text/javascript'>
						$(document).ready( function () {
							cheers.success({
								title: 'Toko Update',
								message: 'Info toko berhasil diupdate',
								alert: $('select[name="alert"]').val(),
							});
						}); 
					</script>
					<?php
					unset($_SESSION['alert']);
				}
				
				
				?>
				<div style="margin-top: 90px;" class="container container-top">
					<div class="seller-page-content">
						<div class="seller-header">
							<div class="seller-cover">
								<img src="assets/img/cover-saller.jpg" style="display: block;
								height: 100px;
								width: 100%;">
							</div>
							<div class="seller-title" style="top: 60px;">
								
								<div style="float: left;">
									<h3 style="font-weight: bold;"><?php 

										echo $row2['lpk_name']?></h3>
									</div>
									<div style="float: right;padding-top: 20px;">
										<i class="fa fa-circle "></i>
										<?php
										$periods         = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun");
										$lengths         = array("60","60","24","7","4.35","12","10");
										$now             = time();
										$unix_date       = strtotime($llogin);
										if(empty($unix_date)) {   
											return "Format tanggal salah";
										}
										if($now > $unix_date) {   
											$lastseen     = $now - $unix_date;
											$tense         = "yang lalu";
										} else {
											$lastseen     = $unix_date - $now;
											$tense         = "dari sekarang";
										}
										for($j = 0; $lastseen >= $lengths[$j] && $j < count($lengths)-1; $j++) {
											$lastseen /= $lengths[$j];
										}
										$lastseen = round($lastseen);
										if($lastseen != 1) {
											$periods[$j].= "";
										}
										echo "$lastseen $periods[$j] {$tense}";
										?>
									</div> 
								</div>
								<div class="seller-desc" style="    padding: 3px 20px 0px 10px;">

									<div style="float: left;">

										Jam Aktif<br>
										<b><?php echo $row2['lpk_activehour']?></b>
									</div>
									<div style="float: right; text-align: right;">
										<?php
										$a = $_SESSION['iduser'];
										if($a != $iduser){ 
											if($sekarang<=$pecahjambuka OR $sekarang >=$pecahjamtutup){
												?>
												<a class="btn-pesan" style="background: #fff;color: #9c0b0b;border: 2px solid #7b1111;padding: 3px;margin-top: 3px;" >
													Tutup
												</a>
												<?php
											}else{
												?>
												<a class="btn-pesan" style="background: #fff;color: #036514;border: 2px solid #036514;padding: 3px;margin-top: 3px;" >
													BUKA
												</a>
												<?php
											}
											
										}else{
											?>
											<a class="btn-pesan" href="member/edit_toko.php" style="background: #F39C12" >
												<i class="fa fa-pencil-square-o"></i>  Edit Lapak
											</a>
											<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
						<div id="newest-welcome-list">
							<div class="feed" id="feed">
								<ul class="product-list"  id="updates">
									<?php
									$lat2 = $_SESSION['lat'];
									$long2 = $_SESSION['lon'];
									$jarak = "5";
									$sql3 = "SELECT 
									( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
									l.lpk_id,l.lpk_name,l.lpk_username,
									(6371 * acos(cos(radians(".$lat2.")) 
									* cos(radians(lpk_lat)) * cos(radians(lpk_long) 
									- radians(".$long2.")) + sin(radians(".$lat2.")) 
									* sin(radians(lpk_lat)))) 
									AS jarak 
									FROM lapak  l, (SELECT @NO_URUT := 0 ) VARIABLE_URUT 
									where l.lpk_username like '$user'";
									$cek =$mysqli->query($sql3);
									$hasil = $cek->fetch_array();
									if($hasil[4] >= '5'){
										?>
										<div class="panel panel-default">
											<div class="panel-body">      
												<div class="row"> 
													<div class="column-12">
														<img src="assets/img/gatersedia.png">
													</div>
												</div>
											</div>
										</div>
										<?php
									}else{
										require_once 'module/produk.php';
										$produk = new produk();
										$produkData = $produk->data($idlapak); 
										echo $produkData;
									} 

									?>
								</ul>
							</div>
						</div>
					</div>
					<?php include 'template/footer.php'; 
				}
				else{
					header("Location: index.php");
				}
				$mysqli->close();
			}
		}
		public function terdaftar(){
			$memid =$_SESSION['iduser'];
			$db = new database();		
			$mysqli = $db->connect();
			$sql = "SELECT count(mem_id) FROM lapak WHERE mem_id LIKE '$memid'";
			$result = $mysqli->query($sql);
			$row= $result->fetch_array();
			if($row[0]>0){
				header("Location: ../member/index.php?Sudah Punya Lapak");

			}
			else{


			}
			$mysqli->close();

		}
		function joinseller($user,$namatoko,$jambuka,$jamtutup){
			$memid =$_SESSION['iduser'];
			$db = new database();
			$jam = $jambuka.":00-".$jamtutup.":00";
			$mysqli = $db->connect(); 
			$today =date('Y-m-d');
			$sql2 = "INSERT INTO lapak(mem_id,lpk_name,lpk_username,lpk_status,lpk_activehour,lpk_created)VALUES ('$memid','$namatoko', '$user', 'N','$jam','$today')";
			$result = $mysqli->query($sql2);
        	 // cek hasil query
			if ($result) {
	        	 /* 
	        	 jika data berhasil disimpan alihkan ke halaman selanjutnya
	        	 */
	        	 header("Location: ../member/lokasipenjual.php");
	        	}else {
	        	/* 
	        	jika data tidak berhasil disimpan alihkan ke halaman joinseller lagi
	        	*/
	        	header("Location: ../member/joinseller.php?Proses Daftar Gagal");
	        }
	        $mysqli->close();
	    }
	    function setlokasi($lat,$lon){
	    	$memid =$_SESSION['iduser'];
	    	$db = new database();
	    	$mysqli = $db->connect(); 
	    	$today =date('Y-m-d');
	    	$sql2 = "UPDATE lapak SET lpk_lat = '$lat', lpk_long = '$lon' WHERE mem_id = '$memid'";
	    	$result = $mysqli->query($sql2);
        	 // cek hasil query
	    	if ($result) {
	        	/* jika data berhasil disimpan alihkan ke halaman verifikasi
	        	*/
	        	header('Location:../member/uploadseller.php');
	        }else {
	        	/* jika data tidak berhasil disimpan alihkan ke halaman verifikasi
	        	*/
	        	header("Location: ../member/lokasipenjual.php?Proses Setting Lokasi");
	        }
	        $mysqli->close();
	    }
	    function uploadfoto(){
	    	$memid =$_SESSION['iduser'];
	    	$db = new database();
	    	$mysqli = $db->connect(); 
	    	$lokasi_file = $_FILES['seller']['tmp_name'];
	    	$tipe_file   = $_FILES['seller']['type'];
	    	$nama_file   = $_FILES['seller']['name'];
	    	$direktori   = "../assets/uploads/lapak/$nama_file";
	    	
	    	if (!empty($lokasi_file)) {
	    		move_uploaded_file($lokasi_file,$direktori); 

	    		$sql2 = "UPDATE lapak SET lpk_picture = '$nama_file' WHERE mem_id = '$memid'";
	    		$result = $mysqli->query($sql2);
	    		if ($result) {
	    			$sql3 = "SELECT lpk_id FROM lapak WHERE mem_id LIKE '$memid' limit 1";
	    			$result1 = $mysqli->query($sql3);
	    			$row1= $result1->fetch_array();
	    			$_SESSION['lpk_id']= $row1['lpk_id'];
	        	/* jika data berhasil disimpan alihkan ke halaman verifikasi
	        	*/
	        	header('Location:../member/index.php');
	        	$_SESSION['alert'] = 'tokoopen';
	        }else {
	        	/* jika data tidak berhasil disimpan alihkan ke halaman verifikasi
	        	*/
	        	header("Location: ../member/uploadseller.php?Proses upload gagal");
	        }
	        $mysqli->close();
	    }else{
	    	header("Location: ../member/uploadseller.php?Proses upload gagal");
	    }
	}

	public function infolapak($segment){
		$db = new database();
		$id= $_SESSION['iduser'];		
		$mysqli = $db->connect();
		$sql = "SELECT * FROM lapak WHERE mem_id LIKE '$id' limit 1";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		if($row[0]>0){
			?>
			<ul>
				<?php
				if($segment=="index"){
					?>
					<li class="special-dropdown">
						<div class="row">
							<div class="column-1">
								<a id="settingdrop" class="dropdown-emitter" href="#"><i class="fa fa-bar-chart"></i></a>
							</div>
							<div class="column-10">

								<button type="button" id="sidechart" class="btnnavbar" style="text-align: left;margin-top: -7px;height: 31px;">
									<span style="font-size: 15px;padding: 0px;"><a href="#" style="padding: 10px;">Penjualan</a></span>
								</button>
							</div>
							<div class="column-1" style="margin: 5px 0px 0px -40px;">
								<i id="sidetooglechart" class="fa fa-angle-left"></i>
							</div>
						</div>
						<div id="chartmenu" style="display: none;">
							<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
								<div class="column-1">
								</div>
								<a href="member/transactions.php?list=sell" style="width: 100%;padding-left: 27px;">
									<div class="column-10"><span style="">Daftar Penjualan</span><br>
									</div>
								</a>
							</div>
							<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
								<div class="column-1">
								</div>
								<a href="member/produk.php" style="width: 100%;padding-left: 27px;">
									<div class="column-10"><span style="">Daftar Produk</span><br>
									</div>
								</a>
							</div>

						</div>  
					</li>
					<?php
				}else{
					?>
					<li class="special-dropdown">
						<div class="row">
							<div class="column-1">
								<a id="settingdrop" class="dropdown-emitter" href="#"><i class="fa fa-bar-chart"></i></a>
							</div>
							<div class="column-10">

								<button type="button" id="sidechart" class="btnnavbar" style="text-align: left;margin-top: -7px;height: 31px;">
									<span style="font-size: 15px;padding: 0px;"><a href="#" style="padding: 10px;">Penjualan</a></span>
								</button>
							</div>
							<div class="column-1" style="margin: 5px 0px 0px -40px;">
								<i id="sidetooglechart" class="fa fa-angle-left"></i>
							</div>
						</div>
						<div id="chartmenu" style="display: none;">
							<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
								<div class="column-1">
								</div>
								<a href="transactions.php?list=sell" style="width: 100%;padding-left: 27px;">
									<div class="column-10"><span style="">Daftar Penjualan</span><br>
									</div>
								</a>
							</div>
							<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
								<div class="column-1">
								</div>
								<a href="produk.php" style="width: 100%;padding-left: 27px;">
									<div class="column-10"><span style="">Daftar Produk</span><br>
									</div>
								</a>
							</div>

						</div>  
					</li>
					<?php
				}
				?>
			</ul>
			<?php
			$mysqli->close();
		}
		else{
			?>
			<ul style="margin: 0px;">
				<li>
					<a href="member/joinseller.php"><i class="fa fa-inbox"></i> Daftar Menjadi Penjual</a>
				</li>   
			</ul>
			<?php
			$mysqli->close();
			
		}
	}
	public function data(){
		$db = new database();		
		$mysqli = $db->connect();
		if($_SESSION['nerbie']==""){
			?>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row"> 
						<div class="column-12">
							<img src="assets/img/smile.png">
						</div>
					</div>
				</div>
			</div>
			<?php
		}else{
			$lat2 = $_SESSION['lat'];
			$long2 = $_SESSION['lon'];
			$jarak = "5";
			$sql = "SELECT 
			( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
			l.lpk_id,l.lpk_name,l.lpk_username,l.lpk_picture,l.lpk_freeongkir,
			(6371 * acos(cos(radians(".$lat2.")) 
			* cos(radians(lpk_lat)) * cos(radians(lpk_long) 
			- radians(".$long2.")) + sin(radians(".$lat2.")) 
			* sin(radians(lpk_lat)))) 
			AS jarak 
			FROM lapak  l, (SELECT @NO_URUT := 0 ) VARIABLE_URUT
			WHERE lpk_status like 'Y'
			HAVING jarak <= ".$jarak." 
			ORDER BY jarak LIMIT 0, 2
			";
			$cek =$mysqli->query($sql);
			$hasil = $cek->fetch_array();
			if($hasil[0] != NULL){
				$result = $mysqli->query($sql);
				while($r = $result->fetch_array()):   
					$id = $r['lpk_id'];
				$nama =  $r['lpk_name'];
				$username = $r['lpk_username'];
				$km = $r['jarak'];
				$ongkir = $r['lpk_freeongkir'];
				if($km > 1){
					$km2 =Round($km,2 )." KM";
				}else{
					$hasil =$km*1000;
					$km2 = Round($hasil,2 )." M";
				}
				?>
				<li class="list-content">
					<?php
					if($ongkir=="1"){
						?>
						<div class="product-wish">
							<div style="float: right;">
								<ul class="rating">
									<li>
										<img class="lazy" style="height: 30px;" src="assets/img/gratis.png">
										
									</li>      
								</ul>
							</div>
						</div>
						<?php
					}
					?>

					<a href="<?php echo $username ?>">
						<img class="lazy" src="assets/uploads/lapak/<?php echo $r['lpk_picture']?>" >
						<div class="caption product-name">
							<?php echo  $nama ?> 
						</div>  
						<div class="caption product-seller">
							<div class="content">
								<span class="fa fa-map-marker"></span>
								<?php echo $km2  ?>
							</div>
						</div>  
					</a>
				</li>
				<?php
				endwhile;
				?>
			</ul>
			<div class="facebook_style" id="facebook_style">
				<a id="2" href="#" class="load_more" >
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					Lihat Lainnya
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<img src="assets/img/arrow1.png" />
				</a>
			</div>
			<?php
		}else{
			?>
			<div class="panel panel-default">
				<div class="panel-body">      
					<div class="row"> 
						<div class="column-12">
							<img src="assets/img/maaf.png">
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
public function ulload(){
	?>
	<ul class="product-list"  id="updates">
		<?php
		$db = new database();		
		$mysqli = $db->connect();
		if($_SESSION['nerbie']==""){
			?>
			<div class="panel panel-default">
				<div class="panel-body">

					<div class="row"> 
						<div class="column-12">
							<img src="assets/img/smile.png">
						</div>
					</div>
				</div>
			</div>
			<?php
		}else{
			$lat2 = $_SESSION['lat'];
			$long2 = $_SESSION['lon'];
			$jarak = "5";
			$sql = "SELECT 
			( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
			l.lpk_id,l.lpk_name,l.lpk_username,l.lpk_picture,l.lpk_freeongkir,
			(6371 * acos(cos(radians(".$lat2.")) 
			* cos(radians(lpk_lat)) * cos(radians(lpk_long) 
			- radians(".$long2.")) + sin(radians(".$lat2.")) 
			* sin(radians(lpk_lat)))) 
			AS jarak 
			FROM lapak  l, (SELECT @NO_URUT := 0 ) VARIABLE_URUT
			WHERE lpk_status like 'Y' 
			HAVING jarak <= ".$jarak." 
			ORDER BY jarak LIMIT 0, 2
			";
			$cek =$mysqli->query($sql);
			$hasil = $cek->fetch_array();
			if($hasil[0] != NULL){
				$result = $mysqli->query($sql);
				while($r = $result->fetch_array()):   
					$id = $r['lpk_id'];
				$username = $r['lpk_username'];
				$nama = $r['lpk_name'];
				$km = $r['jarak'];
				$ongkir = $r['lpk_freeongkir'];
				$login=date('Y-m-d H:i:s');
				$nerbie= $_SESSION['nerbie'];
				if(isset($_SESSION['email'])){
					$email = isset($_SESSION['email']);
					
					$updateses = "UPDATE member SET mem_lat = '$lat2', mem_long = '$long2', mem_nerbie = '$nerbie',mem_lastlogin = '$login' WHERE mem_email LIKE '$email'";
					$excses = $mysqli->query($updateses);
				}
				if($km > 1){
					$km2 =Round($km,2 )." KM";
				}else{
					$hasil =$km*1000;
					$km2 = Round($hasil,2 )." M";
				}
				
				?>
				<li class="list-content">
					<?php
					if($ongkir=="1"){
						?>
						<div class="product-wish">
							<div style="float: right;">
								<ul class="rating">
									<li>
										<img class="lazy" style="height: 30px;" src="assets/img/gratis.png">
										
									</li>      
								</ul>
							</div>
						</div>
						<?php
					}
					?>
					<a href="<?php echo $username ?>">
						<img class="lazy" src="assets/uploads/lapak/<?php echo $r['lpk_picture']?>" >
						<div class="caption product-name">
							<?php echo  $nama ?>
						</div>  
						<div class="caption product-seller">
							<div class="content">
								<span class="fa fa-map-marker"></span>
								<?php echo $km2 ?>
							</div>
						</div>  
					</a>
				</li>
				<?php
				endwhile;
				?>
			</ul>
			<div class="facebook_style" id="facebook_style">
				<a id="2" href="#" class="load_more" >
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					Lihat Lainnya
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<img src="assets/img/arrow1.png" />
				</a>
			</div>
			<?php
		}else{
			?>
			<div class="panel panel-default">
				<div class="panel-body">      
					<div class="row"> 
						<div class="column-12">
							<img src="assets/img/maaf.png">
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
public function load_more($idakhir){
	$db = new database();		
	$mysqli = $db->connect();
	if($_SESSION['nerbie']==""){
		?>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row"> 
					<div class="column-12">
						<img src="assets/img/smile.png">
					</div>
				</div>
			</div>
		</div>
		<?php
	}else{
		$lat2 = $_SESSION['lat'];
		$long2 = $_SESSION['lon'];
		$jarak = "5";
		$sql = "SELECT 
		( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
		l.lpk_id,l.lpk_name,l.lpk_username,l.lpk_picture,l.lpk_freeongkir,
		(6371 * acos(cos(radians(".$lat2.")) 
		* cos(radians(lpk_lat)) * cos(radians(lpk_long) 
		- radians(".$long2.")) + sin(radians(".$lat2.")) 
		* sin(radians(lpk_lat)))) 
		AS jarak 
		FROM lapak  l, (SELECT @NO_URUT := 0 ) VARIABLE_URUT 
		WHERE lpk_status like 'Y'
		HAVING jarak <= ".$jarak." 
		ORDER BY jarak LIMIT ".$idakhir.", 2
		";
		$result = $mysqli->query($sql);
		while($r = $result->fetch_array()):   
			$id = $r['lpk_id'];
		$no = $r['NO_URUT'];
		$username = $r['lpk_username'];
		$nama = $r['lpk_name'];
		$ongkir =$r['lpk_freeongkir'];
		$picture = $r['lpk_picture'];
		$km = $r['jarak'];
		if($km > 1){
			$km2 =Round($km,2 )." KM";
		}else{
			$hasil =$km*1000;
			$km2 = Round($hasil,2 )." M";
		}
		if($r = ""){
			?>
			<div class="panel panel-default">
				<div class="panel-body">      
					<div class="row"> 
						<div class="column-12">
							<img src="assets/img/maaf.png">
						</div>
					</div>
				</div>
			</div>
			<?php
		}else{
			?>
			<li class="list-content">
				<?php
				if($ongkir=="1"){
					?>
					<div class="product-wish">
						<div style="float: right;">
							<ul class="rating">
								<li>
									<img class="lazy" style="height: 30px;" src="assets/img/gratis.png">
									
								</li>      
							</ul>
						</div>
					</div>
					<?php
				}
				?>
				<a href="<?php echo $username ?>">
					<img class="lazy" src="assets/uploads/lapak/<?php echo $picture?>" >
					<div class="caption product-name">
						<?php echo  $nama ?>
					</div>  
					<div class="caption product-seller">
						<div class="content">
							<span class="fa fa-map-marker"></span>
							<?php echo $km2 ?>
						</div>
					</div>  
				</a>
			</li>
			<?php
		}
		?>
		<?php
		endwhile;
		$sql2 = "SELECT 
		( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
		l.lpk_id,l.lpk_name,l.lpk_username,
		(6371 * acos(cos(radians(".$lat2.")) 
		* cos(radians(lpk_lat)) * cos(radians(lpk_long) 
		- radians(".$long2.")) + sin(radians(".$lat2.")) 
		* sin(radians(lpk_lat)))) 
		AS jarak 
		FROM lapak  l, (SELECT @NO_URUT := 0 ) VARIABLE_URUT
		WHERE lpk_status like 'Y' 
		HAVING jarak <= ".$jarak." 
		ORDER BY jarak
		";
		$result2 = $mysqli->query($sql2);
		while($r2 = $result2->fetch_array()):
			$no2 = $r2['NO_URUT'];
		endwhile;
		    if($no2 > $idakhir){ //statement if else ini akan memutuskan apakah data masih bisa ditampilkan lagi atau tidak
		    	$noid = $idakhir+2;
		    	?>
		    	<div class="facebook_style" id="facebook_style">
		    		<a id="<?php echo $noid; ?>" href="#" class="load_more" > &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		    			Lihat Lainnya
		    			&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="assets/img/arrow1.png" />
		    		</a>
		    	</div>
		    	<?php

		    }else{
		    	?>
		    	<div id='facebook_style'>
		    		<a id='end' href='#' class='load_more' >Tidak Ada Lagi Penjual</a>
		    	</div>
		    	<?php
		    }

		}
	}
	function uploadtoko(){
		if(isset($_POST)){
			$proid =$_POST['proid'];
			############ Edit settings ##############
			$ThumbSquareSize 		= 100; //Thumbnail will be 200x200
			$BigImageMaxSize 		= 300; //Image Maximum height or width
			$ThumbPrefix			= "thumb_"; //Normal thumb Prefix
			$DestinationDirectory	= '../assets/uploads/lapak/'; //specify upload directory ends with / (slash)
			$Quality 				= 90; //jpeg quality
			##########################################				
			//check if this is an ajax request
			if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
				die();
			}
			// check $_FILES['ImageFile'] not empty
			if(!isset($_FILES['ImageFile']) || !is_uploaded_file($_FILES['ImageFile']['tmp_name']))
			{
				die('Something wrong with uploaded file, something missing!'); // output error when above checks fail.
			}

			// Random number will be added after image name
			$RandomNumber 	= rand(1000, 999999); 
			$ImageName 		= str_replace(' ','-',strtolower($_FILES['ImageFile']['name'])); //get image name
			$ImageSize 		= $_FILES['ImageFile']['size']; // get original image size
			$TempSrc	 	= $_FILES['ImageFile']['tmp_name']; // Temp name of image file stored in PHP tmp folder
			$ImageType	 	= $_FILES['ImageFile']['type']; //get file type, returns "image/png", image/jpeg, text/plain etc.
				//Let's check allowed $ImageType, we use PHP SWITCH statement here
			switch(strtolower($ImageType)){
				case 'image/png':
				//Create a new image from file 
				$CreatedImage =  imagecreatefrompng($_FILES['ImageFile']['tmp_name']);
				break;
				case 'image/gif':
				$CreatedImage =  imagecreatefromgif($_FILES['ImageFile']['tmp_name']);
				break;			
				case 'image/jpeg':
				case 'image/pjpeg':
				$CreatedImage = imagecreatefromjpeg($_FILES['ImageFile']['tmp_name']);
				break;
				default:
			die('Unsupported File!'); //output error and exit
		}
		//PHP getimagesize() function returns height/width from image file stored in PHP tmp folder.
		//Get first two values from image, width and height. 
		//list assign svalues to $CurWidth,$CurHeight
		list($CurWidth,$CurHeight)=getimagesize($TempSrc);

		//Get file extension from Image name, this will be added after random name
		$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
		$ImageExt = str_replace('.','',$ImageExt);
		//remove extension from filename
		$ImageName 		= preg_replace("/\\.[^.\\s]{3,4}$/", "", $ImageName); 
		$memid =$_SESSION['iduser'];
		$db = new database();
		$mysqli = $db->connect(); 
		$sql = "SELECT lpk_username FROM lapak WHERE mem_id LIKE '$memid'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		$lpkuser = $row['lpk_username'];
		//Construct a new name with random number and extension.
		$NewImageName = $ImageName.'-'.$lpkuser.'-'.$RandomNumber.'.'.$ImageExt;
				//set the Destination Image
		$thumb_DestRandImageName 	= $DestinationDirectory.$ThumbPrefix.$NewImageName; //Thumbnail name with destination directory
		$DestRandImageName 			= $DestinationDirectory.$NewImageName; // Image with destination directory
		//Resize image to Specified Size by calling resizeImage function.
		if($this->resizeImage($CurWidth,$CurHeight,$BigImageMaxSize,$DestRandImageName,$CreatedImage,$Quality,$ImageType)){
			//Create a square Thumbnail right after, this time we are using cropImage() function
			if(!$this->cropImage($CurWidth,$CurHeight,$ThumbSquareSize,$thumb_DestRandImageName,$CreatedImage,$Quality,$ImageType)){
				echo 'Error Creating thumbnail';
			}		/*
					We have succesfully resized and created thumbnail image
					We can now output image to user's browser or store information in the database
					*/
					echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
					echo '<tr>';
					echo '<td align="center"><img src="../assets/uploads/lapak/'.$ThumbPrefix.$NewImageName.'" alt="Thumbnail"></td>';
					echo '</tr>';
					echo '</table>';
					$a = $NewImageName;
					?>
					<input class="kb-input" name="lpk_image" style="" value="<?php echo $a?>" type="text" hidden > 
					<?php
				}else{
				die('Resize Error'); //output error
			}
		}
	}
	// This function will proportionally resize image 
	function resizeImage($CurWidth,$CurHeight,$MaxSize,$DestFolder,$SrcImage,$Quality,$ImageType){
		//Check Image size is not 0
		if($CurWidth <= 0 || $CurHeight <= 0) 
		{
			return false;
		}

		//Construct a proportional size of new image
		$ImageScale      	= min($MaxSize/$CurWidth, $MaxSize/$CurHeight); 
		$NewWidth  			= ceil($ImageScale*$CurWidth);
		$NewHeight 			= ceil($ImageScale*$CurHeight);
		$NewCanves 			= imagecreatetruecolor($NewWidth, $NewHeight);

		// Resize Image
		if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight))
		{
			switch(strtolower($ImageType))
			{
				case 'image/png':
				imagepng($NewCanves,$DestFolder);
				break;
				case 'image/gif':
				imagegif($NewCanves,$DestFolder);
				break;			
				case 'image/jpeg':
				case 'image/pjpeg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;
				default:
				return false;
			}
		//Destroy image, frees memory	
			if(is_resource($NewCanves)) {imagedestroy($NewCanves);} 
			return true;
		}
	}
	//This function corps image to create exact square images, no matter what its original size!
	function cropImage($CurWidth,$CurHeight,$iSize,$DestFolder,$SrcImage,$Quality,$ImageType){
		//Check Image size is not 0
		if($CurWidth <= 0 || $CurHeight <= 0) 
		{
			return false;
		}

		//abeautifulsite.net has excellent article about "Cropping an Image to Make Square bit.ly/1gTwXW9
		if($CurWidth>$CurHeight)
		{
			$y_offset = 0;
			$x_offset = ($CurWidth - $CurHeight) / 2;
			$square_size 	= $CurWidth - ($x_offset * 2);
		}else{
			$x_offset = 0;
			$y_offset = ($CurHeight - $CurWidth) / 2;
			$square_size = $CurHeight - ($y_offset * 2);
		}

		$NewCanves 	= imagecreatetruecolor($iSize, $iSize);	
		if(imagecopyresampled($NewCanves, $SrcImage,0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size))
		{
			switch(strtolower($ImageType))
			{
				case 'image/png':
				imagepng($NewCanves,$DestFolder);
				break;
				case 'image/gif':
				imagegif($NewCanves,$DestFolder);
				break;			
				case 'image/jpeg':
				case 'image/pjpeg':
				imagejpeg($NewCanves,$DestFolder,$Quality);
				break;
				default:
				return false;
			}
		//Destroy image, frees memory	
			if(is_resource($NewCanves)) {imagedestroy($NewCanves);} 
			return true;

		}
	}
	function tampiltoko(){
		$db = new database();
		$lpkid =$_SESSION['lpk_id'];
		$mysqli = $db->connect(); 
		$sqltmp = "SELECT l.lpk_username,l.lpk_name,l.lpk_picture,l.lpk_activehour,l.lpk_lat,l.lpk_long,l.lpk_nerbie FROM lapak l WHERE l.lpk_id ='$lpkid'";
		$resulttmp = $mysqli->query($sqltmp);
		$rowtmp= $resulttmp->fetch_array();
		$id = $rowtmp['lpk_username'];
		$jam = $rowtmp['lpk_activehour'];
		$pecah = explode("-", $jam);
		$pecahjambuka = explode(":", $pecah[0]);
		$pecahjamtutup = explode(":", $pecah[1]);
		$jambuka = $pecahjambuka[0];
		$jamtutup = $pecahjamtutup[0];
		$nerbie = $rowtmp['lpk_nerbie'];
		$_SESSION['lpknerbie'] = $nerbie;
		if(!$id){
			echo "<script>alert('Page Not Found');</script>"; 
			echo "<script>history.go(-1);</script>";
		}
		?>
		<form id="imageform" action="../helper/lapak.php?aksi=savelapak" method="POST" enctype="multipart/form-data" style="overflow: hidden;height: auto">
			<div id="output">
				<table width="100%" cellspacing="0" cellpadding="4" border="0">
					<tbody>
						<tr>
							<td align="center"><img style="height: 115px; width: 115px" src="../assets/uploads/lapak/<?php echo $rowtmp['lpk_picture']?>" alt="Thumbnail">
							</td>
						</tr>
					</tbody>
				</table> 
				<input class="kb-input" name="lpk_image" style="" value="<?php echo $rowtmp['lpk_picture']?>" type="text" hidden >
			</div>          
			<br>
			<div style=" text-align: left; padding: 0px 5px;">
				<div>
					<input class="kb-input" name="lpkid" style="" value="<?php echo $lpkid?>" type="text" hidden >
					<div class="row" style="margin-bottom: 10px;">
						<div class="column-12">
							<div>
								<label>username :</label>
								<input class="kb-input" name="lpkuser" style="" value="<?php echo $rowtmp['lpk_username']?>" placeholder="username Lapak" type="text" disabled="disabled">
							</div>
						</div>
					</div>
					
					<div class="row" style="margin-bottom: 10px;">
						<div class="column-12">
							<label>Nama Toko :</label>
							<input class="kb-input" name="lpkname" style="" value="<?php echo $rowtmp['lpk_name']?>" placeholder="Nama Produk" type="text">
						</div>
					</div>
					<div class="row" style="margin-bottom: 10px;">
						<label style="margin-left: 15px;">Jam Aktif :</label>
						<div class="column-12">
							<div class="column-5" style="padding: 0px;">
								<select class="kb-input" id="jambuka" name="jambuka">
									<option value="01">01:00</option>
									<option value="02">02:00</option>
									<option value="03">03:00</option>
									<option value="04">04:00</option>
									<option value="05">05:00</option>
									<option value="06">06:00</option>
									<option value="07">07:00</option>
									<option value="08">08:00</option>
									<option value="09">09:00</option>
									<option value="10">10:00</option>
									<option value="11">11:00</option>
									<option value="12">12:00</option>
									<option value="13">13:00</option>
									<option value="14">14:00</option>
									<option value="15">15:00</option>
									<option value="16">16:00</option>
									<option value="17">17:00</option>
									<option value="18">18:00</option>
									<option value="19">19:00</option>
									<option value="20">20:00</option>
									<option value="21">21:00</option>
									<option value="22">22:00</option>
									<option value="23">23:00</option>
									<option value="24">24:00</option>
								</select>
								<script type="text/javascript">
									var x = <?php echo $jambuka-1 ?>;   
									$("#jambuka option:eq(" + x + ")").attr("selected","selected");
								</script>
							</div>
							<div class="column-2" style="padding: 0px;text-align: center;margin-top: 10px;">
								<span>Sampai</span>
							</div>
							<div class="column-5" style="padding: 0px;">
								<select class="kb-input" id="jamtutup" name="jamtutup">
									<option value="01">01:00</option>
									<option value="02">02:00</option>
									<option value="03">03:00</option>
									<option value="04">04:00</option>
									<option value="05">05:00</option>
									<option value="06">06:00</option>
									<option value="07">07:00</option>
									<option value="08">08:00</option>
									<option value="09">09:00</option>
									<option value="10">10:00</option>
									<option value="11">11:00</option>
									<option value="12">12:00</option>
									<option value="13">13:00</option>
									<option value="14">14:00</option>
									<option value="15">15:00</option>
									<option value="16">16:00</option>
									<option value="17">17:00</option>
									<option value="18">18:00</option>
									<option value="19">19:00</option>
									<option value="20">20:00</option>
									<option value="21">21:00</option>
									<option value="22">22:00</option>
									<option value="23">23:00</option>
									<option value="24">24:00</option>
								</select>
								<script type="text/javascript">
									var x = <?php echo $jamtutup-1 ?>;   
									$("#jamtutup option:eq(" + x + ")").attr("selected","selected");
								</script>
							</div>
						</div>
					</div>

					<div class="row" style="margin-bottom: 10px;" id="lapaklokasi">
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
									<!--</span>-->
								</a>
							</div>
						</div>
						<input class="kb-input" name="lpklon" style="" value="<?php echo $rowtmp['lpk_long']?>?>" placeholder="Nama Produk" type="hidden">
						<input name="lpknerbie" value="<?php echo $_SESSION['lpknerbie']?>" type="hidden">
						<input name="lpklat" value="<?php echo $rowtmp['lpk_lat']?>?>" type="hidden">
					</div>

					<div class="row" style="margin-bottom: 10px;">
						<div class="column-12" style="margin-bottom: 10px;">
							<input name="submit" class="kb-button  button-float kb-button2" style="width: 100%;cursor: pointer;" value="Simpan" type="submit">
						</div>
					</div>
				</div>
			</div>
		</form>

		<?php
	}
	function sessionlapak($nerbie,$lat,$lon){
		$_SESSION['lpknerbie'] = $nerbie;
		$_SESSION['lpklat'] = $lat;
		$_SESSION['lpklon'] = $lon;
	}
	function savelapak($lpk_image,$lpkid,$lpkname,$jambuka,$jamtutup,$lpklon,$lpklat,$lpknerbie){
		$memid =$_SESSION['iduser'];
		$db = new database();
		$mysqli = $db->connect(); 
		$jam = $jambuka.":00-".$jamtutup.":00";
		$sql = "SELECT count(lpk_id),lpk_username FROM lapak WHERE lpk_id ='$lpkid'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		$username = $row[1];
		$sql2 ="UPDATE lapak SET lpk_name = '$lpkname', lpk_picture = '$lpk_image', lpk_activehour = '$jam', lpk_lat = '$lpklat', lpk_long = '$lpklon', lpk_nerbie = '$lpknerbie' WHERE lpk_id = '$lpkid'";

		$result = $mysqli->query($sql2);
        	 // cek hasil query
		if ($result) {
		    /* 
		    jika data berhasil disimpan alihkan ke halaman selanjutnya
		    */
		    //header("Location:../member/produk.php?Menunggu Review");
		    header("Location:../$username");
		    $_SESSION['alert'] = 'berhasildiupdate';
		    unset($_SESSION['thumb']);
		    unset($_SESSION['lpklon']);
		    unset($_SESSION['lpklat']);
		    unset($_SESSION['lpknerbie']);
		}
	}
	function ubahstatus($aksi,$user){
		$db = new database();
		$mysqli = $db->connect();
		if($aksi=="aktifkan"){
			$status = "N";
		}elseif($aksi=="nonaktifkan"){
			$status = "Y";
		}
		$sql2 ="UPDATE lapak SET lpk_status = '$status' WHERE lpk_username = '$user'";
		$result = $mysqli->query($sql2);
        	 // cek hasil query
		if ($result) {
		    /* 
		    jika data berhasil disimpan alihkan ke halaman selanjutnya
		    */
		    //header("Location:../member/produk.php?Menunggu Review");
		    header("Location: ../admin/lapak.php");
		    $_SESSION['alert'] = 'berhasildiupdate';

		}
	}
}
?>