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
include_once("Modelo/administrador.php");
include_once("Modelo/herramienta.php");

Basededatos::CreateInstancia();

class ControladorAdministrador{

    public function index(){ 
        require_once("Vista/Administrador/template.php");       
    }
    public function inicio(){ 

      
        $admins=Administrador::mostrar(); 
        
        $dbHost="localhost";
        $dbUsername="root";
        $dbPassword="";
        $dbName="bd02";
        
        
        if(!empty($_POST['respaldo'])){
          $respaldo=$_POST['respaldo'];
          if($respaldo==1){
            Administrador::respaldo_bd($dbHost,  $dbUsername,$dbPassword, $dbName);
              echo('<div class="alert alert-success d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div>
              ¡Éxito, se ha creado el respaldo de la base de datos!
              </div>
              </div>');
          }
        }

                 
          if(!empty($_POST['Recuperar'])){
            

          $Recuperar=$_POST['Recuperar'];
        
          if($Recuperar==2){
            
            $file=$_POST['file'];

            $direccion="../CarpinteriaGral/respaldos/".$file;

            Administrador::restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $direccion);
              echo('<div class="alert alert-success d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div>
              ¡Éxito, se ha creado la recuperación de la base de datos!
              </div>
              </div>');
          }
        
  
        }
        include_once("Vista/Administrador/inicio.php");
    }
    public function crear(){      
        if($_POST){
            $Nombre=$_POST['Nombre'];
            $APAdmin=$_POST['APAdmin'];
            $AMAdmin=$_POST['AMAdmin'];
            $CorreoElectronico=$_POST['CorreoElectronico'];
            $Contrasena=$_POST['Contrasena'];
            $folio=1;
            Administrador::crear($Nombre, $APAdmin, $AMAdmin, $CorreoElectronico, $Contrasena,$folio);
        }
        include_once("Vista/Administrador/crear.php");
    }

    public function borrar(){
        //print_r($_GET);
        //validar si existe, si es entero, si es dato
        $FolioAdmin=$_GET['FolioAdmin'];
        Administrador::borrar($FolioAdmin);
        //Redireccion sin nesecidad de que aparezca una pantalla en blanco.
        header("Location:./?controlador=administrador&accion=inicio");
    }

    public function editar(){
        if($_POST){
            $FolioAdmin=$_POST['FolioAdmin'];
            $Nombre=$_POST['Nombre'];
            $AMAdmin=$_POST['AMAdmin'];
            $APAdmin=$_POST['APAdmin'];
            $CorreoElectronico=$_POST['CorreoElectronico'];
            $Contrasena=$_POST['Contrasena'];
            Administrador::editar($FolioAdmin,$Nombre, $APAdmin, $AMAdmin, $CorreoElectronico, $Contrasena);
            
        }
        $FolioAdmin=$_GET['FolioAdmin'];
        $admin=(Administrador::buscar($FolioAdmin));
        include_once("Vista/Administrador/editar.php");
    }
    
    public function inicio_administrador(){

        $datos = Administrador::clientes_frecuentes();
        $datos_productos = Administrador::productos_mas_vendidos();
        $fechas_distintas = Administrador::traer_fechas_distintas();
        $meses_distintos = Administrador::traer_meses_distintas();
        $productos = Administrador::mostrar_productos();
        session_start();
        $id_administrador=$_SESSION['id'];
        

        $anual=[];
        $mes=[];
        $materiales=[];
        $folio_producto=0;
      

        if(!empty($_POST['anio'])){
          $anio=$_POST['anio'];
          $mes=$_POST['mes'];
          
          if($anio==null && $mes!=null ){
              echo('
              <div class="alert alert-danger d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div>
              ¡Para el reporte de mes debes escoger el año!
              </div>
              </div>');
          }

          if($anio!=null && $mes!=null){
            $anual = Administrador::reporte_mensual($anio,$mes);
          }

          if($anio!=null && $mes==null){
          $anual = Administrador::reporte_anual($anio);
          }
        }

        
        if(!empty($_POST['cantidad'])){
              $folio_producto = $_POST['folio_materia_prima'];
              $cantidad = $_POST['cantidad'];
              //trae el precio de la tabla calculadora
              $tabla_productos = Administrador::producto_precio_insumos($folio_producto);
              //Verifica la existencia de id producto en calculadora
              $verificar=Administrador::verificar_existencia_producto($folio_producto);
              
              if(!empty($verificar)){
              
                Administrador::actualizar_cantidad_calculadora($cantidad,$folio_producto);
              
            }else{
                foreach ($tabla_productos as $tabla_producto){
                Administrador::insertar_calculadora($cantidad,$folio_producto,$id_administrador,$tabla_producto->precio_insumo);
                }
               
            }
        }
        $mostrar_calculadora=Administrador::mostrar_calculadora();


        

            include_once("Vista/AdministradorM/inicio.php");
    }

    public function reporte_busqueda_materia_prima(){
      session_start();
      $datos = Administrador::clientes_frecuentes();
      $datos_productos = Administrador::productos_mas_vendidos();
      $fechas_distintas = Administrador::traer_fechas_distintas();
        $meses_distintos = Administrador::traer_meses_distintas();
      $productos = Administrador::mostrar_productos();
      $mostrar_calculadora=Administrador::mostrar_calculadora();

      $anual=[];
      $mes=[];
      $materiales=[];
      $mostrar_calculadora=[];
      if($_POST){
        $nombremateria=$_POST['nombremateria'];
        $materiales=Administrador::reporte_materia_prima($nombremateria);
      }

      include_once("Vista/AdministradorM/inicio.php");
    }

    public function eliminar_folio_calculadora(){
      $idcalculadora=$_GET['idcalculadora'];
      Administrador::borrar_fila_calculadora($idcalculadora);
      header("Location:./?controlador=administrador&accion=inicio_administrador");
    }

    public function eliminar_todo(){
      $id_administrador=$_GET['id_administrador'];
      Administrador::eliminar_todo($id_administrador);
      header("Location:./?controlador=administrador&accion=inicio_administrador");
    }

    public function desactivar_prestamo(){
      $idPh=$_GET['idPh'];
      

      Administrador::desactivar_prestamo($idPh);
     
      include_once("Vista/AdministradorM/inicio_prestaciones.php");
      header("Location:./?controlador=Administrador&accion=inicio_prestaciones");
    }
     
    public function activar_prestamo(){
      $idPh=$_GET['idPh'];
      

      Administrador::activar_prestamo($idPh);
     
      include_once("Vista/AdministradorM/inicio_prestaciones.php");
      header("Location:./?controlador=Administrador&accion=inicio_prestaciones");
    }

    public function inicio_prestaciones(){
        $datos_empleados=Administrador::mostrar_empleados();
        $tabla_prestacion_herramienta=Administrador::mostrar_prestacion_herramientas();

        foreach($tabla_prestacion_herramienta as $m_c){
              $v=Administrador::existencia_idph($m_c->idPh);
              if($v==null){
                echo('
            <div class="alert alert-warning d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            ¡Debes insertar valores para '.$m_c->correoelectronico.'!
            </div>
            </div>');
              }
              
        }
        
        if($_POST){
          $folio_empleado=$_POST['folio_empleado'];
          $verificar=Administrador::verificar_prestacion_herramienta($folio_empleado);
          if(!empty($verificar)){
            echo('
            <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            ¡Ya esta registrada una prestación para este empleado, desactive el estado e inserte una nueva presentación!
            </div>
            </div>');
            }else{
            Administrador::insertar_prestacion_herramienta($folio_empleado);
            echo('
            <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
            ¡Prestación realizada con éxito!
            </div>
            </div>');
            
                $tabla_prestacion_herramienta=Administrador::mostrar_prestacion_herramientas();
                foreach($tabla_prestacion_herramienta as $m_c){
                  $v=Administrador::existencia_idph($m_c->idPh);
                  if($v==null){
                    echo('
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                ¡Debes insertar valores para '.$m_c->correoelectronico.'!
                </div>
                </div>');
                  }
                  
                }

              }
              
        }
        

        
        
      include_once("Vista/AdministradorM/crear_prestacion.php");
    } 

    public function asignar_herramienta(){

      $idPh=$_GET['idPh'];
      
      if(!empty($_POST['folio'])){
        $folio_herramienta=$_POST['folio'];
        $verificar_cantidad=Administrador::verificar_cantidad(1,$folio_herramienta);

        if($verificar_cantidad==0){
          echo('
              <div class="alert alert-warning d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div>
              ¡Ya no hay herramienta para asignar!
              </div>
              </div>');
          }else{
          if(empty(Administrador::existencia_phch($idPh,$folio_herramienta))){
              Administrador::insertar_phch($idPh,$folio_herramienta,1);  
              Herramientas::actualizar_restar_cantidad(1,$folio_herramienta);
          
          }else{
            echo('
              <div class="alert alert-warning d-flex align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
              <div>
              ¡ya insertaste esta herramienta!
              </div>
              </div>');
                }
          
        
        }    
        
        
      }

      if(!empty($_POST['folio_eliminar'])){

        $cantidad_eliminar= $_POST['cantidad_eliminar'];
        $folio_herramienta_eliminar= $_POST['folio_herramienta_eliminar'];
        
        Herramientas::actualizar_sumar_cantidad($cantidad_eliminar,$folio_herramienta_eliminar);

        $idPhch_eliminar=$_POST['folio_eliminar'];
        Administrador::eliminar_idPhch($idPhch_eliminar);
      }

      if(!empty($_POST['cantidad'])){
        $cantidad_vieja=$_POST['cantidad_vieja'];
        $cantidad_nueva=$_POST['cantidad'];
        $idPhch=$_POST['idPhch_actualizar'];
        
        $folio_herramienta_actualizar=$_POST['folio_herramienta_actualizar'];
        $verificar_cantidad=Administrador::verificar_cantidad( $cantidad_nueva,$folio_herramienta_actualizar);
       
        if($verificar_cantidad==0){
          $h=Herramientas::buscar($folio_herramienta_actualizar);

          foreach ($h as $hs){
            $cp=$h->Cantidad;
          }
          echo('
          <div class="alert alert-warning  d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>
          ¡ya no hay herramientas!
          </div>
          </div>');
                
            }else{
            echo('
            <div class="alert alert-success  d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            ¡Actualización exitosa!
            </div>
            </div>');

            $h=Herramientas::buscar($folio_herramienta_actualizar);
              foreach ($h as $hs){
               $cantidad_tabla_herramientas=$h->Cantidad;
              }
              if($cantidad_nueva==$cantidad_tabla_herramientas){

                $diferencia=0;
                $todo=$cantidad_nueva+$cantidad_vieja;
                echo("todo".$todo);
                Herramientas::actualizar_remplazar_cantidad($diferencia,$folio_herramienta_actualizar);
                Administrador::actualizar_cantidad_h($todo,$idPhch);

              }else{
                      if($cantidad_nueva>$cantidad_vieja){
                        $diferencia=$cantidad_nueva-$cantidad_vieja;
                        
                        Herramientas::actualizar_restar_cantidad($diferencia,$folio_herramienta_actualizar);
                        Administrador::actualizar_cantidad_h($cantidad_nueva,$idPhch);
                      }
                    
                      if($cantidad_nueva<$cantidad_vieja){
                        $diferencia=$cantidad_vieja-$cantidad_nueva;
                      
                        Herramientas::actualizar_sumar_cantidad($diferencia,$folio_herramienta_actualizar);
                        Administrador::actualizar_cantidad_h($cantidad_nueva,$idPhch);
                      }
              }
            }
      }   
        
        
      if(!empty($_POST['cantidad_extravio'])){

        $cantidad_extravio=$_POST['cantidad_extravio'];
        $idPhch_extravio=$_POST['idPhch_extravio'];
        $cantidad_vieja_extravio=$_POST['cantidad_vieja_extravio'];

        if ($cantidad_extravio<=$cantidad_vieja_extravio && $cantidad_extravio>=1 ) {
       
          Administrador::actualizar_estatus($idPhch_extravio,$cantidad_extravio);
          echo('
          <div class="alert alert-success  d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>
          ¡Se añadio la cantidad de extravio!
          </div>
          </div>');
        }
       else {
        echo('
        <div class="alert alert-warning  d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
        ¡la cantidad de herramientas pérdidas debe ser igual a la de adquiridas!
        </div>
        </div>');
         
        }
        

      }

      if(!empty($_POST['sin_adeudos'])){
        $sin_adeudos=$_POST['sin_adeudos'];
        $idPhch_extravio_eliminar=$_POST['idPhch_extravio_eliminar'];
        Administrador::actualizar_estatus($idPhch_extravio_eliminar,0);
        echo('
          <div class="alert alert-success  d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>
          ¡Se eliminaron los adeudos!
          </div>
          </div>');
      }
      
      
        $catalogo_phch=Administrador::mostrar_phch($idPh);
        $catalogo_herramientas=Herramientas::mostrar();
      include_once("Vista/AdministradorM/asignar_herramienta.php");
    }
    
  
    }


  
?>