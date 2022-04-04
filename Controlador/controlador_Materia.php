<?php
include_once("conexion.php");
include_once("Modelo/materia.php");
Basededatos::CreateInstancia();


    class ControladorMateria{
        //Muestra todos los productos que tiene la tabla de materia primas
        public function inicio(){ 
            $materias=Materia::mostrar(); 
            include_once("Vista/materia/inicio.php");
        }
        //Recibe y envía los datos de la materia prima para poder crearlos
        public function crear(){
            if($_POST){
            $NombreMat=$_POST['NombreMat'];
            $NombreSuc=$_POST['NombreSuc'];
            $MedidasMat=$_POST['MedidasMat'];
            $TipoMadera=$_POST['TipoMadera'];
            $CantidadMat=$_POST['CantidadMat'];
            $PrecioMat=$_POST['PrecioMat'];
            if(Materia::crear(
                        $NombreMat, 
                        $NombreSuc, 
                        $MedidasMat, 
                        $TipoMadera,
                        $CantidadMat,
                        $PrecioMat)!=1){
                            $_POST['NombreMat']=null;
                            $_POST['NombreSuc']=null;
                            $_POST['MedidasMat']=null;
                            $_POST['TipoMadera']=null;
                            $_POST['CantidadMat']=null;
                            $_POST['PrecioMat']=null;
                        }
                }
                include_once("Vista/materia/crear.php");
        }
        //Recibe y envía los datos de la materia para poder editarlos
        public function editar(){
            if($_POST){
                $FolioMat=$_POST['FolioMat'];           
                $NombreMat=$_POST['NombreMat'];
                $NombreSuc=$_POST['NombreSuc'];
                $MedidasMat=$_POST['MedidasMat'];
                $TipoMadera=$_POST['TipoMadera'];
                $CantidadMat=$_POST['CantidadMat'];
                $PrecioMat=$_POST['PrecioMat'];
                Materia::editar(
                    $FolioMat,                
                    $NombreMat, 
                    $NombreSuc, 
                    $MedidasMat, 
                    $TipoMadera,
                    $CantidadMat,
                    $PrecioMat);
            }
            $FolioMat=$_GET['FolioMat'];
            $materia=(Materia::buscar($FolioMat));
            include_once("Vista/materia/editar.php");
        }
        //Recibe el folio para eliminar la materia prima 
        public function borrar(){
        $FolioMat=$_GET['FolioMat'];
        Materia::borrar($FolioMat);
        header("Location:./?controlador=materia&accion=inicio");
        }


    }
?>