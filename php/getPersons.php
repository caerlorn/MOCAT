<?php 
require_once 'isLogged.php';

//$tcKimlik = $sicilNo = $isim = $soyad = $ePosta = $birim = $telefon = $dahili = $faks = $unvan = $unvanDiger = $olusturulmaTarihi = '';
$getPersonsFrom = NULL;
$result = array();

if(isset($_POST["getPersonsFrom"]) && strlen($_POST["getPersonsFrom"])>0 && is_numeric($_POST["getPersonsFrom"])){
	$getPersonsFrom = filter_var($_POST["getPersonsFrom"],FILTER_SANITIZE_NUMBER_INT); 
}
if($getPersonsFrom == 007){
	if($msql = $con->prepare("SELECT `tcKimlik`, `sicilNo`, `isim`, `soyad`, `ePosta`, birimler.birim, `telefon`, `dahili`, `faks`, unvanlar.unvan, `unvan_Diger`, `olusturulmaTarihi` FROM `kisiler`
							LEFT JOIN `unvanlar` ON unvanlar.unvanKodu = kisiler.unvan
							LEFT JOIN `birimler` ON birimler.birimKodu = kisiler.birim")){
	$msql->execute();
	$row = $msql->get_result();
	while($data = $row->fetch_assoc() ){
		$result[] = $data;
	}
	$msql->close();
	
}
	else{
		echo 'Error: ' . $con->error;
		return false;
	}
}
else{
	if($msql = $con->prepare("SELECT `tcKimlik`, `sicilNo`, `isim`, `soyad`, `ePosta`, birimler.birim, `telefon`, `dahili`, `faks`, unvanlar.unvan, `unvan_Diger`, `olusturulmaTarihi` FROM `kisiler`
							LEFT JOIN `unvanlar` ON unvanlar.unvanKodu = kisiler.unvan
							LEFT JOIN `birimler` ON birimler.birimKodu = kisiler.birim
							WHERE kisiler.birim = ?")){
	$msql->bind_param("i", $getPersonsFrom);
	$msql->execute();
	$row = $msql->get_result();
	while($data = $row->fetch_assoc() ){
		$result[] = $data;
	}
	$msql->close();
	
}
	else{
		echo 'Error: ' . $con->error;
		return false;
	}
}
echo json_encode( $result );
?>