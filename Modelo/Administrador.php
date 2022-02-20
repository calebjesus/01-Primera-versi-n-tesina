<?php

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
    
    public static function crear($Nombre, $APAdmin, $AMAdmin,$CorreoElectronico, $Contrasena, $folio){
        $conexion=Basededatos::CreateInstancia();

        $sql= $conexion->prepare("SELECT * FROM catalogoadministrador WHERE CorreoElectronico=?");
        $sql->execute(array($CorreoElectronico));
    
        $admin=$sql->fetch();

        
        if(strcmp ($CorreoElectronico , $admin['CorreoElectronico'] ) == 0)
        {
            echo "<div class='container2'><span class='estiloError'>$CorreoElectronico ya se encuentra Registrado</span></div>";

        }else{

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
    }
    } 

    public static function borrar($FolioAdmin){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM catalogoadministrador WHERE FolioAdmin=?");
        $sql->execute(array($FolioAdmin));
    
    }

    public static function buscar($FolioAdmin){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoadministrador WHERE FolioAdmin=?");
        $sql->execute(array($FolioAdmin));
        $admin=$sql->fetch();
        return new Administrador($admin['FolioAdmin'],$admin['Nombre'], $admin['APAdmin'], $admin['AMAdmin'],$admin['CorreoElectronico'],$admin['Contrasena']);
    }

    public static function editar($FolioAdmin,$Nombre, $APAdmin, $AMAdmin, $CorreoElectronico,$Contrasena){
        
        $conexion=Basededatos::CreateInstancia(); 
        

        $sql= $conexion->prepare("UPDATE  catalogoadministrador SET Nombre=?, APAdmin=?, AMAdmin=?,CorreoElectronico=?,Contrasena=? WHERE FolioAdmin=?");
        $sql->execute(array($Nombre, $APAdmin, $AMAdmin, $CorreoElectronico,$Contrasena, $FolioAdmin));
        echo "<div class='container3'><span class='estiloExito'>Los datos se guardaron correctamente </span></div>";
    
        
    }

    public static function clientes_frecuentes(){
        

        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->query("SELECT CorreoElectronico, nombreclien, count(apartado.Idcliente) as conteo_compras from apartado 
        INNER JOIN Catalogocliente ON apartado.IdCliente=Catalogocliente.IdCliente
        where MONTH(fecha) = MONTH(NOW())-1
        group by apartado.idcliente;");
           
            
            $res=[];
                
                foreach ($sql->fetchALL() as $prod) {
                    $obj = new stdClass();
                    $obj->value = $prod['conteo_compras'];
                    $obj->color = self::randomColor();
                    $obj->label = $prod['nombreclien']."   ".$prod['CorreoElectronico'];
                    
                    array_push($res, $obj);
                }
        return $res;   
    }

    public static function productos_mas_vendidos(){
        

        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->query("SELECT nombreprod, sum(apartadoproducto.cantidad) as coteo_productos 
        from apartadoproducto
        INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd = apartadoproducto.FolioProd
        INNER JOIN apartado ON apartado.FolioApartado = apartadoproducto.FolioApartado
        where MONTH(fecha) = MONTH(NOW())-1
        group by apartadoproducto.FolioProd;");
           
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

    public static function reporte_anual($anio){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT nombreprod, sum(apartadoproducto.cantidad) as coteo_productos ,sum(apartadoproducto.preciototal) as precio
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

    public static function reporte_mensual($anio,$mes){
            $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("SELECT nombreprod, sum(apartadoproducto.cantidad) as coteo_productos ,sum(apartadoproducto.preciototal) as precio
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

    public static function reporte_materia_prima($nombremateria){
        $conexion=Basededatos::CreateInstancia();
            $sql= $conexion->prepare("SELECT nombremat, nombresuc, min(preciomat) as preciomat, cantidadmat
            from catalogomateriaprima
            where nombremat =? 
            group by preciomat;");
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

    public static function mostrar_calculadora(){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->query("SELECT idcalculadora, catalogoproducto.nombreprod as producto, calculadora.precio*calculadora.cantidad as precio, calculadora.cantidad as cantidad
        from calculadora
        INNER JOIN Catalogoproducto ON Catalogoproducto.Folioprod = calculadora.Folioprod;");
        $res=[];
        foreach ($sql->fetchALL() as $prod){
                $obj = new stdClass();
                $obj->idcalculadora = $prod['idcalculadora'];
                $obj->producto = $prod['producto'];
                $obj->precio = $prod['precio'];
                $obj->cantidad = $prod['cantidad'];
                array_push($res, $obj);
            }
            return $res;  
    }

    public static function verificar_existencia_producto( $folio_producto){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("select  folioprod from calculadora where folioprod = ?;");
        $sql->execute(array( $folio_producto));
        $prod=$sql->fetch();
            return $prod['folioprod'];  
    }

    public static function actualizar_cantidad_calculadora($cantidad,$folio_producto){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  calculadora SET cantidad=cantidad+? WHERE Folioprod=?");
        $sql->execute(array($cantidad,$folio_producto));
    }

    public static function borrar_fila_calculadora($idcalculadora){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM calculadora WHERE idcalculadora=?");
        $sql->execute(array($idcalculadora));
    }

    public static function eliminar_todo($id_administrador){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM calculadora WHERE FolioAdmin=?");
        $sql->execute(array($id_administrador));
    }

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

    public static function verificar_prestacion_herramienta($folio_empleado){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("select  IdEmpleados from prestacionHerramientas where IdEmpleados = ? and estado = 1;");
        $sql->execute(array( $folio_empleado));
        $prod=$sql->fetch();
            return $prod['IdEmpleados'];  
    }

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

    public static function existencia_idph($idph){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("select idph from phch where idph=?;");
        $sql->execute(array($idph));
        $prod=$sql->fetch();
            return $prod['idph'];  
    }

    public static function verificar_cantidad($cantidad,$folio_herramienta){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT if(cantidad<?,'0','1') as verificar
        from catalogoherramienta
        where folioherra=?;");
        $sql->execute(array($cantidad,$folio_herramienta));
        $prod=$sql->fetch();
            return $prod['verificar'];  
    }

    public static function existencia_phch($idPh,$folio_herramienta){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT folioherra from phch
        where folioherra=? and idph=?;");
        $sql->execute(array($folio_herramienta,$idPh));
        $prod=$sql->fetch();
            return $prod['folioherra'];  
    }

    public static function insertar_phch($idPh,$folio_herramienta,$cantidad){
        $estado=1;
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("INSERT into phch(
            idPh,
            FolioHerra, 
            Cantidad,
            Estado) 
            values(?,?,?,?)");
        $sql->execute(array($idPh,$folio_herramienta,$cantidad,$estado));
    }

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

    public static function eliminar_idPhch($idPhch_eliminar){
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("DELETE FROM phch WHERE idphch=?");
        $sql->execute(array($idPhch_eliminar));
    }

    public static function actualizar_cantidad_h($cantidad,$idPhch){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  PhCh SET cantidad=? WHERE idPhch=?");
        $sql->execute(array($cantidad,$idPhch));
    }

    public static function desactivar_prestamo($idPh){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  prestacionHerramientas SET estado=0 WHERE idPh=?");
        $sql->execute(array($idPh));
    }
    
    public static function activar_prestamo($idPh){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  prestacionHerramientas SET estado=1 WHERE idPh=?");
        $sql->execute(array($idPh));
    }
    
    public static function actualizar_estatus($idPhch_extravio,$cantidad_extravio){
        $conexion=Basededatos::CreateInstancia(); 
        $sql= $conexion->prepare("UPDATE  PhCh SET estado=? WHERE idPhch=?");
        $sql->execute(array($cantidad_extravio,$idPhch_extravio));
    }

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
            $contenido = "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
            /*!50503 SET NAMES utf8 */;
            /*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
            /*!40103 SET TIME_ZONE='+00:00' */;
            /*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
            /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
            /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
            /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;";
            foreach ($tablasARespaldar as $nombreDeLaTabla) {
                if (empty($nombreDeLaTabla)) {
                    continue;
                }
                $datosQueContieneLaTabla = $mysqli->query('SELECT * FROM `' . $nombreDeLaTabla . '`');
                $cantidadDeCampos = $datosQueContieneLaTabla->field_count;
                $cantidadDeFilas = $mysqli->affected_rows;

                $contenido .= 'DROP TABLE IF EXISTS `'.$nombreDeLaTabla.'`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;';

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
                $contenido .= '/*!40000 ALTER TABLE `'.$nombreDeLaTabla.'` ENABLE KEYS */;
                                UNLOCK TABLES;';

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
            
        


   
    
}


?>