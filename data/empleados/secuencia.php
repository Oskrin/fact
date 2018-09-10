<?php
	include '../conexion.php';
	include '../funciones_generales.php';		
	$conexion = conectarse();
	$sql = "";
	$lista1 = array();
	$id_tabla = '';
	if($_GET['fn'] == '0') {//function atras
		if($_GET['id'] == '') {///si exsite un id previo
			$sql = "SELECT id_nomina FROM nomina ORDER BY fecha_creacion DESC limit 1";
			$id_tabla = id_unique($conexion, $sql);			
		} else {
			$sql = "SELECT id_nomina FROM nomina WHERE id_nomina not in (SELECT id_nomina FROM nomina WHERE id_nomina >= '$_GET[id]' ORDER BY id_nomina DESC) ORDER BY fecha_creacion DESC limit 1";
			$id_tabla = id_unique($conexion, $sql);			
		}
		$sql = "SELECT id_nomina,identificacion,nombres_completos,telefono1,telefono2,ciudad,descripcion,direccion,correo,comentario,sueldo,id_usuario FROM nomina,ciudad WHERE nomina.ciudad = ciudad.id_ciudad AND id_nomina = '$id_tabla'";			
		$lista1=array(atras_adelente($conexion,$sql)); 		
		$data = (json_encode($lista1));
		echo $data;
	} else {
		if($_GET['fn'] == '1') {//function adelante
			if($_GET['id'] == '') {///si exsite un id previo
				$sql = "SELECT id_nomina FROM nomina ORDER BY fecha_creacion DESC limit 1";
				$id_tabla = id_unique($conexion, $sql);			
			} else {
				$sql = "SELECT id_nomina FROM nomina WHERE id_nomina not in (SELECT id_nomina FROM nomina WHERE id_nomina <= '$_GET[id]' ORDER BY id_nomina ASC) ORDER BY fecha_creacion ASC limit 1";				
				$id_tabla = id_unique($conexion, $sql);			
			}
			$sql = "SELECT id_nomina,identificacion,nombres_completos,telefono1,telefono2,ciudad,descripcion,direccion,correo,comentario,sueldo,id_usuario FROM nomina,ciudad WHERE nomina.ciudad = ciudad.id_ciudad AND id_cliente = '$id_tabla'";			
			$lista1 = array(atras_adelente($conexion,$sql)); 		
			$data = (json_encode($lista1));
			echo $data;
		}	
	}

?>