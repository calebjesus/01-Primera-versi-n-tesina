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
            <input id="fechas" name="fechas" required="" type="date" placeholder="Fechas disponibles">
            <br>


            <input type="hidden" required="" class="form-control" name="idcliente" id="idcliente"
                value="<?PHP echo($_SESSION['id']); ?>" aria-describedby="helpId">



            <div class="mb-3">
                <label for="" class="form-label">¿Cómo podemos ayudarte?:</label>
                <input type="text" required="" class="form-control" name="asunto" id="asunto" aria-describedby="helpId"
                    placeholder="Escribe aquí… ">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Unico estado en el trabajamos, disculpe las molestias.</label>
                <input type="text" readonly required="" class="form-control" name="estado" id="estado"
                    aria-describedby="helpId" value="Morelos" placeholder="Escribe aquí… ">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Selecciona tu municipio:</label>
                <select required="" id="municipio" name="municipio" class="form-select"
                    aria-label="Default select example">

                    <option value="">Seleccione uno...</option>
                    <option value="	Amacuzac	"> Amacuzac </option>
                    <option value="	Atlatlahucan	"> Atlatlahucan </option>
                    <option value="	Axochiapan	"> Axochiapan </option>
                    <option value="	Ayala	"> Ayala </option>
                    <option value="	Coatlán del Río	"> Coatlán del Río </option>
                    <option value="	Cuautla	"> Cuautla </option>
                    <option value="	Cuernavaca	"> Cuernavaca </option>
                    <option value="	Emiliano Zapata	"> Emiliano Zapata </option>
                    <option value="	Huitzilac	"> Huitzilac </option>
                    <option value="	Jantetelco	"> Jantetelco </option>
                    <option value="	Jiutepec	"> Jiutepec </option>
                    <option value="	Jojutla	"> Jojutla </option>
                    <option value="	Jonacatepec de Leandro Valle	"> Jonacatepec de Leandro Valle </option>
                    <option value="	Mazatepec	"> Mazatepec </option>
                    <option value="	Miacatlán	"> Miacatlán </option>
                    <option value="	Ocuituco	"> Ocuituco </option>
                    <option value="	Puente de Ixtla	"> Puente de Ixtla </option>
                    <option value="	Temixco	"> Temixco </option>
                    <option value="	Tepalcingo	"> Tepalcingo </option>
                    <option value="	Tepoztlán	"> Tepoztlán </option>
                    <option value="	Tetecala	"> Tetecala </option>
                    <option value="	Tetela del Volcán	"> Tetela del Volcán </option>
                    <option value="	Tlalnepantla	"> Tlalnepantla </option>
                    <option value="	Tlaltizapán de Zapata	"> Tlaltizapán de Zapata </option>
                    <option value="	Tlaquiltenango	"> Tlaquiltenango </option>
                    <option value="	Tlayacapan	"> Tlayacapan </option>
                    <option value="	Totolapan	"> Totolapan </option>
                    <option value="	Xochitepec	"> Xochitepec </option>
                    <option value="	Yautepec	"> Yautepec </option>
                    <option value="	Yecapixtla	"> Yecapixtla </option>
                    <option value="	Zacatepec	"> Zacatepec </option>
                    <option value="	Zacualpan de Amilpas	"> Zacualpan de Amilpas </option>
                    <option value="	Temoac	"> Temoac </option>
                    <option value="	Coatetelco	"> Coatetelco </option>
                    <option value="	Xoxocotla	"> Xoxocotla </option>
                    <option value="	Hueyapan	"> Hueyapan </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Ingresa tu colonia:</label>
                <input type="text" required="" class="form-control" name="colonia" id="colonia"
                    aria-describedby="helpId" placeholder="Escribe aquí… ">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Ingresa calle, N. int. y N. ext.:</label>
                <input type="text" required="" class="form-control" name="calle" id="calle" aria-describedby="helpId"
                    placeholder="Ejemplo (Azteca, 12, 15)">
            </div>


            <input class="btn btn-success" type="submit" value="Crear">
            <a href="?controlador=ReadC&accion=enviar_fechas_ocupadas" class="btn btn-danger">fechas</a>
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
    inline: true,
    minDate: "today",
    enableTime: true,
    altInput: true,
    altFormat: "l j F Y, H:i",
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