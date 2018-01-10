<?php
date_default_timezone_set('Asia/Jakarta');	
// buat class member
class member {
	public function __construct() {
		require_once $_SERVER['DOCUMENT_ROOT'].'/roti/config/database.php';	
	}
	public function cekemail($email){
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT count(mem_email) FROM member WHERE mem_email LIKE '$email'";
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
	public function checkphone($phone){
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT count(mem_phone) FROM member WHERE mem_phone LIKE '$phone'";
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
	public function checklogin($email){
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT count(mem_email) FROM member WHERE mem_email LIKE '$email'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		if($row[0]>0){
			$sql1 = "SELECT count(mem_email) FROM member WHERE mem_email LIKE '$email' AND mem_status LIKE 'Y'";
			$result1 = $mysqli->query($sql1);
			$row1= $result1->fetch_array();
			if($row1[0]>0){
				echo 'true';
				$_SESSION['email'] = $email;
			}else{
				echo '"Akun dinonaktifkan, Silahkan Hubungi kami"';
			}
			
			$mysqli->close();
		}
		else{
			echo '"Email Tidak Terdaftar"';
			$mysqli->close();
		}
	}
	public function checkpassword($pass){
		$email = $_SESSION['email'];
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT count('mem_email') FROM member WHERE mem_email LIKE '$email' AND mem_password LIKE md5('$pass')";
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
	public function login($email,$pass){
		$db = new database();		
		$mysqli = $db->connect();	
		$sql = "SELECT * FROM member m WHERE mem_email LIKE '$email' AND mem_password LIKE md5('$pass')";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		if($row[0]>0){
			session_start();
			unset($_SESSION['email']);
			unset($_SESSION['login']);
			unset($_SESSION['iduser']);
			unset($_SESSION['nama']);
			date_default_timezone_set('Asia/Jakarta');
			$ceklapak = "SELECT lpk_id,lpk_username FROM member m INNER JOIN lapak l ON l.mem_id=m.mem_id WHERE mem_email LIKE '$email'";
			$rlapak = $mysqli->query($ceklapak);
			$rowlapak= $rlapak->fetch_array();

			$login=date('Y-m-d H:i:s');
			$nerbie = $_SESSION['nerbie'];
			$lat = $_SESSION['lat'];
			$_SESSION['lpk_id'] = $rowlapak['lpk_id'];
			$lon = $_SESSION['lon'];
			$_SESSION['email'] = $email;
			$_SESSION['login'] = 'YES';
			$_SESSION['alert'] = 'login';
			$_SESSION['iduser'] = $row['mem_id'];
			$_SESSION['lpkuser'] = $rowlapak['lpk_username'];
			$_SESSION['nama'] = $row['mem_firstname'] .' '.$row['mem_lastname'];
			if(!$nerbie){
				$sql2 = "UPDATE member SET mem_lastlogin = '$login' WHERE mem_email LIKE '$email'";
			}else{
				$sql2 = "UPDATE member SET mem_lat = '$lat', mem_long = '$lon', mem_nerbie = '$nerbie',mem_lastlogin = '$login' WHERE mem_email LIKE '$email'";
			}
			$result = $mysqli->query($sql2);
        	 // cek hasil query
			$_SESSION['nerbie'] = $row['mem_nerbie'];
			$_SESSION['lat'] = $row['mem_lat'] ;
			$_SESSION['lon'] = $row['mem_long'];
			$mysqli->close();
			header('Location:../index.php');
		}
		else{
			$mysqli->close();
			header('Location:../ndex.php?passsalah');
		}	
	}
	function registrasi($first,$last,$email,$phone,$pass){
		$db = new database();
		$mysqli = $db->connect(); 
		$tanggal = "$yy-$mm-$dd";
		$today =date('Y-m-d');
		$kode =  $this->kocok();
		$sql = "SELECT count(mem_email) FROM member WHERE mem_email LIKE '$email'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		if($row[0]>0){
	   		/* 
	        jika data sudah ada akan dialihkan ke halaman 
	        */
	        header('Location:daftar.php?email sudah ada silahkan login');
	    }else{
	    	$sql2 = "INSERT INTO member(mem_firstname,mem_lastname,mem_email,mem_phone,mem_password,mem_status,mem_verification,mem_created)VALUES ('$first', '$last', '$email','$phone',md5('$pass'),'N','$kode','$today')";
	    	$result = $mysqli->query($sql2);
        	 // cek hasil query
	    	if ($result) {
	        	 /* 
	        	 jika data berhasil disimpan alihkan ke halaman verifikasi
	        	 */
	        	 header('Location:../verifikasi.php?email='.$email);
	        	}else {
	        	/* 
	        	jika data berhasil disimpan alihkan ke halaman verifikasi
	        	*/
	        	header("Location: ../index.php?Proses Daftar Gagal");
	        }
	    }
	    $mysqli->close();
	}

	function request($email){
		$wakturequest  = new DateTime();
		date_add($wakturequest, date_interval_create_from_date_string('33 seconds'));
		$db = new database();
		$mysqli = $db->connect(); 
		$sql = "SELECT * FROM member WHERE mem_email = '$email'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();	
		$status = $row['mem_status'];
		if($status =='N'){
			$userkey = "1xwp4q";
			$passkey = "putri11";
			$kode = $row['mem_verification'];
			$telepon= $row['mem_phone'];
			$message="[warungmodern.com] Silahkan masukkan kode $kode pada kolom verifikasi untuk melengkapi registrasi anda. terima kasih.";
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
			$_SESSION['request'] = $wakturequest;
			$_SESSION['nohp'] = $nohp;
		}else if($status =='Y'){
			header('Location:member/index.php');
		}
		$mysqli->close();
	}

	function aktivasi($kodeotp,$email){
		$db = new database();
		$q = $kodeotp;
		$mysqli = $db->connect(); 
		$sql = "SELECT * FROM member WHERE mem_email LIKE '$email' AND mem_verification LIKE '$q' limit 1";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		if($row[0]>0){
			/* jika data sudah ada lakukan update mem_status*/
			$sql2 = "UPDATE member SET mem_status = 'Y', mem_verification = '' WHERE mem_email = '$email'";
			$result = $mysqli->query($sql2);
        	 // cek hasil query
			if ($result) {
	        	/* jika data berhasil disimpan alihkan ke halaman verifikasi
	        	*/
	        	unset($_SESSION['email']);
	        	header('Location:../index.php');
	        	$_SESSION['alert'] = "versuccess";
	        }else {
	        	/* jika data tidak berhasil disimpan alihkan ke halaman verifikasi
	        	*/
	        	unset($_SESSION['email']);
	        	$_SESSION['alert'] = "vergagal";
	        	header("Location:../index.php");
	        }
	    }else{
	    	/* jika data kode verifikasi tidak sesuai alihkan ke halaman kode salah*/
	    	header("Location:../index.php?kode salah");
	    }	
	}
	function logout(){
		unset($_SESSION['email']);
		session_destroy();
		session_start();
		$_SESSION['alert'] = "logout";
		header("Location:../index.php");
	}	


	function kocok()
	{
		$pengacak = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$hasil = "";
		for($i=0; $i<$panjang=8; $i++){
			$pos = rand(0,strlen($pengacak)-1);
			$hasil .= $pengacak[$pos];
		}
		return $hasil;
	}

	function tampilmember(){
		$db = new database();
		$mememail =$_SESSION['email'];
		$mysqli = $db->connect(); 
		$sqltmp = "SELECT mem_id,mem_email,mem_firstname,mem_lastname,mem_phone FROM member WHERE mem_email like '$mememail'";
		$resulttmp = $mysqli->query($sqltmp);
		$rowtmp= $resulttmp->fetch_array();
		$id = $rowtmp['mem_email'];
		if(!$id){
			echo "<script>alert('Page Not Found');</script>"; 
			echo "<script>history.go(-1);</script>";
		}
		?>
		<div style="margin-top: 90px;" class="container container-top" style="margin-top: 30px;background: #fff;padding: 10px;">
			<div id="tampilmember">
				<form action="../helper/member.php?aksi=saveinfo" enctype="multipart/form-data" method="POST" id="frm-editmem" style="overflow: hidden;height: auto;font-size: 12px;width: 100%;margin-right: auto;margin-left: auto;background: #fff;padding: 30px 20px 0px 20px;border-radius: 10px;box-shadow: 1px 1px 3px #AAA;margin-top: 10px;">

					<div style=" text-align: left; padding: 0px 5px;">
						<div class="column-12" style="margin-bottom: 10px;padding: 0px;">
							<div class="column-12">
								<label>Email :</label>
								<input class="kb-input " name="mememail" style="" value="<?php echo $rowtmp['mem_email']?>" disabled placeholder="Nama Produk" type="text">
							</div>
						</div>
						<div class="column-12" style="padding: 0px;">
							<div class="column-12">
								<div class="column-6 "  style="padding: 0px;">
									<label>Nama Depan :</label>
									<input class="kb-input required" name="memfirst" id="memfirst" style="" value="<?php echo $rowtmp['mem_firstname']?>" placeholder="Nama Depan" type="text" >
								</div>
								<div class="column-6 form-group" style="padding: 0px;">
									<label>Nama Belakang :</label>
									<input class="kb-input required" name="memlast"
									id="memlast" style="" value="<?php echo $rowtmp['mem_lastname']?>" placeholder="Nama Belakang" type="text">
								</div>
							</div>
						</div>
						<div class="column-12" style="margin-bottom: 10px;padding: 0px;">
							<div class="column-12">
								<div class="column-8 "  style="padding: 0px;">
									<label>Nomer Lama :</label>
									<input class="kb-input required"  name="oldphone" id="oldphone"  value="<?php echo $rowtmp['mem_phone']?>" disabled placeholder="username Lapak" type="text" >
								</div>
								<div class="column-4 "  style="padding: 0px;margin-top: 22px;">
									<a  href="#verifikasi" id="modaltrigger" class="kb-button  button-float kb-button2" style="width: 28%;padding: 7px;border-radius: 0px;" type="submit">
										Ubah Nomer
									</a>
								</div>
							</div>
						</div>		
						<div class="column-12" style="margin-bottom: 10px;padding: 0px;" id="lapaklokasi">
							<div class="column-12" style="margin-bottom: 10px;">
								<input name="submit" class="kb-button  button-float kb-button2" style="width: 100%;cursor: pointer;" value="Simpan" type="submit">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div id="verifikasi" class="modal" style="display:none;">
			<div class="row-fluid">
				<div class="span12"> 
					<div class="row-fluid">
						<label class="control-label" for="inputAddress" style="text-align: center;">Ganti Nomer</label>
						<hr>
						<div class="column-12 "  style="padding: 0px;">
							<label style="font-weight: unset;">Nomer Lama :</label>
							<input class="kb-input required" name="memfirst" id="memfirst" style="" disabled value="<?php echo $rowtmp['mem_phone']?>" placeholder="Nomer Lama" type="text" >
						</div>
						<form  id="frm-requestotp" method="post" class="frm-requestotp">  

							<div class="column-12 " style="padding: 0px;">
								<label style="font-weight: unset;">Nomer Baru:</label>
								<input class="kb-input required" name="phone"
								id="phone" value="" placeholder="Nomer Baru" type="text">
								<button  class="kb-button requestotp button-float kb-button2" style="padding: 7px;cursor: pointer;width: 97%;margin: 10px 0px;" type="submit">
									Minta Kode
								</button> 
							</div>
						</form>
						<div id="otpsucces"></div>
						<form action="../helper/member.php?aksi=simpanno" method="POST" id="frm-updateno">
							<div class="column-12"  style="padding: 0px;">
								<label style="font-weight: unset;">Kode Verifikasi :</label>
								<input class="kb-input required" name="kodeotp" id="kodeotp" style="" value="<?php echo $kode?>" placeholder="Kode Verifikasi" type="text" >
							</div>
							<div class="column-12 form-group"  style="padding: 0px;">
								<label style="font-weight: unset;">Password :</label>
								<input class="kb-input required" name="pass" id="pass" style="" value="" placeholder="password" type="password" >
							</div>
							<button  class="kb-button simpanno button-float kb-button2" style="padding: 7px;cursor: pointer;width: 97%;background: #4b4545;margin: 10px 0px;" type="submit">
								Simpan
							</button> 
						</form>
					</div>


					
					<script type="text/javascript">
						$(function(){
							$('#loginform').submit(function(e){
								return false;
							});

							$('#modaltrigger').leanModal({ top: 90, overlay: 0.45, closeButton: ".hidemodal" });
						});
					</script>
				</div>
			</div>
			<script>
				$('.inputAddress').addressPickerByGiro({
					distanceWidget: true,
					boundElements: {
						'region': '.region',
						'county': '.county',
						'street': '.street',
						'street_number': '.street_number',
						'latitude': '.latitude',
						'longitude': '.longitude',

					}
				});
			</script>
		</div>
		<script type="text/javascript">
			$(function(){
				$('#loginform').submit(function(e){
					return false;
				});

				$('#modaltrigger').leanModal({
					top: 110,
					overlay: 0.45,
					closeButton: ".hidemodal" 
				});
			});
		</script>

		<?php
	}
	public function checkotp($kodeotp){
		$email = $_SESSION['email'];
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT count('mem_verification') FROM member WHERE mem_verification LIKE '$kodeotp' AND mem_email like '$email'";
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
	function requestotp($nomer){
		$db = new database();
		$mysqli = $db->connect();
		$memid =$_SESSION['iduser'];
		$kode =  $this->kocok();
		date_default_timezone_set('Asia/Jakarta');
		$date = new DateTime();
		$date->modify('+1 Hours');
		$expired = $date->format('Y-m-d H:i:s');
		$sql = "UPDATE member SET mem_verification ='$kode',mem_tmpphone ='$nomer',mem_expotp ='$expired' where mem_id = '$memid'";
		$result = $mysqli->query($sql);
		if ($result) {
			$userkey = "1xwp4q";
			$passkey = "putri11";
			$message="[warungmodern.com] Silahkan masukkan kode $kode pada kolom verifikasi untuk menyelesaikan proses ganti nomer telepon";
			$url = "https://reguler.zenziva.net/apps/smsapi.php";
			$curlHandle = curl_init();
			curl_setopt($curlHandle, CURLOPT_URL, $url);
			curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$nomer.'&pesan='.urlencode($message));
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
			curl_setopt($curlHandle, CURLOPT_POST, 1);
			$results = curl_exec($curlHandle);
			curl_close($curlHandle);

		}else{
			echo "Gagal";
		}

	}
	function simpanno(){
		$db = new database();
		$mysqli = $db->connect();
		$memid =$_SESSION['iduser'];
		$cek = "SELECT count(mem_tmpphone),mem_tmpphone FROM member WHERE mem_id ='$memid'";
		$rcek = $mysqli->query($cek);
		$row= $rcek->fetch_array();
		$newphone = $row['mem_tmpphone'];
		$sql = "UPDATE member SET mem_phone='$newphone', mem_verification ='',mem_tmpphone ='' where mem_id = '$memid'";
		$result = $mysqli->query($sql);
		if ($result) {
			echo "<script>alert('Nomer Telepon Berhasil diganti');</script>"; 
			echo "<script>history.go(-1);</script>";
		}else{
			echo "Gagal";
		}

	}
	function saveinfo($memfirst,$memlast){
		$memid =$_SESSION['iduser'];
		$db = new database();
		$mysqli = $db->connect(); 
		$sql2 ="UPDATE member SET mem_firstname = '$memfirst', mem_lastname = '$memlast' WHERE mem_id = '$memid'";
		$result = $mysqli->query($sql2);
        	 // cek hasil query
		if ($result) {
			$_SESSION['nama'] = $memfirst .' '.$memlast;
			$_SESSION['alert'] = "saveinfo";
			header('Location:../member/index.php');
		}
		$mysqli->close();
	}
	function savepassword($passnew){
		$memid =$_SESSION['iduser'];
		$db = new database();
		$mysqli = $db->connect(); 
		$sql2 ="UPDATE member SET mem_password = md5('$passnew') WHERE mem_id = '$memid'";
		$result = $mysqli->query($sql2);
        	 // cek hasil query
		if ($result) {
			$_SESSION['alert'] = "savepassword";
			if($_SESSION['alert']){
				header('Location:../index.php');
			}
			unset($_SESSION['lpk_id']);
			unset($_SESSION['login']);
			unset($_SESSION['iduser']);
			unset($_SESSION['nama']);
			unset($_SESSION['email']);
			unset($_SESSION['lpkuser']);
			unset($_SESSION['nerbie']);
			unset($_SESSION['lat']);
			unset($_SESSION['lon']);

			
			

		}

		$mysqli->close();
	}
	function hp($nohp) {
	    // kadang ada penulisan no hp 0811 239 345
		$nohp = str_replace(" ","",$nohp);
	    // kadang ada penulisan no hp (0274) 778787
		$nohp = str_replace("(","",$nohp);
	    // kadang ada penulisan no hp (0274) 778787
		$nohp = str_replace(")","",$nohp);
	    // kadang ada penulisan no hp 0811.239.345
		$nohp = str_replace(".","",$nohp);

	    // cek apakah no hp mengandung karakter + dan 0-9
		if(!preg_match('/[^+0-9]/',trim($nohp))){
	        // cek apakah no hp karakter 1-3 adalah +62
			if(substr(trim($nohp), 0, 3)=='+62'){
				$hp = '0'.substr(trim($nohp), 3);
			}elseif(substr(trim($nohp), 0, 2)=='62'){
				$hp = '0'.substr(trim($nohp), 2);
			}
	        // cek apakah no hp karakter 1 adalah 0
			elseif(substr(trim($nohp), 0, 1)=='0'){
				$hp = $nohp;
			}
		}
		printf($hp);
	}
	//hp($nohp);
	function cekreset($email){
		$db = new database();		
		$mysqli = $db->connect();
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$sql = "SELECT count(mem_email) FROM member WHERE mem_email LIKE '$email'";
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
		}else {
			$email = str_replace(" ","",$email);
		    // kadang ada penulisan no result (0274) 778787
			$email = str_replace("(","",$email);
		    // kadang ada penulisan no result (0274) 778787
			$email = str_replace(")","",$email);
		    // kadang ada penulisan no result 0811.239.345
			$email = str_replace(".","",$email);
			// cek apakah no result mengandung karakter + dan 0-9
			if(!preg_match('/[^+0-9]/',trim($email))){
		        // cek apakah no result karakter 1-3 adalah +62
				if(substr(trim($email), 0, 3)=='+62'){
					$result = '0'.substr(trim($email), 3);
				}elseif(substr(trim($email), 0, 2)=='62'){
					$result = '0'.substr(trim($email), 2);
				}
		        // cek apakah no result karakter 1 adalah 0
				elseif(substr(trim($email), 0, 1)=='0'){
					$result = $email;
				}
				$string=strlen($result);
				if($string <=10){
					echo '"Format Hp kurang dari 11"';
				}elseif($string >=13){
					echo '"Format Hp Lebih dari 13"';
				}else{
					$sql = "SELECT count(mem_email) FROM member WHERE mem_phone LIKE '$email'";
					$result = $mysqli->query($sql);
					$row= $result->fetch_array();
					if($row[0]>0){
						echo 'true';
						$mysqli->close();
					}
					else{
						echo '"No Hp Tidak Terdaftar"';
						$mysqli->close();
					}
				}
			}else{
				echo '"Format Salah"';
			}
			
		}
	}
	function resetpassword($email){
		$db = new database();
		$mysqli = $db->connect();
		$kode =  $this->kocok();
		date_default_timezone_set('Asia/Jakarta');
		$date = new DateTime();
		$expired = $date->format('Y-m-d H:i:s');
		$getmail = "SELECT mem_email,mem_phone,mem_verification,mem_expotp, mem_email FROM member WHERE mem_email LIKE '$email' OR mem_phone LIKE '$email'";
		$rgetmail = $mysqli->query($getmail);
		$rowget= $rgetmail->fetch_array();
		$iniemail = $rowget['mem_email'];
		$cekemail = "SELECT count(mem_email) as email FROM member WHERE mem_expotp >= '$expired' AND mem_email LIKE '$iniemail'";
		$resultmail = $mysqli->query($cekemail);
		$rowmail= $resultmail->fetch_array();
		$nama = $rowget['mem_email'];
		if($rowmail['email']>0){
			$dee = $rowget[2];
			$nomer = $rowget[1];
			$userkey = "1xwp4q";
			$passkey = "putri11";
			$message="[warungmodern.com] Hy $nama, <br>Berikut adalah password baru kamu : <br>$dee<br> Segera ubah password kamu ";
			$url = "https://reguler.zenziva.net/apps/smsapi.php";
			$curlHandle = curl_init();
			curl_setopt($curlHandle, CURLOPT_URL, $url);
			curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$nomer.'&pesan='.urlencode($message));
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
			curl_setopt($curlHandle, CURLOPT_POST, 1);
			$results = curl_exec($curlHandle);
			curl_close($curlHandle);
			$XMLdata = new SimpleXMLElement($results);
			$status = $XMLdata->message[0]->text;
			$_SESSION['alert'] = 'resetpassword';
			header('Location:../index.php');
		}
		else{
			$date->modify('+1 Hours');
			$otpexprd = $date->format('Y-m-d H:i:s');
			$sql = "UPDATE member SET mem_verification ='$kode', mem_password=md5('$kode'), mem_expotp= '$otpexprd' where mem_email = '$email'";
			$result = $mysqli->query($sql);
			if ($result) {
				$nomer = $rowget[1];
				$userkey = "1xwp4q";
				$passkey = "putri11";
				$message="[warungmodern.com] Hy $nama, <br>Berikut adalah password baru kamu : <br>$kode<br> Segera ubah password kamu ";
				$url = "https://reguler.zenziva.net/apps/smsapi.php";
				$curlHandle = curl_init();
				curl_setopt($curlHandle, CURLOPT_URL, $url);
				curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$nomer.'&pesan='.urlencode($message));
				curl_setopt($curlHandle, CURLOPT_HEADER, 0);
				curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
				curl_setopt($curlHandle, CURLOPT_POST, 1);
				$results = curl_exec($curlHandle);
				curl_close($curlHandle);
				$XMLdata = new SimpleXMLElement($results);
				$status = $XMLdata->message[0]->text;
				echo $status;
				$_SESSION['alert'] = 'resetpassword';
				header('Location:../index.php');
			}else{
				$_SESSION['alert'] = 'resetfailed';
				header('Location:../index.php');
				echo "Gagal";
			}
		}
		echo "<pre>";
		print_r($rowmail);
		echo "</pre>";
		print_r($rowget);
	}
	function ubahstatus($aksi,$email){
		$db = new database();
		$mysqli = $db->connect();
		if($aksi=="aktifkan"){
			$status = "Y";
		}elseif($aksi=="nonaktifkan"){
			$status = "N";
		}
		$sql2 ="UPDATE member SET mem_status = '$status' WHERE mem_email = '$email'";
		$result = $mysqli->query($sql2);
        	 // cek hasil query
		if ($result) {
		    /* 
		    jika data berhasil disimpan alihkan ke halaman selanjutnya
		    */
		    //header("Location:../member/produk.php?Menunggu Review");
		    header("Location: ../admin/member.php");
		    $_SESSION['alert'] = 'berhasildiupdate';

		}
	}
	function ubah($username){
		$db = new database();
		$mysqli = $db->connect();
		$mysqli = $db->connect();	
		$sql = "SELECT * FROM member WHERE mem_email LIKE '$username'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		$kode =  $this->kocok();
		if($row[0]>0){
			?>
			<div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;width: 50%;position: relative;margin-right: auto;margin-left: auto;">
				<div class="register-form">
					<div class="register-header">
						Ganti Password Member
						<hr>
					</div>
					<div>
						<form action="../helper/member.php?aksi=change" method="POST" id="frm-login">
							<div class="form-group">
								<input class="form-control" name="username" id="username" value="<?php echo $_GET['email']?>" readonly='true' type="text">
							</div>
							<div class="form-group">
								<input class="form-control" name="pass" id="pass" placeholder="Password" readonly='true' value="<?php echo $kode?>" type="text">
							</div>
							<input type="submit" id="tombol-login" class="button" value="Ubah">
						</form>
					</div>
				</div>
			</div>
			<?php
		}
		else{
			$mysqli->close();
			$_SESSION['alert'] = 'paslogin';
			header('Location:../admin/index.php');
		}	
	}
	function change($username,$pass){
		$db = new database();
		$mysqli = $db->connect();

		$sql2 ="UPDATE member SET mem_password = md5('$pass') WHERE mem_email = '$username'";
		$result = $mysqli->query($sql2);
		if ($result) {
			header("Location: ../admin/member.php");
			$_SESSION['alert'] = 'passwordsukses';
		
		}else{
			header("Location: ../admin/member.php");
			$_SESSION['alert'] = 'Gagal';
		}

	}
}
?>
