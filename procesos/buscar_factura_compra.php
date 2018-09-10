<?php

session_start();
include '../data/conexion.php';
conectarse();
$texto = $_GET['term'];

$consulta = pg_query("select id_factura_compra, numero_serie from factura_compra where numero_serie like '%$texto%'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'id_factura_compra' => $row[0],
    );
}
echo $data = json_encode($data);
?>