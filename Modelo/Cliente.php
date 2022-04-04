<?php
/*La clase cliente esta encarga de realizar las operaciones de la tabla cliente entre ellas el CRUD */
class Cliente{

    public $IdCliente;
    public $NombreClien;
    public $APClien;
    public $AMClien;
    public $FechaNacimiento;
    public $Telefono;
    public $Direccion;
    public $CorreoElectronico;
    public $Contrasena;
  
    public function __construct($IdCliente,$NombreClien, $APClien, $AMClien, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico, $Contrasena){
        $this->IdCliente=$IdCliente;
        $this->NombreClien=$NombreClien;
        $this->APClien=$APClien;
        $this->AMClien=$AMClien;
        $this->FechaNacimiento=$FechaNacimiento;
        $this->Telefono=$Telefono;
        $this->Direccion=$Direccion;
        $this->CorreoElectronico=$CorreoElectronico;
        $this->Contrasena=$Contrasena;

    }

    /*Muestra todos los datos de la tabla catalogoCliente */
    public static function mostrar(){
        $listaCliente=[];
        $conexion=BasedeDatos::CreateInstancia();
        $sql= $conexion->query("SELECT * FROM catalogoCliente");

        foreach ($sql->fetchALL() as $Cliente) {
            $listaCliente[]=new Cliente(
            $Cliente['IdCliente'],
            $Cliente['NombreClien'], 
            $Cliente['APClien'], 
            $Cliente['AMClien'],
            $Cliente['FechaNacimiento'],
            $Cliente['Telefono'],
            $Cliente['Direccion'],
            $Cliente['CorreoElectronico'], 
            $Cliente['Contrasena']);
        }
        return $listaCliente;
    }

    /*Ingresa información del cliente a la tabla correspondiente evaluado que el correo electronico no esta dado de alta */
    function crear($NombreClien, $APClien, $AMClien, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico, $Contrasena,$rol){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoCliente WHERE CorreoElectronico=?");
        $sql->execute(array($CorreoElectronico));   
        $Cliente=$sql->fetch();

        if( empty($Cliente['CorreoElectronico']) )
        {
            $sql= $conexion->prepare("INSERT into catalogoCliente(NombreClien,folio ,APClien, AMClien, FechaNacimiento, Telefono, Direccion, CorreoElectronico, Contrasena) values(?,?,?,?,?,?,?,?,?)");
            $sql->execute(array($NombreClien,$rol, $APClien, $AMClien, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico, $Contrasena));
            echo "<div class='container3'>
            <span class='estiloExito'>Registrado Exitoso de: $CorreoElectronico </span></div>";
        }else{
            echo "<div class='container2'><span class='estiloError'>$CorreoElectronico ya se encuentra Registrado</span></div>"; 
            return 1;
        }
    } 

    //Devuelve la edad dando una fecha de nacimiento
    function verifedad($FechaNacimiento){
        list($year,$month,$day) = explode("-",$FechaNacimiento);
        $DifYea  = date("Y") - $year;
        $DifMon  = date("m") - $month;
        $DifDay  = date("d") - $day;
        if ($DifDay< 0 || $DifMon < 0)
          $DifYea--;
        return $DifYea;
    }
    
    /*Elimina la información de la tabla catalogocliente por medio del id */
    public static function borrar($IdCliente){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM catalogoCliente WHERE IdCliente=?");
        $sql->execute(array($IdCliente));
    }

    /*Busca información de un cliente por medio de la llave primaria */
    public static function buscar($IdCliente){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoCliente WHERE IdCliente=?");
        $sql->execute(array($IdCliente));
        $Cliente=$sql->fetch();
        return new Cliente($Cliente['IdCliente'],$Cliente['NombreClien'], $Cliente['APClien'], $Cliente['AMClien'],$Cliente['FechaNacimiento'],$Cliente['Telefono'],$Cliente['Direccion'],$Cliente['CorreoElectronico'], $Cliente['Contrasena']);
    }

    /*Actualiza la información de un cliente por medio de su llave primaria */
    public static function editar($IdCliente,$NombreClien, $APClien, $AMClien, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico,$Contrasena){  
        $conexion=Basededatos::CreateInstancia();       
        $sql= $conexion->prepare("UPDATE  catalogoCliente SET NombreClien=?, APClien=?, AMClien=?, FechaNacimiento=?, Telefono=?, Direccion=?, CorreoElectronico=?,Contrasena=? WHERE IdCliente=?");
        $sql->execute(array($NombreClien, $APClien, $AMClien, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico,$Contrasena, $IdCliente));
        echo "<div class='container3'><span class='estiloExito'>Los datos se guardaron correctamente </span></div>";
    }

    /*Recolecta la información de la tabla citas identificada por la llave primaria de un cliente */
    public static function mostrar_citas(){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->query("SELECT folio_citas, correoelectronico, fecha_hora_cita, lugar_cita, asunto  
        from citas
        INNER JOIN Catalogocliente ON citas.IdCliente=Catalogocliente.IdCliente;");
        $res=[];

            foreach ($sql->fetchALL() as $prod) {
                $obj = new stdClass();
                $obj->folio_citas = $prod['folio_citas'];
                $obj->correoelectronico = $prod['correoelectronico'];
                $obj->fecha_hora_cita = $prod['fecha_hora_cita'];
                $obj->lugar_cita = $prod['lugar_cita'];
                $obj->asunto = $prod['asunto'];
                array_push($res, $obj);
            }
        return $res;   
    }

    /*Elimina las citas de la tabla citas por medio de la llave primaria de la tabla citas */
    public static function Eliminar_citas($folio_citas){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM citas WHERE folio_citas=?");
        $sql->execute(array($folio_citas));
    }

}

?>