/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

            /*!50503 SET NAMES utf8 */;

            /*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;

            /*!40103 SET TIME_ZONE='+00:00' */;

            /*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;

            /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

            /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

            /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `apartado`;
                
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `apartado` WRITE;
                                /*!40000 ALTER TABLE `apartado` DISABLE KEYS */;
INSERT INTO apartado VALUES
("2","4","2021-01-14","2021-01-24","75000","1"),
("7","5","2022-01-17","2022-01-27","150000","1"),
("8","4","2022-02-28","2022-01-28","225000","1"),
("13","4","2022-02-28","2022-01-26","100000","1");
/*!40000 ALTER TABLE `apartado` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `apartadoproducto` WRITE;
                                /*!40000 ALTER TABLE `apartadoproducto` DISABLE KEYS */;
INSERT INTO apartadoproducto VALUES
("1","33","2","1","75000"),
("2","33","7","2","75000"),
("3","33","8","3","75000"),
("4","32","13","1","50000"),
("5","32","13","1","50000");
/*!40000 ALTER TABLE `apartadoproducto` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `calculadora` WRITE;
                                /*!40000 ALTER TABLE `calculadora` DISABLE KEYS */;
INSERT INTO calculadora VALUES
("7","31","1","56","2"),
("8","32","1","4224","4"),
("9","33","1","5504","5");
/*!40000 ALTER TABLE `calculadora` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `carritotemporal` WRITE;
                                /*!40000 ALTER TABLE `carritotemporal` DISABLE KEYS */;
/*!40000 ALTER TABLE `carritotemporal` ENABLE KEYS */;
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
  `Contrasena` char(60) NOT NULL,
  PRIMARY KEY (`FolioAdmin`),
  KEY `rol_jk` (`folio`),
  CONSTRAINT `rol_jk` FOREIGN KEY (`folio`) REFERENCES `roles` (`folio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `catalogoadministrador` WRITE;
                                /*!40000 ALTER TABLE `catalogoadministrador` DISABLE KEYS */;
INSERT INTO catalogoadministrador VALUES
("4","1","ADELFO","solano","ABAD","Adelfo@gmail.com","$2y$10$5DqGWw.v9H0zTyFDs1x9eOhU/2FtGsdHOccqaLmYBsN/bB8rujsZm"),
("5","1","ADRIANA","RODRIGUEZ","MOLANO","ADRIANA@upemor.edu.mx","$2y$10$IiDZngeezmWRRN/lnXYtm.DKq/NIV.8lky3n8HF.IAJQrv/glA3ZG"),
("6","1","CAMILA","FLOREZ","VELEZ","CAMILA@upemor.edu.mx","$2y$10$zhtWQe7TqLQLzkUP9RIOZ.1Qm0H1E6tUnB9Nq0QAMZSTd6W4CaGxe"),
("7","1","CARLOS JOSE","LATORRE","BORRERO","CARLOSJOSE@gmail.com","$2y$10$dO6EXZnnAfhkDTEJsKz3o.3ngO2bEeq8EGumVQKGzDThjOhC87.t6"),
("1","1","jesus","solano","alquicira","2","$2y$10$kjO/T.b6n2.12VS8gBLv8uMkqstQlMG6NrbzeJYkfIZLFtL.JglxC");
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
  `Contrasena` char(60) NOT NULL,
  PRIMARY KEY (`IdCliente`),
  KEY `rol_Cl` (`folio`),
  CONSTRAINT `rol_Cl` FOREIGN KEY (`folio`) REFERENCES `roles` (`folio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `catalogocliente` WRITE;
                                /*!40000 ALTER TABLE `catalogocliente` DISABLE KEYS */;
INSERT INTO catalogocliente VALUES
("4","2","PATRICIA HELENA","ARBELAEZ","HOYOS","1978-02-02","7774432525","Calle Isidro Díaz 14, frente a la playa en el antiguo pueblo de pescadores","patricia@gmail.com","$2y$10$AAJyw9fWzxUqZ.huD0C9wO5gmy9jPMZ94kBq7yoCMkurGfVbS0PJu"),
("5","2","VICTOR","DIAZ","MEDINA","1999-05-06","7774432521","Naturalista Rafael Cisternas, 4 planta 1 puerta 6, 46010 Valencia.","arber@gmail.com","$2y$10$sr13fshp08AhnLunbQOuU.VdbxZgfT27IainR.lFnhsHxKIvEA1Fu");
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `catalogoempleado` WRITE;
                                /*!40000 ALTER TABLE `catalogoempleado` DISABLE KEYS */;
INSERT INTO catalogoempleado VALUES
("13","DAVID","VILLAREZ","SOLANO","1997-02-06","7776017214","Dirección: Calle ","DAVID@gmail.com","Colocador"),
("14","JORGE HUMBERTO","OJEDA","BUENO","1974-02-20","7358117816","AVENIDA NIÑOS HEROES NO. 3","OJEDA@gmail.com","Pulidor"),
("15","JUAN MANUEL","BARBERO","PAREDES","1990-05-18","7351781135","CARRETERA MEXICO-LAREDO KM.125","JUANMANUEL@gmail.com","Colocador");
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `catalogoherramienta` WRITE;
                                /*!40000 ALTER TABLE `catalogoherramienta` DISABLE KEYS */;
INSERT INTO catalogoherramienta VALUES
("1","martillo","18","250","Bosch"),
("2","Taladro","23","700","Bosch, color azul."),
("3","Router","14","5000","Bosch, Color amarillo.");
/*!40000 ALTER TABLE `catalogoherramienta` ENABLE KEYS */;
                                UNLOCK TABLES;



DROP TABLE IF EXISTS `catalogomateriaprima`;
                
/*!40101 SET @saved_cs_client     = @@character_set_client */;
                
/*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `catalogomateriaprima` (
  `FolioMat` int(11) NOT NULL AUTO_INCREMENT,
  `NombreMat` varchar(45) NOT NULL,
  `NombreSuc` varchar(45) NOT NULL,
  `MedidasMat` varchar(45) NOT NULL,
  `TipoMadera` varchar(45) NOT NULL,
  `CantidadMat` int(11) NOT NULL,
  `PrecioMat` float NOT NULL,
  PRIMARY KEY (`FolioMat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `catalogomateriaprima` WRITE;
                                /*!40000 ALTER TABLE `catalogomateriaprima` DISABLE KEYS */;
INSERT INTO catalogomateriaprima VALUES
("1","tablón","santa cruz","18*58*45","palo de rosa","56","56"),
("2","tablón","santa isabel","18*58*45","palo de rosa","56","250"),
("3","tablón","madereria lucia","18*58*45","palo de rosa","100","300"),
("4","Laja","Santa Cruz","25*50*269","palo de rosa","210","500"),
("5","Polin","Santa Cruz","18*58*45","palo de rosa","62","500");
/*!40000 ALTER TABLE `catalogomateriaprima` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `catalogoproducto` WRITE;
                                /*!40000 ALTER TABLE `catalogoproducto` DISABLE KEYS */;
INSERT INTO catalogoproducto VALUES
("31","Librero tronco","250 cm* 207 cm* 480 cm","libreros","50000","17","librerotronco.png.png"),
("32","Cajonero parota","15 cm * 20 cm * 40 cm","Cajoneros parota","50000","8","cajonerparota.png"),
("33","Librero de arbol","15 cm * 20 cm * 40 cm","Librero parota","75000","9","Libreroarbol.png");
/*!40000 ALTER TABLE `catalogoproducto` ENABLE KEYS */;
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
  KEY `CThvguyk_CC` (`IdCliente`),
  CONSTRAINT `CThvguyk_CC` FOREIGN KEY (`IdCliente`) REFERENCES `catalogocliente` (`IdCliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `citas` WRITE;
                                /*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO citas VALUES
("1","4","2022-02-18 16:15:00","Morelos Ocuituco rancho nuevo Azteca # 12","Cotizar un hotel");
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
                                UNLOCK TABLES;



DROP TABLE IF EXISTS `inicio`;
                
/*!40101 SET @saved_cs_client     = @@character_set_client */;
                
/*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `inicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` text NOT NULL,
  `telefono1` text NOT NULL,
  `telefono2` text NOT NULL,
  `correoelectroncio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `inicio` WRITE;
                                /*!40000 ALTER TABLE `inicio` DISABLE KEYS */;
INSERT INTO inicio VALUES
("1","Calle: Azteca 12, Colonia: Rancho nuevo Yautepec Morelos 62733","(+52) 777 601 72 17","(+52) 777 206 50 74 ","adelfo197433@gmail.com");
/*!40000 ALTER TABLE `inicio` ENABLE KEYS */;
                                UNLOCK TABLES;



DROP TABLE IF EXISTS `inicio_sesion`;
                
/*!40101 SET @saved_cs_client     = @@character_set_client */;
                
/*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `inicio_sesion` (
  `folio` int(11) NOT NULL AUTO_INCREMENT,
  `folioadmin` int(11) NOT NULL,
  `fechainicio` datetime NOT NULL,
  PRIMARY KEY (`folio`),
  KEY `inicio_sesion_Administradores` (`folioadmin`),
  CONSTRAINT `inicio_sesion_Administradores` FOREIGN KEY (`folioadmin`) REFERENCES `catalogoadministrador` (`FolioAdmin`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `inicio_sesion` WRITE;
                                /*!40000 ALTER TABLE `inicio_sesion` DISABLE KEYS */;
INSERT INTO inicio_sesion VALUES
("2","7","2022-03-25 06:17:11"),
("4","7","2022-03-26 05:34:59"),
("5","7","2022-03-26 05:45:20"),
("6","7","2022-03-28 01:13:39"),
("7","7","2022-03-28 01:33:16"),
("8","7","2022-03-28 01:43:27"),
("9","7","2022-03-28 06:35:19"),
("10","7","2022-03-28 07:18:48");
/*!40000 ALTER TABLE `inicio_sesion` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `insumo` WRITE;
                                /*!40000 ALTER TABLE `insumo` DISABLE KEYS */;
INSERT INTO insumo VALUES
("26","31","1","3"),
("27","31","3","3"),
("28","32","5","5"),
("29","32","1","4"),
("30","32","4","3"),
("31","33","5","4"),
("32","33","1","9"),
("33","33","4","6");
/*!40000 ALTER TABLE `insumo` ENABLE KEYS */;
                                UNLOCK TABLES;



DROP TABLE IF EXISTS `municipios`;
                
/*!40101 SET @saved_cs_client     = @@character_set_client */;
                
/*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `municipios` (
  `idm` int(11) NOT NULL AUTO_INCREMENT,
  `municipio` text NOT NULL,
  `estado` text NOT NULL,
  PRIMARY KEY (`idm`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `municipios` WRITE;
                                /*!40000 ALTER TABLE `municipios` DISABLE KEYS */;
INSERT INTO municipios VALUES
("1","Morelos","Amacuzac"),
("2","Morelos","Atlatlahucan"),
("3","Morelos","Axochiapan"),
("4","Morelos","Ayala"),
("5","Morelos","Coatlán del Río"),
("6","Morelos","Cuautla"),
("7","Morelos","Cuernavaca"),
("8","Morelos","Emiliano Zapata"),
("9","Morelos","Huitzilac"),
("10","Morelos","Jantetelco"),
("11","Morelos","Jiutepec"),
("12","Morelos","Jojutla"),
("13","Morelos","Mazatepec"),
("14","Morelos","Miacatlán"),
("15","Morelos","Ocuituco"),
("16","Morelos","Puente de Ixtla"),
("17","Morelos","Yautepec");
/*!40000 ALTER TABLE `municipios` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `phch` WRITE;
                                /*!40000 ALTER TABLE `phch` DISABLE KEYS */;
INSERT INTO phch VALUES
("2","11","1","2","0"),
("3","11","2","2","1"),
("4","11","3","1","1");
/*!40000 ALTER TABLE `phch` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `prestacionherramientas` WRITE;
                                /*!40000 ALTER TABLE `prestacionherramientas` DISABLE KEYS */;
INSERT INTO prestacionherramientas VALUES
("11","13","2022-02-15","1");
/*!40000 ALTER TABLE `prestacionherramientas` ENABLE KEYS */;
                                UNLOCK TABLES;



DROP TABLE IF EXISTS `roles`;
                
/*!40101 SET @saved_cs_client     = @@character_set_client */;
                
/*!50503 SET character_set_client = utf8mb4 */;

CREATE TABLE `roles` (
  `folio` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(45) NOT NULL,
  PRIMARY KEY (`folio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */;
                                LOCK TABLES `roles` WRITE;
                                /*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO roles VALUES
("1","administrador"),
("2","cliente");
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
                                UNLOCK TABLES;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
            /*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
            /*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
            /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
            /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
            /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
            /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;