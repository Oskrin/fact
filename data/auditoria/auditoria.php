<?php
include '../conexion.php';
include '../funciones_generales.php';		
$conexion = conectarse();
$f = split(' - ', $_POST['fecha']);


$consulta = pg_query("SELECT U.identificacion, U.nombres_completos, A.proceso, A.nombre_tabla, A.fecha_creacion FROM auditoria A, usuario U WHERE  A.fecha_creacion between '".$f[0].' 00:00:00'."' AND '".$f[1].' 23:59:59'."' AND A.id_usuario = U.id_usuario AND U.id_usuario = '".$_POST['id']."' order by A.fecha_creacion");
while ($row = pg_fetch_row($consulta)) {
    $lista[] = $row[0];
    $lista[] = $row[1];
    $lista[] = $row[2];
    $lista[] = $row[3];
    $lista[] = $row[4];
}
echo $lista = json_encode($lista);
?>