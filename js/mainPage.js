	function ConvertFormToJSON(form){
		var array = jQuery(form).serializeArray();
		var json = {};
		
		jQuery.each(array, function() {
			json[this.name] = this.value || '';
		
		});

		return json;
	}

	var daTable = $('#personList').DataTable({
		   language: {
				url: '../translation/translation.json'
			},
			sDom: '<lfT<t>ip>',
			"tableTools": {
				"sSwfPath": "../swf/copy_csv_xls_pdf.swf",
			},
			deferRender: true,
			retrieve: true
	});
	/*$.fn.dataTable.KeyTable( daTable );*/


	jQuery(document).on('ready', function() {	
		
		$('.combobox').combobox();
		
		jQuery.fn.reset = function () {
		$(this).each (function(e) { 
			this.reset();
		});
		}
	

	$('#topNav a').click(function (e) {
		var tab = $(this);
		if(tab.parent('li').hasClass('active')){
			window.setTimeout(function(){
			$(".tab-pane").removeClass('active');
			tab.parent('li').removeClass('active');
		},1);
	}
	});
		
	/*var daTable = $('#personList').DataTable({
		   language: {
				url: '../translation/translation.json'
			},
			sDom: '<lfT<t>ip>',
			"tableTools": {
				"sSwfPath": "../swf/copy_csv_xls_pdf.swf",
			},
			deferRender: true,
			retrieve: true
	});*/
	/*$.fn.dataTable.KeyTable( daTable );*/

	jQuery('form#newPer').bind('submit', function(event){
		event.preventDefault();
		
		$("#newPerSubmit").hide(); 
		$("#LoadingGif").show();
		
		var form = this;
		var json = ConvertFormToJSON(form);
		/*var tbody = jQuery('#personList > tbody');*/
		$.ajax({
			type: "POST",
			url: "addPersonnel.php",
			data: json,
			dataType: "json"				
		}).success(function(state) { 
			if(state.success === true) {
				var rowNode = daTable
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
				$( rowNode ).attr( "id", 'personRow-' + state['tc']);
				$("#LoadingGif").hide();
				$("#newPerSubmit").show();
				$("#newPer").reset();
				/*
				tbody.append('<tr id="personRow-' + state['tc'] + '"><td><div class="text-center"><span class="text-center"><a href="#" id="personUpdate-' + state['tc'] + '" class="personUpdate" data-toggle="modal" data-original-title="Girdiyi düzenle"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;<a href="#" id="personDelete-' + state['tc'] + '" class="personDelete" ><span class="glyphicon glyphicon-remove"></span></a></span></div></td><td>' + state['tc'] + '</td><td>' + state['sicil'] + '</td><td>' + state['name'] + '</td><td>' + state['sname'] + '</td><td>' + state['email'] + '</td><td>' + state['unit'] + '</td><td>' + state['tel'] + '</td><td>'+ state['dahili'] + '</td><td>' + state['fax'] + '</td><td>' + state['unvan'] + '</td><td>' + state['Ounvan'] + '</td><td>' + state['date'] + '</td></tr>');
				$("#LoadingGif").hide();
				$("#newPerSubmit").show();
				$("#newPer").reset();*/
			} else {
				$("#LoadingGif").hide();
				$("#newPerSubmit").show();
				alert(state.error.join());
			}
		}).fail(function(state) {
			$("#LoadingGif").hide();
			$("#newPerSubmit").show();
			alert("Başarısız");  
		});
		return true;
	});
		
	$("body").on("click", "#personList .personDelete", function(event) {
		event.stopPropagation();
		
		var clickedID = this.id.split('-');
		var dbTC = clickedID[1];
		var myData = 'tcToDelete=' + dbTC;
		$(this).hide();
		
		if(confirm(dbTC + " TC numaralı kişiyi silmek istediğinize emin misiniz?")) {
			this.click;
				jQuery.ajax({
				type: "POST",
				url: "deleteSomething.php",
				dataType: "text",
				data: myData,
				success:function(response){
					daTable.row( '#personRow-'+dbTC ).remove().draw();
					/*$('#personRow-'+dbTC).addClass( "fade hide" );*/
					/*$('#personRow-'+dbTC).fadeOut();*/
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
					$(this).show();
				}
				});
	} else { 
		$(this).show();
		return false;
	  }
	  event.preventDefault();
	});
	
	$("body").on("click", "#personList .personUpdate", function(event) {
		event.stopPropagation();
		
		var clickedID = this.id.split('-');
		var dbTC = clickedID[1];
		var myData = 'personToUpdate=' + dbTC;
			jQuery.ajax({
				type: "POST",
				url: "upupup.php",
				dataType: "json",
				data: myData,
				}).success(function(state) { 
					if(state.success === true) {
						$('.modal-body #upPerTcNo').val(state['tc']);
						$('.modal-body #upPerSicilNo').val(state['sicil']);
						$('.modal-body #upPerName').val(state['name']);
						$('.modal-body #upPerSname').val(state['sname']);
						$('.modal-body #upPerMail').val(state['email']);
						/*$('.modal-body #upPerUnit').val(state['unit']);*/
						$('.modal-body #upPerTel').val( state['tel']);
						$('.modal-body #upPerDtel').val(state['dahili']); 
						$('.modal-body #upPerFax').val(state['fax']);
						/*$('.modal-body #upPerTitle').val(state['unvan']);*/
						$('.modal-body #upPerOtitle').val(state['Ounvan']);
						$('.modal-body #orjTC').val(state['tc']);
						//$('.modal-body #lastChanged').val(state['date']);
						var info = state['date'];
						var newParagraph = document.createElement('p');
						newParagraph.textContent = info;
						$(newParagraph).addClass('form-control-static transparent-input');
						$(newParagraph).attr("id" , 'upParag');
						document.getElementById("secretDate").appendChild(newParagraph);
					    $("#upModal").modal('show');
					
					} else {
						alert(state.error.join());
					  }
				}).fail(function(state) {
			alert("Başarısız");  
		});
		return true;
	});
	
	jQuery('form#upPer').bind('submit', function(event){
		event.preventDefault();
		
		$("#perUpdate").hide(); 
		$("#LoadingGif").show();
		
		var form = this;
		var json = ConvertFormToJSON(form);
	
		$.ajax({
			type: "POST",
			url: "updatePerson.php",
			data: json,
			dataType: "json"			
		}).success(function(state) { 
			if(state.success === true) {
				/*console.log("tc=" + state['tc']);
				console.log(state['sicil']);
				console.log(state['name']);
				console.log(state['sname']);
				console.log(state['email']);
				console.log(state['unit']);
				console.log(state['tel']);
				console.log(state['dahili']);
				console.log(state['fax']);
				console.log(state['unvan']);
				console.log(state['Ounvan']);
				console.log(state['date']);
				var rowNode = daTable.row().data( [
												   '<div class="text-center"><span class="text-center"><a href="#" id="personUpdate-' + state['tc'] + '" class="personUpdate" data-toggle="modal" data-original-title="Girdiyi düzenle"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;<a href="#" id="personDelete-' + state['tc'] + '" class="personDelete" ><span class="glyphicon glyphicon-remove"></span></a></span></div>',
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
				$( rowNode ).attr( "id", 'personRow-' + state['tc']);
				$("#LoadingGif").hide();
				$("#perUpdate").show();
				$("#upPer").reset();
				$("#upModal").modal('hidden');*/
				console.log("asdsad");
				location.reload();
			} else {
				$("#LoadingGif").hide();
				$("#perUpdate").show();
				alert(state.error.join());
			}
		}).fail(function(state) {
			$("#LoadingGif").hide();
			$("#perUpdate").show();
			alert(thrownError);
		});
		return true;
	});
		
	$('#upModal').on('hidden.bs.modal', function () {
		document.getElementById("upParag").remove();
	});
	
	/*var time = new Date().getTime();
     $(document.body).bind("mousemove keypress", function(e) {
         time = new Date().getTime();
     });

     function refresh() {
         if(new Date().getTime() - time >= 60000) 
             window.location.reload(true);
         else 
             setTimeout(refresh, 10000);
     }

     setTimeout(refresh, 10000);*/
	
});