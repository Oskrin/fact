<?php 
	//inclucion de librerias
	include '../conexion.php';
	include '../funciones_generales.php';
	//include '../correos/mail.php';
	// include '../correos/prueba.php';
	error_reporting(0);

	$conexion = conectarse();
	date_default_timezone_set('America/Guayaquil');
	$fecha = date('Y-m-d H:i:s', time());
	$fecha_larga = date('His', time());
	
	//LLena combo cargos
	if (isset($_POST['llenar_periodo'])) {
        $consulta = pg_query("SELECT * FROM periodo ORDER BY fecha_creacion asc");
    
        while ($row = pg_fetch_row($consulta)) {
            $data = array('fecha' => $row[1], 'estado' => $row[2]);
        }
        
        print_r(json_encode($data));
	}
	// fin
?>