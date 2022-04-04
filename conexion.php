<?php

class Basededatos{
    private static $instancia=NULL;

    public static function CreateInstancia(){

        if(!isset(self::$instancia)){
            $opcionesPDO[PDO::ATTR_ERRMODE]= PDO::ERRMODE_EXCEPTION;
            /*Se crea la instancia PDO para la conexión ingresando el nombre de la base de datos, usuario, y contraseña*/
            self::$instancia=new PDO('mysql:host=localhost;dbname=bd02;charset=utf8mb4','root','',$opcionesPDO);
        }

        return self::$instancia;
    }

}

?>