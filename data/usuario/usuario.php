<?php
	include '../conexion.php';
	include '../funciones_generales.php';
	require '../correos/PHPMailer/class.phpmailer.php';
	require '../correos/PHPMailer/PHPMailerAutoload.php';
	require '../correos/PHPMailer/class.smtp.php';

	class email  extends PHPMailer {
	    var $tu_email = 'empresaneltex@gmail.com';
	    var $tu_nombre = 'NELTEX';
	    var $tu_password ='NeltexOtavalo';

	    public function __construct() {
		    $this->IsSMTP(); // protocolo de transferencia de correo
	      	$this->Host = 'smtp.gmail.com';  // Servidor GMAIL
	      	$this->Port = 465; //puerto
	      	$this->SMTPAuth = true; // Habilitar la autenticación SMTP
	      	$this->Username = $this->tu_email;
	      	$this->Password = $this->tu_password;
	      	$this->SMTPSecure = 'ssl'; //habilita la encriptacion SSL
	      	// $this->SMTPDebug = 2; //permite modo debug para ver mensajes de las cosas que van ocurriendo
	      	//remitente
	      	$this->From = $this->tu_email;
	      	$this->FromName = $this->tu_nombre;
	    }

	    /**
	 	* Metodo encargado del envio del e-mail
	 	*/
	    public function enviar($para, $nombre, $titulo , $contenido) {
	      	$this->AddAddress($para, $nombre); // Correo y nombre a quien se envia
	      	$this->WordWrap = 50; // Ajuste de texto
	      	$this->IsHTML(true); //establece formato HTML para el contenido
	      	$this->Subject = $titulo;
	      	$this->Body    =  $contenido; //contenido con etiquetas HTML
	      	$this->AltBody =  strip_tags($contenido); //Contenido para servidores que no aceptan HTML
	      	//envio de e-mail y retorno de resultado
	      	return $this->Send() ;
	   }
	}//--> fin clase

	$conexion = conectarse();
	error_reporting(0);	
    date_default_timezone_set('America/Guayaquil');
    $nivel_1_admin =  array(1,1,1,1);
	$nivel_2_admin =  array(1,1,1,1,1,1,1,1,1,1,1,1);
	$nivel_3_admin =  array(1,1,1,1,1,1,1,1);
	$nivel_1_otros =  array(1,1,1,1);
	$nivel_2_otros =  array(1,1,1,1,1,1,1,1,1,1,1,1);
	$nivel_3_otros =  array(1,1,1,1,1,1,1,1);
	$fecha = date('Y-m-d H:i:s', time());
	$fecha_larga = date('His', time());
	$sql = "";	
	$id = unique($fecha_larga);	
	$id_c = unique($fecha_larga);
	$id_p = unique($fecha_larga);	
	$id_user = sesion_activa();	
	$check = "OFF";	

	if(isset($_POST["form-field-checkbox"]))
		$check = "ON";

	$cadena = " ".$_POST['img'];	
	$buscar = 'data:image/png;base64,';

	if($_POST['tipo'] == "g") {
		$repetidos = repetidos($conexion,"usuario",strtoupper($_POST["txt_13"]),"usuario","g","","");	
		if( $repetidos == 'true') {
			$data = 1; /// este usuario ya existe;
		} else {		
			$repetidos = repetidos($conexion,"identificacion",strtoupper($_POST["txt_1"]),"usuario","g","","");		
			if($repetidos == 'true') {
				$data = 2; /// este nro de cedula ya existe;
			} else {						
				if(strpos($cadena, $buscar) ==  FALSE) {
					$sql ="insert into usuario values ('$id','$_POST[txt_1]','$_POST[txt_2]','$_POST[txt_3]','$_POST[txt_7]','$_POST[txt_11]','$_POST[txt_12]','$_POST[txt_8]','$_POST[txt_13]','$_POST[txt_4]','0','default.png','$check','$fecha')";					
				} else {					
					$resp = img_64("img",$_POST['img'],'png',$id);					
					if($resp == "true") {
						$sql ="insert into usuario values ('$id','$_POST[txt_1]','$_POST[txt_2]','$_POST[txt_3]','$_POST[txt_7]','$_POST[txt_11]','$_POST[txt_12]','$_POST[txt_8]','$_POST[txt_13]','$_POST[txt_4]','0','".$id.".png','$check','$fecha')";						
					} else {
						$sql ="insert into usuario values ('$id','$_POST[txt_1]','$_POST[txt_2]','$_POST[txt_3]','$_POST[txt_7]','$_POST[txt_11]','$_POST[txt_12]','$_POST[txt_8]','$_POST[txt_13]','$_POST[txt_4]','0','default.png','$check','$fecha')";					
					}
				}

				$guardar = guardarSql($conexion,$sql);
				$sql_nuevo = "select (id_usuario,identificacion,nombres_completos,telefono1,telefono2,id_ciudad,direccion,correo,usuario,id_cargo,estado,imagen,extranjero,fecha_creacion) from usuario where id_usuario ='$id'";        
        		$sql_nuevo = sql_array($conexion,$sql_nuevo);
        		auditoria_sistema($conexion,'usuario',$id_user,'Insert',$id,$fecha_larga,$fecha,$sql_nuevo,'');
				/**/
				if($_POST['txt_4'] == '1') {
					$nivel_1_admin = "array['".implode("', '", $nivel_1_admin)."']";
					$nivel_2_admin = "array['".implode("', '", $nivel_2_admin)."']";
					$nivel_3_admin = "array['".implode("', '", $nivel_3_admin)."']";	
					$sql ="insert into permisos values ('$id_p',".$nivel_1_admin."::INT[],".$nivel_2_admin."::INT[],".$nivel_3_admin."::INT[],'$id')";						
				} else {
					$nivel_1_otros = "array['".implode("', '", $nivel_1_otros)."']";
					$nivel_2_otros = "array['".implode("', '", $nivel_2_otros)."']";
					$nivel_3_otros = "array['".implode("', '", $nivel_3_otros)."']";	
					$sql ="insert into permisos values ('$id_p',".$nivel_1_otros."::INT[],".$nivel_2_otros."::INT[],".$nivel_3_otros."::INT[],'$id')";						
				}

				$guardar = guardarSql($conexion,$sql);
				$sql_nuevo = "select (id_permisos,nivel1,nivel2,nivel3,id_usuario) from permisos where id_permisos = '$id_p'";        
        		$sql_nuevo = sql_array($conexion,$sql_nuevo);
        		auditoria_sistema($conexion,'permisos',$id_user,'Insert',$id,$fecha_larga,$fecha,$sql_nuevo,'');
				/**/

				if($guardar == 'true') {
					$data = 0; ////datos guardados
				} else {
					$data = 3; /// error al guardar
				}

				$contrasenia = md5($_POST['txt_6']);

				$contenido_html = '<!doctype html>
				<html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <meta name="viewport" content="initial-scale=1.0" /> <meta name="format-detection" content="telephone=no" /> <title></title> <style type="text/css"> body {
				        width: 100%;
				        margin: 0;
				        padding: 0;
				        -webkit-font-smoothing: antialiased;
				    }
				    @media only screen and (max-width: 600px) {
				        table[class="table-row"] {
				            float: none !important;
				            width: 98% !important;
				            padding-left: 20px !important;
				            padding-right: 20px !important;
				        }
				        table[class="table-row-fixed"] {
				            float: none !important;
				            width: 98% !important;
				        }
				        table[class="table-col"],
				        table[class="table-col-border"] {
				            float: none !important;
				            width: 100% !important;
				            padding-left: 0 !important;
				            padding-right: 0 !important;
				            table-layout: fixed;
				        }
				        td[class="table-col-td"] {
				            width: 100% !important;
				        }
				        table[class="table-col-border"] + table[class="table-col-border"] {
				            padding-top: 12px;
				            margin-top: 12px;
				            border-top: 1px solid #E8E8E8;
				        }
				        table[class="table-col"] + table[class="table-col"] {
				            margin-top: 15px;
				        }
				        td[class="table-row-td"] {
				            padding-left: 0 !important;
				            padding-right: 0 !important;
				        }
				        table[class="navbar-row"],
				        td[class="navbar-row-td"] {
				            width: 100% !important;
				        }
				        img {
				            max-width: 100% !important;
				            display: inline !important;
				        }
				        img[class="pull-right"] {
				            float: right;
				            margin-left: 11px;
				            max-width: 125px !important;
				            padding-bottom: 0 !important;
				        }
				        img[class="pull-left"] {
				            float: left;
				            margin-right: 11px;
				            max-width: 125px !important;
				            padding-bottom: 0 !important;
				        }
				        table[class="table-space"],
				        table[class="header-row"] {
				            float: none !important;
				            width: 98% !important;
				        }
				        td[class="header-row-td"] {
				            width: 100% !important;
				        }
				    }
				    @media only screen and (max-width: 480px) {
				        table[class="table-row"] {
				            padding-left: 16px !important;
				            padding-right: 16px !important;
				        }
				    }
				    @media only screen and (max-width: 320px) {
				        table[class="table-row"] {
				            padding-left: 12px !important;
				            padding-right: 12px !important;
				        }
				    }
				    @media only screen and (max-width: 458px) {
				        td[class="table-td-wrap"] {
				            width: 100% !important;
				        }
				    }
				    </style> </head> <body style="font-family: Arial, sans-serif; font-size:13px; color: #444444; min-height: 200px;" bgcolor="#E4E6E9" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0"> <table width="100%" height="100%" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0"> <tr><td width="100%" align="center" valign="top" bgcolor="#E4E6E9" style="background-color:#E4E6E9; min-height: 200px;"> <table><tr><td class="table-td-wrap" align="center" width="458"><table class="table-space" height="18" style="height: 18px; font-size: 0px; line-height: 0; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="18" style="height: 18px; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" align="left">&nbsp;
				    </td></tr></tbody></table> <table class="table-space" height="8" style="height: 8px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="8" style="height: 8px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;
				    </td></tr></tbody></table> <table class="table-row" width="450" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left"> <table class="table-col" align="left" width="378" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="378" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; width: 378px;" valign="top" align="left"> <table class="header-row" width="378" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="header-row-td" width="378" style="font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #84CA47; margin: 0px; font-size: 18px; padding-bottom: 10px; padding-top: 15px; text-align: center;" valign="top" align="left">¡Gracias por registrarse con nosotros!</td></tr></tbody></table> <div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px; text-align: center;"> <b style="color: #777777;">Su cuenta de NELTEX OTAVALO ha sido configurada y este correo contiene toda la información que necesitará para comenzar a utilizar tu cuenta. <br> Por favor confirme su registro para continuar. </div> </td></tr></tbody></table> </td></tr></tbody></table> <table class="table-space" height="12" style="height: 12px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="12" style="height: 12px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;
				    </td></tr></tbody></table> <table class="table-space" height="12" style="height: 12px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="12" style="height: 12px; width: 450px; padding-left: 16px; padding-right: 16px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="center">&nbsp;
				    <table bgcolor="#E8E8E8" height="0" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td bgcolor="#E8E8E8" height="1" width="100%" style="height: 1px; font-size:0;" valign="top" align="left">&nbsp;
				    </td></tr></tbody></table></td></tr></tbody></table> <table class="table-space" height="16" style="height: 16px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="16" style="height: 16px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;
				    </td></tr></tbody></table> <table class="table-row" width="450" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left"> <table class="table-col" align="left" width="378" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="378" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; width: 378px;" valign="top" align="left"> <div style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; text-align: center;"> <a href="http://www.mediasneltex.com/activacion.php?id='.$id.'" style="color: #ffffff; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border: 4px solid #CA1D27; padding: 4px 9px; font-size: 15px; line-height: 21px; background-color: #CA1D27;">&nbsp;
				    Confirmar &nbsp;
				    </a> </div> <table class="table-space" height="16" style="height: 16px; font-size: 0px; line-height: 0; width: 378px; background-color: #ffffff;" width="378" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="16" style="height: 16px; width: 378px; background-color: #ffffff;" width="378" bgcolor="#FFFFFF" align="left">&nbsp;
				    </td></tr></tbody></table> </td></tr></tbody></table> </td></tr></tbody></table> <table class="table-space" height="6" style="height: 6px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="6" style="height: 6px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;
				    </td></tr></tbody></table> <table class="table-row-fixed" width="450" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-fixed-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 1px; padding-right: 1px;" valign="top" align="left"> <table class="table-col" align="left" width="448" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="448" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal;" valign="top" align="left"> <table width="100%" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td width="100%" align="center" bgcolor="#f5f5f5" style="font-family: Arial, sans-serif; line-height: 24px; color: #bbbbbb; font-size: 13px; font-weight: normal; text-align: center; padding: 9px; border-width: 1px 0px 0px; border-style: solid; border-color: #e3e3e3; background-color: #f5f5f5;" valign="top"> <a href="#" style="color: #428bca; text-decoration: none; background-color: transparent;">NELTEX OTAVALO &copy;
				    2016-2017</a> <br> <a href="#" style="color: #84CA47; text-decoration: none; background-color: transparent;">twitter</a> . <a href="#" style="color: #5b7a91; text-decoration: none; background-color: transparent;">facebook</a> . <a href="#" style="color: #dd5a43; text-decoration: none; background-color: transparent;">google+</a> </td></tr></tbody></table> </td></tr></tbody></table> </td></tr></tbody></table> <table class="table-space" height="1" style="height: 1px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="1" style="height: 1px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;
				    </td></tr></tbody></table> <table class="table-space" height="36" style="height: 36px; font-size: 0px; line-height: 0; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="36" style="height: 36px; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" align="left">&nbsp;
				    </td></tr></tbody></table></td></tr></table> </td></tr> </table> </body> </html>';

				//$email = new email();
				//$titulo = utf8_decode('Activación de cuenta');
				//$contenido_html = utf8_decode($contenido_html);
				//$correo = $_POST['txt_8']; 
				//$email->enviar($correo, 'NELTEX', $titulo, $contenido_html);
				$para = $_POST['txt_8'];
				$titulo = utf8_decode('Activación de cuenta');
				$contenido_html = utf8_decode($contenido_html);
				// Cabecera que especifica que es un HMTL
				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				 
				// Cabeceras adicionales
				$cabeceras .= 'From: NELTEX <tarifas@example.com>' . "\r\n";
				$cabeceras .= 'Cc: archivotarifas@example.com' . "\r\n";
				$cabeceras .= 'Bcc: copiaoculta@example.com' . "\r\n";

				mail($para, $titulo, $contenido_html, $cabeceras);

				$sql = "insert into claves values ('$id_c','$id','$contrasenia')";
				$guardar = guardarSql($conexion,$sql);
				if($guardar == 'true') {
					$data = 0; ////datos guardados
				} else { 
					$data = 3; /// error al guardar
				}
			}	
		}
	} else {
		if($_POST['tipo'] == "m") {
			$repetidos = repetidos($conexion,"usuario",strtoupper($_POST["txt_13"]),"usuario","m",$_POST['txt_o'],"id_usuario");		
			if($repetidos == 'true') {
				$data = 1; /// este dato ya existe;
			} else {		
				if (strpos($cadena, $buscar) ==  FALSE) {
					$sql ="update usuario set identificacion='$_POST[txt_1]',nombres_completos='$_POST[txt_2]',telefono1='$_POST[txt_3]',telefono2='$_POST[txt_7]',id_ciudad='$_POST[txt_11]',direccion='$_POST[txt_12]',correo='$_POST[txt_8]',usuario='$_POST[txt_13]',id_cargo='$_POST[txt_4]',extranjero='$check' where id_usuario = '$_POST[txt_o]'";					
				} else {	
					$resp = img_64("img",$_POST['img'],'png',$_POST['txt_o']);														
					if($resp == "true") {												
						$sql ="update usuario set identificacion='$_POST[txt_1]',nombres_completos='$_POST[txt_2]',telefono1='$_POST[txt_3]',telefono2='$_POST[txt_7]',id_ciudad='$_POST[txt_11]',direccion='$_POST[txt_12]',correo='$_POST[txt_8]',usuario='$_POST[txt_13]',id_cargo='$_POST[txt_4]',imagen='".$_POST['txt_o'].".png',extranjero='$check' where id_usuario = '$_POST[txt_o]'";					
					} else {						
						$sql ="update usuario set identificacion='$_POST[txt_1]',nombres_completos='$_POST[txt_2]',telefono1='$_POST[txt_3]',telefono2='$_POST[txt_7]',id_ciudad='$_POST[txt_11]',direccion='$_POST[txt_12]',correo='$_POST[txt_8]',usuario='$_POST[txt_13]',id_cargo='$_POST[txt_4]',extranjero='$check' where id_usuario = '$_POST[txt_o]'";					
					}
				}

				$guardar = guardarSql($conexion,$sql);
				if($guardar == 'true') {
					$data = 0; ////datos guardados
				}else{
					$data = 2; /// error al guardar
				}				
				$sql = "update claves set id_usuario='$_POST[txt_o]',clave='$_POST[txt_5]' where id_usuario = '$_POST[txt_o]'";
				$sql_anterior = "select (id_usuario,identificacion,nombres_completos,telefono1,telefono2,id_ciudad,direccion,correo,usuario,id_cargo,estado,imagen,extranjero,fecha_creacion) from usuario where id_usuario ='$_POST[txt_o]'";        
        		$sql_anterior = sql_array($conexion,$sql_anterior);
				guardarSql($conexion,$sql);
				$sql_nuevo = "select (id_usuario,identificacion,nombres_completos,telefono1,telefono2,id_ciudad,direccion,correo,usuario,id_cargo,estado,imagen,extranjero,fecha_creacion) from usuario where id_usuario ='$_POST[txt_o]'";        
            	$sql_nuevo = sql_array($conexion,$sql_nuevo);            
            	auditoria_sistema($conexion,'usuario',$id_user,'Update',$_POST['txt_o'],$fecha_larga,$fecha,$sql_nuevo,$sql_anterior);
			}
		}
	}
		
	echo $data;
	
	if (isset($_POST['guardar_cargo'])) {
		//$repetidos = repetidos($conexion, "descripcion", strtoupper($_POST['txt_cargo']), "cargo", "g", "", "");
        //if ($repetidos == 'true') {
        //    $data = "1"; /// este dato ya existe;
        //} else {
            $sql = "insert into cargo values ('$id','" . strtoupper($_POST['txt_cargo']) . "','0')";
            $guardar = guardarSql($conexion, $sql);

            $data = "2";
        //}

        echo $data;	
	}

	if (isset($_POST['guardar_pais'])) {
		$repetidos = repetidos($conexion, "descripcion", strtoupper($_POST['txt_pais']), "pais", "g", "", "");
        if ($repetidos == 'true') {
            $data = "1"; /// este dato ya existe;
        } else {
            $sql = "insert into pais values ('$id','" . strtoupper($_POST['txt_pais']) . "')";
            $guardar = guardarSql($conexion, $sql);

            $data = "2";
        }

        echo $data;	
	}

	if (isset($_POST['guardar_provincia'])) {
		$repetidos = repetidos($conexion, "descripcion", strtoupper($_POST['txt_provincia']), "provincia", "g", "", "");
        if ($repetidos == 'true') {
            $data = "1"; /// este dato ya existe;
        } else {
            $sql = "insert into provincia values ('$id','" . strtoupper($_POST['txt_provincia']) . "', '".$_POST['id']."')";
            $guardar = guardarSql($conexion, $sql);

            $data = "2";
        }

        echo $data;	
	}

	if (isset($_POST['guardar_ciudad'])) {
		$repetidos = repetidos($conexion, "descripcion", strtoupper($_POST['txt_ciudad']), "ciudad", "g", "", "");
        if ($repetidos == 'true') {
            $data = "1"; /// este dato ya existe;
        } else {
            $sql = "insert into ciudad values ('$id','" . strtoupper($_POST['txt_ciudad']) . "', '".$_POST['id']."')";
            $guardar = guardarSql($conexion, $sql);

            $data = "2";
        }

        echo $data;	
	}
?>