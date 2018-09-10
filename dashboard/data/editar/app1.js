$(function() {
	$.ajax({
        url: 'app.php',
		type: 'post',
		data: {info:'info'},
		dataType: 'json',
		success: function (data) {
			vec = data;

			$('#id').val(vec['id']);
			$('#nombre').val(vec['nombres']);
			$('#apellido').val(vec['apellidos']);
			$('#dato1').val(vec['dato1'])
			$('#dato2').val(vec['dato2'])
			$('#dato3').val(vec['dato3']) 
        }
	});

	$("#form-data").validate({
        rules: {
        	nombre: {
                required: true,
            },
            apellido: {
                required: true,
            },
            dato1: {
                required: true,
            },
            dato2: {
                required: true,
            },
            dato3: {
                required: true,
            },
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
                minlength: 5,
            },
            txt_3: {
                required: true,
                equalTo: "#txt_2"
            },
        },
		messages: {
			nombre: {
		        required: "Por favor ingrese información, campo requerido"
		    },
		    apellido: {
		        required: "Por favor ingrese información, campo requerido"
		    },
		    dato1: {
		        required: "Por favor ingrese información, campo requerido"
		    },
		    dato2: {
		        required: "Por favor ingrese información, campo requerido"
		    },
		    dato3: {
		        required: "Por favor ingrese información, campo requerido"
		    },
		    txt_1: {
		        required: "Por favor ingrese información, campo requerido",
		        remote: "Contraseña Incorrecta"
		    },
		    txt_2: {
		        required: "Por favor ingrese información, campo requerido",
		        minlength: "Por favor, Por seguridad ingrese minimo 5 caracteres."
		    },
		    txt_3: {
		        required: "Por favor ingrese información, campo requerido",
		        equalTo: "Por favor, Verifique su password no coincide."
		    },
		},
        submitHandler: function(form) {

        }
    });	
});


$('#btn_cambiar').click(function () {
	var respuesta = $('#form-data').valid();

	if (respuesta == true) {
		var form_uno = $("#form-data").serialize();
		var submit = "btn_guardar";

		$.ajax({
	        url: "app.php",
	        data: form_uno+"&btn_guardar=" + submit,
	        type: "POST",
	        dataType:'json',
	        success: function (data) {
	        	if (data[0] == 1) {
					swal({
					    title: "Ok",
					    text: "Su información fue Modificada correctamente!",
					    type: "success"
					});
				}                                              
	        }
	    });
	}	
});	


