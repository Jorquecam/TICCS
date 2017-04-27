<?php
include_once("../config.inc");
$curso = $_POST['curso'];
$correo = $_POST['correo'];

$query = "SELECT idCompra FROM compras WHERE idCurso = '".$curso."' AND correoUsuario = '".$correo."'";
$exec = mysqli_query($conex, $query);
$result = mysqli_num_rows($exec);

if ($result >= 1){
    echo "Ya adquirido";
}else{
    echo "No adquirido";
}