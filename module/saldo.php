<?php
date_default_timezone_set('Asia/Jakarta');	
// buat class member
class saldo {
	public function __construct() {
		require_once $_SERVER['DOCUMENT_ROOT'].'/roti/config/database.php';	
	}
	function data(){
		$memid =$_SESSION['iduser'];
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT (SELECT sum(sld_amount) FROM saldo WHERE mem_id LIKE '$memid' AND sld_status LIKE 'Debit') as debit, (SELECT sum(sld_amount) FROM saldo WHERE mem_id LIKE '$memid' AND sld_status LIKE 'Credit') as credit";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		$jadi = $row['debit']-$row['credit'];
		if($jadi > 0){
			$angka = $jadi;
			$jumlah_desimal ="0";
			$pemisah_desimal =",";
			$pemisah_ribuan =".";
			echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		}else{
			echo "0";
		}
	}
	function datapending(){
		$memid =$_SESSION['iduser'];
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT sum(wdr_amount) as withdrawal FROM withdrawal WHERE mem_id LIKE '$memid' AND wdr_status LIKE 'Pending'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();

		if($row[0] > 1){
			$angka = $row['withdrawal'];
			$jumlah_desimal ="0";
			$pemisah_desimal =",";
			$pemisah_ribuan =".";
			echo "".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		}else{
			echo "100";
		}
	}
	function datawithdrawal(){
		$memid =$_SESSION['iduser'];
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT sum(wdr_amount) as amount FROM withdrawal WHERE mem_id LIKE '$memid'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		if($row[0]){
			?>
			<p>Saldo Kamu : Rp.<?php echo $row['amount']?></p>
			<?php
		}else{
			?>
			<p>Saldo Kamu : Rp.0</p>
			<?php
		}
	}
	function checksaldo($jmlhsaldo){
		$memid =$_SESSION['iduser'];
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT (SELECT sum(sld_amount) FROM saldo WHERE mem_id LIKE '$memid' AND sld_status LIKE 'Debit') as debit, (SELECT sum(sld_amount) FROM saldo WHERE mem_id LIKE '$memid' AND sld_status LIKE 'Credit') as credit";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		$jadi = $row['debit']-$row['credit'];
		if($jmlhsaldo < 20000){
			echo '"Minimal 20000"';
		}else{

			if($jadi < $jmlhsaldo){
				echo '"Gagal, Saldo kamu hanya '.$jadi.'"';

			}else{
				echo 'true';
				$mysqli->close();
			}
		}
		
	}
	function savewithdrawal($optbank,$atsnama,$jmlhsaldo,$norek){
		$db = new database();
		$memid =$_SESSION['iduser'];
		$mysqli = $db->connect();
		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
		$sql="INSERT INTO withdrawal (mem_id, wdr_amount, wdr_bank, wdr_accountname, wdr_accountnumber, wdr_status, wdr_created) VALUES ('$memid', '$jmlhsaldo', '$optbank', '$atsnama', '$norek', 'Pending', '$now')";
		$saldo = $mysqli->query("INSERT INTO saldo (sld_id, mem_id, sld_desc, sld_amount, sld_status, sld_created) VALUES (NULL, '$memid', 'Meminta Tarik Tunai Ke $optbank ', '$jmlhsaldo', 'Credit', '$now')");
		$result =$mysqli->query($sql);
		if ($result){
			$_SESSION['alert'] = 'withdrawalsukses';
			header("Location: ../member/index.php");
		}else{
			$_SESSION['alert'] = 'withdrawalgagal';
			header("Location:../member/index.php");
		}

	}
	function pending(){
		$memid =$_SESSION['iduser'];
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT COUNT(wdr_id) FROM withdrawal WHERE wdr_status LIKE 'Pending'";
		$result = $mysqli->query($sql);
		$row= $result->fetch_array();
		echo $row[0];
	}
	function wddata($idw){
		$db = new database();		
		$mysqli = $db->connect();
		$sql = "SELECT w.wdr_id,m.mem_email,w.mem_id,w.wdr_accountname,w.wdr_bank,w.wdr_accountnumber,w.wdr_amount,w.wdr_status,w.wdr_created FROM withdrawal w INNER JOIN member m ON w.mem_id=m.mem_id where w.wdr_id LIKE '$idw'";
		$cek =$mysqli->query($sql);
		$hasil = $cek->fetch_array();

		?>
		<div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;width: 50%;position: relative;margin-right: auto;margin-left: auto;">
			<div class="register-form">
				<div class="register-header">
					<centeR>Data Tarik Tunai</centeR>
					<hr>
				</div>
				<div>
					
					<div class="form-group">
						<label>Bank</label>
						<input class="form-control" placeholder="Masukan Nama Produk" value="<?php echo $hasil['wdr_bank'];?>" type="text" disabled>
					</div>
					<div class="form-group">
						<label>No Rekening</label>
						<input class="form-control" placeholder="Masukan username" value="<?php echo $hasil['wdr_accountnumber'];?>" type="text" disabled>
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input class="form-control" placeholder="Masukan username" value="<?php echo $hasil['wdr_accountname'];?>" type="text" disabled>
					</div>
					<?php
					if($hasil['wdr_bank']=="014-BANK BCA"){
						?>
						<div class="form-group">
							<label>Total </label>
							<input class="form-control" placeholder="Masukan username" value="<?php echo $hasil['wdr_amount'];?>" type="text" disabled>
						</div>
						<?php
					}else{
						$jadi = $hasil['wdr_amount']-6500;
						?>
						<div class="form-group">
							<label>Total </label>
							<input class="form-control" placeholder="Masukan username" value="<?php echo $hasil['wdr_amount'];?>" type="text" disabled>
						</div>
						<div class="form-group">
							<label>Biaya Transfer Antar Bank </label>
							<input class="form-control" placeholder="Masukan username" value="6500" type="text" disabled>
						</div>
						<div class="form-group">
							<label>Total </label>
							<input class="form-control" placeholder="Masukan username" value="<?php echo $jadi;?>" type="text" disabled>
						</div>
						<?php
					}
					?>
					<a href="../helper/saldo.php?aksi=terima&idw=<?php echo $_GET['idw']?>" id="tombol-login" class="button">Terima</a>
					<a href="../helper/saldo.php?aksi=tolak&idw=<?php echo $_GET['idw']?>" id="tombol-login" style="background: #b12809;" class="button">Tolak</a>

				</div>
			</div>
		</div>
		<?php
	}
	function ubahstatus($aksi,$idw){
		$db = new database();
		$mysqli = $db->connect();
		if($aksi=="terima"){
			$status = "Selesai";
			$sql2 ="UPDATE withdrawal SET wdr_status = '$status' WHERE wdr_id = '$idw'";
			$result = $mysqli->query($sql2);

			$sql = "SELECT m.mem_phone,m.mem_firstname,w.wdr_accountnumber,w.wdr_bank,w.wdr_amount FROM withdrawal w INNER JOIN member m ON w.mem_id=m.mem_id where w.wdr_id LIKE '$idw'";
			$cek =$mysqli->query($sql);
			$hasil = $cek->fetch_array();
			$userkey = "1xwp4q";
			$passkey = "putri11";
			$telepon= $hasil['mem_phone'];
			$norek = $hasil['wdr_accountnumber'];
			$nama= $hasil['mem_firstname'];
			$bank= $hasil['wdr_bank'];
			if($bank != "014-BANK BCA"){
				$total = $hasil['wdr_amount']-6500;
			}else{
				$total = $hasil['wdr_amount'];
			}
			$message="[Warungmodern.com] $nama Selamat Saldo Kamu sudah di Kirim ke No REK $norek\nNourut: #$idw\nTotal Penarikan: Rp.$total\nTerimakasih";
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

			if ($result) {
				header("Location: ../admin/withdrawal.php");
				$_SESSION['alert'] = 'berhasildiupdate';
			}

		}else{
			$status = "tolak";
			$sql2 ="UPDATE withdrawal SET wdr_status = '$status' WHERE wdr_id = '$idw'";
			$sqlcek = "SELECT w.wdr_id,m.mem_email,w.mem_id,w.wdr_accountname,w.wdr_bank,w.wdr_accountnumber,w.wdr_amount,w.wdr_status,w.wdr_created FROM withdrawal w INNER JOIN member m ON w.mem_id=m.mem_id where w.wdr_id LIKE '$idw'";
			$cek =$mysqli->query($sqlcek);
			$hasil = $cek->fetch_array();
			$memid =$hasil['mem_id'];
			$jmlhsaldo = $hasil['wdr_amount'];
			$saldo = $mysqli->query("INSERT INTO saldo (sld_id, mem_id, sld_desc, sld_amount, sld_status, sld_created) VALUES (NULL, '$memid', 'Rufund Tarik tunai ditolak ', '$jmlhsaldo', 'Debit', '$now')");
			$result = $mysqli->query($sql2);
			if ($result) {
				header("Location: ../admin/withdrawal.php");
				$_SESSION['alert'] = 'berhasildiupdate';
			}
		}
	}
}
?>
