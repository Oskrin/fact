<?php
	include '../conexion.php';
	include '../funciones_generales.php';		
	$conexion = conectarse();
	$sql = "";
	$lista1 = array();
	$id_tabla = '';
	if($_GET['fn'] == '0') {//function atras
		if($_GET['id'] == '') {///si exsite un id previo
			$sql = "SELECT id_proveedor FROM proveedor ORDER BY fecha_creacion DESC limit 1";
			$id_tabla = id_unique($conexion, $sql);			
		} else {
			$sql = "SELECT id_proveedor FROM proveedor WHERE id_proveedor not in (SELECT id_proveedor FROM proveedor WHERE id_proveedor >= '$_GET[id]' ORDER BY id_proveedor DESC) ORDER BY fecha_creacion DESC limit 1";
			$id_tabla = id_unique($conexion, $sql);			
		}
		$sql = "SELECT id_proveedor,tipo_documento,identificacion,nombres_completos,tipo,telefono1,telefono2,ciudad,direccion,empresa,visitador,fax,correo,forma_pago,principal,cupo_credito,serie_comprobante,autorizacion_sri,id,id_sustento,id_comprobante,id_usuario,comentario,estado,fecha_creacion,id_compras,id_ret_fuente,id_ret_iva FROM proveedor WHERE id_proveedor = '".$id_tabla."'";			
		$lista1 = array(atras_adelente($conexion,$sql)); 		
		$data = (json_encode($lista1));
		echo $data;
	} else {
		if($_GET['fn'] == '1') { //function adelante
			if($_GET['id'] == '') { //si exsite un id previo
				$sql = "SELECT id_proveedor FROM proveedor ORDER BY fecha_creacion DESC limit 1";
				$id_tabla = id_unique($conexion, $sql);			
			} else {
				$sql = "SELECT id_proveedor FROM proveedor WHERE id_proveedor not in (SELECT id_proveedor FROM proveedor WHERE id_proveedor <= '$_GET[id]' ORDER BY id_proveedor ASC) ORDER BY fecha_creacion ASC limit 1";				
				$id_tabla = id_unique($conexion, $sql);			
			}
			$sql = "SELECT id_proveedor,tipo_documento,identificacion,nombres_completos,tipo,telefono1,telefono2,ciudad,direccion,empresa,visitador,fax,correo,forma_pago,principal,cupo_credito,serie_comprobante,autorizacion_sri,id,id_sustento,id_comprobante,id_usuario,comentario,estado,fecha_creacion,id_compras,id_ret_fuente,id_ret_iva FROM proveedor WHERE id_proveedor = '".$id_tabla."'";			
			$lista1=array(atras_adelente($conexion,$sql)); 		
			$data = (json_encode($lista1));
			echo $data;
		}	
	}
?>