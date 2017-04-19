<?php
require_once 'isLogged.php';

function tcValidation($data){
	$oddSum = $evenSum = $sum = $tenthDigit = $eleventhDigit = $i= null;
	      
	if (ctype_digit($data) && $data[0] != 0  && strlen($data) == 11) {
		for($i=0;$i<=9;$i+=2){ 
			$oddSum += substr($data, $i, 1);
		}
		for($a=1;$a<=8;$a+=2){
			$evenSum += substr($data, $a, 1);
		}
		for($i=0;$i<10;$i++){
			 $sum += substr($data, $i, 1);
		}
		$tenthDigit = (($oddSum * 7) - $evenSum) % 10;
		$eleventhDigit = $sum % 10;
		if($tenthDigit != substr($data, 9, 1) || $eleventhDigit != substr($data, 10, 1)){
			return false;
		}
		else { 
			return true;
		}
		
	} else {
			return false;
	 }
}

$tcKimlik = $sicilNo = $isim = $soyad = $ePosta = $birim = $telefon = $faks = $unvan = $olusturulmaTarihi = $dahili = $unvanDiger = '';
$personToUpdate = null;
$result = array();
$result['error'] = array();

if(!empty($_POST['orjTC']) && strlen($_POST['orjTC'])>0 && is_numeric($_POST['orjTC'])){
	$personToUpdate = filter_var($_POST['orjTC'],FILTER_SANITIZE_NUMBER_INT);
}

if (!empty($_POST["upPerTitle"]) && !empty($_POST["upPerOtitle"]))
	array_push($result['error'], 'Aynı anda iki unvan giremezsiniz');
	 
if (!empty($_POST["upPerTcNo"]) /*&& tcValidation($_POST["upPerTcNo"])*/)
    $tcKimlik = $_POST["upPerTcNo"];
else 
    array_push($result['error'], 'TC kimlik numarası boş veya geçerli değil');

if (!empty($_POST["upPerSicilNo"]))
    $sicilNo = $_POST["upPerSicilNo"];
else 
    array_push($result['error'], 'Lütfen sicil numarasını giriniz');

if (!empty($_POST["upPerName"]))
    $isim = $_POST["upPerName"];
else 
	array_push($result['error'], 'Lütfen isim giriniz');

if (!empty($_POST["upPerSname"]))
    $soyad = $_POST["upPerSname"];
else 
	array_push($result['error'], 'Lütfen soyad giriniz');

if (!empty($_POST["upPerMail"]) && filter_var($_POST["upPerMail"], FILTER_VALIDATE_EMAIL))
    $ePosta = $_POST["upPerMail"];
else 
    array_push($result['error'], 'e-posta alanı boş veya geçerli değil');

if (!empty($_POST["upPerUnit"]))
    $birim = $_POST["upPerUnit"];
else
	array_push($result['error'], 'Lütfen bir birim seçiniz');

if (!empty($_POST["upPerTel"]))
	$telefon = $_POST["upPerTel"];
else
	array_push($result['error'], 'Lütfen telefon numarasını giriniz');

$dahili = $_POST["upPerDtel"];

if (!empty($_POST["upPerFax"]))
	$faks = $_POST["upPerFax"];
else
	array_push($result['error'], 'Lütfen bir faks numarası giriniz');

if (!empty($_POST["upPerTitle"]))
	$unvan = $_POST["upPerTitle"];
else
	array_push($result['error'], 'Lütfen bir unvan seçiniz');

$unvanDiger = $_POST["upPerOtitle"];

if(isset($result['error']) && count($result['error']) > 0){
    $result['success'] = false;
} 

else {


	/*echo $msql = "UPDATE `kisiler` SET `tcKimlik` = '".$tcKimlik."', `sicilNo` = '".$sicilNo."', `isim` = '".$isim."', `soyad` = '".$soyad."', `ePosta` = '".$ePosta."', `birim` = '".$birim."', `telefon` = '".$telefon."', `dahili` = '".$dahili."', `faks` = '".$faks."', `unvan` = '".$unvan."', `unvan_Diger` = '".$unvanDiger."' WHERE `tcKimlik` = '".$personToUpdate."';";
	echo $personToUpdate;
	echo $tcKimlik;
	echo $sicilNo; 
	echo $isim; 
	echo $soyad; 
	echo $ePosta; 
	echo $birim; 
	echo $telefon;
	echo $dahili; 
	echo $faks;
	echo $unvan; 
	echo $unvanDiger; 
	echo $personToUpdate;*/
	$msql = $con->prepare("UPDATE `kisiler` SET `tcKimlik` = ?, `sicilNo` = ?, `isim` = ?, `soyad` = ?, `ePosta` = ? , `birim` = ?, `telefon` = ?, `dahili` = ?, `faks` = ?, `unvan` = ?, `unvan_Diger` = ? WHERE `tcKimlik` = ?;");
	$msql->bind_param("sssssssssssi", $tcKimlik, $sicilNo, $isim, $soyad, $ePosta, $birim, $telefon, $dahili, $faks, $unvan, $unvanDiger, $personToUpdate);
	$msql->execute();
	$msql = $con->prepare("SELECT `olusturulmaTarihi` FROM `kisiler` WHERE `tcKimlik` = ?;");
	$msql->bind_param("s",  $tcKimlik);
	$msql->execute();
	$msql->bind_result($olusturulmaTarihi);
	$msql->fetch();
	$msql->close();
	
	$result['success'] = true;
    $result['tc'] = $tcKimlik;
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
	$result['date'] = $olusturulmaTarihi;    
}

echo json_encode($result);

?>