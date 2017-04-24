<?php  

	include_once('../config.inc');

	$id = $_POST['id'];
	$pass = $_POST['pass'];

	$query = "SELECT * FROM usuarios WHERE correoUsuario = '".$id."'";
	$exec = mysqli_query($conex, $query);
	$result = mysqli_fetch_assoc($exec);
	$rows = mysqli_num_rows($exec);

	if ($rows == 0) {
		echo json_encode(array('estado' => "wrongUser"));
	}else{
		if (password_verify($pass, $result['contraUsuario'])) {
				echo json_encode(array('estado' => "good"));
				session_start();
				$_SESSION['sesion'] = "SI";
				$_SESSION['correoUsuario'] = $result['correoUsuario'];
		}else{
			echo json_encode(array('estado' => "wrongPass"));
		}
	}
?>