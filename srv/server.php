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

        include "vars.php";

        ob_start();
        include "template/xml-file.php";
        $XML = ob_get_clean();
        $response = sending($XML, $gpg, $consecutivo, $fecha, $sucursal, $rawCed);
        $result = receiving($response, $gpg);
        storing($result, $conn) ? header("HTTP/1.1 400 Not OK") : header("HTTP/1.1 200 OK");
    }
} else {
    header("HTTP/1.1 400 Not OK");
    echo json_encode(array("info" => "No data"));
}

function sending($XML, &$gpg, $consecutivo, $fecha, $sucursal, $rawCed){
    $url = "http://192.168.0.254/www/fdgt-webservice/v1/";
    $gpg->addEncryptKey('dgt@mh.cool');
    $gpg->addSignKey('admin@ticcs.fake', 'admin');
    $signedXML = $gpg->encryptAndSign($XML);

    $to_send = array(
        "clave" => $consecutivo,
        "fecha" => $fecha,
        "sucursal" => intval($sucursal),
        "emisor" => array(
            "tipoIdentificacion" => 2,
            "numeroIdentificacion" => $rawCed
        ),
        "receptor" => array(
            "tipoIdentificacion" => 2,
            "numeroIdentificacion" => $rawCed
        ),
        "comprobanteXml" => $signedXML
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type:application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($to_send)
        )
    );
    $context  = stream_context_create($options);
    return file_get_contents($url, false, $context);
}

function receiving(&$response, &$gpg){
    $response = json_decode($response, TRUE);
    if (isset($response["indEstado"])){
        $plainResponse = $gpg->decryptAndVerify($response["respuestaXML"]);
        $response["respuestaXML"] = $plainResponse;
        return json_encode($response);
    } else {
        header("HTTP/1.1 400 Not OK");
        return json_encode(array("info" => "No response"));
    }
}

function storing($data, &$conn){
    $data = json_decode($data, TRUE);
    if (isset($data["respuestaXML"])){
        header("Content-Type:text/xml");
        exit($data["respuestaXML"]["data"]);
    } else {
        return false;
    }

}