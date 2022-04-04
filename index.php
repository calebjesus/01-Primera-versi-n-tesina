<?php
/* Esto te lleva al controlador y a que paginas quieres abrir
 controlado -> Controlador_Paginas -> Paginas -> accion */
if(isset($_GET['controlador']) && isset($_GET['accion']) ){
    $controlador=$_GET['controlador'];
    $accion=$_GET['accion'];
}else{
    ?>
<script>
// Aqui obtienes solo: http://localhost/CarpinteriaGral/
console.log(window.location.href);
echo(window.location.href); 
//Añadimos el controlador y accion
window.history.replaceState({}, '', '?controlador=Principal&accion=mostrar');
// Aqui obtienes: http://localhost/CarpinteriaGral/?controlador=Principal&accion=inicio
console.log(window.location.href); 
//Recarga la pagina
window.location.reload(); 
</script>
<?php 
}
//llamada a la pagina principal
require_once("Vista/pagina_principal.php");
?>