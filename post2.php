<?php
require_once("lib/Twocheckout.php");
include_once("config.inc");

Twocheckout::privateKey('D1990073-CFEB-4B1C-BCD9-3C7A653748B3');
Twocheckout::sellerId('901344939');
Twocheckout::sandbox(true);
Twocheckout::verifySSL(false);

$token = $_POST['token'];
$correo = $_POST['correo'];
$costo = $_POST['costo'];
$curso = $_POST['curso'];
try {
    $charge = Twocheckout_Charge::auth(array(
        "merchantOrderId" => "123",
        "token" => $token,
        "currency" => 'USD',
        "total" => $costo,
        "billingAddr" => array(
            "name" => 'Testing Tester',
            "addrLine1" => '123 Test St',
            "city" => 'Columbus',
            "state" => 'OH',
            "zipCode" => '43123',
            "country" => 'USA',
            "email" => 'testingtester@2co.com',
            "phoneNumber" => '555-555-5555'
        ),
        "shippingAddr" => array(
            "name" => 'Testing Tester',
            "addrLine1" => '123 Test St',
            "city" => 'Columbus',
            "state" => 'OH',
            "zipCode" => '43123',
            "country" => 'USA',
            "email" => 'testingtester@2co.com',
            "phoneNumber" => '555-555-5555'
        )
    ), 'array');

    if ($charge['response']['responseCode'] == 'APPROVED') {
        $orderNumber = $charge['response']['orderNumber'];
        $transactionId = $charge['response']['transactionId'];


            $query2 = "INSERT INTO compras(fechaCompra, correoUsuario, idCurso, numTrans, numOrden) VALUES (CURDATE(),'".$correo."','".$curso."', '".$transactionId."', '".$orderNumber."')";
            mysqli_query($conex, $query2);

            echo "Thanks for your Order!";
    }else{
        echo "Not today";
    }
} catch (Twocheckout_Error $e) {
    $e->getMessage();

}

// $mail = "Una consulta ha sido enviada desde la página <strong>Smart Home</strong> del sitio web de YOOGOOO: <br><strong>Nombre:</strong> ".$nombre." <br><strong>Correo:</strong> ".$correo." <br><strong>Número de teléfono:</strong> ".$tel." <br><strong>País:</strong> ".$pais."<br><strong>Interesado en:</strong> ".$kit."<br><strong>Mensaje:</strong> ".$msj;
//         //Titulo
//         $titulo = "Consulta desde la página principal";
//         //cabecera
//         $headers = "MIME-Version: 1.0\r\n"; 
//         $headers .= "Content-type: text/html; charset=UTF-8\r\n"; 
//         //dirección del remitente 
//         $headers .= "From: YOOGOOO Web Site  < info@yoogooo.com >\r\n";
//         //Enviamos el mensaje a tu_dirección_email 
//         $bool = mail("web-sh@yoogooo.com",$titulo,$mail,$headers);

