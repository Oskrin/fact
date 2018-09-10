$(function(){
	$("#txt_x").jfilestyle({buttonText: "<span class='glyphicon glyphicon-folder-open'></span> Seleccionar"});
	var table=$('#tabla-info, #tabla-info2').dataTable( {
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
		},
		"pageLength": 3
    });
	

	$("#form-data").validate({
        rules: {
            txt_1: {
                required: true,
            }
        },
		messages: {
		    txt_1: {
		        required: "Por favor ingrese información, campo requerido"
		    }
		},
        submitHandler: function(form) {
        	$.ajax({
	    		url: 'app.php',
	    		type: 'post',
	    		dataType:'json',
	    		data: $(form).serialize(),
	    		success: function (data) {
	    			llenar_tabla();
        			llenar_otros();
	    			if (data[0]==1) {
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
					if (data[0]==0) {
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
	$("#form-data2").validate({
        rules: {
            txt_1: {
                required: true,
            },
            sel_1: {
                required: true,
            },
            txt_x: {
                required: true,
            },
        },
		messages: {
		    txt_1: {
		        required: "Por favor ingrese información, campo requerido"
		    },
		    sel_1: {
		        required: "Por favor selec.. parroquia, campo requerido"
		    },
		    txt_x: {
		        required: "Por favor selec.. imagen, campo requerido"
		    },
		},
        submitHandler: function(form) {
        	$.ajax({
	    		url: 'app.php',
	    		type: 'post',
	    		dataType:'json',
	    		data: new FormData(form),
	    		processData: false,
      			contentType: false,
	    		success: function (data) {
	    			llenar_tabla();
	    			if (data[0]==1) {
						swal({
						    title: "Ok",
						    text: "Su información fue almacenada correctamente!",
						    type: "success"
						},function (){
							$('#form-data2').each (function(){
							  this.reset();
							});
						});
					};
					if (data[0]==0) {
						swal({
						    title: "Lo sentimos",
						    text: "Su información no pudo ser almacenada!",
						    type: "warning"
						},function (){
							$('#form-data2').each (function(){
							  this.reset();
							});
						});
					};
	    		}
	    	});
        }
    });
	
	llenar_tabla();
	llenar_otros();
});
function llenar_tabla(){
	$.ajax({
		url:'app.php',
		type:'POST',
		data:{mostrar_tabla:'ok'},
		dataType:'json',
		success:function(data){
			var t = $('#tabla-info').DataTable();
				t.clear().draw();
			var counter = 1;
			for (var i = 0; i < data.length; i=i+2) {
				t.row.add( [
					counter,
		            data[0+i],
		            data[1+i],
		            data[2+i],
		            data[3+i],
    			] ).draw();
    			counter++;
			}
		}
	});
	$.ajax({
		url:'app.php',
		type:'POST',
		data:{mostrar_tabla2:'ok'},
		dataType:'json',
		success:function(data){
			var t = $('#tabla-info2').DataTable();
				t.clear().draw();
			var counter = 1;
			for (var i = 0; i < data.length; i++) {
				t.row.add( [
					counter,
		            data[i][0],
		            data[i][1],
		            data[i][2],
    			] ).draw();
    			counter++;
			}
		}
	});
}
function editar(id){
	var fulldata=buscar_data(id);
	$('#myModal').modal('show');
	$('#username').text(fulldata[1]);
	$('#username').editable({
        url: 'app.php',
        type: 'text',
        value:fulldata[1],
        pk: id,
        name: 'txt_1_actualizar',
        title: 'Ingrese información',
        validate: function(value) {
		    if($.trim(value) == '') {
		        return 'Este campo es requerido';
		    }
		},
		success: function(value){
			llenar_tabla();
		}
    });
}
function buscar_data(id){
	var resultados;
	$.ajax({
		url: 'app.php',
		type: 'post',
		async:false,
		dataType:'json',
		data: {buscar_info:'',id:id},
		success: function (data) {
			console.log(data);
			resultados=data;
		}
	});
	return resultados;
}
function eliminar(id){
	var fulldata=buscar_data(id);
	swal({   
		title: "Esta seguro?",
		text: "De eliminar "+fulldata[1],
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Sí , eliminarla!",
		cancelButtonText: "Cancelar",
		closeOnConfirm: false
	}, function(){  
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

function llenar_otros(){
	$.ajax({
		url: 'app.php',
		type: 'post',
		data: {mostrar_parroquia:''},
		success: function (data) {
			$('#sel_1').html(data)
		}
	});
}