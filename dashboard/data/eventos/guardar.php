<?php
	if(!isset($_SESSION)) {
		session_start();		
	}

	require('../../../admin2/mysql.php');
	$class = new constante; 

	// if (isset($_POST['btn_guardar'])) {
		$id = $class->idz();
		$fecha = $class->fecha_hora();
		//if (isset($_FILES['txt_x'])) {
			//$carpeta = 'img/'.$id;
			//if (!file_exists($carpeta)) {//verificando existencia de directorio
			//    mkdir($carpeta, 0777, true);
			//};
			//for ($i=0; $i < count($_FILES['txt_x']['name']); $i++) { 
			//	$id_=$class->idz();
			//	$nom=$_FILES['txt_x']['name'][$i];
			//	$url_img='img/'.$nom;
			//	move_uploaded_file ($_FILES['txt_x']['tmp_name'][$i], $url_img);  // Subimos el archivo 
			//	$class->consulta("INSERT INTO img_lugares_establecimientos VALUES ('$id_', '$id', 'establecimiento', '$url_img', '1', '$fecha');");
			//}		
		//}

		$acu[0] = 1;//no almacenado
		$resultado = $class->consulta("INSERT INTO eventos VALUES (	 	'$id',
																		'$_POST[txt_1]',
																		'$_POST[txt_2]',
																		'$_POST[txt_3]',
																		'',
																		'$_POST[txt_4]',
																		'$fecha',
																		'1');");
		if (!$resultado) {
			$acu[0] = 0;//almacenado
		}
		print_r(json_encode($acu));	
	// }

?>