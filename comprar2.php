<?php 
	$plan = $_GET['plan'];
	session_start();
	$correo = $_SESSION['correoUsuario'];
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="img/isotipo.png" type="image/png" sizes="96x96">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>TICCS</title>
		<!-- Bootstrap Core CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
		<!-- Custom Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Mrs+Sheppards%7CDosis:300,400,700%7COpen+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800;' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
		<!-- Plugin CSS -->
		<link rel="stylesheet" href="css/animate.min.css" type="text/css">
		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/chekout2.js"></script>

	    <script src="alertify/alertify.js"></script>
	    <script src="alertify/alertify.min.js"></script>
        <link rel="stylesheet" href="alertify/css/alertify.css" />
	    <link rel="stylesheet" href="alertify/css/alertify.min.css" />
	    <link rel="stylesheet" href="alertify/css/themes/default.css">
	</head>
	<body id="page-top">
			<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand page-scroll" href="#page-top"><img src="img/logo.png" alt="logolayana"></a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li>
							<a class="page-scroll" href="dashboard.php">Inicio</a>
							</li>
						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container -->
			</nav>
		
		<section id="plan">
		<div><input type="hidden" id="correo" value="<?php echo $correo ?>"></div>
		
			<?php
				if(isset($plan) && $plan == "JS01"){
					include_once("codes/planjs2.php");
				}elseif(isset($plan) && $plan == "HC01"){
					include_once("codes/planhc2.php");
				}elseif(isset($plan) && $plan == "MS01"){
					include_once("codes/planms2.php");
				}elseif(isset($plan) && $plan == "PP01"){
					include_once("codes/planpp2.php");
				}elseif(isset($plan) && $plan == "LV01"){
					include_once("codes/planlv2.php");
				}else{
					include_once("codes/planpy2.php");
				}

			?>
			<div id="gifspace" class="col-md-12"></div>
		</section>


		<!-- Section Footer
		================================================== -->
		<section class="bg-dark">
		<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1 class="bottombrand wow flipInX">TICCS</h1>
				<p>
					&copy; 2016 Bootstrap HTML Template by WowThemes.net
				</p>
			</div>
		</div>
		</div>
		</section>

		<!-- jQuery -->
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/parallax.js"></script>
		<script src="js/contact.js"></script>
		<script src="js/countto.js"></script>
		<script src="js/jquery.easing.min.js"></script>
		<script src="js/wow.min.js"></script>
		<script src="js/common.js"></script>
	</body>
</html>