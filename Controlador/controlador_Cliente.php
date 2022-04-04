<?php
include_once("conexion.php");
include_once("Modelo/Cliente.php");
include_once("Modelo/herramienta.php");
include_once("Modelo/administrador.php");
Basededatos::CreateInstancia();

class ControladorCliente{
        //inicio realiza la union entre el modelo y la vista, para mostrar al administrador los datos almacenados en la base de datos.
        public function inicio(){
            $Clientes=Cliente::mostrar();
            $citas=Cliente::mostrar_citas();

            if(!empty($_POST['folio_citas'])){
                $folio_citas=$_POST['folio_citas'];
                Cliente::Eliminar_citas($folio_citas);
                header("Location:./?controlador=Cliente&accion=inicio");
            }

            include_once("Vista/Cliente/inicio.php");
        }
        //crear recibe los datos del cliente y los envía al modelo de cliente para registrar un cliente
        public function crear(){
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
                if(Cliente::verifedad($FechaNacimiento)<=17){
                    echo('
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                ¡Necesitas ser mayor de edad!
                </div>
                </div>');
    
                }else{
                 if (Cliente::crear(
                    $NombreClien, 
                    $APClien, 
                    $AMClien, 
                    $FechaNacimiento, 
                    $Telefono, 
                    $Direccion, 
                    $CorreoElectronico, 
                    $contraseñaHash,
                    $rol)!=1){
                    $_POST['NombreClien']=null;
                    $_POST['APClien']=null;
                    $_POST['AMClien']=null;
                    $_POST['FechaNacimiento']=null;
                    $_POST['Telefono']=null;
                    $_POST['Direccion']=null;
                    $_POST['CorreoElectronico']=null;
                    $_POST['Contrasena']=null;
                    }
                    
                    
                }
            }
            include_once("Vista/Cliente/crear.php");
        }
        //Editar recibe los datos del cliente y los envia al modelo del cliente para editar
        public function editar(){
            if($_POST){
                $IdCliente=$_POST['IdCliente'];
                $NombreClien=$_POST['NombreClien'];
                $AMClien=$_POST['AMClien'];
                $APClien=$_POST['APClien'];
                $FechaNacimiento=$_POST['FechaNacimiento'];
                $Telefono=$_POST['Telefono'];
                $Direccion=$_POST['Direccion'];
                $CorreoElectronico=$_POST['CorreoElectronico'];
                $Contrasena=$_POST['Contrasena'];
                if(Administrador::verificar_correo_folio('catalogocliente',$CorreoElectronico,'IdCliente',$IdCliente)==1){
                    echo('
                   <div class="alert alert-warning d-flex align-items-center" role="alert">
                   <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                   <div>
                   ¡Ya está registrado el correo, intenta con otro!
                   </div>
                   </div>');
                 }else{
                Cliente::editar($IdCliente,$NombreClien, $APClien, $AMClien, $FechaNacimiento, $Telefono, $Direccion, $CorreoElectronico,$Contrasena);
                }
            }
            $IdCliente=$_GET['IdCliente'];
            $Cliente=(Cliente::buscar($IdCliente));
            include_once("Vista/Cliente/editar.php");
        }
        //Recibe el folio del cliente para eliminar
        public function borrar(){
            $IdCliente=$_GET['IdCliente'];
            Cliente::borrar($IdCliente);
            header("Location:./?controlador=Cliente&accion=inicio");
        }
}


?>