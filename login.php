<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="img/isotipo.png" type="image/png" sizes="96x96">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../favicon.ico"> -->
    <title>TICCS - Inicio de Sesión</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->
    <link href="css/signin.css" rel="stylesheet">
   <!--  <script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="alertify/alertify.js"></script>
    <script type="text/javascript" src="alertify/alertify.min.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
    <link rel="stylesheet" href="alertify/css/alertify.css" />
    <link rel="stylesheet" href="alertify/css/alertify.min.css" />
    <link rel="stylesheet" href="alertify/css/themes/default.css">
    
  </head>

  <body>

    <div class="container">

      <form class="form-signin">
        <img src="img/logogrande.png" style="height: 150px; width: 300px;">
        <h2 class="form-signin-heading" style="text-align: center;">Inicio de sesión</h2>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="txtId" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" id="txtPass" class="form-control" placeholder="Contraseña" required>
        <button class="btn btn-lg btn-primary btn-block" type="button" id="inicio" name="inicio">Iniciar Sesión</button>   
      </form>

    </div> 
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
  </body>
</html>
