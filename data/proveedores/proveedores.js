$(document).on("ready",inicio);

function inicio () {
	var boton_click ="";
	// inicializacion de formato txt_ telefono1
	$(".chosen-select").chosen({allow_single_deselect: true}); // works
	/*funcion inicial de la imagen y  buscadores del select no topar plz*/	
	if(!ace.vars['touch']) {
		$('.chosen-select').chosen({allow_single_deselect:true}); 
		 //jQuery(".chosen3").chosen({allow_single_deselect: true, });
		//resize the chosen on window resize

		$(window)
		.off('resize.chosen')
		.on('resize.chosen', function() {
			$('.chosen-select').each(function() {
				 var $this = $(this);
				 $this.next().css({'width': $this.parent().width()});
			});
			$("#txt_17").css({'width': $("#txt_3").parent().width() - 22});
		}).trigger('resize.chosen');
		//resize chosen on sidebar collapse/expand
		$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
			if(event_name != 'sidebar_collapsed') return;
			$('.chosen-select').each(function() {
				 var $this = $(this);
				 $this.next().css({'width': $this.parent().width()});
			});
			$("#txt_17").css({'width': $("#txt_3").parent().width() - 22});
		});

		$('#chosen-multiple-style .btn').on('click', function(e) {
			var target = $(this).find('input[type=radio]');
			var which = parseInt(target.val());
			if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
			 else $('#form-field-select-4').removeClass('tag-input-style');
		});
	}
	// stilo select2
	$(".select2").css({
	    'width': '100%',
	    allow_single_deselect: true,
	    no_results_text: "No se encontraron resultados",
	    allowClear: true,
	});
	// fin

	$('#btn_guardar_pais').on('click', function() {
		$.ajax({
		    url: "proveedores.php",
		    data: {guardar_pais:'guardar_pais', txt_pais: $("#txt_pais").val()}, 	    	    	    
		    type: "POST",				
		    success: function(data) {	    	
		    	if(data == 2) {	
		    		$("#txt_9").html("");
		    		$("#txt_10").html("");
		    		$("#txt_11").html("");
		    		$("#cmb_pais").html("");
		    		$("#cmb_pais2").html("");	        		
		    		alert('Datos Agregados Correctamente');
		    		$("#txt_pais").val("");
		    		$('#modal_pais').modal('hide');
		    		carga_ubicaciones("txt_9","txt_10","txt_11");//pais provincia ciudad 
		    		carga_ubicaciones("cmb_pais");
		    		carga_ubicaciones("cmb_pais2");    		
		    	} else {
		    		if(data == 1) {	    		
		    			alert('El País ya existe. Ingrese otra');
		    			$("#txt_pais").val("");
		    			$("#txt_pais").focus();
		    		}
		    	}
			}		
		});
	});

	$('#btn_guardar_provincia').on('click', function() {
		$.ajax({
		    url: "proveedores.php",
		    data: {guardar_provincia:'guardar_provincia', txt_provincia: $("#txt_provincia").val(), id: $("#cmb_pais").val()}, 	    	    	    
		    type: "POST",				
		    success: function(data) {	    	
		    	if(data == 2) {
		    		$("#txt_9").html("");
		    		$("#txt_10").html("");
		    		$("#txt_11").html("");  
		    		$("#cmb_pais2").html("");
		    		$("#cmb_provincia").html(""); 		
		    		alert('Datos Agregados Correctamente');
		    		$("#txt_provincia").val("");
		    		$('#modal_provincia').modal('hide');
		    		carga_ubicaciones("txt_9","txt_10","txt_11");//pais provincia ciudad
					carga_ubicaciones("cmb_pais2","cmb_provincia");  	    		
		    	} else {
		    		if(data == 1) {	    		
		    			alert('La Provincia ya existe. Ingrese otra');
		    			$("#txt_provincia").val("");
		    			$("#txt_provincia").focus();
		    		}
		    	}
			}		
		});
	});

	$('#btn_guardar_ciudad').on('click', function() {
		$.ajax({
		    url: "proveedores.php",
		    data: {guardar_ciudad:'guardar_ciudad', txt_ciudad: $("#txt_ciudad").val(), id: $("#cmb_provincia").val()}, 	    	    	    
		    type: "POST",				
		    success: function(data) {	    	
		    	if(data == 2) {  
		    		$("#txt_9").html("");
		    		$("#txt_10").html("");
		    		$("#txt_11").html("");
		    		$("#cmb_pais2").html("");
		    		$("#cmb_provincia").html(""); 	 		
		    		alert('Datos Agregados Correctamente');
		    		$("#txt_ciudad").val("");
		    		$('#modal_ciudad').modal('hide');
		    		carga_ubicaciones("txt_9","txt_10","txt_11");//pais provincia ciudad
					carga_ubicaciones("cmb_pais2","cmb_provincia"); 	    		
		    	} else {
		    		if(data == 1) {	    		
		    			alert('La Ciudad ya existe. Ingrese otra');
		    			$("#txt_ciudad").val("");
		    			$("#txt_ciudad").focus();
		    		}
		    	}
			}		
		});
	});

	carga_ubicaciones("cmb_pais");
	carga_ubicaciones("cmb_pais2","cmb_provincia");

	$("#cmb_pais2").change(function() {
		change_pais("cmb_pais2","cmb_provincia");
	});
	
	/*----procesos ci ruc pass-----*/
	$("#txt_1").change(function() {
		documentos("0");
	});

	//$("#txt_2").keyup(function() {
	//	ci_ruc_pass("txt_2",$("#txt_2").val(),$("#txt_1").val());
	//});
	
	// consultar proveedores
	$('#txt_2').focus();
    $("#txt_2").on("keypress",function(e) {
    	if(e.keyCode == 13) { // tecla del alt para el entrer poner 13
    		if($('#txt_2').val() == '') {
    		$.gritter.add({
    			title: 'Error... Ingrese una Identificación',
    			class_name: 'gritter-error gritter-center',
    			time: 1000,
    		});
    		$('#txt_2').focus();
    		} else {
    			if($('#txt_1').val() == 'Cedula') {
    				$.ajax({
    	                type: "POST",
    	                url: "http://coatl.vadowservice.com/data/clientes/app.php",          
    	                data:{consulta_cedula:'consulta_cedula',txt_ruc:$("#txt_2").val()},
    	                dataType: 'json',
    	                beforeSend: function() {
    	                	$.blockUI({ css: { 
    				            border: 'none', 
    				            padding: '15px', 
    				            backgroundColor: '#000', 
    				            '-webkit-border-radius': '10px', 
    				            '-moz-border-radius': '10px', 
    				            opacity: .5, 
    				            color: '#fff' 
    				        	},
    				            message: '<h3>Consultando, Por favor espere un momento    ' + '<i class="fa fa-spinner fa-spin"></i>' + '</h3>'
    				    	});
    	                },
                        success: function(data) {
                        	$.unblockUI();
                    		if(data.datosPersona.valid == false) {
    		            		$.gritter.add({
    								title: 'Lo sentimos, Cédula Erronea',
    								class_name: 'gritter-error gritter-center',
    								time: 1000,
    							});
    							$('#txt_2').focus();
    							$('#txt_2').val("");	
    		            	} else {
    		            		if(data.datosPersona.valid == true) {
    			            		$('#txt_3').val(data.datosPersona.name);
    			            		$('#txt_12').val(data.datosPersona.name);
    			            		//$('#ciudad').val(data.datosPersona.residence);
    			            		//$('#direccion').val(data.datosPersona.streets);
    			            	}	 		
    		            	}
    	                }
    	            });
    			} else {
    				if($('#txt_1').val() == 'RUC') {
    					$.ajax({
    		                type: "POST",
    		                url: "http://coatl.vadowservice.com/data/clientes/app.php",          
    		                data:{consulta_ruc:'consulta_ruc',txt_ruc:$("#txt_2").val()},
    		                dataType: 'json',
    		                beforeSend: function() {
    		                	$.blockUI({ css: { 
    					            border: 'none', 
    					            padding: '15px', 
    					            backgroundColor: '#000', 
    					            '-webkit-border-radius': '10px', 
    					            '-moz-border-radius': '10px', 
    					            opacity: .5, 
    					            color: '#fff' 
    					        	},
    					            message: '<h3>Consultando, Por favor espere un momento    ' + '<i class="fa fa-spinner fa-spin"></i>' + '</h3>'
    					    	});
    		                },
    	                    success: function(data) {
    	                    	$.unblockUI();
    	                    	if(data.datosEmpresa.valid == 'false') {
    			            		$.gritter.add({
    									title: 'Lo sentimos", "Usted no dispone de un RUC registrado en el SRI, o el número ingresado es Incorrecto."',
    									class_name: 'gritter-error gritter-center',
    									time: 1000,
    								});
    
    								$('#txt_2').focus();
    								$('#txt_2').val("");
    			            	} else {
    			            		if(data.datosEmpresa.valid == 'true') {
    					            	$('#txt_3').val(data.datosEmpresa.razon_social);
    					            	$('#txt_12').val(data.datosEmpresa.razon_social);
    					            	//if (data.datosEmpresa.nombre_comercial == "no disponible") {
    					            	//	$('#nombre_comercial').val(data.datosEmpresa.razon_social);
    					            	//} else {
    					            	//	$('#nombre_comercial').val(data.datosEmpresa.nombre_comercial);
    					            	//}
    					            	//$('#telefono1').focus();			            		
    					            }
    			            	}
    		                }
    		            });
    				}	
    			}
    		}
    	}
    });
    // fin
	
	
	/*--cargar combos dependientes--*/    
	carga_ubicaciones("txt_9","txt_10","txt_11");//pais provincia ciudad

	$("#txt_9").change(function() {
		change_pais("txt_9","txt_10","txt_11");
	});

	$("#txt_10").change(function() {
		change_provincia("txt_9","txt_10","txt_11");
	});

    $("#btn_agr_ret_fuente").on('click',function() {
    	boton_click = "txt_20";
    });

    $("#btn_ret_iva").on('click',function() {
    	boton_click = "txt_21";
    });

    // funcion validar solo numeros
	function ValidNum() {
	    if (event.keyCode < 48 || event.keyCode > 57) {
	        event.returnValue = false;
	    }
	    return true;
	}
	// fin

	function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
    
    // guardar proveedores
    function guardar_proveedores() {
    	var valores = $("#form_proveedores").serialize();
    	var texto = ($("#btn_0").text()).trim();
    	var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var correo = $('#txt_6').val();
    
    	if($("#txt_2").val() == "") {
    		$.gritter.add({
    			title: 'Error... Ingrese una Identificación',
    			class_name: 'gritter-error gritter-center',
    			time: 1000,
    		});
    		$("#txt_2").focus();
    	} else {
    		if($("#txt_3").val() == "") {
    			$.gritter.add({
        			title: 'Error... Ingrese Nombre Empresa',
        			class_name: 'gritter-error gritter-center',
        			time: 1000,
        		});
    			$("#txt_3").focus();
    		} else {
    		    if(correo != "" && !expr.test(correo)) {
        			$.gritter.add({
            			title: 'Error... Ingrese un Correo Válido',
            			class_name: 'gritter-error gritter-center',
            			time: 1000,
            		});
        			$("#txt_6").focus();
        		} else {
        			if($("#txt_12").val() == "") {
        				$.gritter.add({
                			title: 'Error... Ingrese un Representante Legal',
                			class_name: 'gritter-error gritter-center',
                			time: 1000,
                		});
        				$("#txt_12").focus();
        			} else {
        				if($("#txt_15").val() == "") {
        					$.gritter.add({
                    			title: 'Error... Ingrese una Dirección',
                    			class_name: 'gritter-error gritter-center',
                    			time: 1000,
                    		});
        					$("#txt_15").focus();
        				} else {
        					if(texto == "Guardar") {
        						datos_proveedor(valores,"g");		
        					} else {
        						datos_proveedor(valores,"m");	
        					}
        				}
        			}
        		}
    		}
    	}
    }
    // fin
    
    // datos proveedores
    function datos_proveedor(valores,tipo,p) {	
    	$.ajax({				
    		type: "POST",
    		data: valores+"&tipo="+tipo,		
    		url: "proveedores.php",			
    	    success: function(data) {	
    	    	if(data == 0) {
    	    		$.gritter.add({
            			title: 'Datos Agregados Correctamente',
            			class_name: 'gritter-success gritter-center',
            			time: 2000,
            		})			
    	    		actualizar_form();				
    	    	} else {
    	    		if(data == 1) {
    	    			$.gritter.add({
                			title: 'Error... La Identificacion ya existe Ingrese Otra',
                			class_name: 'gritter-error gritter-center',
                			time: 2000,
                		});	
    	    			$("#txt_2").val("");
    	    			$("#txt_2").focus();	    			
    	    		} else {
    	    			$.gritter.add({
                			title: 'Error al momento de enviar los datos la página se recargara',
                			class_name: 'gritter-error gritter-center',
                			time: 1000,
                		});	    			
    	    			actualizar_form();
    	    		}
    	    	}
    		}
    	}); 
    }
    // fin

    /*procesos de guardar buscar modificar limpiar actualizar*/ 
    $("#txt_2").keypress(ValidNum);
	$("#txt_3").keypress(soloLetras);
	$("#txt_12").keypress(soloLetras);
	$("#txt_13").keypress(soloLetras);   		
	$("#btn_0").on("click",guardar_proveedores);
	$("#btn_1").on("click",limpiar_form);
	$("#btn_2").on("click",actualizar_form);

	$("#btn_4").on("click",function() {		
		var resp = "";		
		resp = atras($("#txt_0").val(),"proveedores","secuencia.php");
		if(resp[0] != false) {			
			$("#txt_0").val(resp[0][0]);
			$("#txt_1").val(resp[0][1]);
			$("#txt_1").trigger("chosen:updated"); 	
			$("#txt_2").val(resp[0][2]);
			$("#txt_12").val(resp[0][3]);
			$("#txt_14").val(resp[0][4]);		
			$("#txt_14").trigger("chosen:updated"); 			
			$("#txt_4").val(resp[0][5]);		
			$("#txt_5").val(resp[0][6]);
			$("#txt_15").val(resp[0][8]);		
			$("#txt_3").val(resp[0][9]);		
			$("#txt_13").val(resp[0][10]);		
			$("#txt_7").val(resp[0][11]);		
			$("#txt_6").val(resp[0][12]);		
			$("#txt_8").val(resp[0][13]);		
			$("#txt_8").trigger("chosen:updated"); 
			$("#txt_16").val(resp[0][14]);		
			$("#txt_16").trigger("chosen:updated"); 
			$("#txt_17").val(resp[0][15]);		
			$("#txt_18").val(resp[0][16]);		
			$("#txt_19").val(resp[0][17]);		
		    $("#txt_22").val(resp[0][18]);		
			$("#txt_22").trigger("chosen:updated"); 
			$("#txt_23").val(resp[0][19]);		
			$("#txt_23").trigger("chosen:updated"); 

			$.ajax({        
		        type: "POST",
		        dataType: 'json',        
		        url: "../carga_ubicaciones.php?tipo=0&fun=37&id="+$("#txt_23").val(),        
		        success: function(response) {         			        	
		        	$("#txt_24").empty();	        	
		        	$("#txt_24").append("<option value=''>  </option>");				
		            for (var i = 0; i < response.length; i=i+3) {       
		            	if(response[i] == resp[0][20]){
							$("#txt_24").append("<option value ="+response[i]+" selected>"+response[i+1]+" "+response[i+2]+"</option>");				
		            	} else {
							$("#txt_24").append("<option value ="+response[i]+">"+response[i+1]+" "+response[i+2]+"</option>");				
						}     				            	            		
		            }
		            $("#txt_24").trigger("chosen:updated");                                          
		        }
	    	}); 
		    $("#txt_26").val(resp[0][22]);		
		    $("#txt_25").val(resp[0][25]);		
			$("#txt_25").trigger("chosen:updated"); 
			$("#txt_20").val(resp[0][26]);		
			$("#txt_20").trigger("chosen:updated"); 
			$("#txt_21").val(resp[0][27]);		
			$("#txt_21").trigger("chosen:updated"); 
		    documentos("1");
		    /**/
	        var prov = 0;
	        var pais = 0;
	        $.ajax({/*obtnengo el id de provincia*/
		        type: "POST",		        
		        url: "../carga_ubicaciones.php?tipo=0&id="+resp[0][7]+"&fun=5",        
		        success: function(response) {         
		        	prov = response;
		        	$.ajax({/*obtnengo el id del pais*/
				        type: "POST",			        
				        url: "../carga_ubicaciones.php?tipo=0&id="+prov+"&fun=6",        
				        success: function(response) {         
				        	pais = response;						        	
				        	/*cambio los combos*/
						    $.ajax({        
						        type: "POST",
						        dataType: 'json',        
						        url: "../carga_ubicaciones.php?tipo=0&id=0&fun=1",        
						        success: function(response) {         			        	
						        	$("#txt_9").html("");
						            for (var i = 0; i < response.length; i=i+2) {            				            	
						            	if(response[i] == pais){
											$("#txt_9").append("<option value ="+response[i]+" selected>"+response[i+1]+"</option>");            																																
						            	} else {
											$("#txt_9").append("<option value ="+response[i]+">"+response[i+1]+"</option>");            																																
										}
						            }   
						            $("#txt_9").trigger("chosen:updated"); 

						            $.ajax({        
								        type: "POST",
								        dataType: 'json',        
								        url: "../carga_ubicaciones.php?tipo=0&id="+pais+"&fun=2",        
								        success: function(response) {         			        	
								        	$("#txt_10").html("");
								            for (var i = 0; i < response.length; i=i+2) {            				            	
								            	if(response[i] == prov){
													$("#txt_10").append("<option value ="+response[i]+" selected>"+response[i+1]+"</option>");            																																
								            	} else {
													$("#txt_10").append("<option value ="+response[i]+">"+response[i+1]+"</option>");            																																
												}
								            }   
								            $("#txt_10").trigger("chosen:updated"); 

								            $.ajax({        
										        type: "POST",
										        dataType: 'json',        
										        url: "../carga_ubicaciones.php?tipo=0&id="+prov+"&fun=3",        
										        success: function(response) {         			        	
										        	$("#txt_11").html("");
										            for (var i = 0; i < response.length; i=i+2) {            				            	
										            	if(response[i] == resp[0][7]){
															$("#txt_11").append("<option value ="+response[i]+" selected>"+response[i+1]+"</option>");            																																
										            	} else {
															$("#txt_11").append("<option value ="+response[i]+">"+response[i+1]+"</option>");            																																
														}
										            }   
										            $("#txt_11").trigger("chosen:updated");                                 
										        }
										    });	                                    
								        }
								    });	                            
						        }
						    });						    
				        }                   
				    });
		        }                   
		    });	
		} else {
			alert("Sin registros anteriores");
		}			    	            
	    $("#btn_0").text("");
        $("#btn_0").append("<span class='glyphicon glyphicon-log-in'></span> Modificar");
	});

	$("#btn_5").on("click",function() {		
		var resp = "";		
		resp =adelante($("#txt_0").val(),"proveedores","secuencia.php");		
		if(resp[0] != false) {			
			$("#txt_0").val(resp[0][0]);
			$("#txt_1").val(resp[0][1]);
			$("#txt_1").trigger("chosen:updated"); 	
			$("#txt_2").val(resp[0][2]);
			$("#txt_12").val(resp[0][3]);
			$("#txt_14").val(resp[0][4]);		
			$("#txt_14").trigger("chosen:updated"); 			
			$("#txt_4").val(resp[0][5]);		
			$("#txt_5").val(resp[0][6]);

			$("#txt_15").val(resp[0][8]);		
			$("#txt_3").val(resp[0][9]);		
			$("#txt_13").val(resp[0][10]);		
			$("#txt_7").val(resp[0][11]);		
			$("#txt_6").val(resp[0][12]);		
			$("#txt_8").val(resp[0][13]);		
			$("#txt_8").trigger("chosen:updated"); 
			$("#txt_16").val(resp[0][14]);		
			$("#txt_16").trigger("chosen:updated"); 
			$("#txt_17").val(resp[0][15]);		
			$("#txt_18").val(resp[0][16]);		
			$("#txt_19").val(resp[0][17]);		
		    $("#txt_22").val(resp[0][18]);		
			$("#txt_22").trigger("chosen:updated"); 
			$("#txt_23").val(resp[0][19]);		
			$("#txt_23").trigger("chosen:updated"); 

			$.ajax({        
		        type: "POST",
		        dataType: 'json',        
		        url: "../carga_ubicaciones.php?tipo=0&fun=37&id="+$("#txt_23").val(),        
		        success: function(response) {         			        	
		        	$("#txt_24").empty();	        	
		        	$("#txt_24").append("<option value=''>  </option>");				
		            for (var i = 0; i < response.length; i=i+3) {       
		            	if(response[i] == resp[0][20]) {
							$("#txt_24").append("<option value ="+response[i]+" selected>"+response[i+1]+" "+response[i+2]+"</option>");				
		            	} else {
							$("#txt_24").append("<option value ="+response[i]+">"+response[i+1]+" "+response[i+2]+"</option>");				
						}
		            }   
		            $("#txt_24").trigger("chosen:updated");                                          
		        }
	    	}); 
		    $("#txt_26").val(resp[0][22]);		
		    $("#txt_25").val(resp[0][25]);		
			$("#txt_25").trigger("chosen:updated"); 
			$("#txt_20").val(resp[0][26]);		
			$("#txt_20").trigger("chosen:updated"); 
			$("#txt_21").val(resp[0][27]);		
			$("#txt_21").trigger("chosen:updated"); 
		    documentos("1");
		    /**/
	        var prov = 0;
	        var pais = 0;
	        $.ajax({/*obtnengo el id de provincia*/
		        type: "POST",		        
		        url: "../carga_ubicaciones.php?tipo=0&id="+resp[0][7]+"&fun=5",        
		        success: function(response) {         
		        	prov = response;
		        	$.ajax({/*obtnengo el id del pais*/
				        type: "POST",			        
				        url: "../carga_ubicaciones.php?tipo=0&id="+prov+"&fun=6",        
				        success: function(response) {         
				        	pais = response;						        	
				        	/*cambio los combos*/
						    $.ajax({        
						        type: "POST",
						        dataType: 'json',        
						        url: "../carga_ubicaciones.php?tipo=0&id=0&fun=1",        
						        success: function(response) {         			        	
						        	$("#txt_9").html("");
						            for (var i = 0; i < response.length; i=i+2) {            				            	
						            	if(response[i] == pais){
											$("#txt_9").append("<option value ="+response[i]+" selected>"+response[i+1]+"</option>");            																																
						            	} else {
											$("#txt_9").append("<option value ="+response[i]+">"+response[i+1]+"</option>");            																																
										}
						            }   
						            $("#txt_9").trigger("chosen:updated"); 

						            $.ajax({        
								        type: "POST",
								        dataType: 'json',        
								        url: "../carga_ubicaciones.php?tipo=0&id="+pais+"&fun=2",        
								        success: function(response) {         			        	
								        	$("#txt_10").html("");
								            for (var i = 0; i < response.length; i=i+2) {            				            	
								            	if(response[i] == prov) {
													$("#txt_10").append("<option value ="+response[i]+" selected>"+response[i+1]+"</option>");            																																
								            	} else {
													$("#txt_10").append("<option value ="+response[i]+">"+response[i+1]+"</option>");            																																
												}
								            }
								            $("#txt_10").trigger("chosen:updated"); 

								            $.ajax({        
										        type: "POST",
										        dataType: 'json',        
										        url: "../carga_ubicaciones.php?tipo=0&id="+prov+"&fun=3",        
										        success: function(response) {         			        	
										        	$("#txt_11").html("");
										            for (var i = 0; i < response.length; i=i+2) {            				            	
										            	if(response[i] == resp[0][7]) {
															$("#txt_11").append("<option value ="+response[i]+" selected>"+response[i+1]+"</option>");            																																
										            	} else {
															$("#txt_11").append("<option value ="+response[i]+">"+response[i+1]+"</option>");            																																
														}
										            }   
										            $("#txt_11").trigger("chosen:updated");                                
										        }
										    });                               
								        }
								    });		                            
						        }
						    });						    
				        }                   
				    });
		        }                   
		    });	
		} else {
			alert("Sin registros superiores");
		}		    	            
	    $("#btn_0").text("");
	    $("#btn_0").append("<span class='glyphicon glyphicon-log-in'></span> Modificar");     	            
        /**/
	});

     /*jqgrid*/   
    jQuery(function($) {
	    var grid_selector = "#table";
	    var pager_selector = "#pager";
	    
	    //cambiar el tamaño para ajustarse al tamaño de la página
	    $(window).on('resize.jqGrid', function () {
	        //$(grid_selector).jqGrid( 'setGridWidth', $("#myModal").width());	        
	        $(grid_selector).jqGrid( 'setGridWidth', $("#myModal .modal-dialog").width()-30);
	        
	    })
	    //cambiar el tamaño de la barra lateral collapse/expand
	    var parent_column = $(grid_selector).closest('[class*="col-"]');
	    $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
	        if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
	            //para dar tiempo a los cambios de DOM y luego volver a dibujar!!!
	            setTimeout(function() {
	                $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
	            }, 0);
	        }
	    })

	    jQuery(grid_selector).jqGrid({	        
	        datatype: "xml",
	        url: 'xml_proveedores.php',        
	        colNames: ['ID','DOCUMENTO','CI','NOMBRES','TIPO PROVEEDOR','TELÉFONO','CELULAR','id_ciudad','DIRECCIÓN','EMPRESA','VISITADOR','FAX','CORREO','FORMA PAGO','PRINCIPAL','CUPO CRÉDITO','SERIE COMPROBANTE','AUTORIZACIÓN SRI', 'id_grupo','id_sustento','id_comprobante','id_usuario','COMENTARIO','estado','FECHA CREACIÓN','ID_COMPRA','ID_RETENCION_FUENTE','ID_RETENCION_IVA'],
	        colModel:[      
	            {name:'txt_0',index:'id_proveedor',frozen:true,align:'left',search:false},
	            {name:'txt_1',index:'tipo_documento',frozen : true,align:'left',search:true},
	            {name:'txt_2',index:'identificacion',frozen : true,align:'left',search:true},	            
	            {name:'txt_12',index:'nombres_completos',frozen : true,align:'left',search:false},
	            {name:'txt_14',index:'tipo',frozen : true,align:'left',search:false},
	            {name:'txt_4',index:'telefono1',frozen : true,align:'left',search:false},            
	            {name:'txt_5',index:'telefono2',frozen : true,align:'left',search:false},
				{name:'txt_11',index:'id_ciudad',frozen : true,align:'left',search:false},	            	            
	            {name:'txt_15',index:'direccion',frozen : true,align:'left',search:false},
	            {name:'txt_3',index:'empresa',frozen : true,align:'left',search:false},
	            {name:'txt_13',index:'visitador',frozen : true,align:'left',search:false},
	            {name:'txt_7',index:'fax',frozen : true,align:'left',search:false},
	            {name:'txt_6',index:'correo',frozen : true,align:'left',search:false},
				{name:'txt_8',index:'forma_pago',frozen : true,align:'left',search:false},	            	            				
	            {name:'txt_16',index:'proveedor_principal',frozen : true,align:'left',search:false},

	            {name:'txt_17',index:'cupo_credito',frozen : true,align:'left',search:false},	            
	            {name:'txt_18',index:'serie_comprobante',frozen : true,align:'left',search:false},	            
	            {name:'txt_19',index:'autorizacion_sri',frozen : true,align:'left',search:false},	            
	            {name:'txt_22',index:'id',frozen : true,align:'left',search:false},	           //id grupo 
	            {name:'txt_23',index:'id_sustento',frozen : true,align:'left',search:false},	            
	            {name:'txt_24',index:'id_comprobante',frozen : true,align:'left',search:false},	            
	            {name:'id_usuario',index:'id_usuario',frozen : true,align:'left',search:false},	            
	            {name:'txt_26',index:'comentario',frozen : true,align:'left',search:false},	            
	            {name:'estado',index:'estado',frozen : true,align:'left',search:false},	            
	            {name:'fecha_creacion',index:'fecha_creacion',frozen : true,align:'left',search:false},	            
	            {name:'txt_25',index:'id_compra',frozen : true,align:'left',search:false},	            
	            {name:'txt_20',index:'id_ret_fuente',frozen : true,align:'left',search:false},	            
	            {name:'txt_21',index:'id_ret_iva',frozen : true,align:'left',search:false},	            

	        ],          
	        rowNum: 10,       
	        width:600,
	        shrinkToFit: false,
	        height:300,
	        rowList: [10,20,30],
	        pager: pager_selector,        
	        sortname: 'id_proveedor',
	        sortorder: 'asc',
	        caption: 'LISTA DE PROVEEDORES',	        
	        altRows: true,
	        multiselect: false,
	        multiboxonly: true,
	        viewrecords : true,
	        loadComplete : function() {
	            var table = this;
	            setTimeout(function(){
	                styleCheckbox(table);
	                updateActionIcons(table);
	                updatePagerIcons(table);
	                enableTooltips(table);
	            }, 0);
	        },
	        ondblClickRow: function(rowid) {     	            	            
	            var gsr = jQuery(grid_selector).jqGrid('getGridParam','selrow');                                              
            	var ret = jQuery(grid_selector).jqGrid('getRowData',gsr);       	            
            	//console.log(ret)
	            $("#txt_0").val(ret.txt_0);
	            $("#txt_1").val(ret.txt_1);
	            $("#txt_1").trigger("chosen:updated");  
	            $("#txt_2").val(ret.txt_2);
	            $("#txt_3").val(ret.txt_3);
	            $("#txt_4").val(ret.txt_4);	            
	            $("#txt_5").val(ret.txt_5);
	            $("#txt_6").val(ret.txt_6);
	            $("#txt_7").val(ret.txt_7);
	            $("#txt_8").val(ret.txt_8);	            
	            $("#txt_8").trigger("chosen:updated");          	            	            	            

	            $("#txt_12").val(ret.txt_12);
	            $("#txt_13").val(ret.txt_13);	            	            
				$("#txt_14").val(ret.txt_14);	            
	            $("#txt_14").trigger("chosen:updated");          	            	            	            	            
	            $("#txt_15").val(ret.txt_15);	            	            
	            $("#txt_16").val(ret.txt_16);	            	            
	            $("#txt_16").trigger("chosen:updated");          	            	            	            
	            $("#txt_17").val(ret.txt_17);	            	            
	            $("#txt_18").val(ret.txt_18);	            	            
	            $("#txt_19").val(ret.txt_19);	
	            $("#txt_22").val(ret.txt_22);	            	            
	            $("#txt_22").trigger("chosen:updated");          	            	            	            
	            $("#txt_23").val(ret.txt_23);	            	            
	            $("#txt_23").trigger("chosen:updated");      
	            //
	            $.ajax({        
			        type: "POST",
			        dataType: 'json',        
			        url: "../carga_ubicaciones.php?tipo=0&fun=37&id="+ret.txt_23,        
			        success: function(response) {         			        	
			        	$("#txt_24").empty();	        	
			        	$("#txt_24").append("<option value=''>  </option>");				
			            for (var i = 0; i < response.length; i=i+3) {       
			            	if(response[i] == ret.txt_24) {
								$("#txt_24").append("<option value ="+response[i]+" selected>"+response[i+1]+" "+response[i+2]+"</option>");				
			            	} else {
								$("#txt_24").append("<option value ="+response[i]+">"+response[i+1]+" "+response[i+2]+"</option>");				
							}	
			            }
			            $("#txt_24").trigger("chosen:updated");                                         
			        }
		    	}); 
	            
	            $("#txt_26").val(ret.txt_26);	            	                	            	            	            
	            $("#txt_25").val(ret.txt_25);	            	            
	            $("#txt_25").trigger("chosen:updated");      
	            $("#txt_20").val(ret.txt_20);	            	            
	            $("#txt_20").trigger("chosen:updated");      
	            $("#txt_21").val(ret.txt_21);	            	            
	            $("#txt_21").trigger("chosen:updated");      
	            documentos("1");
	            /**/
	            var prov = 0;
	            var pais = 0;
	            $.ajax({/*obtnengo el id de provincia*/
			        type: "POST",			        
			        url: "../carga_ubicaciones.php?tipo=0&id="+ret.txt_11+"&fun=5",        
			        success: function(response) {         
			        	prov = response;
			        	$.ajax({/*obtnengo el id del pais*/
					        type: "POST",			        
					        url: "../carga_ubicaciones.php?tipo=0&id="+prov+"&fun=6",        
					        success: function(response) {         
					        	pais = response;						        	
					        	/*cambio los combos*/
							    $.ajax({        
							        type: "POST",
							        dataType: 'json',        
							        url: "../carga_ubicaciones.php?tipo=0&id=0&fun=1",        
							        success: function(response) {         			        	
							        	$("#txt_9").html("");
							            for (var i = 0; i < response.length; i=i+2) {            				            	
							            	if(response[i] == pais) {
												$("#txt_9").append("<option value ="+response[i]+" selected>"+response[i+1]+"</option>");            																																
							            	} else {
												$("#txt_9").append("<option value ="+response[i]+">"+response[i+1]+"</option>");            																																
											}
							            }   
							            $("#txt_9").trigger("chosen:updated"); 

							            $.ajax({        
									        type: "POST",
									        dataType: 'json',        
									        url: "../carga_ubicaciones.php?tipo=0&id="+pais+"&fun=2",        
									        success: function(response) {         			        	
									        	$("#txt_10").html("");
									            for (var i = 0; i < response.length; i=i+2) {            				            	
									            	if(response[i] == prov){
														$("#txt_10").append("<option value ="+response[i]+" selected>"+response[i+1]+"</option>");            																																
									            	} else {
														$("#txt_10").append("<option value ="+response[i]+">"+response[i+1]+"</option>");            																																
													}
									            }   
									            $("#txt_10").trigger("chosen:updated");

									            $.ajax({        
											        type: "POST",
											        dataType: 'json',        
											        url: "../carga_ubicaciones.php?tipo=0&id="+prov+"&fun=3",        
											        success: function(response) {         			        	
											        	$("#txt_11").html("");
											            for (var i = 0; i < response.length; i=i+2) {            				            	
											            	if(response[i] == ret.txt_11){
																$("#txt_11").append("<option value ="+response[i]+" selected>"+response[i+1]+"</option>");            																																
											            	} else {
																$("#txt_11").append("<option value ="+response[i]+">"+response[i+1]+"</option>");            																																
															}
											            }   
											            $("#txt_11").trigger("chosen:updated");                                 
											        }
											    });                              
									        }
									    });		                            
							        }
							    });							    
					        }                   
					    });
			        }                   
			    });			    	            
	            $('#myModal').modal('hide'); 
	            $("#btn_0").text("");
	            $("#btn_0").append("<span class='glyphicon glyphicon-log-in'></span> Modificar");     	            
	        },
	        
	        caption: "LISTA PROVEEDORES"
	    });
		jQuery(grid_selector).jqGrid('hideCol', "txt_0");
		jQuery(grid_selector).jqGrid('hideCol', "txt_11");		
		jQuery(grid_selector).jqGrid('hideCol', "txt_25");		
		jQuery(grid_selector).jqGrid('hideCol', "txt_20");		
		jQuery(grid_selector).jqGrid('hideCol', "txt_21");		
		jQuery(grid_selector).jqGrid('hideCol', "estado");	
		jQuery(grid_selector).jqGrid('hideCol', "txt_22");	
		jQuery(grid_selector).jqGrid('hideCol', "txt_23");	
		jQuery(grid_selector).jqGrid('hideCol', "txt_24");		
		jQuery(grid_selector).jqGrid('hideCol', "id_usuario");		

	    $(window).triggerHandler('resize.jqGrid');//cambiar el tamaño para hacer la rejilla conseguir el tamaño correcto

	    function aceSwitch( cellvalue, options, cell ) {
	        setTimeout(function(){
	            $(cell) .find('input[type=checkbox]')
	            .addClass('ace ace-switch ace-switch-5')
	            .after('<span class="lbl"></span>');
	        }, 0);
	    }	    	   
	    //navButtons
	    jQuery(grid_selector).jqGrid('navGrid',pager_selector,
	    {   //navbar options
	        edit: false,
	        editicon : 'ace-icon fa fa-pencil blue',
	        add: false,
	        addicon : 'ace-icon fa fa-plus-circle purple',
	        del: false,
	        delicon : 'ace-icon fa fa-trash-o red',
	        search: true,
	        searchicon : 'ace-icon fa fa-search orange',
	        refresh: true,
	        refreshicon : 'ace-icon fa fa-refresh green',
	        view: true,
	        viewicon : 'ace-icon fa fa-search-plus grey'
	    },
	    {	        
	        recreateForm: true,
	        beforeShowForm : function(e) {
	            var form = $(e[0]);
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	            style_edit_form(form);
	        }
	    },
	    {
	        //new record form
	        //width: 700,
	        closeAfterAdd: true,
	        recreateForm: true,
	        viewPagerButtons: false,
	        beforeShowForm : function(e) {
	            var form = $(e[0]);
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
	            .wrapInner('<div class="widget-header" />')
	            style_edit_form(form);
	        }
	    },
	    {
	        //delete record form
	        recreateForm: true,
	        beforeShowForm : function(e) {
	            var form = $(e[0]);
	            if(form.data('styled')) return false;
	                
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	            style_delete_form(form);
	                
	            form.data('styled', true);
	        },
	        onClick : function(e) {
	            //alert(1);
	        }
	    },
	    {
	        recreateForm: true,
	        afterShowSearch: function(e){
	            var form = $(e[0]);
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
	            style_search_form(form);
	        },
	        afterRedraw: function(){
	            style_search_filters($(this));
	        },
	        //multipleSearch: true
	        overlay: false,
	        sopt: ['eq', 'cn'],
            defaultSearch: 'eq',            	       
	      },
	    {
	        //view record form
	        recreateForm: true,
	        beforeShowForm: function(e){
	            var form = $(e[0]);
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
	        }
	    })	    
	    function style_edit_form(form) {
	        //enable datepicker on "sdate" field and switches for "stock" field
	        form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})
	        form.find('input[name=stock]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
	                
	        //update buttons classes
	        var buttons = form.next().find('.EditButton .fm-button');
	        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
	        buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
	        buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')
	        
	        buttons = form.next().find('.navButton a');
	        buttons.find('.ui-icon').hide();
	        buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
	        buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');       
	    }

	    function style_delete_form(form) {
	        var buttons = form.next().find('.EditButton .fm-button');
	        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
	        buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
	        buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
	    }
	    
	    function style_search_filters(form) {
	        form.find('.delete-rule').val('X');
	        form.find('.add-rule').addClass('btn btn-xs btn-primary');
	        form.find('.add-group').addClass('btn btn-xs btn-success');
	        form.find('.delete-group').addClass('btn btn-xs btn-danger');
	    }

	    function style_search_form(form) {
	        var dialog = form.closest('.ui-jqdialog');
	        var buttons = dialog.find('.EditTable')
	        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
	        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
	        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
	    }
	    
	    function beforeDeleteCallback(e) {
	        var form = $(e[0]);
	        if(form.data('styled')) return false;
	        
	        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	        style_delete_form(form);
	        
	        form.data('styled', true);
	    }
	    
	    function beforeEditCallback(e) {
	        var form = $(e[0]);
	        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	        style_edit_form(form);
	    }

	    function styleCheckbox(table) {}
	    
	    function updateActionIcons(table) {}
	    
	    //replace icons with FontAwesome icons like above
	    function updatePagerIcons(table) {
	        var replacement = 
	            {
	            'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
	            'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
	            'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
	            'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
	        };
	        $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
	            var icon = $(this);
	            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
	            
	            if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
	        })
	    }

	    function enableTooltips(table) {
	        $('.navtable .ui-pg-button').tooltip({container:'body'});
	        $(table).find('.ui-pg-div').tooltip({container:'body'});
	    }

	    //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');

	    $(document).one('ajaxloadstart.page', function(e) {
	        $(grid_selector).jqGrid('GridUnload');
	        $('.ui-jqdialog').remove();
	    });
	}); 
	////////////////	 
	jQuery(function($) {
	    var grid_selector = "#table_1";
	    var pager_selector = "#pager_1";
	    
	    //cambiar el tamaño para ajustarse al tamaño de la página
	    $(window).on('resize.jqGrid', function () {
	        //$(grid_selector).jqGrid( 'setGridWidth', $("#modal_plan").width());	        
	        $(grid_selector).jqGrid( 'setGridWidth', $("#modal_plan .modal-dialog").width()-30);
	        
	    })
	    //cambiar el tamaño de la barra lateral collapse/expand
	    var parent_column = $(grid_selector).closest('[class*="col-"]');
	    $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
	        if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
	            //para dar tiempo a los cambios de DOM y luego volver a dibujar!!!
	            setTimeout(function() {
	                $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
	            }, 0);
	        }
	    })

	    jQuery(grid_selector).jqGrid({	        
	        datatype: "xml",
	        url: '../grupos/xml_plan.php',        	        
	        colNames: ['ID','CÓDIGO','CUENTA','GRUPO'],
	        colModel:[      
            	{name:'id_plan',index:'id_plan',frozen:true,align:'left',search:false,editable_1: true},            	
            	{name:'codigo_cuenta',index:'codigo_cuenta',frozen:true,align:'left',search:true,editable: true, editrules: {required: true},editoptions:{
            		dataInit:function (element,response){
            			$(element).keyup(function() {            				            				
            				var pattern = new RegExp("^[0-9.]{1,}[.]{1}$");        
					        if($(this).val() != '' && pattern.test($(this).val())) {            					        	
					            $("#FormError").css("display","none");
					            $("#FormError").children().text("");
					        } else {					            					            
					        	$("#FormError").css("display","table-row");
					            $("#FormError").children().text("Formato Requerido: 1.");
					        }  
            			});            			
            		}
            	}},
            	{name:'nombre_cuenta',index:'nombre_cuenta',frozen:true,align:'left',search:true,editable: true,editrules: {required: true}},            	            	
            	{name:'grupo_cuenta',index:'grupo_cuenta', width:90, editable: true,edittype:"select",editoptions:{value:"G:Grupo;M:Movimiento"}},
            ],
           	rowNum: 10,       
	        width:600,
	        shrinkToFit: true,
	        height:200,
	        rowList: [10,20,30],
	        pager: pager_selector,        
	        sortname: 'id_plan',
	        sortorder: 'asc',
	        caption: 'Lista de Grupos',	        
	        editurl:'../plan_cuentas/plan_grid.php',
	        altRows: true,
	        multiselect: false,
	        multiboxonly: true,
	        viewrecords: true,
	        loadComplete: function() {
	            var table = this;
	            setTimeout(function(){
	                styleCheckbox(table);
	                updateActionIcons(table);
	                updatePagerIcons(table);
	                enableTooltips(table);
	            }, 0);
	        },
	        ondblClickRow: function(rowid) {
	            var gsr = jQuery(grid_selector).jqGrid('getGridParam','selrow');
            	var ret = jQuery(grid_selector).jqGrid('getRowData',gsr);
				$("#txt_25").val(ret.id_plan);
				$("#txt_25").trigger("chosen:updated");    
				$("#modal_plan").hide();				
	        },	        
	        caption: "PLAN DE CUENTRAS"
	    });
		jQuery(grid_selector).jqGrid('hideCol', "id_plan");
	    $(window).triggerHandler('resize.jqGrid');//cambiar el tamaño para hacer la rejilla conseguir el tamaño correcto
	    function aceSwitch( cellvalue, options, cell ) {
	        setTimeout(function(){
	            $(cell) .find('input[type=checkbox]')
	            .addClass('ace ace-switch ace-switch-5')
	            .after('<span class="lbl"></span>');
	        }, 0);
	    }	    	   
	    //navButtons
	    jQuery(grid_selector).jqGrid('navGrid',pager_selector,
	    {   //navbar options
	        edit: true,
	        editicon : 'ace-icon fa fa-pencil blue',
	        add: true,
	        addicon : 'ace-icon fa fa-plus-circle purple',
	        del: false,
	        delicon : 'ace-icon fa fa-trash-o red',
	        search: true,
	        searchicon : 'ace-icon fa fa-search orange',
	        refresh: true,
	        refreshicon : 'ace-icon fa fa-refresh green',
	        view: true,
	        viewicon : 'ace-icon fa fa-search-plus grey'
	    },
	    {	        
	    	jqModal:true,
	    	width: 500,	        
	        closeAfterEdit : true,
    		reloadAfterSubmit:true,
	        recreateForm: true,
	        overlay: false,   
			beforeShowForm : function(e) {
				var form = $(e[0]);
				form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
				style_edit_form(form);
			},
	        afterSubmit: function (response) {
	        	if(response.responseText == 0) {
	        		$.gritter.add({
						title: 'Mensaje',
						text: 'Registro Guardado correctamente <i class="ace-icon fa fa-spinner fa-spin green bigger-125"></i>',
						time: 1000				
					});
	        		return [true,"",""];
	        	} else {
	        		if(response.responseText == 1) {	
	        			$("#codigo_cuenta").val("");
	        			return [false,"Error.. Este código ya existe"];
		        	}	
	        	}
	        }, 
	        onClose: function() {
                alert('Hi ^_^');
            }   
	    },
	    {
	        //new record form,
	        //width: 700,
	        closeAfterAdd: true,
	        recreateForm: true,	  	        
	        viewPagerButtons: false,	     
	        jqModal:true,
	        overlay: false,   
	        beforeShowForm : function(e) {
	            var form = $(e[0]);	            
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
	            .wrapInner('<div class="widget-header" />')
	            style_edit_form(form);	            
	        },	    
	        afterSubmit: function (response) {
	        	if(response.responseText == 0) {
	        		$.gritter.add({
						title: 'Mensaje',
						text: 'Registro Guardado correctamente <i class="ace-icon fa fa-spinner fa-spin green bigger-125"></i>',
						time: 1000				
					});
	        		plan_cuentas();	        		
	        		return true;
	        	} else {
	        		if(response.responseText == 1) {	
	        			$("#codigo_cuenta").val("");
	        			return [false,"Error.. Este código ya existe"];
		        	}	
	        	}
	        },    
	    },
	    {
	        //delete record form
	        recreateForm: true,	        
	        beforeShowForm : function(e) {
	            var form = $(e[0]);
	            if(form.data('styled')) return false;
	                
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	            style_delete_form(form);
	                
	            form.data('styled', true);
	        },
	        onClick : function(e) {
	            //alert(1);
	        }
	    },
	    {
	        recreateForm: true,
	        afterShowSearch: function(e){
	            var form = $(e[0]);
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
	            style_search_form(form);
	        },
	        afterRedraw: function(){
	            style_search_filters($(this));
	        }
	        ,
	        //multipleSearch: true
	        //overlay: false,
	        jqModal:false,
	        sopt: ['eq', 'cn'],
            defaultSearch: 'eq',            	       
	    },
	    {
	        //view record form
	        recreateForm: true,
	        beforeShowForm: function(e) {
	            var form = $(e[0]);	            
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
	        }
	    })	    
	    function style_edit_form(form) {
	        //enable datepicker on "sdate" field and switches for "stock" field
	        form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})	        
	        form.find('input[name=stock]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
	        //don't wrap inside a label element, the checkbox value won't be submitted (POST'ed)
	        //.addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');	                
	        //update buttons classes
	        var buttons = form.next().find('.EditButton .fm-button');
	        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
	        buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
	        buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')
	        
	        buttons = form.next().find('.navButton a');
	        buttons.find('.ui-icon').hide();
	        buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
	        buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');       
	    }

	    function style_delete_form(form) {
	        var buttons = form.next().find('.EditButton .fm-button');
	        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
	        buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
	        buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
	    }
	    
	    function style_search_filters(form) {
	        form.find('.delete-rule').val('X');
	        form.find('.add-rule').addClass('btn btn-xs btn-primary');
	        form.find('.add-group').addClass('btn btn-xs btn-success');
	        form.find('.delete-group').addClass('btn btn-xs btn-danger');
	    }
	    function style_search_form(form) {
	        var dialog = form.closest('.ui-jqdialog');
	        var buttons = dialog.find('.EditTable')
	        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
	        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
	        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
	    }
	    
	    function beforeDeleteCallback(e) {
	        var form = $(e[0]);
	        if(form.data('styled')) return false;
	        
	        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	        style_delete_form(form);
	        
	        form.data('styled', true);
	    }
	    
	    function beforeEditCallback(e) {
	        var form = $(e[0]);
	        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	        style_edit_form(form);
	    }

	    function styleCheckbox(table) { }
	    
	    function updateActionIcons(table) { }
	    
	    //replace icons with FontAwesome icons like above
	    function updatePagerIcons(table) {
	        var replacement = 
	            {
	            'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
	            'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
	            'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
	            'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
	        };
	        $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
	            var icon = $(this);
	            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
	            
	            if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
	        })
	    }

	    function enableTooltips(table) {
	        $('.navtable .ui-pg-button').tooltip({container:'body'});
	        $(table).find('.ui-pg-div').tooltip({container:'body'});
	    }

	    //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');

	    $(document).one('ajaxloadstart.page', function(e) {
	        $(grid_selector).jqGrid('GridUnload');
	        $('.ui-jqdialog').remove();
	    });
	});
	//////////
	jQuery(function($) {
	    var grid_selector = "#table_2";
	    var pager_selector = "#pager_2";
	    
	    //cambiar el tamaño para ajustarse al tamaño de la página
	    $(window).on('resize.jqGrid', function () {
	        //$(grid_selector).jqGrid( 'setGridWidth', $("#modal_retenciones").width());	        
	        $(grid_selector).jqGrid( 'setGridWidth', $("#modal_retenciones .modal-dialog").width()-30);
	        
	    })
	    //cambiar el tamaño de la barra lateral collapse/expand
	    var parent_column = $(grid_selector).closest('[class*="col-"]');
	    $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
	        if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
	            //para dar tiempo a los cambios de DOM y luego volver a dibujar!!!
	            setTimeout(function() {
	                $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
	            }, 0);
	        }
	    })

	    jQuery(grid_selector).jqGrid({	        
	        datatype: "xml",
	        url: '../retencion_fuente/xml_retenciones.php',        	        
	        colNames: ['ID','CÓDIGO','FORMULARIO','PORCENTAJE','DESCRIPCIÓN','PLAN CUENTAS','estado','FECHA'],
	        colModel:[      
            	{name:'id_retencion',index:'id_retencion',frozen:true,align:'left',search:false,editable: true},            	
            	{name:'codigo_anexo',index:'codigo_anexo',frozen:true,align:'left',search:true,editable: true, editrules: {required: true}},
            	{name:'formulario_103',index:'formulario_103',frozen:true,align:'left',search:true,editable: true,editrules: {required: true}},
            	{name:'porcentaje',index:'porcentaje',frozen:true,align:'left',search:true,editable: true,editrules: {required: true}},
            	{name:'descripcion',index:'descripcion',frozen:true,align:'left',search:true,editable: true,editrules: {required: true}},
            	{name:'id_plan',index:'id_plan',width:170, editable:true,sortable:true,edittype:'select',editoptions:{value:cargar_plan(),dataInit: function(elem) {
        			$(elem).width(170);  
    			}}},
            	{name:'estado',index:'estado',frozen:true,align:'left',search:true,editable: true},
            	{name:'fecha_creacion',index:'fecha_creacion',frozen:true,align:'left',search:true,editable: false},
			],
           	rowNum: 10,       
	        width:600,
	        height:200,
	        rowList: [10,20,30],
	        pager: pager_selector,        
	        sortname: 'id_plan',
	        sortorder: 'asc',
	        caption: 'Lista de Rentenciones',	        
	        editurl:'../retencion_fuente/retenciones_grid.php',
	        altRows: true,
	        multiselect: false,
	        multiboxonly: true,
	        viewrecords : true,
	        loadComplete : function() {
	            var table = this;
	            setTimeout(function(){
	                styleCheckbox(table);
	                updateActionIcons(table);
	                updatePagerIcons(table);
	                enableTooltips(table);
	            }, 0);
	        },
	        ondblClickRow: function(rowid) {
	            var gsr = jQuery(grid_selector).jqGrid('getGridParam','selrow');
            	var ret = jQuery(grid_selector).jqGrid('getRowData',gsr);
            	
            	if(boton_click == 'txt_20') {
            		$("#txt_20").val(ret.id_retencion);
            		$("#txt_20").trigger("chosen:updated");                                                      		
            	} else {
            		$("#txt_21").val(ret.id_retencion);
            		$("#txt_21").trigger("chosen:updated");       	
            	}            	            	
				
				$("#modal_retenciones").hide();				
	        },	        
	        caption: "RETENCIONES"
	    });
		jQuery(grid_selector).jqGrid('hideCol', "id_retencion");
		//jQuery(grid_selector).jqGrid('hideCol', "id_plan");
		jQuery(grid_selector).jqGrid('hideCol', "estado");

	    $(window).triggerHandler('resize.jqGrid');//cambiar el tamaño para hacer la rejilla conseguir el tamaño correcto
	    function aceSwitch( cellvalue, options, cell ) {
	        setTimeout(function(){
	            $(cell) .find('input[type=checkbox]')
	            .addClass('ace ace-switch ace-switch-5')
	            .after('<span class="lbl"></span>');
	        }, 0);
	    }	    	   
	    //navButtons
	    jQuery(grid_selector).jqGrid('navGrid',pager_selector,
	    {   //navbar options
	        edit: true,
	        editicon : 'ace-icon fa fa-pencil blue',
	        add: true,
	        addicon : 'ace-icon fa fa-plus-circle purple',
	        del: false,
	        delicon : 'ace-icon fa fa-trash-o red',
	        search: true,
	        searchicon : 'ace-icon fa fa-search orange',
	        refresh: true,
	        refreshicon : 'ace-icon fa fa-refresh green',
	        view: true,
	        viewicon : 'ace-icon fa fa-search-plus grey'
	    },
	    {	        
	    	jqModal:true,
	    	width: 500,	        
	        closeAfterEdit : true,
    		reloadAfterSubmit:true,
	        recreateForm: true,
	        overlay: false,   
			beforeShowForm : function(e) {
				var form = $(e[0]);
				form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
				style_edit_form(form);
			},
	        afterSubmit: function (response) {
	        	if(response.responseText == 0) {
	        		$.gritter.add({
						title: 'Mensaje',
						text: 'Registro Guardado correctamente <i class="ace-icon fa fa-spinner fa-spin green bigger-125"></i>',
						time: 1000				
					});
	        		return [true,"",""];
	        	} else {
	        		if(response.responseText == 1) {	
	        			$("#codigo_cuenta").val("");
	        			return [false,"Error.. Este código ya existe"];
		        	}	
	        	}
	        }, 
	        onClose: function() {
                
            }   
	    },
	    {
	        //new record form,
	        //width: 700,
	        closeAfterAdd: true,
	        recreateForm: true,	  	        
	        viewPagerButtons: false,	     
	        jqModal:true,
	        overlay: false,   
	        beforeShowForm : function(e) {
	            var form = $(e[0]);	            
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
	            .wrapInner('<div class="widget-header" />')
	            style_edit_form(form);	            
	        },	    
	        afterSubmit: function (response) {
	        	if(response.responseText == 0) {
	        		$.gritter.add({
						title: 'Mensaje',
						text: 'Registro Guardado correctamente <i class="ace-icon fa fa-spinner fa-spin green bigger-125"></i>',
						time: 1000				
					});
	        		codigos_retencion();	        		
	        		return true;
	        	} else {
	        		if(response.responseText == 1) {	
	        			$("#codigo_anexo").val("");
	        			return [false,"Error.. Este código ya existe"];
		        	}	
	        	}
	        },    
	    },
	    {
	        //delete record form
	        recreateForm: true,	        
	        beforeShowForm : function(e) {
	            var form = $(e[0]);
	            if(form.data('styled')) return false;
	                
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	            style_delete_form(form);
	                
	            form.data('styled', true);
	        },
	        onClick : function(e) {
	            //alert(1);
	        }
	    },
	    {
	        recreateForm: true,
	        afterShowSearch: function(e){
	            var form = $(e[0]);
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
	            style_search_form(form);
	        },
	        afterRedraw: function(){
	            style_search_filters($(this));
	        }
	        ,
	        //multipleSearch: true
	        //overlay: false,
	        jqModal:false,
	        sopt: ['eq', 'cn'],
            defaultSearch: 'eq',            	       
	    },
	    {
	        //view record form
	        recreateForm: true,
	        beforeShowForm: function(e){
	            var form = $(e[0]);	            
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
	        }
	    })	    
	    function style_edit_form(form) {
	        //enable datepicker on "sdate" field and switches for "stock" field
	        form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})	        
	        form.find('input[name=stock]').addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
	        //don't wrap inside a label element, the checkbox value won't be submitted (POST'ed)
	        //.addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');	                
	        //update buttons classes
	        var buttons = form.next().find('.EditButton .fm-button');
	        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
	        buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
	        buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')
	        
	        buttons = form.next().find('.navButton a');
	        buttons.find('.ui-icon').hide();
	        buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
	        buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');       
	    }

	    function style_delete_form(form) {
	        var buttons = form.next().find('.EditButton .fm-button');
	        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
	        buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
	        buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
	    }
	    
	    function style_search_filters(form) {
	        form.find('.delete-rule').val('X');
	        form.find('.add-rule').addClass('btn btn-xs btn-primary');
	        form.find('.add-group').addClass('btn btn-xs btn-success');
	        form.find('.delete-group').addClass('btn btn-xs btn-danger');
	    }
	    function style_search_form(form) {
	        var dialog = form.closest('.ui-jqdialog');
	        var buttons = dialog.find('.EditTable')
	        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
	        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
	        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
	    }
	    
	    function beforeDeleteCallback(e) {
	        var form = $(e[0]);
	        if(form.data('styled')) return false;
	        
	        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	        style_delete_form(form);
	        
	        form.data('styled', true);
	    }
	    
	    function beforeEditCallback(e) {
	        var form = $(e[0]);
	        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	        style_edit_form(form);
	    }

	    function styleCheckbox(table) { }
	    
	    function updateActionIcons(table) { }
	    
	    //replace icons with FontAwesome icons like above
	    function updatePagerIcons(table) {
	        var replacement = 
	            {
	            'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
	            'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
	            'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
	            'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
	        };
	        $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
	            var icon = $(this);
	            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
	            
	            if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
	        })
	    }

	    function enableTooltips(table) {
	        $('.navtable .ui-pg-button').tooltip({container:'body'});
	        $(table).find('.ui-pg-div').tooltip({container:'body'});
	    }

	    //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');

	    $(document).one('ajaxloadstart.page', function(e) {
	        $(grid_selector).jqGrid('GridUnload');
	        $('.ui-jqdialog').remove();
	    });
	});
    /**/  
	$('#txt_17').ace_spinner({value:0,min:0,max:900050,step:1, btn_up_class:'btn btn-success' , btn_down_class:'btn btn-danger'});	
	$('#form_proveedores a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		$(window)
		.off('resize.chosen')
		.on('resize.chosen', function() {
			$('.chosen-select').each(function() {
				var $this = $(this);
				$this.next().css({'width': $this.parent().width()});
			});		
			$("#txt_17").css({'width': $("#txt_18").parent().width() - 22});
		}).trigger('resize.chosen');
	});	

	//////////////sustentos comprobantes
	$.ajax({        
        type: "POST",
        dataType: 'json',        
        url: "../carga_ubicaciones.php?tipo=0&fun=36",        
        success: function(response) {         			        	
        	$("#txt_23").empty(); 
        	$("#txt_23").append("<option value=''>  </option>");				       	
            for (var i = 0; i < response.length; i=i+3) {            				            	            	
				$("#txt_23").append("<option value ="+response[i]+">"+response[i+1]+" "+response[i+2]+"</option>");				
            }   
            $("#txt_23").trigger("chosen:updated");                                          
        }
    });

    $("#txt_23").on('change',function() {        
    	$.ajax({        
	        type: "POST",
	        dataType: 'json',        
	        url: "../carga_ubicaciones.php?tipo=0&fun=37&id="+$("#txt_23").val(),        
	        success: function(response) {         			        	
	        	$("#txt_24").empty();	        	
	        	$("#txt_24").append("<option value=''>  </option>");				
	            for (var i = 0; i < response.length; i=i+3) {            				            	            	
					$("#txt_24").append("<option value ="+response[i]+">"+response[i+1]+" "+response[i+2]+"</option>");				
	            }   
	            $("#txt_24").trigger("chosen:updated");                                          
	        }
	    });	   
    });

    $.ajax({        
        type: "POST",
        dataType: 'json',        
        url: "../carga_ubicaciones.php?tipo=0&fun=38",        
        success: function(response) {         			        	
        	$("#txt_22").empty();  
        	$("#txt_22").append("<option value=''>  </option>");				
            for (var i = 0; i < response.length; i=i+3) {            				            	            	
				$("#txt_22").append("<option value ="+response[i]+">"+response[i+2]+"</option>");				
            }   
            $("#txt_22").trigger("chosen:updated");                                          
        }
    });	    
    //////////////plan cuentas////
    plan_cuentas();
    codigos_retencion();
}

function cargar_plan() {
	$.ajax({        
        type: "GET",        
        async: false,      
        url: "../carga_ubicaciones.php?tipo=0&fun=41",        
        success: function(response) {         			        	        	
            plan = response;          
        }        
    });	
    return plan;	
}

function plan_cuentas() {
	$.ajax({        
        type: "POST",
        dataType: 'json',        
        url: "../carga_ubicaciones.php?tipo=0&fun=39",        
        success: function(response) {         		        	        	
        	$("#txt_25").empty();          	
        	$("#txt_25").append("<option value=''>  </option>");				
            for (var i = 0; i < response.length; i=i+3) {            				            	            	
				$("#txt_25").append("<option value ="+response[i]+">"+response[i+1]+" "+response[i+2]+"</option>");				
            }   
            $("#txt_25").trigger("chosen:updated");                                          
        }
    });	
}

function codigos_retencion() {
	$.ajax({        
        type: "POST",
        dataType: 'json',        
        url: "../carga_ubicaciones.php?tipo=0&fun=40",        
        success: function(response) {         			        	
        	$("#txt_20").empty();
        	$("#txt_21").empty();
        	$("#txt_20").append("<option value=''>  </option>");				
        	$("#txt_21").append("<option value=''>  </option>");				
            for (var i = 0; i < response.length; i=i+3) {            				            	            	
				$("#txt_20").append("<option value ="+response[i]+">"+response[i+1]+" "+response[i+2]+"</option>");				
				$("#txt_21").append("<option value ="+response[i]+">"+response[i+1]+" "+response[i+2]+"</option>");				
            }   
            $("#txt_20").trigger("chosen:updated");                                          
            $("#txt_21").trigger("chosen:updated");                                          
        }
    });	
}
/*---------------------------------*/

