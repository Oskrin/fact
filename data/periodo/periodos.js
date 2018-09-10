	$(document).on("ready",inicio);

	function inicio (){


	//////////////para tablas//////////
		jQuery(function($) {
	    var grid_selector = "#grid-table";
	    var pager_selector = "#grid-pager";
	    
	    //cambiar el tamaño para ajustarse al tamaño de la página
	    $(window).on('resize.jqGrid', function () {
	        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
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
	        //for this example we are using local data
	        subGridRowExpanded: function (subgridDivId, rowId) {	          
	        },

	        url: 'xml_periodos.php',
	        datatype: "xml",
	        height: 250,
	        colNames:['ID','FECHA PERIODO','ESTADO','FECHA'],
	        colModel:[
	            {name:'id_periodo',index:'id_periodo', width:50, sorttype:"int", editable: false, hidden: true, editoptions: {readonly: 'readonly'}},
	            {name:'fecha_periodo',index:'fecha_periodo',width:90, editable:true, sorttype:"date",unformat: pickDate},
	            {name:'estado',index:'estado', width:100,editable: true,editoptions:{size:"20"}, editrules: {required: true},edittype:"select",editoptions:{value:"Abierto:Abierto;Cerrado:Cerrado;Abierto Parcialmente:Abierto Parcialmente"}},
	            {name:'fecha_creacion',index:'fecha_creacion', width:100,editable: true,editoptions:{size:"20",maxlength:"30",readonly: 'readonly'}}
	        ], 
	        rowNum:10,
	        rowList:[10,20,30],
	        pager : pager_selector,
	        sortname: 'id_periodo',
	        sortorder: 'asc',
	        altRows: true,
	        multiselect: false,
	        multiboxonly: false,
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

	        editurl: "periodos.php",
	        caption: "LISTA PERIODOS"
	    });
	    $(window).triggerHandler('resize.jqGrid');//cambiar el tamaño para hacer la rejilla conseguir el tamaño correcto

	    function aceSwitch( cellvalue, options, cell ) {
	        setTimeout(function(){
	            $(cell) .find('input[type=checkbox]')
	            .addClass('ace ace-switch ace-switch-5')
	            .after('<span class="lbl"></span>');
	        }, 0);
	    }
	    //enable datepicker
	    function pickDate( cellvalue, options, cell ) {
	        setTimeout(function(){
	            $(cell) .find('input[type=text]')
	            .datepicker({format:'yyyy-mm-dd' , autoclose:true}); 
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
	    	closeAfterEdit: true,
	        recreateForm: true,
	        viewPagerButtons: false,
	        overlay:false,
	        beforeShowForm : function(e) {
	            var form = $(e[0]);
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
	            style_edit_form(form);
	        },
	        // afterSubmit: function (response){
			// if(response.responseText == 3){
	  //       		$.gritter.add({
			// 			title: 'Mensaje',
			// 			text: 'Registro Modificado correctamente <i class="ace-icon fa fa-spinner fa-spin green bigger-125"></i>',
			// 			time: 1000				
			// 		});
	  //       		return true;
	  //       	}else{
	  //       		if(response.responseText == 1){	
	  //       			$("#nombre_bodega").val("");
	  //       			return [false,"Error.. La Bodega ya existe"];
		 //        	}	
	  //       	}
	        // },
	    },
	    {
	        closeAfterAdd: true,
	        recreateForm: true,
	        viewPagerButtons: false,
	        overlay:false,
	        beforeShowForm : function(e) {
	            var form = $(e[0]);
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
	            .wrapInner('<div class="widget-header" />')
	            style_edit_form(form);
	        },
	    //     afterSubmit: function (response){
	    // //     	if(response.responseText == 2) {
	    // //     		$.gritter.add({
					// // 	title: 'Mensaje',
					// // 	text: 'Registro guardado correctamente <i class="ace-icon fa fa-spinner fa-spin green bigger-125"></i>',
					// // 	time: 1000				
					// // });
	    // //     		return true;
	    // //     	}else{
	    // //     		if(response.responseText == 1){	
	    // //     			$("#nombre_bodega").val("");
	    // //     			return [false,"Error.. La Bodega ya existe"];
		   // //      	}	
	    // //     	}
	    //     },
	    },
	    {
	        //delete record form
	        recreateForm: true,
	        overlay:false,
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
	          overlay:false,
	        afterShowSearch: function(e){
	            var form = $(e[0]);
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
	            style_search_form(form);
	        },
	        afterRedraw: function(){
	            style_search_filters($(this));
	        }
	        ,
	        multipleSearch: false,
	      },
	    {
	        //view record form
	        recreateForm: true,
	        overlay:false,
	        beforeShowForm: function(e){
	            var form = $(e[0]);
	            form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
	        }
	    }
	)
	    
	    function style_edit_form(form) {
	        //enable datepicker on "sdate" field and switches for "stock" field
	        form.find('input[name=fecha_periodo]').datepicker({format:'yyyy-mm-dd' , autoclose:true})
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
	//////////////////////fin tabla///////////////
}