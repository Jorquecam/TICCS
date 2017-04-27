<?php
date_default_timezone_set('America/Costa_Rica');
header("Content-Type:application/json");
header("Accept:application/json");

require_once 'Crypt/GPG.php';
include "PDO/pdo_mysqli.inc.php";

$gpg = new Crypt_GPG(array("homedir" => "/home/emilio/.gnupg", "debug" => false));
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST"){
    $conn = new mysqli_conn();
    $data = file_get_contents("php://input");
    $data = json_decode($data, TRUE);
    if (isset($data["factura"])
        && isset($data["codCurso"])
        && isset($data["nomCurso"])
        && isset($data["monto"])
        && $conn->init()){

        include "functions.php";
        include "vars.php";

        ob_start();
        include "template/xml-file.php";
        $XML = ob_get_clean();
        $response = sending($data,$XML, $gpg, $consecutivo, $fecha, $sucursal, $rawCed);
        $result = receiving($data, $response, $gpg, $conn, $ordenPK);
        storing($result, $conn, $ordenPK) ?
            deliver_response(400, "Error", array("info" => "ack stored"))
            : deliver_response(400, "Error", array("info" => "ack not stored"));
    }
} else {
    deliver_response(403, "Not Permitted", array("info" => "Shall not pass"));
}