<?php

session_start();
include '../data/conexion.php';
conectarse();
$texto = $_GET['term'];

$consulta = pg_query("select * from proveedor where empresa like '%$texto%'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[9],
        'id_proveedor' => $row[0]
    );
}
echo $data = json_encode($data);
?>
