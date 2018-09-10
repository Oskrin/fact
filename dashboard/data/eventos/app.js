$(function() {
	$(".datepicker").datepicker({ 
		format: "yyyy-mm-dd",
        autoclose: true
	}).datepicker("setDate","today");

	$("#txt_12, #txt_13").TouchSpin({min: 0,max: 50,step: 1,boostat: 1,maxboostedstep: 1});
    $("#txt_14").rating();
	$("#txt_x").jfilestyle({buttonText: "<span class='glyphicon glyphicon-folder-open'></span> Seleccionar"});
	$('#btn_modificar').attr('disabled', true);

	var table = $('#tabla-info').dataTable( {
        language: {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		}
    });

	$("#form-data").validate({
        rules: {
            txt_1: {
                required: true,
            },
            txt_2: {
                required: true,
            },
            txt_3: {
                required: true,
            },
        },
		messages: {
		    txt_1: {
		        required: "Por favor ingrese información, campo requerido",
		        remote: "Ya existe, ingrese otro"
		    },
		    txt_2: {
		        required: "Por favor ingrese información, campo requerido"
		    },
		    txt_3: {
		        required: "Por favor ingrese información, campo requerido"
		    },
		},
        submitHandler: function(form) {

        }
    });	
	llenar_tabla();	
	
	
});

$('#btn_guardar').click(function() {
	var respuesta = $('#form-data').valid();

	if (respuesta == true) {
		llenar_tabla();
    	var img = $('#txt_x').val();
    	var formObj = document.getElementById("form-data");
    	var formData = new FormData(formObj);

    	$.ajax({
    		url: 'guardar.php',
    		type: 'post',
    		dataType:'json',
    		data: formData,
    		processData: false,
  			contentType: false,
    		success: function (data) {
    			llenar_tabla();
    			if (data[0] == 1) {
					swal({
					    title: "Ok",
					    text: "Su información fue almacenada correctamente!",
					    type: "success"
					},function (){
						$('#form-data').each (function(){
						  this.reset();
						});
					});
				};
				if (data[0] == 0) {
					swal({
					    title: "Lo sentimos",
					    text: "Su información no pudo ser almacenada!",
					    type: "warning"
					},function (){
						$('#form-data').each (function(){
						  this.reset();
						});
					});
				};
    		}
    	});
	}
});

$('#btn_modificar').click(function() {
	var respuesta = $('#form-data').valid();

	if (respuesta == true) {
		llenar_tabla();
    	var img = $('#txt_x').val();
    	var formObj = document.getElementById("form-data");
    	var formData = new FormData(formObj);

    	$.ajax({
    		url: 'modificar.php',
    		type: 'post',
    		dataType:'json',
    		data: formData,
    		processData: false,
  			contentType: false,
    		success: function (data) {
    			llenar_tabla();
    			if (data[0] == 1) {
					swal({
					    title: "Ok",
					    text: "Su información fue modificada correctamente!",
					    type: "success"
					},function (){
						$('#form-data').each (function(){
						  this.reset();
						});
					});
				};
				if (data[0] == 0) {
					swal({
					    title: "Lo sentimos",
					    text: "Su información no pudo ser modificada!",
					    type: "warning"
					},function (){
						$('#form-data').each (function(){
						  this.reset();
						});
					});
				};
    		}
    	});
	}
});

function llenar_tabla() {
	$.ajax({
		url:'app.php',
		type:'POST',
		data:{mostrar_tabla:'ok'},
		dataType:'json',
		success:function(data){
			var t = $('#tabla-info').DataTable();
				t.clear().draw();
			var counter = 1;
			for (var i = 0; i < data.length; i=i+4) {
				t.row.add( [
		            data[0+i],
		            data[1+i],
		            data[2+i],
		            data[3+i]
    			] ).draw();
    			counter++;
			}
		}
	});
}

function editar(id) {
	$('#btn_modificar').attr('disabled', false);
	$('#btn_guardar').attr('disabled', true);

	$.ajax({
		url: 'app.php',
		type: 'post',
		data: {llenar_eventos:'llenar_eventos',id: id},
		dataType: 'json',
		success: function (data) {
			console.log(data);
			$("#id").val(data.id);
			$("#txt_1").val(data.nombre_evento);
			$("#txt_2").val(data.fecha_evento);
			$("#txt_3").val(data.hora_evento);
			$("#txt_4").val(data.descripcion);
		}
	});
}

function buscar_data(id) {
	var resultados;
	$.ajax({
		url: 'app.php',
		type: 'post',
		async:false,
		dataType:'json',
		data: {buscar_info:'',id:id},
		success: function (data) {
			console.log(data);
			resultados = data;
		}
	});
	return resultados;
}

function eliminar(id) {
	// var fulldata = buscar_data(id);
	swal({   
		title: "Esta seguro?",
		// text: "De eliminar "+fulldata[1],
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Sí , eliminarla!",
		cancelButtonText: "Cancelar",
		closeOnConfirm: false
	}, function() {  
		$.ajax({
			url: 'app.php',
			type: 'post',
			data: {eliminar_registro:'',id:id},
			success: function (data) {
				swal("Eliminar!", "El registro se elimino correctamente.", "success");
				llenar_tabla(); 
			}
		});
		
	});
}

