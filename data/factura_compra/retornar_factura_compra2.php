<?php
	session_start();
	include '../conexion.php';
	conectarse();
	error_reporting(0);
	$id = $_GET['com'];
	$arr_data = array();

	$consulta = pg_query("SELECT D.id_productos, P.codigo, P.descripcion, D.cantidad, D.precio, D.descuento, D.total, PI.porcentaje, P.incluye_iva FROM factura_compra F, detalle_factura_compra D, productos P, porcentaje_iva PI WHERE P.id_porcentaje_iva = PI.id_porcentaje_iva AND D.id_productos = P.id_productos AND F.id_factura_compra = D.id_factura_compra AND D.id_factura_compra='" . $id . "'");
	while ($row = pg_fetch_row($consulta)) {
	    $arr_data[] = $row[0];
	    $arr_data[] = $row[1];
	    $arr_data[] = $row[2];
	    $arr_data[] = $row[3];
	    $arr_data[] = $row[4];
	    $arr_data[] = $row[5];
	    $arr_data[] = $row[6];
	    $arr_data[] = $row[7];
	    $arr_data[] = $row[8];
	}
	
	echo json_encode($arr_data);
?>
