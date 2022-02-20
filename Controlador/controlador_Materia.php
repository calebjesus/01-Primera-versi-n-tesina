<?php
include_once("conexion.php");
include_once("Modelo/materia.php");
Basededatos::CreateInstancia();


class ControladorMateria{

    public function inicio(){ 
        $materias=Materia::mostrar(); 
        include_once("Vista/materia/inicio.php");
    }

    public function crear(){
        if($_POST){
        $NombreMat=$_POST['NombreMat'];
        $NombreSuc=$_POST['NombreSuc'];
        $MedidasMat=$_POST['MedidasMat'];
        $TipoMadera=$_POST['TipoMadera'];
        $CantidadMat=$_POST['CantidadMat'];
        $PrecioMat=$_POST['PrecioMat'];
        Materia::crear(
                    $NombreMat, 
                    $NombreSuc, 
                    $MedidasMat, 
                    $TipoMadera,
                    $CantidadMat,
                    $PrecioMat);
            }
            include_once("Vista/materia/crear.php");
    }

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
                $PrecioMat
            );
        }
        
        $FolioMat=$_GET['FolioMat'];
        $materia=(Materia::buscar($FolioMat));
        include_once("Vista/materia/editar.php");
    }

    
    public function borrar(){
    $FolioMat=$_GET['FolioMat'];
    Materia::borrar($FolioMat);
    header("Location:./?controlador=materia&accion=inicio");
    }


}
?>