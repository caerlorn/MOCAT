<?php 
require_once 'isLogged.php';
?>
<!DOCTYPE html>
<html lang="tr-TR">
<head>
<meta charset=utf-8>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Personel Veritabanı</title>
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/dataTables.bootstrap.css">
<link rel="stylesheet" href="../css/dataTables.tableTools.min.css">
<link rel="stylesheet" href="../css/bootstrap-combobox.css">
<!--[if lt IE 8]>
        <link href="../css/bootstrap-ie7.css" rel="stylesheet">
		<link href="../css/Bootstrap3-PIE.css" rel="stylesheet">
<![endif]-->
</head>
<?php flush(); ?>

<body style="margin:15px;">	
<div class="responsive">
<div class="lead col-md-offset-5">Kültür Bakanlığı Veritabanı<h5><p class="navbar-text navbar-right" style="margin-top: -15px;">Oturumu kapat: <a href='logOut.php' class="navbar-link"><?php echo $birimKodu;?></a></p></h5></div>
	<br><br>
	<div class="row">
		<div class="col-md-5 pull-top col-md-offset-0">
		<br>

		<!-- Nav tabs -->
		<ul id="topNav" class="nav nav-tabs" role="tablist">
			<li><a href="#np" role="tab" data-toggle="tab" class="big"><span class="glyphicon glyphicon-user"></span> Yeni Personel</a></li>
			<?php
			if (isSuperAdmin()){
				echo
					'<li><a href="#nu" role="tab" data-toggle="tab" class="big"><span class="glyphicon glyphicon-list-alt"></span> Yeni Birim</a></li>
					 <li><a href="#nt" role="tab" data-toggle="tab" class="big"><span class="glyphicon glyphicon-tasks"></span> Yeni Unvan</a></li>
				     <li class="col-md-4"><select id="chooseUnit" name="chooseUnit" class="form-control input-md combobox">
							 <option placeholder="Personel Listele"></option>
							 <option value="007">Bütün Personel</option>';
							if( $msql = $con->prepare("SELECT `birimKodu`, `birim` FROM `birimler`;")){
								$msql->execute();
								$msql->bind_result($unitCode, $unitName);
								while ($msql->fetch()) {
									echo '<option value="'.$unitCode.'">'.$unitName.'</option>';
								}
								$msql->close();
							}
							else {
								echo 'Error: ' . $con->error;
								return false;
							}
			   echo '</select></li>';
			}
			?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in" id="np">
			<br>
			<?php
				require_once 'newPerson.php';
			?>
			</div>
			<div class="tab-pane fade in" id="nu">
			<br>
			<?php
			if (isSuperAdmin()){
				require_once 'newUnit.php';
			}
			?>
			</div>
			<div class="tab-pane fade in" id="nt">
			<br>
			<?php
			if (isSuperAdmin()){
				require_once 'newTitle.php';
			}
			?>
			</div>
		</div>
		<ul id="botNav" class="nav nav-tabs" role="tablist"></ul>
		</div>
	</div>
</div>
<br>
<br>
	
	<!--PERSON TABLE-->
	<table id="personList" class="table table-responsive table-bordered table-striped table-condensed">
		 <thead>
			<tr>
				<th></th>
				<th>TC Kimlik No</th>
				<th>Sicil No</th>
				<th>Ad</th>
				<th>Soyad</th>
				<th>e-posta</th>
				<th>Birim</th>
				<th>Telefon</th>
				<th>Dahili</th>
				<th>Faks</th>
				<th>Unvan</th>
				<th>Unvan(Diğer)</th>
				<th>Kayıt Tarihi</th>
		   </tr>
		 </thead>
		 <tbody>
<?php
global $birimKodu;
if(!isSuperAdmin()){
/*global $birimKodu;
$jarr = array();
if ($msql = $con->prepare("SELECT * FROM `kisiler` WHERE `birim` = ?")){
$msql->bind_param("i", $birimKodu);
$msql->execute();
$result = $msql->get_result();
while ($obj = $result->fetch_assoc()) {
		$jarr[] = $obj;
}
echo json_encode($jarr);
$msql->close();
}*/
	
	if( $msql = $con->prepare("SELECT `tcKimlik`, `sicilNo`, `isim`, `soyad`, `ePosta`, birimler.birim, `telefon`, `dahili`, `faks`, unvanlar.unvan, `unvan_Diger`, `olusturulmaTarihi` FROM `kisiler`
							LEFT JOIN `unvanlar` ON unvanlar.unvanKodu = kisiler.unvan
							LEFT JOIN `birimler` ON birimler.birimKodu = kisiler.birim	
							WHERE kisiler.birim = ?") ){
							
		$msql->bind_param("i", $birimKodu);
		$msql->execute();
		$msql->bind_result($tcKimlik, $sicilNo, $isim, $soyad, $ePosta, $birim, $telefon, $dahili, $faks, $unvan, $unvanDiger, $olusturulmaTarihi);
		
		while ($msql->fetch()) {
			echo '<tr class="text-center" id="personRow-' . $tcKimlik . '">
					<td><div class="text-center"><span class="text-center">
					<a href="#" id="personUpdate-' . $tcKimlik . '" class="personUpdate" data-toggle="modal" data-original-title="Girdiyi düzenle"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
					<a href="#" id="personDelete-' . $tcKimlik . '" class="personDelete" ><span class="glyphicon glyphicon-remove"></span></a></span></div>
					</td><td>' . $tcKimlik . '</td><td>' . $sicilNo . '</td><td>' . $isim . '</td><td>' . $soyad . '</td><td>' . $ePosta . '</td><td>' . $birim . '</td><td>' . $telefon . '</td><td>'
					. $dahili . '</td><td>' . $faks . '</td><td>' . $unvan . '</td><td>' . $unvanDiger . '</td><td>' . $olusturulmaTarihi . '</td>
				  </tr>';
		}

		$msql->close();}
	else {
		echo 'Error: ' . $con->error;
		return false;
	}
}
?>		
		 </tbody>
    </table>
	
	<!-- Modal HTML -->
    <div id="upModal" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
				   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></span>
	               <h4 class="modal-title">Kayıt Güncelleme</h4>
				</div>
                <div class="modal-body">
                    <form id="upPer" class="form-horizontal col-md-offset-2">
					<fieldset>
					
					<input id="orjTC" name="orjTC" type="hidden">
					
					<div id="secretDate" class="form-group">
					  <label class="col-md-4 control-label" for="lastChanged">Son güncellenme:</label>
					  <!--
					  <div class="col-md-5">
					  <input id="lastChanged" name="lastChanged" class="form-control input-md transparent-input" type="datetime" disabled>
					  </div>-->
					</div>
					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-3 control-label" for="upPerTcNo">TC Kimlik No:</label>  
					  <div class="col-md-5">
					  <input id="upPerTcNo" name="upPerTcNo" placeholder="TC kimlik numarası" class="form-control input-md" pattern="[0-9]{11}" required title="TC Kimlik No 11 haneli bir rakam olmak zorundadır" type="text">
						
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-3 control-label" for="upPerSicilNo">Sicil No:</label>  
					  <div class="col-md-5">
					  <input id="upPerSicilNo" name="upPerSicilNo" placeholder="sicil numarası" class="form-control input-md" pattern=".{10}" required title="10 karakter olmak zorundadır" type="text">
						
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-3 control-label" for="upPerName">İsim:</label>  
					  <div class="col-md-5">
					  <input id="upPerName" name="upPerName" placeholder="adı" class="form-control input-md" pattern=".{2,50}" required title="2 ile 50 karakter arasında olmak zorundadır" type="text">
						
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-3 control-label" for="upPerSname">Soyad:</label>  
					  <div class="col-md-5">
					  <input id="upPerSname" name="upPerSname" placeholder="soyadı" class="form-control input-md" pattern=".{2,50}" required title="2 ile 50 karakter arasında olmak zorundadır" type="text">
						
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-3 control-label" for="upPerMail">E-posta:</label>  
					  <div class="col-md-5">
					  <input id="upPerMail" name="upPerMail" placeholder="e-mail" class="form-control input-md" required="" type="text">
						
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-3 control-label" for="upPerUnit">Birim:</label>  
					  <div class="col-md-5">
					  <!--<input id="upPerUnit" name="upPerUnit" placeholder="birimi" class="form-control input-md" required="" type="text">-->
						<select id="upPerUnit" name="upPerUnit" class="form-control input-md combobox" placeholder="Bir birim seçin">
							<option></option>
						   <?php
								if( $msql = $con->prepare("SELECT `birimKodu`, `birim` FROM `birimler`;")){
									$msql->execute();
									$msql->bind_result($unitCode, $unitName);
									while ($msql->fetch()) {
										echo '<option value="'.$unitCode.'">'.$unitName.'</option>';
									}
								}
								else {
									echo 'Error: ' . $con->error;
									return false;
								}
						   ?>
						</select>
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-3 control-label" for="upPerTel">Telefon No:</label>  
					  <div class="col-md-5">
					  <input id="upPerTel" name="upPerTel" placeholder="telefon" class="form-control input-md" required="" type="text">
						
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-3 control-label" for="upPerDtel">Dahili Telefon:</label>  
					  <div class="col-md-5">
					  <input id="upPerDtel" name="upPerDtel" placeholder="dahili" class="form-control input-md" type="text">
						
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-3 control-label" for="upPerFax">Faks No:</label>  
					  <div class="col-md-5">
					  <input id="upPerFax" name="upPerFax" placeholder="faks" class="form-control input-md" required="" type="text">
						
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-3 control-label" for="upPerTitle">Unvan:</label>  
					  <div class="col-md-5">
					  <!--<input id="upPerTitle" name="upPerTitle" placeholder="unvanı" class="form-control input-md" required="" type="text">-->
					  <select id="upPerTitle" name="upPerTitle" class="form-control input-md combobox" placeholder="Bir unvan seçiniz">
						<option></option>
					   <?php
							if( $msql = $con->prepare("SELECT `unvanKodu`, `unvan` FROM `unvanlar`;")){
								$msql->execute();
								$msql->bind_result($titleID, $titleName);
								while ($msql->fetch()) {
									echo '<option value="'.$titleID.'">'.$titleName.'</option>';
								}
							}
							else {
								echo 'Error: ' . $con->error;
								return false;
							}
					   ?>
					   </select>
						
					  </div>
					</div>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-3 control-label" for="upPerOtitle">Unvan(Diğer):</label>  
					  <div class="col-md-5">
					  <input id="upPerOtitle" name="upPerOtitle" placeholder="listede yoksa" class="form-control input-md" type="text" pattern=".{2,50}">
						
					  </div>
					</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-3 control-label" for="upPerSubmit"></label>
					  <div class="col-md-5">
						<input id="perUpdate" class="btn btn-success btn-default" value="Güncelle" type="submit">
						<img src="../images/loading.gif" id="LoadingGif" style="display:none" />
						<button type="button" class="btn btn-danger btn-default" data-dismiss="modal">Vazgeç</button>
					  	</div>
					</div>
					</fieldset>
				</form>
                </div>
                
            </div>
        </div>
    </div>   
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/dataTables.bootstrap.js"></script>
<script src="../js/dataTables.tableTools.min.js"></script>
<script src="../js/bootstrap-combobox.js"></script>
<script src="../js/mainPage.js"></script>
<?php
	if( isSuperAdmin()){
		echo '<script src="../js/supAdminScripts.js"></script>';
	}
?>
</body>
</html>