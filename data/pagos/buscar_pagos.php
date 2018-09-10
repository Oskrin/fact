<?php

session_start();
include '../conexion.php';
$conexion = conectarse();

$consulta = pg_query("SELECT D.fecha_pagos, D.cuota, D.saldo FROM pagos_venta P, detalle_pagos_venta D WHERE P.id_pagos_venta = D.id_pagos_venta AND P.id_pagos_venta = '$_POST[id]' AND D.estado = 'Activo' order by D.id_detalles_pagos_venta asc ");
while ($row = pg_fetch_row($consulta)) {
    $lista[] = $row[0];
    $lista[] = $row[1];
    $lista[] = $row[2];
}

echo $lista = json_encode($lista);
?>
