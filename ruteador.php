<?php

$controlador=$_GET['controlador'];



include_once("Controlador/controlador_".$controlador.".php");
$objControlador="Controlador".ucfirst($controlador);
$controlador= new $objControlador();
$controlador->$accion();

?>