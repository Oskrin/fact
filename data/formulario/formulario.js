$(document).on("ready",inicio);

function myFunction() {
    window.open("formulario_xml.php");
}

function recargar() {
  setTimeout(function() {
    location.reload();
  }, 2000);  
}

function guardar_formulario() {
    $.ajax({        
        type: "POST",
        data: $("#validation-form-2").serialize() +"&"+ $("#validation-form-3").serialize(),                
        url: "formulario.php",      
        success: function(data) { 
            if( data == 0 ) {

                $.gritter.add({
                  title: 'Información Mensaje',
                  text: ' <span class="fa fa-shield"></span>' + ' ' +'Registro Guardado correctamente <span class="text-succes fa fa-spinner fa-spin"></span>'
                      ,
                 sticky: false,
                 time: 2000,                       
                });
                recargar(); 
            }
            var myWindow = window.open("../../reportes/servicio_rentas_internas.php?hoja=A4&id="+$("#comprobante").val(),'_blank');
        }
    }); 
}

function Valida_punto() {
    var key;
    if (window.event) {
        key = event.keyCode;
    } else if (event.which) {
        key = event.which;
    }

    if (key < 48 || key > 57) {
        if (key === 46 || key === 8) {
            return true;
        } else {
            return false;
        }
    }
    //return true;
}

function flecha_atras() {
    $.ajax({
        type: "POST",
        url: "flechas.php",
        data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "formulario_101" + "&id_tabla=" + "id_formualrio101" + "&tipo=" + 1,
        success: function(data) {
            var val = data;
            if(val != "") {
                $("#comprobante").val(val);
                var valor = $("#comprobante").val();

                $.getJSON('retornar_factura_venta.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama != 0) {
                        for (var i = 0; i < tama; i = i + 23) {
                            $("#id_factura_venta").val(data[i]);
                            $("#fecha_actual").val(data[i + 1]);
                            $("#hora_actual").val(data[i + 2]);
                            $("#digitador").val(data[i + 3] + " " + data[i + 4] );
                            var num = data[i + 5]; 
                            var res = num.substr(8, 20)
                            $("#num_factura").val(res);
                            $("#id_cliente").val(data[i + 6]);
                            $("#ruc_ci").val(data[i + 7]);
                            $("#nombre_cliente").val(data[i + 8]);
                            $("#direccion_cliente").val(data[i + 9]);
                            $("#telefono_cliente").val(data[i + 10]);
                            $("#correo").val(data[i + 11]);
                            $("#autorizacion").val(data[i + 12]);
                            $("#fecha_auto").val(data[i + 13]);
                            $("#fecha_caducidad").val(data[i + 14]);
                            $("#cancelacion").val(data[i + 15]);
                            $("#tipo_precio").val(data[i + 16]);

                            if(data[i + 17 ] == "Pasivo") {
                                $("#estado").append($("<h3>").text("Anulada"));
                                $("#estado h3").css("color","red");
                                $("#btnAnular").attr("disabled", "disabled");
                                $("#btnModificar").attr("disabled", true);
                            } else {
                                $("#estado h3").remove();
                                $("#btnAnular").attr("disabled", "disabled");
                                $("#btnAnular").attr("disabled", false);
                                $("#btnModificar").attr("disabled", false);
                            }

                            $("#total_p").val(data[i + 18]);
                            $("#total_p2").val(data[i + 19]);
                            $("#sub").val((parseFloat(data[i + 18]) + parseFloat(data[i + 19])).toFixed(3));
                            $("#iva").val(data[i + 20]);
                            $("#desc").val(data[i + 21]);
                            $("#tot").val(data[i + 22]);
                        }
                    }
                });
            } else {
                alertify.alert("No hay mas registros posteriores!!");
            }
        }
    });
} 


function inicio () {
  $("#btn_0").on("click",guardar_formulario);
  //$("#btn_4").on("click", flecha_atras);
    $('[data-rel=tooltip]').tooltip();
            
                var $validation = false;
                $('#fuelux-wizard-container')
                .ace_wizard({
                    //step: 2 //optional argument. wizard will jump to step "2" at first
                    //buttons: '.wizard-actions:eq(0)'
                })
                .on('actionclicked.fu.wizard' , function(e, info){
                    if(info.step == 1 && $validation) {
                        if(!$('#validation-form-2').valid()) e.preventDefault();
                    }
                })
                .on('finished.fu.wizard', function(e) {
                    bootbox.dialog({
                        message: "Thank you! Your information was successfully saved!", 
                        buttons: {
                            "success" : {
                                "label" : "OK",
                                "className" : "btn-sm btn-primary"
                            }
                        }
                    });
                }).on('stepclick.fu.wizard', function(e){
                    //e.preventDefault();//this will prevent clicking and selecting steps
                });
            
                    
            
                $('#validation-form-2').validate({
                    errorElement: 'div',
                    errorClass: 'help-block',
                    focusInvalid: false,
                    ignore: "",
                    rules: {
                        311: {
                            digits: false
                            
                            //required: true,
                            //email:true
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                        password2: {
                            required: true,
                            minlength: 5,
                            equalTo: "#password"
                        },
                        name: {
                            required: true
                        },
                        phone: {
                            required: true,
                            phone: 'required'
                        },
                        url: {
                            required: true,
                            url: true
                        },
                        comment: {
                            required: true
                        },
                        state: {
                            required: true
                        },
                        platform: {
                            required: true
                        },
                        subscription: {
                            required: true
                        },
                        gender: {
                            required: true,
                        },
                        agree: {
                            required: true,
                        }
                    },
            
                    messages: {
                        email: {
                            required: "Please provide a valid email.",
                            email: "Please provide a valid email."
                        },
                        password: {
                            required: "Please specify a password.",
                            minlength: "Please specify a secure password."
                        },
                        state: "Please choose state",
                        subscription: "Please choose at least one option",
                        gender: "Please choose gender",
                        agree: "Please accept our policy"
                    },
            
            
                    highlight: function (e) {
                        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                    },
            
                    success: function (e) {
                        $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                        $(e).remove();
                    },
            
                    errorPlacement: function (error, element) {
                        if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                            var controls = element.closest('div[class*="col-"]');
                            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                        }
                        else if(element.is('.select2')) {
                            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                        }
                        else if(element.is('.chosen-select')) {
                            error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                        }
                        else error.insertAfter(element.parent());
                    },
            
                    submitHandler: function (form) {
                    },
                    invalidHandler: function (form) {
                    }
                });
                
                $('#modal-wizard-container').ace_wizard();
                $('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');       
                
                $(document).one('ajaxloadstart.page', function(e) {
                    //in ajax mode, remove remaining elements before leaving page
                    $('[class*=select2]').remove();
                });

         
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
            url: 'xml_formulario.php',        
            colNames: ['ID','AÑO','RUC','EMPRESA','REPRESENTANTE LEGAL','IDENTIFICACIÓN REPRESENTANTE','XML'],
            colModel:[      
                {name:'id_formualrio101',index:'id_formualrio101',frozen:true,align:'left',search:false,hidden:true},
                {name:'anio_contable',index:'anio_contable',frozen : true,align:'left',search:true},
                {name:'ruc_empresa',index:'ruc_empresa',frozen : true,align:'left',search:true},
                {name:'nombre_empresa',index:'nombre_empresa',frozen : true,align:'left',search:false},
                {name:'representante_legal',index:'representante_legal',frozen : true,align:'left',search:false},
                {name:'identificacion_repre',index:'identificacion_repre',frozen : true,align:'left',search:false},
                {name:'xml',index:'xml',frozen : true,align:'center',search:false, hidden: false,width:70},
            ],          
            rowNum: 10,       
            width:600,
            shrinkToFit: false,
            height:200,
            rowList: [10,20,30],
            pager: pager_selector,        
            sortname: 'id_formualrio101',
            sortorder: 'asc',
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
                var ids = jQuery(grid_selector).jqGrid('getDataIDs');
                for(var i = 0;i < ids.length;i++) {
                    var id = ids[i];
                    xml = "<a onclick='myFunction()' title='Descargar XML'><i class='fa fa-file-code-o' style='cursor:pointer; cursor: hand'> XML</i></a>";                    
                    jQuery(grid_selector).jqGrid('setRowData',ids[i],{xml: xml});
                }       
            },
            ondblClickRow: function(rowid) {                                    
                var gsr = jQuery(grid_selector).jqGrid('getGridParam','selrow');                                              
                var ret = jQuery(grid_selector).jqGrid('getRowData',gsr);  
                
                $("#comprobante").val(ret.id_formualrio101);
                var valor = ret.id_formualrio101;  

                /**/
                $.getJSON('retornar_formulario101.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama != 0) {
                        for (var i = 0; i < tama; i = i + 44) {
                            $("#311").val(data[i]);
                            $("#316").val(data[i + 1]);
                            $("#322").val(data[i + 2]);
                            $("#323").val(data[i + 3]);
                            $("#326").val(data[i + 4]);
                            $("#327").val(data[i + 5]);
                            $("#328").val(data[i + 6]);
                            $("#329").val(data[i + 7]);
                            $("#335").val(data[i + 8]);
                            $("#345").val(data[i + 9]);
                            $("#353").val(data[i + 10]);
                            $("#354").val(data[i + 11]);
                            $("#356").val(data[i + 12]);
                            $("#357").val(data[i + 13]);
                            $("#359").val(data[i + 14]);
                            $("#360").val(data[i + 15]);
                            $("#379").val(data[i + 16]);
                            $("#382").val(data[i + 17]);
                            $("#389").val(data[i + 18]);
                            $("#445").val(data[i + 19]);
                            $("#498").val(data[i + 20]);
                            $("#499").val(data[i + 21]);
                            $("#513").val(data[i + 22]);
                            $("#515").val(data[i + 23]);
                            $("#517").val(data[i + 24]);
                            $("#521").val(data[i + 25]);
                            $("#526").val(data[i + 26]);
                            $("#527").val(data[i + 27]);
                            $("#528").val(data[i + 28]);
                            $("#530").val(data[i + 29]);
                            $("#534").val(data[i + 30]);
                            $("#539").val(data[i + 31]);
                            $("#545").val(data[i + 32]);
                            $("#551").val(data[i + 33]);
                            $("#569").val(data[i + 34]);
                            $("#601").val(data[i + 35]);
                            $("#621").val(data[i + 36]);
                            $("#641").val(data[i + 37]);
                            $("#651").val(data[i + 38]);
                            $("#652").val(data[i + 39]);
                            $("#653").val(data[i + 40]);
                            $("#661").val(data[i + 41]);
                            $("#698").val(data[i + 42]);
                            $("#699").val(data[i + 43]);
                        }
                    }
                });

                $.getJSON('retornar_anexos101.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama != 0) {
                        for (var i = 0; i < tama; i = i + 55) {
                            $("#6011").val(data[i]);
                            $("#6061").val(data[i + 1]);
                            $("#6071").val(data[i + 2]);
                            $("#6999").val(data[i + 3]);
                            $("#7051").val(data[i + 4]);
                            $("#7061").val(data[i + 5]);
                            $("#7071").val(data[i + 6]);
                            $("#7081").val(data[i + 7]);
                            $("#7091").val(data[i + 8]);
                            $("#7101").val(data[i + 9]);
                            $("#7111").val(data[i + 10]);
                            $("#7121").val(data[i + 11]);
                            $("#7131").val(data[i + 12]);
                            $("#7132").val(data[i + 13]);
                            $("#7141").val(data[i + 14]);
                            $("#7142").val(data[i + 15]);
                            $("#7143").val(data[i + 16]);
                            $("#7151").val(data[i + 17]);
                            $("#7152").val(data[i + 18]);
                            $("#7162").val(data[i + 19]);
                            $("#7163").val(data[i + 20]);
                            $("#7191").val(data[i + 21]);
                            $("#7192").val(data[i + 22]);
                            $("#7193").val(data[i + 23]);
                            $("#7201").val(data[i + 24]);
                            $("#7202").val(data[i + 25]);
                            $("#7203").val(data[i + 26]);
                            $("#7212").val(data[i + 27]);
                            $("#7221").val(data[i + 28]);
                            $("#7222").val(data[i + 29]);
                            $("#7223").val(data[i + 30]);
                            $("#7232").val(data[i + 31]);
                            $("#7233").val(data[i + 32]);
                            $("#7342").val(data[i + 33]);
                            $("#7343").val(data[i + 34]);
                            $("#7442").val(data[i + 35]);
                            $("#7462").val(data[i + 36]);
                            $("#7463").val(data[i + 37]);
                            $("#7472").val(data[i + 38]);
                            $("#7473").val(data[i + 39]);
                            $("#7482").val(data[i + 40]);
                            $("#7483").val(data[i + 41]);
                            $("#7511").val(data[i + 42]);
                            $("#7512").val(data[i + 43]);
                            $("#7513").val(data[i + 44]);
                            $("#7571").val(data[i + 45]);
                            $("#7572").val(data[i + 46]);
                            $("#7573").val(data[i + 47]);
                            $("#7581").val(data[i + 48]);
                            $("#7582").val(data[i + 49]);
                            $("#7583").val(data[i + 50]);
                            $("#7592").val(data[i + 51]);
                            $("#7593").val(data[i + 52]);
                            $("#7992").val(data[i + 53]);
                            $("#7999").val(data[i + 54]);
                        }
                    }
                });
                  
                /**/
                $('#myModal').modal('hide');
                $("#btn_0").text("");
                $("#btn_0").append("<span class='glyphicon glyphicon-log-in'></span> Modificar");                   
            },
            
            caption: "LISTA FORMULARIOS RETENCIONES"
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

        function styleCheckbox(table) {

        }
        

        //unlike navButtons icons, action icons in rows seem to be hard-coded
        //you can change them like this in here if you want
        function updateActionIcons(table) {
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


}