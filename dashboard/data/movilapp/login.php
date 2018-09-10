<?php
 	require('../../../admin/class.php');
	$class=new constante();
	if (isset($_GET['llenar_parroquias'])) {
		$resultado = $class->consulta("	SELECT id, nom FROM parroquias WHERE STADO='1';");
		while ($row=$class->fetch_array($resultado)) {	
			$data[] = array('id' => $row['id'], 'nom' => $row['nom']);	
		}
		print $_GET['callback'] . '('.json_encode($data).')';
	}
	if (isset($_GET['origen_fin_ruta'])) {
		$resultado = $class->consulta("	SELECT 
											id, nombre, propietario, direccion, posicion, telefono, correo, 
										    sitio_web, descripcion
										FROM lugar_turistico WHERE id='$_GET[id]';");
		while ($row=$class->fetch_array($resultado)) {	
			$data[] = array(
							'id' => $row['id'],
			 				'nombre' => $row['nombre'],
			 				'direccion' => $row['direccion'],
			 				'posicion' => $row['posicion'],
			 				'telefono' => $row['telefono'],
			 				'correo' => $row['correo'],
			 				'sitio_web' => $row['sitio_web'],
			 				'descripcion' => $row['descripcion']
			 				);	
		}
		$resultado = $class->consulta("	SELECT 
											id, nombre, propietario, direccion, posicion, telefono, correo, 
										    sitio_web, descripcion
										FROM establecimientos WHERE id='$_GET[id]';");
		while ($row=$class->fetch_array($resultado)) {	
			$data[] = array(
							'id' => $row['id'],
			 				'nombre' => $row['nombre'],
			 				'direccion' => $row['direccion'],
			 				'posicion' => $row['posicion'],
			 				'telefono' => $row['telefono'],
			 				'correo' => $row['correo'],
			 				'sitio_web' => $row['sitio_web'],
			 				'descripcion' => $row['descripcion']
			 				);	
		}
		print $_GET['callback'] . '('.json_encode($data).')';
	}
	if (isset($_GET['llenar_lugares_turisticos'])) {
		$resultado = $class->consulta("	SELECT id, nombre, propietario, direccion, telefono, correo,sitio_web, descripcion,
											(SELECT tipo FROM tipo_lugar_turistico WHERE ID=id_tipo_lugar_turistico) as tipo,
											(SELECT clima FROM clima WHERE ID=id_clima) as clima,
											(SELECT nom FROM parroquias WHERE ID=id_parroquia) as parroquia	
										FROM lugar_turistico;");
		while ($row=$class->fetch_array($resultado)) {
			$img=imgurl($row['id']);
			$data[] = array('id' => $row['id'], 'nombre' => $row['nombre'], 'descripcion' => $row['descripcion'],'img'=>$img);
		}
		print $_GET['callback'] . '('.json_encode($data).')';
	}
	if (isset($_GET['address_info_datos'])) {
		$resultado = $class->consulta("SELECT posicion, direccion FROM lugar_turistico WHERE ID='$_GET[id]';");
		while ($row=$class->fetch_array($resultado)) {
			$posicion=explode(",", $row['posicion']);
			$data[] = array('latitud' => $posicion[0], 'longitud' => $posicion[1], 'direccion' => $row['direccion'] );
		}
		print $_GET['callback'] . '('.json_encode($data).')';
	}
	
	if (isset($_GET['informacion_lugar_turistico'])) {
		$resultado = $class->consulta("	SELECT id, nombre, propietario, direccion, telefono, correo,sitio_web, descripcion,
											(SELECT tipo FROM tipo_lugar_turistico WHERE ID=id_tipo_lugar_turistico) as tipo,
											(SELECT clima FROM clima WHERE ID=id_clima) as clima,
											(SELECT nom FROM parroquias WHERE ID=id_parroquia) as parroquia	
										FROM lugar_turistico WHERE ID='$_GET[id]';");
		while ($row=$class->fetch_array($resultado)) {
			$img=imgurl($row['id']);
			$data[] = array('id' => $row['id'], 
							'nombre' => $row['nombre'], 
							'propietario' => $row['propietario'],
							'direccion' => $row['direccion'],
							'telefono' => $row['telefono'],
							'correo' => $row['correo'],
							'sitio_web' => $row['sitio_web'],
							'descripcion' => $row['descripcion'],
							'tipo' => $row['tipo'],
							'parroquia' => $row['parroquia'],
							'img'=>$img);
		}
		print $_GET['callback'] . '('.json_encode($data).')';
	}
	if (isset($_GET['llenar_establecimiento'])) {
		$resultado = $class->consulta("	SELECT id, nombre, propietario, direccion, posicion, telefono, correo,sitio_web, descripcion,
												categoria, n_hab, n_plazas,
												(SELECT tipo FROM tipo_establecimientos WHERE ID=tipo_establecimiento) as tipo,
												(SELECT nom FROM parroquias WHERE ID=id_parroquia) as parroquia
											FROM establecimientos;");
		while ($row=$class->fetch_array($resultado)) {
			$img=imgurl($row['id']);
			$data[] = array('id' => $row['id'], 'nombre' => $row['nombre'], 'descripcion' => $row['descripcion'],'img'=>$img);
		}
		print $_GET['callback'] . '('.json_encode($data).')';
	}
	if (isset($_GET['info_estab'])) {
		$resultado = $class->consulta("	SELECT id, nombre, propietario, direccion, posicion, telefono, correo,sitio_web, descripcion,
												categoria, n_hab, n_plazas,
												(SELECT tipo FROM tipo_establecimientos WHERE ID=tipo_establecimiento) as tipo,
												(SELECT nom FROM parroquias WHERE ID=id_parroquia) as parroquia
											FROM establecimientos WHERE ID='$_GET[id]';");
		while ($row=$class->fetch_array($resultado)) {
			$img=imgurl($row['id']);
			$data[] = array('id' => $row['id'],
							'nombre' => $row['nombre'], 
							'propietario' => $row['propietario'],
							'direccion' => $row['direccion'],
							'posicion' => $row['posicion'],
							'telefono' => $row['telefono'],
							'correo' => $row['correo'],
							'sitio_web' => $row['sitio_web'],
							'descripcion' => $row['descripcion'],
							'categoria' => $row['categoria'],
							'n_hab' => $row['n_hab'],
							'n_plazas' => $row['n_plazas'],
							'tipo' => $row['tipo'],
							'parroquia' => $row['parroquia'],
							'img'=>$img
							);
		}
		print $_GET['callback'] . '('.json_encode($data).')';
	}
	

	
	function imgurl($id){
		$class=new constante();
		$retorno='hola';
		$res = $class->consulta("SELECT url_img FROM img_lugares_establecimientos WHERE ID_REFERENCIA='$id';");
			while ($r=$class->fetch_array($res)) {
				$retorno=$r['url_img'];
			}
		return $retorno;
	}
	if (isset($_GET['registro_usuario'])) {
		$id=$class->idz();
		$id1=$class->idz();
		$fecha=$class->fecha_hora();
		$res = $class->consulta("	INSERT INTO cliente.turista
									    VALUES ('$id', '$_GET[nombre]', '$_GET[user]', '', '', '', '1','$fecha');");
		$res = $class->consulta("	INSERT INTO cliente.acceso_turista
									    VALUES ('$id1', '$id','$_GET[user]',md5('$_GET[pass]'), '1','$fecha');");
		if ($res) {
			$data[0]='0';
		}else{
			$data[0]='1';
		}
		print $_GET['callback'] . '('.json_encode($data).')';
	}
	if (isset($_GET['acceso_usuario'])) {
		$stado=0;
		$resultado = $class->consulta("	SELECT CAT.id_turista as id, CAT.correo, CT.nombre, CT.telefono, CT.direccion
										FROM cliente.acceso_turista CAT, cliente.turista CT  
										WHERE CAT.ID_TURISTA=CT.ID AND CAT.correo='$_GET[user]' AND CAT.password=md5('$_GET[pass]') AND CAT.stado='1';");
		while ($row=$class->fetch_array($resultado)) {
			$acu[] = array('id' => $row['id'], 
							'correo' => $row['correo'], 
							'nombre' => $row['nombre'],
							'telefono' => $row['telefono'],
							'direccion' => $row['direccion']
							);
			$stado=1;
		}
		if ($stado==1) {
			$data = array('stado' => $stado, 'modelo'=>$acu);
		}else{
			$data = array('stado' => $stado);
		}
		
		print $_GET['callback'] . '('.json_encode($data).')';
	}
	
 		
?>