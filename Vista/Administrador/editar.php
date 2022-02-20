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
<div class="card">

    <div class="card-body">
        <h4 class="card-title">Actualizar administrador</h4>
        <p class="card-text">Coloca los datos adecuadamente</p>
    </div>
    <div class="card-footer text-muted">
        <form action="" method="post">


            <div class="mb-3">
                <label for="" class="form-label">Folio</label>
                <input readonly type="text" class="form-control" value="<?php echo $admin->FolioAdmin?>"
                    name="FolioAdmin" id="FolioAdmin" aria-describedby="helpId" placeholder="Folio">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Nombre:</label>
                <input type="text" onkeypress="return soloLetras(event);" required=""
                    value="<?php echo $admin->Nombre?>" class="form-control" name="Nombre" i d="Nombre"
                    aria-describedby="helpId" placeholder="Nombre del administrador">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido paterno:</label>
                <input required="" onkeypress="return soloLetras(event);" type="text"
                    value="<?php echo $admin->APAdmin?>" class="form-control" name="APAdmin" id="APAdmin"
                    aria-describedby="helpId" placeholder="Apellido paterno">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido materno:</label>
                <input required="" type="text" value="<?php echo $admin->AMAdmin?>"
                    onkeypress="return soloLetras(event);" class="form-control" name="AMAdmin" id="AMAdmin"
                    aria-describedby="helpId" placeholder="Apellido Materno">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Correo electronico:</label>
                <input required="" type="text" value="<?php echo $admin->CorreoElectronico?>" class="form-control"
                    name="CorreoElectronico" id="CorreoElectronico" aria-describedby="helpId"
                    placeholder="CorreoElectronico">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Contraseña:</label>
                <input required="" type="text" value="<?php echo $admin->Contrasena?>" class="form-control"
                    name="Contrasena" id="Contrasena" aria-describedby="helpId" placeholder="CorreoElectronico">
            </div>

            <input name="" id="" class="btn btn-success" type="submit" value="Actualizar">
            <a href="?controlador=administrador&accion=inicio" class="btn btn-danger">Regresar</a>
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