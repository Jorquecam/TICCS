<?php
$verDoc = 1;
$tipoDoc = 1;
$condVenta = "01";
$orden = $data["factura"];
$ordenPK = $data["facturaPK"];
$rawCed = "012304560789";
$sucursal = "001";
$POS = "00001";
$situacionComprobante = 1;
$codSeguridad = "99999999";
$consecutivo = "506".date("d").date("m").date("y").$rawCed.$sucursal.$POS."0".$tipoDoc.$orden.$situacionComprobante.$codSeguridad;
$miniConsecutivo = $sucursal.$POS."0".$tipoDoc.$orden.$situacionComprobante;
$fecha = date("o-m-d");
$fecha .= "T";
$fecha .= date("G:i:s");
$fecha .= "-06:00";

$cedula = "123456789";
$nombre = "TICCS";
$direccion = "San Ramon, Alajuela, Calle 1, Avenida 0, Campus Corporativo F. Ferrer, M2-F6";
$areaTel = "506";
$tel = "22445566";
$fax = "22445567";
$email = "";

$linea = "1";
$tipoCod = "1";
$codCurso = $data["codCurso"];
$nomCurso = $data["nomCurso"];
$cantidad = "1";
$precio = $data["monto"];
$impVentas = "0.13";

$moneda = "CRC";
$tipoCambio = 1;