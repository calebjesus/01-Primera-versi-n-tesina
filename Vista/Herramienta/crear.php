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
document.title = "Crear herramienta";
</script>
<div class="card">

    <div class="card-body">
        <h4 class="card-title">Crear herramienta</h4>
        <p class="card-text">Coloca los datos adecuadamente</p>
    </div>
    <div class="card-footer text-muted">
        <form action="" method="post">

            <div class="mb-3">
                <label for="" class="form-label">Nombre:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control"
                    name="NombreHerra" id="NombreHerra" aria-describedby="helpId" placeholder="Ejem.(Martillo)">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Cantidad:</label>
                <input type="text" required="" onkeypress="return valideKey(event);" class="form-control"
                    name="Cantidad" id="Cantidad" aria-describedby="helpId" placeholder="Ejem.(10)">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Precio:</label>
                <input type="number" required="" min="0" step="0.05" class="form-control" name="PrecioHerra"
                    id="PrecioHerra" aria-describedby="helpId" placeholder="000.00">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Especificaciones:</label>
                <input type="text" required="" class="form-control" name="Especificaciones" id="Especificaciones"
                    aria-describedby="helpId" placeholder="Especificaciones">
            </div>

            <input name="" id="" class="btn btn-success" type="submit" value="Crear">
            <a href="?controlador=herramienta&accion=inicio" class="btn btn-danger">Regresar</a>
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