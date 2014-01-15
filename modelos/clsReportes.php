<?php

include 'clsConexion.php';

class clsReportes extends clsConexion {
    private $fecha;
    private $competencia;

    function __construct($p=NULL) {
        parent::__construct();
        if (!is_null($p)){
            $this->fecha = $p['fecha'];
            $this->competencia = $p['competencia'];
            
        }
    }
    public function __destruct(){}
    
    public function buscarCompetencia(){
     $str = "<option value='0'>Seleccione</option>";
                $sql = "select id_competencia,(tp.nombre,cat.categoria) as nombre FROM competencia as comp,tipo_competencia as tp,categoria as cat WHERE tipo_comp = cod_comp AND comp.categoria = id_categoria AND sts='FC' AND fecha = '$this->fecha'";
                $datos = $this->filtro($sql);
                while($columna = $this->proximo($datos)){
                         $str .= "<option value =$columna[0]>$columna[1]</option>";                                    
                }
                return $str;
}

}

?>