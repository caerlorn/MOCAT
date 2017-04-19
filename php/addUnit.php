<?php
require_once 'isLogged.php';

if( isSuperAdmin()){
	
$unitNo = $unitName = $unitPass = $unitAddr = $unitLvl = '';
$unitRel = NULL;
$result = array();
$result['error'] = array();

if (!empty($_POST["newUnitNo"]))
    $unitNo = $_POST["newUnitNo"];
else 
    array_push($result['error'], 'Birim kodu boş olamaz');

if (!empty($_POST["newUnitName"]))
    $unitName = $_POST["newUnitName"];
else 
    array_push($result['error'], 'Lütfen birim ismi giriniz');

if ($_POST["newUnitRel"])
    $unitRel = $_POST["newUnitRel"];

if (!empty($_POST["newUnitPass"]))
    $unitPass = $_POST["newUnitPass"];
else 
	array_push($result['error'], 'Lütfen birim için bir parola giriniz');

if (!empty($_POST["newUnitAddr"]))
    $unitAddr = $_POST["newUnitAddr"];
else 
    array_push($result['error'], 'Birim adresini giriniz');

if (!empty($_POST["newUnitLvl"]))
    $unitLvl = $_POST["newUnitLvl"];
else
	array_push($result['error'], 'Birimin yetki seviyesini seçiniz');

if(isset($result['error']) && count($result['error']) > 0){
    $result['success'] = false;
} 

else {
		
	$msql = $con->prepare("INSERT INTO `birimler` ( `birimKodu`, `birim`, `bagliOlduguBirimKodu`, `parola`, `adres`, `yetki` ) VALUES ( ?, ?, ?, ?, ?, ? );");
	$msql->bind_param("ssssss", $unitNo, $unitName, $unitRel, $unitPass, $unitAddr, $unitLvl);
	$msql->execute();
	$msql->close();
	

    $result['success'] = true;
    $result['no'] = $unitNo;
    $result['name'] = $unitName;
    $result['rel'] = $unitRel;
	$result['pass'] = $unitPass;
	$result['addr'] = $unitAddr;
    $result['lvl'] = $unitLvl;
}

echo json_encode($result);

}
else {
	echo "Yetkiniz yeterli değil";
	exit();
}
?>