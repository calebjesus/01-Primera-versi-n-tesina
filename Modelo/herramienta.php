<?php
/*La clase herramientas tiene la función de gestionar las operaciones de las herramientas esto incluye CRUD entre otras. */
class Herramientas{

    public $FolioHerra;
    public $NombreHerra;
    public $Cantidad;
    public $PrecioHerra;
    public $Especificaciones;


    public function __construct(
        $FolioHerra,
        $NombreHerra,
        $Cantidad,
        $PrecioHerra,
        $Especificaciones){

        $this->FolioHerra=$FolioHerra;
        $this->NombreHerra=$NombreHerra;
        $this->Cantidad=$Cantidad;
        $this->PrecioHerra=$PrecioHerra;
        $this->Especificaciones=$Especificaciones;
    }

    /*Busca a todos los datos de la tabla catalogoHerramienta enviandolos en un arreglo*/
    public static function mostrar(){
        $listaHerra=[];
        $conexion=BasedeDatos::CreateInstancia();
        $sql= $conexion->query("SELECT * FROM catalogoHerramienta");
        foreach ($sql->fetchALL() as $herra) {
            $listaHerra[]=new Herramientas(
            $herra['FolioHerra'],
            $herra['NombreHerra'],
            $herra['Cantidad'],
            $herra['PrecioHerra'],
            $herra['Especificaciones']);
        }
        return $listaHerra;
    }

    /*Ingresa la información en la tabla catalogoherramienta validando que el nombre no exista */
    function crear($NombreHerra, $Cantidad, $PrecioHerra, $Especificaciones){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoherramienta WHERE NombreHerra=?");
        $sql->execute(array($NombreHerra));
        $herra=$sql->fetch();

        if(empty($herra['NombreHerra']))
        {
            $sql= $conexion->prepare("INSERT into catalogoherramienta(NombreHerra, Cantidad, PrecioHerra, Especificaciones) values(?,?,?,?)");
            $sql->execute(array($NombreHerra, $Cantidad, $PrecioHerra, $Especificaciones));
            echo "<div class='container3'><span class='estiloExito'>Registrado Exitoso de: $NombreHerra </span></div>";
        }else{
            echo "<div class='container2'><span class='estiloError'>$NombreHerra ya se encuentra Registrado</span></div>";
            return 1;
        }
    }

    /*Busca en la tabla catalogoherramienta toda la información de la herramienta que tenga el mismo folio de entrada */
    public static function buscar($FolioHerra){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoherramienta WHERE FolioHerra=?");
        $sql->execute(array($FolioHerra));
        $herramienta=$sql->fetch();
        return new Herramientas(
        $herramienta['FolioHerra'],
        $herramienta['NombreHerra'], 
        $herramienta['Cantidad'], 
        $herramienta['PrecioHerra'],
        $herramienta['Especificaciones']);
    }

    /*Actualiza  la información de una tupla dependiendo si el folio corresponde*/
    public static function editar($FolioHerra,$NombreHerra, $Cantidad, $PrecioHerra, $Especificaciones){
        $conexion=Basededatos::CreateInstancia();           
        $sql= $conexion->prepare("UPDATE  catalogoherramienta SET NombreHerra=?, Cantidad=?, PrecioHerra=?, Especificaciones=? WHERE FolioHerra=?");
        $sql->execute(array($NombreHerra, $Cantidad, $PrecioHerra, $Especificaciones, $FolioHerra));
        echo "<div class='container3'><span class='estiloExito'>Los datos se guardaron correctamente </span></div>";
    }

    /*Elimina un registro dependiendo el folio de la herramienta */
    public static function borrar($FolioHerra){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM catalogoherramienta WHERE FolioHerra=?");
        $sql->execute(array($FolioHerra));
    }
    
    /*Actualiza la cantidad de la herramienta sumando está función  es utilizada para la prestación de herramientas*/
    public static function actualizar_sumar_cantidad($diferencia,$id_herramienta){
        $conexion=Basededatos::CreateInstancia();           
        $sql= $conexion->prepare("UPDATE  catalogoherramienta SET Cantidad=cantidad+? WHERE FolioHerra=?");
        $sql->execute(array($diferencia, $id_herramienta));
    }

    /*Actualiza la cantidad de la herramienta restandole está función  es utilizada para la prestación de herramientas*/
    public static function actualizar_restar_cantidad($diferencia,$id_herramienta){
        $conexion=Basededatos::CreateInstancia();           
        $sql= $conexion->prepare("UPDATE  catalogoherramienta SET Cantidad=cantidad-? WHERE FolioHerra=?");
        $sql->execute(array($diferencia, $id_herramienta));
    }

    /*Actualiza la cantidad de la herramienta solo reemplazandola está función  es utilizada para la prestación de herramientas*/
    public static function actualizar_remplazar_cantidad($diferencia,$id_herramienta){
        $conexion=Basededatos::CreateInstancia();           
        $sql= $conexion->prepare("UPDATE  catalogoherramienta SET Cantidad=? WHERE FolioHerra=?");
        $sql->execute(array($diferencia, $id_herramienta));
    }


}
?>