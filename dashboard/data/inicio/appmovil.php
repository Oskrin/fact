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
 		
?>