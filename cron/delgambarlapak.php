<?php
daftar_file("../assets/uploads/lapak");
function daftar_file($dir)
{
	if(is_dir($dir))
	{
		if($handle = opendir($dir))
		{
			while(($file = readdir($handle)) !== false)
			{
				require_once $_SERVER['DOCUMENT_ROOT'].'/roti/config/database.php';	
				$db = new database();		
				$mysqli = $db->connect();
				$sql = "SELECT lpk_picture,count(lpk_id) FROM lapak where lpk_picture like '$file'";
				$result = $mysqli->query($sql);
				$r = $result->fetch_array();
				if($r[1]){
					echo	$file."|| Ada ||<br>";
				}else{
					unlink("assets/uploads/lapak/$file");
					echo	$file."|| Gaada ||<br>";
				}

				
			}
			closedir($handle);
		}
	}
}
 //cara menggunakan
?>