// Llamado cuando el token es creado satisfactoriamente
var successCallback = function(data) {
    var myForm = document.getElementById('myCCForm');

    // Establece el valor del token con el valor que tiene el input hidden de token
    myForm.token.value = data.response.token.token;

    // IMPORTANT: Here we call `submit()` on the form element directly instead of using jQuery to prevent and infinite token request loop.
    //myForm.submit();
    post(data.response.token.token);

};


function post(token) {
    var $nombre = $("#name").val();
    var $correo = $("#correo").val();
    var $pass = $("#pass").val();
    var $costo = $("#precio").val();
    var $curso = $("#curso").val();
$("#gifspace").append('<div class="col-md-6"></div><div id="gif" class="col-md-3"><img  src="img/ajax-loader.gif"></div><div class="col-md-3"></div>');
    $.post("post2.php", {token: token, correo: $correo, costo: $costo, curso: $curso}, function (data) {
        $("#gif").remove();
        alertify.alert(data).setHeader('<em>¡Compra Exitosa!</em> ');
        if (data == "Thanks for your Order!"){
            alertify.alert("Tu compra ha sido realizada con éxito", function(){
                window.location.href="dashboard.php?correo="+$correo;
            }).setHeader('<em>¡Compra Exitosa!</em> ');
        }else if(data == "Not today"){
            alertify.alert("Lo sentimos, algo ha salido mal con el pago").setHeader('<em>¡ATENCIÓN!</em> ');
        }else if(data == "User Exists"){
            alertify.alert("Este usuario ya existe, inicie sesión y haga su compra", function(){
                window.location.href="login.php";
            }).setHeader('<em>¡Usuario Existente!</em> ');
        }
    });
    
}


// Called when token creation fails.
var errorCallback = function(data) {
    // Retry the token request if ajax call fails
    if (data.errorCode === 200) {
        // This error code indicates that the ajax call failed. We recommend that you retry the token request.
    } else{
        alert(data.errorMsg);
    }
};

var tokenRequest = function() {
    // Setup token request arguments
    var args = {
        sellerId: "901344939",
        publishableKey: "F35C6C57-AD2B-430E-9C49-8AFAF94D5EC6",
        ccNo: $("#ccNo").val(),
        cvv: $("#cvv").val(),
        expMonth: $("#expMonth").val(),
        expYear: $("#expYear").val()
    };

    // Make the token request
    TCO.requestToken(successCallback, errorCallback, args);
};

$(function() {
    // Pull in the public encryption key for our environment
    TCO.loadPubKey('sandbox');

    $("#myCCForm").submit(function(e) {
        // Call our token request function
        tokenRequest();

        // Prevent form from submitting
        return false;
    });
});
