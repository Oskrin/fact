<?php
	if(!isset($_SESSION)) {
		session_start();		
	}

	require('../../../admin2/mysql.php');
	$class = new constante;

	if (isset($_POST['mostrar_tabla'])) {
		$resultado = $class->consulta("	SELECT id, upper(nombre), upper(propietario), upper(direccion), telefono, correo, 
									       sitio_web,categoria,descripcion, 
									       (SELECT upper(tipo) FROM tipo_establecimientos WHERE id = tipo_establecimiento), 
									       (SELECT upper(nom) FROM parroquias WHERE id = id_parroquia)
										FROM establecimientos WHERE establecimientos.STADO = '1';");
		while ($row=$class->fetch_array($resultado)) {	
			$data[]=$row[1];
			$data[]=$row[2];
			$data[]=$row[3];
			$data[]=$row[4];
			$data[]=$row[5];
			$data[]=$row[6];
			$data[]=$row[7];
			$data[]=$row[8];
			$data[]=$row[9];
			$data[]=$row[10];
			$data[]='
					<button type="button" class="btn btn-outline btn-info btn-xs" onclick=editar("'.$row[0].'")>
						<i class="fa fa-check-square-o"></i>
					</button>
                    <button type="button" class="btn btn-outline btn-warning2 btn-xs" onclick=eliminar("'.$row[0].'")>
                    	<i class="fa fa-minus-square"></i>
                    </button>
					';
		}
		print_r(json_encode($data));
	}

	if (isset($_POST['mostrar_clima'])) {
		$resultado = $class->consulta("SELECT id, upper(clima) FROM clima WHERE STADO = '1';");
		print'<option value=""></option>';
		while ($row = $class->fetch_array($resultado)) {	
			print'<option value="'.$row[0].'">'.$row[1].'</option>';
		}
	}

	if (isset($_POST['mostrar_tipo'])) {
		$resultado = $class->consulta("SELECT id, upper(tipo)  FROM tipo_establecimientos WHERE STADO = '1';");
		print'<option value=""></option>';
		while ($row = $class->fetch_array($resultado)) {	
			print'<option value="'.$row[0].'">'.$row[1].'</option>';
		}
	}

	if (isset($_POST['mostrar_parroquia'])) {
		$resultado = $class->consulta("SELECT id, upper(nom) FROM parroquias WHERE STADO = '1';");
		print'<option value=""></option>';
		while ($row = $class->fetch_array($resultado)) {	
			print'<option value="'.$row[0].'">'.$row[1].'</option>';
		}
	}

	if (isset($_POST['name'])) {
		if ($_POST['name'] == 'txt_1_actualizar') {
			$acu[0] = 1;//no actualizado
			$resultado = $class->consulta("UPDATE parroquias SET nom='$_POST[value]' WHERE id = '$_POST[pk]';");
			if (!$resultado) {
				$acu[0] = 0;// actualizado
			}
		}
	}

	if (isset($_POST['buscar_info'])) {
		$resultado = $class->consulta("SELECT id, upper(nom) FROM parroquias WHERE ID = '$_POST[id]'");
		while ($row = $class->fetch_array($resultado)) {	
			$data[] = $row[0];
			$data[] = $row[1];
		}
		print_r(json_encode($data));
	}
	
	if (isset($_POST['eliminar_registro'])) {
		$acu[0] = 1;//no actualizado
		$resultado = $class->consulta("UPDATE establecimientos SET stado='0' WHERE id = '$_POST[id]';");
		if (!$resultado) {
			$acu[0] = 0;// actualizado
		}
	}
	
	if (isset($_POST['verificar_existencia_value'])) {
		$resultado = $class->consulta("SELECT nombre FROM establecimientos WHERE upper(NOMBRE)=upper('$_POST[txt_1]') AND STADO = '1';");
		$acu = 'true';
		if ($class->fetch_array($resultado)>0) {
			$acu = 'false';
		}
		print $acu;
	}

	if (isset($_POST['llenar_establecimientos'])) {
		$resultado = $class->consulta("SELECT * FROM establecimientos where id = '$_POST[id]'");
		while ($row = $class->fetch_array($resultado)) {
			$data = array('id' => $row[0], 
						'tipo_establecimiento' => $row[1],
						'nombre' => $row[2],
						'propietario' => $row[3],
						'direccion' => $row[4],
						'posicion' => $row[5],
						'categoria' => $row[6],
						'n_hab' => $row[7],
						'n_plazas' => $row[8],
						'telefono' => $row[9],
						'correo' => $row[10],
						'sitio_web' => $row[11],
						'descripcion' => $row[12],
						'id_parroquia' => $row[13]	
						);
		}
		print_r(json_encode($data));
	}
?>

