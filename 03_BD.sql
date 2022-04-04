drop database bd02;

create database BD02;
use BD02;

create table inicio(
id int not null primary key auto_increment,
direccion text not null,
telefono1 text not null,
telefono2 text not null,
correoelectroncio text not null
);
ALTER TABLE inicio AUTO_INCREMENT=000;

create table municipios(
idm int not null primary key auto_increment,
municipio text not null,
estado  text not null
);
ALTER TABLE municipios AUTO_INCREMENT=000;

create table CatalogoEmpleado(
IdEmpleados INT NOT NULL primary key auto_increment,
Nombre VARCHAR(45) NOT NULL,
APEmp VARCHAR(45) NOT NULL,
AMEmp VARCHAR(45) NOT NULL,
FechaNacimiento DATE NOT NULL,
Telefono VARCHAR(45) NOT NULL,
Direccion TEXT NOT NULL,
CorreoElectronico VARCHAR(45) NOT NULL,
TipoEmpleado VARCHAR(45) NOT NULL);
ALTER TABLE CatalogoEmpleado AUTO_INCREMENT=000;
/*---------------------------------------------------------------------*/
create table roles(
folio int NOT NULL primary key auto_increment,
rol VARCHAR(45) NOT NULL
); ALTER TABLE roles AUTO_INCREMENT=000;

/*---------------------------------------------------------------------*/
create table CatalogoAdministrador(
FolioAdmin INT NOT NULL primary key auto_increment,
folio INT NOT NULL,
Nombre VARCHAR(45) NOT NULL,
APAdmin VARCHAR(45) NOT NULL,
AMAdmin VARCHAR(45) NOT NULL,
CorreoElectronico VARCHAR(45) NOT NULL,
Contrasena CHAR(60) NOT NULL,
CONSTRAINT rol_jk FOREIGN KEY (folio)
REFERENCES roles(folio)
ON DELETE CASCADE
ON UPDATE CASCADE) ENGINE = InnoDB;
ALTER TABLE CatalogoAdministrador AUTO_INCREMENT=000;

/*---------------------------------------------------------------------*/
create table CatalogoHerramienta(
FolioHerra INT NOT NULL primary key auto_increment,
NombreHerra VARCHAR(45) NOT NULL,
Cantidad int NOT NULL,
PrecioHerra float NOT NULL,
Especificaciones VARCHAR(45) NOT NULL);
ALTER TABLE CatalogoHerramienta AUTO_INCREMENT=000;
/*---------------------------------------------------------------------*/
create table CatalogoMateriaPrima(
FolioMat INT NOT NULL primary key auto_increment,
NombreMat VARCHAR(45) NOT NULL,
NombreSuc VARCHAR(45) NOT NULL,
MedidasMat VARCHAR(45) NOT NULL,
TipoMadera VARCHAR(45) NOT NULL,
CantidadMat INT NOT NULL,
PrecioMat FLOAT NOT NULL);
ALTER TABLE CatalogoHerramienta AUTO_INCREMENT=000;
/*---------------------------------------------------------------------*/

create table CatalogoCliente(
IdCliente INT NOT NULL primary key auto_increment,
folio INT NOT NULL,
NombreClien VARCHAR(45) NOT NULL,
APClien VARCHAR(45) NOT NULL,
AMClien VARCHAR(45) NOT NULL,
FechaNacimiento DATE NOT NULL,
Telefono VARCHAR(45) NOT NULL,
Direccion TEXT NOT NULL,
CorreoElectronico VARCHAR(45) NOT NULL,
Contrasena CHAR(60) NOT NULL,
CONSTRAINT rol_Cl FOREIGN KEY (folio)
REFERENCES roles(folio)
ON DELETE CASCADE
ON UPDATE CASCADE) ENGINE = InnoDB;
ALTER TABLE CatalogoCliente AUTO_INCREMENT=000;
/*---------------------------------------------------------------------*/
create table CatalogoProducto(
FolioProd INT NOT NULL primary key auto_increment,
NombreProd VARCHAR(45) NOT NULL,
Medidas VARCHAR(45) NOT NULL,
Categoria VARCHAR(45) NOT NULL,
Precio FLOAT NOT NULL,
Cantidad INT NOT NULL,
Nombreimg VARCHAR(45) NOT NULL);
ALTER TABLE CatalogoProducto AUTO_INCREMENT=000;
/*---------------------------------------------------------------------*/

/*---------------------------------------------------------------------*/
create table Apartado(
FolioApartado INT NOT NULL primary key auto_increment,
IdCliente INT NOT NULL,
Fecha DATE,
FechaVencimiento DATE,
PrecioTotal FLOAT,
estado int,
CONSTRAINT A_C FOREIGN KEY (IdCliente)
REFERENCES CatalogoCliente(IdCliente)
ON DELETE CASCADE
ON UPDATE CASCADE) ENGINE = InnoDB;
ALTER TABLE Apartado AUTO_INCREMENT=000;

/*---------------------------------------------------------------------*/
create table ApartadoProducto(
FolioAp INT NOT NULL primary key auto_increment,
FolioProd INT NOT NULL,
FolioApartado INT NOT NULL,
Cantidad INT,
PrecioTotal FLOAT,
CONSTRAINT AP_CP FOREIGN KEY (FolioProd)
REFERENCES CatalogoProducto(FolioProd)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT A_AP FOREIGN KEY (FolioApartado)
REFERENCES Apartado(FolioApartado)
ON DELETE CASCADE
ON UPDATE CASCADE
) ENGINE = InnoDB;
ALTER TABLE ApartadoProducto AUTO_INCREMENT=000;
/*---------------------------------------------------------------------*/
create table CarritoTemporal(
idCarritoTemporal INT NOT NULL primary key auto_increment,
IdCliente INT NOT NULL,
FolioProd INT NOT NULL,
Cantidad INT  NOT NULL,
Estatus INT  NOT NULL,
CONSTRAINT CTh_CC FOREIGN KEY (IdCliente)
REFERENCES CatalogoCliente(IdCliente)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT CTy_CP FOREIGN KEY (FolioProd)
REFERENCES CatalogoProducto(FolioProd)
ON DELETE CASCADE
ON UPDATE CASCADE
) ENGINE = InnoDB;
ALTER TABLE CarritoTemporal AUTO_INCREMENT=000;

/*create table CarritoTemporal(
idCarritoTemporal INT NOT NULL primary key auto_increment,
IdCliente INT NOT NULL,
FolioProd INT NOT NULL,
Cantidad INT  NOT NULL,
Estatus INT  NOT NULL,
CONSTRAINT CTh_CC FOREIGN KEY (IdCliente)
REFERENCES CatalogoCliente(IdCliente)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT CTy_CP FOREIGN KEY (FolioProd)
REFERENCES CatalogoProducto(FolioProd)
ON DELETE CASCADE
ON UPDATE CASCADE
) ENGINE = InnoDB;
ALTER TABLE CarritoTemporal AUTO_INCREMENT=000;*/
/*---------------------------------------------------------------------*/
create table Citas(
folio_citas INT NOT NULL primary key auto_increment,
IdCliente INT NOT NULL,
fecha_hora_cita DATETIME NOT NULL,
lugar_cita TEXT NOT NULL,
asunto TEXT NOT NULL,
CONSTRAINT CThvguyk_CC FOREIGN KEY (IdCliente)
REFERENCES CatalogoCliente(IdCliente)
ON DELETE CASCADE
ON UPDATE CASCADE
) ENGINE = InnoDB;
ALTER TABLE Citas AUTO_INCREMENT=000;


/*---------------------------------------------------------------------*/
create table insumo(
folioinsumo INT NOT NULL primary key auto_increment,
FolioProd INT NOT NULL,
FolioMat INT NOT NULL,
Cantidad INT NOT NULL,
CONSTRAINT ytdhy FOREIGN KEY (FolioProd)
REFERENCES CatalogoProducto(FolioProd)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT dtyh FOREIGN KEY (FolioMat)
REFERENCES Catalogomateriaprima(FolioMat)
ON DELETE CASCADE
ON UPDATE CASCADE
) ENGINE = InnoDB;
ALTER TABLE insumo AUTO_INCREMENT=000;
/*---------------------------------------------------------------------*/
create table calculadora(
idcalculadora INT NOT NULL primary key auto_increment,
FolioProd int,
FolioAdmin int,
precio float,
cantidad int,
CONSTRAINT c_fa FOREIGN KEY (FolioAdmin)
REFERENCES CatalogoAdministrador(FolioAdmin)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT c_cp FOREIGN KEY (FolioProd)
REFERENCES CatalogoProducto(FolioProd)
ON DELETE CASCADE
ON UPDATE CASCADE
)ENGINE = InnoDB;
ALTER TABLE calculadora AUTO_INCREMENT=000;
select * from catalogoadministrador;
/*---------------------------------------------------------------------*/
create table prestacionHerramientas(
idPh INT NOT NULL primary key auto_increment,
IdEmpleados int,
FechaPrestacion date,
Estado int,
CONSTRAINT ph_ce FOREIGN KEY (IdEmpleados)
REFERENCES CatalogoEmpleado(IdEmpleados)
ON DELETE CASCADE
ON UPDATE CASCADE
)ENGINE = InnoDB;
ALTER TABLE prestacionHerramientas AUTO_INCREMENT=000;
/*---------------------------------------------------------------------*/
create table PhCh(
idPhch INT NOT NULL primary key auto_increment,
idPh int,
FolioHerra int,
Cantidad int,
Estado int,
CONSTRAINT catalogoherramienta_PhCh FOREIGN KEY (FolioHerra)
REFERENCES catalogoherramienta(FolioHerra)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT prestacionHerramientas_PhCh FOREIGN KEY (idPh)
REFERENCES prestacionHerramientas(idPh)
ON DELETE CASCADE
ON UPDATE CASCADE
)ENGINE = InnoDB;
ALTER TABLE PhCh AUTO_INCREMENT=000;
/*---------------------------------------------------------------------*/
create table inicio_sesion(
folio int NOT NULL primary key auto_increment,
folioadmin int not null,
fechainicio datetime not null,
CONSTRAINT inicio_sesion_Administradores FOREIGN KEY (folioadmin)
REFERENCES catalogoadministrador(folioadmin)
ON DELETE CASCADE
ON UPDATE CASCADE
)ENGINE = InnoDB;
ALTER TABLE inicio_sesion AUTO_INCREMENT=000;
/*---------------------------------------------------------------------*/

select * from roles;
select * from catalogomateriaprimacatalogomateriaprima;
use bd02;
select *from apartado;
select * from prestacionHerramientas;
select * from catalogocliente;

select * from catalogoadministrador;
select * from catalogoproducto;

SELECT nombreprod, sum(apartadoproducto.cantidad) as coteo_productos ,sum(apartadoproducto.preciototal) as precio
        from apartadoproducto
        INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd = apartadoproducto.FolioProd
        INNER JOIN apartado ON apartado.FolioApartado = apartadoproducto.FolioApartado  
        where year(fecha) = '2022'
        group by apartadoproducto.FolioProd;


SELECT CorreoElectronico, nombreclien, count(apartado.Idcliente) as conteo_compras from apartado 
        INNER JOIN Catalogocliente ON apartado.IdCliente=Catalogocliente.IdCliente
        where MONTH(fecha) = MONTH(NOW())-1
        group by apartado.idcliente;

select *from apartado;
select FolioApartado, correoelectronico, fecha, fechavencimiento, preciototal
from apartado
INNER JOIN Catalogocliente ON Catalogocliente.Idcliente = apartado.Idcliente
where estado=1
order by fechavencimiento;


SELECT  idPh,correoelectronico,FechaPrestacion,Estado from prestacionHerramientas
INNER JOIN Catalogoempleado ON Catalogoempleado.IdEmpleados = prestacionHerramientas.IdEmpleados 
order by fechaprestacion and estado=1 desc;



select idPhch, idPh, NombreHerra, phch.Cantidad, Estado  
from phch
INNER JOIN Catalogoherramienta ON phch.Folioherra = Catalogoherramienta.Folioherra;

select if(cantidad<11,'ya no hay herramientas',"hay herramientas")
from catalogoherramienta
where folioherra=2;

select PhCh.idPh,if(prestacionHerramientas.idPh=PhCh.idPh,0,correoelectronico) as correo
from PhCh
INNER JOIN prestacionHerramientas ON prestacionHerramientas.idPh = PhCh.idPh
INNER JOIN Catalogoempleado ON Catalogoempleado.IdEmpleados = prestacionHerramientas.IdEmpleados;

select idempleados, PhCh.idph
from prestacionHerramientas
INNER JOIN PhCh ON prestacionHerramientas.idPh = PhCh.idPh;

select idempleados, correoelectronico, nombre, APEmp,AMEmp from catalogoempleado;
select * from prestacionHerramientas;

select  idPh,correoelectronico,FechaPrestacion,Estado from prestacionHerramientas
INNER JOIN Catalogoempleado ON Catalogoempleado.IdEmpleados = prestacionHerramientas.IdEmpleados
order by fechaprestacion desc;



select  folioprod from calculadora where folioprod = 28;
select  folioprod from calculadora;


SELECT catalogoproducto.nombreprod as producto, calculadora.precio*calculadora.cantidad as precio, calculadora.cantidad as cantidad
from calculadora
INNER JOIN Catalogoproducto ON Catalogoproducto.Folioprod = calculadora.Folioprod;



select catalogoproducto.nombreprod, calculadora.precio
from calculadora
INNER JOIN Catalogoproducto ON Catalogoproducto.Folioprod = calculadora.Folioprod;
select * from calculadora;

select * from insumo;
select * from catalogoproducto;
select * from catalogomateriaprima;

SELECT folioprod, nombreprod, categoria
from catalogoproducto;



select folioinsumo, nombremat, preciomat, insumo.cantidad as cantidad
from insumo
INNER JOIN Catalogomateriaprima ON Catalogomateriaprima.FolioMat = insumo.FolioMat
where FolioProd=26;

select Catalogoproducto.nombreprod as producto, sum(insumo.cantidad*catalogomateriaprima.PrecioMat) as precio_insumo
from insumo
INNER JOIN Catalogomateriaprima ON Catalogomateriaprima.FolioMat = insumo.FolioMat
INNER JOIN Catalogoproducto ON Catalogoproducto.Folioprod = insumo.Folioprod
where insumo.folioprod = 28
group by nombreprod;


select folioApartado, NombreProd, apartadoproducto.Cantidad, PrecioTotal 
from apartadoproducto
INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd = apartadoproducto.FolioProd
where folioApartado = 68;


select * from Apartado;
select FolioApartado, Fecha, FechaVencimiento, PrecioTotal
from apartado
where IdCliente = 2;



select idCarritoTemporal, carritotemporal.folioprod, carritotemporal.cantidad, Catalogoproducto.precio
from carritotemporal
INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd = carritotemporal.FolioProd
where IdCliente=2 and estatus=1;

/*---------------------------------------------------------------------*/
select sum(carritotemporal.cantidad*Catalogoproducto.Precio)  as PrecioTotal
from carritotemporal
INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd =carritotemporal.FolioProd
where carritotemporal.IdCliente='2' and Estatus='1';

select * from apartado;
select max(FolioApartado) as folio
from Apartado
where IdCliente='2' and fecha='2022-01-28' and fechavencimiento='2022-02-07' and preciototal=14174;



/*---------------------------------------------------------------------*/
/*---------------------------------------------------------------------*/
/*---------------------------------------------------------------------*/


Select NombreProd ,Medidas,Precio,CarritoTemporal.Cantidad from carritotemporal   
INNER JOIN Catalogocliente ON carritotemporal.IdCliente=Catalogocliente.IdCliente  
INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd =carritotemporal.FolioProd
where carritotemporal.IdCliente='1' and Estatus='1';


SELECT nombre_Unidad FROM usuario_profesor 
INNER JOIN cursos ON usuario_profesor.id_Profesor=cursos.id_Profesor 
INNER JOIN unidades ON unidades.id_Curso=cursos.id_Curso 
LEFT JOIN examen ON examen.id_Unidad=unidades.id_Unidad 
WHERE usuario_profesor.id_Profesor=5 AND cursos.id_Curso=32 AND Examen.id_Unidad is null;

select * from carritotemporal;
UPDATE  carritotemporal SET Cantidad=(Cantidad+4) WHERE idCarritoTemporal=10;
select * from carritotemporal;

Select NombreProd ,Medidas,Precio,sum(CarritoTemporal.Cantidad) from carritotemporal   
INNER JOIN Catalogocliente ON carritotemporal.IdCliente=Catalogocliente.IdCliente  
INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd =carritotemporal.FolioProd
where carritotemporal.IdCliente='1' and Estatus='1' group by NombreProd;

 SELECT * FROM carritotemporal WHERE FolioProd=1 and  IdCliente=1 and Estatus = 1;

select * from catalogoproducto;
select * from carritotemporal;


select nombreprod, catalogoproducto.cantidad as cantidad_dispobible, 
if(carritotemporal.Cantidad>catalogoproducto.cantidad,1,0)  as validacion 
from carritotemporal
INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd =carritotemporal.FolioProd
where IdCliente = 3;

select * from ApartadoProducto;
select * from carritotemporal;
select * from Apartado;
select * from catalogoadministrador;
select * from Catalogoproducto;
select * from catalogocliente;
select * from Catalogoproducto;
select * from carritotemporal;

select Folioprod, cantidad
from apartado
INNER JOIN ApartadoProducto ON apartado.FolioApartado = ApartadoProducto.FolioApartado
where  apartado.folioapartado = 98;


select * from catalogoproducto;
UPDATE  catalogoproducto SET Cantidad=Cantidad - 6  WHERE FolioProd=1;
select * from catalogoproducto;

select CorreoElectronico, nombreclien, count(apartado.Idcliente) as conteo_compras from apartado 
INNER JOIN Catalogocliente ON apartado.IdCliente=Catalogocliente.IdCliente
where MONTH(fecha) = MONTH(NOW())-1
group by apartado.idcliente;

select CorreoElectronico, nombreclien, count(apartado.Idcliente) as conteo_compras from apartado 
INNER JOIN Catalogocliente ON apartado.IdCliente=Catalogocliente.IdCliente
where MONTH(fecha) = MONTH(NOW())-1
group by apartado.idcliente;




select nombreprod, sum(apartadoproducto.cantidad) as coteo_productos ,sum(apartadoproducto.preciototal) as precio
from apartadoproducto
INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd = apartadoproducto.FolioProd
INNER JOIN apartado ON apartado.FolioApartado = apartadoproducto.FolioApartado
where year(fecha) = "2021"
group by apartadoproducto.FolioProd;

select * from apartado;
select * from apartadoproducto;

SET lc_time_names = 'es_MX';
select DISTINCT monthname(fecha) as meses_disponibles
from apartado
order by fecha;

select nombreprod, sum(apartadoproducto.cantidad) as coteo_productos ,sum(apartadoproducto.preciototal) as precio
from apartadoproducto
INNER JOIN Catalogoproducto ON Catalogoproducto.FolioProd = apartadoproducto.FolioProd
INNER JOIN apartado ON apartado.FolioApartado = apartadoproducto.FolioApartado
where year(fecha) = "2021" and monthname(fecha)="junio"
group by apartadoproducto.FolioProd;

select nombremat, nombresuc, min(preciomat), cantidadmat
from catalogomateriaprima
where nombremat ='tablón' 
group by preciomat;


select * from catalogomateriaprima;


SELECT CorreoElectronico, nombreclien, count(apartado.Idcliente) as conteo_compras from apartado 
INNER JOIN Catalogocliente ON apartado.IdCliente=Catalogocliente.IdCliente
where MONTH(fecha) = MONTH(NOW())-1
group by apartado.idcliente;

select * from apartadoproducto;
select * from apartado;

select foliomat, nombremat, nombresuc, preciomat
from catalogomateriaprima;















