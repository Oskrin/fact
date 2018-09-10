<?php
	if(!isset($_SESSION)) {
		session_start();		
	}

	require('../../../admin2/mysql.php');
	$class = new constante;

	if (isset($_POST['mostrar_tabla'])) {
		$resultado = $class->consulta("SELECT id, upper(clima) FROM clima WHERE STADO='1';");
		while ($row=$class->fetch_array($resultado)) {	
			$data[]=$row[1];
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
	if (isset($_POST['btn_guardar'])) {
		$id=$class->idz();
		$fecha=$class->fecha_hora();
		$acu[0]=1;//no almacenado
		$resultado = $class->consulta("INSERT INTO clima VALUES ('$id', '$_POST[txt_1]', '1', '$fecha');");
		if (!$resultado) {
			$acu[0]=0;//almacenado
		}
		print_r(json_encode($acu));	
	}
	if (isset($_POST['name'])) {
		if ($_POST['name']=='txt_1_actualizar') {
			$acu[0]=1;//no actualizado
			$resultado = $class->consulta("UPDATE clima SET clima='$_POST[value]' WHERE id='$_POST[pk]';");
			if (!$resultado) {
				$acu[0]=0;// actualizado
			}
		}
	}
	if (isset($_POST['buscar_info'])) {
		$resultado = $class->consulta("SELECT id, upper(clima) FROM clima WHERE ID='$_POST[id]'");
		while ($row=$class->fetch_array($resultado)) {	
			$data[]=$row[0];
			$data[]=$row[1];
		}
		print_r(json_encode($data));
	}
	
	if (isset($_POST['eliminar_registro'])) {
		$acu[0]=1;//no actualizado
		$resultado = $class->consulta("UPDATE clima SET stado='0' WHERE id='$_POST[id]';");
		if (!$resultado) {
			$acu[0]=0;// actualizado
		}
	}
?>