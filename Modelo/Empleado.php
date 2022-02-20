<?php

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


    public static function crear($nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico, $TipoEmpleado){
        $conexion=Basededatos::CreateInstancia();

        $sql= $conexion->prepare("SELECT * FROM catalogoempleado WHERE CorreoElectronico=?");
        $sql->execute(array($CorreoElectronico));
    
        $empleado=$sql->fetch();

        
        if(strcmp ($CorreoElectronico , $empleado['CorreoElectronico'] ) == 0)
        {
            echo "<div class='container2'><span class='estiloError'>$CorreoElectronico ya se encuentra Registrado</span></div>";
        }else{

        $sql= $conexion->prepare("INSERT into catalogoempleado(Nombre, APEmp, AMEmp, FechaNacimiento, Telefono, Direccion, CorreoElectronico, TipoEmpleado) values(?,?,?,?,?,?,?,?)");
        $sql->execute(array($nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico, $TipoEmpleado));
        echo "<div class='container3'>
        <span class='estiloExito'>Registrado Exitoso de: $CorreoElectronico </span></div>";
    }
    } 


    public static function borrar($IdEmpleados){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM catalogoempleado WHERE IdEmpleados=?");
        $sql->execute(array($IdEmpleados));
    
    }

    public static function buscar($IdEmpleados){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoempleado WHERE IdEmpleados=?");
        $sql->execute(array($IdEmpleados));
        $empleado=$sql->fetch();
        return new Empleado($empleado['IdEmpleados'],$empleado['Nombre'], $empleado['APEmp'], $empleado['AMEmp'],$empleado['FechaNacimiento'],$empleado['Telefono'],$empleado['Direccion'],$empleado['CorreoElectronico'], $empleado['TipoEmpleado']);
    }

    public static function editar($IdEmpleados,$nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico,$TipoEmpleado){
        
        $conexion=Basededatos::CreateInstancia(); 
        
        $sql= $conexion->prepare("UPDATE  catalogoempleado SET Nombre=?, APEmp=?, AMEmp=?, FechaNacimiento=?, Telefono=?, Direccion=?, CorreoElectronico=?,TipoEmpleado=? WHERE IdEmpleados=?");
        $sql->execute(array($nombre, $APEmp, $AMEmp, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico,$TipoEmpleado, $IdEmpleados));
        echo "<div class='container3'><span class='estiloExito'>Los datos se guardaron correctamente </span></div>";
    
    

    }

}

?>