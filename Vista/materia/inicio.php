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
document.title = "Inicio materia prima"; // Cambiamos el título
</script>
<p>

</p>
<div class="d-grid gap-2">
    <a name="" id="" class="btn btn-success" href="?controlador=materia&accion=crear" role="">Crear materia prima</a>
</div>
<p>

</p>

<table id="tabla" class="table table-hover" style="width:100%">
    <thead class="table-dark">
        <tr>
            <th>Folio</th>
            <th>Nombre</th>
            <th>Sucursal</th>
            <th>Medidas</th>
            <th>Tipo</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>

        <?php
    foreach ($materias as $materia){?>

        <tr>
            <td><?php echo $materia->FolioMat; ?> </td>
            <td><?php echo $materia->NombreMat; ?> </td>
            <td><?php echo $materia->NombreSuc; ?> </td>
            <td><?php echo $materia->MedidasMat; ?> </td>
            <td><?php echo $materia->TipoMadera; ?> </td>
            <td><?php echo $materia->CantidadMat; ?> </td>
            <td><?php echo $materia->PrecioMat; ?> </td>

            <td>
                <div class="btn-group" role="group" aria-label="">
                    <a href="?controlador=materia&accion=borrar&FolioMat=<?php echo $materia->FolioMat; ?>"
                        class="btn btn-danger">Borrar</a>
                    <a href="?controlador=materia&accion=editar&FolioMat=<?php echo $materia->FolioMat; ?>"
                        class="btn btn-info">Actualizar</a>
                </div>
            </td>
        </tr>

        <?php  } ?>

    </tbody>
</table>

<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>