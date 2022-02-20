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
document.title = "Crear materia";
</script>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Crear materia prima</h4>
        <p class="card-text">Coloca los datos adecuadamente</p>
    </div>
    <div class="card-footer text-muted">
        <form action="" method="post">

            <div class="mb-3">
                <label for="" class="form-label">Nombre:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control"
                    name="NombreMat" id="NombreMat" aria-describedby="helpId" placeholder="Nombre">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Nombre de la sucursal:</label>
                <input type="text" required="" class="form-control" name="NombreSuc" id="NombreSuc"
                    aria-describedby="helpId" placeholder="sucursal">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Medidas:</label>
                <input type="text" required="" class="form-control" name="MedidasMat" id="MedidasMat"
                    aria-describedby="helpId" placeholder="Ejem.(Largo*Ancho*Alto)">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Tipo de madera:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control"
                    name="TipoMadera" id="TipoMadera" aria-describedby="helpId" placeholder="Tipo">
            </div>


            <div class="mb-3">
                <label for="" class="form-label">Cantidad:</label>
                <input type="Number" required="" onkeypress="return valideKey(event);" class="form-control"
                    name="CantidadMat" id="CantidadMat" aria-describedby="helpId" placeholder="Cantidad">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Precio:</label>
                <input type="number" required="" min="0" step="0.05" class="form-control" name="PrecioMat"
                    id="PrecioMat" aria-describedby="helpId" placeholder="00.00">
            </div>

            <input name="" id="" class="btn btn-success" type="submit" value="Crear">
            <a href="?controlador=materia&accion=inicio" class="btn btn-danger">Regresar</a>
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