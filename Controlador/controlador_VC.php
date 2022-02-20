<?php
include_once("conexion.php");
include_once("Modelo/ReadC.php");
include_once("controlador/controlador_readC.php");
Basededatos::CreateInstancia();

class ControladorVC{
    
    public function enviar_fechas_ocupadas(){

        $lista_fechas = implode(" ", readC::fechas_ocupadas());
        echo($lista_fechas);
        return rtrim($lista_fechas, ",");
        
    }

        public function verificar_citas(){  
            session_start();
            $IdCliente=$_SESSION['id'];
            readC::eliminar_cita($IdCliente);;
            $cita = readC::control_cita($IdCliente);
            if(   $cita == 1 ){
                    echo('
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    ¡Ya has pedido una cita, verifica tus cita en tu portal!
                    </div>
                    </div>');
                    include_once("Vista/ClienteM/error_cita.php");
                }else{ 
                    ControladorReadC::insertar_cita();
                    include_once("Vista/ClienteM/GestorCitas.php");
                }
                
                
                
        }

    }

?>
