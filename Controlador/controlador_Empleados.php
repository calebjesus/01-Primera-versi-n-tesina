<?php
include_once("conexion.php");
include_once("Modelo/Empleado.php");
Basededatos::CreateInstancia();

class ControladorEmpleados{

    
    public function inicio(){
        $empleados=Empleado::mostrar();
        include_once("Vista/Empleados/inicio.php");
    }

        public function crear(){
            if($_POST){
                    $nombre=$_POST['nombre'];
                    $APEmp=$_POST['APEmp'];
                    $AMEmp=$_POST['AMEmp'];
                    $FechaNacimiento=$_POST['FechaNacimiento'];
                    $Telefono=$_POST['Telefono'];
                    $Direccion=$_POST['Direccion'];
                    $CorreoElectronico=$_POST['CorreoElectronico'];
                    $TipoEmpleado=$_POST['TipoEmpleado'];
                    Empleado::crear($nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico, $TipoEmpleado);

                }
                include_once("Vista/Empleados/crear.php");
        }
     
             public function editar(){
                if($_POST){
                    $IdEmpleados=$_POST['IdEmpleados'];
                    $Nombre=$_POST['Nombre'];
                    $AMEmp=$_POST['AMEmp'];
                    $APEmp=$_POST['APEmp'];
                    $FechaNacimiento=$_POST['FechaNacimiento'];
                    $Telefono=$_POST['Telefono'];
                    $Direccion=$_POST['Direccion'];
                    $CorreoElectronico=$_POST['CorreoElectronico'];
                    $TipoEmpleado=$_POST['TipoEmpleado'];
                    Empleado::editar($IdEmpleados,$Nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico,$TipoEmpleado);
                    

                }
                $IdEmpleados=$_GET['IdEmpleados'];
                $empleado=(Empleado::buscar($IdEmpleados));
                include_once("Vista/Empleados/editar.php");
             }


                public function borrar(){
                $IdEmpleados=$_GET['IdEmpleados'];
                Empleado::borrar($IdEmpleados);
                header("Location:./?controlador=empleados&accion=inicio");
                }





}


?>