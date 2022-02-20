<?php
    session_start();
    if(!empty($_SESSION['rol'])){
        if($_SESSION['rol'] == 1){
          ?>
              <input type="hidden" id="SesionRol2" value="1">
            <?php
        }else if($_SESSION['rol'] == 2){          
            ?>
            <input type="hidden" id="SesionRol2" value="2">
            <?php
        }
    }
?>

<body class="body2">
    <table id="tabla" class="table table-hover" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th></th>
                <th>Producto</th>
            </tr>
        </thead>
        <tbody>

            <?php
    foreach ($prods as $prod){?>

            <tr>

                <td>

                    <img src="Herramientas/Imagenes/<?php echo $prod->Nombreimg;?>"
                        class="rounded mx-auto d-block img-fluid" alt="" style=" width: 30rem;">

                </td>
                <td>
                    <h5><?php echo $prod->NombreProd;?></h5>
                    <h5>Medidas: <?php echo $prod->Medidas;?></h5>
                    <h5>Precio: $<?php echo $prod->Precio;?> MXN</h5>
                    <h5>Articulos disponibles: <?php echo $prod->Cantidad;?></h5>
                    <br>
                    <form action="?controlador=ReadC&accion=comprar" method="post">
                        <input type="hidden" id="FolioProd" name="FolioProd" value="<?php echo  $prod->FolioProd;?>">
                        <div class="d-grid gap-2">
                        <input  class="btn btn-warning" type="submit" value="Apartar">
                        </div>
                    </form>
                </td>
            </tr>

            <?php  } ?>




    </tbody>
</table>



    <input type="hidden" id="SesionRol" value="0">
    <script src="Herramientas/JS/navBar.js"></script>