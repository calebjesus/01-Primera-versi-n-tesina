<?php

include_once("Modelo/Administrador.php");
include_once("conexion.php");
Basededatos::CreateInstancia();

class ControladorPrincipal{

    //Muesta la página principal
    public function inicio(){
        include_once("Vista/pagina_principal.php");
    }
    //Muestra la página de inicio donde todos los usuarios la pueden ver
    public function mostrar(){
        $inicio=Administrador::informacion_inicio();
        include_once("Vista/inicio.php");
    }


 
}


?>