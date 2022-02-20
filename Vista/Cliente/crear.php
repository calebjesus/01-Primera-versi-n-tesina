<?php  
    session_start();
    if(!isset($_SESSION['rol'])){
        header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
    }else{
        if($_SESSION['rol']!= 1){
            header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
        }
    }

    var_dump($_SESSION['id']);
?>
<script>
document.title = "Crear cliente";
</script>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Crear cliente</h4>
        <p class="card-text">Coloca los datos adecuadamente</p>
    </div>
    <div class="card-footer text-muted">
        <form action="" method="post">

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
                <label for="" class="form-label">Correo electrónico:</label>
                <input type="text" required="" class="form-control" name="CorreoElectronico" id="CorreoElectronico"
                    aria-describedby="helpId" placeholder="Ejem. (usuario@gmail.com)">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Contraseña:</label>
                <input type="password" autocomplete="off" required="" class="form-control" name="Contrasena"
                    id="Contrasena" aria-describedby="helpId" placeholder="Contraseña">
            </div>


            <input name="" id="" class="btn btn-success" type="submit" value="Crear">
            <a href="?controlador=Cliente&accion=inicio" class="btn btn-danger">Regresar</a>
        </form>

    </div>
</div>






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

<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>