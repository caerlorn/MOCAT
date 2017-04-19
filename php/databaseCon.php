<?php

$dbHost="localhost";
$dbUsername="root";
$dbPass="";
$dbName="staj";
global $con;

if(isset($con))
	return;

$con = mysqli_connect($dbHost, $dbUsername, $dbPass, $dbName) or die(sprintf("Veritabani baglantisi basarisiz: %s\n", mysqli_error()));
$con->set_charset("utf8");

?>