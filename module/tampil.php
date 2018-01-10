<?php
session_start();
include '../config/database.php';

if(isset($_POST['idakhir']))
{
	$idakhir=$_POST['idakhir'];
	//tampilkan 5 status berikutnya
	$query = "SELECT * FROM data_location WHERE id > '$idakhir' ORDER BY id LIMIT 1";
	$sql = mysqli_query($con, $query);
	while($r = mysqli_fetch_array($sql)):
		$lat = $r['lat'];
	$long = $r['lon'];
	$lat2 = $_SESSION['lat'];
	$long2 = $_SESSION['lon'];      
	$latFrom = deg2rad($lat2);
	$lonFrom = deg2rad($long2);
	$latTo = deg2rad($lat);
	$lonTo = deg2rad($long);  
	$lonDelta = $lonTo - $lonFrom;
	$a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
	$b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
	$angle = atan2(sqrt($a), $b);
	$jarak = $angle * 6371000;
	$km = ceil($jarak / 1000);
	if($km <= 5){
		$query2 = mysqli_query($con, "SELECT * FROM data_location WHERE id > '$idakhir' ORDER BY id LIMIT 2") or die (mysqli_error());
		while($r2 = mysqli_fetch_array($query2)):
			$id = $r2['id'];
			$nama = $r2['desc'];
			?>
			<li class="list-content">
				
				<a href="#">
					<img class="lazy" src="assets/uploads/thumb/usb-cable.jpg" >
					<div class="caption product-name">
						<?php echo  $nama ?>
					</div>  

					<div class="caption product-seller">
						<div class="content">
							<span class="fa fa-map-marker"></span>
							<?php echo $km. " Meter"  ?>
						</div>
					</div>
	                <!--Rating
	                <div class="product-special-info">
	                  <div class="content">
	                    <ul class="rating">
	                      <li>
	                         <i class="material-icons">star_border</i>
	                      </li>
	                      <li>
	                         <i class="material-icons">star_border</i>
	                      </li>
	                      <li>
	                         <i class="material-icons">star_border</i>
	                      </li>
	                      <li>
	                         <i class="material-icons">star_border</i>
	                      </li>
	                      <li>
	                         <i class="material-icons">star_border</i>
	                      </li>
	                    </ul>
	                  </div>
	                </div>
	            -->
		        </a>
		    </li>

    <?php
    endwhile;
	    if(mysqli_num_rows($query2)==2){ //statement if else ini akan memutuskan apakah data masih bisa ditampilkan lagi atau tidak
			?>
			<div class="facebook_style" id="facebook_style">
				<a id="<?php echo $id; ?>" href="#" class="load_more" > &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					Lihat Lainnya
					 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="assets/img/arrow1.png" />
				</a>
			</div>

			<?php

		}else{
			echo "<div id='facebook_style'>
				<a id='end' href='#' class='load_more' >Tidak Ada Lagi Penjual</a>
			</div>";
		}
	
	}else{
		echo "<div id='facebook_style'>
		<a id='end' href='#' class='load_more' >Tidak Ada Lagi Penjual</a>
	</div>";
	}
	endwhile;
}
?>