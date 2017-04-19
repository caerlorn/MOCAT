<form id="newUnit" class="form-horizontal col-md-offset-0">
	<fieldset>

	<!-- Form Name -->
	<!--<legend>Personel Formu</legend>-->

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newUnitNo">Birim Kodu(8 haneli haberleşme kodu):</label>  
	  <div class="col-md-4">
	  <input id="newUnitNo" name="newUnitNo" placeholder="birim numarası" class="form-control input-md" style = "margin-top: 10px" required type="text">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newUnitName">Birim Adı:</label>  
	  <div class="col-md-4">
	  <input id="newUnitName" name="newUnitName" placeholder="birim ismi" class="form-control input-md" required type="text">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newUnitRel">Bağlı olduğu birim:</label>  
	  <div class="col-md-4">
	  <!--<input id="newUnitRel" name="newUnitRel" placeholder="eğer var ise bağlı olduğu birim adı" class="form-control input-md" type="text">-->
		  <select id="newUnitRel" name="newUnitRel" class="form-control input-md combobox">
			   <option value="">bağlı olduğu birim var ise</option>
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
	  <label class="col-md-4 control-label" for="newUnitPass">Parola:</label>  
	  <div class="col-md-4">
	  <input id="newUnitPass" name="newUnitPass" placeholder="birim parolası" class="form-control input-md" required type="text">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newUnitAddr">Adres:</label>  
	  <div class="col-md-4">
	  <input id="newUnitAddr" name="newUnitAddr" placeholder="birimin adresi" class="form-control input-md" required type="text">
		
	  </div>
	</div>

	<!-- Text input-->
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newUnitLvl">Yetki:</label>  
	  <div class="col-md-4">
	  <input id="newUnitLvl" name="newUnitLvl" placeholder="birim yetki seviyesi" class="form-control input-md" required type="text">
		
	  </div>
	</div>

	<!-- Button -->
	
	<div class="form-group">
	  <label class="col-md-4 control-label" for="newUnitSubmit"></label>
	  <div class="col-md-4">
		<input id="newUnitSubmit" class="btn btn-success" value="Ekle" type="submit">
		<img src="../images/loading.gif" id="LoadingGif" style="display:none" />
		</div>
	</div>
	</fieldset>
</form>