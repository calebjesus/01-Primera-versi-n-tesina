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
document.title = "Datos cliente";
</script>

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div style="display: flex;    flex-direction: column;    justify-content: center;    align-items: center;">

                <h1 class="display-1">Datos cliente</h1>
            </div>
        </div>
    </div>
</div>

<div class="card">

    <div class="card-body">
        <h4 class="card-title">Bienvenido <?php echo $Cliente->NombreClien?></h4>
        <p> Precaución al modificar los datos ya que por estos se enviarán sus pedidos.</p>

    </div>
    <div class="card-footer text-muted">
        <form action="" method="post">

            <div class="mb-3">
                <label for="" class="form-label">Folio</label>
                <input readonly type="text" class="form-control" value="<?php echo $Cliente->IdCliente?>"
                    name="IdCliente" id="IdCliente" aria-describedby="helpId" placeholder="Folio Cliente">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Nombre:</label>
                <input type="text" readonly onkeypress="return soloLetras(event);" required=""
                    value="<?php echo $Cliente->NombreClien?>" class="form-control" name="NombreClien" id="NombreClien"
                    aria-describedby="helpId" placeholder="Nombre del Cliente">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido paterno:</label>
                <input required="" readonly onkeypress="return soloLetras(event);" type="text"
                    value="<?php echo $Cliente->APClien?>" class="form-control" name="APClien" id="APClien"
                    aria-describedby="helpId" placeholder="Apellido paterno">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido materno:</label>
                <input required="" readonly onkeypress="return soloLetras(event);" type="text"
                    value="<?php echo $Cliente->AMClien?>" class="form-control" name="AMClien" id="AMClien"
                    aria-describedby="helpId" placeholder="Apellido materno">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Ingresa la fecha de nacimiento:</label>
                <input required="" readonly type="date" value="<?php echo $Cliente->FechaNacimiento?>"
                    class="form-control" name="FechaNacimiento" id="FechaNacimiento" aria-describedby="helpId"
                    placeholder="Fecha">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Teléfono:</label>
                <input type="text" onkeypress="return valideKey(event);" required="" minlength="10" maxlength="10"
                    value="<?php echo $Cliente->Telefono?>" class="form-control" name="Telefono" id="Telefono"
                    aria-describedby="helpId" placeholder="Teléfono">
            </div>


            <div class="mb-3">
                <label for="" class="form-label">Dirección:</label>
                <input required="" type="text" value="<?php echo $Cliente->Direccion?>" class="form-control"
                    name="Direccion" id="Direccion" aria-describedby="helpId" placeholder="Dirección">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Correo electrónico:</label>
                <input required="" readonly type="text" value="<?php echo $Cliente->CorreoElectronico?>"
                    class="form-control" name="CorreoElectronico" id="CorreoElectronico" aria-describedby="helpId"
                    placeholder="Correo Electrónico">
            </div>

            <div class="mb-3">
                
                <input required="" readonly type="hidden" value="<?php echo $Cliente->Contrasena?>" class="form-control"
                    name="Contrasena" id="Contrasena" aria-describedby="helpId" placeholder="Contraseña">
            </div>



            <input name="" id="" class="btn btn-success" type="submit" value="Actualizar">
        </form>

    </div>
</div>
<div class="d-grid gap-2">
    <a name="" id="" class="btn btn-danger" href="?controlador=Login&accion=cerrar" role="">Cerrar Sesión</a>
</div>

<br>
<br>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div style="display: flex;    flex-direction: column;    justify-content: center;    align-items: center;">

                <h1 class="display-1">Lista de cita</h1>





            </div>
        </div>
    </div>
</div>

<div class="card text-white bg-secondary mb-12">
    <div class="card-header"> </div>
    <div class="card-body">
        <h5 class="card-title">Detalles</h5>
        <?php 
        if(empty($cita)){
            echo 'No hay cita';
        }else{ 
        ?>

        <p class="card-text"><?php echo $cita[0]; ?></p>
        <p class="card-text"><?php echo $cita[1]; ?></p>
        <p class="card-text"><?php echo $cita[2]; ?></p>

        <?php 

        }
        ?>
    </div>
</div>





<div>
    </p>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div
                    style="display: flex;    flex-direction: column;    justify-content: center;    align-items: center;">

                    <h1 class="display-1">Lista de productos</h1>
                </div>
            </div>
        </div>
    </div>




    <!-- inicia tabla de productos -->

    <table id="tabla" class="table table-hover" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th>Folio</th>
                <th>Fecha del pedido</th>
                <th>Fecha de vencimiento</th>
                <th>Total</th>
                <th>Ver detalles</th>
            </tr>
        </thead>
        <tbody>

            <?php 
    foreach ($prods as $prod){?>
            <tr>
                <td><?php echo $prod->FolioApartado; ?> </td>
                <td><?php echo $prod->Fecha;?> </td>
                <td><?php echo $prod->FechaVencimiento;?> </td>
                <td>$<?php echo $prod->PrecioTotal;?> </td>

                <td>
                    <div class="btn-group" role="group" aria-label="">
                        <a href="?controlador=ReadC&accion=ver_tabla_apartadoproducto&FolioApartado=<?php echo $prod->FolioApartado;?>"
                            class="btn btn-info">Detalles</a>

                    </div>
                </td>
            </tr>

            <?php  } ?>
        </tbody>
    </table>
</div>


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

function soloLetras(e) {
    var key = e.keyCode || e.which,
        tecla = String.fromCharCode(key).toLowerCase(),
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
        especiales = [8, 37, 39, 46],
        tecla_especial = false;

    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}
</script>

<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>