<?php
include_once("conexion.php");
include_once("Modelo/Empleado.php");
include_once("Modelo/cliente.php");
include_once("Modelo/administrador.php");
Basededatos::CreateInstancia();

class ControladorEmpleados{

    //Muestra los datos que hay en la base de datos 
    public function inicio(){
        $empleados=Empleado::mostrar();
        include_once("Vista/Empleados/inicio.php");
    }

    //Recibe y envía los datos del empleado al modelo para realizar el registro
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
            
            if(empty($TipoEmpleado)){
                echo('
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    ¡Selecciona un tipo de empleado!
                    </div>
                    </div>');
            }else{
                if(Cliente::verifedad($FechaNacimiento)<=17){
                    echo('
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    ¡Necesitas ser mayor de edad!
                    </div>
                    </div>');
                }else{
                    if(Empleado::crear($nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico, $TipoEmpleado)!=1){
                        $_POST['nombre']=null;
                        $_POST['APEmp']=null;
                        $_POST['AMEmp']=null;
                        $_POST['FechaNacimiento']=null;
                        $_POST['Telefono']=null;
                        $_POST['Direccion']=null;
                        $_POST['CorreoElectronico']=null;
                        $_POST['TipoEmpleado']=null;
                    }
                }
            }
        }
            include_once("Vista/Empleados/crear.php");
    }
     
    //Recibe y envía los datos del empleado al modelo para editar el registro
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
            if(Administrador::verificar_correo_folio('catalogoempleado',$CorreoElectronico,'IdEmpleados',$IdEmpleados)==1){
                echo('
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                ¡Ya está registrado el correo, intenta con otro!
                </div>
                </div>');
            }else{
                Empleado::editar($IdEmpleados,$Nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico,$TipoEmpleado);
            }
        }
        $IdEmpleados=$_GET['IdEmpleados'];
        $empleado=(Empleado::buscar($IdEmpleados));
        include_once("Vista/Empleados/editar.php");
    }

    //Recibe el id del empleado para eliminarlo
    public function borrar(){
    $IdEmpleados=$_GET['IdEmpleados'];
    Empleado::borrar($IdEmpleados);
    header("Location:./?controlador=empleados&accion=inicio");
    }





}


?>