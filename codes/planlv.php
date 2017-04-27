<div class="container">

    <script type="text/javascript">
        $(document).ready(function(){
            $("#pass2").focusout(function() {
                var pass = $("#pass").val();
                var pass2 = $("#pass2").val();

                if (pass != pass2) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.notify('ATENCIÓN: Las contraseñas no coinciden, inténtalo nuevamente.', 'error', 5, function(){});
                    $("#pass2").val("");
                }
            });


            $("#correo").focusout(function(){
                $correo = $("#correo").val();
                
            });
        });
    </script>
    <input type="hidden" id="curso" value="LV01">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Has elegido el curso de <b>Laravel</b></h2>
        </div>
    </div>

    <div class="row">
        <h2>Información de la Cuenta</b></h2>
        <p>Llena el formulario para activar tu cuenta, así podrás acceder al curso que elegiste</p>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form id="myCCForm" method="post">
                <input type="hidden" id="precio" value="19.99">
                <input name="token" id="token" type="hidden" value="" />
                <div class="row">
                    <div class="col-md-12">
                        <span>Correo Electrónico *</span>
                        <input type="email" name="correo" id="correo" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <span>Contraseña *</span>
                        <input type="password" name="pass" id="pass" class="form-control" required>
                    </div>

                    <div class="col-lg-6">
                        <span>Confirma tu contraseña *</span>
                        <input type="password" name="pass2" id="pass2" class="form-control" required >
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <span>Nombre Completo</span>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        Si ya tienes una cuenta, <a href="./login.php">Inicia Sesión</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h2>Método de pago</b></h2> 
                    </div>
                </div>                       

                <div class="row">
                    <div class="col-md-12">
                        <span for="card-number">Número de la Tarjeta</span>
                        <input type="text" class="form-control" id="ccNo" placeholder="">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <span for="expiry-month">Fecha de Expiración</span>
                        <div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <input id="expMonth" class="form-control" type="text" size="2" required placeholder="MM" />
                                </div>
                                <div class="col-xs-1">
                                <h4>/</h4>
                                </div>
                                <div class="col-xs-3">
                                    <input id="expYear" class="form-control" type="text" size="4" required placeholder="YY" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <span for="cvv">Card CVV</span>
                        <div>
                            <input type="text" class="form-control" id="cvv" >
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"> <button type="submit" class="btn btn-success">Pagar</button></div>
                    <div class="col-md-4"></div>
                </div>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>