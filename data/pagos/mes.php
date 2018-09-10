<?php
	if (isset($_POST['cargar_mes'])) {
		setlocale(LC_TIME, 'spanish');
		$mes = date("m"); // Mes actual
 		$nombre = strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 

		print '<option value="'.strtoupper($nombre).'">'.strtoupper($nombre).'</option>';	
	}

	if (isset($_POST['cargar_fechas'])) {
	    date_default_timezone_set('America/Guayaquil');
	    setlocale();
	    
		$dia = date("d"); // dia actual
		
		echo $dia;

		
		
	} 

?>