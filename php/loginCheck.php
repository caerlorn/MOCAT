<?php 

function inCheck($data){

	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	require_once 'databaseCon.php';
	
	if(!empty($_POST["unitNum"]) && !empty($_POST["password"])) {
		
		$unitNum = inCheck(isset($_POST["unitNum"])) ? $_POST["unitNum"] : '';
		$password = inCheck(isset($_POST["password"])) ? $_POST["password"] : '';
	
		$msql = $con->prepare("SELECT `birimKodu` FROM `birimler` WHERE `birimKodu` = ? and `parola` = ?");
		$msql->bind_param("ss", $unitNum, $password);
		$msql->execute();
		$msql->bind_result($birimKodu);
		$msql->fetch();
		$msql->close();
	
		if(!empty($birimKodu)){
			
			session_start();
			//session_regenerate_id(true);
			$sessionKey = session_id();

			$msql = $con->prepare("INSERT INTO `oturumlar` ( `birimKodu`, `sessionKey`, `sessionAddress`, `sessionUseragent`, `sessionExpires`) VALUES ( ?, ?, ?, ?, DATE_ADD(NOW(),INTERVAL 1 HOUR) );");
            $msql->bind_param("isss", $birimKodu, $sessionKey, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'] );
            $msql->execute();
			$msql = $con->prepare("SELECT `yetki` FROM `birimler` WHERE `birimKodu` = ?;");
			$msql->bind_param("i", $birimKodu);
			$msql->execute();
			$msql->bind_result($yetki);
			$msql->fetch();
            $msql->close();
			$_SESSION["yetki"] = $yetki;
            header("Location: main.php");
		}
		else{ header("Location: login.php"); }
	}else{ header("Location: login.php"); }
}else{ header("Location: login.php"); }

?>

