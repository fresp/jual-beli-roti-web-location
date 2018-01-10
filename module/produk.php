<?php
date_default_timezone_set('Asia/Jakarta');	
// buat class member
class produk {
	public function __construct() {
		require_once $_SERVER['DOCUMENT_ROOT'].'/roti/config/database.php';	
	}
	public function data($idlapak){
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT
		( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
		l.pro_name,l.pro_saleprice,l.pro_id,l.pro_image,lpk.lpk_activehour
		FROM produk l  JOIN lapak lpk ON l.lpk_id=lpk.lpk_id ,
		(SELECT @NO_URUT := 0 ) VARIABLE_URUT
		where l.lpk_id  LIKE '$idlapak' AND l.pro_status LIKE 'dijual' ORDER BY pro_id DESC LIMIT 0, 2 ";
		$cek =$mysqli->query($sql);
		$hasil = $cek->fetch_array();
		//$now = "08:01";
		$now = date("H:i");
		$jam = $hasil['lpk_activehour'];
		$pecah = explode("-", $jam);
		$pecahjambuka = $pecah[0];
		$pecahjamtutup = $pecah[1];

		if($hasil[0] != NULL){
			if($now<=$pecahjambuka OR $now >=$pecahjamtutup){

				?>
				<div class="panel panel-default">
					<div class="panel-body">      
						<div class="row"> 
							<div class="column-12">
								<img src="assets/img/tutup.png">
							</div>
						</div>
					</div>
				</div>
				<?php

			}else{
				$result = $mysqli->query($sql);
				while($r = $result->fetch_array()): 

					$id = $r['lpk_id'];
				$idp =  $r['pro_id'];
				$nama =  $r['pro_name'];
				$image = $r['pro_image'];
				$harga = $r['pro_saleprice'];
				?>
				<li class="list-content">

					<a href="p/<?php echo $idp.'-'.str_replace(' ', '-', strtolower($nama)) ?>">
						<img class="lazy" src="assets/uploads/<?php echo $image ?>" >
						<div class="caption product-name">
							<?php echo  $nama ?> 
						</div>  
						<div class="caption product-seller">
							<div class="content">
								<span class="fa ">Rp</span>
								<?php
								$angka = $harga;
								$jumlah_desimal ="0";
								$pemisah_desimal =",";
								$pemisah_ribuan =".";
								echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
								?> 
							</div>
						</div>  
					</a>
				</li>
				<?php
				endwhile;
				?>
				<div class="facebook_style" id="facebook_style">
					<a id="2" name="<?php echo $idlapak?>" href="#" class="load_produk" >
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						Lihat Lainnya
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						<img src="assets/img/arrow1.png" />
					</a>
				</div>
				<?php
			}
			
		}else{
			?>
			<div class="panel panel-default">
				<div class="panel-body">      
					<div class="row"> 
						<div class="column-12">
							<img src="assets/img/gaadaproduk.png">
						</div>
					</div>
				</div>
			</div>
			<?php
		}  

	}
	public function cari($a,$b,$c,$d,$e,$f,$g,$h){
		$cari= $a." ".$b." ".$c." ".$d." ".$e." ".$f." ".$g." ".  $h;
		$db = new database();		
		$mysqli = $db->connect();
		$lat2 = $_SESSION['lat'];
		$long2 = $_SESSION['lon'];
		$jarak = "5";
		$select = "SELECT
		( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
		p.pro_name,p.pro_saleprice,p.pro_id,p.pro_image,l.lpk_freeongkir,(6371 * acos(cos(radians(".$lat2.")) 
		* cos(radians(lpk_lat)) * cos(radians(lpk_long) 
		- radians(".$long2.")) + sin(radians(".$lat2.")) 
		* sin(radians(lpk_lat)))) 
		AS jarak
		FROM lapak l INNER JOIN produk p ON l.lpk_id=p.lpk_id ,
		(SELECT @NO_URUT := 0 ) VARIABLE_URUT ";
		if(!$h){
			if(!$g){
				if(!$f){
					if(!$e){
						if(!$d){
							if(!$c){
								if(!$b){
									if(!$a){
										echo "Kosong";
									}else{
										$regex = "
										WHERE pro_name REGEXP '$a' AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
										ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') DESC LIMIT 0, 2 
										";
									}
								}else{
									$regex = "
									WHERE pro_name REGEXP '$a|$b' AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
									ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
									(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') DESC LIMIT 0, 2 ";
								}
							}else{
								$regex = "
								WHERE pro_name REGEXP '$a|$b|$c' AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
								ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
								(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
								(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') DESC LIMIT 0, 2 ";
							}
						}else{
							$regex = " WHERE pro_name REGEXP '$a|$b|$c|$d' AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
							ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
							(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
							(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
							(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') DESC LIMIT 0, 2 ";
						}
					}else{
						$regex = " WHERE pro_name REGEXP '$a|$b|$c|$d|$e' AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
						ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
						(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
						(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
						(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') +
						(pro_name REGEXP '[[:<:]]".$e."[[:>:]]') DESC LIMIT 0, 2 ";
					}
				}else{
					$regex = " WHERE pro_name REGEXP '$a|$b|$c|$d|$e|$f' AND pro_status LIKE 'dijual'  HAVING jarak <= ".$jarak."
					ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$e."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$f."[[:>:]]') DESC LIMIT 0, 2 ";
				}
			}else{
				$regex = " WHERE pro_name REGEXP '$a|$b|$c|$d|$e|$f|$g' AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
				ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$e."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$f."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$g."[[:>:]]') DESC LIMIT 0, 2 ";
			}
		}else{
			$regex = " WHERE pro_name REGEXP '$a|$b|$c|$d|$e|$f|$g|$h' AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
			ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$e."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$f."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$g."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$h."[[:>:]]') DESC LIMIT 0, 2 ";
		}
		$sql = $select.''.$regex;
		$cek =$mysqli->query($sql);
		$hasil = $cek->fetch_array();
		if($hasil[0] != NULL){
			$result = $mysqli->query($sql);
			while($r = $result->fetch_array()): 
				$id = $r['lpk_id'];
			$idp =  $r['pro_id'];
			$ongkir = $r['lpk_freeongkir'];
			$nama =  $r['pro_name'];
			$image = $r['pro_image'];
			$harga = $r['pro_saleprice'];
			?>
			<li class="list-content">
				<?php
				?>
				
				<a href="../p/<?php echo $idp.'-'.str_replace(' ', '-', strtolower($nama)) ?>">
					<img class="lazy" src="../assets/uploads/<?php echo $image?>" >
					<div class="caption product-name">
						<?php echo  $nama ?> 
					</div>  
					<div class="caption product-seller">
						<div class="content">
							<span class="fa ">Rp</span>
							<?php
							$angka = $harga;
							$jumlah_desimal ="0";
							$pemisah_desimal =",";
							$pemisah_ribuan =".";
							echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
							?> 
						</div>
					</div>  
				</a>
			</li>
			<?php
			endwhile;
			?>

			<div class="facebook_style" id="facebook_style">
				<a id="2" name="<?php echo str_replace(' ', '-', $cari)?>" href="#" class="load_cari" >
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					Lihat Lainnya
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<img src="../assets/img/arrow1.png" />
				</a>
			</div>
			<?php
		}else{
			?>
			<div class="panel panel-default">
				<div class="panel-body">      
					<div class="row"> 
						<div class="column-12">
							<img src="../assets/img/pencariangagal.png">
						</div>
					</div>
				</div>
			</div>
			<?php
		}   
	}
	public function load_cari($idakhir,$idcari){
		$db = new database();
		$teks = $idcari;
		$pecah = explode("-", $teks);
		$a = $pecah[0];
		$b = $pecah[1];
		$c = $pecah[2];
		$d = $pecah[3];
		$e = $pecah[4];
		$f = $pecah[5];
		$g = $pecah[6];
		$h = $pecah[7];
		$lat2 = $_SESSION['lat'];
		$long2 = $_SESSION['lon'];
		$jarak = "5";
		$mysqli = $db->connect();
		$select = "SELECT
		( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
		p.pro_name,p.pro_saleprice,p.pro_id,l.lpk_freeongkir,p.pro_image,(6371 * acos(cos(radians(".$lat2.")) 
		* cos(radians(lpk_lat)) * cos(radians(lpk_long) 
		- radians(".$long2.")) + sin(radians(".$lat2.")) 
		* sin(radians(lpk_lat)))) 
		AS jarak
		FROM lapak l INNER JOIN produk p ON l.lpk_id=p.lpk_id ,
		(SELECT @NO_URUT := 0 ) VARIABLE_URUT ";
		if(!$h){
			if(!$g){
				if(!$f){
					if(!$e){
						if(!$d){
							if(!$c){
								if(!$b){
									if(!$a){
										echo "Kosong";
									}else{
										$regex = "
										WHERE pro_name REGEXP '$a' AND pro_status LIKE 'dijual'  HAVING jarak <= ".$jarak."
										ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') DESC LIMIT ".$idakhir.", 2 
										";
									}
								}else{
									$regex = "
									WHERE pro_name REGEXP '$a|$b' AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
									ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
									(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') DESC LIMIT ".$idakhir.", 2";
								}
							}else{
								$regex = "
								WHERE pro_name REGEXP '$a|$b|$c' AND pro_status LIKE 'dijual'  HAVING jarak <= ".$jarak."
								ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
								(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
								(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') DESC LIMIT ".$idakhir.", 2";
							}
						}else{
							$regex = " WHERE pro_name REGEXP '$a|$b|$c|$d'  AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
							ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
							(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
							(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
							(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') DESC LIMIT ".$idakhir.", 2";
						}
					}else{
						$regex = " WHERE pro_name REGEXP '$a|$b|$c|$d|$e'  AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
						ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
						(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
						(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
						(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') +
						(pro_name REGEXP '[[:<:]]".$e."[[:>:]]') DESC LIMIT ".$idakhir.", 2 ";
					}
				}else{
					$regex = " WHERE pro_name REGEXP '$a|$b|$c|$d|$e|$f' AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
					ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$e."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$f."[[:>:]]') DESC LIMIT ".$idakhir.", 2 ";
				}
			}else{
				$regex = " WHERE pro_name REGEXP '$a|$b|$c|$d|$e|$f|$g' AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
				ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$e."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$f."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$g."[[:>:]]') DESC LIMIT ".$idakhir.", 2 ";
			}
		}else{
			$regex = " WHERE pro_name REGEXP '$a|$b|$c|$d|$e|$f|$g|$h' AND pro_status LIKE 'dijual' HAVING jarak <= ".$jarak."
			ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$e."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$f."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$g."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$h."[[:>:]]') DESC LIMIT ".$idakhir.", 2 ";
		}
		$sql = $select.''.$regex;
		$result = $mysqli->query($sql);
		while($r = $result->fetch_array()):   
			$ongkir = $r['lpk_freeongkir'];
		$idp =  $r['pro_id']; 
		$nama =  $r['pro_name'];
		$image = $r['pro_image'];
		$harga = $r['pro_saleprice'];
		if($r = ""){
			?>
			<div class="panel panel-default">
				<div class="panel-body">      
					<div class="row"> 
						<div class="column-12">
							<img src="../assets/img/gaadaproduk.png">
						</div>
					</div>
				</div>
			</div>
			<?php
		}else{
			?>
			<li class="list-content">
				<div class="product-wish">
					<div class="content">
						<ul class="rating">
							<li>
								<?php
								if($ongkir == 1){
									?>
									<img class="lazy" style="height: 30px;" src="../assets/img/gratis.png" >
									<?php
								}else{
									
								}
								?> 
							</li>      
						</ul>
					</div>
				</div>
				<a href="../p/<?php echo $idp.'-'.str_replace(' ', '-', strtolower($nama)) ?>">
					<img class="lazy" src="../assets/uploads/<?php echo $image?>" >
					<div class="caption product-name">
						<?php echo  $nama ?> 
					</div>  
					<div class="caption product-seller">
						<div class="content">
							<span class="fa ">Rp</span>
							<?php
							$angka = $harga;
							$jumlah_desimal ="0";
							$pemisah_desimal =",";
							$pemisah_ribuan =".";
							echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
							?> 
						</div>
					</div>  
				</a>
			</li>
			<?php
		}
		?>
		<?php
		endwhile;
		$select1 = "SELECT
		( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
		l.pro_name,l.pro_saleprice,l.pro_id
		FROM Produk l ,
		(SELECT @NO_URUT := 0 ) VARIABLE_URUT";
		if(!$h){
			if(!$g){
				if(!$f){
					if(!$e){
						if(!$d){
							if(!$c){
								if(!$b){
									if(!$a){
										echo "Kosong";
									}else{
										$regex1 = "
										WHERE pro_name REGEXP '$a' AND pro_status LIKE 'dijual'
										ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') DESC 
										";
									}
								}else{
									$regex1 = "
									WHERE pro_name REGEXP '$a|$b' AND pro_status LIKE 'dijual'
									ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
									(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') DESC ";
								}
							}else{
								$regex1 = "
								WHERE pro_name REGEXP '$a|$b|$c' AND pro_status LIKE 'dijual'
								ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
								(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
								(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') DESC ";
							}
						}else{
							$regex1 = " WHERE pro_name REGEXP '$a|$b|$c|$d' AND pro_status LIKE 'dijual'
							ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
							(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
							(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
							(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') DESC";
						}
					}else{
						$regex1 = " WHERE pro_name REGEXP '$a|$b|$c|$d|$e' AND pro_status LIKE 'dijual'
						ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
						(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
						(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
						(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') +
						(pro_name REGEXP '[[:<:]]".$e."[[:>:]]') DESC ";
					}
				}else{
					$regex1 = " WHERE pro_name REGEXP '$a|$b|$c|$d|$e|$f' AND pro_status LIKE 'dijual'
					ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$e."[[:>:]]') +
					(pro_name REGEXP '[[:<:]]".$f."[[:>:]]') DESC ";
				}
			}else{
				$regex1 = " WHERE pro_name REGEXP '$a|$b|$c|$d|$e|$f|$g' AND pro_status LIKE 'dijual'
				ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$e."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$f."[[:>:]]') +
				(pro_name REGEXP '[[:<:]]".$g."[[:>:]]') DESC ";
			}
		}else{
			$regex1 = " WHERE pro_name REGEXP '$a|$b|$c|$d|$e|$f|$g|$h' AND pro_status LIKE 'dijual'
			ORDER BY (pro_name REGEXP '[[:<:]]".$a."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$b."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$c."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$d."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$e."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$f."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$g."[[:>:]]') +
			(pro_name REGEXP '[[:<:]]".$h."[[:>:]]') DESC ";
		}
		$sql2 = $select1.''.$regex1;
		$result2 = $mysqli->query($sql2);
		while($r2 = $result2->fetch_array()):
			$no2 = $r2['NO_URUT'];
		endwhile;
		if($no2 > $idakhir){ //statement if else ini akan memutuskan apakah data masih bisa ditampilkan lagi atau tidak
			$noid = $idakhir+2;
			?>
			<div class="facebook_style" id="facebook_style">
				<a id="<?php echo $noid; ?>" name="<?php echo $teks?>" href="#" class="load_cari" > &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					Lihat Lainnya
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="../assets/img/arrow1.png" />
				</a>
			</div>
			<?php
		}else{
			?>
			<div id='facebook_style'>
				<a id='end' href='#' class='load_more' >Tidak Ada Lagi Produk</a>
			</div>
		</div>
		<?php
	}
}
public function detail($name){
	$pecah = explode("-", $name);
	$hasil = $pecah[0];
	$lat2 = $_SESSION['lat'];
	$long2 = $_SESSION['lon'];
	$jarak = "5";
	$db = new database();		
	$mysqli = $db->connect();
	$sql = "SELECT count(pro_id) FROM produk WHERE pro_id LIKE '$hasil'";
	$result = $mysqli->query($sql);
	$row= $result->fetch_array();
	if($row[0]>0){
		include 'member/template/headaccess.php';
		if($_SESSION['alert']=='cart'){
			?>
			<script type='text/javascript'>
				$(document).ready( function () {
					cheers.success({
						title: 'Berhasil Membeli',
						message: '&nbsp',
						alert: $('select[name="alert"]').val(),
					});
				}); 
			</script>
			<?php
			unset($_SESSION['alert']);
		}

		$sql2 = "SELECT p.pro_name,p.pro_image,p.pro_saleprice,c.ctgr_name,l.lpk_name,l.lpk_username,l.lpk_activehour,p.pro_description,p.pro_image,
		(6371 * acos(cos(radians(".$lat2.")) 
		* cos(radians(lpk_lat)) * cos(radians(lpk_long) 
		- radians(".$long2.")) + sin(radians(".$lat2.")) 
		* sin(radians(lpk_lat)))) 
		AS jarak  FROM produk p JOIN category c ON p.ctgr_id=c.ctgr_id JOIN lapak l ON p.lpk_id=l.lpk_id  WHERE p.pro_id LIKE '$hasil' HAVING jarak <= ".$jarak." limit 1";
		$result2 = $mysqli->query($sql2);
		$row2= $result2->fetch_array();
		$image =$row2['pro_image'];
		$now = date("H:i");
		$jam = $row2['lpk_activehour'];
		$pecah = explode("-", $jam);
		$pecahjambuka = $pecah[0];
		$pecahjamtutup = $pecah[1];
		$username = $row2['lpk_username'];
		if($username){
			?>
			<div style="margin-top: 90px;" class="container container-top">
				<div id="newest-welcome-list" style="background: #fff">
					<div class="feed" id="feed">
						<ul class="product-list"  id="updates">
							<li class="pro-content">
								<h2><?php echo $row2['pro_name'];?></h2>
								<hr>
								<div class="column-5">
									<img class="pro-content-img" src="../assets/uploads/<?php echo $image?>" >
								</div>
								<div class="column-7" style="text-align: left;">
									<div class="product-price">
										Rp. <?php
										$angka = $row2['pro_saleprice'];
										$jumlah_desimal ="0";
										$pemisah_desimal =",";
										$pemisah_ribuan =".";
										echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
										?> 
									</div>
									<div style="margin-top: 10px;overflow: hidden;">
										<?php
										
										if($username == $_SESSION['lpkuser']){
											?>
											<a href="../member/edit_product.php?id=<?php echo $hasil;?>" class="btn-pesan" style="background: #F39C12;float: left;"> EDIT</a>
											<?php
										}else{
											if($now<=$pecahjambuka OR $now >=$pecahjamtutup){
												?>
												
												<a class="btn-pesan" style="background: #fff;color: #9c0b0b;;border: 2px solid #7b1111;float: left;"> TUTUP</a>
												<?php
											}else{
												?>
												<form action="../helper/produk.php?aksi=cart" method="POST">
													<input hidden type="text" name="idproduk" value="<?php echo $hasil;?>">
													<input step="1" min="1" max="" name="quantity" value="1" title="Qty" class="product-qty" size="4" pattern="[0-9]*" inputmode="numeric" type="number">
													<input type="submit" class="btn-pesan" style="background: #F39C12;float: left;" value="BELI"> 
												</form>
												<?php
											}
										}
										?>
									</div>
									<hr>
									<b>Kategori : </b> <br> <?php echo $row2['ctgr_name'];?><Br><br>	

								</div>
								<div class="column-12">
									<div class="tab" style="margin-top: 1em;">
										<div  style="float: left;">
											<b>Penjual  : </b> <a href="../<?php echo $username ?>"> <?php echo $row2['lpk_name'];?></a>

										</div>

										
									</div>
									<div class="tab">
										<div class="rev-content" >
											<div class="rev-user-feed" style="width: 100%;">
												<h6>Deskripsi</h6>
												<span style="font-style: italic;font-size: 11px;margin-top: 10px">
													<p><?php echo $row2['pro_description'];?></p>
												</span>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<?php include 'member/template/footeraccess.php';

		}else{
			$_SESSION['alert'] = 'diluar';
			echo "<script>history.go(-1);</script>";
		} 
		
	}
	else{
		header("Location: index.php");
	}
	$mysqli->close();
}
public function load_more($idakhir,$idlapak){
	$db = new database();		
	$mysqli = $db->connect();
	$sql = "SELECT
	( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
	l.pro_name,l.pro_saleprice,l.pro_id,l.pro_image
	FROM Produk l ,
	(SELECT @NO_URUT := 0 ) VARIABLE_URUT
	where l.lpk_id  LIKE '$idlapak' AND l.pro_status LIKE 'dijual' ORDER BY pro_id DESC LIMIT ".$idakhir.", 2";
	$result = $mysqli->query($sql);
	while($r = $result->fetch_array()):   

		$idp =  $r['pro_id']; 
	$nama =  $r['pro_name'];
	$harga = $r['pro_saleprice'];
	$image = $r['pro_image'];
	if($r = ""){
		?>
		<div class="panel panel-default">
			<div class="panel-body">      
				<div class="row"> 
					<div class="column-12">
						<img src="assets/img/gaadaproduk.png">
					</div>
				</div>
			</div>
		</div>
		<?php
	}else{
		?>
		<li class="list-content">
			
			<a href="p/<?php echo $idp.'-'.str_replace(' ', '-', strtolower($nama)) ?>">
				<img class="lazy" src="assets/uploads/<?php echo $image?>" >
				<div class="caption product-name">
					<?php echo  $nama ?> 
				</div>  
				<div class="caption product-seller">
					<div class="content">
						<span class="fa ">Rp</span>
						<?php
						$angka = $harga;
						$jumlah_desimal ="0";
						$pemisah_desimal =",";
						$pemisah_ribuan =".";
						echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
						?> 
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
	l.pro_name,l.pro_saleprice
	FROM Produk l ,
	(SELECT @NO_URUT := 0 ) VARIABLE_URUT
	where l.lpk_id  LIKE '$idlapak' AND l.pro_status LIKE 'dijual' ORDER BY pro_created DESC ";
	$result2 = $mysqli->query($sql2);
	while($r2 = $result2->fetch_array()):
		$no2 = $r2['NO_URUT'];
	endwhile;
		if($no2 > $idakhir){ //statement if else ini akan memutuskan apakah data masih bisa ditampilkan lagi atau tidak
			$noid = $idakhir+2;
			?>
			<div class="facebook_style" id="facebook_style">
				<a id="<?php echo $noid; ?>" name="<?php echo $idlapak?>" href="#" class="load_produk" > &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					Lihat Lainnya
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="assets/img/arrow1.png" />
				</a>
			</div>
			<?php
		}else{
			?>
			<div id='facebook_style'>
				<a id='end' href='#' class='load_more' >Tidak Ada Lagi Produk</a>
			</div>
			<?php
		}
	}
	function uploadproduct(){
		if(isset($_POST)){
			$proid =$_POST['proid'];
			############ Edit settings ##############
			$ThumbSquareSize 		= 100; //Thumbnail will be 200x200
			$BigImageMaxSize 		= 300; //Image Maximum height or width
			$ThumbPrefix			= "thumb_"; //Normal thumb Prefix
			$DestinationDirectory	= '../assets/uploads/'; //specify upload directory ends with / (slash)
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
					$a = $NewImageName;
					echo '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
					echo '<tr>';
					echo '<td align="center"><img src="../assets/uploads/'.$ThumbPrefix.$NewImageName.'" alt="Thumbnail"></td>';
					echo '<td align="center"><input type="text" class="kb-input" hidden="hidden"  id="pro_gambar"  name="pro_gambar" style="" value="'.$a.'" ></td>';

					echo '</tr>';
					echo '</table>';
					?>
					<script type="text/javascript">
						$(document).ready(function()
						{
							$('#pro_image').val($('#pro_gambar').val());
							$("#errorpay").remove();
							$('#submit').attr("disabled", false);
						});
					</script>
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
	function tampilproduk($proid){
		$db = new database();
		$lpkid =$_SESSION['lpk_id'];
		$mysqli = $db->connect(); 
		$sqltmp = "SELECT l.lpk_username,p.pro_image,p.pro_name,p.ctgr_id,p.pro_saleprice,p.pro_description,p.pro_id FROM lapak l JOIN produk p on l.lpk_id=p.lpk_id WHERE p.pro_id ='$proid' and l.lpk_id ='$lpkid'";
		$resulttmp = $mysqli->query($sqltmp);
		$rowtmp= $resulttmp->fetch_array();
		$id = $rowtmp['pro_id'];
		if(!$id){
			echo "<script>alert('Page Not Found');</script>"; 
			echo "<script>history.go(-1);</script>";
		}
		?>
		<div id="output" >
			<table width="100%" cellspacing="0" cellpadding="4" border="0">
				<tbody>
					<tr>
						<td align="center"><img style="height: 115px; width: 115px" src="../assets/uploads/<?php echo $rowtmp['pro_image']?>" alt="Thumbnail">
						</td>
					</tr>
				</tbody>
			</table>  

		</div>
		<form id="imageform" style="height: 380px;" action="../helper/produk.php?aksi=saveproduk" method="POST" enctype="multipart/form-data">

			<div style=" text-align: left; padding: 0px 5px;">
				<div>
					<input class="kb-input" name="proid" style="" value="<?php echo $rowtmp['pro_id']?>" type="text" hidden="hidden">
					<input type="hidden" class="kb-input " name="pro_image" id="pro_image"  value="<?php echo $rowtmp['pro_image']?>" placeholder="Nama Gambar">
					<div class="row" style="margin-bottom: 10px;">
						<div class="column-12">
							<div>
								<label >Kategori Produk :</label>
								<div class="">
									<select class="kb-input" name="ctrg_id">
										<option value="1">Kue Tradisional</option>
										<option value="2">Roti Tawar</option>
										<option value="3">Roti Manis</option>
										<option value="4">Donat</option>
										<option value="5">Cake</option>
										<option value="6">Tart</option>
										<option value="7">Keringan</option>
										<option value="8">Lain lain</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						var x = <?php echo $rowtmp['ctgr_id']-1 ?>;   
						$("#catBox option:eq(" + x + ")").attr("selected","selected");
					</script>
					<div class="row" style="margin-bottom: 10px;">
						<div class="column-12">
							<label>Nama Produk :</label>
							<input class="kb-input" name="pro_name" style="" value="<?php echo $rowtmp['pro_name']?>" placeholder="Nama Produk" type="text">
						</div>
					</div>
					<div class="row" style="margin-bottom: 10px;">
						<div class="column-12">
							<label >Harga Produk :</label>
							<input type="number" class="kb-input required required" 
							value="<?php echo $rowtmp['pro_saleprice']?>" name="pro_saleprice" id="pro_saleprice" placeholder="Harga">
						</div>
					</div>
					<div class="row" style="margin-bottom: 10px;">
						<div class="column-12">
							<label >Deskripsi Produk :</label>
							<textarea class="kb-textarea required" name="pro_description" id="pro_description" style="width: 96%;height: 7em;" placeholder="Deskripsi Produk" value="<?php echo $rowtmp['pro_description']?>"><?php echo $rowtmp['pro_description']?></textarea>
						</div>
					</div>


					<div class="row" style="margin-bottom: 10px;">
						<div class="column-12">
							<input type="submit" name="submit" id="submit" class="kb-button  button-float kb-button2" style="width: 100%;cursor: pointer;" value="Posting">
						</div>
					</div>
				</div>
			</div>
		</form>
		<script>
			$(function() {
				$("#imageform").submit(function() {
					$("#pro_image").each(function() {
						var checkbox = $("#pro_image").val();
						if (!checkbox) {
							$('<span>Foto Tidak Boleh Kosong</span>').appendTo('#errorpay');
							$('#metode').css('border', '2px solid #df3434');
							$('#submit').attr("disabled", true);
						}else {
							document.getElementById("userform").submit();
						}
					});

					return false;
				});
			});
		</script>
		<?php
	}
	function saveproduk($pro_name,$proid,$ctrg_id,$pro_image,$pro_saleprice,$deskripsi){
		$memid =$_SESSION['iduser'];
		$db = new database();
		$mysqli = $db->connect(); 
		$today =date('Y-m-d');
		$sql = "SELECT count(p.pro_id) FROM lapak l JOIN produk p on l.lpk_id=p.lpk_id WHERE p.pro_id ='$proid'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		$lpk = $_SESSION['lpk_id'];
		if($row[0]=="1"){
			$sql2="UPDATE produk SET pro_name = '$pro_name', ctgr_id = '$ctrg_id', pro_saleprice = '$pro_saleprice', pro_description = '$deskripsi', pro_image = '$pro_image',pro_status = 'review' WHERE pro_id = '$proid'";
			$_SESSION['alert'] = "updateproduk";
		}else{
			$sql2 = "INSERT INTO produk(lpk_id,pro_name,ctgr_id,pro_image,pro_saleprice,pro_description,pro_status,pro_created)VALUES ('$lpk','$pro_name', '$ctrg_id', '$pro_image', '$pro_saleprice', '$deskripsi', 'review','$today')";
			$_SESSION['alert'] = "tambahproduk";
		}
		$result = $mysqli->query($sql2);
        	 // cek hasil query
		if ($result) {

			header('Location:../member/index.php');
		}else {
		        /* 
		        jika data tidak berhasil disimpan alihkan ke halaman joinseller lagi
		        */
		        //header("Location:../member/produk.php?Gagal");
		    }

		    $mysqli->close();
		}
		function cart($idproduk,$quantity){
			$memid =$_SESSION['iduser'];
			$db = new database();
			$mysqli = $db->connect(); 
			$today =date('Y-m-d');
			$sql = "SELECT count(pro_id), cart_qty,cart_id FROM cart WHERE mem_id LIKE '$memid' and pro_id = '$idproduk'";
			$result = $mysqli->query($sql);
			$row= $result->fetch_array();
			$tambah = $row[1]+1;
			$id =$row['cart_id'];
			if($_SESSION['login']=="YES"){
				if($row[0]>0){
					$sql2 = "UPDATE cart SET cart_qty = '$tambah' WHERE cart_id = '$id'";
					$result = $mysqli->query($sql2);
					if ($result) {
						$_SESSION['alert'] = 'cart';
						echo "<script>history.go(-1);</script>";
					}
				}else{
					$sql2 = "INSERT INTO cart(mem_id,pro_id,cart_qty,cart_created)VALUES ('$memid','$idproduk', '$quantity','$today')";
					$result = $mysqli->query($sql2);
					if ($result){
						$_SESSION['alert'] = 'cart';
						echo "<script>history.go(-1);</script>";
					}
				}
				$mysqli->close();
			}else{
				$_SESSION['alert'] = 'denied';
				header("Location: ../index.php");
			}

		}
		function listcart($segment){
			$memid =$_SESSION['iduser'];
			$lat2 = $_SESSION['lat'];
			$long2 = $_SESSION['lon'];
			if(!$lat2){
				?>
				<div class="search-content" style=" height: 86%; overflow-y: scroll;">	
					<p style="padding-top: 250px;font-weight: bold;">Tentukan Lokasi Kamu dulu</p>
				</div>
				<?php
			}else{
				$db = new database();
				$mysqli = $db->connect(); 
				$sql = "SELECT cart_id FROM cart WHERE mem_id LIKE '$memid' GROUP BY pro_id";
				$result = $mysqli->query($sql);
				$hasil = $result->fetch_array();
				if($hasil[0] != NULL){
					?>
					<?php
					$sql = "SELECT l.lpk_name,l.lpk_id,l.lpk_freeongkir,l.lpk_username,Sum(c.cart_qty)  AS subtotal,sum(c.cart_qty *p.pro_saleprice) as hasil,(6371 * acos(cos(radians(".$lat2.")) 
					* cos(radians(l.lpk_lat)) * cos(radians(l.lpk_long) 
					- radians(".$long2.")) + sin(radians(".$lat2.")) 
					* sin(radians(lpk_lat)))) 
					AS jarak  FROM cart c JOIN produk p ON c.pro_id=p.pro_id JOIN lapak l ON l.lpk_id=p.lpk_id where c.mem_id like '$memid' GROUP BY p.lpk_id  HAVING jarak <= '5'";
					$cek = $mysqli->query($sql);
					$hasil1 = $cek->fetch_array();
					$result = $mysqli->query($sql);
					if($hasil1[0] == NULL){
						?>
						<div class="search-content" style=" height: 86%; overflow-y: scroll;">	
							<p style="padding-top: 250px;font-weight: bold;">Keranjang Kosong atau Penjual Diluar Jangkauan</p>
						</div>
						<?php
					}else{
						?>
						<span class="fa fa-map-marker" style="color: #FF5454;">
							<?php
							if($_SESSION['nerbie']==""){
								echo "</span> Tentukan Lokasimu";
							}
							else{
								$teks = $_SESSION['nerbie'];
				                //pecah string berdasarkan string ","
								$pecah = explode(",", $teks);
				                //mencari element array 0
								$hasil = $pecah[0];
				                //tampilkan hasil pemecahan

								echo "5 KM </span> dari ".$hasil;
							}	
							?>
							<div class="search-content" style=" height: 86%; overflow-y: scroll;">
								<?php
								$i= 1; 
								$subtotal = array();
								while($r = $result->fetch_array()):
									$lpk = $r[1];
								$subtotal[] =  $r['hasil'];
								$ongkir = $r['lpk_freeongkir'];
								if($ongkir == "0"){
									$jarak = ceil($r['jarak'])*5000;
								}else{
									$jarak = 0;
								}
								
								?>
								<div class="column-12">
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


									</div>
									<div class="tab">
										<?php
										$sql2 = "SELECT c.cart_id,l.lpk_freeongkir, p.pro_name,p.pro_saleprice,p.pro_image,Sum(c.cart_qty) AS total FROM cart c JOIN produk p ON c.pro_id=p.pro_id JOIN lapak l ON l.lpk_id=p.lpk_id where l.lpk_id like '$lpk' and c.mem_id like '$memid' GROUP by p.pro_name ";
										$result2 = $mysqli->query($sql2);
										$i=0;
										while($r2 = $result2->fetch_array()):
											$a[$i]= $r2['cart_id'];
										$all[]= $r2['cart_id'];
										?>
										<div class="rev-content" style="height: 60px;" >
											<div class="rev-user" style="margin-left: -10px;" >
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
												<div class="column-6" style="padding-right: 10px;padding-left: 0px;">
													<span style="font-style: italic;font-size: 11px;">
														<form  id="frm-cart<?php echo $r2['cart_id']; ?>" method="POST">
															<input step="1" style="height: 30px;"  min="1" max="" name="quantity" value="<?php echo $r2['total'] ?>" title="Qty" class="product-qty" size="4" pattern="[0-9]*" inputmode="numeric" type="number" id="qty<?php echo $r2['cart_id']; ?>" >
															<input type="text" name="id" value="<?php echo $r2['cart_id']; ?>" hidden>

															<a id="del" name="<?php echo $r2['cart_id']; ?>" class="btn-pesan del" style="background: #CD220C;height: 30px;padding: 5px;"><i class="fa fa-trash"></i></a> 
															<a id="update" name="<?php echo $r2['cart_id']; ?>" class="btn-pesan update <?php echo $r2['cart_id']; ?>" data-reveal-id="<?php echo $r2['cart_id']; ?>" style="display: none;background: #0CC0D4;height: 30px;padding: 5px;"><i class="fa fa-refresh" ></i></a> 
														</form>
														<script type="text/javascript">
															var timerid;	
															$("#qty<?php echo $r2['cart_id']; ?>").on("input",function(e){
																var value = $(this).val();
																if($(this).data("lastval")!= value){
																	$(this).data("lastval",value);
																	clearTimeout(timerid);
																	timerid = setTimeout(function() {
												    				//change action
												    				$('[data-reveal-id="<?php echo $r2['cart_id']; ?>"]').trigger('click');
												    			},500);
																};
															});
														</script>
													</span>
												</div>
											</div>
										</div>
										<?php
										$i++;
										endwhile;

										?>

										<div class="ongkir-content">
											<div class="column-6" style="text-align:  left;">Total <?php echo $r['subtotal'];?> barang<br>
												Rp. 
												<?php
												$angka = $r['hasil']+$jarak;
												$jumlah_desimal ="0";
												$pemisah_desimal =",";
												$pemisah_ribuan =".";
												echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
												?> 

											</div>
											<div class="column-6" style="text-align: right;">
										<!--<form action="helper/payment.php?aksi=cartselected" method="POST">
											<input type="hidden" name="total" value="<?php echo $angka ?>">
											<input type="hidden" name="lpkid" value="<?php echo $lpk ?>">
											<input type="submit" name="" class="btn-pesan" value="Bayar">
										</form>
									-->
									<?php
									$kalimat = implode("-",$a);
									$jadi = "selected=".$kalimat;
										// satu dua tiga empat lima
									?>
									<?php
									if($segment=="sub"){
										echo '<a class="btn-pesan" href="../orderconfirm.php?'.$jadi.'">Bayar</a>';
									}else{
										echo '<a class="btn-pesan" href="orderconfirm.php?'.$jadi.'">Bayar</a>';
									}
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
				<footer style="border-top: 2px solid #d2d2d2;box-shadow: 2px 0 0 rgba(0, 0, 0, .13);width: 100%;padding: 7px;">
					<div class="column-6" style="text-align: left;">
						Total  Biaya<br>
						<?php
						$sqlcart = "SELECT c.cart_id,l.lpk_id,l.lpk_freeongkir, (6371 * acos(cos(radians(".$lat2.")) 
			              * cos(radians(l.lpk_lat)) * cos(radians(l.lpk_long) 
						- radians(".$long2.")) + sin(radians(".$lat2.")) 
			              * sin(radians(lpk_lat)))  ) 
						AS jarak  FROM cart c JOIN produk p ON c.pro_id=p.pro_id JOIN lapak l ON l.lpk_id=p.lpk_id where c.mem_id like '$memid' GROUP BY l.lpk_id HAVING jarak <= '5'";
						$resultcart = $mysqli->query($sqlcart);
						$ongkir = array();
						while($rcart = $resultcart->fetch_array()):
							$lpk = $rcart['lpk_id'];
						$fre = $rcart['lpk_freeongkir'];
						if($fre=="1"){
							$jarak = 0;
						}else{
							$jarak = $rcart['jarak'];
						}
						$ongkir[] =  ceil($jarak);
						$sql3 = "SELECT c.cart_id,sum(p.pro_saleprice*c.cart_qty) as pro_saleprice,(6371 * acos(cos(radians(".$lat2.")) 
			              * cos(radians(l.lpk_lat)) * cos(radians(l.lpk_long) 
						- radians(".$long2.")) + sin(radians(".$lat2.")) 
			              * sin(radians(lpk_lat)))  ) 
						AS jarak FROM cart c JOIN produk p ON c.pro_id=p.pro_id JOIN lapak l ON l.lpk_id=p.lpk_id where c.mem_id like '$memid' HAVING jarak <= '5'";
						$result = $mysqli->query($sql3);

						$subtotal =array();
						while($r3 = $result->fetch_array()):
							
							$subtotal[] =  $r3['pro_saleprice'];
						?>
						<?php

						endwhile;
						$filter1 = $subtotal;

						$filter = $ongkir;
						endwhile;
						
						?>
						
						<p style="margin-top: 0px;font-size: 16px;font-weight: bold;">Rp. 
							<?php
							
							$b = array_sum($filter1);
							$a = ceil(array_sum($filter))*5000;

							$angka = $b+$a;
							$jumlah_desimal ="0";
							$pemisah_desimal =",";
							$pemisah_ribuan =".";
							$a =number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
							echo $a;
							?></p>
						</div>
						<div class="column-6">
							<?php
							$kalimat = implode("-",$all);
							$jadi = "selected=".$kalimat;
										// satu dua tiga empat lima
							?>
							<?php
							if($segment=="sub"){
								echo '<a class="btn-pesan" href="../orderconfirm.php?'.$jadi.'">Bayar</a>';
							}else{
								echo '<a class="btn-pesan" href="orderconfirm.php?'.$jadi.'">Bayar</a>';
							}
							?>
							
						</div>
					</footer>
					<?php
				}
			}else{
				?>
				<div class="search-content" style=" height: 86%; overflow-y: scroll;">	
					<p style="padding-top: 250px;font-weight: bold;">Belum ada barang di keranjang belanja kamu </p>
				</div>
				<?php
			}
		}
	}
	function cartdel($id){
		$memid =$_SESSION['iduser'];
		$db = new database();
		$mysqli = $db->connect();	
		$sql2 = "DELETE FROM cart WHERE cart_id = '$id'";
		$result = $mysqli->query($sql2);        
		$mysqli->close();
	}
	function cartupdate($id,$quantity){
		$memid =$_SESSION['iduser'];
		$db = new database();
		$mysqli = $db->connect(); 
		if($quantity < 1){
			$sql = "DELETE FROM cart WHERE cart_id = '$id'";
		}else{
			$sql = "UPDATE cart SET cart_qty = '$quantity' WHERE cart_id = '$id'";
		}
		$result = $mysqli->query($sql);
		$mysqli->close();
	}
	public function databarang($idlapak,$filter){ //produk di menu produk di menu
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT
		( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
		l.pro_name,l.pro_saleprice,l.pro_id,l.pro_image
		FROM Produk l ,
		(SELECT @NO_URUT := 0 ) VARIABLE_URUT
		where l.lpk_id LIKE '$idlapak' AND l.pro_status LIKE '$filter' ORDER BY pro_id DESC LIMIT 0, 2 ";
		$cek =$mysqli->query($sql);
		$hasil = $cek->fetch_array();
		if($hasil[0] != NULL){
			$result = $mysqli->query($sql);
			while($r = $result->fetch_array()): 
				$id = $r['lpk_id'];
			$idp =  $r['pro_id'];
			$nama =  $r['pro_name'];
			$image =$r['pro_image'];
			$harga = $r['pro_saleprice'];
			?>
			<li class="list-content">
				
				<div class="product-wish" >
					<div class="content">
						<ul class="rating" style="float: left;margin: 125px 3px;">
							<li>
								<a href="edit_product.php?id=<?php echo $idp?>" style="background: #D91256;padding: 5px 10px 5px 10px;color: #fff;">Ubah</a>
							</li>

						</ul>
						<ul class="rating" style="float: right;margin: 125px 3px;">
							
							<li >
								<a href="../helper/produk.php?aksi=delete&idp=<?php echo $idp?>" style="background: #4e4949;padding: 5px 10px 5px 10px;color: #fff;">Hapus</a>
							</li>      
						</ul>
					</div>

				</div>
				<a href="p/<?php echo $idp.'-'.str_replace(' ', '-', strtolower($nama)) ?>">
					<img class="lazy" src="../assets/uploads/<?php echo $image?>" >
					<div class="caption product-name">
						<?php echo  $nama ?> 
					</div>  
					<div class="caption product-seller">
						<div class="content">
							<span class="fa ">Rp</span>
							<?php
							$angka = $harga;
							$jumlah_desimal ="0";
							$pemisah_desimal =",";
							$pemisah_ribuan =".";
							echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
							?> 
						</div>
					</div>  
				</a>
			</li>
			<?php
			endwhile;
			?>
			<div class="facebook_style" id="facebook_style">
				<a id="2" name="<?php echo $idlapak."|".$filter?>" href="#" class="load_barang" >
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					Lihat Lainnya
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<img src="../assets/img/arrow1.png" />
				</a>
			</div>
			<?php
		}else{
			?>
			<div class="panel panel-default">
				<div class="panel-body">      
					<div class="row"> 
						<div class="column-12">
							<img src="../assets/img/gaadaproduk.png">
						</div>
					</div>
				</div>
			</div>
			<?php
		}   
	}
	public function load_morebarang($idakhir,$pecah){ //loadmore produk di menu
		$db = new database();
		$pecah = explode("|", $pecah);
		$idlapak = $pecah[0];
		$filter = $pecah[1];
		$mysqli = $db->connect();
		$sql = "SELECT
		( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
		l.pro_name,l.pro_saleprice,l.pro_id,l.pro_image
		FROM Produk l ,
		(SELECT @NO_URUT := 0 ) VARIABLE_URUT
		where l.lpk_id  LIKE '$idlapak' AND l.pro_status LIKE '$filter' ORDER BY pro_id DESC LIMIT ".$idakhir.", 2";
		$result = $mysqli->query($sql);
		while($r = $result->fetch_array()):   
			
			$idp =  $r['pro_id']; 
		$nama =  $r['pro_name'];
		$image = $r['pro_image'];
		$harga = $r['pro_saleprice'];
		if($r = ""){
			?>
			<div class="panel panel-default">
				<div class="panel-body">      
					<div class="row"> 
						<div class="column-12">
							<img src="../assets/img/gaadaproduk.png">
						</div>
					</div>
				</div>
			</div>
			<?php
		}else{
			?>
			<li class="list-content">
				<div class="product-wish">
					<div class="content">
						<ul class="rating" style="float: left;margin: 125px 3px;">
							<li>
								<a href="edit_product.php?id=<?php echo $idp?>" style="background: #D91256;padding: 5px 10px 5px 10px;color: #fff;">Ubah</a>
							</li>

						</ul>
						<ul class="rating" style="float: right;margin: 125px 3px;">
							
							<li >
								<a href="../helper/produk.php?aksi=delete&idp=<?php echo $idp?>" style="background: #4e4949;padding: 5px 10px 5px 10px;color: #fff;">Hapus</a>
							</li>      
						</ul>
					</div>
				</div>
				<a href="p/<?php echo $idp.'-'.str_replace(' ', '-', strtolower($nama)) ?>">
					<img class="lazy" src="../assets/uploads/<?php echo $image ?>" >
					<div class="caption product-name">
						<?php echo  $nama ?> 
					</div>  
					<div class="caption product-seller">
						<div class="content">
							<span class="fa ">Rp</span>
							<?php
							$angka = $harga;
							$jumlah_desimal ="0";
							$pemisah_desimal =",";
							$pemisah_ribuan =".";
							echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
							?> 
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
		l.pro_name,l.pro_saleprice
		FROM Produk l ,
		(SELECT @NO_URUT := 0 ) VARIABLE_URUT
		where l.lpk_id  LIKE '$idlapak' AND l.pro_status LIKE '$filter' ORDER BY pro_created DESC ";
		$result2 = $mysqli->query($sql2);
		while($r2 = $result2->fetch_array()):
			$no2 = $r2['NO_URUT'];
		endwhile;
		if($no2 > $idakhir){ //statement if else ini akan memutuskan apakah data masih bisa ditampilkan lagi atau tidak
			$noid = $idakhir+2;
			?>
			<br>
			<div class="facebook_style" id="facebook_style">
				<a id="<?php echo $noid; ?>" name="<?php echo $idlapak."|".$filter?>" href="#" class="load_barang" >
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					Lihat Lainnya
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<img src="../assets/img/arrow1.png" />
				</a>
			</div>
			<?php
		}else{
			?>
			<div id='facebook_style'>
				<a id='end' href='#' class='load_more' >Tidak Ada Lagi Produk</a>
			</div>
			<?php
		}
	}
	function kategori($segment){
		$db = new database();
		$mysqli = $db->connect(); 
		$sql = "SELECT ctgr_name FROM category";
		$result = $mysqli->query($sql);
		while($r2 = $result->fetch_array()):
			$name = $r2['ctgr_name'];
		$kategori=str_replace(' ', '-', $name);
		?>
		<div class="column-12"  style="padding: 0px;margin: 5px 0px 5px 0px;">
			<div class="column-1">
			</div>
			<?php
			if($segment=="index"){
				?>
				<a href="kategori/<?php echo $kategori ?>" style="width: 100%;padding-left: 27px;">
					<div class="column-10"><span style=""><?php echo $name ?></span><br>
					</div>
				</a>
				<?php
			}else{
				?>
				<a href="../kategori/<?php echo $kategori ?>" style="width: 100%;padding-left: 27px;">
					<div class="column-10"><span style=""><?php echo $name ?></span><br>
					</div>
				</a>
				<?php
			}
			?>
		</div>
		<?php
		endwhile;
	}
	public function datakategori($kategori){ //produk di menu produk di menu
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT ( @NO_URUT := @NO_URUT + 1 ) NO_URUT, p.pro_name,p.pro_saleprice,p.pro_id,c.ctgr_name,c.ctgr_id,p.pro_image FROM produk p INNER JOIN category c ON c.ctgr_id=p.ctgr_id, (SELECT @NO_URUT := 0 ) VARIABLE_URUT where c.ctgr_name LIKE '$kategori' AND pro_status LIKE 'dijual' ORDER BY pro_id DESC LIMIT 0, 2 ";
		$cek =$mysqli->query($sql);
		$hasil = $cek->fetch_array();
		if($hasil[0] != NULL){
			$result = $mysqli->query($sql);
			while($r = $result->fetch_array()): 
				
				$id = $r['ctgr_id'];
			$idp =  $r['pro_id'];
			$nama =  $r['pro_name'];
			$image = $r['pro_image'];
			$harga = $r['pro_saleprice'];
			?>
			<li class="list-content">
				
				<a href="../p/<?php echo $idp.'-'.str_replace(' ', '-', strtolower($nama)) ?>">
					<img class="lazy" src="../assets/uploads/<?php echo $image ?>" >
					<div class="caption product-name">
						<?php echo  $nama ?> 
					</div>  
					<div class="caption product-seller">
						<div class="content">
							<span class="fa ">Rp</span>
							<?php
							$angka = $harga;
							$jumlah_desimal ="0";
							$pemisah_desimal =",";
							$pemisah_ribuan =".";
							echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
							?> 
						</div>
					</div>  
				</a>
			</li>
			<?php
			endwhile;
			?>
			<div class="facebook_style" id="facebook_style">
				<a id="2" name="<?php echo $id?>" href="#" class="load_kategori" >
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					Lihat Lainnya
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<img src="../assets/img/arrow1.png" />
				</a>
			</div>
			<?php
		}else{
			?>
			<div class="panel panel-default">
				<div class="panel-body">      
					<div class="row"> 
						<div class="column-12">
							<img src="../assets/img/gaadakategori.png">
						</div>
					</div>
				</div>
			</div>
			<?php
		}   
	}
	public function load_morekategori($idakhir,$idkategori){ //loadmore produk di menu
		$db = new database();
		$mysqli = $db->connect();
		$sql = "SELECT 
		( @NO_URUT := @NO_URUT + 1 ) NO_URUT,
		p.pro_name,p.pro_saleprice,p.pro_id,c.ctgr_name,c.ctgr_id,p.pro_image FROM produk p INNER JOIN category c ON c.ctgr_id=p.ctgr_id, (SELECT @NO_URUT := 0 ) VARIABLE_URUT where  c.ctgr_id LIKE '$idkategori' AND pro_status LIKE 'dijual' ORDER BY pro_id DESC LIMIT 2, 2 ";
		$result = $mysqli->query($sql);
		while($r = $result->fetch_array()):   

			$idp =  $r['pro_id']; 
		$nama =  $r['pro_name'];
		$image = $r['pro_image'];
		$harga = $r['pro_saleprice'];
		if($r = ""){
			?>
			<div class="panel panel-default">
				<div class="panel-body">      
					<div class="row"> 
						<div class="column-12">
							<img src="../assets/img/gaadaproduk.png">
						</div>
					</div>
				</div>
			</div>
			<?php
		}else{
			?>
			<li class="list-content">
				
				<a href="../p/<?php echo $idp.'-'.str_replace(' ', '-', strtolower($nama)) ?>">
					<img class="lazy" src="../assets/uploads/<?php echo $image ?>" >
					<div class="caption product-name">
						<?php echo  $nama ?> 
					</div>  
					<div class="caption product-seller">
						<div class="content">
							<span class="fa ">Rp</span>
							<?php
							$angka = $harga;
							$jumlah_desimal ="0";
							$pemisah_desimal =",";
							$pemisah_ribuan =".";
							echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
							?> 
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
		l.pro_name,l.pro_saleprice
		FROM Produk l INNER JOIN category c ON c.ctgr_id=l.ctgr_id,
		(SELECT @NO_URUT := 0 ) VARIABLE_URUT
		where  c.ctgr_id LIKE '$idkategori' AND pro_status LIKE 'dijual' ORDER BY pro_created DESC ";
		$result2 = $mysqli->query($sql2);
		while($r2 = $result2->fetch_array()):
			$no2 = $r2['NO_URUT'];
		endwhile;
		if($no2 > $idakhir){ //statement if else ini akan memutuskan apakah data masih bisa ditampilkan lagi atau tidak
			$noid = $idakhir+2;
			?>

			<div class="facebook_style" id="facebook_style">
				<a id="<?php echo $noid; ?>" name="<?php echo $idlapak."|".$filter?>" href="#" class="load_barang" >
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					Lihat Lainnya
					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<img src="../assets/img/arrow1.png" />
				</a>
			</div>
			<?php
		}else{
			?>
			<div id='facebook_style'>
				<a id='end' href='#' class='load_more' >Tidak Ada Lagi Produk</a>
			</div>
			<?php
		}
	}
	function lihatproduk($idp){
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT p.pro_name,p.pro_image,p.pro_saleprice,p.pro_description,c.ctgr_name
		FROM produk p JOIN category c ON p.ctgr_id=c.ctgr_id 
		where p.pro_id  LIKE '$idp'";
		$cek =$mysqli->query($sql);
		$hasil = $cek->fetch_array();
		?>
		<div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;width: 50%;position: relative;margin-right: auto;margin-left: auto;">
			<div class="register-form">
				<div class="register-header">
					<centeR>Lihat Produk</centeR>
					<hr>
				</div>
				<div>
					<table width="100%" cellspacing="0" cellpadding="4" border="0">
						<tbody>
							<tr>
								<td align="center"><img style="height: 115px; width: 115px" src="../assets/uploads/<?php echo $hasil['pro_image'];?>" alt="Thumbnail">
								</td>
							</tr>
						</tbody>
					</table>
					<div class="form-group">
						<label>Nama produk</label>
						<input class="form-control" placeholder="Masukan Nama Produk" value="<?php echo $hasil['pro_name'];?>" type="text" disabled>
					</div>
					<div class="form-group">
						<label>Kategori produk</label>
						<input class="form-control" placeholder="Masukan username" value="<?php echo $hasil['ctgr_name'];?>" type="text" disabled>
					</div>
					<div class="form-group">
						<label>Harga produk</label>
						<input class="form-control" placeholder="Masukan username" value="<?php echo $hasil['pro_saleprice'];?>" type="text" disabled>
					</div>
					<div class="form-group">
						<label>Deskripsi produk</label>
						<textarea  readonly class="form-control" style="max-width: 100%"><?php echo $hasil['pro_description'];?></textarea>

					</div>
					<a href="../helper/produk.php?aksi=terima&idp=<?php echo $_GET['idp']?>" id="tombol-login" class="button">Terima</a>
					<a href="../helper/produk.php?aksi=blokir&idp=<?php echo $_GET['idp']?>" id="tombol-login" style="background: #b12809;" class="button">Blokir</a>
				</div>
			</div>
		</div>
		<?php
	}
	function ubahstatus($aksi,$idp){
		$db = new database();
		$mysqli = $db->connect();
		if($aksi=="blokir"){
			$status = "diblokir";
			$sql2 ="UPDATE produk SET pro_status = '$status' WHERE pro_id = '$idp'";
			$result = $mysqli->query($sql2);
			if ($result) {
				header("Location: ../admin/produk.php");
				$_SESSION['alert'] = 'berhasildiupdate';
			}
		}elseif($aksi=="terima"){
			$status = "dijual";
			$sql2 ="UPDATE produk SET pro_status = '$status' WHERE pro_id = '$idp'";
			$result = $mysqli->query($sql2);
			if ($result) {
				header("Location: ../admin/produk.php");
				$_SESSION['alert'] = 'berhasildiupdate';
			}
		}elseif($aksi=="tidak"){
			$status = "tidak";
			$sql2 ="UPDATE produk SET pro_status = '$status' WHERE pro_id = '$idp'";
			$result = $mysqli->query($sql2);
			if ($result) {
				header("Location: ../admin/produk.php");
				$_SESSION['alert'] = 'berhasildiupdate';
			}
		}elseif($aksi=="dijual"){
			$status = "dijual";
			$sql2 ="UPDATE produk SET pro_status = '$status' WHERE pro_id = '$idp'";
			$result = $mysqli->query($sql2);
			if ($result) {
				header("Location: ../admin/produk.php");
				$_SESSION['alert'] = 'berhasildiupdate';
			}
		}elseif($aksi=="delete"){
			$sql2 ="DELETE FROM produk WHERE pro_id = '$idp'";
			$result = $mysqli->query($sql2);
			if ($result) {
				echo "<script>history.go(-1);</script>";
				$_SESSION['alert'] = 'berhasildiupdate';
			}
		}
	}
	function datareview(){
		$memid =$_SESSION['iduser'];
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT COUNT(pro_id) FROM `produk` WHERE `pro_status` LIKE 'review'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		echo $row[0];
	}
}
?>
