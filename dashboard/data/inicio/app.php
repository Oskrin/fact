<?php
	if(!isset($_SESSION)) {
		session_start();		
	}
	
	require('../../../admin2/mysql.php');
	$class = new constante;

	if (isset($_POST['llenar_mapa'])) {
		$resultado = $class->consulta("	SELECT id,'lugar_turistico' as lugar, posicion FROM lugar_turistico WHERE STADO='1';");
		while ($row=$class->fetch_array($resultado)) {	
			$data[]= array($row[0],$row[1],$row[2]);			
		}
		$resultado = $class->consulta("	SELECT id,'establecimiento' as lugar, posicion FROM establecimientos WHERE STADO='1';");
		while ($row=$class->fetch_array($resultado)) {	
			$data[]= array($row[0],$row[1],$row[2]);			
		}
		
		print_r(json_encode($data));
	}
	if (isset($_POST['mostrar_info'])) {
		$data;
		if ($_POST['ty']=='lugar_turistico') {
			$resultado = $class->consulta("	SELECT nombre, propietario, direccion, telefono, correo,sitio_web, descripcion,
												(SELECT tipo FROM tipo_lugar_turistico WHERE ID=id_tipo_lugar_turistico) as tipo,
												(SELECT clima FROM clima WHERE ID=id_clima) as clima,
												(SELECT nom FROM parroquias WHERE ID=id_parroquia) as parroquia
											FROM lugar_turistico WHERE ID='$_POST[id]';");
			while ($row=$class->fetch_array($resultado)) {	
				$data['nombre']=$row['nombre'];
				$data['propietario']=$row['propietario'];
				$data['direccion']=$row['direccion'];
				$data['telefono']=$row['telefono'];
				$data['correo']=$row['correo'];
				$data['sitio_web']=$row['sitio_web'];
				$data['descripcion']=$row['descripcion'];
				$data['parroquia']=$row['parroquia'];
				$data['clima']=$row['clima'];
				$data['tipo']=$row['tipo'];				
			}
			$acu= array();
			$resultado = $class->consulta("	SELECT url_img FROM img_lugares_establecimientos WHERE ID_REFERENCIA='$_POST[id]';");
			while ($row=$class->fetch_array($resultado)) {	
				$acu[]=$row['url_img'];
			}
			$data['fotos']=$acu;
		}
			
		if ($_POST['ty']=='establecimiento') {
			$resultado = $class->consulta("	SELECT nombre, propietario, direccion, posicion, telefono, correo,sitio_web, descripcion,
												categoria, n_hab, n_plazas,
												(SELECT tipo FROM tipo_establecimientos WHERE ID=tipo_establecimiento) as tipo,
												(SELECT nom FROM parroquias WHERE ID=id_parroquia) as parroquia
											FROM establecimientos WHERE ID='$_POST[id]';");
			while ($row=$class->fetch_array($resultado)) {	
				$data['nombre']=$row['nombre'];
				$data['propietario']=$row['propietario'];
				$data['direccion']=$row['direccion'];
				$data['telefono']=$row['telefono'];
				$data['correo']=$row['correo'];
				$data['sitio_web']=$row['sitio_web'];
				$data['descripcion']=$row['descripcion'];
				$data['parroquia']=$row['parroquia'];
				$data['tipo']=$row['tipo'];
			}
			$acu= array();
			$resultado = $class->consulta("	SELECT url_img FROM img_lugares_establecimientos WHERE ID_REFERENCIA='$_POST[id]';");
			while ($row=$class->fetch_array($resultado)) {	
				$acu[]=$row['url_img'];
			}
			$data['fotos']=$acu;
		}		
		print_r(json_encode($data));
	}
?>

