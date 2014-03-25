<?php
/*Desarrollado por Innodite 
    RIF:  J-40270256-6
    Contacto
        Javier Urbano     0416-583.38.09
        Anthony Filgueira 0426-594.00.45
*/
include("clsConexion.php");
include ("clsUtils.php");

class clsInscripcion extends clsConexion{
	private $id_inscripcion;
	private $cedula;
        private $nombre;
	private $edad;
        private $competencia;
        private $comp;
	
        public function __construct($competidor=NULL){
            parent::__construct();
            
            if (!is_null($competidor)){
		$this->id_inscripcion   = $competidor['id_inscripcion'];
		$this->cedula           = $competidor['cedula'];
                $this->nombre           = strtolower($competidor['nombre']);
                $this->edad             = $competidor['edad'];
                $this->competencia      = $competidor['competencia'];
                $this->comp             = $competidor['comp'];
		
                                        }               }

	public function __destruct(){}

public function listarInscripcionesInd(){
$sql = "SELECT id_inscripcion,cedula,nombre,edad,id_competencia,competencia FROM listarInscripcionesInd WHERE cedula=$this->cedula OR nombre='$this->nombre' OR edad=$this->edad OR id_competencia=$this->competencia";
$datos = $this->filtro($sql);
if ($this->getNumRows() > 0){
       $out = array();
        while($columna = $this->proximo($datos)){
                     $out[] = array(
                         'id_inscripcion'=>$columna[0],
                         'cedula'=>$columna[1],
                         'nombre'=>$columna[2],
                         'edad'=>$columna[3],
                         'id_competencia'=>$columna[4],
                         'competencia'=>$columna[5]); 
                      
                }
                $this->cerrarFiltro($datos);
		$this->cerrarConexion();
               return $out;
        }else{
            return 0;
        }
}

public function buscar(){
		$encontro = false;		

		$sql = "SELECT * FROM inscripcion WHERE cedula = '$this->cedula'";
		$datos = $this->filtro($sql);

		if ($columna = $conex->proximo($datos)){
			$this->id_inscripcion = $columna[0];
			$this->cedula     = $columna[1];
			$this->categoria      = $columna[2];
			$this->competencia    = $columna[3];
			$this->costo          = $columna[4];
            		$encontro = true;
		}//End IF

		$this->cerrarFiltro($datos);
		$this->cerrarConexion();
		return $encontro;
	}//Close Function Buscar
        
        public function buscarCompetidor(){
            
            $sql = "SELECT cedula, nombre,edad FROM competidor WHERE cedula = $this->cedula";
            $r = $this->filtro($sql);
            
            if ($this->getNumRows() > 0){
                
                $fila = $this->proximo($r);
                $out = array('ci'=>$fila[0],'nombre'=>$fila[1],'edad'=>$fila[2]);
                                        }
            else{ return 0;}
            
            return $out;  
        }
        public function inscribirCompetidor(){
            $sql = "SELECT inscribir_competidor($this->cedula,lower('$this->nombre'),$this->edad,$this->competencia,'$this->comp')";
            if($this->filtro($sql))
            {return 1;}
            else{
            return 0;}
        }

                public function insertar($p=NULL){
         $this->filtro("INSERT INTO competidor(cedula,nombre,edad) values ('$this->cedula','$this->nombre','$this->edad')");
              
         $out=  $this->filtro("INSERT INTO inscripcion(cedula,id_competencia) VALUES ('$this->cedula','$this->competencia')");
		
            return ($out);
	}

	public function modificar($p=NULL){
        $out = $this->filtro("update inscripcion set id_competencia = '$this->competencia'
                              where id_inscripcion = $this->id_inscripcion") ? true : false;
        $this->cerrarConexion();
        return $out;
    }

	public function eliminarInscripcion(){		
                if($this->filtro("delete from inscripcion where id_inscripcion = '$this->id_inscripcion'")){
                    $this->cerrarConexion();
                    return 1;
                }
                else{
                    return 0;
                }
                
	}

       public function getCategorias(){           
                $str = "<option value='0'>Seleccione...</option>";
                $sql = "select * from categoria where $this->edad between edad_min and edad_max";
                $datos = $this->filtro($sql);
                while($columna = $this->proximo($datos)){
                         $str .= "<option value =$columna[1]>$columna[0]</option>";                                    
                }
                return $str;
    }
    
    public function getCompetencias($p=NULL){
        $v = $this->utilidades->getLsCompetenciasVal($p);
        $str = "<option value ='0'>Seleccione...</option>";
        foreach ($v as $key => $value) {
            $str .= "<option value ='$value[id]'>$value[nombre]</option>"; 
        }
        return $str;
    }
    public function listarCompetenciaInd(){
        $sql = "select comp.id_competencia,(comp.fecha || '/' || mc.nombre || '/' || cat.nombre) AS nombre
                FROM competencia AS comp,categoria AS cat,modo_competencia AS mc 
                WHERE comp.id_modo_competencia = mc.id_modo_competencia 
                AND comp.id_categoria = cat.id_categoria AND comp.sts = 'VAL' AND mc.modalidad = 'individual'
                AND $this->edad BETWEEN cat.edad_min AND cat.edad_max";
        $datos = $this->filtro($sql);
        if ($this->getNumRows() > 0){
       $out = array();
        while($columna = $this->proximo($datos)){
                     $out[] = array('id_competencia'=>$columna[0],'nombre'=>$columna[1]); 
                      
                }
                $this->cerrarFiltro($datos);
		$this->cerrarConexion();
               return $out;
        }else{
            return 0;
        }
    }


    public function listarTabla($p=NULL){
        $where = is_null($p) ? "" : " where id_competencia=cod_comp";
        $i = 1;
        $str = "<table id='lstable'> 
                <tr>
                    <td>Cedula</td>
                    <td>Competidor</td>
                    <td>Edad</td>
                    <td>Competencia</td>
                   
                </tr>";
        $r = $this->filtro("select  i.id_inscripcion,
                                            i.cedula,
                                            co.nombre,
                                            co.edad,
                                            mc.nombre
                                    FROM inscripcion i,
                                         competidor co,
                                         competencia c,
                                         modo_competencia mc 
                                    WHERE c.id_competencia= i.id_competencia
                                          and co.cedula= i.cedula
                                          and c.id_modo_competencia = mc.id_modo_competencia
                                    ORDER BY 3");
        $rt =  $this->getNumRows();
            while ($row = $this->proximo($r)) {
               $str .= "<tr>
                            
                            <td>$row[1]</td>
                            <td>$row[2]</td>
                            <td>$row[3]</td>
                            <td>$row[4]</td>
                            <td>$row[5]</td>
                            <td>
                                <img id='imgf$i'class='puntero' title='Modificar' src='../img/up_med.png'  onclick=\"modificar(".$i++.",$row[0],$row[5])\">
                                <img class='puntero' title='Eliminar'  src='../img/del_med.png' onclick=\"eliminar('$row[0]')\">
                            </td>
                        </tr>
                        ";               
            }
        $str .= "</table>";
        $this->cerrarConexion();
        return ($rt > 0) ? $str : " ";
    }
}//Cierra Clase Inscripcion
?>
