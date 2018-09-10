<?php
    include '../conexion.php';
    include '../funciones_generales.php';		
    $conexion = conectarse();
    $f = split(' - ', $_POST['fecha']);
    $lista = array();

    $sql = pg_query("SELECT fecha,detalle,ingreso,egreso,saldo,referencia FROM movimientos_bancos WHERE fecha between '".$f[0].' 00:00:00'."' and '".$f[1].' 23:59:59'."' order by fecha");
    while ($row = pg_fetch_row($sql)) {            
        $lista[] = $row[0];
        $lista[] = $row[1];
        $lista[] = $row[2];
        $lista[] = $row[3];
        $lista[] = $row[4];
        $lista[] = $row[5];
    } 
                         
    echo json_encode($lista);  
?>