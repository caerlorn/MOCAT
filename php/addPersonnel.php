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
		else { return true;	}
		
	} else { return false;	}
}

$tcKimlik = $sicilNo = $isim = $soyad = $ePosta = $birim = $telefon = $dahili = $faks = $unvan = $unvanDiger = $olusturulmaTarihi = '';
$result = array();
$result['error'] = array();

if (!empty($_POST["newPerTitle"]) && !empty($_POST["newPerOtitle"]))
	array_push($result['error'], 'Aynı anda iki unvan giremezsiniz');

if (!empty($_POST["newPerTcNo"]) /*&& tcValidation($_POST["newPerTcNo"])*/)
    $tcKimlik = $_POST["newPerTcNo"];
else 
    array_push($result['error'], 'TC kimlik numarası boş veya geçerli değil');

if (!empty($_POST["newPerSicilNo"]))
    $sicilNo = $_POST["newPerSicilNo"];
else 
    array_push($result['error'], 'Lütfen sicil numarasını giriniz');

if (!empty($_POST["newPerName"]))
    $isim = $_POST["newPerName"];
else 
	array_push($result['error'], 'Lütfen isim giriniz');

if (!empty($_POST["newPerSname"]))
    $soyad = $_POST["newPerSname"];
else 
	array_push($result['error'], 'Lütfen soyad giriniz');

if (!empty($_POST["newPerMail"]) && filter_var($_POST["newPerMail"], FILTER_VALIDATE_EMAIL))
    $ePosta = $_POST["newPerMail"];
else 
    array_push($result['error'], 'e-posta alanı boş veya geçerli değil');

if (!empty($_POST["newPerUnit"]))
    $birim = $_POST["newPerUnit"];
else
	array_push($result['error'], 'Lütfen bir birim seçiniz');

if (!empty($_POST["newPerTel"]))
	$telefon = $_POST["newPerTel"];
else
	array_push($result['error'], 'Lütfen telefon numarasını giriniz');

if ($_POST["newPerDtel"])
	$dahili = $_POST["newPerDtel"];

if (!empty($_POST["newPerFax"]))
	$faks = $_POST["newPerFax"];
else
	array_push($result['error'], 'Lütfen bir faks numarası giriniz');

if (!empty($_POST["newPerTitle"]))
	$unvan = $_POST["newPerTitle"];
else
	array_push($result['error'], 'Lütfen bir unvan seçiniz');

if ($_POST["newPerOtitle"])
	$unvanDiger = $_POST["newPerOtitle"];
	


if(isset($result['error']) && count($result['error']) > 0){
    $result['success'] = false;
} 

else {
		
	$msql = $con->prepare("INSERT INTO `kisiler` ( `tcKimlik`, `sicilNo`, `isim`, `soyad`, `ePosta`, `birim`, `telefon`, `dahili`, `faks`, `unvan`, `unvan_Diger`, `olusturulmaTarihi` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW() );");
	$msql->bind_param("sssssssssss", $tcKimlik, $sicilNo, $isim, $soyad, $ePosta, $birim, $telefon, $dahili, $faks, $unvan, $unvanDiger);
	$msql->execute();
	$msql = $con->prepare("SELECT birimler.birim, unvanlar.unvan, `olusturulmaTarihi` FROM `kisiler`
						   LEFT JOIN `unvanlar` ON unvanlar.unvanKodu = kisiler.unvan
						   LEFT JOIN `birimler` ON birimler.birimKodu = kisiler.birim	
						   WHERE kisiler.tcKimlik = ?");
	$msql->bind_param("i", $tcKimlik);
	$msql->execute();
	$msql->bind_result($birim, $unvan, $olusturulmaTarihi);
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