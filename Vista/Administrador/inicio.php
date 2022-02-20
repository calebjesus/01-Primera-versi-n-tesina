<?php  
    session_start();
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
                            <th>Contraseña</th>
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
                            <td><?php echo $admin->Contrasena;?> </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="">
                                    <a href="?controlador=administrador&accion=borrar&FolioAdmin=<?php echo $admin->FolioAdmin; ?>"
                                        class="btn btn-danger">Borrar</a>
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
<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>