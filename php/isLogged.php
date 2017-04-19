<?php

session_start();
$sessionKey = session_id();

require_once 'databaseCon.php';

function isSuperAdmin(){

	if (isset($_SESSION["yetki"]) && $_SESSION["yetki"] == 2){
		return true;
	}
	return false;
}

$msql = $con->prepare("SELECT `sessionID`, `birimKodu` FROM `oturumlar` WHERE `sessionKey` = ? AND `sessionAddress` = ? AND `sessionUseragent` = ? AND `sessionExpires` > NOW();");
$msql->bind_param("sss", $sessionKey, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
$msql->execute();
$msql->bind_result($sessionID, $birimKodu);
$msql->fetch();
$msql->close();

/*else {
	trigger_error('Wrong SQL: ' . $msql . ' Error: ' . $con->error, E_USER_ERROR); //development bitince sil
	header('HTTP/1.1 500 Mysql hatası!');
	exit();
}*/

if(empty($sessionID)) {
	header("Location: login.php");
	exit();
}

$msql = $con->prepare("UPDATE `oturumlar` SET `sessionExpires` = DATE_ADD(NOW(),INTERVAL 1 HOUR) WHERE `sessionID` = ?;");
$msql->bind_param("i", $sessionID );
$msql->execute();
$msql->close();

/*else {
	trigger_error('Wrong SQL: ' . $msql . ' Error: ' . $con->error, E_USER_ERROR); //development bitince sil
	header('HTTP/1.1 500 Mysql hatası!');
	exit();
}*/


?>