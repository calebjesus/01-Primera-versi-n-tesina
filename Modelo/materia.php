<?php
/*La clase Materia tiene la principal función de realizar el CRUD para materia prima. */
class Materia{

    public $FolioMat;
    public $NombreMat;
    public $NombreSuc;
    public $MedidasMat;
    public $TipoMadera;
    public $CantidadMat;
    public $PrecioMat;

    public function __construct(
        $FolioMat,
        $NombreMat,
        $NombreSuc,
        $MedidasMat,
        $TipoMadera,
        $CantidadMat,
        $PrecioMat){

        $this->FolioMat=$FolioMat;
        $this->NombreMat=$NombreMat;
        $this->NombreSuc=$NombreSuc;
        $this->MedidasMat=$MedidasMat;
        $this->TipoMadera=$TipoMadera;
        $this->CantidadMat=$CantidadMat;
        $this->PrecioMat=$PrecioMat;
        
    }

    /*Busca todos los datos de la tabla catalogoMateriaPrima */
    public static function mostrar(){
        $listaMateria=[];
        $conexion=BasedeDatos::CreateInstancia();
        $sql= $conexion->query("SELECT * FROM catalogoMateriaPrima");
        foreach ($sql->fetchALL() as $materia) {
            $listaMateria[]=new Materia(
            $materia['FolioMat'],
            $materia['NombreMat'],
            $materia['NombreSuc'],
            $materia['MedidasMat'],
            $materia['TipoMadera'],
            $materia['CantidadMat'],
            $materia['PrecioMat']);
        }
        return $listaMateria;
    }
     
    /*Ingresa los datos de la materia prima validando que tanto el nombre y la suscursal no sean iguales y devolviendo mensajes de exito o error */
    public static function crear($NombreMat, $NombreSuc, $MedidasMat, $TipoMadera,$CantidadMat,$PrecioMat){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogomateriaprima WHERE NombreMat=? && NombreSuc=?");
        $sql->execute(array($NombreMat, $NombreSuc));
        $materia=$sql->fetch();

        if( empty($materia['NombreMat'])   &&  empty($materia['NombreSuc']) )
        {
        $sql= $conexion->prepare("INSERT into catalogomateriaprima(NombreMat, NombreSuc, MedidasMat, TipoMadera,CantidadMat,PrecioMat) values(?,?,?,?,?,?)");
        $sql->execute(array($NombreMat, $NombreSuc, $MedidasMat, $TipoMadera,$CantidadMat ,$PrecioMat ));
        echo "<div class='container3'>
        <span class='estiloExito'>Registrado Exitoso de: $NombreMat </span></div>";
        }else{
        echo "<div class='container2'><span class='estiloError'>$NombreMat ya se encuentra Registrado</span></div>";
        return 1;
        }
    }

    /*busca a una materia prima por su folio */
    public static function buscar($FolioMat){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogomateriaprima WHERE FolioMat=?");
        $sql->execute(array($FolioMat));
        $materia=$sql->fetch();
        return new Materia(
        $materia['FolioMat'],
        $materia['NombreMat'], 
        $materia['NombreSuc'], 
        $materia['MedidasMat'],
        $materia['TipoMadera'],
        $materia['CantidadMat'],
        $materia['PrecioMat']);
    }

    /*Actualiza la tabla de catalogo materia prima */
    public static function editar($FolioMat,$NombreMat, $NombreSuc, $MedidasMat, $TipoMadera,$CantidadMat,$PrecioMat){  
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  catalogomateriaprima SET  NombreMat=?, NombreSuc=?, MedidasMat=?, TipoMadera=?, CantidadMat=?, PrecioMat=? WHERE FolioMat=?");
        $sql->execute(array($NombreMat, $NombreSuc, $MedidasMat, $TipoMadera,$CantidadMat,$PrecioMat, $FolioMat));
        echo "<div class='container3'>
        <span class='estiloExito'>Actualización Exitosa </span></div>";
    }

    /*Elimina a una materia prima por su folio */
    public static function borrar($FolioMat){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM catalogomateriaprima WHERE FolioMat=?");
        $sql->execute(array($FolioMat));
    }

}
?>