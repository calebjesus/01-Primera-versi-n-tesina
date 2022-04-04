<?php  
    session_start();
    if(!isset($_SESSION['rol'])){
        header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
    }else{
        if($_SESSION['rol']!= 1){
            header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
        }
    }
?>
<script>
document.title = "Crear administrador"; // Cambiamos el título
</script>

<div class="card">

    <div class="card-body">
        <h4 class="card-title">Crear administrador</h4>
        <p class="card-text">Coloca los datos adecuadamente</p>
    </div>
    <div class="card-footer text-muted">
        <form action="" method="post">

            <div class="mb-3">
                <label for="" class="form-label">Nombre:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control" name="Nombre"
                    id="Nombre" aria-describedby="helpId" placeholder="Nombre del administrador"
                    value="<?php if (isset($_POST['Nombre'])) echo $_POST['Nombre'];?>" >
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido paterno:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control"
                    name="APAdmin" id="APAdmin" aria-describedby="helpId" placeholder="Apellido paterno"
                    value="<?php if (isset($_POST['APAdmin'])) echo $_POST['APAdmin'];?>" >
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido materno:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control"
                    name="AMAdmin" id="AMAdmin" aria-describedby="helpId" placeholder="Apellido materno"
                    value="<?php if (isset($_POST['AMAdmin'])) echo $_POST['AMAdmin'];?>" >
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Correo electrónico:</label>
                <input type="email"
                pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"  
                required="" class="form-control" name="CorreoElectronico" id="CorreoElectronico"
                    aria-describedby="helpId" placeholder="Ejem. (usuario@gmail.com)"
                    value="<?php if (isset($_POST['CorreoElectronico'])) echo $_POST['CorreoElectronico'];?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Contraseña:</label>
                <input type="password" required="" class="form-control" name="Contrasena" id="Contrasena"
                    aria-describedby="helpId" placeholder="Contraseña"
                    value="<?php if (isset($_POST['Contrasena'])) echo $_POST['Contrasena'];?>" >
            </div>

            <input name="" id="" class="btn btn-success" type="submit" value="Crear">
            <a href="?controlador=administrador&accion=inicio" class="btn btn-danger">Regresar</a>
        </form>

    </div>
</div>






<script type="text/javascript">
function validarEmail(evt) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(valor)) {
        alert("La dirección de email " + valor + " es correcta.");
    } else {
        alert("La dirección de email es incorrecta.");
    }
}

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