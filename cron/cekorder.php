<?php
public function __construct() {
	require_once $_SERVER['DOCUMENT_ROOT'].'/roti/config/database.php';	
}
$db = new database();
$mysqli = $db->connect();
$now=date('Y-m-d H:i:s');
$db = new database();
?>