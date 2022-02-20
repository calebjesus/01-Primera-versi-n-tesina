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
document.title = "Crear prestación"; // Cambiamos el título
</script>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Crear prestación</h4>
        <p class="card-text">Coloca los datos adecuadamente</p>
    </div>
        <div class="card-footer text-muted">
            <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <select id="folio_empleado" name="folio_empleado" class="form-select" aria-label="Default select example">
                            <option  value= "">Seleciona empleado</option>
                            <?php
                                foreach($datos_empleados as $option){
                                    echo "<option value=$option->idempleados >".$option->idempleados."/  ".$option->correoelectronico."/".$option->nombre." ".$option->APEmp." ".$option->AMEmp."</option>";
                                }
                            ?>
                        </select>
                    </div>
                        <br>
                        <br>
                        <input class="btn btn-success" type="submit" value="Crear"> 
            </form>
        </div>
</div>
<br>
<br>
<div class="card">
    <div class="card-body">
        <table id="" class="table table-hover" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>E-mail</th>
                        <th>Fecha registro</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        foreach ($tabla_prestacion_herramienta as $m_c){?>
                    <tr>
                        <td><?php echo $m_c->correoelectronico; ?> </td>
                        <td><?php echo $m_c->FechaPrestacion;?> </td>
                        <td><?php if($m_c->Estado==0){ echo("Desactivado"); }else{ echo("Activo");} ?></td>
                        <td>
                        <div class="btn-group" role="group" aria-label="">

                        <a href="?controlador=administrador&accion=asignar_herramienta&idPh=<?php echo $m_c->idPh;?>"
                        class="btn btn-success">Asignar herramienta</a>
                        
                        <a href="?controlador=administrador&accion=desactivar_prestamo&idPh=<?php echo $m_c->idPh;?>"
                        class="btn btn-danger">Inactivo</a>

                        <a href="?controlador=administrador&accion=activar_prestamo&idPh=<?php echo $m_c->idPh;?>"
                        class="btn btn-warning">Activo</a>

                        
                        </div>
                        </td>
                    </tr>
                        
                    <?php }?>
                </tbody>
            </table>
    </div>
</div>
<br>
<br>

</script>
<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>


