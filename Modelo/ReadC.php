<?php

class ReadC{

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
    
/*Buscar identifica a todos los clientes y los muestra en la interfaz.*/
    public static function buscar($IdCliente){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoCliente WHERE IdCliente=?");
        $sql->execute(array($IdCliente));
        $Cliente=$sql->fetch();
        return new ReadC(
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
/*Editar tiene la instruccuion de recibir los datos que se van a actualizar junto con la llave
primaria del cliente.*/
    public static function editar($Telefono, $Direccion,$Contrasena,$IdCliente){
        $conexion=Basededatos::CreateInstancia();       
        $sql= $conexion->prepare("UPDATE  catalogoCliente 
        SET  
        Telefono=?,Direccion=?,Contrasena=? WHERE IdCliente=?");
        $sql->execute(array($Telefono, $Direccion,$Contrasena,$IdCliente));
        echo "<div class='container3'><span class='estiloExito'>Los datos se guardaron correctamente 
        </span></div>";
    }
/*Crear carrito inserta valores a la tabla de carrito recibiendo el folio del producto y de cliente.*/
    public static function crearCarritoTemporal($FolioProd, $IdCliente){
        $cantidad=1;
        $estatus=1;
        $conexion=Basededatos::CreateInstancia();
        //Verificar la existencia de un producto
        $sql2= $conexion->prepare("SELECT * FROM carritotemporal WHERE FolioProd=? and  IdCliente=? and Estatus = 1;");
        $sql2->execute(array($FolioProd,$IdCliente));   
        $prod2=$sql2->fetch();
        $idCarrito=$prod2['idCarritoTemporal'];

        //Ver cantidad
        $sql= $conexion->prepare("SELECT * FROM catalogoProducto WHERE FolioProd=?");
        $sql->execute(array($FolioProd));   
        $prod=$sql->fetch();


        if( empty($prod2['idCarritoTemporal']) ){
            if($prod['Cantidad']>=1){
                $sql= $conexion->prepare("INSERT INTO CarritoTemporal(
                    IdCliente, 
                    FolioProd,
                    Cantidad, 
                    Estatus)
                    values(?,?,?,?)");
                 $sql->execute(array($IdCliente,$FolioProd,$cantidad, $estatus));
            }else{
                echo "<div class='container2'><span class='estiloError'> ya no hay productos</span></div>";
            }
        }else{
            $sql= $conexion->prepare("UPDATE  carritotemporal SET Cantidad=(Cantidad+1) WHERE idCarritoTemporal=?;");
            $sql->execute(array($idCarrito));
            
        }



        
    }
/*La función editarC edita la cantidad de la tabla carrito recibiendo el folio y la cantidaa nueva.*/
    public static function editarC($folioC,$CantidadMat){
    
        $conexion=Basededatos::CreateInstancia(); 
        
        $sql= $conexion->prepare("UPDATE  carritotemporal SET Cantidad=? WHERE idCarritoTemporal=?;");
        $sql->execute(array($CantidadMat,$folioC));
        echo "<div class='container3'>
        <span class='estiloExito'>Actualización exitosa </span></div>";
        
    }
/*Elimina la tupla de la tabla carrito junto recibiendo el folio de esta misma. */
    public static function Eliminar($folioC){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM carritotemporal WHERE idCarritoTemporal=?");
        $sql->execute(array($folioC));
        echo "<div class='container2'>
        <span class='estiloError'>Eliminación exitosa </span></div>";
    }
/*Búsqueda del precio total realiza la suma del precio de todas las tuplas que tengan al mismo cliente.*/
    public static function busquedaPrecioTotal($IdCliente){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT  sum(carritotemporal.cantidad*Catalogoproducto.Precio) as precioTotal
        from carritotemporal
        INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd =carritotemporal.FolioProd
        where carritotemporal.IdCliente=? and Estatus=1;");
        $sql->execute(array($IdCliente));
        $prod=$sql->fetch();

            return $prod['precioTotal'];  
    }






    public static function insertar_apartado($PrecioTotal,$IdCliente){
        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Mexico_City");
        setlocale(LC_TIME, 'spanish');    
        $fecha_actual=date('Y-m-d');                      
        $fecha_vencimiento=date("Y-m-d",strtotime($fecha_actual."+ 10 days"));
        $estado=1;
        //insertar en tabla apartado
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("INSERT into Apartado(
            IdCliente,
            Fecha, 
            FechaVencimiento, 
            PrecioTotal,
            estado) 
            values(?,?,?,?,?)");
        $sql->execute(array($IdCliente, $fecha_actual, $fecha_vencimiento, $PrecioTotal,$estado));
            
        //busqueda del folio de la tabla apartado
        $conexion2=Basededatos::CreateInstancia();
            $sql2= $conexion2->prepare("SELECT max(FolioApartado) as folio
            from Apartado
            where IdCliente=? and fecha=? and fechavencimiento=? and preciototal=?");
            $sql2->execute(array($IdCliente,$fecha_actual,$fecha_vencimiento,$PrecioTotal));
            $prod=$sql2->fetch();

            return $prod['folio'];  


    }

    public static function insertar_apartado_producto($IdCliente,$folio_apartado){
        
        $conexion=Basededatos::CreateInstancia();
        
        $sql= $conexion->prepare("SELECT idCarritoTemporal, carritotemporal.folioprod, carritotemporal.cantidad, Catalogoproducto.precio
        from carritotemporal
        INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd = carritotemporal.FolioProd
        where IdCliente=? and estatus=1;");
        $sql->execute(array($IdCliente));
        foreach ($sql->fetchALL() as $prod) {
                $sql2= $conexion->prepare("INSERT into ApartadoProducto(
                    FolioProd,
                    FolioApartado, 
                    Cantidad, 
                    PrecioTotal) 
                    values(?,?,?,?)");
                $sql2->execute(array($prod['folioprod'], $folio_apartado, $prod['cantidad'], $prod['precio']));
                //Eliminar del carrito temporal
                $sql= $conexion->prepare("DELETE FROM carritotemporal WHERE idCarritoTemporal=?");
                $sql->execute(array($prod['idCarritoTemporal']));
            }
    }

    public static function crear_cita($fecha_hora,$asunto,$lugar_cita,$IdCliente){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("INSERT into Citas(
                IdCliente, 
                fecha_hora_cita, 
                lugar_cita,
                asunto) 
                values(?,?,?,?)");
            $sql->execute(array($IdCliente, $fecha_hora, $lugar_cita, $asunto));
            
    }
    
    public static function fechas_ocupadas(){
        
        $conexion=BasedeDatos::CreateInstancia();
        $sql= $conexion->query("SELECT fecha_hora_cita from citas");
            $lista_fechas=[];
            foreach ($sql->fetchALL() as $prod){
                array_push($lista_fechas, '"'.$prod['fecha_hora_cita'].'",'  );
                }
        return $lista_fechas;

    }

    public static function buscarP($IdCliente){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("SELECT idCarritotemporal, NombreProd,Medidas,(Precio*CarritoTemporal.Cantidad) as Precio ,CarritoTemporal.Cantidad from carritotemporal   
            INNER JOIN Catalogocliente ON carritotemporal.IdCliente=Catalogocliente.IdCliente  
            INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd =carritotemporal.FolioProd
            where carritotemporal.IdCliente=? and Estatus=1;");
            $sql->execute(array($IdCliente));
            $prod=$sql->fetch();
            $res=[];
                for ($x = 0; $x < count($prod); $x++) {
                    $obj = new stdClass();
                    $obj->idCarritotemporal = $prod['idCarritotemporal'];
                    $obj->NombreProd = $prod['NombreProd'];
                    $obj->Medidas = $prod['Medidas'];
                    $obj->Precio = $prod['Precio'];
                    $obj->Cantidad = $prod['Cantidad'];
                    array_push($res, $obj);
                }
                return $res;    
    }   

    public static function control_cita($IdCliente){

        $conexion2=Basededatos::CreateInstancia();
        $sql2= $conexion2->prepare("select * from citas where IdCliente=?");
        $sql2->execute(array($IdCliente));
        $clien=$sql2->fetch(PDO::FETCH_NUM);

        if($clien == true){

            return 1;
            echo("ya pidio una cita");
        }else{
            return 0;
            echo("no pidio una cita ");
        }
        
    }

    public static function eliminar_cita($IdCliente){

        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Mexico_City");
        setlocale(LC_TIME, 'spanish');   
        $fecha_actual = date("Y-m-d"); 

        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT fecha_hora_cita from citas where IdCliente = ?");
        $sql->execute(array($IdCliente));
        $prod=$sql->fetch();
        $fecha_anterior = date("Y-m-d", strtotime($prod['fecha_hora_cita']));

        
        

        if($fecha_actual > $fecha_anterior){         
  
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM citas WHERE IdCliente=?");
        $sql->execute(array($IdCliente));
        }

    }

    public static function buscar_productos_apartado($IdCliente){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("SELECT FolioApartado, Fecha, FechaVencimiento, PrecioTotal
            from apartado
            where IdCliente = ?");
            $sql->execute(array($IdCliente));
            //$prod=$sql->fetch();
            $res=[];
                //for ($x = 0; $x < count($prod); $x++) {
                foreach ($sql->fetchALL() as $prod) {
                    $obj = new stdClass();
                    $obj->FolioApartado = $prod['FolioApartado'];
                    $obj->Fecha = $prod['Fecha'];
                    $obj->FechaVencimiento = $prod['FechaVencimiento'];
                    $obj->PrecioTotal = $prod['PrecioTotal'];
                    array_push($res, $obj);
                }
        return $res;   
    }
    
    public static function apartado_producto_detalles($salida){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("SELECT NombreProd, apartadoproducto.Cantidad, PrecioTotal 
            from apartadoproducto
            INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd = apartadoproducto.FolioProd
            where folioApartado = ?");
            $sql->execute(array($salida));
            $res=[];
                foreach ($sql->fetchALL() as $prod) {
                    $obj = new stdClass();
                    $obj->NombreProd = $prod['NombreProd'];
                    $obj->Cantidad = $prod['Cantidad'];
                    $obj->PrecioTotal = $prod['PrecioTotal'];
                    array_push($res, $obj);
                }
        return $res;   
    }

    public static function datos_cita($IdCliente){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("SELECT * from citas where IdCliente=?");
            $sql->execute(array($IdCliente));
            $prod=$sql->fetch();
            $res=[];
                //for ($x = 0; $x < count($prod); $x++) {
                
                    $obj = new stdClass();
                    
                    $obj->fecha_hora_cita = $prod['fecha_hora_cita'];
                    $obj->lugar_cita = $prod['lugar_cita'];
                    $obj->asunto = $prod['asunto'];
                    array_push($res,$prod['fecha_hora_cita'],$prod['lugar_cita'],$prod['asunto']);
                
        return $res;   
        

    } 

    public static function verificar_cantidad($IdCliente){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("SELECT nombreprod, catalogoproducto.cantidad as cantidad_dispobible, 
            if(carritotemporal.Cantidad>catalogoproducto.cantidad,1,0)  as validacion 
            from carritotemporal
            INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd =carritotemporal.FolioProd
            where IdCliente = ?");
            $sql->execute(array($IdCliente));
           
            $res=[];
                
                foreach ($sql->fetchALL() as $prod) {
                    //validar la cantidad
                    $obj = new stdClass();
                    $obj->nombreprod = $prod['nombreprod'];
                    $obj->cantidad_dispobible = $prod['cantidad_dispobible'];
                    $obj->validacion = $prod['validacion'];
                    array_push($res, $obj);

                    if($prod['validacion'] == 1 ){
                        echo "<div class='container2'><span class='estiloError'>
                        No hay suficiente mercancia para {$prod['nombreprod']} solo hay {$prod['cantidad_dispobible']} productos disponibles 
                        </span></div>";
                    return 1;
                    }
                }
                return 0;
        return $res;  


    }

    public static function eliminar_cantidades($folio_apartado){

        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT Folioprod, cantidad
        FROM apartado
        INNER JOIN ApartadoProducto ON apartado.FolioApartado = ApartadoProducto.FolioApartado
        where  apartado.folioapartado = ?");
        $sql->execute(array($folio_apartado));
        $res=[];
            foreach ($sql->fetchALL() as $prod) {
                //validar la cantidad
                $conexion=Basededatos::CreateInstancia();
                $sql= $conexion->prepare("UPDATE  catalogoproducto SET Cantidad=Cantidad-?  WHERE FolioProd = ?");
                $sql->execute(array($prod['cantidad'],$prod['Folioprod']));
            }
    }
            
}

?>