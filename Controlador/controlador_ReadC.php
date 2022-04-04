<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
</svg>


<?php
include_once("conexion.php");
include_once("Modelo/ReadC.php");
include_once("Modelo/Producto.php");
include_once("Modelo/BuscarP.php");
include_once("controlador/controlador_VC.php");
Basededatos::CreateInstancia();

class ControladorReadC{

    //función que realiza el apartado de los clientes 
    public function comprar(){
        session_start();
        $IdCliente=$_SESSION['id'];
        //verifica el inicio de sesión
        if(empty($_SESSION['id'])){
            echo('
            <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            ¡ Inicia sesión !
            </div>
            </div>');
        }else{
            //Verifica la sesión del cliente
            if($_SESSION['rol'] == 2){
                $Cliente=(ReadC::buscar($IdCliente));
                if(empty($_POST['FolioProd'])){
                    $FolioProd=0;
                }else{
                    $FolioProd=$_POST['FolioProd'];
                }
                
                if($FolioProd != 0){
                    ReadC::crearCarritoTemporal($FolioProd, $IdCliente);
                    $prods=BuscarP::buscarP($IdCliente);
                }else{
                    $prods=BuscarP::buscarP($IdCliente);
                }
            }
        }
        include_once("Vista/ClienteM/Comprar.php");
    }
    //Actualiza la cantidad de los productos en la sección de apartados
    public function ActualizarCantidad(){
                
        $folioC=$_POST['folioC'];
        $CantidadMat=$_POST['CantidadMat'];
        
        session_start();
        $IdCliente=$_SESSION['id'];
        $Cliente=(ReadC::buscar($IdCliente));
        $prods=BuscarP::buscarP($IdCliente);

        ReadC::editarC($folioC,$CantidadMat);
        $prods=BuscarP::buscarP($IdCliente);
                 
        
      
        include_once("Vista/ClienteM/Comprar.php");
    }
    //Elimina al producto del carrito temporal en la sección de apartados
    public function Eliminarproducto(){
       
        $folioC=$_POST['folioC1'];
        session_start();
        $IdCliente=$_SESSION['id'];
        $Cliente=(ReadC::buscar($IdCliente));
        $prods=BuscarP::buscarP($IdCliente);
        ReadC::Eliminar($folioC);
        $prods=BuscarP::buscarP($IdCliente);

        include_once("Vista/ClienteM/Comprar.php");
    }
    //Realiza el apartado de los productos
    public function realizarCompra(){
            session_start();
            $IdCliente=$_SESSION['id'];
            $Cliente=(ReadC::buscar($IdCliente));
            $prods=BuscarP::buscarP($IdCliente);

            $PrecioTotal=ReadC::busquedaPrecioTotal($IdCliente);
            
            if($PrecioTotal==null){
            echo('
            <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            ¡Primero realiza un apartado!
            </div>
            </div>');

            }else{
            
            if(ReadC::verificar_cantidad($IdCliente) == 0){
            
            $folio_apartado=ReadC::insertar_apartado($PrecioTotal,$IdCliente);
            ReadC::insertar_apartado_producto($IdCliente,$folio_apartado);
            ReadC::eliminar_cantidades($folio_apartado);
                echo('
                <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                ¡Compra realizada con éxito!
                <br>
                El administrador se pondrá en contacto contigo en 10 días hábiles.
                </div>
                </div>');
            }
        }


            $prods=BuscarP::buscarP($IdCliente);
            include_once("Vista/ClienteM/Comprar.php");
    }
    //Ingresa la cita del cliente
    public function insertar_cita(){
        if($_POST){
            $IdCliente=$_POST["idcliente"];
            $fecha_hora=$_POST['fechas'];
            $asunto=$_POST['asunto'];
            $estado=$_POST['estado'];
            $municipio=$_POST['municipio'];
            $colonia=$_POST['colonia'];
            $calle=$_POST['calle'];     
            $lugar_cita = $estado." ".$municipio." ".$colonia." ".$calle;
            
            $cadena_de_texto =  $asunto." ".$colonia." ".$calle;
            if(ReadC::verificar_inyeccionSQL($cadena_de_texto)==1){
                echo('
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                ¡Estas insertando palabras reservadas cambia los signos!
                </div>
                </div>');
            }else{
                if(empty($fecha_hora) || empty($estado) || empty($municipio)){
                    echo('
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    ¡Completa el registro!
                    </div>
                    </div>');
                
                }else{
                    readC::crear_cita($fecha_hora,$asunto,$lugar_cita,$IdCliente);
                    header("Location:./?controlador=VC&accion=verificar_citas");
                }
            }

           

        } 
    }
    //Envía el arreglo de fechas ocupadas por otros clientes
    public function enviar_fechas_ocupadas(){

        $lista_fechas = implode(" ", readC::fechas_ocupadas());
        echo($lista_fechas);
        return rtrim($lista_fechas, ",");
        
    }
    //Envía la información del cliente, cita y pedidos en el apartado de cuentas y listas
    public function cuenta_listas(){
        
        session_start(); 
        if($_POST){
            $IdCliente=$_POST['IdCliente'];
            $Telefono=$_POST['Telefono'];
            $Direccion=$_POST['Direccion'];
            $Contrasena=$_POST['Contrasena'];
            $cadena_de_texto =  $Direccion." ".$Contrasena;
            if(ReadC::verificar_inyeccionSQL($cadena_de_texto)==1){
                echo('
            <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            ¡Estas insertando palabras reservadas!
            </div>
            </div>');
            }else{
                ReadC::editar($Telefono, $Direccion,$Contrasena,$IdCliente);
            }

           
        }

        $IdCliente=$_SESSION['id'];
        $Cliente=(ReadC::buscar($IdCliente));
        $prods=ReadC::buscar_productos_apartado($IdCliente);
        $cita = ReadC::datos_cita($IdCliente);
        
        
        include_once("Vista/clienteM/sesion.php");
    }
    //Envía los detalles de cada pedido
    public function ver_tabla_apartadoproducto(){
        $FolioApartado=$_GET['FolioApartado'];
        $prods=ReadC::apartado_producto_detalles($FolioApartado);
        include_once("Vista/clienteM/Detalles_productos.php");
    }

    


}


?>