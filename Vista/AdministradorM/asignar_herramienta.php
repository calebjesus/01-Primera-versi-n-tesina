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
document.title = "Asignar herramientas"; // Cambiamos el título
</script>
<br>
<br>
<div class="card">
    <div class="card-body">
        <table id="" class="table table-hover" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>        </th>
                        <th>Herramientas perdidas</th>
                        <th>          </th>
                        <th>          </th>
                        <th>          </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        foreach ($catalogo_phch as $phch){?>
                    <tr>
                        <td><?php echo $phch->NombreHerra; ?> </td>
                        <td><?php echo $phch->cantidad;?></td>
                        <td>
                            <form  method="post" enctype="multipart/form-data">           
                                <input type="number" value="" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" style="width : 100px; heigth : 1px">
                                <input type="hidden" value="<?php echo $phch->cantidad;?>" class="form-control" name="cantidad_vieja" id="cantidad_vieja" >
                                <input type="hidden" value="<?php echo $phch->idPhch;?>" class="form-control" name="idPhch_actualizar" id="idPhch_actualizar" >
                                <input type="hidden" value="<?php echo $phch->folioherra;?>" class="form-control" name="folio_herramienta_actualizar" id="folio_herramienta_actualizar" aria-describedby="helpId">
                                <input class="btn btn-primary" type="submit" value="actualizar cantidad">
                            </form>
                        </td>
                        <td><?php echo $phch->Estado;?></td>

                        <td>
                            <form  method="post" enctype="multipart/form-data">           
                                <input  type="number" value="" class="form-control" name="cantidad_extravio" id="cantidad_extravio"  style="width : 100px; heigth : 1px">
                                <input type="hidden" value="<?php echo $phch->idPhch;?>" class="form-control" name="idPhch_extravio" id="idPhch_extravio" >
                                <input type="hidden" value="<?php echo $phch->cantidad;?>" class="form-control" name="cantidad_vieja_extravio" id="cantidad_vieja_extravio" >
                                <input class="btn btn-warning" type="submit" value="Ingresar extravíos" onclick="return ConfirmUpdateextravios()">
                            </form>
                        </td>
                        <td>
                        <form  method="post" enctype="multipart/form-data">      
                                <input type="hidden" value="<?php echo $phch->idPhch;?>" class="form-control" name="idPhch_extravio_eliminar" id="idPhch_extravio_eliminar" >     
                                <input  type="hidden" value="1 " class="form-control" name="sin_adeudos" id="sin_adeudos">
                                <input class="btn btn-danger" type="submit" value="eliminar extravíos" onclick="return ConfirmDeleteextravios()">
                            </form>
                        </td>

                        <td>
                        <form  method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $phch->idPhch;?>" class="form-control" name="folio_eliminar" id="folio_eliminar" aria-describedby="helpId">
                            <input type="hidden" value="<?php echo $phch->cantidad;?>" class="form-control" name="cantidad_eliminar" id="cantidad_eliminar">
                            <input type="hidden" value="<?php echo $phch->folioherra;?>" class="form-control" name="folio_herramienta_eliminar" id="folio_herramienta_eliminar">
                            <input name="" id="" class="btn btn-danger" type="submit" value="Eliminar" onclick="return ConfirmDelete()">
                        </form>
                        </td>


                    </tr>
                        
                    <?php }?>
                </tbody>
            </table>
    </div>
</div>
<br>
<br>


<div class="card">
    <div class="card-body">
        <table id="" class="table table-hover" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>Folio</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                        foreach ($catalogo_herramientas as $herramienta){?>
                    <tr>
                        <td><?php echo $herramienta->FolioHerra; ?> </td>
                        <td><?php echo $herramienta->NombreHerra; ?> </td>
                        <td><?php echo $herramienta->Cantidad; ?> </td>
                        
                        <td>
                        <div class="btn-group" role="group" aria-label="">

                        <form  method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $herramienta->FolioHerra;?>" class="form-control" name="folio" id="folio" aria-describedby="helpId">
                        <input name="" id="" class="btn btn-success" type="submit" value="Agregar">
                        </form>

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
    function ConfirmDeleteextravios() {
        var respuesta = confirm("¿Estás seguro de eliminar todos los extravíos?");
        if(respuesta == true){
            return true;
        }
        else{
            return false;
        }
        
    }
    function ConfirmUpdateextravios() {
        var respuesta = confirm("¿Estás seguro de actualizar el extravío de una herramienta?");
        if(respuesta == true){
            return true;
        }
        else{
            return false;
        }
        
    }


</script>


<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>