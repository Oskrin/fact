<?php
include '../conexion.php';
include '../funciones_generales.php';       
$conexion = conectarse();

$sql = pg_query("SELECT P.codigo, P .descripcion, P.stock, K.id_kardex from kardex k, productos P where P.id_productos = K.id_productos AND K.id_productos = '".$_POST['id']."'");
while ($row = pg_fetch_row($sql)) {
    $codigo = $row[0];
    $descripcion = $row[1];
    $stock = $row[2];
    $id_kardex = $row[3];
}

$consulta = pg_query("SELECT SUM(CAST(c_e AS INT)) cantidad_entrada, SUM(CAST(c_s AS INT)) cantidad_salida FROM detalles_kardex WHERE id_kardex = '".$id_kardex."'");
while ($row = pg_fetch_row($consulta)) {
    $cantidad_entrada = $row[0];
    $cantidad_salida = $row[1];
}
$lista = array('codigo' => $codigo, 'descripcion' => $descripcion, 'cantidad_entrada' => $cantidad_entrada, 'cantidad_salida' => $cantidad_salida, 'stock' => $stock);



echo $lista = json_encode($lista);
?>