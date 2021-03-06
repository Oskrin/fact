<?php include('../menu/index.php'); ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		
		<link rel="shortcut icon" href="../../dist/images/logo.fw.png">
		<title>Inicio - <?php empresa(); ?></title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../../dist/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../dist/css/font-awesome.min.css" />
		<!-- Select -->
		<link rel="stylesheet" href="../../dist/css/chosen.min.css" />				
		<link rel="stylesheet" href="../../dist/css/ui.jqgrid.min.css" />
		<link rel="stylesheet" href="../../dist/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="../../dist/css/datepicker.min.css" />
		<link rel="stylesheet" href="../../dist/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="../../dist/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="../../dist/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="../../dist/css/fontdc.css" />
		<link rel="stylesheet" href="../../dist/css/jquery-ui.custom.min.css" type="text/css"/>
		<link rel="stylesheet" href="../../dist/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="../../dist/css/style.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="../../dist/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link type="text/css" rel="stylesheet" id="ace-skins-stylesheet" href="../../dist/css/ace-skins.min.css">
        <link type="text/css" rel="stylesheet" id="ace-rtl-stylesheet" href="../../dist/css/ace-rtl.min.css">
        <script src="../../dist/js/ace-extra.min.js"></script>
    </head>

    <body class="skin-2">
		<?php menu_arriba(); ?>
		<div class="main-container" id="main-container">
			<?php menu_lateral(); ?>
			 <div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-xs-12 col-sm-12 widget-container-col">
										<div class="widget-box">
											<div class="widget-header">
												<h5 class="widget-title">Factura Compra</h5>
												<div class="widget-toolbar">
													<a href="" data-action="fullscreen" class="orange2">
														<i class="ace-icon fa fa-expand"></i>
													</a>
													<a href="" data-action="reload">
														<i class="ace-icon fa fa-refresh"></i>
													</a>
												</div>
											</div>		

											<div class="widget-body">
												<div class="widget-main">
													<div class="row">
														<div class="col-xs-12">
															<div class="tabbable">
																<ul class="nav nav-tabs" id="myTab">
																	<li class="active">
																		<a data-toggle="tab" href="#factura">
																			<i class="green ace-icon fa fa-pencil-square-o bigger-120"></i>
																			Factura
																		</a>
																	</li>

																	<li class="">
        																<a data-toggle="tab" href="#detalle_pagos">
        																	<i class="green ace-icon fa fa-money bigger-120"></i>
        																	Detalle Pagos
        																</a>
        															</li>
																</ul>

																<form class="form-horizontal" id="form_facturaCompra" name="form_facturaCompra">
																	<div class="tab-content">
																		<div id="factura" class="tab-pane fade in active">
																			<div class="row">
																				<div class="col-md-12 pull-right">
																					<div class="col-md-4">
																						<label class="col-sm-4 no-padding-right" for="fecha_actual">Fecha Actual:</label>
																						<div class="col-sm-8">
																							<div class="input-group">
																								<input class="form-control date-picker" id="fecha_actual" name="fecha_actual" type="text" readonly data-date-format="yyyy-mm-dd" />
																								<input type="hidden" id="comprobante" name="comprobante" readonly class="form-control" />
																								<span class="input-group-addon">
																									<i class="fa fa-calendar bigger-110"></i>
																								</span>
																							</div>
																						</div>
																					</div>

																					<div class="col-md-4">
																						<label class="col-sm-4 no-padding-right" for="hora_actual">Hora Actual:</label>
																						<div class="col-sm-8">
																							<div class="input-group">
																								<input class="form-control" type="text" id="hora_actual" name="hora_actual"  readonly />
																								<span class="input-group-addon">
																									<i class="fa fa-clock-o bigger-110"></i>
																								</span>
																							</div>
																						</div>
																					</div>

																					<div class="col-md-4">
																						<span class="bigger-120">
																							<span class="red bolder">Responsable:</span>
																							<span ><?php print($_SESSION['nombrescompletosdow']); ?></span>
																						</span>
																					</div>
																				</div>
																			</div>

																			<div class="hr"></div>

																			<div class="row">
																				<div class="col-md-12">
																					<div class="col-md-5">
																						<div class="form-group">
																							<label class="col-sm-4 no-padding-right" for="serie3">Numero de serie: <font color="red">*</font></label>	
																							<div class="col-sm-8">
																								<input type="text" id="serie" name="serie" class="form-control" />					
																								<input type="hidden" id="id_factura_compra" name="id_factura_compra" class="form-control" />	
																							</div>															
																						</div>
																					</div>

																					<div class="col-md-7">
																						<div class="form-group">
																							<label class="col-sm-5 control-label no-padding-right" for="tipo_comprobante">Tipo de Comprobante</label>
																							<div class="col-sm-7">
																								<select class="chosen-select form-control" id="tipo_comprobante" name="tipo_comprobante" data-placeholder="Tipo de Comprobante">
							                                                                    </select>
																							</div>		
																						</div>
																					</div>
																				</div>
																			</div>	

																			<div class="row">
																				<div class="col-md-12">
																					<div class="col-md-5">
																						<div class="form-group">
																							<label class="col-sm-4 no-padding-right" for="txt_nro_identificacion">Cédula de Identidad o Ruc: <font color="red">*</font></label>
																							<div class="col-sm-8">
																							<input type="hidden" id="id_proveedor" name="id_proveedor">	
																								<select class="chosen-select form-control" id="txt_nro_identificacion" name="txt_nro_identificacion" data-placeholder="Nro de identifiación">	     
							                                                                        <option value=""></option>     
							                                                                    </select>
																							</div>
																						</div>												
																					</div>

																					<div class="col-md-7">
																						<div class="form-group">
																							<label class="col-sm-5 control-label no-padding-right" for="txt_nombre_proveedor">Proveedor:<font color="red">*</font></label>
																							<div class="col-sm-7">
																								<select class="chosen-select form-control" id="txt_nombre_proveedor" name="txt_nombre_proveedor" data-placeholder="Nombres Completos">        
							                                                                        <option value=""> </option>          
							                                                                    </select>
																							</div>
																						</div>									
																					</div>
																				</div>
																			</div>	

																			<div class="row">
																				<div class="col-md-12">
																					<div class="col-sm-4">
																						<div class="form-group">
																							<label class="col-sm-5 no-padding-right" for="fecha_registro">Fecha Registro:</label>
																							<div class="col-sm-7">
																								<div class="input-group">
																									<input type="text" id="fecha_registro" name="fecha_registro" readonly class="form-control date-picker" />
																									<span class="input-group-addon">
																										<i class="fa fa-calendar bigger-110"></i>
																									</span>
																								</div>
																							</div>
																						</div>
																					</div>

																					<div class="col-sm-4">
																						<div class="form-group">	
																							<label class="col-sm-5 control-label no-padding-right" for="fecha_emision">Fecha Emisión:</label>
																							<div class="col-sm-7">
																								<div class="input-group">
																									<input type="text" id="fecha_emision" name="fecha_emision" readonly class="form-control date-picker" />
																									<span class="input-group-addon">
																										<i class="fa fa-calendar bigger-110"></i>
																									</span>
																								</div>
																							</div>		
																						</div>
																					</div>

																					<div class="col-sm-4">
																						<div class="form-group">
																							<label class="col-sm-5 control-label no-padding-right" for="fecha_caducidad">Fecha Caducidad:</label>
																							<div class="col-sm-7">
																								<div class="input-group">
																									<input type="text" id="fecha_caducidad" name="fecha_caducidad" readonly class="form-control date-picker" />
																									<span class="input-group-addon">
																										<i class="fa fa-calendar bigger-110"></i>
																									</span>
																								</div>
																							</div>		
																						</div>
																					</div>															
																				</div>
																			</div>

																			<div class="row">
																				<div class="col-md-12">
																					<div class="col-sm-4">
																						<div class="form-group">
																							<label class="col-sm-5 no-padding-right" for="fecha_cancelacion">Fecha cancelación:</label>
																								<div class="col-sm-7">
																									<div class="input-group">
																									<input type="text" id="fecha_cancelacion" name="fecha_cancelacion" readonly class="form-control date-picker" />
																									<span class="input-group-addon">
																										<i class="fa fa-calendar bigger-110"></i>
																									</span>
																								</div>
																							</div>		
																						</div>
																					</div>

																					<div class="col-sm-4">
																						<div class="form-group">	
																							<label class="col-sm-5 control-label no-padding-right" for="autorizacion">Nro de Autorización: <font color="red">*</font></label>
																							<div class="col-sm-7">
																								<input type="text" id="autorizacion" name="autorizacion" class="form-control" maxlength="30" /> 
																							</div>	
																						</div>
																					</div>

																					<div class="col-sm-4">
																						<div class="form-group">
																							<label class="col-sm-5 control-label no-padding-right" for="formas">Forma de Pago:</label>
																							<div class="col-sm-7">
																								<select class="chosen-select form-control" id="formas" name="formas" data-placeholder="Forma de Pago">                   
							                                                                    </select>
																							</div>		
																						</div>														
																					</div>
																				</div>
																			</div>

																			<div class="row">
																				<div class="col-md-12">												
																					<div class="col-sm-4">
																						<div class="form-group" style="display: none;">
																							<label class="col-sm-5 no-padding-right" for="termino_pago"> Términos de Pago:</label>
																							<div class="col-sm-7">
																								<select class="chosen-select form-control" id="termino_pago" name="termino_pago" data-placeholder="Términos de Pago">
							                                                                    </select>
																							</div>		
																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="row ">
																				<div class="col-xs-12">
																					<div class="col-xs-12">
																						<h3 class="header smaller lighter green">
																							Detalle Factura
																						</h3>
																					</div>
																				</div>
																			</div>

																			<div class="row">
																				<div class="col-xs-12">
																					<div class="col-xs-2">
																						<div class="row">
																							<div class="col-xs-12">
																								<label>Codigo Barra:</label>
																							</div>
																						</div>
																						<div class="row">
																							<div class="col-xs-12">
																								<input type="text" id="codigo_barras" name="codigo_barras"  class="form-control" />				
																							</div>
																						</div>
																					</div>
																					<div class="col-xs-3">
																						<div class="row">
																							<div class="col-xs-12">
																								<label>Código:</label>
																							</div>
																						</div>
																						<div class="row">
																							<div class="col-xs-12">
																								<input type="text" id="codigo" name="codigo"  class="form-control" />	
																							</div>
																						</div>
																					</div>
																					<div class="col-xs-4">
																						<div class="row">
																							<div class="col-xs-12">
																								<label>Producto:</label>
																							</div>
																						</div>
																						<div class="row">
																							<div class="col-xs-12">
																								<input type="text" id="producto" name="producto"  class="form-control" />
																							</div>
																						</div>
																					</div>

																					<div class="col-xs-3">
																						<div class="row">
																							<div class="col-xs-12">
																								<div class="col-sm-4">
																									<div class="row">
																										<div class="col-xs-12">
																											<label> Cantidad:</label>
																										</div>
																									</div>
																									<div class="row">
																										<div class="col-xs-12">
																											<input type="text" id="cantidad" name="cantidad" class="form-control" /> 
																										</div>
																									</div>
																								</div>
																								<div class="col-sm-4">
																									<div class="row">
																										<div class="col-xs-12">
																											<label> Precio:</label>
																										</div>
																									</div>
																									<div class="row">
																										<div class="col-xs-12">
																											<input type="text" id="precio" name="precio" onkeydown="return validarNumeros(event)" value="0.00" class="form-control" /> 
																										</div>
																									</div>
																								</div>
																								<div class="col-sm-4">
																									<div class="row">
																										<div class="col-xs-12">
																											<label> Descuento:</label>
																										</div>
																									</div>
																									<div class="row">
																										<div class="col-xs-12">
																											<input type="number" id="descuento" name="descuento" class="form-control" value="0" min="0" maxlength="3" /> 
																											<input type="hidden" id="stock" name="stock" class="form-control" /> 
																											<input type="hidden" id="id_productos" name="id_productos" class="form-control" /> 
																											<input type="hidden" id="iva_producto" name="iva_producto" class="form-control" /> 
																											<input type="hidden" id="incluye" name="incluye" class="form-control" />
																											<input type="hidden" id="inventar" name="inventar" class="form-control" />  
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>

																			<div class="row">
																				<div class="col-xs-12">
																					<div class="col-sm-12">
																						<div class="hr hr-18 dotted hr-double"></div>
																					</div>
																				</div>
																			</div>

																			<div class="col-md-12">
													                            <div id="grid_container">
													                                <table id="list"></table>
													                            </div>
													                        </div>

													                        <div class="row">
																				<div class="col-md-12">
																					<div class="col-md-9"></div>
																					<div class="col-md-3">	
																						<div class="form-group">
																							<label class="col-sm-4 no-padding-right" for="tarifa0"> Tarifa 0:</label>
																							<div class="col-sm-8">
																								<input type="text" id="tarifa0" name="tarifa0" class="form-control" readonly value="0.000" /> 
																							</div>	
																						</div>	

																						<div class="form-group">
																							<label class="col-sm-4 no-padding-right" for="tarifa12"> Tarifa 12:</label>
																							<div class="col-sm-8">
																								<input type="text" id="tarifa12" name="tarifa12" class="form-control" readonly value="0.000" /> 
																							</div>	
																						</div>

																						<div class="form-group">
																							<label class="col-sm-4 no-padding-right" for="iva"> 12 % Iva:</label>
																							<div class="col-sm-8">
																								<input type="text" id="iva" name="iva" class="form-control" readonly value="0.000" /> 
																							</div>	
																						</div>

																						<div class="form-group">
																							<label class="col-sm-4 no-padding-right" for="descuento_total"> Descuento:</label>
																							<div class="col-sm-8">
																								<input type="text" id="descuento_total" name="descuento_total" class="form-control" readonly value="0.000" /> 
																							</div>	
																						</div>

																						<div class="form-group">
																							<label class="col-sm-4 no-padding-right" for="total"> Total:</label>
																							<div class="col-sm-8">
																								<input type="text" id="total" name="total" class="form-control" readonly value="0.000" /> 
																							</div>	
																						</div>												
																					</div>	
																				</div>
																			</div>
																		</div>
																		
																		<div id="detalle_pagos" class="tab-pane fade">
        																	<div class="row">
        																		<div class="col-md-12 pull-right">
        																			<div class="col-md-4">
        																				<label class="col-sm-4 no-padding-right" for="adelanto">Adelanto:</label>
        																				<div class="col-sm-8">
        																					<div class="input-group">
        																						<input type="text"  id="adelanto" name="adelanto" class="form-control" value="0.00"/>
        																						<span class="input-group-addon">
        																							<i class="fa fa-usd bigger-110"></i>
        																						</span>
        																					</div>
        																				</div>
        																			</div>
        
        																			<div class="col-md-4">
        																				<label class="col-sm-4 no-padding-right" for="meses">Meses:</label>
        																				<div class="col-sm-8">
        																					<input class="form-control" type="number" id="meses" name="meses" min="1" max="3" value="0" />
        																				</div>
        																			</div>
        
        																			<div class="col-md-4">
        																			</div>
        																		</div>
        																	</div>
        																</div>
																	</div>
																</form>

																<div class="row">
																	<div class="center">													 
																		<button type="submit" class="btn btn-primary" id="btn_0">
																			<i class="ace-icon fa fa-floppy-o bigger-120 write"></i>
																			Guardar
																		</button>
																		<button type="button" id="btn_1" class="btn btn-primary">
																			<i class="ace-icon fa fa-refresh bigger-120 write"></i>
																			Actualizar
																		</button>														
																		<button data-toggle="modal" href="#myModal" type="button" class="btn btn-primary">
																			<i class="ace-icon fa fa-search bigger-120 write"></i>
																			Buscar
																		</button>
																		<button type="button" id="btn_2" class="btn btn-primary">
																			<i class="ace-icon fa fa-arrow-circle-left bigger-120 write"></i>
																			Atras
																		</button>
																		<button type="button" id="btn_3" class="btn btn-primary">
																			<i class="ace-icon fa fa fa-arrow-circle-right bigger-120 write"></i>
																			Adelante
																		</button>
																	</div>
																</div>	
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>							
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php footer(); ?>

		<a href="" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
		</div>

		<!-- Modal -->
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
				    <div class="modal-header">
				      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				      	<h4 class="modal-title">BUSCAR FACTURAS COMPRAS</h4>
				    </div>
				    <div class="modal-body">
				        <table id="table2"></table>
						<div id="pager2"></div>
				    </div>
				    <div class="modal-footer">
				      	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				    </div>
				</div>
			</div>
		</div>

		<!-- Modal País-->
		<div class="modal fade" id="modal_chequera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
			    <div class="modal-content blue">
			        <div class="modal-header">
			          	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			          	<h4 class="modal-title">AGREGAR CHEQUERA</h4>
			        </div>

			        <form class="form-horizontal" name="form_chequera" id="form_chequera" autocomplete="off">
			        	<div class="modal-body">		            
			            	<div class="form-group has-error">
								<label class="col-sm-3 control-label no-padding-right" for="num_cheque">Número Cheque:</label>
								<div class="col-sm-7">
									<input type="text" id="num_cheque" name="num_cheque"  placeholder="Número Cheque" class="form-control" />
								</div>
							</div>

							<div class="form-group has-error">
								<label class="col-sm-3 control-label no-padding-right" for="banco">Banco:</label>
								<div class="col-sm-7">
									<input type="text" id="banco" name="banco"  placeholder="Banco" class="form-control" />
								</div>
							</div>

							<div class="form-group has-error">
								<label class="col-sm-3 control-label no-padding-right" for="monto">Monto:</label>
								<div class="col-sm-7">
									<input type="text" id="monto" name="monto" placeholder="Monto" class="form-control" value="0.00" />
								</div>
							</div>

							<div class="form-group has-error">
								<label class="col-sm-3 control-label no-padding-right" for="fecha_cheque">Fecha Cheque:</label>
								<div class="col-sm-7">
									<div class="input-group">
										<input type="text" id="fecha_cheque" name="fecha_cheque" class="form-control date-picker" />
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</div>
							</div>								            
			        	</div>
			        	<div class="modal-footer">
				          	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				         	<button type="button" class="btn btn-primary" id="btn_confirmar">Confirmar</button>
				        </div>
			        </form>
			    </div>
		    </div>
		</div>
		<!-- /.modal -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='../../dist/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../../dist/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../../dist/js/bootstrap.min.js"></script>

		<script src="../../dist/js/jquery-ui.min.js"></script>
		<script src="../../dist/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../../dist/js/jquery.easypiechart.min.js"></script>
		<script src="../../dist/js/jquery.sparkline.min.js"></script>
		<script src="../../dist/js/flot/jquery.flot.min.js"></script>
		<script src="../../dist/js/flot/jquery.flot.pie.min.js"></script>
		<script src="../../dist/js/flot/jquery.flot.resize.min.js"></script>
		<script src="../../dist/js/chosen.jquery.min.js"></script>
		<script src="../../dist/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="../../dist/js/date-time/bootstrap-timepicker.min.js"></script>
		<script src="../../dist/js/date-time/daterangepicker.min.js"></script>
		<script src="../../dist/js/date-time/moment.min.js"></script>
				
		<!-- ace scripts -->
		<script src="../../dist/js/ace-elements.min.js"></script>
		<script src="../../dist/js/ace.min.js"></script>
		<script src="../../dist/js/jqGrid/jquery.jqGrid.min.js"></script>
        <script src="../../dist/js/jqGrid/i18n/grid.locale-en.js"></script>
        <script src="../../dist/js/jquery.maskedinput.min.js"></script>
        <script src="../../dist/js/jquery.bootstrap-duallistbox.min.js"></script>
        <script src="../../dist/js/jquery.raty.min.js"></script>
        <script src="../../dist/js/select2.min.js"></script>
        <script src="../../dist/js/bootstrap-multiselect.min.js"></script>
		
		<script src="../generales.js"></script>
		<script src="factura_compra.js"></script>
		<script src="../../dist/js/validCampoFranz.js" ></script>
		<script src="../../dist/js/jquery.gritter.min.js"></script>
		<script src="../../dist/js/ventana_reporte.js" type="text/javascript"></script>
	</body>
</html>  

<!-- Modal imprimir-->
<!-- <div id="top-menu" class="modal aside" data-fixed="true" data-placement="top" data-background="true" data-backdrop="invisible" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body container">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1 white">
						<h3 class="lighter">Factura Compras</h3>
						
					</div>

					<div class="col-sm-5 text-center line-height-2">									
						&nbsp; &nbsp;
						<a class="btn btn-app btn-light no-radius" href="#">
							<i class="ace-icon fa fa-print bigger-230"></i>
							Imprimir
						</a>
					</div>
				</div>
			</div>
		</div>
		<button class="btn btn-inverse btn-app btn-xs ace-settings-btn aside-trigger" data-target="#top-menu" data-toggle="modal" type="button">
			<i data-icon="fa-chevron-down" data-icon="fa-chevron-up" class="ace-icon fa fa-chevron-down bigger-110 icon-only"></i>
		</button>
	</div>
</div>
 -->
