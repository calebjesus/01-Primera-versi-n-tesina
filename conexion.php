<?php

class Basededatos{
    private static $instancia=NULL;

    public static function CreateInstancia(){

        if(!isset(self::$instancia)){
            $opcionesPDO[PDO::ATTR_ERRMODE]= PDO::ERRMODE_EXCEPTION;

            self::$instancia= new PDO('mysql:host=localhost;dbname=BD02;charset=utf8mb4','root','',$opcionesPDO);
          //  echo"Exito en la conexión";
        }

        return self::$instancia;
    }

}

?>