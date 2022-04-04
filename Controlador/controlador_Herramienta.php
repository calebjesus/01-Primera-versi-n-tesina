<?php
include_once("conexion.php");
include_once("Modelo/herramienta.php");
Basededatos::CreateInstancia();


class ControladorHerramienta{
    //Muestra las herramientas que estan en la base de datos
    public function inicio(){ 
        $herramientas=Herramientas::mostrar(); 
        include_once("Vista/herramienta/inicio.php");
    }

    //Recibe y envía los datos a modelo para registar una herramienta
    public function crear(){
        if($_POST){
                $NombreHerra=$_POST['NombreHerra'];
                $Cantidad=$_POST['Cantidad'];
                $PrecioHerra=$_POST['PrecioHerra'];
                $Especificaciones=$_POST['Especificaciones'];

                if(Herramientas::crear(
                    $NombreHerra, 
                    $Cantidad, 
                    $PrecioHerra, 
                    $Especificaciones)!=1){
                        $_POST['NombreHerra']=null;
                        $_POST['Cantidad']=null;
                        $_POST['PrecioHerra']=null;
                        $_POST['Especificaciones']=null;
                    }

        }
        include_once("Vista/herramienta/crear.php");
    }

    //Recibe y envía los datos a modelo para editar una herramienta
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

    //Recibe el folio de la herramienta a eliminar enviando los datos al modelo
    public function borrar(){
            $FolioHerra=$_GET['FolioHerra'];
            Herramientas::borrar($FolioHerra);
            header("Location:./?controlador=herramienta&accion=inicio");
    }

}
?>