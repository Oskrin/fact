$(function() {
	$(".datepicker").datepicker({ 
		format: "yyyy-mm-dd",
        autoclose: true
	}).datepicker("setDate","today");

	// imprimir 
	$('#btn_establecimientos').click(function () {
		reporte_establecimientos();	
	});	
	// fin

	// imprimir 
	$('#btn_lugares').click(function () {
		reporte_lugares();	
	});	
	// fin
});

function reporte_establecimientos() {
	var myWindow = window.open("../reportes/establecimientos_visitados.php?hoja=A4&fecha_inicio="+$('#txt_1').val() + "&fecha_fin="+$('#txt_2').val() + "&limite="+$('#txt_3').val(),'_blank'); 	
}

function reporte_lugares() {
	var myWindow = window.open("../reportes/lugares_turisticos_visitados.php?hoja=A4&fecha_inicio="+$('#txt_4').val() + "&fecha_fin="+$('#txt_5').val() + "&limite="+$('#txt_6').val(),'_blank'); 	
}
