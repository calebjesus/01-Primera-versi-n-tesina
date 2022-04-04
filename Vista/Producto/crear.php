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
document.title = "Crear producto"; // Cambiamos el título
</script>

<div class="card">

    <div class="card-body">

        <h4 class="card-title">Crear producto</h4>
        <p class="card-text">Coloca los datos adecuadamente</p>
    </div>
    <div class="card-footer text-muted">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="" class="form-label">Nombre:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control"
                    name="NombreProd" id="NombreProd" aria-describedby="helpId" placeholder="Nombre del Producto"
                    value="<?php if (isset($_POST['NombreProd'])) echo $_POST['NombreProd'];?>" >
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Medidas:</label>
                <input type="text" required="" class="form-control" name="Medidas" id="Medidas"
                    aria-describedby="helpId" placeholder="Ejem.(Largo*Ancho*Alto)"
                    value="<?php if (isset($_POST['Medidas'])) echo $_POST['Medidas'];?>" >
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Categoría:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" onkeypress="return check(event);"
                    class="form-control" name="Categoria" id="Categoria" aria-describedby="helpId"
                    placeholder="Categoría"
                    value="<?php if (isset($_POST['Categoria'])) echo $_POST['Categoria'];?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Precio:</label>
                <input type="number" required="" min="0" step="0.05" required="" class="form-control" name="Precio"
                    id="Precio" aria-describedby="helpId" placeholder="00.00"
                    value="<?php if (isset($_POST['Precio'])) echo $_POST['Precio'];?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Cantidad:</label>
                <input type="text" onkeypress="return valideKey(event);" required="" class="form-control"
                    name="Cantidad" id="Cantidad" aria-describedby="helpId" placeholder="Cantidad"
                    value="<?php if (isset($_POST['Cantidad'])) echo $_POST['Cantidad'];?>" >
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Nombre de la imagen:</label>
                <input type="text" required="" class="form-control" name="Nombreimg" id="Nombreimg"
                    aria-describedby="helpId" placeholder="Nombre"
                    value="<?php if (isset($_POST['Nombreimg'])) echo $_POST['Nombreimg'];?>">
            </div>

            <div class="form-group">
                <input type="file" name="imagen" required="">
            </div>

            <input class="btn btn-success" type="submit" value="Crear">
            <a href="?controlador=Producto&accion=inicio" class="btn btn-danger">Regresar</a>
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