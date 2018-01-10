<?php
session_start();
$nerbie = $_POST['nerbie'];
$lat = $_POST['lat'];
$lon = $_POST['lon'];

$_SESSION['nerbie'] = $nerbie;
$_SESSION['lat'] = $lat;
$_SESSION['lon'] = $lon;
?>


