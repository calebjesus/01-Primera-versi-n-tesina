<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol></svg>
<?php
include_once("conexion.php");
include_once("Modelo/Login.php");
include_once("Modelo/cliente.php");
include_once("Modelo/ReadC.php");

Basededatos::CreateInstancia();


class ControladorLogin{
    //Muestra la página de inicio del sistema
    public function inicio(){ 
        include_once("Vista/Login/inicio.php");
    }

    //Valida al usuario que inicia sesión
    public function validarLogin(){ 
        if($_POST){
            $usuario=$_POST['usuario'];
            $pass=$_POST['pass'];

            $cadena_de_texto =  $usuario." ".$pass;
            if(ReadC::verificar_inyeccionSQL($cadena_de_texto)==1){
                echo('
            <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            ¡Estas insertando palabras reservadas!
            </div>
            </div>');
            }else{
                Login::buscar($usuario, $pass);
            }
            
        }
        include_once("Vista/Login/inicio.php");
    }

    //Destruye la sesión iniciada
    public function cerrar(){
        session_start();
        session_unset();
        session_destroy();
        include_once("Vista/Login/inicio.php");
    }

    //Recibe los datos y los envía al modelo para realizar el registro del cliente
    public function registro(){
        if($_POST){
            $NombreClien=$_POST['NombreClien'];
            $APClien=$_POST['APClien'];
            $AMClien=$_POST['AMClien'];
            $FechaNacimiento=$_POST['FechaNacimiento'];
            $Telefono=$_POST['Telefono'];
            $Direccion=$_POST['Direccion'];
            $CorreoElectronico=$_POST['CorreoElectronico'];
            $Contrasena=$_POST['Contrasena'];
            $contraseñaHash = password_hash($Contrasena, PASSWORD_DEFAULT); 

            $rol=2;

            $cadena_de_texto =  $NombreClien." ".$APClien." ". $AMClien." ".$Direccion." ".$CorreoElectronico." ".$Contrasena;
            if(ReadC::verificar_inyeccionSQL($cadena_de_texto)==1){
                echo('
            <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            ¡Estas insertando palabras reservadas!
            </div>
            </div>');
            }else{
                if(Cliente::verifedad($FechaNacimiento)<=17){
                    echo('
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    ¡Necesitas ser mayor de edad!
                    </div>
                    </div>');
    
                }else{
                    Cliente::crear(
                        $NombreClien, 
                        $APClien, 
                        $AMClien, 
                        $FechaNacimiento, 
                        $Telefono, 
                        $Direccion, 
                        $CorreoElectronico, 
                        $contraseñaHash,
                        $rol);
                }
            }

            

            

        }
        include_once("Vista/Login/Registro.php");
    }
}