<?php  
    
    if(!isset($_SESSION['rol'])){
        header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
    }else{
        if($_SESSION['rol']!= 2){
            header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
        }
    }
?>
<script>
document.title = "Realizar compra";
</script>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Prepara tu compra <?php echo $Cliente->NombreClien?></h4>
        <p>Verifica tus datos antes de proceder a tu apartado.</p>
        <p>Nombre del cliente: <?php echo $Cliente->NombreClien?> <?php echo $Cliente->APClien?>
            <?php echo $Cliente->AMClien?></p>
        <p>Numero de teléfono: <?php echo $Cliente->Telefono?></p>
        <p>Dirección: <?php echo $Cliente->Direccion?></p>
        <p>Correo electrónico: <?php echo $Cliente->CorreoElectronico?></p>
        <p> </p>
        <table class="table table-success table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Medidas</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>

                <?php 
    foreach ($prods as $prod){?>
                <tr>

                    <td><?php echo $prod->NombreProd;?> </td>
                    <td><?php echo $prod->Medidas;?> </td>
                    <td><?php echo $prod->Precio;?> </td>
                    <td><?php echo $prod->Cantidad;?> </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="">
                            <button value="" id="<?php echo $prod->idCarritoTemporal;?>"
                                name="<?php echo $prod->Cantidad;?>" onclick="reply_click(this.id,this.name)"
                                type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Actualizar cantidad</button>

                            <button value="" id="<?php echo $prod->idCarritoTemporal;?>" onclick="reply_click2(this.id)"
                                type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal2">Eliminar</button>
                        </div>
                    </td>
                </tr>


                <?php  } ?>
            </tbody>
        </table>
        <a href="?controlador=ReadC&accion=realizarCompra" class="btn btn-success">realizar apartado</a>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualiza la cantidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="?controlador=ReadC&accion=ActualizarCantidad" method="post">

                    <div class="mb-3">
                        <label for="" class="form-label">Cantidad:</label>
                        <input name="CantidadMat" id="CantidadMat" type="Number" onkeypress="return valideKey(event);"
                            class="form-control" aria-describedby="helpId" placeholder="Cantidad">
                    </div>

                    <!--Contiene el numero de folio de carritotemporal --->
                    <input type="hidden" id="folioC" name="folioC">


            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input name="" id="" class="btn btn-success" type="submit" value="Actualizar">
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="?controlador=ReadC&accion=Eliminarproducto" method="post">

                    <h1>¿Estás seguro de eliminar este producto?</h1>

                    <!--Contiene el numero de folio de carritotemporal --->
                    <input type="hidden" id="folioC1" name="folioC1">


            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input name="" id="" class="btn btn-success" type="submit" value="Borrar">
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
//selecionas el id a donde se lo vamos a enviar
var folioC1 = document.getElementById('folioC1');

function reply_click2(clicked_id) {
    folioC1.value = clicked_id;

}
</script>

<script type="text/javascript">
//selecionas el id a donde se lo vamos a enviar
var folioC = document.getElementById('folioC');
var CantidadMat = document.getElementById('CantidadMat');

function reply_click(clicked_id, clicked_cantidad) {
    folioC.value = clicked_id;
    CantidadMat.value = clicked_cantidad;
}
</script>

<script type="text/javascript">
function valideKey(evt) {

    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;

    if (code == 8) { // backspace.
        return true;
    } else if (code >= 48 && code <= 57) { // is a number.
        return true;
    } else { // other keys.
        return false;
    }
}
</script>

<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>