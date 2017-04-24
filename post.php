<?php
require_once("lib/Twocheckout.php");
include_once("config.inc");

Twocheckout::privateKey('D1990073-CFEB-4B1C-BCD9-3C7A653748B3');
Twocheckout::sellerId('901344939');
Twocheckout::sandbox(true);
Twocheckout::verifySSL(false);

$token = $_POST['token'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$costo = $_POST['costo'];
$curso = $_POST['curso'];
$pass = $_POST['pass'];

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

        $query = "SELECT correoUsuario FROM usuarios WHERE correoUsuario = '".$correo."'";
        $exec = mysqli_query($conex, $query);
        $rows = mysqli_num_rows($exec);

        if($rows == 0 || $rows == null){
            $query = "INSERT INTO usuarios(correoUsuario, nombreUsuario, contraUsuario) VALUES ('".$correo."','".$nombre."','".password_hash($pass, PASSWORD_DEFAULT)."')";
            mysqli_query($conex, $query);

            $query2 = "INSERT INTO compras(fechaCompra, correoUsuario, idCurso, numTrans, numOrden) VALUES (CURDATE(),'".$correo."','".$curso."', '".$transactionId."', '".$orderNumber."')";
            mysqli_query($conex, $query2);

            session_start();
                $_SESSION['sesion'] = "SI";
                $_SESSION['correoUsuario'] = $correo;

            echo "Thanks for your Order!";
        }else{
            echo "User Exists";
        }


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

