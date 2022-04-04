<?php
include_once("conexion.php");
include_once("Modelo/ClienteP.php");
Basededatos::CreateInstancia();


class ControladorClienteP{

    //ApartadoP es una función que permite a todo tipo de usuario ver el catálogo de productos
    public function apartadoP(){ 
        $prods=ApartadoP::mostrar(); 
        include_once("Vista/ClienteP/apartadoP.php");
    }

    public function sesion(){ 
   // include_once("Controlador/controlador_ReadC");
    //include_once("Vista/ClienteP/sesion.php");
    }

}
?>