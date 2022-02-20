<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="strength.js"></script>
<script type="text/javascript" src="js.js"></script>

<script src="forte.js"></script>



<script>
document.title = "Crear cliente";
</script>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Registrate</h4>
        <p class="card-text">Coloca los datos adecuadamente</p>
    </div>
    <div class="card-footer text-muted">
        <form action="" method="post"  >

            <div class="mb-3">
                <label for="" class="form-label">Nombre:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control"
                    name="NombreClien" id="NombreClien" aria-describedby="helpId" placeholder="Nombre del cliente">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido paterno:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control"
                    name="APClien" id="APClien" aria-describedby="helpId" placeholder="Apellido paterno">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido materno:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control"
                    name="AMClien" id="AMClien" aria-describedby="helpId" placeholder="Apellido materno">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Ingresa la fecha de nacimiento:</label>
                <input type="date" required="" class="form-control" name="FechaNacimiento" id="FechaNacimiento"
                    aria-describedby="helpId" placeholder="Fecha">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Teléfono:</label>
                <input type="text" onkeypress="return valideKey(event);" required="" minlength="10" maxlength="10"
                    class="form-control" name="Telefono" id="Telefono" aria-describedby="helpId" placeholder="Teléfono">
            </div>


            <div class="mb-3">
                <label for="" class="form-label">Dirección:</label>
                <input type="text" required="" class="form-control" name="Direccion" id="Direccion"
                    aria-describedby="helpId" placeholder="Dirección">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Correo electrónico Ejem.(usuario@gmail.com)</label>
                <input type="email" required="" class="form-control" name="CorreoElectronico" id="CorreoElectronico"
                    pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" aria-describedby="helpId" placeholder="Ejem. (usuario@gmail.com)">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Contraseña:</label>
                <div class="input-group">
                        <input type="password" autocomplete="off" required="" class="form-control" name="Contrasena"
                        type="password"  id="Contrasena" aria-describedby="helpId" placeholder="Contraseña">
                        <div class="input-group-append">
                        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                        </div>   
                </div>
                        <div>
                        <span  style="color: red;" id="passstrength"></span>
                        </div>
            </div>



            <input name="" id="" class="btn btn-success" type="submit" value="Crear">
            <a href="?controlador=Login&accion=inicio" class="btn btn-danger">Regresar</a>
        </form>

    </div>
</div>

<script type="text/javascript">
$('#Contrasena').keyup(function(e) {
     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     var enoughRegex = new RegExp("(?=.{6,}).*", "g");
     if (false == enoughRegex.test($(this).val())) {
             $('#passstrength').html('Más caracteres.');
     } else if (strongRegex.test($(this).val())) {
             $('#passstrength').className = 'ok';
             $('#passstrength').html('Fuerte!');
     } else if (mediumRegex.test($(this).val())) {
             $('#passstrength').className = 'alert';
             $('#passstrength').html('Media!');
     } else {
             $('#passstrength').className = 'error';
             $('#passstrength').html('Débil!');
     }
     return true;
});

</script>

<script type="text/javascript">
function mostrarPassword(){
		var cambio = document.getElementById("Contrasena");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
	
	$(document).ready(function () {
	//CheckBox mostrar contraseña
	$('#ShowPassword').click(function () {
		$('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});
});


</script>





<script type="text/javascript">
function valideKey(evt) {

    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;

    if (code == 8) { // backspace.
        return true;
    } else if (code >= 48 && code <= 57) { // is a number.
        return true;
    } else { // other keys.
        return false;
    }
}

function soloLetras(e) {
    var key = e.keyCode || e.which,
        tecla = String.fromCharCode(key).toLowerCase(),
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
        especiales = [8, 37, 39, 46],
        tecla_especial = false;

    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}
</script>

<input type="hidden" id="SesionRol" value="0">
<script src="Herramientas/JS/navBar.js"></script>