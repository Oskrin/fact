<?php
    session_start();
    include '../conexion.php';
    conectarse();
    error_reporting(0);
    $codigo_barras = $_GET["codigo_barras"];
    $precio = $_GET["precio"];
    $arr_data = array();

    if ($codigo_barras != "") {
        $consulta = pg_query("SELECT * FROM productos P, porcentaje_iva I WHERE P.id_porcentaje_iva = I.id_iva AND P.estado = 'Si' AND P.codigo_barras = '$codigo_barras'");
        while ($row = pg_fetch_row($consulta)) {
            $arr_data[] = $row[0];
            $arr_data[] = $row[1];
            $arr_data[] = $row[3];
            $arr_data[] = $row[4];
            $arr_data[] = $row[27];
            $arr_data[] = $row[10];
            $arr_data[] = $row[29];
            $arr_data[] = $row[15];
            $arr_data[] = $row[26];
        }
    }
    
    echo json_encode($arr_data);
?>