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
document.title = "Editar producto";
</script>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Editar producto</h4>
        <p class="card-text">Coloca los datos adecuadamente</p>
    </div>
    <div class="card-footer text-muted">

        <form action="" method="post" enctype="multipart/form-data">



            <div class="mb-3">
                <label for="" class="form-label">Folio</label>
                <input readonly type="text" class="form-control" value="<?php echo $Prod->FolioProd?>" name="FolioProd"
                    id="FolioProd" aria-describedby="helpId" placeholder="Folio">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Nombre:</label>
                <input type="text" onkeypress="return soloLetras(event);" required=""
                    value="<?php echo $Prod->NombreProd?>" class="form-control" name="NombreProd" i d="NombreProd"
                    aria-describedby="helpId" placeholder="Nombre del Producto">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Medidas:</label>
                <input required="" type="text" value="<?php echo $Prod->Medidas?>" class="form-control" name="Medidas"
                    id="Medidas" aria-describedby="helpId" placeholder="Ejem.(Largo*Ancho*Alto)">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Categoría:</label>
                <input required="" onkeypress="return soloLetras(event);" type="text"
                    value="<?php echo $Prod->Categoria?>" class="form-control" name="Categoria" id="Categoria"
                    aria-describedby="helpId" placeholder="Categoría">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Precio:</label>
                <input required="" type="number" min="0" step="0.05" value="<?php echo $Prod->Precio?>"
                    class="form-control" name="Precio" id="Precio" aria-describedby="helpId" placeholder="$ 00.0">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Cantidad:</label>
                <input required="" type="number" value="<?php echo $Prod->Cantidad?>" class="form-control"
                    name="Cantidad" id="Cantidad" aria-describedby="helpId" placeholder="Cantidad">
            </div>


            <div class="mb-3">
                <label for="" class="form-label">Nombre de la imagen:</label>
                <input required="" readonly type="text" value="<?php echo $Prod->Nombreimg?>" class="form-control"
                    name="Nombreimg" id="Nombreimg" aria-describedby="helpId" placeholder="Nombre de la imagen">
            </div>

            <div class="form-group">
                <input type="file" id="imagen" name="imagen">
            </div>


            <input name="" id="" class="btn btn-success" type="submit" value="Editar">
            <a href="?controlador=producto&accion=inicio" class="btn btn-danger">Regresar</a>
        </form>

    </div>
</div>
<script>
// Accedemos al botón
var Nombreimg = document.getElementById('Nombreimg');

// evento para el input radio del "si"
document.getElementById('imagen').addEventListener('click', function(e) {
    Nombreimg.removeAttr("readonly");
});
Nombreimg.value = document.getElementById("Nombreimg").value;
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

<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>