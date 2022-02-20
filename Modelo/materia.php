<?php

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
     
    public static function crear($NombreMat, $NombreSuc, $MedidasMat, $TipoMadera,$CantidadMat,$PrecioMat){
        
        $conexion=Basededatos::CreateInstancia();
        
        $sql= $conexion->prepare("SELECT * FROM catalogomateriaprima WHERE NombreMat=? && NombreSuc=?");
        $sql->execute(array($NombreMat, $NombreSuc));
        $materia=$sql->fetch();

        if((strcmp ($NombreMat , $materia['NombreMat']) == 0) && (strcmp ($NombreSuc , $materia['NombreSuc']) == 0))
        {
            echo "<div class='container2'><span class='estiloError'>$NombreMat ya se encuentra Registrado</span></div>";
        }else{
        $sql= $conexion->prepare("INSERT into catalogomateriaprima(NombreMat, NombreSuc, MedidasMat, TipoMadera,CantidadMat,PrecioMat) values(?,?,?,?,?,?)");
        $sql->execute(array($NombreMat, $NombreSuc, $MedidasMat, $TipoMadera,$CantidadMat ,$PrecioMat ));
        echo "<div class='container3'>
        <span class='estiloExito'>Registrado Exitoso de: $NombreMat </span></div>";
    }
    }

    public static function buscar($FolioMat){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogomateriaprima WHERE FolioMat=?");
        $sql->execute(array($FolioMat));
        $materia=$sql->fetch();
        return new Materia(
        $materia['FolioMat'],
        $materia['FolioAdmin'],
        $materia['NombreMat'], 
        $materia['NombreSuc'], 
        $materia['MedidasMat'],
        $materia['TipoMadera'],
        $materia['CantidadMat'],
        $materia['PrecioMat']);
    }

    public static function editar($FolioMat,$NombreMat, $NombreSuc, $MedidasMat, $TipoMadera,$CantidadMat,$PrecioMat){
        
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  catalogomateriaprima SET  NombreMat=?, NombreSuc=?, MedidasMat=?, TipoMadera=?, CantidadMat=?, PrecioMat=? WHERE FolioMat=?");
        $sql->execute(array($NombreMat, $NombreSuc, $MedidasMat, $TipoMadera,$CantidadMat,$PrecioMat, $FolioMat));
        echo "<div class='container3'>
        <span class='estiloExito'>Actualización Exitosa </span></div>";
    }

    public static function borrar($FolioMat){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM catalogomateriaprima WHERE FolioMat=?");
        $sql->execute(array($FolioMat));
    }

}
?>