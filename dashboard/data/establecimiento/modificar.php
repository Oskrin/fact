<?php 
	if(!isset($_SESSION)) {
		session_start();		
	}

	require('../../../admin2/mysql.php');
	$class = new constante;

	// if (isset($_POST['btn_modificar'])) {
		$id = $class->idz();
		$fecha = $class->fecha_hora();
		// $data = "";
		// if (isset($_FILES['txt_x'])) {
		// 	$carpeta = 'img/'.$id;
		// 	if (!file_exists($carpeta)) {//verificando existencia de directorio
		// 	    mkdir($carpeta, 0777, true);
		// 	};
		// 	for ($i = 0; $i < count($_FILES['txt_x']['name']); $i++) { 
		// 		$id_= $class->idz();
		// 		$nom = $_FILES['txt_x']['name'][$i];
		// 		$url_img = 'img/'.$id.'/'.$nom;
		// 		move_uploaded_file ($_FILES['txt_x']['tmp_name'][$i], $url_img);  // Subimos el archivo 
		// 		$class->consulta("INSERT INTO img_lugares_establecimientos VALUES ('$id_', '$id', 'lugar-turistico', '$url_img', '1', '$fecha');");
		// 	}		
		// }
		$acu[0] = 1;//no almacenado

		$resultado = $class->consulta("UPDATE establecimientos SET			tipo_establecimiento = '$_POST[sel_10]',
																			nombre = '$_POST[txt_1]',
																			propietario = '$_POST[txt_2]',
																			direccion = '$_POST[txt_3]',
																			posicion = '$_POST[txt_4]',
																			categoria = '$_POST[txt_14]',
																			n_hab = '$_POST[txt_12]',
																			n_plazas = '$_POST[txt_13]',
																			telefono = '$_POST[txt_5]',
																			correo = '$_POST[txt_6]',
																			sitio_web = '$_POST[txt_7]',
																			descripcion = '$_POST[txt_9]',
																			id_parroquia = '$_POST[sel_11]'
																			WHERE id = '$_POST[id]'");
		if (!$resultado) {
			$acu[0] = 0;//modificado
		}

		print_r(json_encode($acu));	
	// }

?>