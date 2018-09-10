$(document).on("ready",inicio);

    function myFunction(id) {
        var myWindow = window.open("../../reportes/rol_pagos.php?id="+id,'_blank');
    }
    
    function recargar() {
        setTimeout(function() {
            location.reload();
        }, 1000);  
    }

    function guardar_nomina() {
        var formulario = $("#form_nomina").serialize();
        var sueldo = $('#txt_4').val();
        var fecha = $("#fecha_actual").val();
        var dia = fecha.substr(8, 10); 
    
        var decimo_tercero = (parseFloat(375)/12).toFixed(2);
        var decimo_cuarto = (parseFloat(sueldo) / 12).toFixed(2);  
    
        if (dia == 27 || dia == 28) {
            if($("#txt_0").val() == "") {
                $.gritter.add({
        			title: 'Error... Seleccione un registro',
        			class_name: 'gritter-error gritter-center',
        			time: 1000,
        		});
            } else {
                if($("#dias_laborados").val() == "") {
                    $.gritter.add({
            			title: 'Error... Ingrese Dias Laborados',
            			class_name: 'gritter-error gritter-center',
            			time: 1000,
            		});
                    $("#dias_laborados").focus(); 
                } else {
                    if($("#no_laborado").val() == "") {
                        $.gritter.add({
            			    title: 'Error... Ingrese Dias No Laborados',
            			    class_name: 'gritter-error gritter-center',
            			    time: 1000,
            		    });
                        $("#no_laborado").focus(); 
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "nomina.php",
                            data: formulario + "&tercero=" + decimo_tercero + "&cuarto=" + decimo_cuarto ,
                            success: function(data) {
                                var val = data;
                                if (val == 0) {
                                    $.gritter.add({
                                        title: 'Información Mensaje',
                                        text: ' <span class="fa fa-shield"></span>' + ' ' +'Nómina Guardada Correctamente <span class="text-succes fa fa-spinner fa-spin"></span>'
                                            ,
                                        sticky: false,
                                        time: 1000,                       
                                    });
                                    recargar(); 
                                }
                            }
                        });
                    }
                }
           }
        } else {        
            $.gritter.add({
    			title: 'Error... No se encuentra en dias habiles para realizar roles de pagos',
    			class_name: 'gritter-error gritter-center',
    			time: 1000,
    		});     
        }
    }

function inicio() {	
  show();
  function mes_actual() {
    $.ajax({
      type: "POST",
      url: "mes.php",
      data: {cargar_mes:'cargar_mes'},
      success: function(data) {
        $('#mes').html(data).trigger("change");
      }
    });
  }

  function fechas_nomina() {
    $.ajax({
      type: "POST",
      url: "mes.php",
      data: {cargar_fechas:'cargar_fechas', fecha_sistema:$("#fecha_actual").val()},
      success: function(data) {
        if (data == 27 || data == 28) {
        } else {
          location.href = "../inicio"
          alert('No se encuentra en dias habiles para realizar roles de pagos');
            
        }
      }
    });
  }

  mes_actual();
  //fechas_nomina();

  // stilo select2
    $(".select2").css({
        'width': '100%',
        allow_single_deselect: true,
        no_results_text: "No se encontraron resultados",
        allowClear: true,
    });
    // fin

    // limpiar select2
    $("#mes").select2({
        // allowClear: true
    });
    // fin

  // tooltips 
    $('[data-rel=tooltip]').tooltip();

    // seclect chosen 
    $('.chosen-select').chosen({
        allow_single_deselect:true,
        no_results_text:'No encontrado'     
    });
    
    $(document).one('ajaxloadstart.page', function(e) {
        //in ajax mode, remove before leaving page
        $('.modal.aside').remove();
        $(window).off('.aside')
    });

    // modal
      $('.modal.aside').ace_aside();
      $('#aside-inside-modal').addClass('aside').ace_aside({container: '#my-modal > .modal-dialog'});

    // formato calendario
      $('.date-picker').datepicker({
        autoclose: true,
        showOtherMonths: true,
        format:'yyyy-mm-dd',
        startView:0   
      }).datepicker('setDate', 'today');

    // ventana emergente importar
    $('#btn_importar').click(function() {
      $('#modal-importar').modal('show');
    });
    // fin

    // ventana emergente importar
    $('#btn_importar2').click(function() {
      $('#modal-importar2').modal('show');
    });
    // fin

    // formato archivo excel
    $('#archivo_excel').fileinput({
          uploadUrl: '#',
          uploadAsync: false,
          minFileCount: 1,
          maxFileCount: 20,
          showUpload: true,
          slugCallback: function(filename) {
              return filename.replace('(', '_').replace(']', '_');
          }
      });
      // fin

    // cargar horarios de entrada
    $('#btn_excel').click(function() {
      var formObj = document.getElementById("form_excel");
      var formData = new FormData(formObj);
      var inicioMinutos = 0;
      var inicioHoras = 0;
      var transcurridoMinutos = 0;
      var transcurridoHoras = 0;

      $.ajax({
        url: "cargar_excel.php",
        type: "POST",
        data:  formData,
        mimeType:"multipart/form-data",
        dataType: 'json',
        contentType: false,
        cache: false, 
        processData:false,
        success: function(data, textStatus, jqXHR) {
          var count = 0;
          for (var i = 0; i < data.length; i++) {
            if (data[i] == "0") {
              count++;
            }
          }

          var cal = 30 - count;
          $('#dias_laborados').val(cal);
          $('#no_laborado').val(count);

          $('#modal-importar').modal('hide');
        }         
      });
    });
    // fin

    // cargar horarios de entrada
    $('#btn_excel2').click(function() {
      var formObj = document.getElementById("form_excel2");
      var formData = new FormData(formObj);
      var inicioMinutos = 0;
      var inicioHoras = 0;
      var transcurridoMinutos = 0;
      var transcurridoHoras = 0;

      $.ajax({
        url: "cargar_excel2.php",
        type: "POST",
        data:  formData,
        mimeType:"multipart/form-data",
        dataType: 'json',
        contentType: false,
        cache: false, 
        processData:false,
        success: function(data, textStatus, jqXHR) {
          var count = 0;
          for (var i = 0; i < data.length; i++) {
            if (data[i] != "null") {
              count = count + data[i];
            }
          }

          console.log(count);

          $('#horas_extras').val(count);

          $('#modal-importar2').modal('hide');
        }         
      });
    });
    // fin

 	////////////////validaciones/////////////////

  function calcular() {
    if($("#txt_0").val() == "") {
       alert("Seleccione un registro");
    } else {
      var sueldo = $('#txt_4').val();
      var acumula = $('#acumula').val();
      var dias_laborados = $('#dias_laborados').val();
      var no_laborados = $('#no_laborado').val();
      var extras = $('#horas_extras').val();

      var horas_extras = (parseFloat(sueldo/15)/8 * parseFloat(extras)).toFixed(2);

      if (acumula == 'NO') {
        var decimo_tercero = (parseFloat(375)/12).toFixed(2);
        var decimo_cuarto = (parseFloat(sueldo) / 12).toFixed(2);  
      } else {
          var decimo_tercero = '0.00';
          var decimo_cuarto = '0.00';  
      }
      
      var total_ingresos = (parseFloat(decimo_tercero) + parseFloat(decimo_cuarto) + parseFloat(sueldo) + parseFloat(horas_extras)).toFixed(2);
      // var sueldo_basico = ((parseFloat(sueldo/30)/8) * parseFloat(dias_laborados)).toFixed(2);
      var descuento_faltas = ((parseFloat(sueldo/30)) * parseFloat(no_laborados)).toFixed(2);
      var total_descuentos = parseFloat(descuento_faltas).toFixed(2);
      var neto_pagar = (total_ingresos - total_descuentos).toFixed(2);

      $('#decimo_tercero').val(decimo_tercero);
      $('#decimo_cuarto').val(decimo_cuarto);
      $('#total_extras').val(horas_extras);
      $('#total_ingresos').val(total_ingresos);
      $('#descuento_faltas').val(descuento_faltas);
      $('#total_descuentos').val(total_descuentos);
      $('#neto_pagar').val(neto_pagar);   
    }
    
  }

/*-----guardar factura compra--*/
  $("#btn_0").on("click", guardar_nomina);
  $("#btn_calcular").on("click", calcular);


// /busqueda facturas a cobrar
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
          url: 'xml_empleados.php',        
          colNames: ['ID','IDENTIFICACIÓN','NOMBRES','TELÉFONO','CELULAR','id_ciudad','CIUDAD','DIRECCIÓN','CORREO','COMENTARIO','SUELDO','ACUMULA'],
          colModel:[      
              {name:'txt_0',index:'id_empleado',frozen:true,align:'left',search:false},
              {name:'txt_2',index:'identificacion',frozen : true,align:'left',search:true},
              {name:'txt_3',index:'nombres_completos',frozen : true,align:'left',search:false},
              {name:'txt_4',index:'telefono1',frozen : true,align:'left',search:false},            
              {name:'txt_5',index:'telefono2',frozen : true,align:'left',search:false},
              {name:'txt_11',index:'id_ciudad',frozen : true,align:'left',search:false},              
              {name:'descripcion',index:'descripcion',frozen : true,align:'left',search:false},
              {name:'txt_12',index:'direccion',frozen : true,align:'left',search:false},
              {name:'txt_6',index:'correo',frozen : true,align:'left',search:true},
              {name:'txt_13',index:'comentario',frozen : true,align:'left',search:false},
              {name:'txt_7',index:'sueldo',frozen : true,align:'left',search:false},
              {name:'acumula',index:'acumula',frozen : true,align:'left',search:false},
          ],          
          rowNum: 10,       
          width:600,
          shrinkToFit: false,
          height:200,
          rowList: [10,20,30],
          pager: pager_selector,        
          sortname: 'id_empleado',
          sortorder: 'asc',
          caption: 'LISTA EMPELADOS',          
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
              
              $("#txt_0").val(ret.txt_0);
              $("#txt_2").val(ret.txt_2);
              $("#txt_3").val(ret.txt_3);
              $("#txt_4").val(ret.txt_7);
              $("#acumula").val(ret.acumula);
              $('#myModal').modal('hide');                  
          },
          
          caption: "LISTA EMPLEADOS"
      });

    jQuery(grid_selector).jqGrid('hideCol', "txt_0");
    jQuery(grid_selector).jqGrid('hideCol', "txt_11");    

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
          afterShowSearch: function(e) {
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
          beforeShowForm: function(e) {
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

      $(document).one('ajaxloadstart.page', function(e) {
          $(grid_selector).jqGrid('GridUnload');
          $('.ui-jqdialog').remove();
      });
  });


  jQuery(function($) {
      var grid_selector2 = "#table2";
      var pager_selector2 = "#pager2";
      
      //cambiar el tamaño para ajustarse al tamaño de la página
      $(window).on('resize.jqGrid', function () {
          //$(grid_selector2).jqGrid( 'setGridWidth', $("#myModal").width());          
          $(grid_selector2).jqGrid( 'setGridWidth', $("#myModal .modal-dialog").width()-30);
          
      })
      //cambiar el tamaño de la barra lateral collapse/expand
      var parent_column = $(grid_selector2).closest('[class*="col-"]');
      $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
          if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
              //para dar tiempo a los cambios de DOM y luego volver a dibujar!!!
              setTimeout(function() {
                  $(grid_selector2).jqGrid( 'setGridWidth', parent_column.width() );
              }, 0);
          }
      })

      jQuery(grid_selector2).jqGrid({          
          datatype: "xml",
          url: 'xml_nomina.php',        
          colNames: ['ID','IDENTIFICACIÓN','NOMBRES','FECHA NÓMINA','MES','NETO PAGAR','PDF'],
          colModel:[      
              {name:'id_nomina',index:'id_nomina',frozen:true,align:'left',search:false, hidden: true},
              {name:'identificacion',index:'identificacion',frozen : true,align:'left',search:true},
              {name:'nombres_completos',index:'nombres_completos',frozen : true,align:'left',search:false},
              {name:'fecha_nomina',index:'fecha_nomina',frozen : true,align:'left',search:false},            
              {name:'mes',index:'mes',frozen : true,align:'left',search:false},
              {name:'neto_pagar',index:'neto_pagar',frozen : true,align:'left',search:false},              
              {name:'pdf',index:'pdf',frozen : true,align:'left',search:false},
          ],          
          rowNum: 10,       
          width:600,
          shrinkToFit: false,
          height:200,
          rowList: [10,20,30],
          pager: pager_selector2,        
          sortname: 'id_nomina',
          sortorder: 'asc',
          caption: 'LISTA NÓMINA',          
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
          gridComplete: function() {
            var ids = jQuery(grid_selector2).jqGrid('getDataIDs');
            for(var i = 0;i < ids.length;i++) {
                var id = ids[i];
                pdf = "<a onclick=myFunction('"+id+"') title='Reporte Rol Pagos'><i class='fa fa-file-pdf-o red2' style='cursor:pointer; cursor: hand'> PDF</i></a>";                    
                jQuery(grid_selector2).jqGrid('setRowData',ids[i],{pdf: pdf});
            }       
        },
          ondblClickRow: function(rowid) {                                
              var gsr = jQuery(grid_selector2).jqGrid('getGridParam','selrow');                                              
              var ret = jQuery(grid_selector2).jqGrid('getRowData',gsr);                                      
          },
          
          caption: "LISTA NÓMINA"
      });

    jQuery(grid_selector2).jqGrid('hideCol', "txt_0");
    jQuery(grid_selector2).jqGrid('hideCol', "txt_11");    

      $(window).triggerHandler('resize.jqGrid');//cambiar el tamaño para hacer la rejilla conseguir el tamaño correcto

      function aceSwitch( cellvalue, options, cell ) {
          setTimeout(function(){
              $(cell) .find('input[type=checkbox]')
              .addClass('ace ace-switch ace-switch-5')
              .after('<span class="lbl"></span>');
          }, 0);
      }          
      //navButtons
      jQuery(grid_selector2).jqGrid('navGrid',pager_selector2,
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

      $(document).one('ajaxloadstart.page', function(e) {
          $(grid_selector2).jqGrid('GridUnload');
          $('.ui-jqdialog').remove();
      });
  });


jQuery(window).bind('resize', function () {
jQuery("#list").setGridWidth(jQuery('#grid_container').width(), true);
}).trigger('resize');

}