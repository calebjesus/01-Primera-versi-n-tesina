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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.js"
    integrity="sha512-uLlukEfSLB7gWRBvzpDnLGvzNUluF19IDEdUoyGAtaO0MVSBsQ+g3qhLRL3GTVoEzKpc24rVT6X1Pr5fmsShBg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="Herramientas/PLUGIN/chart.js"></script>
<br>
<div class="d-grid gap-2">
    <a class="btn btn-primary" href="?controlador=Administrador&accion=reporte_busqueda_materia_prima">Evaluación de materias primas</a>
    <a class="btn btn-primary" href="?controlador=Administrador&accion=anual_mensual">Reporte anual y mensual</a>
    
</div>
<br>
<br>
<div class="row">
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Clientes frecuentes</h3>
            <form action="" method="post">
            <div class="mb-3">
                    <label for="" class="form-label">Ingresa la cantidad de clientes :</label>
                    <input type="Number" min="1" required="" onkeypress="return valideKey(event);" class="form-control"
                    name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="Cantidad"
                    value="<?php if (isset($_POST['cantidad'])) echo $_POST['cantidad'];?>">
            </div>
            <input name="" id="" class="btn btn-success" type="submit" value="Buscar">
            </form>
            <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Productos más apartados</h3>
            <form action="" method="post">
            <div class="mb-3">
                    <label for="" class="form-label">Ingresa la cantidad de productos :</label>
                    <input type="Number" min="1" required="" onkeypress="return valideKey(event);" class="form-control"
                    name="CantidadMat" id="CantidadMat" aria-describedby="helpId" placeholder="Cantidad"
                    value="<?php if (isset($_POST['CantidadMat'])) echo $_POST['CantidadMat'];?>">
            </div>
            <input name="" id="" class="btn btn-success" type="submit" value="Buscar">
            </form>

            <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="doughnutChartDemo"></canvas>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<br>
<br>
<div class="row">
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Inicios de sesión</h3>
            <table id="tabla2" class="table table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    
                    <th>Folio Administrador</th>
                    <th>Fecha y hora de ingreso</th>
                </tr>
            </thead>
            <tbody>
                <?php 
            foreach ($datos_inicio_sesiones as $prod){?>
                <tr>
                    <td><?php echo $prod->folioadmin; ?> </td>
                    <td><?php echo $prod->fechainicio;?> </td>
                </tr>
                <?php  } ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<br>



<script type="text/javascript">
var arreglo_datos = <?php echo json_encode($datos); ?>;
var arreglo_datos_productos = <?php echo json_encode($datos_productos); ?>;

var data = {
    labels: ["January", "February", "March", "April", "May"],
    datasets: [{
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
var pdata = [{
        value: 300,
        color: "#F7464A",
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