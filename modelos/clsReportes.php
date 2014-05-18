<?php

include 'clsConexion.php';
include '../controladores/ctrPdf.php';

class clsReportes extends clsConexion {
    private $desde;
    private $hasta;
    private $tcomp;
    private $sts;
    private $competencia;
    private $opcion;

    function __construct($p=NULL) {
        parent::__construct();
        if (!is_null($p)){
            $this->desde = $p['fecha1'];
            $this->hasta = $p['fecha2'];
            $this->tcomp = $p['tcomp'];
            $this->sts = $p['sts'];
            $this->competencia = $p['competencia'];
            $this->opcion = $p['opcion'];
        }
    }
    public function __destruct(){}
    
    public function buscarCompetencia($p=null){
        $salida = array();
        $sts   = ($this->sts === "0")   ? "" : "AND sts='$this->sts'";
        $tcomp = ($this->tcomp === "0") ? "" : "AND upper(mc.modalidad) = '$this->tcomp'";
        $fecha = (is_null($this->desde) || is_null($this->hasta) || 
                  $this->desde == ''    || $this->hasta == '') ? "" : 
                  "AND fecha between '$this->desde' and '$this->hasta'";
        
        $sql = "SELECT id_competencia,
                       comp.fecha,
                       upper(case when comp.sts = 'FC'  then 'Finalizada'
                                  when comp.sts = 'VAL' then 'Pendiente'
                             else 'Invalido' end) sts,
                       upper(mc.modalidad) modalidad,
                       (mc.nombre || '/' || COALESCE(cat.nombre,ce.nombre)) AS nombre 
                FROM competencia AS comp
                     inner join modo_competencia AS mc on comp.id_modo_competencia = mc.id_modo_competencia 
                     left join categoria AS cat on comp.id_categoria = cat.id_categoria
                     left join categoria_equipo AS ce on ce.id_categoria = comp.id_categoria_equipo
                WHERE 
                      comp.sts is not null
                      $sts 
                      $tcomp 
                      $fecha
                ORDER BY 2 DESC";
        $datos = $this->filtro($sql);
        while($columna = $this->proximo($datos)){
            array_push($salida, array("id"=>$columna[0],"fecha"=>$columna[1],"sts"=>$columna[2],"modalidad"=>$columna[3],"nombre"=>$columna[4]));
        }
        return json_encode($salida, JSON_FORCE_OBJECT);
    }


}
?>