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
document.title = "Actualizar empleado"; // Cambiamos el título
</script>

<div class="card">

    <div class="card-body">
        <h4 class="card-title">Actualizar empleado</h4>
        <p class="card-text">Coloca los datos adecuadamente</p>
    </div>
    <div class="card-footer text-muted">
        <form action="" method="post">


            <div class="mb-3">
                <label for="" class="form-label">Id empleado</label>
                <input readonly type="text" class="form-control" value="<?php echo $empleado->IdEmpleados?>"
                    name="IdEmpleados" id="IdEmpleados" aria-describedby="helpId" placeholder="Folio empleado">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Nombre:</label>
                <input type="text" onkeypress="return soloLetras(event);" required=""
                    value="<?php echo $empleado->Nombre?>" class="form-control" name="Nombre" id="Nombre"
                    aria-describedby="helpId" placeholder="Nombre del empleado">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido paterno:</label>
                <input required="" type="text" onkeypress="return soloLetras(event);"
                    value="<?php echo $empleado->APEmp?>" class="form-control" name="APEmp" id="APEmp"
                    aria-describedby="helpId" placeholder="Apellido paterno">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido materno:</label>
                <input required="" type="text" onkeypress="return soloLetras(event);"
                    value="<?php echo $empleado->AMEmp?>" class="form-control" name="AMEmp" id="AMEmp"
                    aria-describedby="helpId" placeholder="Apellido Materno">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Ingresa la fecha de nacimiento:</label>
                <input required="" type="date" value="<?php echo $empleado->FechaNacimiento?>" class="form-control"
                    name="FechaNacimiento" id="FechaNacimiento" aria-describedby="helpId" placeholder="Fecha">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Teléfono:</label>
                <input type="text" onkeypress="return valideKey(event);" required="" minlength="10" maxlength="10"
                    value="<?php echo $empleado->Telefono?>" class="form-control" name="Telefono" id="Telefono"
                    aria-describedby="helpId" placeholder="Teléfono">
            </div>


            <div class="mb-3">
                <label for="" class="form-label">Dirección:</label>
                <input required="" type="text" value="<?php echo $empleado->Direccion?>" class="form-control"
                    name="Direccion" id="Direccion" aria-describedby="helpId" placeholder="Dirección">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Correo electrónico :</label>
                <input required="" type="text" value="<?php echo $empleado->CorreoElectronico?>" class="form-control"
                    name="CorreoElectronico" id="CorreoElectronico" aria-describedby="helpId"
                    placeholder="Correo electrónico">
            </div>


            <div class="mb-3">
                <label for="" class="form-label">Tipo empleado</label>
                <select class="form-control" name="TipoEmpleado" id="TipoEmpleado"
                    value="<?php echo $empleado->TipoEmpleado?>">

                    <option><?php echo $empleado->TipoEmpleado?></option>
                    <option>Barnizador</option>
                    <option>Pulidor</option>
                    <option>Colocador</option>
                    <option>Fabricador</option>
                </select>
            </div>

            <input name="" id="" class="btn btn-success" type="submit" value="Actualizar">
            <a href="?controlador=empleados&accion=inicio" class="btn btn-danger">Regresar</a>
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