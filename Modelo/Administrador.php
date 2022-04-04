<?php
/* La clase administrador realiza todas las operaciones de CRUD, funciones como reportes, prestamos, entre otros.*/
class Administrador{

    public $FolioAdmin;
    public $Nombre;
    public $APAdmin;
    public $AMAdmin;
    public $CorreoElectronico;
    public $Contrasena;

    public function __construct($FolioAdmin, $Nombre, $APAdmin,$AMAdmin, $CorreoElectronico,         $Contrasena){
        $this->FolioAdmin=$FolioAdmin;
        $this->Nombre=$Nombre;
        $this->APAdmin=$APAdmin;
        $this->AMAdmin=$AMAdmin;
        $this->CorreoElectronico=$CorreoElectronico;
        $this->Contrasena=$Contrasena;
    }
    /*Muestra los datos de los administrados, regresando un arreglo de todo lo que haya en la base de datos */
    public static function mostrar(){
        $listaAdmin=[];
        $conexion=BasedeDatos::CreateInstancia();
        $sql= $conexion->query("SELECT * FROM catalogoadministrador");
        foreach ($sql->fetchALL() as $admin) {
            $listaAdmin[]=new Administrador(
            $admin['FolioAdmin'],
            $admin['Nombre'],
            $admin['APAdmin'],
            $admin['AMAdmin'],
            $admin['CorreoElectronico'],
            $admin['Contrasena']);
        }
        return $listaAdmin;
    }
    /*Recibe todos los datos del administrador y valida si es un administrador regresando mensaje de exito o errores */
    public static function crear($Nombre, $APAdmin, $AMAdmin,$CorreoElectronico, $Contrasena, $folio){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoadministrador WHERE CorreoElectronico=?");
        $sql->execute(array($CorreoElectronico));
        $admin=$sql->fetch();
        
        if(empty($admin['CorreoElectronico'])){
            $sql= $conexion->prepare("INSERT into catalogoadministrador(
            folio,
            Nombre, 
            APAdmin, 
            AMAdmin,
            CorreoElectronico, 
            Contrasena) 
            values(?,?,?,?,?,?)");
         $sql->execute(array($folio,$Nombre, $APAdmin, $AMAdmin,$CorreoElectronico, $Contrasena));
        echo "<div class='container3'>
        <span class='estiloExito'>Registrado Exitoso de: $CorreoElectronico </span></div>";
        }else{
        echo "<div class='container2'><span class='estiloError'>$CorreoElectronico ya se encuentra Registrado</span></div>";
        return 1;
        }
    }
    /*Función que recibe el nombre de la tabla, correo electronico, nombre del folio y el numero del folio, 
    está función es para verificar la existencia de un correo electronico, ocupada en la funcioón de actualizar*/
    function verificar_correo_folio($nombre_tabla,$correo,$folio_nombre,$folio){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->query("select * from $nombre_tabla");
        
        foreach ($sql->fetchALL() as $admin) {
            if(strcmp($correo, $admin['CorreoElectronico']) === 0 && $folio!=$admin[0]){
                return 1;
            }
        }
    }
    /* Función para eliminar a un administrador*/
    public static function borrar($FolioAdmin){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM catalogoadministrador WHERE FolioAdmin=?");
        $sql->execute(array($FolioAdmin));
    
    }
    /*Función que busca a un administrador dado su numero de folio, regresando un vector con los datos del administrador*/
    public static function buscar($FolioAdmin){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoadministrador WHERE FolioAdmin=?");
        $sql->execute(array($FolioAdmin));
        $admin=$sql->fetch();
        return new Administrador($admin['FolioAdmin'],$admin['Nombre'], $admin['APAdmin'], $admin['AMAdmin'],$admin['CorreoElectronico'],$admin['Contrasena']);
    }
    /*Función para editar los datos del administrador retornando un mensaje de éxito en caso de realizar la actualización*/
    public static function editar($FolioAdmin,$Nombre, $APAdmin, $AMAdmin, $CorreoElectronico,$Contrasena){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  catalogoadministrador SET Nombre=?, APAdmin=?, AMAdmin=?,CorreoElectronico=?,Contrasena=? WHERE FolioAdmin=?");
        $sql->execute(array($Nombre, $APAdmin, $AMAdmin, $CorreoElectronico,$Contrasena, $FolioAdmin));
        echo "<div class='container3'><span class='estiloExito'>Los datos se guardaron correctamente </span></div>";
    }
    /*Función para obtener el reporte de los clientes frecuentes recibiendo la cantidad de clientes a imprimir
    regresando un arreglo de los datos de cada cliente, este reporte solo hace por cada mes anterior*/
    public static function clientes_frecuentes($cantidad){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT CorreoElectronico, nombreclien, count(apartado.Idcliente) as conteo_compras from apartado 
        INNER JOIN Catalogocliente ON apartado.IdCliente=Catalogocliente.IdCliente
        where MONTH(fecha) = MONTH(NOW())-1
        group by apartado.idcliente
        limit $cantidad;");
        $sql->execute(array($cantidad));
            $res=[];
                foreach ($sql->fetchALL() as $prod){
                    $obj = new stdClass();
                    $obj->value = $prod['conteo_compras'];
                    $obj->color = self::randomColor();
                    $obj->label = $prod['nombreclien']."   ".$prod['CorreoElectronico'];
                    array_push($res, $obj);
                }
        return $res;   
    }
    /*Función para obtener el reporte de los productos más vendidos recibiendo la cantidad de productos a imprimir
    regresando un arreglo de los datos de cada cliente, este reporte está dado por cada mes.*/
    function productos_mas_vendidos($CantidadMat){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT nombreprod, sum(apartadoproducto.cantidad) as coteo_productos 
        from apartadoproducto
        INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd = apartadoproducto.FolioProd
        INNER JOIN apartado ON apartado.FolioApartado = apartadoproducto.FolioApartado
        where MONTH(fecha) = MONTH(NOW())-1
        group by apartadoproducto.FolioProd
        limit $CantidadMat");
        $sql->execute(array($CantidadMat));
            $res=[];     
                foreach ($sql->fetchALL() as $prod) {
                    $obj = new stdClass();
                    $obj->value = $prod['coteo_productos'];
                    $obj->color = self::randomColor();
                    $obj->label = $prod['nombreprod'];
                    array_push($res, $obj);
                }
        return $res;   
    }
    /*Función utilizada para los reportes de clientes frecuentes y productos más apartados regresando un 
    arreglo con el color aleatorio */
    function randomColor(){
        $str = "#";
        for($i = 0 ; $i < 6 ; $i++){
        $randNum = rand(0, 15);
        switch ($randNum) {
        case 10: $randNum = "A"; 
        break;
        case 11: $randNum = "B"; 
        break;
        case 12: $randNum = "C"; 
        break;
        case 13: $randNum = "D"; 
        break;
        case 14: $randNum = "E"; 
        break;
        case 15: $randNum = "F"; 
        break; 
        }
        $str .= $randNum;
        }
        return $str;
    }
    /*Función utilizada para el gestor de citas, retornando un arreglo con todas las fechas reservadas*/
    public static function traer_fechas_distintas(){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->query("SELECT DISTINCT year(fecha) as fechas_disponibles
        from apartado
        order by fecha;");
        $res=[];
            foreach ($sql->fetchALL() as $prod) {
                array_push($res, $prod['fechas_disponibles']);
            }
    return $res;  
    }
    /*Función que realiza el reporte anual recibiendo el año y devolviendo un arreglo con la información 
    requerida por el asesor externo*/
    public static function reporte_anual($anio){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT nombreprod, sum(apartadoproducto.cantidad) as coteo_productos ,(apartadoproducto.preciototal * sum(apartadoproducto.cantidad)) as precio
        from apartadoproducto
        INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd = apartadoproducto.FolioProd
        INNER JOIN apartado ON apartado.FolioApartado = apartadoproducto.FolioApartado  where year(fecha) = ?
        group by apartadoproducto.FolioProd");
        $sql->execute(array($anio));
        $res=[];
            foreach ($sql->fetchALL() as $prod) {
                $obj = new stdClass();
                $obj->nombreprod = $prod['nombreprod'];
                $obj->coteo_productos = $prod['coteo_productos'];
                $obj->precio = $prod['precio'];
                array_push($res, $obj);
            }
    return $res;   
    }
    /*Función  que extrae todos los meses de la tabla de apartado, con el fin de imprimir datos de los meses
    regresando en un arreglo los meses*/
    public static function traer_meses_distintas(){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->query("select DISTINCT monthname(fecha) as meses_disponibles
        from apartado
        order by fecha;");

        $res=[];
            foreach ($sql->fetchALL() as $prod) {
                array_push($res, $prod['meses_disponibles']);
            }
        return $res;  
    }
    /*Función que realiza el reporte mensual recibiendo el mes y año,  imprimiendo los datos en un arreglo*/
    public static function reporte_mensual($anio,$mes){
            $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("SELECT nombreprod, sum(apartadoproducto.cantidad) as coteo_productos ,(apartadoproducto.preciototal * sum(apartadoproducto.cantidad)) as precio
            from apartadoproducto
            INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd = apartadoproducto.FolioProd
            INNER JOIN apartado ON apartado.FolioApartado = apartadoproducto.FolioApartado
            where year(fecha) = ? and monthname(fecha)=?
            group by apartadoproducto.FolioProd;");
            $sql->execute(array($anio,$mes));
            $res=[];
                foreach ($sql->fetchALL() as $prod) {
                    $obj = new stdClass();
                    $obj->nombreprod = $prod['nombreprod'];
                    $obj->coteo_productos = $prod['coteo_productos'];
                    $obj->precio = $prod['precio'];
                    array_push($res, $obj);
                }
        return $res;  
    }

    /*Función utilizada para el reporte de la materia prima recibiendo el nombre a buscar y
    regresando un arreglo con todos los productos*/
    public static function reporte_materia_prima($nombremateria){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("SELECT nombremat, nombresuc, preciomat, cantidadmat
            from catalogomateriaprima
            where nombremat =? 
            order by preciomat asc;");
            $sql->execute(array($nombremateria));
            $res=[];
                foreach ($sql->fetchALL() as $prod) {
                    $obj = new stdClass();
                    $obj->nombremat = $prod['nombremat'];
                    $obj->nombresuc = $prod['nombresuc'];
                    $obj->preciomat = $prod['preciomat'];
                    $obj->cantidadmat = $prod['cantidadmat'];
                    array_push($res, $obj);
                }
        return $res;  

    }

    /*Función que retorna un arreglo con los datos de la tabla de productos*/
    public static function mostrar_productos(){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->query("SELECT folioprod, nombreprod, categoria
        from catalogoproducto;");
        $res=[];
            foreach ($sql->fetchALL() as $prod){
                $obj = new stdClass();
                $obj->folioprod = $prod['folioprod'];
                $obj->nombreprod = $prod['nombreprod'];
                $obj->categoria = $prod['categoria'];
                array_push($res, $obj);
            }
        return $res;  
    }

    /*Función que retorna la información de productos por medio de su folio, en la tabla de insumos utilizada para la 
    función de la calculadora*/
    public static function producto_precio_insumos($folio_producto){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT Catalogoproducto.nombreprod as producto, sum(insumo.cantidad*catalogomateriaprima.PrecioMat) as precio_insumo
        from insumo
        INNER JOIN Catalogomateriaprima ON Catalogomateriaprima.FolioMat = insumo.FolioMat
        INNER JOIN Catalogoproducto ON Catalogoproducto.Folioprod = insumo.Folioprod
        where insumo.folioprod = ?
        group by nombreprod;");
        $sql->execute(array($folio_producto));
        $res=[];
        foreach ($sql->fetchALL() as $prod){
                $obj = new stdClass();
                $obj->producto = $prod['producto'];
                $obj->precio_insumo = $prod['precio_insumo'];
                array_push($res, $obj);
            }
            return $res;  
    }

    /*Función para ingresar la información a la tabla de la calculadora*/
    public static function insertar_calculadora($cantidad,$folio_producto,$id_administrador,$precio){
        $conexion=Basededatos::CreateInstancia();
        
        $sql= $conexion->prepare("INSERT into calculadora(
            FolioProd,
            FolioAdmin, 
            precio,
            cantidad) 
            values(?,?,?,?)");
         $sql->execute(array($folio_producto,$id_administrador,$precio,$cantidad));
    }

    //Muestra los datos de la calculadora seleccionando al Id del administrador y al producto.
    public static function mostrar_calculadora($id_administrador){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT idcalculadora,calculadora.precio as costeunitario, catalogoproducto.nombreprod as producto, calculadora.precio*calculadora.cantidad as precio, calculadora.cantidad as cantidad
        from calculadora
        INNER JOIN Catalogoproducto ON Catalogoproducto.Folioprod = calculadora.Folioprod
        where FolioAdmin = ?;");
        $sql->execute(array($id_administrador));
        $res=[];
        foreach ($sql->fetchALL() as $prod){
                $obj = new stdClass();
                $obj->idcalculadora = $prod['idcalculadora'];
                $obj->costeunitario = $prod['costeunitario'];
                $obj->producto = $prod['producto'];
                $obj->precio = $prod['precio'];
                $obj->cantidad = $prod['cantidad'];
                array_push($res, $obj);
            }
            return $res;  
    }
    //verifica la existencia del producto y que existe con el administrador
    public static function verificar_existencia_producto($folio_producto,$id_administrador){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT  folioprod from calculadora where folioprod = ? and FolioAdmin=?");
        $sql->execute(array( $folio_producto,$id_administrador));
        $prod=$sql->fetch();
        
        if(!empty($prod['folioprod'])){          
            return $prod['folioprod'];  
        }
        

    }
    //Actualiza la cantidad del producto identificando al administrador con la llave primaria
    public static function actualizar_cantidad_calculadora($cantidad,$folio_producto,$id_administrador){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  calculadora SET cantidad=cantidad+? WHERE Folioprod=? and FolioAdmin=?");
        $sql->execute(array($cantidad,$folio_producto,$id_administrador));
    }

    /*Función para eliminar los productos que hay en la calculadora*/
    public static function borrar_fila_calculadora($idcalculadora){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM calculadora WHERE idcalculadora=?");
        $sql->execute(array($idcalculadora));
    }
    /*Función para eliminar todo lo que hay en la tabla de calculadora por medio del folio*/
    public static function eliminar_todo($id_administrador){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM calculadora WHERE FolioAdmin=?");
        $sql->execute(array($id_administrador));
    }

    /*Función para mostrar los datos de los empleados devolviendo un arreglo con la información*/
    public static function mostrar_empleados(){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->query("SELECT 
            idempleados, 
            correoelectronico, 
            nombre, 
            APEmp,
            AMEmp from catalogoempleado;");
            $res=[];
                foreach ($sql->fetchALL() as $prod){
                    $obj = new stdClass();
                    $obj->idempleados = $prod['idempleados'];
                    $obj->correoelectronico = $prod['correoelectronico'];
                    $obj->nombre = $prod['nombre'];
                    $obj->APEmp = $prod['APEmp'];
                    $obj->AMEmp = $prod['AMEmp'];
                    array_push($res, $obj);
                }
        return $res;  
    }
    
    /*Función para verificar si un empleado cuenta con alguna prestación de herramientas */
    public static function verificar_prestacion_herramienta($folio_empleado){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("select  IdEmpleados from prestacionHerramientas where IdEmpleados = ? and estado = 1;");
        $sql->execute(array( $folio_empleado));
        $prod=$sql->fetch();
        if(!empty($prod['IdEmpleados'])){
            return $prod['IdEmpleados'];  
        }
    }

    /*Función para insertar en la tabla prestaciones recibiendo el folio del empleado*/
    public static function insertar_prestacion_herramienta($folio_empleado){
        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Mexico_City");
        setlocale(LC_TIME, 'spanish');    
        $fecha_actual=date('Y-m-d'); 
        $estado=1;
        
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("INSERT into prestacionHerramientas(
            IdEmpleados,
            FechaPrestacion, 
            Estado) 
            values(?,?,?)");
        $sql->execute(array($folio_empleado,$fecha_actual,$estado));
    }

    /*Función que imprime los datos de las prestaciones de herramientas retornandolas en un arreglo*/
    public static function mostrar_prestacion_herramientas(){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->query("SELECT  idPh,correoelectronico,FechaPrestacion,Estado from prestacionHerramientas
        INNER JOIN Catalogoempleado ON Catalogoempleado.IdEmpleados = prestacionHerramientas.IdEmpleados 
        order by fechaprestacion and estado=1 desc;");
            $res=[];
                foreach ($sql->fetchALL() as $prod){
                    $obj = new stdClass();
                    $obj->idPh = $prod['idPh'];
                    $obj->correoelectronico = $prod['correoelectronico'];
                    $obj->FechaPrestacion = $prod['FechaPrestacion'];
                    $obj->Estado = $prod['Estado'];
                    array_push($res, $obj);
                }
        return $res;  
    }

    /*Función que regresa el id de la tabla phch */
    public static function existencia_idph($idph){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("select idph from phch where idph=?;");
        $sql->execute(array($idph));
        $prod=$sql->fetch();
         if(!empty($prod['idph'])){
           return $prod['idph'];   
        }   
    }

    /*Función que verifica la cantidad de herramienta, esto para actualizar las herramientas que hay 
    en la base de datos*/
    public static function verificar_cantidad($cantidad,$folio_herramienta){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT if(cantidad<?,'0','1') as verificar
        from catalogoherramienta
        where folioherra=?;");
        $sql->execute(array($cantidad,$folio_herramienta));
        $prod=$sql->fetch();
            return $prod['verificar'];  
    }

    /*Función que verifica la prestacion de una herramienta recibiendo el id de la herramienta y de la tabla
    y retornando el folio de la herramienta*/
    public static function existencia_phch($idPh,$folio_herramienta){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT folioherra from phch
        where folioherra=? and idph=?;");
        $sql->execute(array($folio_herramienta,$idPh));
        $prod=$sql->fetch();

        if(!empty($prod['folioherra'])){
          return $prod['folioherra'];     
        }
            
    }

    /*Función ingresa la informacion en la tabla phch recibiendo los atributos del id, folio de la herramienta y cantidad */
    public static function insertar_phch($idPh,$folio_herramienta,$cantidad){
        $estado=0;
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("INSERT into phch(
            idPh,
            FolioHerra, 
            Cantidad,
            Estado) 
            values(?,?,?,?)");
        $sql->execute(array($idPh,$folio_herramienta,$cantidad,$estado));
    }

    /*Función que muestra la información de la tabla phch*/
    public static function mostrar_phch($idPh){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT idPhch, idPh,phch.folioherra as folioherra , NombreHerra, phch.Cantidad as cantidad, Estado  
        from phch
        INNER JOIN Catalogoherramienta ON phch.Folioherra = Catalogoherramienta.Folioherra
        where idph=?;");
        $sql->execute(array($idPh));
            $res=[];
                foreach ($sql->fetchALL() as $prod){
                    $obj = new stdClass();
                    $obj->idPhch = $prod['idPhch'];
                    $obj->idPh = $prod['idPh'];
                    $obj->folioherra = $prod['folioherra'];
                    $obj->NombreHerra = $prod['NombreHerra'];
                    $obj->cantidad = $prod['cantidad'];
                    $obj->Estado = $prod['Estado'];
                    array_push($res, $obj);
                }
        return $res; 
    }

    /*Función para eliminar una tupla de la tabla phch recibiendo el id*/
    public static function eliminar_idPhch($idPhch_eliminar){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM phch WHERE idphch=?");
        $sql->execute(array($idPhch_eliminar));
    }

    /*Función que actualiza  la cantidad en la tabla de phch*/
    public static function actualizar_cantidad_h($cantidad,$idPhch){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  PhCh SET cantidad=? WHERE idPhch=?");
        $sql->execute(array($cantidad,$idPhch));
    }

    /*Función para desactivar el estado del prestamo de herramientas*/
    public static function desactivar_prestamo($idPh){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  prestacionHerramientas SET estado=0 WHERE idPh=?");
        $sql->execute(array($idPh));
    }
    
    /*Función para activar el prestamo de herramientas*/
    public static function activar_prestamo($idPh){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  prestacionHerramientas SET estado=1 WHERE idPh=?");
        $sql->execute(array($idPh));
    }
    
    /*Función para actualizar el estado del extravío de alguna herramienta*/
    public static function actualizar_estatus($idPhch_extravio,$cantidad_extravio){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  PhCh SET estado=? WHERE idPhch=?");
        $sql->execute(array($cantidad_extravio,$idPhch_extravio));
    }

    /*Función para realizar el respaldo de la base de datos esta opción que se encuentra en la sección del administrador 
    recibe el host, el nombre del usuario, contraseña y el nombre de la base de datos*/
    public static function respaldo_bd($host, $usuario, $pasword, $nombreDeBaseDeDatos){
            set_time_limit(3000);
            $tablasARespaldar = [];
            $mysqli = new mysqli($host, $usuario, $pasword, $nombreDeBaseDeDatos);
            $mysqli->select_db($nombreDeBaseDeDatos);
            $mysqli->query("SET NAMES 'utf8'");
            $tablas = $mysqli->query('SHOW TABLES');
            while ($fila = $tablas->fetch_row()) {
                $tablasARespaldar[] = $fila[0];
            }
            $contenido = "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n
            /*!50503 SET NAMES utf8 */;\n
            /*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;\n
            /*!40103 SET TIME_ZONE='+00:00' */;\n
            /*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;\n
            /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;\n
            /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;\n
            /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;\n";
            foreach ($tablasARespaldar as $nombreDeLaTabla) {
                if (empty($nombreDeLaTabla)) {
                    continue;
                }
                $datosQueContieneLaTabla = $mysqli->query('SELECT * FROM `' . $nombreDeLaTabla . '`');
                $cantidadDeCampos = $datosQueContieneLaTabla->field_count;
                $cantidadDeFilas = $mysqli->affected_rows;

                $contenido .= "\nDROP TABLE IF EXISTS `".$nombreDeLaTabla."`;
                \n/*!40101 SET @saved_cs_client     = @@character_set_client */;
                \n/*!50503 SET character_set_client = utf8mb4 */;";

                $esquemaDeTabla = $mysqli->query('SHOW CREATE TABLE ' . $nombreDeLaTabla);

                $filaDeTabla = $esquemaDeTabla->fetch_row();
                $contenido .= "\n\n" . $filaDeTabla[1] . ";\n\n";

                $contenido .= '/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `'.$nombreDeLaTabla.'` WRITE;
                                /*!40000 ALTER TABLE `'.$nombreDeLaTabla.'` DISABLE KEYS */;';
                
                for ($i = 0, $contador = 0; $i < $cantidadDeCampos; $i++, $contador = 0) {
                    while ($fila = $datosQueContieneLaTabla->fetch_row()) {
                        //La primera y cada 100 veces
                        if ($contador % 100 == 0 || $contador == 0) {
                            $contenido .= "\nINSERT INTO " . $nombreDeLaTabla . " VALUES";
                        }
                        $contenido .= "\n(";
                        for ($j = 0; $j < $cantidadDeCampos; $j++) {
                            $fila[$j] = str_replace("\n", "\\n", addslashes($fila[$j]));
                            if (isset($fila[$j])) {
                                $contenido .= '"' . $fila[$j] . '"';
                            } else {
                                $contenido .= '""';
                            }
                            if ($j < ($cantidadDeCampos - 1)) {
                                $contenido .= ',';
                            }
                        }
                        $contenido .= ")";
                        # Cada 100...
                        if ((($contador + 1) % 100 == 0 && $contador != 0) || $contador + 1 == $cantidadDeFilas) {
                            $contenido .= ";";

                            
                        
                        } else {
                            $contenido .= ",";
                        }
                        $contador = $contador + 1;


                    }
                }
                $contenido .= "\n/*!40000 ALTER TABLE `".$nombreDeLaTabla."` ENABLE KEYS */;
                                UNLOCK TABLES;";

                $contenido .= "\n\n\n";


            }
            $contenido .= "\r\n\r\n/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
            /*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
            /*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
            /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
            /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
            /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
            /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;";
        
            # Se guardará dependiendo del directorio, en una carpeta llamada respaldos
            $carpeta = "../CarpinteriaGral/respaldos";
            if (!file_exists($carpeta)) {
                mkdir($carpeta);
            }
            # Calcular un ID único
            $id = uniqid();
            # También la fecha
            $fecha = date("Y-m-d");
            # Crear un archivo que tendrá un nombre como respaldo_2018-10-22_asd123.sql
            $nombreDelArchivo = sprintf('%s/respaldo_%s_%s.sql', $carpeta, $fecha, $id);
            #Escribir todo el contenido. Si todo va bien, file_put_contents NO devuelve FALSE
            return file_put_contents($nombreDelArchivo, $contenido) !== false;
        
    }

    /*Función para restaurar la base de datos, recibe el host, el nombre de usuario, la contraseña, el nombre
    de la base de datos junto con la dirreción donde se aguardará */
    public static function restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $direccion){
           //connection
            $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
        
            //variable use to store queries from our sql file
            $sql = '';
            
            //get our sql file
            $lines = file($direccion);
        
            //return message
            $output = array('error'=>false);
            
            //loop each line of our sql file
            foreach ($lines as $line){
        
                //skip comments
                if(substr($line, 0, 2) == '--' || $line == ''){
                    continue;
                }
        
                //add each line to our query
                $sql .= $line;
        
                //check if its the end of the line due to semicolon
                if (substr(trim($line), -1, 1) == ';'){
                    //perform our query
                    $query = $conn->query($sql);
                    if(!$query){
                        $output['error'] = true;
                        $output['message'] = $conn->error;
                    }
                    else{
                        $output['message'] = 'Base de datos restaurada con éxito';
                    }
        
                    //reset our query variable
                    $sql = '';
                    
                }
            }
        
            return $output;
    }

    /*Función para imprimir la información de la página principal */
    public static function informacion_inicio(){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->query("SELECT direccion, telefono1, telefono2, correoelectroncio from inicio;");
            $res=[];
                foreach ($sql->fetchALL() as $prod){
                    $obj = new stdClass();
                    $obj->direccion = $prod['direccion'];
                    $obj->telefono1 = $prod['telefono1'];
                    $obj->telefono2 = $prod['telefono2'];
                    $obj->correoelectroncio = $prod['correoelectroncio'];
                    array_push($res, $obj);
                }
        return $res;
    }
    
    public static function insertar_inicio_sesion($id){
        
        $conexion=Basededatos::CreateInstancia();
        /*Obtiene la fecha actual*/
        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Mexico_City");
        setlocale(LC_TIME, 'spanish'); 
        $fecha = date('Y-m-d h:i:s', time());                
        

        $sql= $conexion->prepare("INSERT into inicio_sesion(
            folioadmin, 
            fechainicio) 
            values(?,?)");
        $sql->execute(array($id,$fecha));
    }

    public static function inicio_sesiones(){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->query("select folioadmin, fechainicio from inicio_sesion;");
            $res=[];
                foreach ($sql->fetchALL() as $prod){
                    $obj = new stdClass();
                    $obj->folioadmin = $prod['folioadmin'];
                    $obj->fechainicio = $prod['fechainicio'];
                    array_push($res, $obj);
                }
        return $res; 
    }

   
    
}


?>