<?php  
    if(!isset($_SESSION['rol'])){
        header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
    }else{
        if($_SESSION['rol']!= 1){
            header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
        }else if($_SESSION['rol']!= 1){
            header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
        }
    }
?>
<script>
document.title = "Inicio Administrador"; // Cambiamos el título
</script>
<br>
<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
      <h5>Respaldar base de datos</h5>
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
            <br>
            <form  method="post" enctype="multipart/form-data">
                    <div class="d-grid gap-2">
                        <input  type="hidden" value="1 " class="form-control" name="respaldo" id="respaldo">
                        <input class="btn btn-primary" type="submit" value="Generar base de datos">
                    </div>
            </form>
            <br>
    </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
      <h5>Recuperar base de datos</h5>
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <br> 
            <form  method="post" enctype="multipart/form-data">

                <select id="file" name="file" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <?php
                $directorio = "../CarpinteriaGral/respaldos";
                $dir=opendir($directorio);
                while (($file = readdir($dir))!== false)
                    {
                    if ($file != '.' && $file != '..')       
                        echo "<option value='" . $file . "'>".$file."</option>";
                    }
                ?>
                </select>
                <input  type="hidden" value="2" class="form-control" name="Recuperar" id="Recuperar">
                <input class="btn btn-primary" type="submit" value="Recuperar base de datos">
            </form>
            
        <br>
      </div>
    </div>
  </div>
<br>
<div class="card">
  <div class="card-body">
  <br>
  <div class="d-grid gap-2">
                <a name="" id="" class="btn btn-success" href="?controlador=Administrador&accion=crear" role="">Crear
                    administrador</a>
            </div>
            <br>
                <table id="tabla" class="table table-hover" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>Folio</th>
                            <th>Nombre</th>
                            <th>A. Paterno</th>
                            <th>A. Materno</th>
                            <th>E-mail</th>
                           
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                    foreach ($admins as $admin){?>
                        <tr>
                            <td><?php echo $admin->FolioAdmin; ?> </td>
                            <td><?php echo $admin->Nombre;?> </td>
                            <td><?php echo $admin->APAdmin;?> </td>
                            <td><?php echo $admin->AMAdmin;?> </td>
                            <td><?php echo $admin->CorreoElectronico;?> </td>
                            
                            <td>
                                <div class="btn-group" role="group" aria-label="">
                                    <a href="?controlador=administrador&accion=borrar&FolioAdmin=<?php echo $admin->FolioAdmin; ?>"
                                        class="btn btn-danger" onclick="return ConfirmDelete()">Borrar</a>
                                    <a href="?controlador=administrador&accion=editar&FolioAdmin=<?php echo $admin->FolioAdmin; ?>"
                                        class="btn btn-info">Actualizar</a>
                                </div>
                            </td>
                        </tr>

                        <?php  } ?>




                    </tbody>
                </table>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
    <h5 class="display-1">Cifrar contraseñas</h5>
        <form method="post" >
        <div class="mb-3">
                        <label for="" class="form-label">Ingresa la contraseña a cifrar</label>
                        <input type="text" required="" class="form-control" name="contraseña" id="contraseña" aria-describedby="helpId" placeholder="contraseña">
                        <br>
                        <label for="" class="form-label">Contraseña cifrada</label>
                        <input readonly  value="<?php echo $contraseñaHash?>" class="form-control" name="contraseña_cifrada" id="contraseña_cifrada" aria-describedby="helpId" placeholder="">
                    </div>
                    <input action="" class="btn btn-success" type="submit" value="Cifrar">
        </form>
    </div>
</div>


<br>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div
                        style="display: flex;    flex-direction: column;    justify-content: center;    align-items: center;">
                        <h5 class="display-1">Calculadora</h5>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <form method="post">
            <select id="folio_materia_prima" name="folio_materia_prima" class="form-select"
                aria-label="Default select example">
                <option value="">Seleciona el producto</option>
                <?php
                                foreach($productos as $producto){
                                    echo "<option value=$producto->folioprod >".$producto->folioprod." ".$producto->nombreprod."/  ".$producto->categoria."</option>";
                                }
                            ?>
            </select>
            <br>
            <div class="mb-3">
                <label for="" class="form-label">Cantidad:</label>
                <input type="text" onkeypress="return valideKey(event);" required="" class="form-control"
                    name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="Cantidad">
            </div>
            <input action="" class="btn btn-success" type="submit" value="Buscar">

        </form>
        <br>
        <table id="" class="table table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Coste unitario</th>
                    <th>Coste/material</th>
                    <th>Cantidad</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $cont=0;
                        foreach ($mostrar_calculadora as $m_c){
                            $cont+=$m_c->precio;
                            ?>
                <tr>
                    <td><?php echo $m_c->producto; ?> </td>
                    <td>$ <?php echo $m_c->costeunitario; ?> </td>
                    <td>$ <?php echo $m_c->precio;?> </td>
                    <td><?php echo $m_c->cantidad;?> </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="">
                            <a href="?controlador=administrador&accion=eliminar_folio_calculadora&idcalculadora=<?php echo $m_c->idcalculadora; ?>"
                                class="btn btn-danger">Eliminar</a>
                        </div>
                    </td>
                </tr>

                <?php }?>


            </tbody>
        </table>

        <br>
    </div>
</div>
<div class="card text-white bg-success mb-12" style="max-width: 100rem;">
    <div class="card-header">Precio total:</div>
    <div class="card-body">
        <h5 class="card-title"> $ <?php echo($cont);?></h5>
        <div class="btn-group" role="group" aria-label="">
            <a href="?controlador=administrador&accion=eliminar_todo&id_administrador=<?php echo $_SESSION['id']; ?>"
                class="btn btn-danger">Eliminar</a>
        </div>
    </div>
</div>


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