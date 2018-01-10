<?php
date_default_timezone_set('Asia/Jakarta');	
// buat class member
class admin {
	public function __construct() {
		require_once $_SERVER['DOCUMENT_ROOT'].'/roti/config/database.php';	
	}

	public function checklogin($username){
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT count(adm_username) FROM admin WHERE adm_username LIKE '$username'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		if($row[0]>0){
			$sql1 = "SELECT count(adm_username) FROM admin WHERE adm_username LIKE '$username' AND adm_status LIKE 'Y'";
			$result1 = $mysqli->query($sql1);
			$row1= $result1->fetch_array();
			if($row1[0]>0){
				echo 'true';
				$_SESSION['username'] = $username;
			}else{
				echo '"Akun dinonaktifkan, Silahkan Hubungi bagian administrator"';
			}
			$mysqli->close();
		}
		else{
			echo '"Username Tidak Terdaftar"';
			$mysqli->close();
		}
	}
	public function checkpassword($pass){
		$username = $_SESSION['username'];
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT count('adm_username') FROM admin WHERE adm_username LIKE '$username' AND adm_password LIKE md5('$pass')";
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
	public function login($username,$pass){
		$db = new database();		
		$mysqli = $db->connect();	
		$sql = "SELECT * FROM admin WHERE adm_username LIKE '$username' AND adm_password LIKE md5('$pass')";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		if($row[0]>0){
			session_start();
			$_SESSION['loginadmin'] = 'YES';
			$_SESSION['alert'] = 'login';
			$_SESSION['idadmin'] = $row['adm_id'];
			$_SESSION['namaadmin'] = $row['adm_fullname'];
			$mysqli->close();
			header('Location:../admin/index.php');
		}
		else{
			$mysqli->close();
			$_SESSION['alert'] = 'paslogin';
			header('Location:../admin/index.php');
		}	
	}
	function ubahstatus($aksi,$user){
		$db = new database();
		$mysqli = $db->connect();
		if($aksi=="aktifkan"){
			$status = "Y";
		}elseif($aksi=="nonaktifkan"){
			$status = "N";
		}
		$sql2 ="UPDATE admin SET adm_status = '$status' WHERE adm_username = '$user'";
		$result = $mysqli->query($sql2);
        	 // cek hasil query
		if ($result) {
		    /* 
		    jika data berhasil disimpan alihkan ke halaman selanjutnya
		    */
		    //header("Location:../member/produk.php?Menunggu Review");
		    header("Location: ../admin/admin.php");
		    $_SESSION['alert'] = 'berhasildiupdate';

		}
	}
	function ubah($username){
		$db = new database();
		$mysqli = $db->connect();
		$mysqli = $db->connect();	
		$sql = "SELECT * FROM admin WHERE adm_username LIKE '$username'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		if($row[0]>0){
			?>
			<div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;width: 50%;position: relative;margin-right: auto;margin-left: auto;">
				<div class="register-form">
					<div class="register-header">
						<centeR>Ubah Admin</centeR>
						<hr>
					</div>
					<div>
						<form action="../helper/admin.php?aksi=change" method="POST" id="frm-ubah">
							<input class="form-control" name="user"  id="user" placeholder="Masukan username" value="<?php echo $row['adm_username'];?>" type="hidden">
							<div class="form-group">
								<label>Nama Lengkap</label>
								<input class="form-control" name="username" id="username" placeholder="Masukan username" value="<?php echo $row['adm_fullname'];?>" type="text">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" name="pass" id="pass" placeholder="Password" type="password">
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
	function change($username,$pass,$user){
		$db = new database();
		$mysqli = $db->connect();
		if($username and $pass){
			$sql2 ="UPDATE admin SET adm_fullname = '$username',adm_password = md5('$pass') WHERE adm_username = '$user'";
			$result = $mysqli->query($sql2);
			if ($result) {
				header("Location: ../admin/admin.php");
				$_SESSION['alert'] = 'userpasssukses';
			}else{
				header("Location: ../admin/admin.php");
				$_SESSION['alert'] = 'Gagal';
			}
		}elseif($username and !$pass){
			$sql2 ="UPDATE admin SET adm_fullname = '$username' WHERE adm_username = '$user'";
			$result = $mysqli->query($sql2);
			if ($result) {
				header("Location: ../admin/admin.php");
				$_SESSION['alert'] = 'usersukses';
			}else{
				header("Location: ../admin/admin.php");
				$_SESSION['alert'] = 'Gagal';
			}
		}else{
			header("Location: ../admin/admin.php");
			$_SESSION['alert'] = 'Gagal';
		}
	}
	function add($username,$pass){
		$db = new database();
		$mysqli = $db->connect();
		$today =date('Y-m-d');
		$uname = strtolower(str_replace(' ', '', $username));
		$ufix = substr($uname, 0,5).date('ymd');
		$uu =$ufix;
		$sql = "INSERT INTO admin(adm_fullname,adm_username,adm_password,adm_status,adm_created)VALUES ('$username', '$ufix',md5('$pass'),'Y','$today')";
		$result = $mysqli->query($sql);
		if ($result) {
			header("Location: ../admin/admin.php");
			$_SESSION['alert'] = 'tambahadmin';
		}else{
			header("Location: ../admin/admin.php");
			$_SESSION['alert'] = 'Gagal';
		}
		
	}
}
?>
