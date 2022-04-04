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
<br>
<br>
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
                    <a href="?controlador=Cliente&accion=borrar&IdCliente=<?php echo $cliente->IdCliente; ?>"class="btn btn-danger" onclick="return ConfirmDelete()">Borrar</a>

                    <a href="?controlador=Cliente&accion=editar&IdCliente=<?php echo $cliente->IdCliente; ?>"
                        class="btn btn-info">Actualizar</a>
                </div>
            </td>
        </tr>

        <?php  } ?>




    </tbody>
</table>

<br>
<br>
<div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div style="display: flex;    flex-direction: column;    justify-content: center;    align-items: center;">
                <h1 class="display-1">Citas de clientes</h1>
                </div>
            </div>
        </div>
</div>
<br>

<table id="tabla2" class="table table-hover" style="width:100%">
    <thead class="table-dark">
        <tr>
            <th>Folio</th>
            <th>E-mail</th>
            <th>Asunto</th>
            <th>Fecha y hora</th>
            <th>Lugar de la cita</th>
            <th>      </th>
        </tr>
    </thead>
    <tbody>

        <?php
    foreach ($citas as $cita){?>

        <tr>
            <td><?php echo $cita->folio_citas; ?> </td>
            <td><?php echo $cita->asunto; ?> </td>
            <td><?php echo $cita->correoelectronico; ?> </td>
            <td><?php echo $cita->fecha_hora_cita; ?> </td>
            <td><?php echo $cita->lugar_cita; ?> </td>
            <td>
                <form  method="post" enctype="multipart/form-data">           
                <input type="hidden" value="<?php echo $cita->folio_citas;?>" class="form-control" name="folio_citas" id="folio_citas" aria-describedby="helpId">
                <input class="btn btn-danger" type="submit" value="Eliminar" onclick="return ConfirmDelete()">
                </form>
            </td>
        </tr>

        <?php  } ?>




    </tbody>
</table>





<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>
<script type="text/javascript">
    function ConfirmDelete() {
        var respuesta = confirm("¿Estás seguro de eliminar?");
        if(respuesta == true){
            return true;
        }
        else{
            return false;
        }
        
    }

</script>