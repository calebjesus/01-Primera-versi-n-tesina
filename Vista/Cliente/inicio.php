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
document.title = "Inicio cliente"; // Cambiamos el título
</script>
<p>

</p>
<div class="d-grid gap-2">
    <a name="" id="" class="btn btn-success" href="?controlador=cliente&accion=crear" role="">Crear cliente</a>
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
            <th>Contraseña</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>

        <?php
    foreach ($Clientes as $cliente){?>

        <tr>
            <td><?php echo $cliente->IdCliente; ?> </td>
            <td><?php echo $cliente->NombreClien; ?> </td>
            <td><?php echo $cliente->APClien; ?> </td>
            <td><?php echo $cliente->AMClien; ?> </td>
            <td><?php echo $cliente->FechaNacimiento; ?> </td>
            <td><?php echo $cliente->Telefono; ?> </td>
            <td><?php echo $cliente->Direccion; ?> </td>
            <td><?php echo $cliente->CorreoElectronico; ?> </td>
            <td><?php echo $cliente->Contrasena; ?> </td>
            <td>
                <div class="btn-group" role="group" aria-label="">
                    <a href="?controlador=Cliente&accion=borrar&IdCliente=<?php echo $cliente->IdCliente; ?>"
                        class="btn btn-danger">Borrar</a>
                    <a href="?controlador=Cliente&accion=editar&IdCliente=<?php echo $cliente->IdCliente; ?>"
                        class="btn btn-info">Actualizar</a>
                </div>
            </td>
        </tr>

        <?php  } ?>




    </tbody>
</table>

<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>