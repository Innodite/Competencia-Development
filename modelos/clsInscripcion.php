<?php

include("clsConexion.php");
include ("clsUtils.php");
/*
Desarrollado Por Innodite 
RIF J-
Contacto:
Anthony Filgueira
0426-5940045
Javier Urbano
0416-5833809
*/
class clsInscripcion extends clsConexion{
	private $id_inscripcion;
	private $cedula;
	private $competencia;
        private $nombre;
        private $edad;
        private $sw;
        private $utilidades;

	public function __construct($p=NULL){
            parent::__construct();
            $this->utilidades = new clsUtils();
            if (!is_null($p)){
		$this->id_inscripcion = $p['id'];
		$this->cedula = $p['txtCedula'];
		$this->competencia = $p['txtCompetencia'];
                $this->nombre = $p['nombre'];
                $this->edad = $p['edad'];
                $this->sw = $p['swper'];
            }
	}

	public function __destruct(){}

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
        
        public function chkCi($p=NULL){
            $out = "";
            $where = is_null($p) ? " where cedula = '$this->cedula'" : " where cedula = '$p[txtCedula]'";
            $sql = "select cedula, nombre,edad from competidor $where";
            $r = $this->filtro($sql);
            if ($this->getNumRows() > 0){
                $fila = $this->proximo($r);
                $out = array("CI"=>$fila[0],"NOMBRE"=>$fila[1],"EDAD"=>$fila[2]);
            }else
                return 0;
            return json_encode($out);  
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

	public function eliminar($p){		
		$out = $this->filtro("delete from inscripcion where id_inscripcion = '$p[id]'") ? true : false;
		$this->cerrarConexion();
                return $out;
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
