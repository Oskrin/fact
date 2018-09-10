<?php 
	//inclucion de librerias
	include '../conexion.php';
	include '../funciones_generales.php';
	include '../correos/mail.php';
	error_reporting(0);

	// include '../correos/prueba.php';
	$conexion = conectarse();
	date_default_timezone_set('America/Guayaquil');
	$fecha = date('Y-m-d H:i:s', time());
	$fecha_larga = date('His', time());
	$id = unique($fecha_larga);
	$id_session = sesion_activa();///datos session
	$id_user = sesion_activa();

	$acumulable = "NO";
	if(isset($_POST["acumulable"]))
		$acumulable = "SI";

	// guardar pagos
	pg_query("insert into nomina values('$id','".$_POST['txt_0']."', '".$_POST['fecha_actual']."','".$_POST['mes']."','".$_POST['acumula']."','','".$_POST['horas_extras']."','".$_POST['dias_laborados']."','".$_POST['no_laborado']."','".$_POST['txt_4']."','".$_POST['total_extras']."','".$_POST['tercero']."','".$_POST['cuarto']."'
		,'".$_POST['total_ingresos']."','".$_POST['descuento_faltas']."','','".$_POST['total_descuentos']."','".$_POST['neto_pagar']."','Activo','$fecha')");
	// fin

	// registrar libro diario
	// $id_libro  = unique($fecha_larga);

	// $sql_libro = "insert into libro_diario values ('".$id_libro."','".$fecha."','".$arreglo5[$i]."','','11501155240ac39d2f0','Tabla Pagos Cobrar','Cobro en efectivo del documento'.$arreglo1[1])";///caja
	// $guardar = guardarSql($conexion,$sql_libro);

	$id_libro  = unique($fecha_larga);
	$sql_libro = "insert into libro_diario values ('".$id_libro."','".$fecha."','".$_POST['neto_pagar']."','','11501155240ac39f4e6','Tabla Pagos Nómina','Cuentas por pagar')";///cuentas por cobrar
	$guardar = guardarSql($conexion,$sql_libro);	
	// fin

	$sql_nuevo = "select (id_nomina) from nomina where id_nomina = '$id'";
	$sql_nuevo = sql_array($conexion,$sql_nuevo);
	auditoria_sistema($conexion,'nomina',$id_user,'Insert',$id,$fecha_larga,$fecha,$sql_nuevo,'');


	$data = 0; /// error al guardar

	echo $data;
?>