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
document.title = "Inicio producto";
</script>

<br>
<br>
<div class="card">
  <div class="card-body">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="tile">
                                    <div style="display: flex;    flex-direction: column;    justify-content: center;    align-items: center;">
                                    <h1 class="display-1">Entrega de productos</h1>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <br>

        <table id="tabla" class="table table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>E-mail</th>
                    <th>Fecha/pedido</th>
                    <th>Fecha Vencimiento</th>
                    <th>Total</th>
                    <th>     </th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
            foreach ($entrega_productos as $prod){?>
                <tr>
                    <td><?php echo $prod->correoelectronico; ?> </td>
                    <td><?php echo $prod->fecha;?> </td>
                    <td><?php echo $prod->fechavencimiento;?> </td>
                    <td><?php echo $prod->preciototal;?> </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="">
                            <a href="?controlador=producto&accion=producto_entregado&FolioApartado=<?php echo $prod->FolioApartado; ?>"
                                class="btn btn-warning" onclick="return ConfirmProductoentregado()">¿Entregado?</a>
                            <a href="?controlador=producto&accion=producto_entregado&FolioApartado=<?php echo $prod->FolioApartado; ?>"
                                class="btn btn-danger" onclick="return ConfirmProductocancelado()">Cancelado</a>
                        </div>
                    </td>
                </tr>
                <?php  } ?>
            </tbody>
        </table>
  </div>
</div>
<br>
<br>

<div class="card">
    <div class="card-body">
        <div class="d-grid gap-2">
            <a name="" id="" class="btn btn-success" href="?controlador=producto&accion=crear" role="">Crear un producto</a>
        </div>
            <br>
            <br>
        <table id="tabla2" class="table table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Folio</th>
                    <th>Nombre</th>
                    <th>Medidas</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
            foreach ($prods as $prod){?>
                <tr>
                    <td><?php echo $prod->FolioProd; ?> </td>
                    <td><?php echo $prod->NombreProd;?> </td>
                    <td><?php echo $prod->Medidas;?> </td>
                    <td><?php echo $prod->Categoria;?> </td>
                    <td><?php echo $prod->Precio;?> </td>
                    <td><?php echo $prod->Cantidad;?> </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="">
                            <a href="?controlador=producto&accion=borrar&FolioProd=<?php echo $prod->FolioProd; ?>"
                                class="btn btn-danger">Borrar</a>
                            <a href="?controlador=producto&accion=editar&FolioProd=<?php echo $prod->FolioProd; ?>"
                                class="btn btn-info">Actualizar</a>
                            <a href="?controlador=producto&accion=insumo&FolioProd=<?php echo $prod->FolioProd; ?>"
                            class="btn btn-warning">Insumo</a>
                        </div>
                    </td>
                </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<br>


<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>

<script type="text/javascript">
    function ConfirmProductoentregado() {
        var respuesta = confirm("¿Estás seguro de marcarlo por entregado?, este apartado ya no parecerá.");
        if(respuesta == true){
            return true;
        }
        else{
            return false;
        }
        
    }
    function ConfirmProductocancelado() {
        var respuesta = confirm("¿Estás seguro de marcarlo por cancelado?, este apartado ya no parecerá.");
        if(respuesta == true){
            return true;
        }
        else{
            return false;
        }
        
    }
</script>