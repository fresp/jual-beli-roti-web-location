<?php
session_start();
error_reporting(0);

if($_SESSION['login'] !=""){
	require_once '../module/seller.php';
	$produk = new seller();
	$result = $produk->terdaftar();
	include 'template/head.php';
	
	?>
	<div style="vertical-align: center;margin-top: 100px;" class="container container-top">
		<div class="register-wrapper" style="margin-top: 30px;background: #fff;padding: 10px;">
			<div class="register-form">
				<div class="register-header">
					<h4><span style="font-weight: bold;">Langkah ke 1</span> | Isi Info Toko</h4>
					<hr>
				</div>
				<div>
					<form  action="../helper/lapak.php?aksi=joinseller" enctype="multipart/form-data" method="POST" id="frm-buka">
						<div class="form-group">
							<label >Username :</label>
							<input class="form-control required" id="user" name="user" placeholder="username" type="text"   >
						</div>
						<div class="form-group">
							<label >Nama Toko :</label>
							<input class="form-control required" id="namatoko" name="namatoko" placeholder="Nama Toko" type="text"   >
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

						<input type="submit" class="button" value="Next"><br>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Sidebar Kiri --> 
	<?php
	include 'template/footer2.php'; 
}else{
	header('Location:../login.php?Login terlebih dahulu');
}

?>

