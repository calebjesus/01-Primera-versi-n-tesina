<?php
include_once("conexion.php");
include_once("Modelo/Cliente.php");
Basededatos::CreateInstancia();

class ControladorCliente{

    
    public function inicio(){
        $Clientes=Cliente::mostrar();
        include_once("Vista/Cliente/inicio.php");
    }

        public function crear(){
            if($_POST){
                $NombreClien=$_POST['NombreClien'];
                $APClien=$_POST['APClien'];
                $AMClien=$_POST['AMClien'];
                $FechaNacimiento=$_POST['FechaNacimiento'];
                $Telefono=$_POST['Telefono'];
                $Direccion=$_POST['Direccion'];
                $CorreoElectronico=$_POST['CorreoElectronico'];
                $Contrasena=$_POST['Contrasena'];
                $rol=2;
                Cliente::crear(
                    $NombreClien, 
                    $APClien, 
                    $AMClien, 
                    $FechaNacimiento, 
                    $Telefono, 
                    $Direccion, 
                    $CorreoElectronico, 
                    $Contrasena,
                    $rol);

            }
            include_once("Vista/Cliente/crear.php");
        }
     
        public function editar(){
            if($_POST){
                $IdCliente=$_POST['IdCliente'];
                $NombreClien=$_POST['NombreClien'];
                $AMClien=$_POST['AMClien'];
                $APClien=$_POST['APClien'];
                $FechaNacimiento=$_POST['FechaNacimiento'];
                $Telefono=$_POST['Telefono'];
                $Direccion=$_POST['Direccion'];
                $CorreoElectronico=$_POST['CorreoElectronico'];
                $Contrasena=$_POST['Contrasena'];
                Cliente::editar($IdCliente,$NombreClien, $APClien, $AMClien, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico,$Contrasena);
            
            }
            $IdCliente=$_GET['IdCliente'];
            $Cliente=(Cliente::buscar($IdCliente));
            include_once("Vista/Cliente/editar.php");
        }


        public function borrar(){
            $IdCliente=$_GET['IdCliente'];
            Cliente::borrar($IdCliente);
            header("Location:./?controlador=Cliente&accion=inicio");
        }
}


?>