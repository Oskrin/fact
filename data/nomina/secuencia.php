<?php
	include '../conexion.php';
	include '../funciones_generales.php';		
	$conexion = conectarse();
	$sql = "";
	$lista1 = array();
	$id_tabla = '';
	if($_GET['fn'] == '0'){//function atras
		if($_GET['id'] == ''){///si exsite un id previo
			$sql = "select id_nomina from nomina order by fecha_creacion desc limit 1";
			$id_tabla = id_unique($conexion, $sql);			
		}else{
			$sql = "select id_nomina from nomina where id_nomina not in (select id_nomina from nomina where id_nomina >= '$_GET[id]' order by id_nomina desc) order by fecha_creacion desc limit 1";
			$id_tabla = id_unique($conexion, $sql);			
		}
		$sql = "select id_nomina,identificacion,nombres_completos,telefono1,telefono2,ciudad,descripcion,direccion,correo,comentario,sueldo,id_usuario from nomina,ciudad where nomina.ciudad = ciudad.id_ciudad and id_nomina = '$id_tabla'";			
		$lista1=array(atras_adelente($conexion,$sql)); 		
		$data = (json_encode($lista1));
		echo $data;
	}else{
		if($_GET['fn'] == '1'){//function adelante
			if($_GET['id'] == ''){///si exsite un id previo
				$sql = "select id_nomina from nomina order by fecha_creacion desc limit 1";
				$id_tabla = id_unique($conexion, $sql);			
			}else{
				$sql = "select id_nomina from nomina where id_nomina not in (select id_nomina from nomina where id_nomina <= '$_GET[id]' order by id_nomina asc) order by fecha_creacion asc limit 1";				
				$id_tabla = id_unique($conexion, $sql);			
			}
			$sql = "select id_nomina,identificacion,nombres_completos,telefono1,telefono2,ciudad,descripcion,direccion,correo,comentario,sueldo,id_usuario from nomina,ciudad where nomina.ciudad = ciudad.id_ciudad and id_cliente = '$id_tabla'";			
			$lista1=array(atras_adelente($conexion,$sql)); 		
			$data = (json_encode($lista1));
			echo $data;
		}	
	}

?>