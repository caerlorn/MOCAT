<?php

	echo '<!--UNIT TABLE-->
			<table id="unitList" class="table table-responsive table-bordered table-striped table-condensed">
			 <thead>
				<tr>
					<th></th>
					<th>Birim Kodu</th>
					<th>Birim Adı</th>
					<th>Bağlı Olduğu Birim</th>
					<th>Parola</th>
					<th>Adres</th>
					<th>Yetki</th>
			   </tr>
			 </thead>
			 <tbody>';
        
	if( $msql = $con->prepare("SELECT b.birimKodu, b.birim ustBirim, b2.birim altBirim, b.parola, b.adres, b.yetki FROM birimler AS b INNER JOIN birimler AS b2 ON b2.bagliOlduguBirimKodu = b.birimKodu") ){
		$msql->execute();
		$msql->bind_result($birimKodu, $birim, $bagliOlduguBirim, $parola, $adres, $yetki);
		
		while ($msql->fetch()) {
			echo '<tr class="text-center" id="unitRow-' . $birimKodu . '">
					<td><div class="text-center"><span class="text-center">
					<a href="#" id="unitUpdate-' . $birimKodu . '" class="unitUpdate" data-toggle="modal" data-original-title="Girdiyi düzenle"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
					<a href="#" id="unitDelete-' . $birimKodu . '" class="unitDelete" ><span class="glyphicon glyphicon-remove"></span></a></span></div>
					</td><td>' . $birimKodu . '</td><td>' . $birim . '</td><td>' . $bagliOlduguBirim . '</td><td>' . $parola . '</td><td>' . $adres . '</td><td>' . $yetki . '</td>
				  </tr>';
		}

		$msql->close();}
	else {
		echo 'Error: ' . $con->error;
		return false;
	}
	echo '</tbody></table>';

		 
	echo '<!--TITLE TABLE-->
		<table id="titleList" class="table table-responsive table-bordered table-striped table-condensed">
		 <thead>
			<tr>
				<th></th>
				<th>ID</th>
				<th>Unvan</th>
		   </tr>
		 </thead>
		 <tbody>';


	if( $msql = $con->prepare("SELECT `unvanKodu`, `unvan` FROM `unvanlar`") ){
		$msql->execute();
		$msql->bind_result($unvanID, $unvan);
		
		while ($msql->fetch()) {
			echo '<tr class="text-center" id="titleRow-' . $unvanID . '">
					<td><div class="text-center"><span class="text-center">
					<a href="#" id="titleUpdate-' . $unvanID . '" class="titleUpdate" data-toggle="modal" data-original-title="Girdiyi düzenle"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
					<a href="#" id="titleDelete-' . $unvanID . '" class="titleDelete" ><span class="glyphicon glyphicon-remove"></span></a></span></div>
					</td><td>' . $unvanID . '</td><td>' . $unvan . '</td>
				  </tr>';
		}

		$msql->close();}
	else {
		echo 'Error: ' . $con->error;
		return false;
	}
	echo '</tbody></table>';
?>		