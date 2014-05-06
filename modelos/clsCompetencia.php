<?php
/*Desarrollado por Innodite 
    RIF:  J-40270256-6
    Contacto
        Javier Urbano     0416-583.38.09
        Anthony Filgueira 0426-594.00.45
*/
include 'clsConexion.php';
include 'clsUtils.php';

class clsCompetencia extends clsConexion{
 
    
    private $id;
    private $fecha;
    private $tip_comp;
    private $porcp;
    private $porcc;
    private $inscripcion;
    private $rondas;
    private $categoria;
    private $utilidades;
    
    public function __construct($p=NULL){
        parent::__construct();
        $this->utilidades = new clsUtils();
         if (!is_null($p)){
             $this->id = $p['id'];
             $this->fecha = $p['fecha'];
             $this->tip_comp = $p['tip_comp'];
             $this->porcp = $p['porcp'];
             $this->porcc = $p['porcc'];
              $this->inscripcion = $p['inscripcion'];
             $this->rondas = $p['rondas'];
             $this->categoria = $p['categoria'];
         }
    }
    public function __destruct(){}
    
    public function listarTabla($p=NULL){
        $where = is_null($p) ? "" : " where fecha = '". strtoupper($p['fecha'])."' and id_modo_competencia = '$p[tip_comp]'";
        $i = 1;
        $str = "<table id='lstable'>
<tr>
<td class='truco'><label>Fecha</label></td>
<td class='truco'><label>Competencia</label></td>
<td class='truco'><label>Categoria</label></td>
<td class='truco'><label>% Premio</label></td>
<td class='truco'><label>% Casa</label></td>
<td class='truco'><label>Inscripcion</label></td>
<td class='truco'><label>Vueltas</label></td>
</tr>";
        $r = $this->filtro("select id_competencia,fecha,id_modo_competencia,id_categoria,porc_premio,porc_casa,monto_inscripcion,vueltas from competencia $where order by fecha");
        $rt = $this->getNumRows();
            while ($row = $this->proximo($r)) {
               $vtc = $this->utilidades->getLsTipoCompetencia($row[2],TRUE);
               $vct = $this->utilidades->getLsCategorias($row[3],TRUE);
               $str .= "<tr>
<td class='lstb_med'>$row[1]</td>
<td class='lstb_med'>". $vtc[0] ."</td>
<td class='lstb_med'>$vct[0]</td>
<td class='lstb_small'>$row[4]</td>
<td class='lstb_small'>$row[5]</td>
<td class='lstb_large0'>$row[6]</td>
<td class='lstb_small'>$row[7]</td>
<td class='topbuttons'>
<img id='imgf$i'class='puntero' title='Modificar' src='../img/up_med.png' onclick=\"modificar(".$i++.",$row[0],'$row[1]',$row[2],$row[3],$row[4],'$row[5]',$row[6],'$row[7]')\">
<img class='puntero' title='Eliminar' src='../img/del_med.png' onclick=\"eliminar('$row[0]')\">
</td>
</tr>
";
            }
        $str .= "</table>";
        $this->utilidades->cerrarConexion();
        $this->cerrarConexion();
        return ($rt > 0) ? $str : " ";
    }
    
    public function getCompetencias(){
        $v = $this->utilidades->getLsTipoCompetencia();
        $str = "<option value ='0'>Seleccione...</option>";
        foreach ($v as $key => $value) {
            $str .= "<option value ='$value[id]'>$value[nombre]</option>";
        }
        return $str;
    }
    
    public function getCategorias(){
        $v = $this->utilidades->getLsCategorias();
        $str = "<option value ='0'>Seleccione...</option>";
        foreach ($v as $key => $value) {
            $str .= "<option value ='$value[id]'>$value[nombre]</option>";
        }
        return $str;
    }

    public function insertar(){
        $sql = "insert into competencia (fecha,id_modo_competencia,porc_premio,porc_casa,monto_inscripcion,vueltas,id_categoria,sts)
values
('$this->fecha',$this->tip_comp,$this->porcp,$this->porcc,$this->inscripcion,$this->rondas,'$this->categoria','VAL')";
        $out = ($this->filtro($sql)) ? true : false;
        $this->cerrarConexion();
        return $out;
    }
    
    public function modificar($p=NULL){
        $out = $this->filtro("update competencia set fecha = '$this->fecha', id_modo_competencia = $this->tip_comp, porc_premio = $this->porcp, porc_casa = $this->porcc,
vueltas = $this->rondas, id_categoria = '$this->categoria'
where id_competencia = $this->id") ? true : false;
        $this->cerrarConexion();
        return $out;
    }

    public function eliminar($p=NULL){
        $out = $this->filtro("delete from competencia where id_competencia = '$p[id]'") ? true : false;
        $this->cerrarConexion();
        return $out;
    }
}

?>