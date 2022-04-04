<?php
include_once("conexion.php");
include_once("Modelo/Administrador.php");
Basededatos::CreateInstancia();

/*Login cumple con la funcionalidad de dejar acceder aun usuario tipo administrador o cliente, y con esto buscar de cual usuario se trata */
class Login{

    public $usuario;
    public $pass;
   

    public function __construct($usuario, $pass){
        $this->usuario=$usuario;
        $this->pass=$pass;
    }


    public static function buscar($usuario, $pass){
        session_start();


        /*Inicia la sesión tanto para cliente o administrador, dependiendo de que rol que se trate */
        if(isset($_SESSION['rol'])){
            /*En caso de la variable isset($_SESSION['rol']) contenga un valor  */
            switch($_SESSION['rol']){
                /*Define a donde lo enviará */
                case 1:
                    header("Location: http://localhost/CarpinteriaGral/?controlador=Administrador&accion=inicio");
                break;
                case 2:
                    header("Location: http://localhost/CarpinteriaGral/?controlador=Cliente&accion=inicio");
                break;
                default:
            }
        }
        
        /*Recolecta los datos del administrador */
        $conexion=Basededatos::CreateInstancia();
        $sql= $conexion->prepare("SELECT * FROM catalogoadministrador WHERE CorreoElectronico=?");
        $sql->execute(array($usuario));
        $admin=$sql->fetch(PDO::FETCH_NUM);

        $conexion2=Basededatos::CreateInstancia();
        $sql2= $conexion2->prepare("SELECT * FROM catalogocliente WHERE CorreoElectronico=?");
        $sql2->execute(array($usuario));
        $clien=$sql2->fetch(PDO::FETCH_NUM);
        
        if(!empty($admin[6])){
            
            if (password_verify($pass, $admin[6])) {
                $rol     =  $admin[1]; 
                $idAdmin =  $admin[0];
                /*recolecta la información del administrador como rol y folio */
                $_SESSION['rol'] = $rol;
                $_SESSION['id']  = $idAdmin;
                
                switch($_SESSION['rol']){
                    case 1:    
                        Administrador::insertar_inicio_sesion($idAdmin);
                        header("Location: http://localhost/CarpinteriaGral/?controlador=Administrador&accion=inicio");
                    break;
                    default:
                }
            }else{
                echo "<div class='container2'><span class='estiloError'>Usuario o contraseña incorrectos</span></div>";
               /*elimina la sesión creada */
                session_unset();
                session_destroy();
            }

        }else if(!empty($clien[9])){
            
                /*Busca al cliente */
                /*Evalúa si el cliente existe */
                if (password_verify($pass, $clien[9])) {
                    /*Obtiene los datos del cliente */
                    $rol     =  $clien[1]; 
                    $idClien =  $clien[0];
                    $_SESSION['rol'] = $rol;
                    $_SESSION['id']  = $idClien;
                    /*Redirecciona en caso de ser un cliente */
                    switch($_SESSION['rol']){
                        case 2:    
                        header("Location: http://localhost/CarpinteriaGral/?controlador=Cliente&accion=inicio");
                        break;
                        default:
                    }
                }else{
                    echo "<div class='container2'><span class='estiloError'>Usuario o contraseña incorrectos</span></div>";
                   /*elimina la sesión creada */
                    session_unset();
                    session_destroy();
                }

        }else{
            echo "<div class='container2'><span class='estiloError'>Usuario o contraseña incorrectos</span></div>";
           /*elimina la sesión creada */
            session_unset();
            session_destroy();
        }
        /*Evalúa si el administrador existe */
       
        

    }


      

    






}