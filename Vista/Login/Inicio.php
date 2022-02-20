<?php
    session_start();
    if(!empty($_SESSION['rol'])){
        if($_SESSION['rol'] == 1){
            header("Location: http://localhost/CarpinteriaGral/?controlador=Administrador&accion=inicio");
        }else if($_SESSION['rol'] == 2){          
            header("Location: http://localhost/CarpinteriaGral/?controlador=ReadC&accion=comprar");  
        }
    }else{
?>

<input type="hidden" id="SesionRol" value="0">
<!-- Se va a procesar en login.php y se enviará por POST, no por GET-->
<form method="post" action="?controlador=Login&accion=validarLogin">
    <!--
            Nota: el atributo name es importante, pues lo vamos a recibir de esa manera
            en PHP
        -->
        <br><br>
    <input  class="form-control" name="usuario" type="text" placeholder="Escribe tu nombre de usuario">
    <br><br>
    <input class="form-control" name="pass" type="password" placeholder="Contraseña">
    <br><br>
    <!--Lo siguiente envía el formulario-->
    <div class="d-grid gap-2">
    <input name="" id="" class="btn btn-success" type="submit" value="Iniciar">
    </div>
</form>
<br><br><br>
<center>
<p>¿Aún no estas registrado?
<a href="http://localhost/CarpinteriaGral/?controlador=Login&accion=registro">Registrate</a>.
</p>
</center>


<?php  
        
    }



    
  


?>


<script src="Herramientas/JS/navBar.js"></script>