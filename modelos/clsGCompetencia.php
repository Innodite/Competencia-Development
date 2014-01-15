<?php

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clsGCompetencia
 *
 * @author JUrbano
 */
include 'clsConexion.php';
include 'clsUtils.php';

class clsGCompetencia  extends clsConexion{    
    //put your code here
    private $desde;
    private $hasta;
    private $categ;
    private $vuelt;
    private $ronda;
    private $time;
    private $competencia;
    private $id;
    private $utilidades;
    
    public function __construct($p=NULL){
        parent::__construct();
        $this->utilidades = new clsUtils();
        if (!is_null($p)){
            $this->desde = $p['desde'];
            $this->hasta = $p['hasta'];
            $this->categ = $p['categoria'];
            $this->vuelt = $p['vuelta'];
            $this->ronda = $p['ronda'];
            $this->time  = $p['time'];
            $this->competencia = $p['competencia'];
            $this->id = $p['id'];
        }
    }
    public function __destruct(){
        parent::__destruct();
    }
    
    public function BsCompetencias($p=NULL){}
	 
	 public function getInscripciones($p=NULL) {
	 	$vPos = array();
	 	$vPosAsigned = array();
	 	$rn	= 0;
	 	$valor = 0;
	 	$sw   = TRUE;
	 	
                if ($this->vuelt == 1)
                    $this->ejecutar("update competencia set sts = 'ACT' where id_competencia = $this->id");                
                
	 	$r = $this->filtro("select i.id_inscripcion, p.ci, p.nombre, p.edad,
       									  c.nro_vueltas, i.costo
									from inscripcion i
     										inner join competidor p on p.ci = i.ci_persona
     										inner join competencia c on c.id_competencia = i.competencia
									where c.id_competencia = $this->id");
		$rn = $this->getNumRows();					
		while($tupla = $this->proximo($r)) {
			$vPos[] = array("cedula"=>$tupla[1],"nombre"=>$tupla[2],"edad"=>$tupla[3],"rondas"=>$tupla[4],"costos"=>$tupla[5],"posicion"=>null,"id"=>$tupla[0]);
			 		
		}
		
		$str = "<table id='lstable'>
                            <tr>
                                <td><label>Rondas</label></td>
                                <td><label><div id='rrondas'>$this->vuelt/{$vPos[0]['rondas']}</div></label></td>
                                <td class='tdmin'><img id=\"imgnxt\" class=\"puntero\" title=\"Siguiente\" src=\"../img/next.png\" style='visibility:hidden'></td>
                                <td colspan='5'>
                                    <input type='hidden' name='nvmax' id='nvmax' value='{$vPos[0]['rondas']}'>
                                </td>
                            </tr>
                            <tr>
	 			<td class='tdmin'><label>Item</label></td>
	 			<td class='tdmin'><label>C&eacute;dula</label></td>
	 			<td class='tdlong'><label>Nombre</label></td>
	 			<td class='tdmin'><label>Edad</label></td>
	 			<td class='tdmin'><label>Ronda</label></td>
	 			<td class='tdmin'><label>Costo</label></td>
	 			<td class='tdlong'><label>Tiempo</label></td>
                                                                       <td><label>Ranking</label>
                                                                            <input type='hidden' id='ttalinsc' name='ttalinsc' value='$rn'>
                                                                            <input type='hidden' id='valuinsc' name='valuinsc' value='0'>
                                                                       </td>
                            </tr>";
		
		foreach($vPos as $key => $value){
			do {
				if (is_null($value['posicion'])){
					$valor = rand(1, $rn);
					if (!in_array($valor, $vPosAsigned)){						
						$vPos[$key]['posicion'] = $valor;
						$vPosAsigned[] = $valor;
						$sw = FALSE;  
					}
				}
			}while($sw);
			$sw = TRUE;
		}
		
		$vNewPos = $this->utilidades->array_sort($vPos,'posicion',SORT_ASC);
		foreach($vNewPos as $key => $value){
			$str .= "<tr>
                                                                        <td class='tdmin'>$value[posicion]</td>
                                                                        <td class='tdmin'>$value[cedula]</td>
                                                                        <td class='tdlong'>$value[nombre]</td>
                                                                        <td class='tdmin'>$value[edad]</td>
                                                                        <td class='tdmin'>$this->vuelt</td>
                                                                        <td class='tdmin'>$value[costos]</td>
                                                                        <td class='tdlong'>
                                                                            <input type='text' class='mintopbuttons' name='tftime$value[posicion]' id='tftime$value[posicion]' required>
                                                                            <img id=\"imgadd$value[posicion]\" class=\"topbuttons\" title=\"Agregar\" src=\"../img/add_med.png\" onclick=\"setTime($value[id],$this->vuelt,$value[posicion])\">
                                                                        </td>
                                                                        <td>
                                                                               <div id='rk$value[id]' class='ranking'></div>
                                                                               <div id='gk$value[id]' class='ranking'></div>
                                                                        </td>
                                                                  </tr>";	
		}
			
		$str .= "</table>";
		return $str;
	 }
	 
    public function getLsCompetencias($p=NULL){
        $v = $this->utilidades->getLsCompetenciasVal($p);
        $str = "<option value ='0'>Seleccione...</option>";
        foreach ($v as $key => $value) {
            $str .= "<option value ='$value[id]'>$value[nombre]</option>"; 
        }
        return $str;
    }

    public function setTime($p=NULL){
        $vOut = array();
        $vOutG = array();
        $this->IniciarTrans();        
        if (!$this->filtro("INSERT INTO result_comp(tiempo, posicion, ronda, id_inscripcion) VALUES ($this->time, 0, $this->ronda, $this->id)")) $this->error++;
        
        $r = $this->filtro("select rc.id_result, i.id_inscripcion, rc.ronda, rc.tiempo, rc.posicion, row_number() over(order by rc.ronda, rc.tiempo) posicion_final
                                    from result_comp rc
                                         inner join inscripcion i on i.id_inscripcion = rc.id_inscripcion
                                         inner join competencia c on c.id_competencia = i.competencia
                                    where c.id_competencia = $this->competencia
                                          and rc.ronda = $this->ronda
                                    order by rc.ronda, rc.tiempo");
        if (!$r)
            $this->error++;
        else{
            while($tupla = $this->proximo($r)){
                $vOut[] = array("id"=>$tupla[1],"posfinal"=>$tupla[5]);
                $sql = "update result_comp set posicion = $tupla[5] where id_result = $tupla[0]";
                if (!$this->filtro($sql)) $this->error++;
            }
            $rs = $this->filtro("select tmp.id_inscripcion,tmp.tiempo, row_number() over(order by 2) posicion_final 
                                          from 
                                           (select i.id_inscripcion, sum(rc.tiempo) tiempo
                                            from result_comp rc
                                              inner join inscripcion i on i.id_inscripcion = rc.id_inscripcion
                                              inner join competencia c on c.id_competencia = i.competencia
                                            where c.id_competencia = $this->competencia
                                                       and exists (select null 
                                                                          from result_comp trc 
                                                                          where trc.id_inscripcion = rc.id_inscripcion 
                                                       and trc.ronda = $this->ronda)
                                          group by i.id_inscripcion  
                                          order by 2) tmp");
            while ($row = $this->proximo($rs)) {
                $vOutG[] = array("id"=>$row[0],"posfg"=>$row[2]);
            }
        }
        $this->EndTrans();
        $this->cerrarConexion();
        $out = array("R"=>($this->error) ? FALSE : TRUE,"POSICIONES"=>$vOut,"GENERAL"=>$vOutG);
        return json_encode($out);
    }

}

?>
