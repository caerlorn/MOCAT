<form id="newPer" class="form-horizontal col-md-offset-0">
	<fieldset>

	<!-- Form Name -->
	<!--<legend>Personel Formu</legend>-->

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newPerTcNo">TC Kimlik No:</label>  
	  <div class="col-md-4">
	  <input id="newPerTcNo" name="newPerTcNo" placeholder="TC kimlik numarası" class="form-control input-md" pattern="[0-9]{11}" required title="TC Kimlik No 11 haneli bir rakam olmak zorundadır" type="text">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newPerSicilNo">Sicil No:</label>  
	  <div class="col-md-4">
	  <input id="newPerSicilNo" name="newPerSicilNo" placeholder="sicil numarası" class="form-control input-md" pattern=".{10}" required title="10 karakter olmak zorundadır" type="text">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newPerName">İsim:</label>  
	  <div class="col-md-4">
	  <input id="newPerName" name="newPerName" placeholder="adı" class="form-control input-md" pattern=".{2,50}" required title="2 ile 50 karakter arasında olmak zorundadır" type="text">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newPerSname">Soyad:</label>  
	  <div class="col-md-4">
	  <input id="newPerSname" name="newPerSname" placeholder="soyadı" class="form-control input-md" pattern=".{2,50}" required title="2 ile 50 karakter arasında olmak zorundadır" type="text">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newPerMail">E-posta:</label>  
	  <div class="col-md-4">
	  <input id="newPerMail" name="newPerMail" placeholder="e-mail" class="form-control input-md" required="" type="text">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	<label class="col-md-4 control-label" for="newPerUnit">Birim:</label>  
	 <div class="col-md-4">
	  <!--<input id="newPerUnit" name="newPerUnit" placeholder="birimi" class="form-control input-md" required="" type="text">-->
	  <select id="newPerUnit" name="newPerUnit" class="form-control input-md combobox">
	   <option value="">Bir birim seçiniz</option>
	   <?php
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
	   ?>
	  </select>
	 </div>
	</div>
	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newPerTel">Telefon Numarası:</label>  
	  <div class="col-md-4">
	  <input id="newPerTel" name="newPerTel" placeholder="telefon" class="form-control input-md" required="" type="text">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newPerDtel">Dahili Telefon:</label>  
	  <div class="col-md-4">
	  <input id="newPerDtel" name="newPerDtel" placeholder="dahili" class="form-control input-md" type="text">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newPerFax">Faks Numarası:</label>  
	  <div class="col-md-4">
	  <input id="newPerFax" name="newPerFax" placeholder="faks" class="form-control input-md" required="" type="text">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newPerTitle">Unvan:</label>  
	  <div class="col-md-4">
	  <!--<input id="newPerTitle" name="newPerTitle" placeholder="unvanı" class="form-control input-md" required="" type="text">-->
	  <select id="newPerTitle" name="newPerTitle" class="form-control input-md combobox">
	   <option value="">Bir unvan seçiniz</option>
	   <?php
			if( $msql = $con->prepare("SELECT `unvanKodu`, `unvan` FROM `unvanlar`;")){
				$msql->execute();
				$msql->bind_result($titleID, $titleName);
				while ($msql->fetch()) {
					echo '<option value="'.$titleID.'">'.$titleName.'</option>';
				}
				$msql->close();
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
	  <label class="col-md-4 control-label" for="newPerOtitle">Unvan(Diğer):</label>  
	  <div class="col-md-4">
	  <input id="newPerOtitle" name="newPerOtitle" placeholder="unvanı listede yok ise" class="form-control input-md" type="text" pattern=".{2,50}">
		
	  </div>
	</div>

	<!-- Button -->
	
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newPerSubmit"></label>
	  <div class="col-md-4">
		<input id="newPerSubmit" class="btn btn-success" value="Ekle" type="submit">
		<img src="../images/loading.gif" id="LoadingGif" style="display:none" />
		</div>
	</div>
	</fieldset>
</form>