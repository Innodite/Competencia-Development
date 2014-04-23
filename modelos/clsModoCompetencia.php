<?php


include 'clsConexion.php';

class clsModoCompetencia extends clsConexion {
    
    
    private $nombre;
    private $modalidad;
    
    public function __construct($p=NULL){
        parent::__construct();
        $this->nombre = $p['nombre'];
        $this->modalidad = $p['modalidad'];
    }
    
    public function __destruct(){}
    
    public function listarTabla($p=NULL){
//        $where = is_null($p) ? "" : " where upper(nombre) like '%".  strtoupper($p['nombre'])."%'";
        $i = 1;
        $str = "<table id='lstable'>";
        $str .="<tr>
                <td class='truco'>Modo de Competencia</td>
                <td class='truco'>Modalidad</td>
                </tr>";
        $r = $this->filtro("SELECT id_modo_competencia,nombre,modalidad FROM modo_competencia ORDER BY nombre");
        $rt =  $this->getNumRows();
            while ($row = $this->proximo($r)) {
               $str .= "<tr>
                            <td>$row[1]</td>
                            <td>$row[2]</td>
                            <td>
                                <img id='imgf$i' title='Modificar' src='../img/up_med.png'  onclick=\"modificar(".$i++.",'$row[1]',$row[0])\">
                                <img title='Eliminar'  src='../img/del_med.png' onclick=\"eliminar('$row[0]')\">
                            </td>
                        </tr>";               
            }
        $str .= "</table>";
        $this->cerrarConexion();
      return ($rt > 0) ? $str : " ";
    }
    
    public function insertar(){        
	$out = $this->filtro("insert into modo_competencia (nombre,modalidad) values ('$this->nombre','$this->modalidad')") ? true : false;
        $this->cerrarConexion();
        return $out;
    }
    
    public function modificar($p=NULL){
        $this->nombre = $p['nombre'];
        $out = $this->filtro("update modo_competencia set nombre= '$this->nombre' where id_modo_competencia = $p[id]") ? true : false;
        $this->cerrarConexion();
        return $out;
    }
    
    public function eliminar($p=NULL){
        $out = $this->filtro("delete from modo_competencia where id_modo_competencia = $p[id]") ? true : false;
        $this->cerrarConexion();
        return $out;
    }
}

?>
