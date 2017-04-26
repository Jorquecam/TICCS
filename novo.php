<?php
/**
 * Created by PhpStorm.
 * User: Emilio
 * Date: 26/04/2017
 * Time: 12:42
 */


$conex = mysqli_connect("localhost", "root", "4565", "ticcs");

var_dump($conex);
$query = "SELECT cp.idCurso, cu.nombreCurso FROM compras cp, cursos cu WHERE cp.idCurso = cu.idCurso AND cp.correoUsuario = '".$_GET["correo"]."'";
$exec = mysqli_query($conex, $query);
$row = mysqli_num_rows($exec);
echo "<hr>";
echo $row;
echo "<hr>";
echo "<hr>";
