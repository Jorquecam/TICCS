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

            $idQuery = "SELECT COUNT(idCompra) FROM compras";
            $idExec = mysqli_query($conex, $idQuery);
            $idResult = mysqli_fetch_assoc($idExec);
            $idCompra = $idResult["COUNT(idCompra)"] + 1;
            $cantCeros = 10 - strlen((string)$idCompra);

            for ($i = 0; $i<= $cantCeros; $i++){
                $idCompra = $idCompra."0";
            }

            $query2 = "INSERT INTO compras(idCompra, fechaCompra, correoUsuario, idCurso, numTrans, numOrden) VALUES ('".$idCompra."',CURDATE(),'".$correo."','".$curso."', '".$transactionId."', '".$orderNumber."')";
            mysqli_query($conex, $query2);

            $query3 = "SELECT nombreCurso FROM cursos WHERE idCurso ='".$curso."'";
            $exec3 = mysqli_query($conex, $query3);
            $result3 = mysqli_fetch_assoc($exec3);
            $nombreCurso = $result3["nombreCurso"];

            session_start();
                $_SESSION['sesion'] = "SI";
                $_SESSION['correoUsuario'] = $correo;

            echo "Thanks for your Order!";

            //Ejemplo data
            $data = array("factura"     =>  "$idCompra",
                            "codCurso"  =>  "$curso",
                            "nomCurso"  =>  "$nombreCurso",
                            "monto"     =>  "$costo");

            //Function
            function redirect($data){
                $url = "192.168.0.254";
                
                $options = array(
                    'http' => array(
                        'header'  => "Content-type:application/json\r\n",
                        'method'  => 'POST',
                        'content' => json_encode($data)
                    )
                );
                $context  = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                if ($result === FALSE) { /* Handle error */ }
            }
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

