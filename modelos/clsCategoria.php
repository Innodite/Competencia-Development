<?php
/*Desarrollado por www.innodite.com
    RIF:  J-40270256-6
    Contacto
        Javier Urbano     0416-583.38.09
        Anthony Filgueira 0426-594.00.45
*/
include 'clsConexion.php';

class clsCategoria extends clsConexion{

    private $nombre;
    private $agemin;
    private $agemax;
    private $id;

    
    public function __construct($arreglo=NULL){
        parent::__construct();
        if (!is_null($arreglo)){
            $this->nombre = $arreglo['nombre'];
            $this->agemin = $arreglo['edadMin'];
            $this->agemax = $arreglo['edadMax'];
            $this->id     = $arreglo['id'];
         
        }
    }
    
    public function __destruct(){}
    
    public function listarTabla($arreglo=NULL){
        //$where = is_null($p) ? "" : " where upper(nombre) like '%".  strtoupper($p['nombre'])."%'";
        $i = 1;
        $str = "<table id='lstable'>";
        $str .="<tr>
                        <td class='truco'><label>Nombre</label></td>
                        <td class='truco'><label>Edad M&iacute;nima</label></td>
                        <td class='truco'><label>Edad M&aacute;xima</label></td>
                        
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
    public function insertarCategoria() {
        $out = $this->filtro("SELECT insertar_categoria('$this->nombre',$this->agemin,$this->agemax)") ? true : 0;
        $this->cerrarConexion();
        return $out;                    }
        
    public function actualizarCategoria() {
       $out = $this->filtro("SELECT actualizar_categoria($this->id,'$this->nombre',$this->agemin,$this->agemax)") ? true : false;
       $this->cerrarConexion();
       return $out;                         }
   
    public function eliminarCategoria() {      
       $out = $this->filtro("SELECT eliminar_categoria($this->id)")? true : false;
       $this->cerrarConexion();
       return $out;                         }
    
          
}
?>
