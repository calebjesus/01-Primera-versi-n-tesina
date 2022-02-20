<?php

class Login{

    public $usuario;
    public $pass;
   

    public function __construct($usuario, $pass){
        $this->usuario=$usuario;
        $this->pass=$pass;
    }


    public static function buscar($usuario, $pass){
        
        session_start();

        if(isset($_SESSION['rol'])){
            switch($_SESSION['rol']){
                case 1:
                    header("Location: http://localhost/CarpinteriaGral/?controlador=Administrador&accion=inicio");
                break;
        
                case 2:
                    header("Location: http://localhost/CarpinteriaGral/?controlador=Cliente&accion=inicio");
                break;
        
                default:
            }
    
        }
        
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoadministrador WHERE CorreoElectronico=? AND Contrasena=?");
        $sql->execute(array($usuario,$pass));
        $admin=$sql->fetch(PDO::FETCH_NUM);
        
        if($admin == true){
            $rol     =  $admin[1]; 
            $idAdmin =  $admin[0];
            
            $_SESSION['rol'] = $rol;
            $_SESSION['id']  = $idAdmin;
            
            switch($_SESSION['rol']){
                case 1:    
                header("Location: http://localhost/CarpinteriaGral/?controlador=Administrador&accion=inicio");
                break;
    
                default:
            }

        }else{
            $conexion2=Basededatos::CreateInstancia();
            $sql2= $conexion2->prepare("SELECT * FROM catalogocliente WHERE CorreoElectronico=? AND Contrasena=?");
            $sql2->execute(array($usuario,$pass));
            $clien=$sql2->fetch(PDO::FETCH_NUM);

            if($clien == true){
                $rol     =  $clien[1]; 
                $idClien =  $clien[0];
                
                $_SESSION['rol'] = $rol;
                $_SESSION['id']  = $idClien;
                
                switch($_SESSION['rol']){
                    case 2:    
                    header("Location: http://localhost/CarpinteriaGral/?controlador=Cliente&accion=inicio");
                    break;
        
                    default:
                }
    
            }else{
                echo "<div class='container2'><span class='estiloError'>Usuario o contraseña incorrectos</span></div>";
               
                session_unset();
                session_destroy();
           
            }

        }

    }


      

    






}