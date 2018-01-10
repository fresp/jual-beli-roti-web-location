<?php
session_start();
print_r($_SESSION);

?>
<?php 
require_once 'module/saldo.php';
$saldo = new saldo();
$pending = $saldo->pending(); 
echo $pending;
?>