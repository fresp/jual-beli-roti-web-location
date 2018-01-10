<?php
error_reporting(0);
if(is_array($_FILES)){
	if(is_uploaded_file($_FILES['userImage']['tmp_name'])){
		$sourcePath = $_FILES['userImage']['tmp_name'];
		$targetPath = "../assets/uploads/real".$_FILES['userImage']['name'];
		if(move_uploaded_file($sourcePath, $targetPath)){
			echo "Selamat Anda Sudah bisa berjualan";
		}else{
			echo "Foto Gagal diupload";
		}
	}
}
?>