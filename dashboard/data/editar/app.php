<?php
	if(!isset($_SESSION)) {
		session_start();		
	}

	require('../../../admin2/mysql.php');
	$class = new constante;

	// consulta info
	if (isset($_POST['info'])) {
		$data;

		$resultado = $class->consulta("SELECT * FROM usuarios");

		while ($row = $class->fetch_array($resultado)) {
			$data['id']=$row[0];
			$data['nombres']=$row[1];
			$data['apellidos']=$row[2];
			$data['dato1']=$row[3];
			$data['dato2']=$row[4];
			$data['dato3']=$row[5];
		}

		print_r(json_encode($data));

	}


	if (isset($_POST['verificar_existencia_value'])) {
		$resultado = $class->consulta("SELECT password FROM acceso WHERE password = md5('$_POST[txt_1]') AND STADO = '1';");

		if ($class->fetch_array($resultado)>0) {
			$acu = 'true';
		} else {
			$acu = 'false';
		}

		print $acu;
	}


	if (isset($_POST['btn_guardar'])) {

		$acu[0] = 1;
		$resultado = $class->consulta("UPDATE acceso SET password = md5('$_POST[txt_3]')");

		if (!$resultado) {
			$acu[0] = 0;
		}

		$resultado = $class->consulta("UPDATE usuarios SET nombre = '$_POST[nombre]', apellido = '$_POST[apellido]', dato1 = '$_POST[dato1]' , dato2 = '$_POST[dato2]' , dato3 = '$_POST[dato3]'");
		
		print_r(json_encode($acu));	
	}
?>