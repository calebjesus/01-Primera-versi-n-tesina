<?php  
    
    if(!isset($_SESSION['rol'])){
        header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
    }else{
        if($_SESSION['rol']!= 2){
            header("Location: http://localhost/CarpinteriaGral/?controlador=Login&accion=inicio");
        }
    }
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
document.title = "Crear Cita"; // Cambiamos el título
</script>

<div class="card">

    <div class="card-body">

        <h4 class="card-title">Crear una cita</h4>
        <p class="card-text">Coloca los datos adecuadamente.
            <br>
            Solo podrás crear la cita de un día, por el momento solo podremos atenderte en el estado de Mexico Morelos.
        </p>

    </div>
    <div class="card-footer text-muted">
        <form action="" method="post" enctype="multipart/form-data">
            <br>
            <input id="fechas" name="fechas" required="" type="date" placeholder="Fechas disponibles"
            value="<?php if (isset($_POST['fechas'])) echo $_POST['fechas'];?>">
            <br>


            <input type="hidden" required="" class="form-control" name="idcliente" id="idcliente"
                value="<?PHP echo($_SESSION['id']); ?>" aria-describedby="helpId">



            <div class="mb-3">
                <label for="" class="form-label">¿Cómo podemos ayudarte?:</label>
                <input type="text" required="" class="form-control" name="asunto" id="asunto" aria-describedby="helpId"
                    placeholder="Escribe aquí… "
                    value="<?php if (isset($_POST['asunto'])) echo $_POST['asunto'];?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Unico estado en el trabajamos, disculpe las molestias.</label>
                    <select id="estado" name="estado" class="form-select" aria-label="Default select example">
                    <?php
                        foreach($datos_estado as $option){
                            echo "<option value=$option->municipio >".$option->municipio."</option>";
                        }
                    ?>
                    <option  selected="selected"  value="<?php if (isset($_POST['estado'])) echo $_POST['estado'];?>"><?php if (isset($_POST['estado'])) echo $_POST['estado'];?> </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Selecciona tu municipio:</label>
                <select id="municipio" name="municipio" class="form-select" aria-label="Default select example">
                    <option  value= "">Municipios</option>
                    <?php
                        foreach($datos_municipios as $option){
                            echo "<option value=$option->estado >".$option->estado."</option>";
                        }
                    ?>
                    <option  selected="selected"  value="<?php if (isset($_POST['municipio'])) echo $_POST['municipio'];?>"><?php if (isset($_POST['municipio'])) echo $_POST['municipio'];?> </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Ingresa tu colonia:</label>
                <input type="text" required="" class="form-control" name="colonia" id="colonia"
                    aria-describedby="helpId" placeholder="Escribe aquí… " 
                    value="<?php if (isset($_POST['colonia'])) echo $_POST['colonia'];?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Ingresa calle, N. int. y N. ext.:</label>
                <input type="text" required="" class="form-control" name="calle" id="calle" aria-describedby="helpId"
                    placeholder="Ejemplo (Azteca, 12, 15)"
                    value="<?php if (isset($_POST['calle'])) echo $_POST['calle'];?>">
            </div>


            <input class="btn btn-success" type="submit" value="Crear">
        </form>

    </div>
</div>

<?php
    include_once("Controlador/controlador_VC.php");
    ControladorVC::enviar_fechas_ocupadas();
    ?>
<script>
config = {

    disable: [<?php echo(ControladorVC::enviar_fechas_ocupadas());?>],

    minDate: "today",
    enableTime: true,
    minTime: "9:00",
    maxTime: "17:00",
    dateFormat: "Y-m-d H:i",
    locale: {
        firstDayOfWeek: 1,
        weekdays: {
            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        },
        months: {
            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
            longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ],
        },
    }
}

flatpickr("#fechas", config);
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


<input type="hidden" id="SesionRol" value="2">
<script src="Herramientas/JS/navBar.js"></script>