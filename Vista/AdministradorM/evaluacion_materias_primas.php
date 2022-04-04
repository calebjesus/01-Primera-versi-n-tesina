<?php  
    if(!isset($_SESSION['rol'])){
        header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
    }else{
        if($_SESSION['rol']!= 1){
            header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
        }
    }
?>
<br>
<div class="d-grid gap-2">
<a href="?controlador=Administrador&accion=inicio_administrador" class="btn btn-danger">Regresar</a>
</div>
<br>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div
                        style="display: flex;    flex-direction: column;    justify-content: center;    align-items: center;">
                        <h1 class="display-1"> Evaluación materias primas</h1>
                    </div>
                </div>
            </div>
        </div>
        <form method="post" action="?controlador=Administrador&accion=reporte_busqueda_materia_prima">
            <div class="mb-3">
                <label for="" class="form-label">Ingresa el nombre del material:</label>
                <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control"
                    name="nombremateria" id="nombremateria" aria-describedby="helpId"
                    placeholder="Nombre de la materia prima">
            </div>
            <input name="" href=" " id="" class="btn btn-success" type="submit" value="Buscar"> 
        </form>
        <br>
        <table id="tabla" class="table table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Material </th>
                    <th>Sucursal </th>
                    <th>Precio </th>
                    <th>Cantidad </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                        
                            foreach ($materiales as $material){?>
                <tr>
                    <td><?php echo $material->nombremat; ?> </td>
                    <td><?php echo $material->nombresuc;?> </td>
                    <td><?php echo $material->preciomat;?> </td>
                    <td><?php echo $material->cantidadmat;?> </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<br>


<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>
