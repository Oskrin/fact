$(function() {
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
                remote: {
			        url: "app.php",
			        type: "post",
			        data: {verificar_existencia_value:''}
			    }
            },
            txt_2: {
                required: true,
            },
            txt_3: {
                required: true,
            },
            txt_4: {
                required: true,
            },
            txt_5: {
                required: true,
                number: true
            },
            txt_6: {
                required: true,
                email:true
            },
            txt_7: {
                url:true
            },
            sel_8: {
                required: true,
            },
            sel_10: {
                required: true,
            },
            sel_11: {
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
		    txt_4: {
		        required: "Por favor ingrese información, campo requerido"
		    },
		    txt_5: {
		        required: "Por favor ingrese información, campo requerido",
		        number: 'Ingrse solo números'
		    },
		    txt_6: {
		        required: "Por favor ingrese información, campo requerido",
		        email:'correo electrónico no valido'
		    },
		    txt_7: {
		        url:'Dirección url no valido'
		    },
		    sel_8: {
		        required: "Por favor ingrese información, campo requerido"
		    },
		    sel_10: {
		        required: "Por favor ingrese información, campo requerido"
		    },
		    sel_11: {
		        required: "Por favor ingrese información, campo requerido"
		    },
		},
        submitHandler: function(form) {

        }
    });	
	llenar_tabla();	
	llenar_clima();
	$('#map').height();
	$('#btn_mapa').click(function(){	
		mapa();
		$('#myModal-map').modal('show');
	});
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
			for (var i = 0; i < data.length; i=i+11) {
				t.row.add( [
		            data[0+i],
		            data[1+i],
		            data[2+i],
		            data[3+i],
		            data[4+i],
		            // data[5+i],
		            estrellas(data[6+i]),
		            // data[7+i],			            
		            data[8+i],
		            data[9+i],
		            data[10+i],
		            data[11+i],

    			] ).draw();
    			counter++;
			}
		}
	});
}

function estrellas(num) {
	var acu = '';
	for (var i = 0; i < num; i++) {
		acu=acu+'<i class="pe-7s-star text-warning"></i>';
	}
	return acu;
}

function editar(id) {
	$('#btn_modificar').attr('disabled', false);
	$('#btn_guardar').attr('disabled', true);

	$.ajax({
		url: 'app.php',
		type: 'post',
		data: {llenar_establecimientos:'llenar_establecimientos',id: id},
		dataType: 'json',
		success: function (data) {
			console.log(data);
			$("#id").val(data.id);
			$("#txt_1").val(data.nombre);
			$("#txt_2").val(data.propietario);
			$("#txt_3").val(data.direccion);
			$("#txt_4").val(data.posicion);
			$("#txt_5").val(data.telefono);
			$("#txt_6").val(data.correo);
			$("#txt_7").val(data.sitio_web);
			$("#sel_8").val(data.id_clima);
			$("#txt_9").val(data.descripcion);
			$("#sel_10").val(data.tipo_establecimiento);
			$("#sel_11").val(data.id_parroquia);
			$("#txt_12").val(data.n_hab);
			$("#txt_13").val(data.n_plazas);
			$("#txt_14").val(data.categoria);
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

function llenar_clima() {
	$.ajax({
		url: 'app.php',
		type: 'post',
		data: {mostrar_clima:''},
		success: function (data) {
			$('#sel_8').html(data)
		}
	});
	$.ajax({
		url: 'app.php',
		type: 'post',
		data: {mostrar_tipo:''},
		success: function (data) {
			$('#sel_10').html(data)
		}
	});
	$.ajax({
		url: 'app.php',
		type: 'post',
		data: {mostrar_parroquia:''},
		success: function (data) {
			$('#sel_11').html(data)
		}
	});
}

function mapa() {
	$('#map').html('');
	var map = new ol.Map({
	  layers: [
	    new ol.layer.Tile({
	      source: new ol.source.OSM()
	    })
	  ],
	  controls: ol.control.defaults({
	    attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
	      collapsible: false
	    })
	  }),
	  // renderer: exampleNS.getRendererFromQueryString(),
	  target: 'map',
	  view: new ol.View({
	    center: ol.proj.transform([-78.26667,0.3], 'EPSG:4326', 'EPSG:3857'),
	    zoom: 13
	  })
	});

	// Popup showing the position the user clicked
	var popup = new ol.Overlay({
	  element: document.getElementById('popup')
	});
	map.addOverlay(popup);

	map.on('click', function(evt) {
	  var element = popup.getElement();
	  var coordinate = evt.coordinate;	  
	  var hdms = ol.coordinate.toStringHDMS(ol.proj.transform(coordinate, 'EPSG:3857', 'EPSG:4326'));
	  $(element).popover('destroy');
	  popup.setPosition(coordinate);
	  var hdms = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
	  $(element).popover({
	    'placement': 'top',
	    'animation': false,
	    'html': true,
	    'content': '<span class="fa fa-check-square-o"></span> ok'
	  });
	  $(element).popover('show');
	  $('#txt_4').val(hdms);
	});
	//mostrar icono
	
	setInterval(function(){map.updateSize();}, 50);	
	
}
function generariconomap(coordinate){
	var iconFeature = new ol.Feature({
	  geometry: new ol.geom.Point(coordinate),
	  name: 'Null Island',
	  population: 4000,
	  rainfall: 500
	});

	var iconStyle = new ol.style.Style({
	  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
	    anchor: [0.5, 46],
	    anchorXUnits: 'fraction',
	    anchorYUnits: 'pixels',
	    opacity: 0.75,
	    src: 'data/icon.png'
	  }))
	});

	iconFeature.setStyle(iconStyle);	
}