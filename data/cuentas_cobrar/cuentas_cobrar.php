<?php 
    include '../conexion.php';
    include '../funciones_generales.php';
    include '../correos/mail.php';
    error_reporting(0);

    $conexion = conectarse();
    date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d H:i:s', time());
    $fecha_larga = date('His', time());
    $sql = "";
    $sql2 = "";	
    $sql3 = "";
    $sql4 = "";
    $id_session = sesion_activa();///datos session

    // modificar pagos
    $consulta = pg_query("SELECT * FROM detalle_pagos_venta WHERE id_detalles_pagos_venta = '$_POST[id]'");
    while ($row = pg_fetch_row($consulta)) {
        $id_pagos_venta = $row[1];
        $monto = $row[4];

        $consulta2 = pg_query("SELECT * FROM pagos_venta WHERE id_pagos_venta = '$id_pagos_venta'");
        while ($row = pg_fetch_row($consulta2)) {
            $saldo = $row[8];

            $cal = $row[8] - $monto;
            $format_numero = number_format($cal, 2, '.', '');
            if ($format_numero == '0.00') {
               pg_query("Update pagos_venta Set saldo='" . $format_numero . "', estado = 'Cancelado' where id_pagos_venta='" . $id_pagos_venta . "'");
               pg_query("Update detalle_pagos_venta Set estado ='Cancelado' where id_detalles_pagos_venta='" . $_POST['id'] . "'");
            } else {
                pg_query("Update pagos_venta Set saldo='" . $format_numero . "' where id_pagos_venta='" . $id_pagos_venta . "'");
                pg_query("Update detalle_pagos_venta Set estado ='Cancelado' where id_detalles_pagos_venta='" . $_POST['id'] . "'");
            }
        }
    }
    // fin

    $data = $_POST['id']; /// error al guardar

    echo $data;

    if (isset($_POST['cargar_pagos'])) {
        $sql = pg_query("SELECT * FROM detalle_pagos_venta WHERE CAST(fecha_pagos AS DATE) > NOW() AND CAST(fecha_pagos AS DATE)  < NOW() + CAST('2 days' AS INTERVAL) AND  estado = 'Activo';");
        while($row = pg_fetch_row($sql)) {
            $id_pagos_venta = $row[1];
            $cuota = $row[3];

            $sql2 = pg_query("SELECT id_factura_venta FROM pagos_venta WHERE id_pagos_venta = '$id_pagos_venta'");
            while($row2 = pg_fetch_row($sql2)) {
                $id_factura_venta = $row2[0];

                $sql3 = pg_query("SELECT id_cliente FROM factura_venta WHERE id_factura_venta = '$id_factura_venta'");
                while($row3 = pg_fetch_row($sql3)) {
                    $id_cliente = $row3[0];

                    $sql4 = pg_query("SELECT identificacion, nombres_completos, telefono2, direccion FROM cliente WHERE id_cliente ='$id_cliente'");
                    while($row4 = pg_fetch_row($sql4)) {
                        $identificacion = $row4[0];
                        $nombres_completos = $row4[1];
                        $telefono2 = $row4[2];

                        $data[] = array('identificacion' => $identificacion, 'nombres_completos' => $nombres_completos, 'telefono2' => $telefono2, 'cuota' => $cuota);

                        // print $direccion;
                    } 
                } 
            }    
        }
        echo $data = json_encode($data); 

        // print $identificacion;
    }
?>