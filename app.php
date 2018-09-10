<?php 
 	include 'data/conexion.php';
    include 'data/funciones_generales.php';
    $conexion = conectarse();

    $sql = "UPDATE usuario set estado = '0' WHERE id_usuario = '$_POST[id]'";
    $guardar = guardarSql($conexion, $sql);

    $data = 0;
    echo $data;
?>