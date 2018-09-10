$(document).on("ready",inicio);	
function inicio() {
	/*--buscadores--*/
  var input_ci = $("#txt_1_chosen").children().next().children();     
  $(input_ci).on("keyup",function(input_ci){    
    var text = $(this).children().val();
    if(text != ""){     
      $.ajax({        
            type: "POST",
            dataType: 'json',        
            url: "../carga_ubicaciones.php?tipo=0&id=0&fun=26&val="+text,        
            success: function(data, status) {
              $('#txt_1').html("");           
              for (var i = 0; i < data.length; i=i+3) {                                                 
                  appendToChosen(data[i],data[i+1],text,data[i+2],"txt_1","txt_1_chosen");
                }           
              $('#txt_2').html("");
              $('#txt_2').append($("<option data-extra='"+data[1]+"'></option>").val(data[0]).html(data[2])).trigger('chosen:updated');                    
              $("#txt_0").val(data[0])                          
          },
          error: function (data) {
              console.log(data)
          }         
        });
      }   
  });
  $("#txt_1").chosen().change(function (event,params){
    if(params == undefined){      
      $('#txt_1').html("");
      $('#txt_1').append($("<option></option>"));         
      $('#txt_1').trigger('chosen:updated')
      $('#txt_2').html("");
      $('#txt_2').append($("<option></option>"));         
      $('#txt_2').trigger('chosen:updated');      
          $("#txt_0").val("");            
    }else{        
      var a = $("#txt_1 option:selected");            
      $('#txt_2').html("");
      $('#txt_2').append($("<option data-extra='"+$(a).text()+"'></option>").val($(a).val()).html($(a).data("extra"))).trigger('chosen:updated');
      $("#txt_0").val($(a).val());
    }
  }); 
  var input_nombre = $("#txt_2_chosen").children().next().children();     
  $(input_nombre).on("keyup",function(input_nombre){        
    var text = $(this).children().val();
    if(text != ""){
      $.ajax({        
            type: "POST",
            dataType: 'json',        
            url: "../carga_ubicaciones.php?tipo=0&id=0&fun=27&val="+text,        
            success: function(data, status) {
              $('#txt_2').html("");           
              for (var i = 0; i < data.length; i=i+3) {                             
                  appendToChosen(data[i],data[i+2],text,data[i+1],"txt_2","txt_2_chosen");
                }           
              $('#txt_1').html("");
              $('#txt_1').append($("<option data-extra='"+data[2]+"'></option>").val(data[0]).html(data[1])).trigger('chosen:updated');                    
              $("#txt_0").val(data[0])                          
          },
          error: function (data) {
              console.log(data)
          }         
        });
      }   
  });
  $("#txt_2").chosen().change(function (event,params){
    if(params == undefined){      
      $('#txt_2').html("");
      $('#txt_2').append($("<option></option>"));         
      $('#txt_2').trigger('chosen:updated')
      $('#txt_1').html("");
      $('#txt_1').append($("<option></option>"));         
      $('#txt_1').trigger('chosen:updated');      
          $("#txt_0").val("");            
    }else{        
      var a = $("#txt_2 option:selected");            
      $('#txt_1').html("");
      $('#txt_1').append($("<option data-extra='"+$(a).text()+"'></option>").val($(a).val()).html($(a).data("extra"))).trigger('chosen:updated');
      $("#txt_0").val($(a).val());
    }
  }); 
  /*-------------*/
  
  $('#btn_buscar').click(function(){
    $('#td_auditoria').dataTable().fnClearTable();
    $.ajax({
        type: "POST",
        url: "auditoria.php",  
        data:{id:$('#txt_0').val(),fecha:$('#rango_fecha').val()},
        dataType: 'json',
        success: function(response) {         
          for (var i = 0; i < response.length; i=i+5) {            
              $('#td_auditoria').dataTable().fnAddData([
                response[i+0],
                response[i+1],
                response[i+2],
                response[i+3],
                response[i+4],
              ]);                                
          }
         }                    
      });
  })            	
}