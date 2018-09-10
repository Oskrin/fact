<?php 
    // datos pagos venta
    // $campo1 = $_POST['campo1'];
    // $campo2 = $_POST['campo2'];
    // $campo3 = $_POST['campo3'];
    // $campo4 = $_POST['campo4'];
    // $campo5 = $_POST['campo5'];
    // $campo6 = $_POST['campo6'];
    // // fin

    // // descomponer detalle pagos venta
    // $arreglo1 = explode('|', $campo1);
    // $arreglo2 = explode('|', $campo2);
    // $arreglo3 = explode('|', $campo3);
    // $arreglo4 = explode('|', $campo4);
    // $arreglo5 = explode('|', $campo5);
    // $arreglo6 = explode('|', $campo6);
    // $nelem = count($arreglo1);

    // for ($i = 1; $i < $nelem; $i++) {
    // 	$id1 = unique($fecha_larga);
    // 	$id2 = unique($fecha_larga);

    // 	// guardar pagos
    // 	pg_query("insert into pagos_cobrar values('$id1','".$_POST['id_cliente']."','".$id_session."', '".$_POST['fecha_actual']."','".$_POST['hora_actual']."','".$_POST['formas']."','$arreglo2[$i]','$arreglo3[$i]','$arreglo4[$i]','$arreglo5[$i]','$arreglo6[$i]','".$_POST['observaciones']."','Activo','$fecha','".$_SESSION['id']."')");
    //     // fin

    // 	// modificar pagos
    //     $consulta = pg_query("select * from pagos_venta where id_pagos_venta = '".$arreglo1[$i]."'");
    //     while ($row = pg_fetch_row($consulta)) {
    //         $saldo = $row[8];
    //     }
    //     // fin

    //     $cal = $saldo - $arreglo5[$i];

    //     $format_numero = number_format($cal, 2, '.', '');

    //     if ($format_numero == 0) {
    //         pg_query("Update pagos_venta Set saldo='" . $format_numero . "', estado='Cancelado' where id_pagos_venta='" . $arreglo1[$i] . "'");
    //     } else {
    //         pg_query("Update pagos_venta Set saldo='" . $format_numero . "' where id_pagos_venta='" . $arreglo1[$i] . "'");
    //     }

    //     // procedimiento 1
    //     $consulta3 = pg_query("select * from detalle_pagos_venta where id_pagos_venta = '$arreglo1[$i]' and estado='Activo' order by id_detalles_pagos_venta desc");
    //     while ($row = pg_fetch_row($consulta3)) {
    //         $id = $row[0];
    //         $saldo2 = $row[4];
    //         $fecha_mes = $row[2];
    //     }

    //     $cal2 = $saldo2 - $arreglo5[$i];
    //     $format_numero2 = number_format($cal2, 2, '.', '');

    //     if ($cal2 <= 0) {
    //         pg_query("Update detalle_pagos_venta Set saldo='0.00', estado='Cancelado'  where id_detalles_pagos_venta = '" . $id . "' and id_pagos_venta='" . $arreglo1[$i] . "' and estado='Activo' ");
    //         pg_query("insert into detalle_pagos_internos values('$id2','$id1','$fecha_mes','$saldo2','0.00','Pasivo')");
    //     } else {
    //         pg_query("Update detalle_pagos_venta Set saldo='" . $format_numero2 . "' where id_detalles_pagos_venta = '" . $id . "' and id_pagos_venta='" . $arreglo1[$i] . "' and estado='Activo' ");
    //         pg_query("insert into detalle_pagos_internos values('$id2','$id1','$fecha_mes','" . abs(($saldo2 - $cal2)) . "','$cal2','Activo')");
    //     }
    //     // fin
        
    //     // procedimiento 2
    //     if ($cal2 < 0) {
    //         $consulta3 = pg_query("select * from detalle_pagos_venta where id_pagos_venta = '$arreglo1[$i]' and estado='Activo' order by id_detalles_pagos_venta desc");
    //         while ($row = pg_fetch_row($consulta3)) {
    //             $ids = $row[0];
    //             $saldo3 = $row[4];
    //             $fecha_mes2 = $row[2];
    //         }

    //         $cal3 = ($saldo3 - (abs($cal2)));
    //         $format_numero3 = number_format($cal3, 2, '.', '');

    //         if ($cal3 <= 0) {
    //             pg_query("Update detalle_pagos_venta Set saldo='0.00' , estado='Cancelado'  where id_detalles_pagos_venta = '" . $ids . "' and id_pagos_venta='" . $arreglo1[$i] . "' and estado='Activo' ");
    //             pg_query("insert into detalle_pagos_internos values('$id2','$id1','$fecha_mes2','$saldo3','0.00','Pasivo')");
    //         } else {
    //             pg_query("Update detalle_pagos_venta Set saldo='" . $format_numero3 . "' where id_detalles_pagos_venta = '" . $ids . "' and id_pagos_venta='" . $arreglo1[$i] . "' and estado='Activo' ");
    //             pg_query("insert into detalle_pagos_internos values('$id2','$id1','$fecha_mes2','" . abs($cal2) . "','$cal3','Activo')");
    //         }
    //     }
    //     // fin
        
    //     // procedimiento 3
    //     if ($cal3 < 0) {
    //         $consulta3 = pg_query("select * from detalle_pagos_venta where id_pagos_venta = '$arreglo1[$i]' and estado='Activo' order by id_detalles_pagos_venta desc");
    //         while ($row = pg_fetch_row($consulta3)) {
    //             $idss = $row[0];
    //             $saldo4 = $row[4];
    //             $fecha_mes3 = $row[2];
    //         }

    //         $cal4 = ($saldo4 - (abs($cal3)));
    //         $format_numero4 = number_format($cal4, 2, '.', '');

    //         if ($cal4 <= 0.00) {
    //             pg_query("Update detalle_pagos_venta Set saldo='0.00' , estado='Cancelado'  where id_detalles_pagos_venta = '" . $idss . "' and id_pagos_venta='" . $arreglo1[$i] . "' and estado='Activo' ");
    //             pg_query("insert into detalle_pagos_internos values('$id2','$id1','$fecha_mes3','$saldo4','0.00','Pasivo')");
    //         } else {
    //             pg_query("Update detalle_pagos_venta Set saldo='" . $format_numero4 . "' where id_detalles_pagos_venta = '" . $idss . "' and id_pagos_venta='" . $arreglo1[$i] . "' and estado='Activo' ");
    //             pg_query("insert into detalle_pagos_internos values('$id2','$id1','$fecha_mes3','" . abs($cal3) . "','$cal4','Activo')");
    //         }
    //     }
    //     // fin
        
    //     // registrar libro diario
    // 	$id_libro  = unique($fecha_larga);
    	
    // 	$sql_libro = "insert into libro_diario values ('".$id_libro."','".$fecha."','".$arreglo5[$i]."','','11501155240ac39d2f0','Tabla Pagos Cobrar','Cobro en efectivo del documento'.$arreglo1[1])";///caja
    // 	$guardar = guardarSql($conexion,$sql_libro);

    // 	$id_libro  = unique($fecha_larga);
    // 	$sql_libro = "insert into libro_diario values ('".$id_libro."','".$fecha."','','".$arreglo5[$i]."','11501155240ac39f4e6','Tabla Pagos Cobrar','Cobro cuentas cobrar')";///cuentas por cobrar
    // 	$guardar = guardarSql($conexion, $sql_libro);	
    // 	// fin
    // }


?>