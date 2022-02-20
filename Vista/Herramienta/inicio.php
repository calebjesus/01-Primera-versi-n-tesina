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
document.title = "Inicio herramienta"; // Cambiamos el título
</script>
<p>

</p>
<div class="d-grid gap-2">
    <a name="" id="" class="btn btn-success" href="?controlador=herramienta&accion=crear" role="">Ingresar
        herramientas</a>
</div>
<p>

</p>

<table id="tabla" class="table table-hover" style="width:100%">
    <thead class="table-dark">
        <tr>
            <th>Folio</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Especificaciones</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>

        <?php
    foreach ($herramientas as $herramienta){?>

        <tr>
            <td><?php echo $herramienta->FolioHerra; ?> </td>
            <td><?php echo $herramienta->NombreHerra; ?> </td>
            <td><?php echo $herramienta->Cantidad; ?> </td>
            <td><?php echo $herramienta->PrecioHerra; ?> </td>
            <td><?php echo $herramienta->Especificaciones; ?> </td>

            <td>
                <div class="btn-group" role="group" aria-label="">
                    <a href="?controlador=herramienta&accion=borrar&FolioHerra=<?php echo $herramienta->FolioHerra; ?>"
                        class="btn btn-danger">Borrar</a>
                    <a href="?controlador=herramienta&accion=editar&FolioHerra=<?php echo $herramienta->FolioHerra; ?>"
                        class="btn btn-info">Actualizar</a>
                </div>
            </td>
        </tr>

        <?php  } ?>




    </tbody>
</table>

<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>