<?php


include 'clsConexion.php';

class clsCategoria extends clsConexion{
    //put your code here
    private $nombre;
    private $agemin;
    private $agemax;
    private $id;
    
    public function __construct($p=NULL){
        parent::__construct();
        if (!is_null($p)){
            $this->nombre = $p['nombre'];
            $this->agemin = $p['agemin'];
            $this->agemax = $p['agemax'];
            $this->id     = $p['id'];
        }
    }
    
    public function __destruct(){}
    
    public function listarTabla($p=NULL){
        //$where = is_null($p) ? "" : " where upper(nombre) like '%".  strtoupper($p['nombre'])."%'";
        $i = 1;
        $str = "<table id='lstable'>";
        $str .="<tr>
                        <td><label>Nombre</label></td>
                        <td><label>Edad M&iacute;nima</label></td>
                        <td><label>Edad M&aacute;xima</label></td>
                        
                    </tr>";
        $r = $this->filtro("select * FROM ver_categoria");
        $rt =  $this->getNumRows();
            while ($row = $this->proximo($r)) {
               $str .= "<tr>
                            <td>$row[0]</td>
                            <td>$row[1]</td>
                            <td>$row[2]</td>
                            <td>
                                <img id='imgf$i' title='Modificar' src='../img/up_med.png'  onclick=\"modificar(".$i++.",'$row[0]',$row[1],$row[2],$row[3])\">
                                <img title='Eliminar'  src='../img/del_med.png' onclick=\"eliminar('$row[3]')\">
                            </td>
                        </tr>
                        ";               
            }
        $str .= "</table>";
        $this->cerrarConexion();
        return ($rt > 0) ? $str : " ";
    }
    
    public function insertar(){
        $out = $this->filtro("SELECT insertar_categoria('$this->nombre',$this->agemin,$this->agemax)") ? true : false;
        $this->cerrarConexion();
        return $out;
    }
    
    public function modificar($p=NULL){
        $this->nombre = $p['nombre'];
        $this->agemin = $p['agemin'];
        $this->agemax = $p['agemax'];
        
        $out = $this->filtro("SELECT actualizar_categoria($p[id],'$this->nombre',$this->agemin,$this->agemax)") ? true : false;
        $this->cerrarConexion();
        return $out;
    }
    
    public function eliminar($p=NULL){
        $out = $this->filtro("SELECT eliminar_categoria($p[id])") ? true : false;
        $this->cerrarConexion();
        return $out;
    }
}

?>
