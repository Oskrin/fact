<?php 
if(!isset($_SESSION))
    {
        session_start();        
    }
    if(!isset($_SESSION["fulldataadmin"])) {
        header('Location: ../login/');
    }
    include'../config/config.php';
    $classmenu = new menu();
 ?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title>Home - Admin</title>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="../../vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="../../vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="../../vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="../../vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../../vendor/datatables_plugins/integration/bootstrap/3/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="../../vendor/alert/sweetalert.css" />
    <link rel="stylesheet" href="../../vendor/xeditable/bootstrap3-editable/css/bootstrap-editable.css" />
    <link rel="stylesheet" href="../../vendor/date-time/bootstrap-timepicker.min.css" />

    <!-- App styles -->
    <link rel="stylesheet" href="../../fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="../../fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="../../styles/style.css">

</head>
<body>

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div>
    <div class="splash-title">
        <h1>Registro - Santa Ana de Cotacachi</h1>
        <p></p>
        <img src="../../images/loading-bars.svg" width="64" height="64" /> 
    </div>
</div>
<!-- Header -->
<div id="header">
    <div class="color-line">
    </div>
    <div id="logo" class="light-version">
        <span>
            GeO Portal
        </span>
    </div>
    <nav role="navigation">
        <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
        <div class="small-logo">
            <span class="text-primary">GeO Portal</span>
        </div>
        <form role="search" class="navbar-form-custom" method="post" action="#">
            <div class="form-group">
                <input type="text" placeholder="Buscarl" class="form-control" name="search">
            </div>
        </form>
        <div class="mobile-menu">
            <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse" data-target="#mobile-collapse">
                <i class="fa fa-chevron-down"></i>
            </button>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav no-borders">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="pe-7s-keypad"></i>
                    </a>

                    <div class="dropdown-menu hdropdown bigmenu animated flipInX">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <a href="../exit/">
                                        <i class="pe pe-7s-close text-info"></i>
                                        <h5>Salir</h5>
                                    </a>
                                </td>
                                <td>
                                    <a href="">
                                        <i class="pe pe-7s-comment text-info"></i>
                                        <h5>Información</h5>
                                    </a>
                                </td>
                                <td>
                                    <a href="../rutas_trazadas/">
                                        <i class="pe pe-7s-graph1 text-danger"></i>
                                        <h5>Reportes</h5>
                                    </a>
                                </td>
                                <td>
                                    <a href="">
                                        <i class="pe pe-7s-box1 text-success"></i>
                                        <h5>Archivos</h5>
                                    </a>
                                </td>
                                <td>
                                    <a href="../editar/">
                                        <i class="pe pe-7s-users text-success"></i>
                                        <h5>Perfil</h5>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </li>    
            </ul>
        </div>
    </nav>
</div>

<!-- Navigation -->
<?php $classmenu->lateral(); ?>

<!-- Main Wrapper -->
<div id="wrapper">
    <div class="content animate-panel">
        <div class="row">
            <div class="col-sm-12">
                <div class="hpanel">
                    <div class="panel-heading">
                        <div class="panel-tools">
                            <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                            <a class="closebox"><i class="fa fa-times"></i></a>
                        </div>
                        Formulario Cambiar Contraseña
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="form-data">
                            <h1>MODIFICAR USUARIO</h1>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Id:</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" id="id" name="id" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Nombres:</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" id="nombre" name="nombre" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Apellidos:</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" id="apellido" name="apellido" class="form-control" />
                                    </div>
                                </div>    
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Ciudad:</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" id="dato1" name="dato1" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Dirección:</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" id="dato2" name="dato2" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Teléfono:</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" id="dato3" name="dato3" class="form-control" />
                                    </div>
                                </div>     
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Contraseña Antigua:</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="password" id="txt_1" name="txt_1" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Nueva Contraseña:</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="password" id="txt_2" name="txt_2" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-4 no-padding-right">Confirme Contraseña:</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="password" id="txt_3" name="txt_3" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <button class="btn w-xs btn-info" type="button" name="btn_cambiar" id="btn_cambiar">Modificar</button>
                                    </div>
                                </div>   
                            </div>

                            <div class="col-sm-2"></div>                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer-->
    <footer class="footer">
        Company 2015-2016
    </footer>
</div>

<!-- Vendor scripts -->
<script src="../../vendor/jquery/dist/jquery.min.js"></script>
<script src="../../vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="../../vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../../vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../vendor/jquery-flot/jquery.flot.js"></script>
<script src="../../vendor/jquery-flot/jquery.flot.resize.js"></script>
<script src="../../vendor/jquery-flot/jquery.flot.pie.js"></script>
<script src="../../vendor/flot.curvedlines/curvedLines.js"></script>
<script src="../../vendor/jquery.flot.spline/index.js"></script>
<script src="../../vendor/metisMenu/dist/metisMenu.min.js"></script>
<script src="../../vendor/iCheck/icheck.min.js"></script>
<script src="../../vendor/peity/jquery.peity.min.js"></script>
<script src="../../vendor/sparkline/index.js"></script>
<script src="../../vendor/xeditable/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="../../vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="../../vendor/datatables_plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script src="../../vendor/date-time/bootstrap-datepicker.min.js"></script>
<script src="../../vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="../../vendor/alert/sweetalert.min.js"></script>

<!-- App scripts -->
<script src="../../scripts/homer.js"></script>
<script src="../../scripts/charts.js"></script>
<script src="app.js"></script>
</body>

<!-- Mirrored from webapplayers.com/homer_admin-v1.8/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 30 Oct 2015 09:57:42 GMT -->
</html>
<style type="text/css">
    #form-data input{
        text-transform: uppercase;
    }
</style>