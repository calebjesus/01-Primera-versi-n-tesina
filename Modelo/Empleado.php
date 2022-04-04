<?php
/*La clase empleado tiene la principal función de realizar las operaciones de CRUD  */
class Empleado{

    public $IdEmpleados;
    public $Nombre;
    public $APEmp;
    public $AMEmp;
    public $FechaNacimiento;
    public $Telefono;
    public $Direccion;
    public $CorreoElectronico;
    public $TipoEmpleado;

    public function __construct($IdEmpleados,$Nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico, $TipoEmpleado){
        $this->IdEmpleados=$IdEmpleados;
        $this->Nombre=$Nombre;
        $this->APEmp=$APEmp;
        $this->AMEmp=$AMEmp;
        $this->FechaNacimiento=$FechaNacimiento;
        $this->Telefono=$Telefono;
        $this->Direccion=$Direccion;
        $this->CorreoElectronico=$CorreoElectronico;
        $this->TipoEmpleado=$TipoEmpleado;

    }

    /*Muestra los todos los datos de la tabla catalogoempleado enviadolos en un arreglo */
    public static function mostrar(){
        $listaEmpleados=[];
        $conexion=BasedeDatos::CreateInstancia();
        $sql= $conexion->query("SELECT * FROM catalogoempleado");

        foreach ($sql->fetchALL() as $empleado) {
            $listaEmpleados[]=new Empleado(
            $empleado['IdEmpleados'],
            $empleado['Nombre'], 
            $empleado['APEmp'], 
            $empleado['AMEmp'],
            $empleado['FechaNacimiento'],
            $empleado['Telefono'],
            $empleado['Direccion'],
            $empleado['CorreoElectronico'], 
            $empleado['TipoEmpleado']);
        }
        return $listaEmpleados;
    }

    /*Ingresa la información a la tabla catalogoempleado evaluando que correo electronico no exista en la base de datos */
    function crear($nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico, $TipoEmpleado){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoempleado WHERE CorreoElectronico=?");
        $sql->execute(array($CorreoElectronico));
        $empleado=$sql->fetch();

        if( empty($empleado['CorreoElectronico'])){
                $sql= $conexion->prepare("INSERT into catalogoempleado(Nombre, APEmp, AMEmp, FechaNacimiento, Telefono, Direccion, CorreoElectronico, TipoEmpleado) values(?,?,?,?,?,?,?,?)");
                $sql->execute(array($nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico, $TipoEmpleado));
                echo "<div class='container3'>
                 <span class='estiloExito'>Registrado Exitoso de: $CorreoElectronico </span></div>";
        }else{
        echo "<div class='container2'><span class='estiloError'>$CorreoElectronico ya se encuentra Registrado</span></div>";
        return 1;
        }
    } 

    /*Elimina al empleado de acuerdo a su folio */
    public static function borrar($IdEmpleados){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM catalogoempleado WHERE IdEmpleados=?");
        $sql->execute(array($IdEmpleados));
    }

    /*Busca información en la tabla catalogoempleado de acuerdo a la llave primaria */
    public static function buscar($IdEmpleados){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoempleado WHERE IdEmpleados=?");
        $sql->execute(array($IdEmpleados));
        $empleado=$sql->fetch();
        return new Empleado($empleado['IdEmpleados'],$empleado['Nombre'], $empleado['APEmp'], $empleado['AMEmp'],$empleado['FechaNacimiento'],$empleado['Telefono'],$empleado['Direccion'],$empleado['CorreoElectronico'], $empleado['TipoEmpleado']);
    }

    /*Actualiza la información en la tabla catalogoempleado de acuerdo al folio del empleado */
    public static function editar($IdEmpleados,$nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico,$TipoEmpleado){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  catalogoempleado SET Nombre=?, APEmp=?, AMEmp=?, FechaNacimiento=?, Telefono=?, Direccion=?, CorreoElectronico=?,TipoEmpleado=? WHERE IdEmpleados=?");
        $sql->execute(array($nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico,$TipoEmpleado, $IdEmpleados));
        echo "<div class='container3'><span class='estiloExito'>Los datos se guardaron correctamente </span></div>";
    }

}

?>