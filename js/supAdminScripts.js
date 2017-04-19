/*var daTable2 = $('#unitList').DataTable({
		   language: {
				url: '../translation/yerlimaliyurdummaliherkesonukullanmali.json'
			},
			sDom: '<lfT<t>ip>',
			"tableTools": {
				"sSwfPath": "../swf/copy_csv_xls_pdf.swf",
			},
			deferRender: true
			
	});
	
var daTable3 = $('#titleList').DataTable({
		   language: {
				url: '../translation/yerlimaliyurdummaliherkesonukullanmali.json'
			},
			sDom: '<lfT<t>ip>',
			"tableTools": {
				"sSwfPath": "../swf/copy_csv_xls_pdf.swf",
			},
			deferRender: true
	});*/
	
/*var daTable = $('#personList').DataTable({
				   language: {
						url: '../translation/translation.json'
					},
					sDom: '<lfT<t>ip>',
					"tableTools": {
						"sSwfPath": "../swf/copy_csv_xls_pdf.swf",
					},
			});*/
	
$('#chooseUnit').change(function() {
	/*var val = $("#chooseUnit option:selected").val();
    alert(val);*/
	var myData = 'getPersonsFrom=' +$("#chooseUnit option:selected").val();
	daTable.clear().draw();
	$.ajax({
		type: "POST",
		url: "getPersons.php",
		data: myData,
		dataType: "json",
		scriptCharset : "utf-8"
		}).success(function(jsonData) {	
			for ( var i=0, iend=jsonData.length ; i<iend ; i++ ) {
							jsonData[i].actions = '<div class="text-center"><span class="text-center"><a href="#" id="personUpdate-' + jsonData[i].tcKimlik + '" class="personUpdate" data-toggle="modal" data-original-title="Girdiyi düzenle"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;<a href="#" id="personDelete-' + jsonData[i].tcKimlik + '" class="personDelete" ><span class="glyphicon glyphicon-remove"></span></a></span></div>';
							//console.log(jsonData[i]);
						    var rowNode = daTable.row.add( [
															jsonData[i].actions, 
															jsonData[i].tcKimlik,
															jsonData[i].sicilNo,
															jsonData[i].isim,
															jsonData[i].soyad,
															jsonData[i].ePosta,
															jsonData[i].birim,
															jsonData[i].telefon,
															jsonData[i].dahili,
															jsonData[i].faks,
															jsonData[i].unvan,
															jsonData[i].unvan_Diger,
															jsonData[i].olusturulmaTarihi
							] )
							.draw()
							.node();
							$( rowNode ).addClass('text-center');
							$( rowNode ).attr( "id", 'personRow-' + jsonData[i].tcKimlik);
			 }
			
			/*$.each(dataObj, function(key,value){
				console.log(value);
			});
		
			/*daTable.clear().rows.add(jsonData).draw();
			console.log(dataObj);*/
		
		}).error(function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
					$(this).show();
		});
	});

jQuery('form#newUnit').bind('submit', function(event){
		event.preventDefault();
		
		$("#newUnitSubmit").hide(); 
		$("#LoadingGif").show();
		
		var form = this;
		var json = ConvertFormToJSON(form);
		/*var tbody = jQuery('#personList > tbody');*/

		$.ajax({
			type: "POST",
			url: "addUnit.php",
			data: json,
			dataType: "json"				
		}).success(function(state) { 
			if(state.success === true) {
				/*var rowNode = daTable
					.row.add( [ '<div class="text-center"><span class="text-center"><a href="#" id="personUpdate-' + state['tc'] + '" class="personUpdate" data-toggle="modal" data-original-title="Girdiyi düzenle"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;<a href="#" id="personDelete-' + state['tc'] + '" class="personDelete" ><span class="glyphicon glyphicon-remove"></span></a></span></div>',
								 state['tc'],
								 state['sicil'],
								 state['name'],
								 state['sname'],
								 state['email'],
								 state['unit'],
								 state['tel'],
								 state['dahili'],
								 state['fax'],
								 state['unvan'],
								 state['Ounvan'],
								 state['date']						
							  ] )
					.draw()
					.node();
					
				$( rowNode ).addClass('text-center');
				$( rowNode ).attr( "id", 'personRow-' + state['tc']);*/
				$("#LoadingGif").hide();
				$("#newUnitSubmit").show();
				$("#newUnit").reset();
				/*
				tbody.append('<tr id="personRow-' + state['tc'] + '"><td><div class="text-center"><span class="text-center"><a href="#" id="personUpdate-' + state['tc'] + '" class="personUpdate" data-toggle="modal" data-original-title="Girdiyi düzenle"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;<a href="#" id="personDelete-' + state['tc'] + '" class="personDelete" ><span class="glyphicon glyphicon-remove"></span></a></span></div></td><td>' + state['tc'] + '</td><td>' + state['sicil'] + '</td><td>' + state['name'] + '</td><td>' + state['sname'] + '</td><td>' + state['email'] + '</td><td>' + state['unit'] + '</td><td>' + state['tel'] + '</td><td>'+ state['dahili'] + '</td><td>' + state['fax'] + '</td><td>' + state['unvan'] + '</td><td>' + state['Ounvan'] + '</td><td>' + state['date'] + '</td></tr>');
				$("#LoadingGif").hide();
				$("#newUnitSubmit").show();
				$("#newPer").reset();*/
			} else {
				$("#LoadingGif").hide();
				$("#newUnitSubmit").show();
				alert(state.error.join());
			}
		}).fail(function(state) {
			$("#LoadingGif").hide();
			$("#newUnitSubmit").show();
			alert("Başarısız" + thrownError);  
		});
		return true;
	});
	
	jQuery('form#newTitle').bind('submit', function(event){
		event.preventDefault();
		
		$("#newTitleSubmit").hide(); 
		$("#LoadingGif").show();
		
		var form = this;
		var json = ConvertFormToJSON(form);
		/*var tbody = jQuery('#personList > tbody');*/

		$.ajax({
			type: "POST",
			url: "addTitle.php",
			data: json,
			dataType: "json"				
		}).success(function(state) { 
			if(state.success === true) {
				/*var rowNode = daTable
					.row.add( [ '<div class="text-center"><span class="text-center"><a href="#" id="personUpdate-' + state['tc'] + '" class="personUpdate" data-toggle="modal" data-original-title="Girdiyi düzenle"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;<a href="#" id="personDelete-' + state['tc'] + '" class="personDelete" ><span class="glyphicon glyphicon-remove"></span></a></span></div>',
								 state['tc'],
								 state['sicil'],
								 state['name'],
								 state['sname'],
								 state['email'],
								 state['unit'],
								 state['tel'],
								 state['dahili'],
								 state['fax'],
								 state['unvan'],
								 state['Ounvan'],
								 state['date']						
							  ] )
					.draw()
					.node();
					
				$( rowNode ).addClass('text-center');
				$( rowNode ).attr( "id", 'personRow-' + state['tc']);*/
				$("#LoadingGif").hide();
				$("#newTitleSubmit").show();
				$("#newTitle").reset();
				/*
				tbody.append('<tr id="personRow-' + state['tc'] + '"><td><div class="text-center"><span class="text-center"><a href="#" id="personUpdate-' + state['tc'] + '" class="personUpdate" data-toggle="modal" data-original-title="Girdiyi düzenle"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;<a href="#" id="personDelete-' + state['tc'] + '" class="personDelete" ><span class="glyphicon glyphicon-remove"></span></a></span></div></td><td>' + state['tc'] + '</td><td>' + state['sicil'] + '</td><td>' + state['name'] + '</td><td>' + state['sname'] + '</td><td>' + state['email'] + '</td><td>' + state['unit'] + '</td><td>' + state['tel'] + '</td><td>'+ state['dahili'] + '</td><td>' + state['fax'] + '</td><td>' + state['unvan'] + '</td><td>' + state['Ounvan'] + '</td><td>' + state['date'] + '</td></tr>');
				$("#LoadingGif").hide();
				$("#newTitleSubmit").show();
				$("#newTitle").reset();*/
			} else {
				$("#LoadingGif").hide();
				$("#newTitleSubmit").show();
				alert(state.error.join());
			}
		}).fail(function(state) {
			$("#LoadingGif").hide();
			$("#newTitleSubmit").show();
			alert("Başarısız" + thrownError);  
		});
		return true;
	});
	
	
	
	
	
	