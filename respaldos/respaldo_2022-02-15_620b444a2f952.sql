/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
            /*!50503 SET NAMES utf8 */;
            /*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
            /*!40103 SET TIME_ZONE='+00:00' */;
            /*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
            /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
            /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
            /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;DROP TABLE IF EXISTS `apartado`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `apartado` (
  `FolioApartado` int(11) NOT NULL AUTO_INCREMENT,
  `IdCliente` int(11) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `FechaVencimiento` date DEFAULT NULL,
  `PrecioTotal` float DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`FolioApartado`),
  KEY `A_C` (`IdCliente`),
  CONSTRAINT `A_C` FOREIGN KEY (`IdCliente`) REFERENCES `catalogocliente` (`IdCliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `apartado` WRITE;
                                /*!40000 ALTER TABLE `apartado` DISABLE KEYS */;
INSERT INTO apartado VALUES
("1","4","2022-01-14","2022-02-24","250000","1"),
("2","5","2022-01-14","2022-02-24","50000","1");/*!40000 ALTER TABLE `apartado` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `apartadoproducto`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `apartadoproducto` (
  `FolioAp` int(11) NOT NULL AUTO_INCREMENT,
  `FolioProd` int(11) NOT NULL,
  `FolioApartado` int(11) NOT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `PrecioTotal` float DEFAULT NULL,
  PRIMARY KEY (`FolioAp`),
  KEY `AP_CP` (`FolioProd`),
  KEY `A_AP` (`FolioApartado`),
  CONSTRAINT `AP_CP` FOREIGN KEY (`FolioProd`) REFERENCES `catalogoproducto` (`FolioProd`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `A_AP` FOREIGN KEY (`FolioApartado`) REFERENCES `apartado` (`FolioApartado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `apartadoproducto` WRITE;
                                /*!40000 ALTER TABLE `apartadoproducto` DISABLE KEYS */;/*!40000 ALTER TABLE `apartadoproducto` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `calculadora`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `calculadora` (
  `idcalculadora` int(11) NOT NULL AUTO_INCREMENT,
  `FolioProd` int(11) DEFAULT NULL,
  `FolioAdmin` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcalculadora`),
  KEY `c_fa` (`FolioAdmin`),
  KEY `c_cp` (`FolioProd`),
  CONSTRAINT `c_cp` FOREIGN KEY (`FolioProd`) REFERENCES `catalogoproducto` (`FolioProd`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `c_fa` FOREIGN KEY (`FolioAdmin`) REFERENCES `catalogoadministrador` (`FolioAdmin`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `calculadora` WRITE;
                                /*!40000 ALTER TABLE `calculadora` DISABLE KEYS */;/*!40000 ALTER TABLE `calculadora` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `carritotemporal`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `carritotemporal` (
  `idCarritoTemporal` int(11) NOT NULL AUTO_INCREMENT,
  `IdCliente` int(11) NOT NULL,
  `FolioProd` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Estatus` int(11) NOT NULL,
  PRIMARY KEY (`idCarritoTemporal`),
  KEY `CTh_CC` (`IdCliente`),
  KEY `CTy_CP` (`FolioProd`),
  CONSTRAINT `CTh_CC` FOREIGN KEY (`IdCliente`) REFERENCES `catalogocliente` (`IdCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `CTy_CP` FOREIGN KEY (`FolioProd`) REFERENCES `catalogoproducto` (`FolioProd`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `carritotemporal` WRITE;
                                /*!40000 ALTER TABLE `carritotemporal` DISABLE KEYS */;/*!40000 ALTER TABLE `carritotemporal` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `catalogoadministrador`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `catalogoadministrador` (
  `FolioAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `folio` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `APAdmin` varchar(45) NOT NULL,
  `AMAdmin` varchar(45) NOT NULL,
  `CorreoElectronico` varchar(45) NOT NULL,
  `Contrasena` varchar(45) NOT NULL,
  PRIMARY KEY (`FolioAdmin`),
  KEY `rol_jk` (`folio`),
  CONSTRAINT `rol_jk` FOREIGN KEY (`folio`) REFERENCES `roles` (`folio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `catalogoadministrador` WRITE;
                                /*!40000 ALTER TABLE `catalogoadministrador` DISABLE KEYS */;
INSERT INTO catalogoadministrador VALUES
("1","1","jesus","solano","alquicira","1","1");
/*!40000 ALTER TABLE `catalogoadministrador` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `catalogocliente`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `catalogocliente` (
  `IdCliente` int(11) NOT NULL AUTO_INCREMENT,
  `folio` int(11) NOT NULL,
  `NombreClien` varchar(45) NOT NULL,
  `APClien` varchar(45) NOT NULL,
  `AMClien` varchar(45) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Telefono` varchar(45) NOT NULL,
  `Direccion` text NOT NULL,
  `CorreoElectronico` varchar(45) NOT NULL,
  `Contrasena` varchar(45) NOT NULL,
  PRIMARY KEY (`IdCliente`),
  KEY `rol_Cl` (`folio`),
  CONSTRAINT `rol_Cl` FOREIGN KEY (`folio`) REFERENCES `roles` (`folio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `catalogocliente` WRITE;
                                /*!40000 ALTER TABLE `catalogocliente` DISABLE KEYS */;
INSERT INTO catalogocliente VALUES
("4","2","Yoseline","Jofman","has","1997-02-02","7776017217","Calle azteca","2","2"),
("5","2","victor","diaz","medina","2001-05-06","7776017217","c","g","g");
/*!40000 ALTER TABLE `catalogocliente` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `catalogoempleado`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `catalogoempleado` (
  `IdEmpleados` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `APEmp` varchar(45) NOT NULL,
  `AMEmp` varchar(45) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Telefono` varchar(45) NOT NULL,
  `Direccion` text NOT NULL,
  `CorreoElectronico` varchar(45) NOT NULL,
  `TipoEmpleado` varchar(45) NOT NULL,
  PRIMARY KEY (`IdEmpleados`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `catalogoempleado` WRITE;
                                /*!40000 ALTER TABLE `catalogoempleado` DISABLE KEYS */;
INSERT INTO catalogoempleado VALUES
("13","David","Solano","Alquicira","2016-02-06","7776017214","Calle aztecap","jesus","Colocador");
/*!40000 ALTER TABLE `catalogoempleado` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `catalogoherramienta`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `catalogoherramienta` (
  `FolioHerra` int(11) NOT NULL AUTO_INCREMENT,
  `NombreHerra` varchar(45) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `PrecioHerra` float NOT NULL,
  `Especificaciones` varchar(45) NOT NULL,
  PRIMARY KEY (`FolioHerra`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `catalogoherramienta` WRITE;
                                /*!40000 ALTER TABLE `catalogoherramienta` DISABLE KEYS */;/*!40000 ALTER TABLE `catalogoherramienta` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `catalogomateriaprima`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `catalogomateriaprima` (
  `FolioMat` int(11) NOT NULL AUTO_INCREMENT,
  `FolioAdmin` int(11) NOT NULL,
  `NombreMat` varchar(45) NOT NULL,
  `NombreSuc` varchar(45) NOT NULL,
  `MedidasMat` varchar(45) NOT NULL,
  `TipoMadera` varchar(45) NOT NULL,
  `CantidadMat` int(11) NOT NULL,
  `PrecioMat` float NOT NULL,
  PRIMARY KEY (`FolioMat`),
  KEY `fkMat_Ad` (`FolioAdmin`),
  CONSTRAINT `fkMat_Ad` FOREIGN KEY (`FolioAdmin`) REFERENCES `catalogoadministrador` (`FolioAdmin`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `catalogomateriaprima` WRITE;
                                /*!40000 ALTER TABLE `catalogomateriaprima` DISABLE KEYS */;/*!40000 ALTER TABLE `catalogomateriaprima` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `catalogoproducto`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `catalogoproducto` (
  `FolioProd` int(11) NOT NULL AUTO_INCREMENT,
  `NombreProd` varchar(45) NOT NULL,
  `Medidas` varchar(45) NOT NULL,
  `Categoria` varchar(45) NOT NULL,
  `Precio` float NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Nombreimg` varchar(45) NOT NULL,
  PRIMARY KEY (`FolioProd`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `catalogoproducto` WRITE;
                                /*!40000 ALTER TABLE `catalogoproducto` DISABLE KEYS */;/*!40000 ALTER TABLE `catalogoproducto` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `citas`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `citas` (
  `folio_citas` int(11) NOT NULL AUTO_INCREMENT,
  `IdCliente` int(11) NOT NULL,
  `fecha_hora_cita` datetime NOT NULL,
  `lugar_cita` text NOT NULL,
  `asunto` text NOT NULL,
  PRIMARY KEY (`folio_citas`),
  KEY `C_CC` (`IdCliente`),
  CONSTRAINT `C_CC` FOREIGN KEY (`IdCliente`) REFERENCES `catalogocliente` (`IdCliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `citas` WRITE;
                                /*!40000 ALTER TABLE `citas` DISABLE KEYS */;/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `insumo`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `insumo` (
  `folioinsumo` int(11) NOT NULL AUTO_INCREMENT,
  `FolioProd` int(11) NOT NULL,
  `FolioMat` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  PRIMARY KEY (`folioinsumo`),
  KEY `ytdhy` (`FolioProd`),
  KEY `dtyh` (`FolioMat`),
  CONSTRAINT `dtyh` FOREIGN KEY (`FolioMat`) REFERENCES `catalogomateriaprima` (`FolioMat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ytdhy` FOREIGN KEY (`FolioProd`) REFERENCES `catalogoproducto` (`FolioProd`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `insumo` WRITE;
                                /*!40000 ALTER TABLE `insumo` DISABLE KEYS */;/*!40000 ALTER TABLE `insumo` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `phch`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `phch` (
  `idPhch` int(11) NOT NULL AUTO_INCREMENT,
  `idPh` int(11) DEFAULT NULL,
  `FolioHerra` int(11) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPhch`),
  KEY `catalogoherramienta_PhCh` (`FolioHerra`),
  KEY `prestacionHerramientas_PhCh` (`idPh`),
  CONSTRAINT `catalogoherramienta_PhCh` FOREIGN KEY (`FolioHerra`) REFERENCES `catalogoherramienta` (`FolioHerra`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prestacionHerramientas_PhCh` FOREIGN KEY (`idPh`) REFERENCES `prestacionherramientas` (`idPh`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `phch` WRITE;
                                /*!40000 ALTER TABLE `phch` DISABLE KEYS */;/*!40000 ALTER TABLE `phch` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `prestacionherramientas`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `prestacionherramientas` (
  `idPh` int(11) NOT NULL AUTO_INCREMENT,
  `IdEmpleados` int(11) DEFAULT NULL,
  `FechaPrestacion` date DEFAULT NULL,
  `Estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPh`),
  KEY `ph_ce` (`IdEmpleados`),
  CONSTRAINT `ph_ce` FOREIGN KEY (`IdEmpleados`) REFERENCES `catalogoempleado` (`IdEmpleados`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `prestacionherramientas` WRITE;
                                /*!40000 ALTER TABLE `prestacionherramientas` DISABLE KEYS */;/*!40000 ALTER TABLE `prestacionherramientas` ENABLE KEYS */;
                                UNLOCK TABLES;


DROP TABLE IF EXISTS `roles`;
                /*!40101 SET @saved_cs_client     = @@character_set_client */;
                /*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `roles` (
  `folio` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) NOT NULL,
  PRIMARY KEY (`folio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `roles` WRITE;
                                /*!40000 ALTER TABLE `roles` DISABLE KEYS */;/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
                                UNLOCK TABLES;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
            /*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
            /*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
            /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
            /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
            /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
            /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;