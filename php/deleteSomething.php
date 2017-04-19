<?php
require_once 'isLogged.php';

$tcToDelete = null;

if(isset($_POST["tcToDelete"]) && strlen($_POST["tcToDelete"])>0 && is_numeric($_POST["tcToDelete"])){
	
	$tcToDelete = filter_var($_POST["tcToDelete"],FILTER_SANITIZE_NUMBER_INT); 
	
if(isset($result['error']) && count($result['error']) > 0){
    $result['success'] = false;
} else {
	if($msql = $con->prepare("DELETE FROM `kisiler` WHERE tcKimlik = ( ? );")){
	   $msql->bind_param("i", $tcToDelete);
	   $msql->execute();
	   $msql->close();
	   
	   $result['success'] = true;
	}
	else {
	   header('HTTP/1.1 500 Şahıs silinemedi!');
	   exit();
	}
}
}