$(document).on("ready",inicio);

/*--*/
function inicio () {
	function recargar() {
	  setTimeout(function() {
	    location.reload();
	  }, 2000);  
	}
	
	// consultar usuarios
	$("#txt_1").on("keypress",function(e) {
		if(e.keyCode == 13) { // tecla del alt para el entrer poner 13
			if($('#txt_1').val() == '') {
			$.gritter.add({
				title: 'Error... Ingrese una Identificación',
				class_name: 'gritter-error gritter-center',
				time: 1000,
			});
			$('#txt_1').focus();
			} else {
				$.ajax({
	                type: "POST",
	                url: "http://coatl.vadowservice.com/data/usuarios/app.php",          
	                data:{consulta_cedula:'consulta_cedula',txt_ruc:$("#txt_1").val()},
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
							
							$('#txt_1').focus();
							$('#txt_1').val("");	
		            	} else {
		            		if(data.datosPersona.valid == true) {
			            		$('#txt_2').val(data.datosPersona.name);
			            		//$('#ciudad').val(data.datosPersona.residence);
			            		$('#txt_12').val(data.datosPersona.streets);
			            	}	 		
		            	}
	                }
	            });
			}
		}
	});
	// fin

	$("#reload").click(function() {
		actualizar_form();
	});
	$("input:not([readonly='readonly']):text:visible:first").focus();   
	///////////varias validaciones//////////////}
	//editables on first profile page
	$.fn.editable.defaults.mode = 'inline';
	$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';    				
	
	// *** editable avatar *** //
	try {
		try {
			document.createElement('IMG').appendChild(document.createElement('B'));
		} catch(e) {
			Image.prototype.appendChild = function(el){}
		}

		var last_gritter
		$('#avatar').editable({
			type: 'image',
			name: 'avatar',
			value: null,
			image: {
				//specify ace file input plugin's options here
				btn_choose: 'Cambiar Imagen',
				droppable: true,
				maxSize: 510000,//~100Kb

				//and a few extra ones here
				name: 'avatar',//put the field name here as well, will be used inside the custom plugin
				on_error : function(error_type) {//on_error function will be called when the selected file has a problem
					if(last_gritter) $.gritter.remove(last_gritter);
					if(error_type == 1) {//file format error
						last_gritter = $.gritter.add({
							title: 'El archivo no es una imagen!',
							text: 'Por favor, elija un jpg | jpeg | imagen png!',
							class_name: 'gritter-error gritter-center'
						});
					} else if(error_type == 2) {//file size rror
						last_gritter = $.gritter.add({
							title: 'Archivo muy grande!',
							text: 'Tamaño de la imagen no debe superar los 100Kb!',
							class_name: 'gritter-error gritter-center'
						});
					}
					else {//other error
					}
				},
				on_success : function() {
					$.gritter.removeAll();
				}
			},
		    url: function(params) {
				var deferred = new $.Deferred

				var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();

				if(!value || value.length == 0) {
					deferred.resolve();
					return deferred.promise();
				}

				//dummy upload
				setTimeout(function(){
					if("FileReader" in window) {
						//for browsers that have a thumbnail of selected image						
						var thumb = $('#avatar').next().find('img').data('thumb');
						if(thumb) $('#avatar').get(0).src = thumb;
					}
					
					deferred.resolve({'status':'OK'});

					if(last_gritter) $.gritter.remove(last_gritter);
					last_gritter = $.gritter.add({
						title: 'Imagen Actualizada!',
						text: 'Carga en servidor puede ser fácilmente implementado . Un ejemplo de trabajo se incluye con la plantilla.',
						class_name: 'gritter-info gritter-center'
					});
					
				 } , parseInt(Math.random() * 800 + 800))

				return deferred.promise();
				
				// ***END OF UPDATE AVATAR HERE*** //
			},
			
			success: function(response, newValue) {				
			}
		})
	}catch(e) {}
	////////////////////////////////////////////	
	
 	/*------------*/	
	$('.chosen-select').chosen({allow_single_deselect:true,}); 
	// stilo select2
	$(".select2").css({
	    'width': '100%',
	    allow_single_deselect: true,
	    no_results_text: "No se encontraron resultados",
	    allowClear: true,
	});
	// fin
	$(window)
	.off('resize.chosen')
	.on('resize.chosen', function() {
		$('.chosen-select').each(function() {
			 var $this = $(this);
			 $this.next().css({'width': $this.parent().width()});
		})
	}).trigger('resize.chosen');
	//resize chosen on sidebar collapse/expand
	$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
		if(event_name != 'sidebar_collapsed') return;
		$('.chosen-select').each(function() {
			 var $this = $(this);
			 $this.next().css({'width': $this.parent().width()});
		})
	});
	
	$('#btn_guardar_cargo').on('click', function() {
		$.ajax({
		    url: "usuario.php",
		    data: {guardar_cargo:'guardar_cargo', txt_cargo: $("#txt_cargo").val()}, 	    	    	    
		    type: "POST",				
		    success: function(data) {	    	
		    	if(data == 2) {	
		    		$("#txt_cargo").val("");
		    		$.gritter.add({
            			title: 'Datos Agregados Correctamente',
            			class_name: 'gritter-success gritter-center',
            			time: 2000,
            		});
		    		$("#txt_4").html("");
		    		$('#modal_cargo').modal('hide');
		    		
		    		$.ajax({          
                        type: "POST",
                        dataType: 'json',        
                        url: "../carga_ubicaciones.php?tipo=0&id=0&fun=4",        
                        success: function(response) {         
                            for (var i = 0; i < response.length; i=i+2) {            	
                				$("#txt_4").append("<option value ="+response[i]+">"+response[i+1]+"</option>");            																																
                            }   
                            $("#txt_4").trigger("chosen:updated");                              
                        }                   
                    });
		    	} else {
		    		if(data == 1) {	    		
		    			alert('El Cargo ya existe. Ingrese otra')	;
		    			$("#txt_cargo").val("");
		    			$("#txt_cargo").focus();
		    		}
		    	}
			}		
		});
	});

	$('#btn_guardar_pais').on('click', function() {
		$.ajax({
		    url: "usuario.php",
		    data: {guardar_pais:'guardar_pais', txt_pais: $("#txt_pais").val()}, 	    	    	    
		    type: "POST",				
		    success: function(data) {	    	
		    	if(data == 2) {	
		    		$("#txt_9").html("");
		    		$("#txt_10").html("");
		    		$("#txt_11").html("");
		    		$("#cmb_pais").html("");
		    		$("#cmb_pais2").html("");	        		
		    		$.gritter.add({
            			title: 'Datos Agregados Correctamente',
            			class_name: 'gritter-success gritter-center',
            			time: 2000,
            		});
		    		$("#txt_pais").val("");
		    		$('#modal_pais').modal('hide');
		    		carga_ubicaciones("txt_9","txt_10","txt_11");//pais provincia ciudad 
		    		carga_ubicaciones("cmb_pais");
		    		carga_ubicaciones("cmb_pais2");    		
		    	} else {
		    		if(data == 1) {	    		
		    			alert('El País ya existe. Ingrese otra')	;
		    			$("#txt_pais").val("");
		    			$("#txt_pais").focus();
		    		}
		    	}
			}		
		});
	});

	$('#btn_guardar_provincia').on('click', function() {
		$.ajax({
		    url: "usuario.php",
		    data: {guardar_provincia:'guardar_provincia', txt_provincia: $("#txt_provincia").val(), id: $("#cmb_pais").val()}, 	    	    	    
		    type: "POST",				
		    success: function(data) {	    	
		    	if(data == 2) {
		    		$("#txt_9").html("");
		    		$("#txt_10").html("");
		    		$("#txt_11").html("");  
		    		$("#cmb_pais2").html("");
		    		$("#cmb_provincia").html("");  		
		    		$.gritter.add({
            			title: 'Datos Agregados Correctamente',
            			class_name: 'gritter-success gritter-center',
            			time: 2000,
            		});
		    		$("#txt_provincia").val("");
		    		$('#modal_provincia').modal('hide');
		    		carga_ubicaciones("txt_9","txt_10","txt_11");//pais provincia ciudad
					carga_ubicaciones("cmb_pais2","cmb_provincia");  	    		
		    	} else {
		    		if(data == 1) {	    		
		    			alert('La Provincia ya existe. Ingrese otra')	;
		    			$("#txt_provincia").val("");
		    			$("#txt_provincia").focus();
		    		}
		    	}
			}		
		});
	});

	$('#btn_guardar_ciudad').on('click', function() {
		$.ajax({
		    url: "usuario.php",
		    data: {guardar_ciudad:'guardar_ciudad', txt_ciudad: $("#txt_ciudad").val(), id: $("#cmb_provincia").val()}, 	    	    	    
		    type: "POST",				
		    success: function(data) {	    	
		    	if(data == 2) {  
		    		$("#txt_9").html("");
		    		$("#txt_10").html("");
		    		$("#txt_11").html("");
		    		$("#cmb_pais2").html("");
		    		$("#cmb_provincia").html(""); 	 		
		    		$.gritter.add({
            			title: 'Datos Agregados Correctamente',
            			class_name: 'gritter-success gritter-center',
            			time: 2000,
            		});
		    		$("#txt_ciudad").val("");
		    		$('#modal_ciudad').modal('hide');
		    		carga_ubicaciones("txt_9","txt_10","txt_11");//pais provincia ciudad
					carga_ubicaciones("cmb_pais2","cmb_provincia");  	    		
		    	} else {
		    		if(data == 1) {	    		
		    			alert('La Ciudad ya existe. Ingrese otra')	;
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

	/*cargar el select de cargos*/
    $.ajax({          
        type: "POST",
        dataType: 'json',        
        url: "../carga_ubicaciones.php?tipo=0&id=0&fun=4",        
        success: function(response) {         
            for (var i = 0; i < response.length; i=i+2) {            	
				$("#txt_4").append("<option value ="+response[i]+">"+response[i+1]+"</option>");            																																
            }   
            $("#txt_4").trigger("chosen:updated");                              
        }                   
    }); 
    /*---*/
	carga_ubicaciones("txt_9","txt_10","txt_11");//pais provincia ciudad
	$("#txt_9").change(function() {
		change_pais("txt_9","txt_10","txt_11");
	});

	$("#txt_10").change(function() {
		change_provincia("txt_9","txt_10","txt_11");
	});

	//$("#txt_1").on("keyup",function() {		
	//	if($("#form-field-checkbox").prop("checked"))
	//		ci("txt_1","ON");
	//	else
	//		ci("txt_1","OFF");
	//});	

	$("#form-field-checkbox").click(function() {
		if($("#form-field-checkbox").prop("checked")) {
			$("#txt_1").val("");
			$("#txt_1").focus();
			$("#txt_1").prop("maxlength","30");
		} else {
			$("#txt_1").val("");
			$("#txt_1").focus();
			$("#txt_1").prop("maxlength","10");
		}
	})

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

	/*-----*/
	$("#txt_1").keypress(ValidNum);
	$("#txt_2").keypress(soloLetras);
	$("#btn_0").on("click",guardar);	
	$("#btn_1").on("click",limpiar_form);
	$("#btn_2").on("click",actualizar_form);

	$("#btn_4").on("click",function () {		
		var resp = "";		
		resp =atras($("#txt_o").val(),"usuario","secuencia.php");		
		if(resp[0] != false) {
			$("#txt_o").val(resp[0][0]);
			$("#txt_1").val(resp[0][1]);
			$("#txt_2").val(resp[0][2]);
			$("#txt_3").val(resp[0][3]);
			$("#txt_7").val(resp[0][4]);		
			$("#txt_12").val(resp[0][7]);
			$("#txt_8").val(resp[0][8]);
			$("#txt_13").val(resp[0][9]);		
			$("#txt_13").val(resp[0][9]);
			$("#avatar").attr("src","img/"+resp[0][13]);

			if(resp[0][14] == "ON") {
		    	$("#form-field-checkbox").prop("checked",true);
		    } else {
		    	$("#form-field-checkbox").prop("checked",false);
		    }	    
		    $("#txt_5").val(resp[0][15]);
		    $("#txt_6").val(resp[0][15]);
		    $("#txt_4").val(resp[0][10]);
		    $("#txt_4").trigger("chosen:updated");
		    /**/
	        var prov = 0;
	        var pais = 0;
	        $.ajax({/*obtnengo el id de provincia*/
		        type: "POST",		        
		        url: "../carga_ubicaciones.php?tipo=0&id="+resp[0][5]+"&fun=5",        
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
										            	if(response[i] == resp[0][5]) {
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
        /**/
	});

	$("#btn_5").on("click",function () {		
		var resp = "";		
		resp =adelante($("#txt_o").val(),"usuario","secuencia.php");		
		if(resp[0] != false){
			$("#txt_o").val(resp[0][0]);
			$("#txt_1").val(resp[0][1]);
			$("#txt_2").val(resp[0][2]);
			$("#txt_3").val(resp[0][3]);
			$("#txt_7").val(resp[0][4]);		
			$("#txt_12").val(resp[0][7]);
			$("#txt_8").val(resp[0][8]);
			$("#txt_13").val(resp[0][9]);		
			$("#txt_13").val(resp[0][9]);
			$("#avatar").attr("src","img/"+resp[0][13]);	
			if(resp[0][14] == "ON") {
		    	$("#form-field-checkbox").prop("checked",true);
		    } else {
		    	$("#form-field-checkbox").prop("checked",false);
		    }

		    $("#txt_5").val(resp[0][15]);
		    $("#txt_6").val(resp[0][15]);
		    $("#txt_4").val(resp[0][10]);
		    $("#txt_4").trigger("chosen:updated");
		    /**/
	        var prov = 0;
	        var pais = 0;
	        $.ajax({/*obtnengo el id de provincia*/
		        type: "POST",		        
		        url: "../carga_ubicaciones.php?tipo=0&id="+resp[0][5]+"&fun=5",        
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
										            	if(response[i] == resp[0][5]){
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
	        url: 'xml_usuario.php',        
	        colNames: ['ID','CI','NOMBRES','TELÉFONO','CELULAR','id_ciudad','CIUDAD','DIRECCIÓN','CORREO','USUARIO','id_cargo','CARGO','estado','imagen','extranjero','clave'],
	        colModel:[      
	            {name:'txt_o',index:'txt_o',frozen:true,align:'left',search:false},
	            {name:'txt_1',index:'identificacion',frozen : true,align:'left',search:true},
	            {name:'txt_2',index:'nombres_completos',frozen : true,align:'left',search:true},
	            {name:'txt_3',index:'txt_3',frozen : true,align:'left',search:false},
	            {name:'txt_7',index:'txt_7',frozen : true,align:'left',search:false},
	            {name:'txt_11',index:'txt_11',frozen : true,align:'left',search:false},            
	            {name:'nombre_ciudad',index:'nombre_ciudad',frozen : true,align:'left',search:false},
	            {name:'txt_12',index:'txt_12',frozen : true,align:'left',search:false},
	            {name:'txt_8',index:'txt_8',frozen : true,align:'left',search:false},
	            {name:'txt_13',index:'usuario',frozen : true,align:'left',search:true},
	            {name:'txt_4',index:'txt_4',frozen : true,align:'left',search:false},
	            {name:'nombre_cargo',index:'nombre_cargo',frozen : true,align:'left',search:false},
	            {name:'estado',index:'estado',frozen : true,align:'left',search:false},
	            {name:'imagen',index:'imagen',frozen : true,align:'left',search:false},
	            {name:'extranjero',index:'extranjero',frozen : true,align:'left',search:false},
	            {name:'txt_5',index:'txt_5',frozen : true,align:'left',search:false},
	        ],          
	        rowNum: 10,       
	        width:600,
	        shrinkToFit: false,
	        height:200,
	        rowList: [10,20,30],
	        pager: pager_selector,        
	        sortname: 'id_usuario',
	        sortorder: 'asc',
	        caption: 'LISTA DE USUARIOS',	        
	        
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
	            $("#txt_o").val(ret.txt_o);
	            $("#txt_1").val(ret.txt_1);
	            $("#txt_2").val(ret.txt_2);
	            $("#txt_3").val(ret.txt_3);
	            $("#txt_4").val(ret.txt_4);
	            $("#txt_4").trigger("chosen:updated");            
	            $("#txt_5").val(ret.txt_5);
	            $("#txt_6").val(ret.txt_5);
	            $("#txt_7").val(ret.txt_7);
	            $("#txt_8").val(ret.txt_8);	            
	            $("#txt_12").val(ret.txt_12);
	            $("#txt_13").val(ret.txt_13);	            
	            if(ret.extranjero == "ON"){
	            	$("#form-field-checkbox").prop("checked",true);
	            }else{
	            	$("#form-field-checkbox").prop("checked",false);
	            }
	            $("#avatar").attr("src","img/"+ret.imagen);	
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
							            	if(response[i] == pais){
												$("#txt_9").append("<option value ="+response[i]+" selected>"+response[i+1]+"</option>");            																																
							            	}
											else{
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
									            	}
													else{
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
											            	}
															else{
																$("#txt_11").append("<option value ="+response[i]+">"+response[i+1]+"</option>");            																																
															}
											            }   
											            $("#txt_11").trigger("chosen:updated"); 
											                                         
											        }
											    });	      
									                                         
									        }
									    });/**/		                            
							        }
							    });/**/							    
					        }                   
					    });
			        }                   
			    });			    	            
	            /**/
	            $('#myModal').modal('hide'); 
	            $("#btn_0").text("");
	            $("#btn_0").append("<span class='glyphicon glyphicon-log-in'></span> Modificar");     	            
	        },
	        
	        caption: "LISTA DE USUARIOS"
	    });
		jQuery(grid_selector).jqGrid('hideCol', "txt_o");
		jQuery(grid_selector).jqGrid('hideCol', "txt_11");
		jQuery(grid_selector).jqGrid('hideCol', "txt_4");
		jQuery(grid_selector).jqGrid('hideCol', "estado");
		jQuery(grid_selector).jqGrid('hideCol', "imagen");
		jQuery(grid_selector).jqGrid('hideCol', "extranjero");		
		jQuery(grid_selector).jqGrid('hideCol', "txt_5");		
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
	        }
	        ,
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



	    //it causes some flicker when reloading or navigating grid
	    //it may be possible to have some custom formatter to do this as the grid is being created to prevent this
	    //or go back to default browser checkbox styles for the grid
	    function styleCheckbox(table) {
	        /**
	                    $(table).find('input:checkbox').addClass('ace')
	                    .wrap('<label />')
	                    .after('<span class="lbl align-top" />')


	                    $('.ui-jqgrid-labels th[id*="_cb"]:first-child')
	                    .find('input.cbox[type=checkbox]').addClass('ace')
	                    .wrap('<label />').after('<span class="lbl align-top" />');
	         */
	    }
	    

	    //unlike navButtons icons, action icons in rows seem to be hard-coded
	    //you can change them like this in here if you want
	    function updateActionIcons(table) {
	        /**
	                    var replacement = 
	                    {
	                            'ui-ace-icon fa fa-pencil' : 'ace-icon fa fa-pencil blue',
	                            'ui-ace-icon fa fa-trash-o' : 'ace-icon fa fa-trash-o red',
	                            'ui-icon-disk' : 'ace-icon fa fa-check green',
	                            'ui-icon-cancel' : 'ace-icon fa fa-times red'
	                    };
	                    $(table).find('.ui-pg-div span.ui-icon').each(function(){
	                            var icon = $(this);
	                            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
	                            if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
	                    })
	         */
	    }
	    
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
}
function guardar() {///funcion para guardar datos
	var texto = ($("#btn_0").text()).trim();
	var valores = $("#form_usuario").serialize();
	var cadena = document.getElementById('txt_5').value;
	var expresionR = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{4,8}$/;
	var resultado = expresionR.test(cadena);
	var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var correo = $("#txt_8").val();	

	if($("#txt_1").val() == "") {
		$.gritter.add({
			title: 'Error... Ingrese una Identificación',
			class_name: 'gritter-error gritter-center',
			time: 1000,
		});
		$("#txt_1").focus();
	} else {
		if($("#txt_2").val() == "") {
			$.gritter.add({
    			title: 'Error... Ingrese Nombres Completos',
    			class_name: 'gritter-error gritter-center',
    			time: 1000,
    		});
			$("#txt_2").focus();
		} else {
			if(correo == "") {
				$.gritter.add({
        			title: 'Error... Ingrese un Correo',
        			class_name: 'gritter-error gritter-center',
        			time: 1000,
        		});
				$("#txt_8").focus();
			} else {
				if (!expr.test(correo)){
					$.gritter.add({
            			title: 'Error... Ingrese un Correo Válido',
            			class_name: 'gritter-error gritter-center',
            			time: 1000,
            		});
					$("#txt_8").focus();
				} else {
					if($("#txt_13").val() == "") {
						$.gritter.add({
                			title: 'Error... Ingrese un Usuario',
                			class_name: 'gritter-error gritter-center',
                			time: 1000,
                		});
						$("#txt_13").focus();
					} else {
						if($("#txt_5").val() == "") {
							$.gritter.add({
                    			title: 'Error... Ingrese una Contraseña',
                    			class_name: 'gritter-error gritter-center',
                    			time: 1000,
                    		});
							$("#txt_5").focus();
						} else {
							if(resultado != true) {
							    $.gritter.add({
                        			title: 'Error de 4 a 8 caracteres, debe incluir mínimo 1 Mayúscula (A-Z), una Minúscula (a-z) y un Número',
                        			class_name: 'gritter-error gritter-center',
                        			time: 1000,
                        		});
								$("#txt_5").focus();
							} else {
								if($("#txt_6").val() == "") {
									$.gritter.add({
                            			title: 'Error... Confirme Contraseña',
                            			class_name: 'gritter-error gritter-center',
                            			time: 1000,
                            		});
									$("#txt_6").focus();
								} else {
									if($("#txt_5").val() != $("#txt_6").val()) {
									    $.gritter.add({
                                			title: 'Error... Las Contraseñas no coinciden',
                                			class_name: 'gritter-error gritter-center',
                                			time: 1000,
                                		});
										$("#txt_6").val("");
										$("#txt_6").focus();	
									} else {
										if($("#txt_11").val() == "") {
										    $.gritter.add({
                                    			title: 'Error... Ingrese una Ciudad',
                                    			class_name: 'gritter-error gritter-center',
                                    			time: 1000,
                                    		});
										} else {
											if($("#txt_12").val() == "") {
												$.gritter.add({
                                        			title: 'Error... Ingrese una Dirección',
                                        			class_name: 'gritter-error gritter-center',
                                        			time: 1000,
                                        		});
												$("#txt_12").val("");
												$("#txt_12").focus();	
											} else {
												if(texto == "Guardar") {
													guardar_datos(valores,"g"); 
												}
											}	
										}
									}
								}
							}		
						}	
					}
				}	
			}	
		}	
	}				 
}

function guardar_datos(valores,tipo,p) {		
	$.ajax({
	    url: "usuario.php", 	    				    	    
	    data:  valores + "&img="+$("#avatar")[0].src + "&tipo="+tipo, 	    	    
	    type: "POST",
	    beforeSend: function() {
        	$.blockUI({ 
        		css: { backgroundColor: 'background: rgba(255,255,255,0.2);', color: '#fff', border:'2px'},
        		message: '<h3>Enviando información, Por favor espere un momento...'
                                +'<span class="loader animated fadeIn handle ui-sortable-handle">'
                                +'<span class="spinner">'
                                    +'<i class="fa fa-spinner fa-spin"></i>'
                                +'</span>'
                                +'</span>'
                          +'</h3>'
        	});
        },				
	    success: function(data) {				    
	    	if(data == 0) {
	    		$.unblockUI();
	    		swal({
				    title: "Buen trabajo! estimado/a",
				    text: "Su registro fue exitoso, por favor verifique su correo electrónico para activar su cuenta!",
				    type: "warning",
				},function () {
					$('#form_usuario').each (function() {
					  this.reset();
					});
				});	
	    		$('#table').trigger('reloadGrid');					
	    	} else {
	    		if(data == 1) {	
	    			$.unblockUI();    		
	    			$.gritter.add({
            			title: 'Error... La Identificacion ya existe Ingrese Otra',
            			class_name: 'gritter-error gritter-center',
            			time: 2000,
            		});
	    			$("#txt_13").val("");
	    			$("#txt_13").focus();
	    		} else {	    			
	    			if(data == 2) {
	    				$.unblockUI();
	    				$.gritter.add({
                			title: 'Error... La Identificacion ya existe Ingrese Otra',
                			class_name: 'gritter-error gritter-center',
                			time: 2000,
                		});
	    				$("#txt_1").val("");
	    				$("#txt_1").focus();
	    			}
	    		}
	    	}
		},		
	}); 
}

