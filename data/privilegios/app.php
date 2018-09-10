<?php 
	include '../conexion.php';
	include '../funciones_generales.php';		
	$conexion = conectarse();	
    date_default_timezone_set('America/Guayaquil');
	$fecha = date('Y-m-d H:i:s', time());
	$fecha_larga = date('His', time());
	$sql = "";	
	$id = unique($fecha_larga);			
	$id_user = sesion_activa();
	
	//error_reporting(E_ALL);
//ini_set('display_errors', '1');

	// modificar privilegios
	if (isset($_POST['updateprivilegios'])) {
		$vector = json_encode($_POST['data']);
		$data = 0;

		$sql = "update privilegios set data = '$vector' where id_usuario='$_POST[user]'";	
    	$guardar = guardarSql($conexion,$sql);
	
		//$resp = $class->consulta("UPDATE privilegios SET data = '$vector' WHERE id_cargo = '$_POST[user]'");
		//if ($sql) {
			$data = 1;
		//} 

		echo $data;
	}
	// fin

	//LLena combo cargos
	if (isset($_POST['llenar_cargos'])) {
        $consulta = pg_query("SELECT id_usuario, nombres_completos  FROM usuario WHERE estado = '0'");
        print'<option value="">&nbsp;</option>';
        while ($row = pg_fetch_row($consulta)) {
            print '<option value="'.$row[0].'">'.$row[1].'</option>';
        }
	}
	// fin
	
	// estado privilegios
	function buscarstatus($array, $valor) {
		$retorno = array_search($valor, $array);
		if ($retorno) {
			return true;
		} else {
			return false;
		}	
	}
	// fin
	
	// Inicios methodo recursos data
	if (isset($_POST['retornar'])) {
		$sum;
		$consulta = pg_query("SELECT data FROM privilegios WHERE id_usuario = '".$_POST['id']."'");
		while ($row = pg_fetch_row($consulta)) {
			$sum = json_decode($row[0]);
		}

		$acumulador = 
		array(
			'Menú' => 
				array(
				'text' => 'Menú',
				'type' => 'folder',
				'additionalParameters' => 
					array(
						'id' => 1,
						'children' => 
						array(
						    'Inicio'=> 
							array(
								'text' => 'Inicio', 
								'type' => 'item',
								'id' => 'inicio',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'inicio')
								)
							),
							'Bodegas'=> 
							array(
								'text' => 'Bodegas', 
								'type' => 'item',
								'id' => 'bodegas',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'bodegas')
								)
							),
							'Categorias'=> 
							array(
								'text' => 'Categorias', 
								'type' => 'item',
								'id' => 'categorias',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'categorias')
								)
							),
							'Marcas'=> 
							array(
								'text' => 'Marcas', 
								'type' => 'item',
								'id' => 'marcas',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'marcas')
								)
							),
							'UnidadMedida'=> 
							array(
								'text' => 'Unidad Medida', 
								'type' => 'item',
								'id' => 'unidad_medida',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'unidad_medida')
								)
							),
							'TipoProducto'=> 
							array(
								'text' => 'Tipo Producto', 
								'type' => 'item',
								'id' => 'tipo_producto',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'tipo_producto')
								)
							),
							'FormaPago'=> 
							array(
								'text' => 'Forma Pago', 
								'type' => 'item',
								'id' => 'formas_pago',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'formas_pago')
								)
							),
							'TerminosPago'=> 
							array(
								'text' => 'Terminos Pago', 
								'type' => 'item',
								'id' => 'terminos_pago',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'terminos_pago')
								)
							),
							'Usuarios'=> 
							array(
								'text' => 'Usuarios', 
								'type' => 'item',
								'id' => 'usuario',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'usuario')
								)
							),
							'Clientes'=> 
							array(
								'text' => 'Clientes', 
								'type' => 'item',
								'id' => 'clientes',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'clientes')
								)
							),
							'Proveedores'=> 
							array(
								'text' => 'Proveedores', 
								'type' => 'item',
								'id' => 'proveedores',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'proveedores')
								)
							),
							'Empleados'=> 
							array(
								'text' => 'Empleados', 
								'type' => 'item',
								'id' => 'empleados',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'empleados')
								)
							),
							'Productos'=> 
							array(
								'text' => 'Productos', 
								'type' => 'item',
								'id' => 'productos',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'productos')
								)
							),
							'Inventario'=> 
							array(
								'text' => 'Inventario', 
								'type' => 'item',
								'id' => 'inventario',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'inventario')
								)
							),
							'Proforma'=> 
							array(
								'text' => 'Proforma', 
								'type' => 'item',
								'id' => 'proforma',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'proforma')
								)
							),
							'FacturaCompra'=> 
							array(
								'text' => 'Factura Compra', 
								'type' => 'item',
								'id' => 'factura_compra',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'factura_compra')
								)
							),
							'DevolucionCompra'=> 
							array(
								'text' => 'Devolucion Compra', 
								'type' => 'item',
								'id' => 'devolucion_compra',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'devolucion_compra')
								)
							),
							'FacturaVenta'=> 
							array(
								'text' => 'Factura Venta', 
								'type' => 'item',
								'id' => 'factura_venta',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'factura_venta')
								)
							),
							'CuentasCobrar'=> 
							array(
								'text' => 'CuentasCobrar', 
								'type' => 'item',
								'id' => 'cuentas_cobrar',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'cuentas_cobrar')
								)
							),
							'CuentasPagar'=> 
							array(
								'text' => 'Cuentas Pagar', 
								'type' => 'item',
								'id' => 'cuentas_pagar',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'cuentas_pagar')
								)
							),
							'Nomina'=> 
							array(
								'text' => 'Nomina', 
								'type' => 'item',
								'id' => 'pagos',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'pagos')
								)
							),
							'Kardex'=> 
							array(
								'text' => 'Kardex', 
								'type' => 'item',
								'id' => 'kardex',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'kardex')
								)
							),
							'LibroDiario'=> 
							array(
								'text' => 'Libro Diario', 
								'type' => 'item',
								'id' => 'libro_diario',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'libro_diario')
								)
							),
							'MovimientosBancos'=> 
							array(
								'text' => 'Movimientos Bancos', 
								'type' => 'item',
								'id' => 'movimientos_bancos',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'movimientos_bancos')
								)
							),
							'Privilegios'=> 
							array(
								'text' => 'Privilegios', 
								'type' => 'item',
								'id' => 'privilegios',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'privilegios')
								)
							),
							'Porcentaje'=> 
							array(
								'text' => 'Porcentaje', 
								'type' => 'item',
								'id' => 'iva',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'iva')
								)
							),
							'Auditoria'=> 
							array(
								'text' => 'Auditoria', 
								'type' => 'item',
								'id' => 'auditoria',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'auditoria')
								)
							),
							'PlanCuentas'=> 
							array(
								'text' => 'Plan Cuentas', 
								'type' => 'item',
								'id' => 'plan_cuentas',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'plan_cuentas')
								)
							),
							'GruposContables'=> 
							array(
								'text' => 'Grupos Contables', 
								'type' => 'item',
								'id' => 'grupos',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'grupos')
								)
							),
							'SustentoTributario'=> 
							array(
								'text' => 'Sustento Tributario', 
								'type' => 'item',
								'id' => 'sustento_tributario',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'sustento_tributario')
								)
							),
							'TipoComprobante'=> 
							array(
								'text' => 'Tipo Comprobante', 
								'type' => 'item',
								'id' => 'tipo_comprobante',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'tipo_comprobante')
								)
							),
							'SustentoComprobantes'=> 
							array(
								'text' => 'Sustento Comprobantes', 
								'type' => 'item',
								'id' => 'sustento_comprobante',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'sustento_comprobante')
								)
							),
							'Retencion'=> 
							array(
								'text' => 'Retencion', 
								'type' => 'item',
								'id' => 'retencion_fuente',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'retencion_fuente')
								)
							),
							'Bancos'=> 
							array(
								'text' => 'Bancos', 
								'type' => 'item',
								'id' => 'bancos',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'bancos')
								)
							),
							'Cuentas'=> 
							array(
								'text' => 'Cuentas', 
								'type' => 'item',
								'id' => 'cuentas',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'cuentas')
								)
							),
							'Periodo'=> 
							array(
								'text' => 'Periodo', 
								'type' => 'item',
								'id' => 'periodo',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'periodo')
								)
							),
							'formulario101'=> 
							array(
								'text' => 'formulario101', 
								'type' => 'item',
								'id' => 'formulario',
								'additionalParameters' => 
								array(
									'item-selected' => buscarstatus($sum,'formulario')
								)
							)
						)
					)
				)
			);

		$acu2;
		for ($i = 0; $i < count($acu); $i++) { 
			$acu2[$i] = array(
							'text' => $acu[$i], 
							'type' => 'folder',
							'additionalParameters' => 
												array(
													'id' => '1',
													'children'=> 
													array('opcion2' => 
														array(
															'text' => 'opcion2', 
															'type' => 'item',
															'id'=>'moji',
															'additionalParameters' => 
															array(
																'item-selected' => true
															)
														)
													)
												)
											);
		}

		print(json_encode($acumulador));
	}
	// fin

?>

