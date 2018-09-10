<?php include('../menu/index.php'); 
include '../conexion.php';
$conexion = conectarse();
?>
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
		<link rel="stylesheet" href="../../dist/css/select2.min.css" />				
		<link rel="stylesheet" href="../../dist/css/ui.jqgrid.min.css" />
		<link rel="stylesheet" href="../../dist/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="../../dist/css/datepicker.min.css" />
		<link rel="stylesheet" href="../../dist/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="../../dist/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="../../dist/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="../../dist/css/fontdc.css" />
		<link rel="stylesheet" href="../../dist/css/jquery-ui.custom.min.css" type="text/css"/>
		<link rel="stylesheet" href="../../dist/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="../../dist/css/style.css"  />
		<link rel="stylesheet" href="../../dist/css/fileinput.css" media="all" type="text/css" />

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
					<div class="breadcrumbs" id="breadcrumbs">
                        <script type="text/javascript">
                            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                        </script>
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="../inicio/">Inicio</a>
                            </li>
                            <li class="active">Procesos</li>
                            <li class="active">Pagos Nómina</li>
                        </ul>
                    </div>
                    
					<div class="page-content">
						<div class="row">						
							<div class="col-xs-12 col-sm-12 widget-container-col">
								<div class="widget-box">
									<div class="widget-header">
										<h5 class="widget-title">Pagos Nómina</h5>
										<div class="widget-toolbar">
											<a href="#" data-action="fullscreen" class="orange2">
												<i class="ace-icon fa fa-expand"></i>
											</a>
											<a href="#" data-action="reload">
												<i class="ace-icon fa fa-refresh"></i>
											</a>
										</div>
									</div>									
									<div class="widget-body">
										<div class="widget-main">
											<div class="row">
												<form class="form-horizontal" name="form_nomina" id="form_nomina" autocomplete="off">	
													<div class="row">
														<div class="col-md-12 pull-right">
															<div class="col-md-4">
																<label class="col-sm-4 control-label" for="fecha_actual">Fecha Nómina:</label>
																<div class="col-sm-8">
																	<div class="input-group">
																		<input class="form-control date-picker" id="fecha_actual" name="fecha_actual" type="text" readonly data-date-format="yyyy-mm-dd" />
																		<span class="input-group-addon">
																			<i class="fa fa-calendar bigger-110"></i>
																		</span>
																	</div>
																</div>
															</div>

															<div class="col-md-4">
																<label class="col-sm-4 control-label" for="hora_actual">Hora Nómina:</label>
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
															
													<div class="row">
														<div class="col-md-12">
															<div class="hr hr-18 dotted hr-double"></div>
														</div>
													</div>

													<div class="row">	
														<div class="col-md-12">
															<div class="col-md-4">
																<div class="form-group">
																	<label class="col-sm-6 control-label" for="txt_2">Identificación: </label>
																	<div class="col-sm-6">
																		<input type="text" id="txt_2" name="txt_2" class="form-control" readonly   value="" /> 
																		<input type="hidden" id="txt_0" name="txt_0" />
																	</div>									
																</div>

																<div class="form-group">			
																	<label class="col-sm-6 control-label no-padding-right" for="mes"> Mes:</label>
																	<div class="col-sm-6">
																		<select class="select2" id="mes" name="mes" data-placeholder="Mes">
	                                                                    </select>
																	</div>													
																</div>

																<div class="form-group">
																	<label class="col-sm-6 control-label no-padding-right" for="horas_extras">Horas Extras:</label>
																	<div class="col-sm-6">
																		<input type="number" id="horas_extras" name="horas_extras" class="form-control" value="0" />
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-6 control-label no-padding-right" for="decimo_tercero">Décimo Tercero:</label>
																	<div class="col-sm-6">
																		<span class="input-icon">
																			<input type="text" id="decimo_tercero" name="decimo_tercero" class="form-control" value="0.00" />
																			<input type="hidden" id="acumula" name="acumula" class="form-control" value="" />
																			<i class="ace-icon fa fa fa-usd orange"></i>
																		</span>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-6 control-label no-padding-right" for="total_ingresos">Total Ingresos:</label>
																	<div class="col-sm-6">
																		<span class="input-icon">
																			<input type="text" id="total_ingresos" name="total_ingresos" class="form-control" value="0.00" />
																			<i class="ace-icon fa fa fa-usd orange"></i>
																		</span>
																	</div>
																</div>					
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label class="col-sm-4 control-label" for="txt_3">Nombres Empleado: </label>
																	<div class="col-sm-8">
																		<input type="text" id="txt_3" name="txt_3" class="form-control" readonly   value="" />
																	</div>									
																</div>

																<div class="form-group">
																	<label class="col-sm-4 control-label no-padding-right" for="dias_laborados">Días Laborados:</label>
																	<div class="col-sm-6">
																		<input type="text" name="dias_laborados" id="dias_laborados" class="form-control" value="" />
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-4 control-label no-padding-right"></label>
																	<div class="col-sm-6">
																		<button type="button" name="btn_importar" id="btn_importar" class="btn btn-white btn-primary btn-bold" data-toggle="tooltip" title="Importar archivo CSV"><i class="fa fa-file-excel-o bigger-110 green"></i> Importar Días</button>
																		<button type="button" name="btn_importar2" id="btn_importar2" class="btn btn-white btn-primary btn-bold" data-toggle="tooltip" title="Importar archivo CSV"><i class="fa fa-file-excel-o bigger-110 green"></i> Importar Horas</button>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-4 control-label no-padding-right" for="decimo_cuarto">Décimo Cuarto:</label>
																	<div class="col-sm-6">
																		<span class="input-icon">
																			<input type="text" id="decimo_cuarto" name="decimo_cuarto" class="form-control" value="0.00" />
																			<i class="ace-icon fa fa fa-usd orange"></i>
																		</span>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-4 control-label no-padding-right" for="descuento_faltas">Descuento Faltas:</label>
																	<div class="col-sm-6">
																		<span class="input-icon">
																			<input type="text" id="descuento_faltas" name="descuento_faltas" class="form-control" value="0.00" />
																			<i class="ace-icon fa fa fa-usd orange"></i>
																		</span>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-4 control-label no-padding-right" for=""></label>
																	<div class="col-sm-6">
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-4 control-label no-padding-right" for="neto_pagar">Neto a Pagar:</label>
																	<div class="col-sm-6">
																		<span class="input-icon">
																			<input type="text" id="neto_pagar" name="neto_pagar" class="form-control" value="0.00" />
																			<i class="ace-icon fa fa fa-usd orange"></i>
																		</span>
																	</div>
																</div>						
															</div>

															<div class="col-md-4">
																<div class="form-group">
																	<label class="col-sm-5 control-label" for="txt_4">Sueldo:</label>
																	<div class="col-sm-6">
																		<input type="text" id="txt_4" name="txt_4" readonly class="form-control" value="0.00" /> 
																	</div>								
																</div>

																<div class="form-group">
																	<label class="col-sm-5 control-label no-padding-right" for="no_laborado">Días no Laborados:</label>
																	<div class="col-sm-6">
																		<input type="text" name="no_laborado" id="no_laborado" class="form-control" value="" />
																	</div>	
																</div>

																<div class="form-group">
																	<label class="col-sm-5 control-label no-padding-right"></label>
																	<div class="col-sm-6">
																	<button type="button" name="btn_calcular" id="btn_calcular" class="btn btn-white btn-primary btn-bold" data-toggle="tooltip" title="Calcular"> Calcular</button>
																	</div>	
																</div>

																<div class="form-group">
																	<label class="col-sm-5 control-label no-padding-right" for="total_extras">Total Extras:</label>
																	<div class="col-sm-6">
																		<span class="input-icon">
																			<input type="text" id="total_extras" name="total_extras" class="form-control" value="0.00" />
																			<i class="ace-icon fa fa fa-usd orange"></i>
																		</span>
																	</div>
																</div>

																<div class="form-group">
																	<label class="col-sm-5 control-label no-padding-right" for="total_descuentos">Total Descuentos:</label>
																	<div class="col-sm-6">
																		<span class="input-icon">
																			<input type="text" id="total_descuentos" name="total_descuentos" class="form-control" value="0.000" />
																			<i class="ace-icon fa fa fa-usd orange"></i>
																		</span>
																	</div>
																</div>					
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															<div class="hr hr-18 dotted hr-double"></div>
														</div>
													</div>
												</form>

												<div class="row">
													<div class="center">
														<button data-toggle="modal" href="#myModal" type="button" id="btn_3" class="btn btn-primary">
															<i class="ace-icon fa fa-floppy-o bigger-120 write"></i>
															Buscar Empleado
														</button>													 
														<button type="button" class="btn btn-primary" id="btn_0">
															<i class="ace-icon fa fa-floppy-o bigger-120 write"></i>
															Guardar
														</button>
														<button data-toggle="modal" href="#myModal2" type="button" id="btn_4" class="btn btn-primary">
															<i class="ace-icon fa fa-floppy-o bigger-120 write"></i>
															Buscar Nónima
														</button>
														<button type="button" id="btn_1" class="btn btn-primary">
															<i class="ace-icon fa fa-file-o bigger-120 write"></i>
															Limpiar
														</button>
														<button type="button" id="btn_2" class="btn btn-primary">
															<i class="ace-icon fa fa-refresh bigger-120 write"></i>
															Actualizar
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
			</div><!-- /.main-content -->

			<?php footer(); ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- Modal Empleados-->
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
		    <div class="modal-dialog modal-lg">
		        <div class="modal-content">
			        <div class="modal-header">
			          	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			          	<h4 class="modal-title">BUSCAR EMPLEADOS</h4>
			        </div>
			        <div class="modal-body">
			            <table id="table"></table>
						<div id="pager"></div>
			        </div>
			        <div class="modal-footer">
			          	<button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
			        </div>
		        </div>
		    </div>
		</div>
		<!-- /.modal -->

		<!-- Modal Empleados-->
		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal2">
		    <div class="modal-dialog modal-lg">
		        <div class="modal-content">
			        <div class="modal-header">
			          	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			          	<h4 class="modal-title">BUSCAR NÓMINA</h4>
			        </div>
			        <div class="modal-body">
			            <table id="table2"></table>
						<div id="pager2"></div>
			        </div>
			        <div class="modal-footer">
			          	<button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
			        </div>
		        </div>
		    </div>
		</div>
		<!-- /.modal -->

		<!-- Modal Importar Días-->
		<div id="modal-importar" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" name="form_excel" id="form_excel" autocomplete="off">
						<div class="modal-header no-padding">
							<div class="table-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									<span class="white">&times;</span>
								</button>
								Agregar Archivo CSV
							</div>
						</div>

						<div class="modal-body">
							<div class="row center">
								<div class="col-sm-12">
									<div class="form-group">
						                <input type="file" name="archivo_excel" id="archivo_excel" class="file" />
									</div>
								</div>
							</div>
						</div>
						
						<div class="modal-footer no-margin-top">
							<button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal" data-toggle="tooltip" title="Cerrar ventana">
								<i class="ace-icon fa fa-times"></i>
								Cerrar
							</button>
							<button type="button" name="btn_excel" id="btn_excel" class="btn btn-sm btn-primary pull-right" data-toggle="tooltip" title="Cargar Excel">
								<i class="ace-icon fa fa-check"></i>
								Cargar
							</button>
						</div>
					</form>	
				</div>
			</div>
		</div>
		<!-- /.modal -->

		<!-- Modal Importar Extras-->
		<div id="modal-importar2" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" name="form_excel2" id="form_excel2" autocomplete="off">
						<div class="modal-header no-padding">
							<div class="table-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									<span class="white">&times;</span>
								</button>
								Agregar Archivo CSV
							</div>
						</div>

						<div class="modal-body">
							<div class="row center">
								<div class="col-sm-12">
									<div class="form-group">
						                <input type="file" name="archivo_excel" id="archivo_excel" class="file" />
									</div>
								</div>
							</div>
						</div>
											
						<div class="modal-footer no-margin-top">
							<button type="button" class="btn btn-sm btn-danger pull-left" data-dismiss="modal" data-toggle="tooltip" title="Cerrar ventana">
								<i class="ace-icon fa fa-times"></i>
								Cerrar
							</button>
							<button type="button" name="btn_excel2" id="btn_excel2" class="btn btn-sm btn-primary pull-right" data-toggle="tooltip" title="Cargar Excel">
								<i class="ace-icon fa fa-check"></i>
								Cargar
							</button>
						</div>
					</form>	
				</div>
			</div>
		</div>
		<!-- Modal -->

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
		<script src="../../dist/js/fileinput.js" type="text/javascript"></script>
				
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
		<script src="nomina.js"></script>
		<script src="../../dist/js/validCampoFranz.js" ></script>
		<script src="../../dist/js/jquery.gritter.min.js"></script>
		<script src="../../dist/js/ventana_reporte.js" type="text/javascript"></script>
	</body>
</html> 