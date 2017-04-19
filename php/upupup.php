<?php
require_once 'isLogged.php';

$tcToDelete = $sicilNo = $isim = $soyad = $ePosta = $birim = $telefon = $dahili = $faks = $unvan = $unvanDiger = $sonGüncellenme = '';
$result = array();
$result['error'] = array();

if(isset($_POST["personToUpdate"]) && strlen($_POST["personToUpdate"])>0 && is_numeric($_POST["personToUpdate"])){
	$tcToDelete = filter_var($_POST["personToUpdate"],FILTER_SANITIZE_NUMBER_INT); 
}
		
	//$msql = $con->prepare("SELECT `sicilNo`, `isim`, `soyad`, `ePosta`, `birim`, `telefon`, `dahili`, `faks`, `unvan`, `unvan_Diger`, `sonGüncellenme` FROM `kisiler` WHERE `tcKimlik` = ?;");
	$msql = $con->prepare("SELECT `sicilNo`, `isim`, `soyad`, `ePosta`, birimler.birim, `telefon`, `dahili`, `faks`, unvanlar.unvan, `unvan_Diger`, `sonGüncellenme` FROM `kisiler`
							LEFT JOIN `unvanlar` ON unvanlar.unvanKodu = kisiler.unvan
							LEFT JOIN `birimler` ON birimler.birimKodu = kisiler.birim	
							WHERE kisiler.tcKimlik = ?;");
							
	$msql->bind_param("s", $tcToDelete);
	$msql->execute();
	$msql->bind_result($sicilNo, $isim, $soyad, $ePosta, $birim, $telefon, $dahili, $faks, $unvan, $unvanDiger, $sonGüncellenme);
	$msql->fetch();
	$msql->close();
	

    $result['success'] = true;
    $result['tc'] = $tcToDelete;
    $result['sicil'] = $sicilNo;
    $result['name'] = $isim;
	$result['sname'] = $soyad;
	$result['email'] = $ePosta;
    $result['unit'] = $birim;
    $result['tel'] = $telefon;
    $result['dahili'] = $dahili;
    $result['fax'] = $faks;
    $result['unvan'] = $unvan;
    $result['Ounvan'] = $unvanDiger;
	$result['date'] = $sonGüncellenme;


echo json_encode($result);
?>