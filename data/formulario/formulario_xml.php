<?php
	include '../conexion.php';
	include '../funciones_generales.php';		
	$conexion = conectarse();
	date_default_timezone_set('America/Guayaquil');
    $fecha = date('Y-m-d H:i:s', time()); 
    $fecha_larga = date('His', time()); 
	$sql = "";		
	$id_user = sesion_activa();	
	$id = unique($fecha_larga);	
	$cont = 0;
	$cont2 = 0;
	// general xml

	// consulta empresa
	$consulta3 = pg_query("select * from empresa where id_empresa = '".$_SESSION['id']."'");
	while ($row = pg_fetch_row($consulta3)) {
	 	$anio = $row[19];
	 	$ruc_empresa = $row[1];
	 	$nombre_empresa = $row[2];
	 	$ruc_representante = $row[16];
	}

	$xml = new DomDocument('1.0', 'UTF-8');

	$formulario = $xml->createElement('formulario');
    $formulario = $xml->appendChild($formulario);
 
    $cabecera = $xml->createElement('cabecera');
    $cabecera = $formulario->appendChild($cabecera);
 
    $codigo_version_formulario = $xml->createElement('codigo_version_formulario','01201501');
    $codigo_version_formulario = $cabecera->appendChild($codigo_version_formulario);

    $ruc = $xml->createElement('ruc', $ruc_empresa);
    $ruc = $cabecera->appendChild($ruc);

    $codigo_moneda = $xml->createElement('codigo_moneda','1');
    $codigo_moneda = $cabecera->appendChild($codigo_moneda);

    $detalle = $xml->createElement('detalle');
    $detalle = $formulario->appendChild($detalle);

    // campo 99
    $campo = $xml->createElement('campo','');
    $campo->setAttribute('numero', '99');
    $campo = $detalle->appendChild($campo);

    // campo 31
    $campo = $xml->createElement('campo','O');
    $campo->setAttribute('numero', '31');
    $campo = $detalle->appendChild($campo);

    // campo 102
    $campo = $xml->createElement('campo',$anio);
    $campo->setAttribute('numero', '102');
    $campo = $detalle->appendChild($campo);

    // campo 104
    $campo = $xml->createElement('campo','');
    $campo->setAttribute('numero', '104');
    $campo = $detalle->appendChild($campo);

    // campo 203
    $campo = $xml->createElement('campo','');
    $campo->setAttribute('numero', '203');
    $campo = $detalle->appendChild($campo);

    // campo 201
    $campo = $xml->createElement('campo',$ruc_empresa);
    $campo->setAttribute('numero', '201');
    $campo = $detalle->appendChild($campo);

    // campo 202
    $campo = $xml->createElement('campo',$nombre_empresa);
    $campo->setAttribute('numero', '202');
    $campo = $detalle->appendChild($campo);

    // 11
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '11');
    $campo = $detalle->appendChild($campo);

    // 3
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '3');
    $campo = $detalle->appendChild($campo);

    // 7
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7');
    $campo = $detalle->appendChild($campo);

    // 4
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '4');
    $campo = $detalle->appendChild($campo);

    // 8
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '8');
    $campo = $detalle->appendChild($campo);

    // 12
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '12');
    $campo = $detalle->appendChild($campo);

    // 13
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '13');
    $campo = $detalle->appendChild($campo);

    // 9
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '9');
    $campo = $detalle->appendChild($campo);

    // 5
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '5');
    $campo = $detalle->appendChild($campo);

    // 14
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '14');
    $campo = $detalle->appendChild($campo);

    // 6
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6');
    $campo = $detalle->appendChild($campo);

    // 10
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '10');
    $campo = $detalle->appendChild($campo);

    // 15
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '15');
    $campo = $detalle->appendChild($campo);

    // 17
    $campo = $xml->createElement('campo','2');
    $campo->setAttribute('numero', '17');
    $campo = $detalle->appendChild($campo);

    // 311
    // $campo = $xml->createElement('campo',number_format($_POST['311'], 2, '.', ''));
    // $campo->setAttribute('numero', '311');
    // $campo = $detalle->appendChild($campo);

    // 312
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '312');
    $campo = $detalle->appendChild($campo);

    // 313
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '313');
    $campo = $detalle->appendChild($campo);

    // 6012
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6012');
    $campo = $detalle->appendChild($campo);

    // 6011
    // $campo = $xml->createElement('campo',number_format($_POST['6011'], 2, '.', ''));
    // $campo->setAttribute('numero', '6011');
    // $campo = $detalle->appendChild($campo);

    // 6022
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6022');
    $campo = $detalle->appendChild($campo);

    // 6021
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6021');
    $campo = $detalle->appendChild($campo);

    // 6032
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6032');
    $campo = $detalle->appendChild($campo);

    // 6031
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6031');
    $campo = $detalle->appendChild($campo);

    // 314
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '314');
    $campo = $detalle->appendChild($campo);

    // 6042
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6042');
    $campo = $detalle->appendChild($campo);

    // 6041
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6041');
    $campo = $detalle->appendChild($campo);

    // 315
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '315');
    $campo = $detalle->appendChild($campo);

    // 6052
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6052');
    $campo = $detalle->appendChild($campo);

    // 6051
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6051');
    $campo = $detalle->appendChild($campo);

    // 316
    // $campo = $xml->createElement('campo',number_format($_POST['316'], 2, '.', ''));
    // $campo->setAttribute('numero', '316');
    // $campo = $detalle->appendChild($campo);

    // 6062
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6062');
    $campo = $detalle->appendChild($campo);

    // 6061
    // $campo = $xml->createElement('campo',number_format($_POST['6061'], 2, '.', ''));
    // $campo->setAttribute('numero', '6061');
    // $campo = $detalle->appendChild($campo);

    // 317
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '317');
    $campo = $detalle->appendChild($campo);

    // 6072
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6072');
    $campo = $detalle->appendChild($campo);

    // 6071
    // $campo = $xml->createElement('campo',number_format($_POST['6071'], 2, '.', ''));
    // $campo->setAttribute('numero', '6071');
    // $campo = $detalle->appendChild($campo);

    // 6081
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6081');
    $campo = $detalle->appendChild($campo);

    // 6082
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6082');
    $campo = $detalle->appendChild($campo);

    // 318
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '318');
    $campo = $detalle->appendChild($campo);

    // 319
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '319');
    $campo = $detalle->appendChild($campo);

    // 6091
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6091');
    $campo = $detalle->appendChild($campo);

    // 6092
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6092');
    $campo = $detalle->appendChild($campo);

    // 320
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '320');
    $campo = $detalle->appendChild($campo);

    // 321
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '321');
    $campo = $detalle->appendChild($campo);

    // 6101
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6101');
    $campo = $detalle->appendChild($campo);

    // 6102
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6102');
    $campo = $detalle->appendChild($campo);

    // 322
    // $campo = $xml->createElement('campo',number_format($_POST['322'], 2, '.', ''));
    // $campo->setAttribute('numero', '322');
    // $campo = $detalle->appendChild($campo);

    // 6112
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6112');
    $campo = $detalle->appendChild($campo);

    // 6111
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6111');
    $campo = $detalle->appendChild($campo);

    // 6121
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6121');
    $campo = $detalle->appendChild($campo);

    // 6122
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6122');
    $campo = $detalle->appendChild($campo);

    // 323
    // $campo = $xml->createElement('campo',number_format($_POST['323'], 2, '.', ''));
    // $campo->setAttribute('numero', '323');
    // $campo = $detalle->appendChild($campo);

    // 324
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '324');
    $campo = $detalle->appendChild($campo);

    // 6131
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6131');
    $campo = $detalle->appendChild($campo);

    // 6132
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6132');
    $campo = $detalle->appendChild($campo);

    // 325
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '325');
    $campo = $detalle->appendChild($campo);

    // 6999
    // $campo = $xml->createElement('campo',number_format($_POST['6999'], 2, '.', ''));
    // $campo->setAttribute('numero', '6999');
    // $campo = $detalle->appendChild($campo);

    // 6001
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6001');
    $campo = $detalle->appendChild($campo);

    // 326
    // $campo = $xml->createElement('campo',number_format($_POST['326'], 2, '.', ''));
    // $campo->setAttribute('numero', '326');
    // $campo = $detalle->appendChild($campo);

    // 327
    // $campo = $xml->createElement('campo',number_format($_POST['327'], 2, '.', ''));
    // $campo->setAttribute('numero', '327');
    // $campo = $detalle->appendChild($campo);

    // 6002
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '6002');
    $campo = $detalle->appendChild($campo);

    // 328
    // $campo = $xml->createElement('campo',number_format($_POST['328'], 2, '.', ''));
    // $campo->setAttribute('numero', '328');
    // $campo = $detalle->appendChild($campo);

    // 329
    // $campo = $xml->createElement('campo',number_format($_POST['329'], 2, '.', ''));
    // $campo->setAttribute('numero', '329');
    // $campo = $detalle->appendChild($campo);

    // 330
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '330');
    $campo = $detalle->appendChild($campo);

    // 331
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '331');
    $campo = $detalle->appendChild($campo);

    // 332
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '332');
    $campo = $detalle->appendChild($campo);

    // 333
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '333');
    $campo = $detalle->appendChild($campo);

    // 334
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '334');
    $campo = $detalle->appendChild($campo);

    // 335
    // $campo = $xml->createElement('campo',number_format($_POST['335'], 2, '.', ''));
    // $campo->setAttribute('numero', '335');
    // $campo = $detalle->appendChild($campo);

    // 336
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '336');
    $campo = $detalle->appendChild($campo);

    // 337
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '337');
    $campo = $detalle->appendChild($campo);

    // 7010
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7010');
    $campo = $detalle->appendChild($campo);

    // 338
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '338');
    $campo = $detalle->appendChild($campo);

    // 7011
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7011');
    $campo = $detalle->appendChild($campo);

    // 7012
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7012');
    $campo = $detalle->appendChild($campo);

    // 339
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '339');
    $campo = $detalle->appendChild($campo);

    // 340
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '340');
    $campo = $detalle->appendChild($campo);

    // 7021
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7021');
    $campo = $detalle->appendChild($campo);

    // 7023
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7023');
    $campo = $detalle->appendChild($campo);

    // 345
    // $campo = $xml->createElement('campo',number_format($_POST['345'], 2, '.', ''));
    // $campo->setAttribute('numero', '345');
    // $campo = $detalle->appendChild($campo);

    // 7031
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7031');
    $campo = $detalle->appendChild($campo);

    // 7032
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7032');
    $campo = $detalle->appendChild($campo);

    // 7033
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7033');
    $campo = $detalle->appendChild($campo);

    // 350
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '350');
    $campo = $detalle->appendChild($campo);

    // 7041
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7041');
    $campo = $detalle->appendChild($campo);

    // 351
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '351');
    $campo = $detalle->appendChild($campo);

    // 7051
    // $campo = $xml->createElement('campo',number_format($_POST['7051'], 2, '.', ''));
    // $campo->setAttribute('numero', '7051');
    // $campo = $detalle->appendChild($campo);

    // 7061
    // $campo = $xml->createElement('campo',number_format($_POST['7061'], 2, '.', ''));
    // $campo->setAttribute('numero', '7061');
    // $campo = $detalle->appendChild($campo);

    // 7063
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7063');
    $campo = $detalle->appendChild($campo);

    // 352
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '352');
    $campo = $detalle->appendChild($campo);

    // 353
    // $campo = $xml->createElement('campo',number_format($_POST['353'], 2, '.', ''));
    // $campo->setAttribute('numero', '353');
    // $campo = $detalle->appendChild($campo);

    // 7073
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7073');
    $campo = $detalle->appendChild($campo);

    // // 7071
    // $campo = $xml->createElement('campo',number_format($_POST['7071'], 2, '.', ''));
    // $campo->setAttribute('numero', '7071');
    // $campo = $detalle->appendChild($campo);

    // // 354
    // $campo = $xml->createElement('campo',number_format($_POST['354'], 2, '.', ''));
    // $campo->setAttribute('numero', '354');
    // $campo = $detalle->appendChild($campo);

    // // 7081
    // $campo = $xml->createElement('campo',number_format($_POST['7081'], 2, '.', ''));
    // $campo->setAttribute('numero', '7081');
    // $campo = $detalle->appendChild($campo);

    // 355
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '355');
    $campo = $detalle->appendChild($campo);

    // // 7091
    // $campo = $xml->createElement('campo',number_format($_POST['7091'], 2, '.', ''));
    // $campo->setAttribute('numero', '7091');
    // $campo = $detalle->appendChild($campo);

    // // 7101
    // $campo = $xml->createElement('campo',number_format($_POST['7101'], 2, '.', ''));
    // $campo->setAttribute('numero', '7101');
    // $campo = $detalle->appendChild($campo);

    // // 356
    // $campo = $xml->createElement('campo',number_format($_POST['356'], 2, '.', ''));
    // $campo->setAttribute('numero', '356');
    // $campo = $detalle->appendChild($campo);

    // // 357
    // $campo = $xml->createElement('campo',number_format($_POST['357'], 2, '.', ''));
    // $campo->setAttribute('numero', '357');
    // $campo = $detalle->appendChild($campo);

    // // 7111
    // $campo = $xml->createElement('campo',number_format($_POST['7111'], 2, '.', ''));
    // $campo->setAttribute('numero', '7111');
    // $campo = $detalle->appendChild($campo);

    // // 7121
    // $campo = $xml->createElement('campo',number_format($_POST['7121'], 2, '.', ''));
    // $campo->setAttribute('numero', '7121');
    // $campo = $detalle->appendChild($campo);

    // 358
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '358');
    $campo = $detalle->appendChild($campo);

    // // 359
    // $campo = $xml->createElement('campo',number_format($_POST['359'], 2, '.', ''));
    // $campo->setAttribute('numero', '359');
    // $campo = $detalle->appendChild($campo);

    // // 7131
    // $campo = $xml->createElement('campo',number_format($_POST['7132'], 2, '.', ''));
    // $campo->setAttribute('numero', '7131');
    // $campo = $detalle->appendChild($campo);

    // 7132
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7132');
    $campo = $detalle->appendChild($campo);

    // 7133
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7133');
    $campo = $detalle->appendChild($campo);

    // 7143
    // $campo = $xml->createElement('campo',number_format($_POST['7143'], 2, '.', ''));
    // $campo->setAttribute('numero', '7143');
    // $campo = $detalle->appendChild($campo);

    // // 7142
    // $campo = $xml->createElement('campo',number_format($_POST['7142'], 2, '.', ''));
    // $campo->setAttribute('numero', '7142');
    // $campo = $detalle->appendChild($campo);

    // // 7141
    // $campo = $xml->createElement('campo',number_format($_POST['7141'], 2, '.', ''));
    // $campo->setAttribute('numero', '7141');
    // $campo = $detalle->appendChild($campo);

    // // 360
    // $campo = $xml->createElement('campo',number_format($_POST['360'], 2, '.', ''));
    // $campo->setAttribute('numero', '360');
    // $campo = $detalle->appendChild($campo);

    // // 7152
    // $campo = $xml->createElement('campo',number_format($_POST['7152'], 2, '.', ''));
    // $campo->setAttribute('numero', '7152');
    // $campo = $detalle->appendChild($campo);

    // // 7151
    // $campo = $xml->createElement('campo',number_format($_POST['7151'], 2, '.', ''));
    // $campo->setAttribute('numero', '7151');
    // $campo = $detalle->appendChild($campo);

    // 7153
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7153');
    $campo = $detalle->appendChild($campo);

    // 361
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '361');
    $campo = $detalle->appendChild($campo);

    // 7161
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7161');
    $campo = $detalle->appendChild($campo);

    // 7162
    // $campo = $xml->createElement('campo',number_format($_POST['7162'], 2, '.', ''));
    // $campo->setAttribute('numero', '7162');
    // $campo = $detalle->appendChild($campo);

    // // 7163
    // $campo = $xml->createElement('campo',number_format($_POST['7163'], 2, '.', ''));
    // $campo->setAttribute('numero', '7163');
    // $campo = $detalle->appendChild($campo);

    // 362
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '362');
    $campo = $detalle->appendChild($campo);

    // 7173
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7173');
    $campo = $detalle->appendChild($campo);

    // 7172
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7172');
    $campo = $detalle->appendChild($campo);

    // 7171
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7171');
    $campo = $detalle->appendChild($campo);

    // 7183
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7183');
    $campo = $detalle->appendChild($campo);

    // 7182
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7182');
    $campo = $detalle->appendChild($campo);

    // 7181
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7181');
    $campo = $detalle->appendChild($campo);

    // 363
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '363');
    $campo = $detalle->appendChild($campo);

    // 7193
    // $campo = $xml->createElement('campo',number_format($_POST['7193'], 2, '.', ''));
    // $campo->setAttribute('numero', '7193');
    // $campo = $detalle->appendChild($campo);

    // // 7192
    // $campo = $xml->createElement('campo',number_format($_POST['7192'], 2, '.', ''));
    // $campo->setAttribute('numero', '7192');
    // $campo = $detalle->appendChild($campo);

    // // 7191
    // $campo = $xml->createElement('campo',number_format($_POST['7191'], 2, '.', ''));
    // $campo->setAttribute('numero', '7191');
    // $campo = $detalle->appendChild($campo);

    // // 7201
    // $campo = $xml->createElement('campo',number_format($_POST['7201'], 2, '.', ''));
    // $campo->setAttribute('numero', '7201');
    // $campo = $detalle->appendChild($campo);

    // // 7202
    // $campo = $xml->createElement('campo',number_format($_POST['7202'], 2, '.', ''));
    // $campo->setAttribute('numero', '7202');
    // $campo = $detalle->appendChild($campo);

    // // 7203
    // $campo = $xml->createElement('campo',number_format($_POST['7203'], 2, '.', ''));
    // $campo->setAttribute('numero', '7203');
    // $campo = $detalle->appendChild($campo);

    // 364
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '364');
    $campo = $detalle->appendChild($campo);

    // 7211
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7211');
    $campo = $detalle->appendChild($campo);

    // 7212
    // $campo = $xml->createElement('campo',number_format($_POST['7212'], 2, '.', ''));
    // $campo->setAttribute('numero', '7212');
    // $campo = $detalle->appendChild($campo);

    // 7213
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7213');
    $campo = $detalle->appendChild($campo);

    // 365
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '365');
    $campo = $detalle->appendChild($campo);

    // 7221
    // $campo = $xml->createElement('campo',number_format($_POST['7221'], 2, '.', ''));
    // $campo->setAttribute('numero', '7221');
    // $campo = $detalle->appendChild($campo);

    // // 7222
    // $campo = $xml->createElement('campo',number_format($_POST['7222'], 2, '.', ''));
    // $campo->setAttribute('numero', '7222');
    // $campo = $detalle->appendChild($campo);

    // // 7223
    // $campo = $xml->createElement('campo',number_format($_POST['7223'], 2, '.', ''));
    // $campo->setAttribute('numero', '7223');
    // $campo = $detalle->appendChild($campo);

    // 366
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '366');
    $campo = $detalle->appendChild($campo);

    // 7233
    // $campo = $xml->createElement('campo',number_format($_POST['7233'], 2, '.', ''));
    // $campo->setAttribute('numero', '7233');
    // $campo = $detalle->appendChild($campo);

    // // 7232
    // $campo = $xml->createElement('campo',number_format($_POST['7232'], 2, '.', ''));
    // $campo->setAttribute('numero', '7232');
    // $campo = $detalle->appendChild($campo);

    // 7231
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7231');
    $campo = $detalle->appendChild($campo);

    // 367
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '367');
    $campo = $detalle->appendChild($campo);

    // 368
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '368');
    $campo = $detalle->appendChild($campo);

    // 7241
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7241');
    $campo = $detalle->appendChild($campo);

    // 7242
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7242');
    $campo = $detalle->appendChild($campo);

    // 7243
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7243');
    $campo = $detalle->appendChild($campo);

    // 369
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '369');
    $campo = $detalle->appendChild($campo);

    // 7252
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7252');
    $campo = $detalle->appendChild($campo);

    // 7251
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7251');
    $campo = $detalle->appendChild($campo);

    // 7253
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7253');
    $campo = $detalle->appendChild($campo);

    // 370
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '370');
    $campo = $detalle->appendChild($campo);

    // 7262
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7262');
    $campo = $detalle->appendChild($campo);

    // 7263
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7263');
    $campo = $detalle->appendChild($campo);

    // 7271
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7271');
    $campo = $detalle->appendChild($campo);

    // 7272
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7272');
    $campo = $detalle->appendChild($campo);

    // 7273
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7273');
    $campo = $detalle->appendChild($campo);

    // 379
    // $campo = $xml->createElement('campo',number_format($_POST['379'], 2, '.', ''));
    // $campo->setAttribute('numero', '379');
    // $campo = $detalle->appendChild($campo);

    // 7281
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7281');
    $campo = $detalle->appendChild($campo);

    // 7282
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7282');
    $campo = $detalle->appendChild($campo);

    // 7283
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7283');
    $campo = $detalle->appendChild($campo);

    // 7293
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7293');
    $campo = $detalle->appendChild($campo);

    // 7292
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7292');
    $campo = $detalle->appendChild($campo);

    // 7291
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7291');
    $campo = $detalle->appendChild($campo);

    // 381
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '381');
    $campo = $detalle->appendChild($campo);

    // 7303
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7303');
    $campo = $detalle->appendChild($campo);

    // 7302
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7302');
    $campo = $detalle->appendChild($campo);

    // 7301
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7301');
    $campo = $detalle->appendChild($campo);

    // 382
    // $campo = $xml->createElement('campo',number_format($_POST['382'], 2, '.', ''));
    // $campo->setAttribute('numero', '382');
    // $campo = $detalle->appendChild($campo);

    // 7311
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7311');
    $campo = $detalle->appendChild($campo);

    // 7313
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7313');
    $campo = $detalle->appendChild($campo);

    // 7312
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7312');
    $campo = $detalle->appendChild($campo);

    // 383
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '383');
    $campo = $detalle->appendChild($campo);

    // 7321
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7321');
    $campo = $detalle->appendChild($campo);

    // 7322
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7322');
    $campo = $detalle->appendChild($campo);

    // 7323
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7323');
    $campo = $detalle->appendChild($campo);

    // 384
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '384');
    $campo = $detalle->appendChild($campo);

    // 7331
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7331');
    $campo = $detalle->appendChild($campo);

    // 7332
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7332');
    $campo = $detalle->appendChild($campo);

    // 7333
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7333');
    $campo = $detalle->appendChild($campo);

    // 385
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '385');
    $campo = $detalle->appendChild($campo);

    // 386
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '386');
    $campo = $detalle->appendChild($campo);

    // 7343
    // $campo = $xml->createElement('campo',number_format($_POST['7343'], 2, '.', ''));
    // $campo->setAttribute('numero', '7343');
    // $campo = $detalle->appendChild($campo);

    // // 7342
    // $campo = $xml->createElement('campo',number_format($_POST['7342'], 2, '.', ''));
    // $campo->setAttribute('numero', '7342');
    // $campo = $detalle->appendChild($campo);

    // 7341
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7341');
    $campo = $detalle->appendChild($campo);

    // 389
    // $campo = $xml->createElement('campo',number_format($_POST['389'], 2, '.', ''));
    // $campo->setAttribute('numero', '389');
    // $campo = $detalle->appendChild($campo);

    // 7353
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7353');
    $campo = $detalle->appendChild($campo);

    // 7351
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7351');
    $campo = $detalle->appendChild($campo);

    // 7352
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7352');
    $campo = $detalle->appendChild($campo);

    // 7363
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7363');
    $campo = $detalle->appendChild($campo);

    // 7362
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7362');
    $campo = $detalle->appendChild($campo);

    // 7361
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7361');
    $campo = $detalle->appendChild($campo);

    // 411
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '411');
    $campo = $detalle->appendChild($campo);

    // 7373
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7373');
    $campo = $detalle->appendChild($campo);

    // 7372
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7372');
    $campo = $detalle->appendChild($campo);

    // 7371
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7371');
    $campo = $detalle->appendChild($campo);

    // 412
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '412');
    $campo = $detalle->appendChild($campo);

    // 7383
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7383');
    $campo = $detalle->appendChild($campo);

    // 7382
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7382');
    $campo = $detalle->appendChild($campo);

    // 7381
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7381');
    $campo = $detalle->appendChild($campo);

    // 413
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '413');
    $campo = $detalle->appendChild($campo);

    // 7393
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7393');
    $campo = $detalle->appendChild($campo);

    // 7391
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7391');
    $campo = $detalle->appendChild($campo);

    // 7392
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7392');
    $campo = $detalle->appendChild($campo);

    // 7403
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7403');
    $campo = $detalle->appendChild($campo);

    // 7401
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7401');
    $campo = $detalle->appendChild($campo);

    // 7402
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7402');
    $campo = $detalle->appendChild($campo);

    // 414
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '414');
    $campo = $detalle->appendChild($campo);

    // 7413
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7413');
    $campo = $detalle->appendChild($campo);

    // 7412
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7412');
    $campo = $detalle->appendChild($campo);

    // 7411
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7411');
    $campo = $detalle->appendChild($campo);

    // 415
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '415');
    $campo = $detalle->appendChild($campo);

    // 7421
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7421');
    $campo = $detalle->appendChild($campo);

    // 7423
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7423');
    $campo = $detalle->appendChild($campo);

    // 7422
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7422');
    $campo = $detalle->appendChild($campo);

    // 7431
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7431');
    $campo = $detalle->appendChild($campo);

    // 7433
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7433');
    $campo = $detalle->appendChild($campo);

    // 7432
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7432');
    $campo = $detalle->appendChild($campo);

    // 416
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '416');
    $campo = $detalle->appendChild($campo);

    // 417
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '417');
    $campo = $detalle->appendChild($campo);

    // 7441
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7441');
    $campo = $detalle->appendChild($campo);

    // 7442
    // $campo = $xml->createElement('campo',number_format($_POST['7442'], 2, '.', ''));
    // $campo->setAttribute('numero', '7442');
    // $campo = $detalle->appendChild($campo);

    // 7443
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7443');
    $campo = $detalle->appendChild($campo);

    // 418
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '418');
    $campo = $detalle->appendChild($campo);

    // 7453
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7453');
    $campo = $detalle->appendChild($campo);

    // 7452
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7452');
    $campo = $detalle->appendChild($campo);

    // 7451
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7451');
    $campo = $detalle->appendChild($campo);

    // 419
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '419');
    $campo = $detalle->appendChild($campo);

    // 7462
    // $campo = $xml->createElement('campo',number_format($_POST['7462'], 2, '.', ''));
    // $campo->setAttribute('numero', '7462');
    // $campo = $detalle->appendChild($campo);

    // // 7463
    // $campo = $xml->createElement('campo',number_format($_POST['7463'], 2, '.', ''));
    // $campo->setAttribute('numero', '7463');
    // $campo = $detalle->appendChild($campo);

    // // 7473
    // $campo = $xml->createElement('campo',number_format($_POST['7473'], 2, '.', ''));
    // $campo->setAttribute('numero', '7473');
    // $campo = $detalle->appendChild($campo);

    // // 7472
    // $campo = $xml->createElement('campo',number_format($_POST['7472'], 2, '.', ''));
    // $campo->setAttribute('numero', '7472');
    // $campo = $detalle->appendChild($campo);

    // 420
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '420');
    $campo = $detalle->appendChild($campo);

    // 421
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '421');
    $campo = $detalle->appendChild($campo);

    // 7481
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7481');
    $campo = $detalle->appendChild($campo);

    // 7483
    // $campo = $xml->createElement('campo',number_format($_POST['7483'], 2, '.', ''));
    // $campo->setAttribute('numero', '7483');
    // $campo = $detalle->appendChild($campo);

    // // 7482
    // $campo = $xml->createElement('campo',number_format($_POST['7482'], 2, '.', ''));
    // $campo->setAttribute('numero', '7482');
    // $campo = $detalle->appendChild($campo);

    // 422
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '422');
    $campo = $detalle->appendChild($campo);

    // 7491
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7491');
    $campo = $detalle->appendChild($campo);

    // 7492
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7492');
    $campo = $detalle->appendChild($campo);

    // 7493
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7493');
    $campo = $detalle->appendChild($campo);

    // 423
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '423');
    $campo = $detalle->appendChild($campo);

    // 424
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '424');
    $campo = $detalle->appendChild($campo);

    // 7503
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7503');
    $campo = $detalle->appendChild($campo);

    // 7502
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7502');
    $campo = $detalle->appendChild($campo);

    // 7501
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7501');
    $campo = $detalle->appendChild($campo);

    // 439
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '439');
    $campo = $detalle->appendChild($campo);

    // 7513
    // $campo = $xml->createElement('campo',number_format($_POST['7513'], 2, '.', ''));
    // $campo->setAttribute('numero', '7513');
    // $campo = $detalle->appendChild($campo);

    // // 7512
    // $campo = $xml->createElement('campo',number_format($_POST['7512'], 2, '.', ''));
    // $campo->setAttribute('numero', '7512');
    // $campo = $detalle->appendChild($campo);

    // // 7511
    // $campo = $xml->createElement('campo',number_format($_POST['7511'], 2, '.', ''));
    // $campo->setAttribute('numero', '7511');
    // $campo = $detalle->appendChild($campo);

    // // 445
    // $campo = $xml->createElement('campo',number_format($_POST['445'], 2, '.', ''));
    // $campo->setAttribute('numero', '445');
    // $campo = $detalle->appendChild($campo);

    // // 498
    // $campo = $xml->createElement('campo',number_format($_POST['498'], 2, '.', ''));
    // $campo->setAttribute('numero', '498');
    // $campo = $detalle->appendChild($campo);

    // 7521
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7521');
    $campo = $detalle->appendChild($campo);

    // 7522
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7522');
    $campo = $detalle->appendChild($campo);

    // 7523
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7523');
    $campo = $detalle->appendChild($campo);

    // 7531
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7531');
    $campo = $detalle->appendChild($campo);

    // 7533
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7533');
    $campo = $detalle->appendChild($campo);

    // 7542
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7542');
    $campo = $detalle->appendChild($campo);

    // 7543
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7543');
    $campo = $detalle->appendChild($campo);

    // 446
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '446');
    $campo = $detalle->appendChild($campo);

    // 499
    // $campo = $xml->createElement('campo',number_format($_POST['499'], 2, '.', ''));
    // $campo->setAttribute('numero', '499');
    // $campo = $detalle->appendChild($campo);

    // 7553
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7553');
    $campo = $detalle->appendChild($campo);

    // 7551
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7551');
    $campo = $detalle->appendChild($campo);

    // 496
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '496');
    $campo = $detalle->appendChild($campo);

    // 7563
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7563');
    $campo = $detalle->appendChild($campo);

    // 7562
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7562');
    $campo = $detalle->appendChild($campo);

    // 7561
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7561');
    $campo = $detalle->appendChild($campo);

    // 7571
    // $campo = $xml->createElement('campo',number_format($_POST['7571'], 2, '.', ''));
    // $campo->setAttribute('numero', '7571');
    // $campo = $detalle->appendChild($campo);

    // // 7572
    // $campo = $xml->createElement('campo',number_format($_POST['7572'], 2, '.', ''));
    // $campo->setAttribute('numero', '7572');
    // $campo = $detalle->appendChild($campo);

    // // 7573
    // $campo = $xml->createElement('campo',number_format($_POST['7573'], 2, '.', ''));
    // $campo->setAttribute('numero', '7573');
    // $campo = $detalle->appendChild($campo);

    // // 7583
    // $campo = $xml->createElement('campo',number_format($_POST['7583'], 2, '.', ''));
    // $campo->setAttribute('numero', '7583');
    // $campo = $detalle->appendChild($campo);

    // // 7581
    // $campo = $xml->createElement('campo',number_format($_POST['7581'], 2, '.', ''));
    // $campo->setAttribute('numero', '7581');
    // $campo = $detalle->appendChild($campo);

    // // 7582
    // $campo = $xml->createElement('campo',number_format($_POST['7582'], 2, '.', ''));
    // $campo->setAttribute('numero', '7582');
    // $campo = $detalle->appendChild($campo);

    // 7591
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7591');
    $campo = $detalle->appendChild($campo);

    // 7592
    // $campo = $xml->createElement('campo',number_format($_POST['7592'], 2, '.', ''));
    // $campo->setAttribute('numero', '7592');
    // $campo = $detalle->appendChild($campo);

    // // 7593
    // $campo = $xml->createElement('campo',number_format($_POST['7593'], 2, '.', ''));
    // $campo->setAttribute('numero', '7593');
    // $campo = $detalle->appendChild($campo);

    // 7991
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7991');
    $campo = $detalle->appendChild($campo);

    // 511
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '511');
    $campo = $detalle->appendChild($campo);

    // 7992
    // $campo = $xml->createElement('campo',number_format($_POST['7992'], 2, '.', ''));
    // $campo->setAttribute('numero', '7992');
    // $campo = $detalle->appendChild($campo);

    // 512
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '512');
    $campo = $detalle->appendChild($campo);

    // 7999
    // $campo = $xml->createElement('campo',number_format($_POST['7999'], 2, '.', ''));
    // $campo->setAttribute('numero', '7999');
    // $campo = $detalle->appendChild($campo);

    // // 513
    // $campo = $xml->createElement('campo',number_format($_POST['513'], 2, '.', ''));
    // $campo->setAttribute('numero', '513');
    // $campo = $detalle->appendChild($campo);

    // 7001
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7001');
    $campo = $detalle->appendChild($campo);

    // 7002
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7002');
    $campo = $detalle->appendChild($campo);

    // 514
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '514');
    $campo = $detalle->appendChild($campo);

    // 7003
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '7003');
    $campo = $detalle->appendChild($campo);

    // 515
    // $campo = $xml->createElement('campo',number_format($_POST['515'], 2, '.', ''));
    // $campo->setAttribute('numero', '515');
    // $campo = $detalle->appendChild($campo);

    // 516
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '516');
    $campo = $detalle->appendChild($campo);

    // 517
    // $campo = $xml->createElement('campo',number_format($_POST['517'], 2, '.', ''));
    // $campo->setAttribute('numero', '517');
    // $campo = $detalle->appendChild($campo);

    // 518
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '518');
    $campo = $detalle->appendChild($campo);

    // 801
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '801');
    $campo = $detalle->appendChild($campo);

    // 519
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '519');
    $campo = $detalle->appendChild($campo);

    // 520
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '520');
    $campo = $detalle->appendChild($campo);

    // 802
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '802');
    $campo = $detalle->appendChild($campo);

    // 521
    // $campo = $xml->createElement('campo',number_format($_POST['521'], 2, '.', ''));
    // $campo->setAttribute('numero', '521');
    // $campo = $detalle->appendChild($campo);

    // 522
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '522');
    $campo = $detalle->appendChild($campo);

    // 97
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '97');
    $campo = $detalle->appendChild($campo);

    // 98
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '98');
    $campo = $detalle->appendChild($campo);

    // 524
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '524');
    $campo = $detalle->appendChild($campo);

    // 803
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '803');
    $campo = $detalle->appendChild($campo);

    // 525
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '525');
    $campo = $detalle->appendChild($campo);

    // 804
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '804');
    $campo = $detalle->appendChild($campo);

    // 805
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '805');
    $campo = $detalle->appendChild($campo);

    // 526
    // $campo = $xml->createElement('campo',number_format($_POST['526'], 2, '.', ''));
    // $campo->setAttribute('numero', '526');
    // $campo = $detalle->appendChild($campo);

    // 806
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '806');
    $campo = $detalle->appendChild($campo);

    // 527
    // $campo = $xml->createElement('campo',number_format($_POST['527'], 2, '.', ''));
    // $campo->setAttribute('numero', '527');
    // $campo = $detalle->appendChild($campo);

    // // 528
    // $campo = $xml->createElement('campo',number_format($_POST['528'], 2, '.', ''));
    // $campo->setAttribute('numero', '528');
    // $campo = $detalle->appendChild($campo);

    // 807
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '807');
    $campo = $detalle->appendChild($campo);

    // 808
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '808');
    $campo = $detalle->appendChild($campo);

    // 529
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '529');
    $campo = $detalle->appendChild($campo);

    // 530
    // $campo = $xml->createElement('campo',number_format($_POST['530'], 2, '.', ''));
    // $campo->setAttribute('numero', '530');
    // $campo = $detalle->appendChild($campo);

    // 809
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '809');
    $campo = $detalle->appendChild($campo);

    // 531
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '531');
    $campo = $detalle->appendChild($campo);

    // 532
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '532');
    $campo = $detalle->appendChild($campo);

    // 810
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '810');
    $campo = $detalle->appendChild($campo);

    // 533
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '533');
    $campo = $detalle->appendChild($campo);

    // 811
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '811');
    $campo = $detalle->appendChild($campo);

    // 534
    // $campo = $xml->createElement('campo',number_format($_POST['534'], 2, '.', ''));
    // $campo->setAttribute('numero', '534');
    // $campo = $detalle->appendChild($campo);

    // 812
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '812');
    $campo = $detalle->appendChild($campo);

    // 813
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '813');
    $campo = $detalle->appendChild($campo);

    // 535
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '535');
    $campo = $detalle->appendChild($campo);

    // 539
    // $campo = $xml->createElement('campo',number_format($_POST['539'], 2, '.', ''));
    // $campo->setAttribute('numero', '539');
    // $campo = $detalle->appendChild($campo);

    // 814
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '814');
    $campo = $detalle->appendChild($campo);

    // 815
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '815');
    $campo = $detalle->appendChild($campo);

    // 816
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '816');
    $campo = $detalle->appendChild($campo);

    // 817
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '817');
    $campo = $detalle->appendChild($campo);

    // 541
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '541');
    $campo = $detalle->appendChild($campo);

    // 542
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '542');
    $campo = $detalle->appendChild($campo);

    // 818
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '818');
    $campo = $detalle->appendChild($campo);

    // 543
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '543');
    $campo = $detalle->appendChild($campo);

    // 819
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '819');
    $campo = $detalle->appendChild($campo);

    // 544
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '544');
    $campo = $detalle->appendChild($campo);

    // 829
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '829');
    $campo = $detalle->appendChild($campo);

    // 545
    // $campo = $xml->createElement('campo',number_format($_POST['545'], 2, '.', ''));
    // $campo->setAttribute('numero', '545');
    // $campo = $detalle->appendChild($campo);

    // 831
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '831');
    $campo = $detalle->appendChild($campo);

    // 832
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '832');
    $campo = $detalle->appendChild($campo);

    // 546
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '546');
    $campo = $detalle->appendChild($campo);

    // 547
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '547');
    $campo = $detalle->appendChild($campo);

    // 839
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '839');
    $campo = $detalle->appendChild($campo);

    // 548
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '548');
    $campo = $detalle->appendChild($campo);

    // 841
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '841');
    $campo = $detalle->appendChild($campo);

    // 549
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '549');
    $campo = $detalle->appendChild($campo);

    // 550
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '550');
    $campo = $detalle->appendChild($campo);

    // 842
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '842');
    $campo = $detalle->appendChild($campo);

    // 843
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '843');
    $campo = $detalle->appendChild($campo);

    // 551
    // $campo = $xml->createElement('campo',number_format($_POST['551'], 2, '.', ''));
    // $campo->setAttribute('numero', '551');
    // $campo = $detalle->appendChild($campo);

    // 552
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '552');
    $campo = $detalle->appendChild($campo);

    // 844
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '844');
    $campo = $detalle->appendChild($campo);

    // 845
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '845');
    $campo = $detalle->appendChild($campo);

    // 553
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '553');
    $campo = $detalle->appendChild($campo);

    // 847
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '847');
    $campo = $detalle->appendChild($campo);

    // 554
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '554');
    $campo = $detalle->appendChild($campo);

    // 555
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '555');
    $campo = $detalle->appendChild($campo);

    // 848
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '848');
    $campo = $detalle->appendChild($campo);

    // 849
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '849');
    $campo = $detalle->appendChild($campo);

    // 556
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '556');
    $campo = $detalle->appendChild($campo);

    // 557
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '557');
    $campo = $detalle->appendChild($campo);

    // 850
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '850');
    $campo = $detalle->appendChild($campo);

    // 851
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '851');
    $campo = $detalle->appendChild($campo);

    // 558
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '558');
    $campo = $detalle->appendChild($campo);

    // 852
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '852');
    $campo = $detalle->appendChild($campo);

    // 559
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '559');
    $campo = $detalle->appendChild($campo);

    // 560
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '560');
    $campo = $detalle->appendChild($campo);

    // 855
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '855');
    $campo = $detalle->appendChild($campo);

    // 856
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '856');
    $campo = $detalle->appendChild($campo);

    // 569
    // $campo = $xml->createElement('campo',number_format($_POST['569'], 2, '.', ''));
    // $campo->setAttribute('numero', '569');
    // $campo = $detalle->appendChild($campo);

    // 857
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '857');
    $campo = $detalle->appendChild($campo);

    // 579
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '579');
    $campo = $detalle->appendChild($campo);

    // 589
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '589');
    $campo = $detalle->appendChild($campo);

    // 858
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '858');
    $campo = $detalle->appendChild($campo);

    // 859
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '859');
    $campo = $detalle->appendChild($campo);

    // 599
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '599');
    $campo = $detalle->appendChild($campo);

    // 869
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '869');
    $campo = $detalle->appendChild($campo);

    // 879
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '879');
    $campo = $detalle->appendChild($campo);

    // 601
    // $campo = $xml->createElement('campo',number_format($_POST['601'], 2, '.', ''));
    // $campo->setAttribute('numero', '601');
    // $campo = $detalle->appendChild($campo);

    // 871
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '871');
    $campo = $detalle->appendChild($campo);

    // 872
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '872');
    $campo = $detalle->appendChild($campo);

    // 602
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '602');
    $campo = $detalle->appendChild($campo);

    // 873
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '873');
    $campo = $detalle->appendChild($campo);

    // 611
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '611');
    $campo = $detalle->appendChild($campo);

    // 621
    // $campo = $xml->createElement('campo',number_format($_POST['621'], 2, '.', ''));
    // $campo->setAttribute('numero', '621');
    // $campo = $detalle->appendChild($campo);

    // 629
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '629');
    $campo = $detalle->appendChild($campo);

    // 631
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '631');
    $campo = $detalle->appendChild($campo);

    // 632
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '632');
    $campo = $detalle->appendChild($campo);

    // 633
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '633');
    $campo = $detalle->appendChild($campo);

    // 634
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '634');
    $campo = $detalle->appendChild($campo);

    // 635
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '635');
    $campo = $detalle->appendChild($campo);

    // 641
    // $campo = $xml->createElement('campo',number_format($_POST['641'], 2, '.', ''));
    // $campo->setAttribute('numero', '641');
    // $campo = $detalle->appendChild($campo);

    // // 651
    // $campo = $xml->createElement('campo',number_format($_POST['651'], 2, '.', ''));
    // $campo->setAttribute('numero', '651');
    // $campo = $detalle->appendChild($campo);

    // // 652
    // $campo = $xml->createElement('campo',number_format($_POST['652'], 2, '.', ''));
    // $campo->setAttribute('numero', '652');
    // $campo = $detalle->appendChild($campo);

    // // 653
    // $campo = $xml->createElement('campo',number_format($_POST['653'], 2, '.', ''));
    // $campo->setAttribute('numero', '653');
    // $campo = $detalle->appendChild($campo);

    // 654
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '654');
    $campo = $detalle->appendChild($campo);

    // 655
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '655');
    $campo = $detalle->appendChild($campo);

    // 890
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '890');
    $campo = $detalle->appendChild($campo);

    // 656
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '656');
    $campo = $detalle->appendChild($campo);

    // 661
    // $campo = $xml->createElement('campo',number_format($_POST['661'], 2, '.', ''));
    // $campo->setAttribute('numero', '661');
    // $campo = $detalle->appendChild($campo);

    // 662
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '662');
    $campo = $detalle->appendChild($campo);

    // 897
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '897');
    $campo = $detalle->appendChild($campo);

    // 698
    // $campo = $xml->createElement('campo',number_format($_POST['698'], 2, '.', ''));
    // $campo->setAttribute('numero', '698');
    // $campo = $detalle->appendChild($campo);

    // 898
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '898');
    $campo = $detalle->appendChild($campo);

    // 699
    // $campo = $xml->createElement('campo',number_format($_POST['699'], 2, '.', ''));
    // $campo->setAttribute('numero', '699');
    // $campo = $detalle->appendChild($campo);

    // 899
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '899');
    $campo = $detalle->appendChild($campo);

    // 902
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '902');
    $campo = $detalle->appendChild($campo);

    // 903
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '903');
    $campo = $detalle->appendChild($campo);

    // 904
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '904');
    $campo = $detalle->appendChild($campo);

    // 999
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '999');
    $campo = $detalle->appendChild($campo);

    // 905
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '905');
    $campo = $detalle->appendChild($campo);

    // 906
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '906');
    $campo = $detalle->appendChild($campo);

    // 907
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '907');
    $campo = $detalle->appendChild($campo);

    // 912
    $campo = $xml->createElement('campo','');
    $campo->setAttribute('numero', '912');
    $campo = $detalle->appendChild($campo);

    // 910
    $campo = $xml->createElement('campo','');
    $campo->setAttribute('numero', '910');
    $campo = $detalle->appendChild($campo);

    // 908
    $campo = $xml->createElement('campo','');
    $campo->setAttribute('numero', '908');
    $campo = $detalle->appendChild($campo);

    // 909
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '909');
    $campo = $detalle->appendChild($campo);

    // 911
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '911');
    $campo = $detalle->appendChild($campo);

    // 913
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '913');
    $campo = $detalle->appendChild($campo);

    // 915
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '915');
    $campo = $detalle->appendChild($campo);

    // 916
    $campo = $xml->createElement('campo','');
    $campo->setAttribute('numero', '916');
    $campo = $detalle->appendChild($campo);

    // 918
    $campo = $xml->createElement('campo','');
    $campo->setAttribute('numero', '918');
    $campo = $detalle->appendChild($campo);

    // 917
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '917');
    $campo = $detalle->appendChild($campo);

    // 919
    $campo = $xml->createElement('campo','0.00');
    $campo->setAttribute('numero', '919');
    $campo = $detalle->appendChild($campo);

    // 198
    $campo = $xml->createElement('campo',$ruc_representante);
    $campo->setAttribute('numero', '198');
    $campo = $detalle->appendChild($campo);

    // 199
    $campo = $xml->createElement('campo','');
    $campo->setAttribute('numero', '199');
    $campo = $detalle->appendChild($campo);

    // 922
    $campo = $xml->createElement('campo','89');
    $campo->setAttribute('numero', '922');
    $campo = $detalle->appendChild($campo);

	$xml->formatOutput = true;
    $el_xml = $xml->saveXML();
    $xml->save('formulario101.xml');

    $fn = "formulario101.xml"; 
    header("Content-Disposition: attachment; filename=\"" . $fn . "\";" );
    header('Content-Type: text/xml');
    readfile($fn);
?>