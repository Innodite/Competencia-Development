<?php



include_once 'clsConexion.php';

class clsUtils extends clsConexion{
    
    public function __construct(){
        parent::__construct();
    }
    public function __destruct(){}
    
    public function getLsTipoCompetencia($selected=NULL,$single=NULL){
        $where = is_null($selected) ? "" : " where id_modo_competencia = '$selected'";
        $salida = array();
        $r = $this->filtro("select id_modo_competencia,nombre from modo_competencia $where order by nombre");
        if (is_null($single)){
            while($row = $this->proximo($r)){
                $salida[] = array("id"=>$row[0],"nombre"=>$row[1]);
            }
        }else{
            $row = $this->proximo($r);
            $salida[] = $row[1];
        }                            
        return $salida;
    }
    
    public function getLsCategorias($selected=NULL,$single=NULL){
        $where = is_null($selected) ? "" : " where id_categoria = $selected";
        $salida = array();
        $r = $this->filtro("select id_categoria, nombre from categoria $where order by nombre");
        if (is_null($single)){
            while($row = $this->proximo($r)){
                $salida[] = array("id"=>$row[0],"nombre"=>  strtoupper($row[1]));
            }
        }else{
            $row = $this->proximo($r);
            $salida[] = $row[1];
        }        
        return $salida;
    }
    
    public function getLsCompetenciasVal($selected=NULL,$single=NULL){
        $fecha = (isset($selected['desde']) && $selected['desde'] != "" && 
                        isset($selected['hasta'])  && $selected['hasta']  != "" ) ? " and c.fecha between '$selected[desde]' and '$selected[hasta]' " : "";
        
        $edad = (isset($selected['edad']) && $selected['edad'] != "" && !is_null($selected['edad'])) ? " $selected[edad] between ctg.edad_min and ctg.edad_max " : "(c.categoria = $selected[categoria] or $selected[categoria] = 0)";
        
        $where = is_null($selected) ? " where c.sts = 'VAL'" : " where  $edad
                                                                        $fecha
                                                                        and c.sts = 'VAL'";
        $salida = array();
        $r = $this->filtro("select c.id_competencia, 
                                              (c.fecha || ' / ' || tc.nombre || ' / ' || ctg.nombre) as nombre
                                    from competencia c
                                            inner join modo_competencia tc on tc.id_modo_competencia = c.id_modo_competencia
                                            inner join categoria ctg on ctg.id_categoria = c.id_categoria 
                                    $where");
        if (is_null($single)){
            while($row = $this->proximo($r)){
                $salida[] = array("id"=>$row[0],"nombre"=>  strtoupper($row[1]));
            }
        }else{
            $row = $this->proximo($r);
            $salida[] = $row[1];
        }        
        return $salida;
    }

    public function array_sort($array, $on, $order=SORT_ASC){
    	$new_array = array();
    	$sortable_array = array();
        
    	if (count($array) > 0) {
            foreach ($array as $k => $v) {
            	if (is_array($v)) {
                   foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) 
                        $sortable_array[$k] = $v2;                    
}
            	} else {
                    $sortable_array[$k] = $v;
            	}
            }

            switch ($order) {
            	case SORT_ASC: asort($sortable_array);   break;
            	case SORT_DESC: arsort($sortable_array); break;
            }

            foreach ($sortable_array as $k => $v) {
            	$new_array[$k] = $array[$k];
            }
    	}
    
    	return $new_array;
    }
    
    public static function setFormatFecha($date,$out="dd-mm-yyyy"){
        $sp = strpos($date,"/") === false ? "-" : "/";
        $tmp = explode($sp,$date);
        $sp = strpos($out,"/") === false ? "-" : "/";
        $tmp1 = explode($sp,$out);
        $aux = "";
        if (strlen($tmp1[0]) == 4){ if (strlen($tmp[0]) < 4){ $aux = $tmp[0]; $tmp[0] = $tmp[2]; $tmp[2] = $aux; }}
        if (strlen($tmp1[2]) == 4){ if (strlen($tmp[2]) < 4){ $aux = $tmp[2]; $tmp[2] = $tmp[0]; $tmp[0] = $aux; }}
        return $tmp[0].$sp.$tmp[1].$sp.$tmp[2];
    }

}

?>
