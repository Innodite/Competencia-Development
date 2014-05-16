<?php

include 'clsConexion.php';
include '../controladores/ctrPdf.php';

class clsReportes extends clsConexion {
    private $fecha;
    private $competencia;
    private $opcion;

    function __construct($p=NULL) {
        parent::__construct();
        if (!is_null($p)){
            $this->fecha = $p['fecha'];
            $this->competencia = $p['competencia'];
            $this->opcion = $p['opcion'];
        }
    }
    public function __destruct(){}
    
    public function buscarCompetencia(){
     $str = "<option value='0'>Seleccione</option>";
                $sql = "SELECT id_competencia,(comp.fecha || '/' || mc.nombre || '/' || cat.nombre) AS nombre FROM competencia AS comp,modo_competencia AS mc,categoria AS cat 
WHERE comp.id_modo_competencia = mc.id_modo_competencia 
AND comp.id_categoria = cat.id_categoria 
AND sts='FC' AND fecha = '$this->fecha'";
                $datos = $this->filtro($sql);
                while($columna = $this->proximo($datos)){
                         $str .= "<option value =$columna[0]>$columna[1]</option>";                                    
                }
                return $str;
}



public function mostrarDocumento(){
   return 1;
   // header("Content-type: application/pdf Location: http://localhost/competencia-development/modelos/clsDocumento.php");
}
}
?>