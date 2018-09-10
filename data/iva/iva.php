
<?php

include '../conexion.php';
include '../funciones_generales.php';
$conexion = conectarse();
date_default_timezone_set('America/Guayaquil');
$fecha = date('Y-m-d H:i:s', time());
$fecha_larga = date('His', time());
$sql = "";
$id = unique($fecha_larga);
$id_user = sesion_activa();

if ($_POST['oper'] == "add") {
    $repetidos = repetidos($conexion, "descripcion", strtoupper($_POST['descripcion']), "porcentaje_iva", "g", "", "");
    if ($repetidos == 'true') {
        $data = "1"; /// este dato ya existe;
    } else {
        $sql = "insert into porcentaje_iva values ('$id','". strtoupper($_POST['descripcion']) ."','$fecha','1')";
        $guardar = guardarSql($conexion, $sql);
        $sql_nuevo = "SELECT (id_iva,descripcion,fecha_creacion,estado) FROM porcentaje_iva where id_iva = '$id'";        
        $sql_nuevo = sql_array($conexion,$sql_nuevo);
        auditoria_sistema($conexion,'porcentaje_iva',$id_user,'Insert',$id,$fecha_larga,$fecha,$sql_nuevo,'');
        $data = "2";
    }
} else {
    if ($_POST['oper'] == "edit") {
        $repetidos = repetidos($conexion, "descripcion", strtoupper($_POST['descripcion']), "porcentaje_iva", "m", $_POST['id'], "id_iva");
        if ($repetidos == 'true') {
            $data = "1"; /// este dato ya existe;
        } else {            
            $sql_anterior = "SELECT (id_iva,descripcion,fecha_creacion,estado) FROM porcentaje_iva where id_iva = '$_POST[id]'";        
            $sql_anterior = sql_array($conexion,$sql_anterior);
            $sql = "update porcentaje_iva set descripcion = '" . strtoupper($_POST['descripcion']) . "', fecha_creacion = '$fecha' where id_iva = '$_POST[id]'";            
            $guardar = guardarSql($conexion, $sql);
            $sql_nuevo = "SELECT (id_iva,descripcion,fecha_creacion,estado)  FROM porcentaje_iva where id_iva = '$_POST[id]'";        
            $sql_nuevo = sql_array($conexion,$sql_nuevo);            
            auditoria_sistema($conexion,'porcentaje_iva',$id_user,'Update',$_POST['id'],$fecha_larga,$fecha,$sql_nuevo,$sql_anterior);
            $data = "3";                         
        }
    }
}
echo $data;
?>