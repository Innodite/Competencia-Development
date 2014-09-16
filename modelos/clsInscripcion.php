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
	private $nombreEquipo;
        private $idEquipo;
        public function __construct($competidor=NULL){
            parent::__construct();
            
            if (!is_null($competidor)){
		$this->id_inscripcion   = $competidor['id_inscripcion'];
		$this->cedula           = $competidor['cedula'];
                $this->nombre           = strtolower($competidor['nombre']);
                $this->edad             = $competidor['edad'];
                $this->competencia      = $competidor['competencia'];
                $this->comp             = $competidor['comp'];
                $this->nombreEquipo     = strtolower($competidor['nombreEquipo']);
                $this->idEquipo         = $competidor['idEquipo'];
		
                                        }               }

	public function __destruct(){}

public function listarInscripcionesInd(){
$sql = "SELECT id_inscripcion,cedula,nombre,edad,id_competencia,competencia FROM inscripciones_individuales WHERE cedula=$this->cedula OR id_competencia=$this->competencia OR nombre='$this->nombre'";
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
public function listarEquipo(){
    $sql = "SELECT * FROM equipo";
     $datos = $this->filtro($sql);
      if ($this->getNumRows() > 0){
       $out = array();
        while($columna = $this->proximo($datos)){
                     $out[] = array('id_equipo'=>$columna[0],'nombre'=>$columna[1]); 
                      
                }
                $this->cerrarFiltro($datos);
		$this->cerrarConexion();
               return $out;
        }else{
            return 0;
        }
    
}
public function inscribirEquipo(){
    $sql = "INSERT INTO inscripcion(id_equipo,id_competencia) values ($this->idEquipo,$this->competencia)";
     if($this->filtro($sql))
            {return 1;}
            else{
            return 0;}
    
}
public function listarInscripcionesEquip(){
    $sql = "SELECT * FROM inscripciones_equipo WHERE id_equipo = $this->idEquipo OR id_competencia = $this->competencia ";
    $datos = $this->filtro($sql);
if ($this->getNumRows() > 0){
       $out = array();
        while($columna = $this->proximo($datos)){
                     $out[] = array(
                         'id_inscripcion'=>$columna[0],
                         'nombre'=>$columna[1],
                         'id_competencia'=>$columna[2],
                         'competencia'=>$columna[3]); 
                      
                }
                $this->cerrarFiltro($datos);
		$this->cerrarConexion();
               return $out;
        }else{
            return 0;
        }
}

public function listarCompetenciaEquip(){
    $sql = "SELECT * FROM catequipo('$this->nombreEquipo')";
    $datos = $this->filtro($sql);
       if ($this->getNumRows() > 0){
       $out = array();
        while($columna = $this->proximo($datos)){
                     $out[] = array('id_competencia'=>$columna[0],'nombreE'=>$columna[1]); 
                      
                }
                $this->cerrarFiltro($datos);
		$this->cerrarConexion();
               return $out;
        }else{
            return 0;
        }
   
}

        
        public function buscarCompetidor(){
            
            $sql = "SELECT cedula, nombre,edad,fecha_nac FROM competidor WHERE cedula = $this->cedula";
            $r = $this->filtro($sql);
            
            if ($this->getNumRows() > 0){
                
                $fila = $this->proximo($r);
                $out = array('ci'=>$fila[0],'nombre'=>$fila[1],'edad'=>$fila[3]);
                                        }
            else{ return 0;}
            
            return $out;  
        }
        public function inscribirCompetidor(){
            $sql = "SELECT inscribir_competidor($this->cedula,lower('$this->nombre'),'$this->edad',$this->competencia,'$this->comp')";
            if($this->filtro($sql))
            {return 1;}
            else{
            return 0;}
        }


	public function eliminarInscripcion(){		
                if($this->filtro("DELETE FROM inscripcion WHERE id_inscripcion = '$this->id_inscripcion'")){
                    $this->cerrarConexion();
                    return 1;
                }
                else{
                    return 0;
                }
                
	}

      
    public function listarCompetenciaInd(){
        $sql = "select * from cat_insc_ind('$this->edad')";
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
    
}//Cierra Clase Inscripcion
?>
