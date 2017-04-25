<?php
    include_once("config.inc");
    session_start();
    if(isset($_GET["correo"]) && $_GET["correo"] != ""){
        $_SESSION['sesion'] = "SI";
        $_SESSION['correoUsuario'] = $_GET["correo"];

        $query = "SELECT cp.idCurso, cu.nombreCurso FROM compras cp, cursos cu WHERE cp.idCurso = cu.idCurso AND cp.correoUsuario = '".$_GET["correo"]."'";
        $exec = mysqli_query($conex, $query);
        $row = mysqli_num_rows($exec);

        
    }else if (isset($_SESSION['sesion']) && $_SESSION['sesion'] == "SI") {
        $correo = $_SESSION['correoUsuario'];
        $query = "SELECT cp.idCurso, cu.nombreCurso FROM compras cp, cursos cu WHERE cp.idCurso = cu.idCurso AND cp.correoUsuario = '".$_SESSION['correoUsuario']."'";
        $exec = mysqli_query($conex, $query);
        $row = mysqli_num_rows($exec);
    }else{
        header("Location: index.html");
    }
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="img/favico.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!--    <meta http-equiv="refresh" content="600;url=codes/salir.php">-->

    <title>TICCS - Panel de Cursos</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="css/light-bootstrap-dashboard.css" rel="stylesheet"/>



    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script language="JavaScript" src="js/jquery-3.1.1.min.js"></script>
    <script language="JavaScript" src="alertify/alertify.js"></script>
    <script language="JavaScript" src="alertify/alertify.min.js"></script>
    <link rel="stylesheet" href="alertify/css/alertify.css">
    <link rel="stylesheet" href="alertify/css/alertify.min.css">
    <link rel="stylesheet" href="alertify/css/themes/default.css">
    <script language="JavaScript" src="js/index.js"></script>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="gray" data-image="assets/img/sidebar-4.jpg">

        <div class="sidebar-wrapper">
            <div class="logo">
                <img src="img/logogrande.png" style="width: 200px; margin-top: 10px">
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="fa fa-bell-o"></i>
                        <p>Cursos disponibles</p>
                    </a>
                </li>
                <li >
                    <a href="comprar.php?correo=<?php echo $correo ?>.php">
                        <i class="fa fa-bell-o"></i>
                        <p>Comprar cursos</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="codes/salir.php"><i class="fa fa-power-off" aria-hidden="true" style="color: #82BC00"></i>  Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container">
                <div class="col-md-11">
                    <div class="card">
                        <div class="header"></h4>
                            
                            <p class="category"></p>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <?php 
                                if ($row == 0) {
                                    echo '<h2>No se han adquirido cursos</h2>';
                                }else{
                                    echo '<h2>Cursos disponibles</h2>';
                                    while ($result = mysqli_fetch_assoc($exec)) {
                                        echo "<div class='row'><h2>".$result['nombreCurso']."</h2></div>";
                                    }
                                }
                             ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>


</html>
