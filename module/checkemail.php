<?php
include '../config/database.php';
		$email=  $_GET['email'];
   $cek =  mysqli_query($con, "SELECT count(mem_email) FROM member WHERE mem_email LIKE '$email'");
   $row=mysqli_fetch_array($cek);
   if($row[0]>0){
		  echo 'false';
   }
   else{
		 echo 'true';
   }
?>