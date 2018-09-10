<?php

session_start();
include '../data/conexion.php';
conectarse();
$texto = $_GET['term'];

$consulta = pg_query("select D.id_devolucion, F.numero_serie from devolucion_compra D, factura_compra F where D.id_factura_compra = F.id_factura_compra and F.numero_serie like '%$texto%'");
while ($row = pg_fetch_row($consulta)) {
    $data[] = array(
        'value' => $row[1],
        'id_devolucion_compra' => $row[0],
    );
}
echo $data = json_encode($data);
?>