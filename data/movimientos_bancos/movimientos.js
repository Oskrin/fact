$(document).on("ready",inicio);	
function inicio(){	 
  $('input[name=date-range-picker]').daterangepicker({
    'applyClass' : 'btn-sm btn-success',
    'cancelClass' : 'btn-sm btn-purple',
    locale: {
      applyLabel: 'Aplicar',
      cancelLabel: 'Cancelar',
    }
  }); 	 	  
  $('#btn_buscar').click(function(){
    //$('#td_libro').dataTable().fnClearTable();
    $('#td_libro tbody').html('');
    var debe = 0;
    var haber = 0;
    $.ajax({
        type: "POST",
        url: "movimientos.php",  
        data:{fecha:$('#rango_fecha').val()},
        dataType: 'json',
        success: function(response) {                           
          for (var i = 0; i < response.length; i= i+6) {           
            $('#td_libro tbody').append('<tr><td><strong>'+response[i]+'</strong></td><td ><strong>'+response[i+1]+'</td><td><strong>'+response[i+2]+'</strong></td><td><strong>'+response[i+3]+'</strong></td><td><strong>'+response[i+4]+'</strong></td><td><strong>'+response[i+5]+'</strong></td></tr>');           
          }
         }                    
      });       
      
  })
  $('#btn_reporte').click(function(){    
    window.open("../reportes/libro_diario.php?fecha="+$('#rango_fecha').val());
  });
               	
}