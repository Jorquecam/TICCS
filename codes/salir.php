<?php
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");

	session_start();
		unset($_SESSION['sesion']);
		unset($_SESSION['correoUsuario']);
	session_destroy();
		
	header("Location: ../index.html");
    exit();
?>