<?php
include_once("conexion.php");
include_once("Modelo/herramienta.php");
Basededatos::CreateInstancia();


class ControladorHerramienta{

    public function inicio(){ 
        $herramientas=Herramientas::mostrar(); 
        include_once("Vista/herramienta/inicio.php");
    }

    public function crear(){
        if($_POST){
                $NombreHerra=$_POST['NombreHerra'];
                $Cantidad=$_POST['Cantidad'];
                $PrecioHerra=$_POST['PrecioHerra'];
                $Especificaciones=$_POST['Especificaciones'];
                Herramientas::crear(
                    $NombreHerra, 
                    $Cantidad, 
                    $PrecioHerra, 
                    $Especificaciones);

            }
            include_once("Vista/herramienta/crear.php");
    }

    public function editar(){
            if($_POST){
                $FolioHerra=$_POST['FolioHerra'];
                $NombreHerra=$_POST['NombreHerra'];
                $Cantidad=$_POST['Cantidad'];
                $PrecioHerra=$_POST['PrecioHerra'];
                $Especificaciones=$_POST['Especificaciones'];
                Herramientas::editar($FolioHerra,$NombreHerra, $Cantidad, $PrecioHerra, $Especificaciones);
            }
            $FolioHerra=$_GET['FolioHerra'];
            $herramienta=(Herramientas::buscar($FolioHerra));
            include_once("Vista/herramienta/editar.php");
    }

    public function borrar(){
            $FolioHerra=$_GET['FolioHerra'];
            Herramientas::borrar($FolioHerra);
            header("Location:./?controlador=herramienta&accion=inicio");
    }

}
?>