<?php
	if(!isset($_SESSION)) {
		session_start();		
	}

	require('../../../admin2/mysql.php');
	$class = new constante; 

	// if (isset($_POST['btn_guardar'])) {
		$id = $class->idz();
		$fecha = $class->fecha_hora();
		if (isset($_FILES['txt_x'])) {
			$carpeta = 'img/'.$id;
			if (!file_exists($carpeta)) {//verificando existencia de directorio
			    mkdir($carpeta, 0777, true);
			};
			for ($i=0; $i < count($_FILES['txt_x']['name']); $i++) { 
				$id_=$class->idz();
				$nom=$_FILES['txt_x']['name'][$i];
				$url_img='img/'.$id.'/'.$nom;
				move_uploaded_file ($_FILES['txt_x']['tmp_name'][$i], $url_img);  // Subimos el archivo 
				$class->consulta("INSERT INTO img_lugares_establecimientos VALUES ('$id_', '$id', 'establecimiento', '$url_img', '1', '$fecha');");
			}		
		}

		$acu[0] = 1;//no almacenado
		$resultado = $class->consulta("INSERT INTO establecimientos VALUES (	 '$id',
																		'$_POST[sel_10]',
																		'$_POST[txt_1]',
																		'$_POST[txt_2]',
																		'$_POST[txt_3]',
																		'$_POST[txt_4]',
																		'$_POST[txt_14]',
																		'$_POST[txt_12]',
																		'$_POST[txt_13]',
																		'$_POST[txt_5]',
																		'$_POST[txt_6]',
																		'$_POST[txt_7]',
																		'$_POST[txt_9]',
																		'$_POST[sel_11]',
																		'1',
																		'$fecha');");
		if (!$resultado) {
			$acu[0] = 0;//almacenado
		}
		print_r(json_encode($acu));	
	// }

?>