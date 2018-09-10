<?php 
	include '../conexion.php';
    include '../funciones_generales.php';
    include '../correos/mail.php';
    $conexion = conectarse();
    // error_reporting(0);

    if (isset($_POST['cargar_pagos'])) {
        $sql = pg_query("SELECT * FROM cheques_compra WHERE CAST(fecha_cobrar AS DATE) > NOW() AND CAST(fecha_cobrar AS DATE) < NOW() + CAST('2 days' AS INTERVAL) AND estado = 'Activo'");
        while($row = pg_fetch_row($sql)) {
            $numero_cheque = $row[1];
            $banco = $row[2];
            $monto = $row[3];

            $data[] = array('numero_cheque' => $numero_cheque, 'banco' => $banco, 'monto' => $monto);
  
        }
        echo $data = json_encode($data); 
    }
?>