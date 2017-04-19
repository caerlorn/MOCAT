<?php
require_once 'isLogged.php';

if( isSuperAdmin()){
	
$titleName = $titleNo = '';
$result = array();
$result['error'] = array();

if (!empty($_POST["newTitleName"]))
    $titleName = $_POST["newTitleName"];
else 
    array_push($result['error'], 'Unvan ismi boş olamaz');


if(isset($result['error']) && count($result['error']) > 0){
    $result['success'] = false;
} 

else {
		
	$msql = $con->prepare("INSERT INTO `unvanlar` ( `unvan` ) VALUES ( ? );");
	$msql->bind_param("s", $titleName);
	$msql->execute();
	$msql = $con->prepare("SELECT `unvanKodu` from `unvanlar` WHERE `unvan` = ?");
	$msql->bind_param("s", $titleName);
	$msql->execute();
	$msql->bind_result($titleNo);
	$msql->fetch();
    $msql->close();
	

    $result['success'] = true;
    $result['no'] = $titleNo;
    $result['name'] = $titleName;
}

echo json_encode($result);

}
else {
	echo "Yetkiniz yeterli değil";
	exit();
}
?>