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
document.title = "Inicio empleado"; // Cambiamos el título
</script>
<p>

</p>
<div class="d-grid gap-2">
    <a name="" id="" class="btn btn-success" href="?controlador=empleados&accion=crear" role="">Crear un empleado</a>
</div>
<p>

</p>

<table id="tabla" class="table table-hover" style="width:100%">
    <thead class="table-dark">
        <tr>
            <th>Folio</th>
            <th>Nombre</th>
            <th>A. Paterno</th>
            <th>A. Materno</th>
            <th>F. Nacimiento</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>E-mail</th>
            <th>T. Empleado</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>

        <?php
    foreach ($empleados as $empleado){?>

        <tr>
            <td><?php echo $empleado->IdEmpleados; ?> </td>
            <td><?php echo $empleado->Nombre; ?> </td>
            <td><?php echo $empleado->APEmp; ?> </td>
            <td><?php echo $empleado->AMEmp; ?> </td>
            <td><?php echo $empleado->FechaNacimiento; ?> </td>
            <td><?php echo $empleado->Telefono; ?> </td>
            <td><?php echo $empleado->Direccion; ?> </td>
            <td><?php echo $empleado->CorreoElectronico; ?> </td>
            <td><?php echo $empleado->TipoEmpleado; ?> </td>


            <td>
                <div class="btn-group" role="group" aria-label="">
                    <a href="?controlador=empleados&accion=borrar&IdEmpleados=<?php echo $empleado->IdEmpleados; ?>"
                        class="btn btn-danger">Borrar</a>
                    <a href="?controlador=empleados&accion=editar&IdEmpleados=<?php echo $empleado->IdEmpleados; ?>"
                        class="btn btn-info">Actualizar</a>
                </div>
            </td>
        </tr>

        <?php  } ?>




    </tbody>
</table>

<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>