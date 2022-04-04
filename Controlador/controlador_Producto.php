<?php
include_once("conexion.php");
include_once("Modelo/producto.php");
Basededatos::CreateInstancia();

class ControladorProducto{

    //Muestra los productos que hay en la base de datos y los productos que a entregar en la vista de producto
    public function inicio(){ 
        $prods=Producto::mostrar(); 
        $entrega_productos=Producto::entrega_productos();
        include_once("Vista/producto/inicio.php");
    }
    //Envía los datos al modelo productos para ingresar un producto
    public function crear(){      
       if($_POST){
            $NombreProd=$_POST['NombreProd'];
            $Medidas=$_POST['Medidas'];
            $Categoria=$_POST['Categoria'];
            $Precio=$_POST['Precio'];
            $Cantidad=$_POST['Cantidad'];
            $Nombreimg=$_POST['Nombreimg'];
            $producto=$_POST['Nombreimg'];
            $sinformato=$_FILES['imagen']['type'];

            $formato = (explode("/",$sinformato));   
            
            $nreal = $producto.'.'.$formato[1];

            if( Producto::buscarImg($nreal) ){
                if(empty($formato[1])){
                    echo "<div class='container2'><span class='estiloError'>Imagen corrupta, inserte una nueva </span></div>";
                }else{  
                    $ruta = "Herramientas/Imagenes/".$nreal;
                    move_uploaded_file($_FILES['imagen']['tmp_name'],$ruta);

                    if(Producto::crear($NombreProd, $Medidas, $Categoria, $Precio, $Cantidad,$nreal)!=1){
                        $_POST['NombreProd']=null;
                        $_POST['Medidas']=null;
                        $_POST['Categoria']=null;
                        $_POST['Precio']=null;
                        $_POST['Cantidad']=null;
                        $_POST['Nombreimg']=null;
                        $_POST['Nombreimg']=null;
                    }     

                }
            }else{  
                echo "<div class='container2'><span class='estiloError'>Nombre de la imagen ya existe</span></div>";    
            }
        }
        include_once("Vista/producto/crear.php");
    }
    //Recibe el folio del producto a través del método GET
    public function borrar(){      
        $FolioProd=$_GET['FolioProd'];
        $Prod=(Producto::buscar($FolioProd));
        
        unlink("Herramientas/Imagenes/".$Prod->Nombreimg); 
        Producto::borrar($FolioProd);
        header("Location:./?controlador=producto&accion=inicio");
    }
    //Recibe los datos y envía a la vista del producto para editar un producto
    public function editar(){
       
        if($_POST){
            $FolioProd=$_POST['FolioProd'];
            $NombreProd=$_POST['NombreProd'];
            $Categoria=$_POST['Categoria'];
            $Medidas=$_POST['Medidas'];
            $Precio=$_POST['Precio'];
            $Cantidad=$_POST['Cantidad'];
           
            $producto=$_POST['Nombreimg'];
            $sinformato=$_FILES['imagen']['type'];
            $formato = (explode("/",$sinformato));
            

            if(empty($formato[0])){
                Producto::editar($FolioProd,$NombreProd, $Medidas, $Categoria, $Precio, $Cantidad,$producto);
            }else{
                $FolioProd=$_GET['FolioProd'];
                $Prod=(Producto::buscar($FolioProd));
                unlink("Herramientas/Imagenes/".$Prod->Nombreimg); 
            if(empty($formato[1])){
                echo "<div class='container2'><span class='estiloError'>Imagen corrupta, inserte una nueva </span></div>";
              
        
            }else{
                $nreal = $producto.'.'.$formato[1];
                $ruta = "Herramientas/Imagenes/".$nreal;
                move_uploaded_file($_FILES['imagen']['tmp_name'],$ruta);
                Producto::editar($FolioProd,$NombreProd, $Medidas, $Categoria, $Precio, $Cantidad,$nreal);  
                    
            }
        }
            
        }

        

        
        

        $FolioProd=$_GET['FolioProd'];
        $Prod=(Producto::buscar($FolioProd));
        include_once("Vista/producto/editar.php");
    }
    //Envía los datos de las materias primas, para asignarle a los productos insumos
    public function insumo(){
        $insumos=[];
        $folio_producto=$_GET['FolioProd'];
        $insumos=Producto::mostrar_materia_prima();
        
        if($_POST){
            if(!empty($_POST['folio_materia_prima'])){
                $folio_materia_prima = $_POST['folio_materia_prima'];
                $cantidad = $_POST['cantidad'];
                Producto::insertar_isumo($folio_materia_prima,$folio_producto,$cantidad);
            }

            if(!empty($_POST['folioinsumo'])){
                $folioinsumo = $_POST['folioinsumo'];
                Producto::Eliminar_insumo($folioinsumo);
            }
            
        }
        


        $materia_prima_producto=Producto::mostrar_insumo($folio_producto);
        include_once("Vista/producto/insumo.php");
    }
    //Realiza el cambio de estado de los productos que se han entregado
    public function producto_entregado(){
        $FolioApartado=$_GET['FolioApartado'];
        Producto::producto_entregado($FolioApartado);
        header("Location:./?controlador=producto&accion=inicio");
    }
    //Realiza el cambio de estado de los producos que se han cancelado
    public function producto_cancelado(){
        $FolioApartado=$_GET['FolioApartado'];
        Producto::productos_cancelados($FolioApartado);
        Producto::producto_entregado($FolioApartado);
        header("Location:./?controlador=producto&accion=inicio");
    }
}?>