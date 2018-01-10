<?php
daftar_file("../assets/uploads/");
error_reporting(0);
function daftar_file($dir)
{
	if(is_dir($dir))
	{
		if($handle = opendir($dir))
		{
			while(($file = readdir($handle)) !== false)
			{	
				$pecah = explode("_", $file);
				if($pecah[1]){
					$a = $pecah[1];
				}else{
					$a = $file;
				}
				

				require_once $_SERVER['DOCUMENT_ROOT'].'/roti/config/database.php';	
				$db = new database();		
				$mysqli = $db->connect();
				$sql = "SELECT pro_image,count(pro_id) FROM produk where pro_image like '$a'";
				$result = $mysqli->query($sql);
				$r = $result->fetch_array();
				$gambar = $r['pro_image'];
				if($r[1]=="0"){
					unlink("../assets/uploads/$file");
				}
			}
			closedir($handle);
		}
	}
}
?>