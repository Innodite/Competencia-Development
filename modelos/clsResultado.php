<?php
/*Desarrollado por Innodite 
    RIF:  J-40270256-6
    Contacto
        Javier Urbano     0416-583.38.09
        Anthony Filgueira 0426-594.00.45
*/
include("clsConexion.php");
include ("clsUtils.php");

class clsResultado extends clsConexion{
	private $id_competencia;
	
        public function __construct($competidor=NULL){
            parent::__construct();
            
            if (!is_null($competidor)){
		$this->id_competencia   = $competidor['id'];
		
                                        }               }

	public function __destruct(){}


public function listarResultados($p=NULL){
  
    $sql = "select * FROM ranking_encierro where id_competencia=".$this->id_competencia;
     $datos = $this->filtro($sql);
      if ($this->getNumRows() > 0){
       $out = array();
        while($columna = $this->proximo($datos)){
                     $out[] = array('nombre'=>$columna[0],'numero'=>$columna[6],'becerro'=>$columna[3],'tiempo'=>$columna[2]); 
                      
                }
                $this->cerrarFiltro($datos);
		$this->cerrarConexion();
               return $out;
        }else{
            return 0;
        }
    
}
    
}//Cierra Clase Inscripcion

/*
$ob = new clsResultado(array("id"=>5));

$t = $ob->listarResultados();
print_r($t);
 
 */
?>


