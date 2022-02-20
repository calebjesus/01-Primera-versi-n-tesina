<?php

class Producto{

    public $FolioProd;
    public $NombreProd;
    public $Medidas;
    public $Categoria;
    public $Precio;
    public $Cantidad;
    public $Nombreimg;

    public function __construct($FolioProd, $NombreProd, $Medidas,$Categoria, $Precio, $Cantidad,$Nombreimg){
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
            $listaProd[]=new Producto(
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
    
    public static function crear($NombreProd, $Medidas, $Categoria, $Precio, $Cantidad,$Nombreimg){
        $conexion=Basededatos::CreateInstancia();

        $sql= $conexion->prepare("SELECT * FROM catalogoProducto WHERE NombreProd=?");
        $sql->execute(array($NombreProd));   
        $prod=$sql->fetch();
        
        if( empty($prod['NombreProd']) )
        {
            $sql= $conexion->prepare("INSERT into catalogoProducto(
                NombreProd, 
                Medidas, 
                Categoria,
                Precio, 
                Cantidad,
                Nombreimg) 
                values(?,?,?,?,?,?)");
             $sql->execute(array($NombreProd, $Medidas, $Categoria, $Precio, $Cantidad,$Nombreimg));
            echo "<div class='container3'><span class='estiloExito'>Registrado Exitoso de: $NombreProd </span></div>";
            
        }else{

            echo "<div class='container2'><span class='estiloError'>$NombreProd ya se encuentra Registrado</span></div>";
        
        }
    } 

    public static function borrar($FolioProd){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM catalogoProducto WHERE FolioProd=?");
        $sql->execute(array($FolioProd));
    
    }

    public static function buscar($FolioProd){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoProducto WHERE FolioProd=?");
        $sql->execute(array($FolioProd));
        $prod=$sql->fetch();
        return new Producto(
            $prod['FolioProd'],
            $prod['NombreProd'], 
            $prod['Medidas'], 
            $prod['Categoria'],
            $prod['Precio'],
            $prod['Cantidad'],
            $prod['Nombreimg']);
    }

    public static function buscarImg($Nombreimg){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoProducto WHERE Nombreimg=?");
        $sql->execute(array($Nombreimg));
        $prod=$sql->fetch();
        


        if( empty($prod['Nombreimg']) )
        {

           return true;
        }else{

            return false;
        }

    

    }

    public static function editar($FolioProd,$NombreProd, $Medidas, $Categoria, $Precio,$Cantidad,$Nombreimg){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  catalogoProducto SET NombreProd=?, Medidas=?, Categoria=?,Precio=?,Cantidad=?, Nombreimg=? WHERE FolioProd=?");
        $sql->execute(array($NombreProd, $Medidas, $Categoria, $Precio,$Cantidad,$Nombreimg, $FolioProd));
        echo "<div class='container3'>
        <span class='estiloExito'>Los datos se guardaron correctamente </span></div>";
    }

    public static function mostrar_materia_prima(){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->query("SELECT foliomat, nombremat, nombresuc, preciomat
        from catalogomateriaprima;");
        $res=[];
            foreach ($sql->fetchALL() as $prod){
                $obj = new stdClass();
                $obj->foliomat = $prod['foliomat'];
                $obj->nombremat = $prod['nombremat'];
                $obj->nombresuc = $prod['nombresuc'];
                $obj->preciomat = $prod['preciomat'];
                array_push($res, $obj);
            }
    return $res;  
    }

    public static function insertar_isumo($folio_materia_prima,$folio_producto,$cantidad){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("INSERT into insumo(
                FolioProd, 
                FolioMat,
                Cantidad) 
                values(?,?,?)");
             $sql->execute(array($folio_producto, $folio_materia_prima, $cantidad));
    }

    public static function mostrar_insumo($folio_producto){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("SELECT folioinsumo, nombremat, preciomat, insumo.cantidad as cantidadt
            from insumo
            INNER JOIN Catalogomateriaprima ON Catalogomateriaprima.FolioMat = insumo.FolioMat
            where FolioProd=?");
            $sql->execute(array($folio_producto));
            $res=[];
            foreach ($sql->fetchALL() as $prod){
                    $obj = new stdClass();
                    $obj->folioinsumo = $prod['folioinsumo'];
                    $obj->nombremat = $prod['nombremat'];
                    $obj->preciomat = $prod['preciomat'];
                    $obj->cantidadt = $prod['cantidadt'];
                    array_push($res, $obj);
                }
                return $res;    
                
    }

    public static function eliminar_insumo($folio_producto){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM insumo WHERE folioinsumo=?");
        $sql->execute(array($folio_producto));
        
    }

    public static function entrega_productos(){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->query("SELECT FolioApartado, correoelectronico, fecha, fechavencimiento, preciototal
            from apartado
            INNER JOIN Catalogocliente ON Catalogocliente.Idcliente = apartado.Idcliente
            where estado=1
            order by fechavencimiento;");
           
            
            $res=[];
                
                foreach ($sql->fetchALL() as $prod) {
                    $obj = new stdClass();
                    $obj->FolioApartado = $prod['FolioApartado'];
                    $obj->correoelectronico = $prod['correoelectronico'];
                    $obj->fecha = $prod['fecha'];
                    $obj->fechavencimiento = $prod['fechavencimiento'];
                    $obj->preciototal = $prod['preciototal'];
                    array_push($res, $obj);
                }
        return $res;   
    }

    public static function producto_entregado($FolioApartado){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  apartado SET estado=0 WHERE FolioApartado=?");
        $sql->execute(array($FolioApartado));
    }

}

?>