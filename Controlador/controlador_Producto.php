<?php
include_once("conexion.php");
include_once("Modelo/producto.php");
Basededatos::CreateInstancia();

class ControladorProducto{

    public function inicio(){ 
        $prods=Producto::mostrar(); 
        $entrega_productos=Producto::entrega_productos();

        include_once("Vista/producto/inicio.php");
    }

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

            if( Producto::buscarImg($nreal) )
            {
                if(empty($formato[1])){
                    echo "<div class='container2'><span class='estiloError'>Imagen corrupta, inserte una nueva </span></div>";
                }else{  
                    $ruta = "Herramientas/Imagenes/".$nreal;
                    move_uploaded_file($_FILES['imagen']['tmp_name'],$ruta);
                    Producto::crear($NombreProd, $Medidas, $Categoria, $Precio, $Cantidad,$nreal);       
                }
            }else
            {  
                echo "<div class='container2'><span class='estiloError'>Nombre de la imagen ya existe</span></div>";    
            }
        }
        include_once("Vista/producto/crear.php");
    }

    public function borrar(){      
        $FolioProd=$_GET['FolioProd'];
        $Prod=(Producto::buscar($FolioProd));
        
        unlink("Herramientas/Imagenes/".$Prod->Nombreimg); 
        Producto::borrar($FolioProd);
        header("Location:./?controlador=producto&accion=inicio");
    }

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

    public function insumo(){
        $insumos=[];
        $folio_producto=$_GET['FolioProd'];
        $insumos=Producto::mostrar_materia_prima();
        
        if($_POST){
            $folio_materia_prima = $_POST['folio_materia_prima'];
            $cantidad = $_POST['cantidad'];
            Producto::insertar_isumo($folio_materia_prima,$folio_producto,$cantidad);
        }
        
        $materia_prima_producto=Producto::mostrar_insumo($folio_producto);
        include_once("Vista/producto/insumo.php");
    }

    public function eliminar_insumo(){
        $folioinsumo=$_GET['folioinsumo'];
        Producto::Eliminar_insumo($folioinsumo);
        header("Location:./?controlador=producto&accion=insumo");
    }

    public function producto_entregado(){
        $FolioApartado=$_GET['FolioApartado'];
        Producto::producto_entregado($FolioApartado);
        header("Location:./?controlador=producto&accion=inicio");
    }




}?>