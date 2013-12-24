<?php


include 'clsConexion.php';

class clsModoCompetencia extends clsConexion {
    //put your code here
    
    private $nombre;
    
    public function __construct($vname){
        parent::__construct();
        $this->nombre = $vname;
    }
    
    public function __destruct(){}
    
    public function getName(){
        return $this->nombre;
    }
    
    public function listarTabla($p=NULL){
        $where = is_null($p) ? "" : " where upper(nombre) like '%".  strtoupper($p['nombre'])."%'";
        $i = 1;
        $str = "<table id='lstable'>";
        $str .="<td><label>Modo de Competencia</label></td>";
        $r = $this->filtro("select cod_comp, nombre from tipo_competencia $where order by nombre");
        $rt =  $this->getNumRows();
            while ($row = $this->proximo($r)) {
               $str .= "<tr>
                            <td>$row[1]</td>
                            <td>
                                <img id='imgf$i'class='puntero' title='Modificar' src='../img/up_med.png'  onclick=\"modificar(".$i++.",'$row[1]',$row[0])\">
                                <img class='puntero' title='Eliminar'  src='../img/del_med.png' onclick='eliminar($row[0])'>
                            </td>
                        </tr>
                        ";               
            }
        $str .= "</table>";
        $this->cerrarConexion();
        return ($rt > 0) ? $str : "";
    }
    
    public function insertar(){        
	$out = $this->filtro("insert into tipo_competencia (nombre) values ('$this->nombre')") ? true : false;
        $this->cerrarConexion();
        return $out;
    }
    
    public function modificar($p=NULL){
        $this->nombre = $p['nombre'];
        $out = $this->filtro("update tipo_competencia set nombre= '$this->nombre' where cod_comp = $p[id]") ? true : false;
        $this->cerrarConexion();
        return $out;
    }
    
    public function eliminar($p=NULL){
        $out = $this->filtro("delete from tipo_competencia where cod_comp = $p[id]") ? true : false;
        $this->cerrarConexion();
        return $out;
    }
}

?>
