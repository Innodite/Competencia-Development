<?php

include 'clsConexion.php';

class clsCrearEquipo extends clsConexion{
    //put your code here
    private $nombre;
    private $cedula;
    private $competidor;
    private $edad;
    private $id;
    
    public function __construct($p=NULL){
        parent::__construct();
        if (!is_null($p)){
            $this->nombre     = $p['nombre'];
            $this->cedula     = $p['cedula'];
            $this->competidor = $p['competidor'];
            $this->edad       = $p['edad'];
            $this->id         = $p['id'];
        }
    }
    
    public function __destruct(){}
    
    public function buscaEquipo($p=NULL){
        $fila = 0;
        $str = '<table id="listable">
                        <tr>
                                    <td colspan="4">
                                            <label>Integrantes del Equipo</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <img id="imgadd"  title="Agregar Integrante" src="../img/add_med.png" onclick="addFila()"/>
                                    </td>
                        </tr>
                        <tr>
                                    <td><label>C&eacute;dula</label></td>
                                    <td><label>Competidor</label></td>
                                    <td><label>Edad</label></td>
                                    <td></td>
                        </tr>';
        $r = $this->filtro("select e.id_equipo, 
                                   e.nombre equipo, 
                                   ie.id_int_equip, 
                                   c.id_competidor,
                                   c.cedula,
                                   c.nombre,
                                   c.edad
                            from equipo e
                                inner join integrantes_equipo ie on ie.id_equipo = e.id_equipo
                                inner join competidor c on c.id_competidor = ie.id_competidor
                            where upper(e.nombre) = upper('$this->nombre')");
        $rt =  $this->getNumRows();
        
        if ($rt > 0){ 
            while($row = $this->proximo($r)){
                $str .=  "<tr>
                                   <td><input type=\"text\" name=\"cedula_$fila\" id=\"cedula_$fila\" value='$row[cedula]' onkeyup=\"verificarCi($fila)\" readonly=''/></td>
                                   <td><input type=\"text\" name=\"competidor_$fila\" id=\"competidor_$fila\" value='$row[nombre]' readonly=''/></td>
                                   <td><input type=\"text\" name=\"edad_$fila\" id=\"edad_$fila\" value='$row[edad]' readonly=''/></td>
                                   <td style=\"text-align:left;\">
                                        <img id=\"imgdel_$fila\"  title=\"Quitar Integrante\"  src=\"../img/del_med.png\" onclick=\"delFila($fila,$row[id_int_equip])\"/>
                                   </td>
                              </tr>";
                // <img id=\"imgsav_$fila\"  title=\"Guardar Cambios\" src=\"../img/save.png\" onclick=\"saveIntegrante($fila)\" style=\"width:28px; height:28px\">
                $fila++;
            };
        }else
                    $str .=  "<tr>
                                   <td><input type=\"text\" name=\"cedula_$fila\" id=\"cedula_$fila\" onkeyup=\"verificarCi($fila)\"/></td>
                                   <td><input type=\"text\" name=\"competidor_$fila\" id=\"competidor_$fila\"/></td>
                                   <td><input type=\"text\" name=\"edad_$fila\" id=\"edad_$fila\"/></td>
                                   <td style=\"text-align:left;\">
                                        <img id=\"imgsav_$fila\"  title=\"Guardar Cambios\" src=\"../img/save.png\" onclick=\"saveIntegrante($fila)\" style=\"width:28px; height:28px\">
                                   </td>
                              </tr>";
        //<img id=\"imgdel_$fila\"  title=\"Quitar Integrante\"  src=\"../img/del_med.png\" onclick=\"delFila($fila)\"/>
         $str .= '</table>';
        return json_encode(array("rows"=>$rt, "data"=>$str), JSON_FORCE_OBJECT);
    }
    
    public function isExistEq(){
        $r = $this->filtro("select id_equipo from equipo where upper(nombre) = upper('$this->nombre')");
        $rt =  $this->getNumRows();
        $row = $this->proximo($r);
        return ($rt > 0) ? $row['id_equipo'] : false;
    }
    
    public function isExistPs(){
        $r = $this->filtro("select id_competidor from competidor where cedula = $this->cedula");
        $rt =  $this->getNumRows();
        $row = $this->proximo($r);
        return ($rt > 0) ? $row['id_competidor'] : false;
    }
    
    public function insertar($p=NULL){
        $ide = false;
        $idp = false;
        $this->IniciarTrans();
        
        if (!$ide = $this->isExistEq()){
            if(!$this->filtro("insert into equipo (nombre) values (upper('$this->nombre'))")){ $this->error++; }
            else { $ide = $this->isExistEq(); }
        }
        
        if ($ide){
           $idp = $this->isExistPs();
           if (!$idp){
               if (!$this->filtro("insert into competidor (cedula,nombre,edad) values ($this->cedula,'$this->competidor',$this->edad)")){ $this->error++; }
               else{ $idp = $this->isExistPs(); }
           }
            
           if (!$this->filtro("insert into integrantes_equipo (id_equipo, id_competidor) values ($ide,$idp)")) $this->error++;
        }
        
        $this->EndTrans();
        return json_encode(array("rs"=> ($this->error > 0) ? false : true), JSON_FORCE_OBJECT);
    }
    
    public function eliminar($p=NULL){
        $r = $this->filtro("delete from integrantes_equipo where id_int_equip = $this->id");
        return json_encode(array("rs"=> $r ? true : false), JSON_FORCE_OBJECT);
    }
}

?>
