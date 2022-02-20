<?php

class ApartadoP{

    public $FolioProd;
    public $NombreProd;
    public $Medidas;
    public $Categoria;
    public $Precio;
    public $Cantidad;
    public $Nombreimg;

    public function __construct($FolioProd, $NombreProd, $Medidas,$Categoria, $Precio, $Cantidad, $Nombreimg){
        $this->FolioProd=$FolioProd;
        $this->NombreProd=$NombreProd;
        $this->Medidas=$Medidas;
        $this->Categoria=$Categoria;
        $this->Precio=$Precio;
        $this->Cantidad=$Cantidad;
        $this->Nombreimg=$Nombreimg;
    }

    public static function mostrar(){
        $listaProd=[];
        $conexion=BasedeDatos::CreateInstancia();
        $sql= $conexion->query("SELECT * FROM catalogoProducto");
        foreach ($sql->fetchALL() as $prod) {
            $listaProd[]=new ApartadoP(
            $prod['FolioProd'],
            $prod['NombreProd'],
            $prod['Medidas'],
            $prod['Categoria'],
            $prod['Precio'],
            $prod['Cantidad'],
            $prod['Nombreimg']);
        }
        return $listaProd;
    }

}

?>