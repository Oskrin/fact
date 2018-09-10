<?php
	include '../conexion.php';
	include '../funciones_generales.php';		
	$conexion = conectarse();
	$sql = "";
	$lista1 = array();
	$id_tabla = '';

	if($_GET['fn'] == '0') {//function atras
		if($_GET['id'] == '') {///si exsite un id previo
			$sql = "SELECT id_usuario FROM usuario ORDER BY fecha_creacion DESC limit 1";
			$id_tabla = id_unique($conexion, $sql);			
		} else {
			$sql = "SELECT id_usuario FROM usuario WHERE id_usuario not in (SELECT id_usuario FROM usuario WHERE id_usuario >= '$_GET[id]' ORDER BY id_usuario DESC) ORDER BY fecha_creacion DESC limit 1";
			$id_tabla = id_unique($conexion, $sql);			
		}

		$sql = "SELECT usuario.id_usuario,identificacion,nombres_completos,telefono1,telefono2,ciudad.id_ciudad,ciudad.descripcion,direccion,correo,usuario,cargo.id_cargo,cargo.descripcion,usuario.estado,imagen,extranjero,clave FROM usuario, ciudad,cargo,claves WHERE usuario.id_ciudad = ciudad.id_ciudad AND cargo.id_cargo = usuario.id_cargo AND claves.id_usuario = usuario.id_usuario AND usuario.id_usuario = '$id_tabla'";			
		$lista1=array(atras_adelente($conexion,$sql)); 		
		$data = (json_encode($lista1));
		echo $data;
	} else {
		if($_GET['fn'] == '1') {//function adelante
			if($_GET['id'] == '') {///si exsite un id previo
				$sql = "SELECT id_usuario FROM usuario ORDER BY fecha_creacion DESC limit 1";
				
				$id_tabla = id_unique($conexion, $sql);			
			} else {
				$sql = "SELECT id_usuario FROM usuario WHERE id_usuario not in (SELECT id_usuario FROM usuario WHERE id_usuario <= '$_GET[id]' ORDER BY id_usuario ASC) ORDER BY fecha_creacion ASC limit 1";				
				$id_tabla = id_unique($conexion, $sql);			
			}

			$sql = "SELECT usuario.id_usuario,identificacion,nombres_completos,telefono1,telefono2,ciudad.id_ciudad,ciudad.descripcion,direccion,correo,usuario,cargo.id_cargo,cargo.descripcion,usuario.estado,imagen,extranjero,clave FROM usuario, ciudad,cargo,claves WHERE usuario.id_ciudad = ciudad.id_ciudad AND cargo.id_cargo = usuario.id_cargo AND claves.id_usuario = usuario.id_usuario AND usuario.id_usuario = '$id_tabla'";			
			$lista1=array(atras_adelente($conexion,$sql)); 		
			$data = (json_encode($lista1));
			echo $data;
		}	
	}
?>