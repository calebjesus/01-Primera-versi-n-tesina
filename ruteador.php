<?php
/*Redirecciona y añade la palabra controlador para ingresar a los archivos*/

$controlador=$_GET['controlador'];
include_once("Controlador/controlador_".$controlador.".php");
$objControlador="Controlador".ucfirst($controlador);
$controlador= new $objControlador();
$controlador->$accion();

?>