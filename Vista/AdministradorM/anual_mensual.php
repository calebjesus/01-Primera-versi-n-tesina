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
<div class="d-grid gap-2">
<a href="?controlador=Administrador&accion=inicio_administrador" class="btn btn-danger">Regresar</a>
</div>
<br>
<div class="card">
    <div class="card-body">
        <form action="?controlador=Administrador&accion=anual_mensual" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div
                            style="display: flex;    flex-direction: column;    justify-content: center;    align-items: center;">
                            <h1 class="display-1"> anual y mensual</h1>
                        </div>
                    </div>
                </div>
            </div>


            <div>
                <div>
                    Años disponibles
                </div>
                <select id="anio" name="anio" class="form-select" aria-label="Default select example">
                    <option value="">Seleciona el año</option>
                    <?php
                foreach($fechas_distintas as $option){
                    echo "<option value=$option >".$option."</option>";
                }
            ?>
                </select>
            </div>


            <div>
                <div>
                    Meses disponibles
                </div>
                <select id="mes" name="mes" class="form-select" aria-label="Default select example">
                    <option value="">Seleciona el mes</option>
                    <?php
                foreach($meses_distintos as $meses){
                    echo "<option value=$meses >".$meses."</option>";
                }
            ?>
                </select>
            </div>
            <br>
            <input name="" id="" class="btn btn-success" type="submit" value="Buscar">
        </form>

        <br>

        <table id="tabla" class="table table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php 
        $cont2=0;
            foreach ($anual as $anuales){
                $cont2+=$anuales->precio;?>
                <tr>
                    <td><?php echo $anuales->nombreprod; ?> </td>
                    <td><?php echo $anuales->coteo_productos;?> </td>
                    <td>$<?php echo $anuales->precio;?> </td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="card text-white bg-success mb-12" style="max-width: 100rem;">
    <div class="card-header">Precio total:</div>
    <div class="card-body">
        <h5 class="card-title"> $ <?php echo($cont2);?></h5>

    </div>
</div>
<br>
<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>
