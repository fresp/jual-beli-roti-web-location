<?php
 $teks=$_POST["q"];
 $cari=str_replace(' ', '-', $teks);
 echo $cari;
 if(!$teks){
 	echo "error";
 }else{
 	header("Location: search/q-$cari");
 }
?>