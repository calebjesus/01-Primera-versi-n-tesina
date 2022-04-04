<?php
include_once("conexion.php");
include_once("Modelo/ReadC.php");
include_once("controlador/controlador_readC.php");
Basededatos::CreateInstancia();

/*La siguiente la clase esta dedicada a ser la vista del cliente para el gestor del citas */
class ControladorVC{
    
    /*Función para llevar el arreglo a la vista de gestor de cistas para el cliente*/
    public function enviar_fechas_ocupadas(){

        $lista_fechas = implode(" ", readC::fechas_ocupadas());
        
        return rtrim($lista_fechas, ",");
        
    }

    /*Función  que verifica las citas que tiene el cliente*/
    public function verificar_citas(){  
        session_start();
        $IdCliente=$_SESSION['id'];
        readC::eliminar_cita($IdCliente);;
        $cita = readC::control_cita($IdCliente);
        $datos_municipios=ReadC::datos_municipios();
        $datos_estado=ReadC::datos_estado();
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
