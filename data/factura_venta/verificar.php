<?php
//inclucion de librerias
	include '../conexion.php';
	include '../funciones_generales.php';
	// error_reporting(0);

if (isset($_POST['verificar'])) {
	$conexion = conectarse();

	$sql = pg_query("SELECT count(*) FROM pagos_venta WHERE id_factura_venta = '".$_POST['id']."' and estado = 'Activo'");
	while ($row = pg_fetch_row($sql)) {
		$count = $row[0];
	}

	if($count != 0) {
    	$data = 1;	
    } else {
    	$data = 0;
    }

    echo $data;	
}


?>