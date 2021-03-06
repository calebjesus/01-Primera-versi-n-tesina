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
<br>
<br>
<div class="card">
    <div class="card-body">
        <div>
            <div>
                <label for="" class="form-label">Ingresa la materia prima:</label>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <select id="folio_materia_prima" name="folio_materia_prima" class="form-select"
                    aria-label="Default select example">
                    <option value="">Seleciona el insumo</option>
                    <?php
                            foreach($insumos as $insumo){
                                echo "<option value=$insumo->foliomat >".$insumo->nombremat."/  ".$insumo->nombresuc."/  $".$insumo->preciomat."</option>";
                            }
                        ?>
                </select>
                <br>
                <div class="mb-3">
                    <label for="" class="form-label">Cantidad:</label>
                    <input type="text" onkeypress="return valideKey(event);" required="" class="form-control"
                        name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="Cantidad">
                </div>
                <br>
                <input name="" id="" class="btn btn-success" type="submit" value="Agregar">
                <br>
            </form>
        </div>
    </div>
</div>
<br>
<br>
<div class="card">
    <div class="card-body">
        <table id="tabla" class="table table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Folio</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($materia_prima_producto as $materia_prima_productos){?>
                <tr>
                    <td><?php echo $materia_prima_productos->folioinsumo;?> </td>
                    <td><?php echo $materia_prima_productos->nombremat; ?> </td>
                    <td><?php echo " $ ".$materia_prima_productos->preciomat;?> </td>
                    <td><?php echo $materia_prima_productos->cantidadt;?> pzas </td>
                    <td>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $materia_prima_productos->folioinsumo;?>"
                                class="form-control" name="folioinsumo" id="folioinsumo" aria-describedby="helpId">
                            <input class="btn btn-warning" type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>
<br>
<br>
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
        letras = " ??????????abcdefghijklmn??opqrstuvwxyz",
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