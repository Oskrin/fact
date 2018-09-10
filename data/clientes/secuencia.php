<?php
	include '../conexion.php';
	include '../funciones_generales.php';		
	$conexion = conectarse();
	$sql = "";
	$lista1 = array();
	$id_tabla = '';

	if($_GET['fn'] == '0') {//function atras
		if($_GET['id'] == '') {///si exsite un id previo
			$sql = "SELECT id_cliente FROM cliente ORDER BY fecha_creacion DESC limit 1";
			$id_tabla = id_unique($conexion, $sql);			
		} else {
			$sql = "SELECT id_cliente FROM cliente WHERE id_cliente not in (SELECT id_cliente FROM cliente WHERE id_cliente >= '$_GET[id]' ORDER BY id_cliente DESC) ORDER BY fecha_creacion DESC limit 1";
			$id_tabla = id_unique($conexion, $sql);			
		}

		$sql = "SELECT id_cliente,tipo_documento,identificacion,nombres_completos,tipo,telefono1,telefono2,ciudad,descripcion,direccion,correo,comentario,cupo_credito,id_usuario FROM cliente,ciudad WHERE cliente.ciudad = ciudad.id_ciudad AND id_cliente = '$id_tabla'";			
		$lista1=array(atras_adelente($conexion,$sql)); 		
		$data = (json_encode($lista1));

		echo $data;
	} else {
		if($_GET['fn'] == '1') {//function adelante
			if($_GET['id'] == '') {///si exsite un id previo
				$sql = "SELECT id_cliente FROM cliente ORDER BY fecha_creacion DESC limit 1";
				$id_tabla = id_unique($conexion, $sql);			
			} else {
				$sql = "SELECT id_cliente FROM cliente WHERE id_cliente not in (SELECT id_cliente FROM cliente WHERE id_cliente <= '$_GET[id]' ORDER BY id_cliente ASC) ORDER BY fecha_creacion ASC limit 1";				
				$id_tabla = id_unique($conexion, $sql);			
			}
			$sql = "SELECT id_cliente,tipo_documento,identificacion,nombres_completos,tipo,telefono1,telefono2,ciudad,descripcion,direccion,correo,comentario,cupo_credito,id_usuario FROM cliente,ciudad WHERE cliente.ciudad = ciudad.id_ciudad AND id_cliente = '$id_tabla'";			
			$lista1 = array(atras_adelente($conexion,$sql)); 		
			$data = (json_encode($lista1));

			echo $data;
		}	
	}
?>