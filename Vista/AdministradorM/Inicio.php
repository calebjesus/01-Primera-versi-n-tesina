<?php  

    if(!isset($_SESSION['rol'])){
        header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
    }else{
        if($_SESSION['rol']!= 1){
            header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
        }
    }
?>  

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js" integrity="sha512-uLlukEfSLB7gWRBvzpDnLGvzNUluF19IDEdUoyGAtaO0MVSBsQ+g3qhLRL3GTVoEzKpc24rVT6X1Pr5fmsShBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script type="text/javascript" src="Herramientas/PLUGIN/chart.js"></script>
            <br>
            <br>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Clientes frecuentes</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                    </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="tile">
                                <h3 class="tile-title">Productos más apartados</h3>
                            <div class="embed-responsive embed-responsive-16by9">
                                <canvas class="embed-responsive-item" id="doughnutChartDemo"></canvas>
                            </div>
        </div>
    </div>
    
</div>
        </div>
    </div>



    
      <div class="card">
        <div class="card-body">
        
        <div class="row">
                    <div class="col-md-12">
                        <div class="tile">
                            <div style="display: flex;    flex-direction: column;    justify-content: center;    align-items: center;">
                            <h5 class="display-1">Calculadora</h5>
                            </div>
                        </div>
                    </div>
            </div>
            <br>
            <form method="post">
                    <select id="folio_materia_prima" name="folio_materia_prima" class="form-select" aria-label="Default select example">
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
                        <input type="text" onkeypress="return valideKey(event);" required="" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="Cantidad">
                    </div>       
                    <input action="" class="btn btn-success" type="submit" value="Buscar">
                    
                </form>
                <br>
                <table id="" class="table table-hover" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
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
                                <a href="?controlador=administrador&accion=eliminar_todo&id_administrador=<?php echo $_SESSION['id']; ?>"class="btn btn-danger">Eliminar</a>
                            </div>              
                        </div>
                </div>
<br>
<br>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div style="display: flex;    flex-direction: column;    justify-content: center;    align-items: center;">
                        <h1 class="display-1"> Evaluación materias primas</h1>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post"  action="?controlador=Administrador&accion=reporte_busqueda_materia_prima" >
                <div class="mb-3">
                    <label for="" class="form-label">Ingresa el nombre del material:</label>
                    <input type="text" required="" onkeypress="return soloLetras(event);" class="form-control" name="nombremateria" id="nombremateria" aria-describedby="helpId" placeholder="Nombre de la materia prima">
                </div>
                <input name="" href=" "  id="" class="btn btn-success" type="submit" value="Buscar">
            </form>
                <table id="tabla" class="table table-hover" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>Material </th>
                            <th>Sucursal </th>
                            <th>Precio   </th>
                            <th>Cantidad </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                            foreach ($materiales as $material){?>
                            <tr>
                            <td><?php echo $material->nombremat; ?> </td>
                            <td><?php echo $material->nombresuc;?> </td>
                            <td><?php echo $material->preciomat;?> </td>
                            <td><?php echo $material->cantidadmat;?> </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>
    </div>

    <br>
    <br>
<div class="card">
  <div class="card-body">
  <form action="?controlador=Administrador&accion=inicio_administrador" method="post">
  <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div style="display: flex;    flex-direction: column;    justify-content: center;    align-items: center;">
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
            <option  value= "">Seleciona el año</option>
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
            <option value= "">Seleciona el mes</option>
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
            foreach ($anual as $anuales){?>
        <tr>
            <td><?php echo $anuales->nombreprod; ?> </td>
            <td><?php echo $anuales->coteo_productos;?> </td>
            <td><?php echo $anuales->precio;?> </td>
        </tr>

        <?php } ?>
    </tbody>
</table>
  </div>
</div>




   <script type="text/javascript">


        var arreglo_datos = <?php echo json_encode($datos); ?>;
        var arreglo_datos_productos = <?php echo json_encode($datos_productos); ?>;

      var data = {
      	labels: ["January", "February", "March", "April", "May"],
      	datasets: [
      		{
      			label: "My First dataset",
      			fillColor: "rgba(220,220,220,0.2)",
      			strokeColor: "rgba(220,220,220,1)",
      			pointColor: "rgba(220,220,220,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(220,220,220,1)",
      			data: [65, 59, 80, 81, 56]
      		},
      		{
      			label: "My Second dataset",
      			fillColor: "rgba(151,187,205,0.2)",
      			strokeColor: "rgba(151,187,205,1)",
      			pointColor: "rgba(151,187,205,1)",
      			pointStrokeColor: "#fff",
      			pointHighlightFill: "#fff",
      			pointHighlightStroke: "rgba(151,187,205,1)",
      			data: [28, 48, 40, 19, 86]
      		}
      	]
      };
      var pdata = [
      	{
      		value: 300,
      		color:"#F7464A",
      		highlight: "#FF5A5E",
      		label: "Red"
      	},
      	{
      		value: 50,
      		color: "#46BFBD",
      		highlight: "#5AD3D1",
      		label: "Green"
      	},
      	{
      		value: 100,
      		color: "#FDB45C",
      		highlight: "#FFC870",
      		label: "Yellow"
      	}
      ]


      
      
      var ctxp = document.getElementById('pieChartDemo').getContext('2d');
      var pieChart = new Chart(ctxp).Pie(arreglo_datos);
      
      var ctxd = document.getElementById('doughnutChartDemo').getContext('2d');
      var doughnutChart = new Chart(ctxd).Doughnut(arreglo_datos_productos);
    </script>


<input type="hidden" id="SesionRol" value="<?php echo $_SESSION['rol'] ?>">
<script src="Herramientas/JS/navBar.js"></script>