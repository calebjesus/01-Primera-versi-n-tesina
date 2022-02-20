<?php  
    session_start();
    if(!isset($_SESSION['rol'])){
        header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
    }else{
        if($_SESSION['rol']!= 2){
            header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
        }
    }
?>
<br>
        <div class="d-grid gap-2">
            <a name="" id="" class="btn btn-success" href="?controlador=ReadC&accion=cuenta_listas" >Regresar</a>
        </div>
<br>
<br>
        <table  class="table table-success table-striped table-hover" style="width:100%">

            <tr>

                <th>Nombre</th>
                <th>Cantidad</th>
                <th>PrecioTotal</th>
            </tr>
            </thead>
            <tbody>

                <?php 
            foreach ($prods as $prod){?>
                <tr>
                    <td><?php echo $prod->NombreProd; ?> </td>
                    <td><?php echo $prod->Cantidad;?> </td>
                    <td><?php echo $prod->PrecioTotal;?> </td>
                </tr>

                <?php  } ?>
            </tbody>
        </table>

<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>