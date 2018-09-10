
<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Page title -->
    <title>Login - Santa Ana de Cotacachi</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->

    <!-- Vendor styles -->
    <link rel="stylesheet" href="../../vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="../../vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="../../vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="../../vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../../vendor/alert/sweetalert.css" />

    <!-- App styles -->
    <link rel="stylesheet" href="../../fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="../../fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="../../styles/style.css">

</head>
<body style="position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -100;
    transform: translateX(-50%) translateY(-50%);
 background: url('../../../img/14349019_253681485026426_719024741_n.jpg') no-repeat;
  background-size: cover;
  transition: 1s opacity;">

<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div>
    <div class="splash-title">
        <h1>Login - Santa Ana de Cotacachi</h1>
        <p></p>
        <img src="../../images/loading-bars.svg" width="64" height="64" /> 
    </div>
</div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="color-line"></div>

<div class="login-container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3>Login - Santa Ana de Cotacachi</h3>
                <small>Ingrese Usuario y Contraseña!</small>
            </div>
            <div class="hpanel">
                <div class="panel-body">
                    <form id="loginForm">
                        <div class="form-group">
                            <label class="control-label" for="username">Nombre de Usuario</label>
                            <input type="text" placeholder="nombre de usuario" title="Por favor, Ingrese su usuario" required="" name="txt_username" id="txt_username" class="form-control">
                            <span class="help-block small">Tu nombre de usuario única de aplicación</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Password</label>
                            <input type="password" title="porfavor ingrese su password / contraseña" placeholder="******" required=""name="txt_password" id="txt_password" class="form-control">
                            <span class="help-block small">Su contraseña segura</span>
                        </div>
                        <button class="btn btn-success btn-block" name="btn_entrar" id="btn_entrar">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <strong>login</strong> - Portal Web Movil <br/> 2015 Copyright Catacachi
        </div>
    </div>
</div>


<!-- Vendor scripts -->
<script src="../../vendor/jquery/dist/jquery.min.js"></script>
<script src="../../vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="../../vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script src="../../vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../vendor/metisMenu/dist/metisMenu.min.js"></script>
<script src="../../vendor/iCheck/icheck.min.js"></script>
<script src="../../vendor/sparkline/index.js"></script>
<script src="../../vendor/alert/sweetalert.min.js"></script>

<!-- App scripts -->
<script src="../../scripts/homer.js"></script>
<script src="app.js"></script>

</body>
</html>