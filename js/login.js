$(document).ready(function(){
	$('#inicio').click(function() {
		var $id = $('#txtId').val();
		var $pass = $('#txtPass').val();
		$.post('codes/verificaLogin.php', {id:$id, pass:$pass}, function(data) {
			if (data.estado == "wrongUser") {
				alertify.set('notifier','position', 'top-right');
				alertify.error('<stong>ATENCIÓN:</stong> El usuario ingresado no está registrado.');
			}else if (data.estado == "wrongPass"){
				alertify.set('notifier','position', 'top-right');
				alertify.error('<stong>ATENCIÓN:</stong> has digitado una contraseña incorrecta.');
			}else if(data.estado == "good"){
				window.location.href = "./dashboard.php";
				return false;
			}
		}, "json");
		return false;
	});

	 // $("#txtPass").keypress(function(e) {
  //      var $id = $('#uname').val();
		// var $pass = $('#psw').val();
		// $.post('codes/verificaLogin.php', {id:$id, pass:$pass}, function(data) {
		// 	if (data.estado == "wrongUser") {
		// 		alertify.set('notifier','position', 'top-right');
		// 		alertify.error('<stong>ATENCIÓN:</stong> El usuario ingresado no está registrado.');
		// 	}else if (data.estado == "wrongPass"){
		// 		alertify.set('notifier','position', 'top-right');
		// 		alertify.error('<stong>ATENCIÓN:</stong> has digitado una contraseña incorrecta.');
		// 	}else if(data.estado == "good"){
		// 		window.location.href = "./dashboard.php";
		// 		return false;
		// 	}
		// }, "json");
  //   });
});