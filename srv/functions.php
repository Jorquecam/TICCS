<?php
/**
 * Created by PhpStorm.
 * User: Emilio
 * Date: 26/04/2017
 * Time: 16:19
 */

function sending($data, $XML, &$gpg, $consecutivo, $fecha, $sucursal, $rawCed){
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
    if (isset($data["test"])){
        switch ($data["test"]){
            case "plain/XML":
                header("Content-Type:application/xml");
                exit($XML);
            case "plain/GPG":
                header("Content-Type:text/plain");
                exit($signedXML);
            case "full/Request":
                exit(json_encode($to_send));
            default:
                return file_get_contents($url, false, $context);
        }
    } else {
        return file_get_contents($url, false, $context);
    }
}

function receiving($data, &$response, &$gpg, &$conn, $ordenPK){
    $response = json_decode($response, TRUE);
    if (isset($response["indEstado"])){
        $plainResponse = $gpg->decryptAndVerify($response["respuestaXML"]);
        $RAW = $response["respuestaXML"];
        $response["respuestaXML"] = $plainResponse;
        if (isset($data["test"])){
            switch ($data["test"]){
                case "plain/GPG-R":
                    header("Content-Type:text/plain");
                    exit($RAW);
                case "plain/XML-R":
                    header("Content-Type:application/xml");
                    exit($plainResponse["data"]);
                case "full/Response":
                    exit(json_encode($response));
            }
        }
        return json_encode($response);
    } else {
    $conn->execSQL("UPDATE compras
                SET compras.ack = ?
                WHERE compras.idCompra = ?;", array(json_encode($response), $ordenPK));
    deliver_response(400, "Error", array("DGT Says" => $response));
        exit;
    }
}

function storing($data, &$conn, $ordenPK){
    $data = json_decode($data, TRUE);
    if (isset($data["respuestaXML"])){
        $XML = new DOMDocument; //Creat DOM object
        $XML->loadXML($data["respuestaXML"]["data"]); //Load document
        $hash = $XML->getElementsByTagName("ID")->item(0);
        $hash = simplexml_import_dom($hash); //Create PHP object from selected ones

        return $conn->execSQL("UPDATE compras
                        SET compras.ack = ?
                        WHERE compras.idCompra = ?;", array($hash, $ordenPK));
    } else {
        $conn->execSQL("UPDATE compras
                        SET compras.ack = ?
                        WHERE compras.idCompra = ?;", array("There is no ack. Storing failed", $ordenPK));
        return false;
    }

}

function deliver_response($status, $status_message,$data = null)
{
    header("Content-Type:application/json");
    header("HTTP/1.1 200 OK");
    $response["status"] = $status;
    $response["status_message"] = $status_message;
    $response["data"] = $data;
    $json_response = json_encode($response);
    echo $json_response;
}