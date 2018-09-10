<!DOCTYPE html>
<html lang="es">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        
        <title>Activacion</title>
        <link rel="shortcut icon" href="dist/images/logo.fw.png">

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="dist/css/font-awesome.min.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="dist/css/fontdc.css" />
        <link rel="stylesheet" href="dist/css/animate.min.css" />
        <link rel="stylesheet" href="dist/css/jquery.gritter.min.css" />
        <link rel="stylesheet" href="dist/css/sweetalert.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="dist/css/ace.min.css" />
        <link rel="stylesheet" href="dist/css/ace-rtl.min.css" />
    </head>

    <body class="blank">
        <div class="main-container">
            <!-- Simple splash screen-->
            <div class="splash" align="center"> <div class="color-line"></div>
                <div class="splash-title">
                    <h1>NELTEX</h1>
                    <p></p>
                    <img src="dashboard/images/loading-bars.svg" width="64" height="64" /> 
                </div>
            </div>

            <div class="color-line"></div>   
        </div>

        <script type="text/javascript">
            window.jQuery || document.write("<script src='dist/js/jquery.min.js'>"+"<"+"/script>");
        </script>

        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='dist/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>

        <script src="dist/js/jquery.validate.min.js"></script>
        <script src="dist/js/additional-methods.min.js"></script>
        <!-- <script type="text/javascript" src="index/index.js"></script> -->
        <script src="dist/js/jquery.gritter.min.js"></script>
        <script src="dist/js/sweetalert.min.js"></script>


        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            $(function(){
                var fullname = window.location.search;
                var getString = fullname.split('?id=')[1]; 
                if (fullname!='') {
                    $.ajax({
                        url: 'app.php',
                        type: 'post',
                        dataType:'json',
                        data: {proceso_activacion:'',id:getString},
                        success: function (data) {
                            if (data == 0) {
                                swal({
                                    title: "Buen Trabajo!",
                                    text: "Su cuenta se ha activado con Éxito.!",
                                    type: "success",
                                },function (){
                                    window.location.href = "../";
                                });
                            } else {
                                swal({
                                    title: "Lo sentimos!",
                                    text: "No se ha podido procesar su petición intente mas tarde.!",
                                    type: "warning",
                                },function () {
                                    window.location.href = "../";
                                });
                            }
                        }
                    });
                }else{
                     swal({
                        title: "Lo sentimos!",
                        text: "Proceso no realizado.!",
                        type: "info",
                    });
                }
                
            });
        </script>
    </body>
</html>
