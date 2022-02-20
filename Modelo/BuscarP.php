<?php

class BuscarP{

    public $NombreProd;
    public $Medidas;
    public $Precio;
    public $Cantidad;
    public $idCarritoTemporal;

  

    public function __construct($idCarritoTemporal,$NombreProd,$Medidas, $Precio, $Cantidad){
        $this->idCarritoTemporal=$idCarritoTemporal;
        $this->NombreProd=$NombreProd;
        $this->Medidas=$Medidas;
        $this->Precio=$Precio;
        $this->Cantidad=$Cantidad;
    }


public static function buscarP($IdCliente){
    $listaprod=[];
     $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT idCarritoTemporal,NombreProd,Medidas,(Precio*CarritoTemporal.Cantidad) as Precio ,CarritoTemporal.Cantidad from carritotemporal   
        INNER JOIN Catalogocliente ON carritotemporal.IdCliente=Catalogocliente.IdCliente  
        INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd =carritotemporal.FolioProd
        where carritotemporal.IdCliente= ? and Estatus= 1");

        $sql->execute(array($IdCliente));

        foreach ($sql->fetchALL() as $prod) {
        $listaprod[] = new BuscarP(
            $prod['idCarritoTemporal'],
            $prod['NombreProd'], 
            $prod['Medidas'], 
            $prod['Precio'],
            $prod['Cantidad']);   
        }

        return $listaprod;
    }
}
?>