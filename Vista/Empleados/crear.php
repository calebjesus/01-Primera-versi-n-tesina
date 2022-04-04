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
document.title = "Crear empleado"; // Cambiamos el título
</script>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Agregar empleado</h4>
        <p class="card-text">Coloca los datos adecuadamente</p>
    </div>
    <div class="card-footer text-muted">
        <form action="" method="post">

            <div class="mb-3">
                <label for="" class="form-label">Nombre:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control" name="nombre"
                    id="nombre" aria-describedby="helpId" placeholder="Nombre del empleado"
                    value="<?php if (isset($_POST['nombre'])) echo $_POST['nombre'];?>" >
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido paterno:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control" name="APEmp"
                    id="APEmp" aria-describedby="helpId" placeholder="Apellido paterno"
                    value="<?php if (isset($_POST['APEmp'])) echo $_POST['APEmp'];?>" >
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido materno:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control" name="AMEmp"
                    id="AMEmp" aria-describedby="helpId" placeholder="Apellido materno"
                    value="<?php if (isset($_POST['AMEmp'])) echo $_POST['AMEmp'];?>" >
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Ingresa la fecha de nacimiento:</label>
                <input type="date" required="" class="form-control" name="FechaNacimiento" id="FechaNacimiento"
                    aria-describedby="helpId" placeholder="Fecha"
                    value="<?php if (isset($_POST['FechaNacimiento'])) echo $_POST['FechaNacimiento'];?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Teléfono:</label>
                <input type="text" onkeypress="return valideKey(event);" required="" minlength="10" maxlength="10"
                    class="form-control" name="Telefono" id="Telefono" aria-describedby="helpId" placeholder="Teléfono"
                    value="<?php if (isset($_POST['Telefono'])) echo $_POST['Telefono'];?>" >
            </div>


            <div class="mb-3">
                <label for="" class="form-label">Dirección:</label>
                <input type="text" required="" class="form-control" name="Direccion" id="Direccion"
                    aria-describedby="helpId" placeholder="Dirección"
                    value="<?php if (isset($_POST['Direccion'])) echo $_POST['Direccion'];?>" >
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Correo electronico:</label>
                <input type="email" required="" class="form-control" name="CorreoElectronico" id="CorreoElectronico"
                    aria-describedby="helpId" 
                    pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
                    placeholder="Ejem. (usuario@gmail.com)" 
                    value="<?php if (isset($_POST['CorreoElectronico'])) echo $_POST['CorreoElectronico'];?>" >
            </div>


            <div class="mb-3">
                <label for="" class="form-label"></label>
                <label for="" class="form-label">Tipo empleado:</label>
                <select class="form-control" name="TipoEmpleado" id="TipoEmpleado" >
                    <option>Barnizador</option>
                    <option>Pulidor</option>
                    <option>Colocador</option>
                    <option>Fabricador</option>
                    <option  selected="selected"  value="<?php if (isset($_POST['TipoEmpleado'])) echo $_POST['TipoEmpleado'];?>"><?php if (isset($_POST['TipoEmpleado'])) echo $_POST['TipoEmpleado'];?> </option>
                </select>
            </div>


            <input name="" id="" class="btn btn-success" type="submit" value="Crear">
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