<?php
/*La clase ReadC cumple con la función de procesar todas operaciones del cliente incluyendo las operacioes 
de citas, apartado, cuenta y listas, entre otras herramientas. */
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
            $idCarrito = $prod2['idCarritoTemporal'];
            $sql= $conexion->prepare("UPDATE carritotemporal SET Cantidad=(Cantidad+1) WHERE idCarritoTemporal=?;");
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
/*Ingresa los datos a la tabla apartado obteniendo el precio total y el id del cliente*/
    public static function insertar_apartado($PrecioTotal,$IdCliente){
       /*Obtiene la fecha actual*/
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

/*Ingresa los datos a la tabla apartaco producto obteniendo el id del cliente y el folio de la tabla apartado*/    
    public static function insertar_apartado_producto($IdCliente,$folio_apartado){
        
        $conexion=Basededatos::CreateInstancia();
        /*Se buscan los datos de la tabla carrito temporal para después ingresarlos*/
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

/*Función SQL para ingresar los datos de la cita */
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

/*Función para obtener las fechas ocupadas de las citas devuelve un arreglo*/
    public static function fechas_ocupadas(){
        $conexion=BasedeDatos::CreateInstancia();
        $sql= $conexion->query("SELECT fecha_hora_cita from citas");
            $lista_fechas=[];
            foreach ($sql->fetchALL() as $prod){
                array_push($lista_fechas, '"'.$prod['fecha_hora_cita'].'",'  );
                }
        return $lista_fechas;
    }

/*Función para extraer los datos del carrito temporal e insertarlo en las tablas de apartado, devuelve un arreglo*/
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

/*Función para buscar si el cliente tiene un cita*/
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

/*Función para eliminar la cita del cliente una vez que haya pasado el tiempo de la ultima cita */
    public static function eliminar_cita($IdCliente){
        /*Se extrae la fecha actual del sistema*/
        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Mexico_City");
        setlocale(LC_TIME, 'spanish');   
        $fecha_actual = date("Y-m-d"); 

        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT fecha_hora_cita from citas where IdCliente = ?");
        $sql->execute(array($IdCliente));
        $prod=$sql->fetch();

        if(!empty($prod['fecha_hora_cita'])){
            $fecha_anterior = date("Y-m-d", strtotime($prod['fecha_hora_cita']));
            if($fecha_actual > $fecha_anterior){         
            $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("DELETE FROM citas WHERE IdCliente=?");
            $sql->execute(array($IdCliente));
            }
        }

        

    }

/*Busca todos los atributos de la tabla apartado por un cliente*/
    public static function buscar_productos_apartado($IdCliente){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("SELECT FolioApartado, Fecha, FechaVencimiento, PrecioTotal
            from apartado
            where IdCliente = ?");
            $sql->execute(array($IdCliente));
            $res=[];
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

/*La función apartado_producto_detalles busca los tributos de la tabla apartado producto para enviarlo a detalles de los productos*/
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
    
/*La función datos_cita busca los atributos en la tabla cita por el id del cliente para mostrarlo en la opción cuenta y listas */
    public static function datos_cita($IdCliente){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("SELECT * from citas where IdCliente=?;");
            $sql->execute(array($IdCliente));
            $res=[];
            foreach ($sql->fetchALL() as $prod) {
                    array_push($res,$prod['fecha_hora_cita'],$prod['lugar_cita'],$prod['asunto']);
            }
        return $res;   
    } 

/*La función verifica la cantidad disponible al momento  de que el cliente aparte un producto retornando valores 0 y 1 para validar la cantidad que el cliente pide y la que hay en existencia  */ 
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

/*Elimina las cantidad que hay de productos en la tabla catalogoproductos por cada vez que el cliente aparte productos*/
    public static function eliminar_cantidades($folio_apartado){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT Folioprod, cantidad
        FROM apartado
        INNER JOIN ApartadoProducto ON apartado.FolioApartado = ApartadoProducto.FolioApartado
        where  apartado.folioapartado = ?");
        $sql->execute(array($folio_apartado));
        $res=[];
            foreach ($sql->fetchALL() as $prod) {
                $conexion=Basededatos::CreateInstancia();
                $sql= $conexion->prepare("UPDATE  catalogoproducto SET Cantidad=Cantidad-?  WHERE FolioProd = ?");
                $sql->execute(array($prod['cantidad'],$prod['Folioprod']));
            }
    } 
//Selecion de el municipio
    public static function datos_municipios(){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->query("SELECT municipio, estado from municipios;");
            $res=[];
                foreach ($sql->fetchALL() as $prod){
                    $obj = new stdClass();
                    $obj->municipio = $prod['municipio'];
                    $obj->estado = $prod['estado'];
                    array_push($res, $obj);
                }
        return $res;
    }
    //Selecion de el municipio
    public static function datos_estado(){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->query("SELECT DISTINCT municipio from municipios;");
            $res=[];
                foreach ($sql->fetchALL() as $prod){
                    $obj = new stdClass();
                    $obj->municipio = $prod['municipio'];
                    array_push($res, $obj);
                }
        return $res;
    }

    public static function verificar_inyeccionSQL($cadena_de_texto){
        $c1= 'select';
        $c2= 'update';
        $c3= 'delete';
        $c4= 'create';
        $c9= 'drop';
        $c10= 'table';
        $c11= 'transact';
        $c12= 'alter';
        $c13= 'where';
        $c14= 'name';
        $c15= 'from';
        $c16= 'database';
        $c17= 'use';
        $c18= 'for';
        $c19= 'set';
        $c20= 'values';
        $c23= 'mysql';
        $c24= 'user';
        $c25= 'into';
        $c26= 'insert';

        $p1 = strripos($cadena_de_texto, $c1);
        $p2 = strripos($cadena_de_texto, $c2);
        $p3 = strripos($cadena_de_texto, $c3);
        $p4 = strripos($cadena_de_texto, $c4);
        $p9 = strripos($cadena_de_texto, $c9);
        $p10 = strripos($cadena_de_texto, $c10);
        $p11 = strripos($cadena_de_texto, $c11);
        $p12 = strripos($cadena_de_texto, $c12);
        $p13 = strripos($cadena_de_texto, $c13);
        $p14 = strripos($cadena_de_texto, $c14);
        $p15 = strripos($cadena_de_texto, $c15);
        $p16 = strripos($cadena_de_texto, $c16);
        $p17 = strripos($cadena_de_texto, $c17);
        $p18 = strripos($cadena_de_texto, $c18);
        $p19 = strripos($cadena_de_texto, $c19);
        $p20 = strripos($cadena_de_texto, $c20);
        $p23 = strripos($cadena_de_texto, $c23);
        $p24 = strripos($cadena_de_texto, $c24);
        $p25 = strripos($cadena_de_texto, $c25);
        $p26 = strripos($cadena_de_texto, $c26);
        //se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
        if (
            $p1 === false &&
            $p2 === false &&
            $p3 === false &&
            $p4 === false &&
            $p9 === false &&
            $p10 === false &&
            $p11 === false &&
            $p12 === false &&
            $p13 === false &&
            $p14 === false &&
            $p15 === false &&
            $p16 === false &&
            $p17 === false &&
            $p18 === false &&
            $p19 === false &&
            $p20 === false &&
            $p23 === false &&
            $p24 === false &&
            $p25 === false &&
            $p26 === false
        ) {
            
            return 0;
            } else {
                   
                    return 1;
                    }
    }
}

?>