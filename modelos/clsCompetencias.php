<?php
include 'clsConexion.php';

class clsCompetencias extends clsConexion{
    private $fecha;
    private $modalidad;
    private $id_competencia;
    private $id_inscripcion;
    private $tiempo;
    private $ronda;
    private $total;
    private $salida;
    private $becerros;


    public function __construct($arreglo=NULL) {
            parent::__construct();
                 if (!is_null($arreglo)){
                        $this->fecha = $arreglo['fecha'];
                        $this->modalidad = $arreglo['modalidad'];
                        $this->id_competencia = $arreglo['id_competencia'];
                        $this->id_inscripcion = $arreglo['id_inscripcion'];
                        $this->tiempo = $arreglo['tiempo'];
                        $this->ronda = $arreglo['ronda'];
                        $this->total = $arreglo['total'];
                        $this->salida = $arreglo['salida'];
                        $this->becerros = $arreglo['becerros'];
                                  }          }
    public function __destruct(){}    
        
    public function cargarCompetencia(){
                
                $str = "<option value=''>Seleccione</option>";
                $sql = "SELECT id_competencia,nombre from mostrar_competencia WHERE fecha = '$this->fecha' AND modalidad='$this->modalidad'";
                
                $datos = $this->filtro($sql);
                
                while($columna = $this->proximo($datos)){
                         $str .= "<option value =$columna[0]>$columna[1]</option>";                                    
                }
                return $str;
                                            }
                                  
    public function iniciarCompetencia(){
                if($this->modalidad=="individual"){
                    
//                       $update = "UPDATE competencia SET sts='EC' WHERE id_competencia='$this->id_competencia'";
//                       $this->filtro($update);
       
                        $i = 1;
                        $sql= "SELECT vueltas FROM competencia WHERE id_competencia= '$this->id_competencia'";
                        $vueltas = $this->filtro($sql);
                        $arreglo= $this->proximo($vueltas);
                        
                        $this->ronda = 1; 
                        $this->total = $arreglo[0];
                        
                        $str = "<table id='competidores'> 
                                    <tr>
                                    <td>Competidor</td>
                                    <td>Vuelta</td>
                                    <td>Tiempo</td>
                                    <td><label>Ronda $this->ronda-$this->total&nbsp;&nbsp;</label><img id='flecha' src='../img/arrow455.png' width='25' height='25' title='Siguiente Ronda' onclick=\"nextRound($this->ronda,'$this->total','$this->id_competencia')\" ></td>
                                    </tr>";
                        $competidores = $this->filtro("SELECT * FROM competidores_aleatorios WHERE id_competencia='$this->id_competencia'");
                        $registros =  $this->getNumRows();
                            while ($competidor = $this->proximo($competidores)) {
                                    $str .= "<tr>
                                                <td>$competidor[1]</td>
                                                <td> $this->ronda</td>
                                                <td><input type='number' size='5' min='1' max='99.999' step='01.001'  id='tiempof$i' required/></td>
                                                <td>
                                                    <img src='../img/notes7.png' width='25' height='25' id='agregarf$i' title='Agregar'  onclick=\"agregar(".$i.",'$competidor[0]','$competidor[2]','$this->ronda')\" >
                                                </td>
                                            </tr>";
                                    $i++;                                       }
                        $str .= "</table>";
                        $this->cerrarConexion();
                        return ($registros > 0) ? $str :0;   }//Fin del IF
                if($this->modalidad=="grupo"){
                    //  $update = "UPDATE competencia SET sts='EC' WHERE id_competencia='$this->id_competencia'";
//                       $this->filtro($update);
       
                        $i = 1;
                        $sql= "SELECT vueltas FROM competencia WHERE id_competencia= '$this->id_competencia'";
                        $vueltas = $this->filtro($sql);
                        $arreglo= $this->proximo($vueltas);
                        
                        $this->ronda = 1; 
                        $this->total = $arreglo[0];
                        
                        $str = "<table id='competidores'> 
                                    <tr>
                                    <td>Equipo</td>
                                    <td>Vuelta</td>
                                    <td>Tiempo</td>
                                    <td>Becerros</td>
                                    <td><label>Ronda $this->ronda-$this->total&nbsp;&nbsp;</label><img id='flecha' src='../img/arrow455.png' width='25' height='25' title='Siguiente Ronda' onclick=\"nextRound($this->ronda,'$this->total','$this->id_competencia')\" ></td>
                                    </tr>";
                        $equipos = $this->filtro("SELECT * FROM equipos_aleatorios WHERE id_competencia='$this->id_competencia'");
                        $registros =  $this->getNumRows();
                            while ($equipo = $this->proximo($equipos)) {
                                    $str .= "<tr>
                                                <td>$equipo[1]</td>
                                                <td> $this->ronda</td>
                                                <td><input type='number' size='5' min='1' max='99.999' step='01.001'  id='tiempof$i' required/></td>
                                                <td><input type='number' size='1' min='1' max='5' step='1'  id='becerrof$i' required/></td>
                                                <td>
                                                    <img src='../img/notes7.png' width='25' height='25' id='agregarf$i' title='Agregar'  onclick=\"agregarTE(".$i.",'$equipo[0]','$equipo[2]','$this->ronda')\" >
                                                </td>
                                            </tr>";
                                    $i++;                                       }
                        $str .= "</table>";
                        $this->cerrarConexion();
                        return ($registros > 0) ? $str :0;
                }
        
                }//Fin Funcion Iniciar_Competencia
                
    public function agregarTiempo(){

        $a= $this->filtro("select  agregar_tiempobp($this->id_inscripcion,$this->salida,$this->ronda,$this->tiempo)") ? true : false;
            if ($a!= 1){
                return 0;
                }else{
                $i = 1;
                $str = "
                        <table id='ranking'> 
                        
                            <tr>
                                <td>Posicion</td>
                                <td>Competidor</td>
                                <td>Tiempo</td>
                            </tr>";
                $r = $this->filtro("select * from ranking_barriles_poste WHERE id_competencia = '$this->id_competencia'");
                $rt =  $this->getNumRows();
                    while ($row = $this->proximo($r)) {
                            $str .= "<tr>
                                        <td>$i</td>
                                        <td >$row[0]</td>
                                        <td >$row[1]</td>
                                        </tr>";
                            $i++;                       }
                            $str .= "</table>";
        $this->cerrarConexion();
        return ($rt >0) ? $str :0;}
}
                    
 public function nextRound(){
    $i = 1;
    $this->ronda= $this->ronda +1;
   
    
   if($this->ronda <= $this->total){
      
        $str = "<table id='competidores'> 
                    <tr>
                        <td>Competidor</td>
                        <td>Vuelta</td>
                        <td>Tiempo</td>
                        <td><label>Ronda $this->ronda-$this->total&nbsp;&nbsp;</label><img src='../img/arrow455.png' width='25' height='25' title='Siguiente Ronda' onclick=\"nextRound($this->ronda,'$this->total','$this->id_competencia')\" ></td>
                    </tr>";
        $competidores = $this->filtro("select * from competidores_aleatorios WHERE id_competencia = '$this->id_competencia'");
        
        $registros =  $this->getNumRows();
            while ($competidor = $this->proximo($competidores)) {
               $str .= "<tr>
                            <td >$competidor[1]</td>
                            <td> $this->ronda</td>
                            <td><input type='number' size='5' min='0' max='99.999' step='00.001'  id='tiempof$i' required/></td>
                            <td>
                                <img src='../img/notes7.png' width='25' height='25' id='agregarf$i' title='Agregar'  onclick=\"agregar(".$i.",'$competidor[0]','$competidor[2]','$this->ronda')\" >
                            </td>
                        </tr>";
               $i++;                            }
               $str .= "</table>";
               $this->cerrarConexion();
                return ($registros > 0) ? $str :0;}     }
     public function primeraDivision(){
         $i = 1;
        $str = "<h1>Primera Division</h1>
                <table id='primeraD'> 
                <tr>
                    <td>Posicion</td>
                    <td>Competidor</td>
                    <td>Tiempo</td>
                </tr>";
         $r = $this->filtro("SELECT * FROM primera_division WHERE id_competencia='$this->id_competencia'");
        $rt =  $this->getNumRows();
        while ($row = $this->proximo($r)) {
              $str .= "<tr>
                            <td>$i</td>
                            <td>$row[0]</td>
                            <td>$row[1]</td>
                       </tr>";
              $i++;
           }
       $str .= "</table>";
       $this->cerrarConexion();
       return ($rt > 0) ? $str :0;
     }
  public function segundaDivision(){
         $i = 1;
        $str = "<h1>Segunda Division</h1>
                <table id='segundaD'> 
                <tr>
                    <td>Posicion</td>
                    <td>Competidor</td>
                    <td>Tiempo</td>
                </tr>";
         $r = $this->filtro("SELECT * FROM segunda_division WHERE id_competencia='$this->id_competencia'");
        $rt =  $this->getNumRows();
        while ($row = $this->proximo($r)) {
              $str .= "<tr>
                            <td>$i</td>
                            <td>$row[0]</td>
                            <td>$row[1]</td>
                       </tr>";
              $i++;
           }
       $str .= "</table>";
       $this->cerrarConexion();
       return ($rt > 0) ? $str :0;
     }
   public function terceraDivision(){
         $i = 1;
        $str = "<h1>Tercera Division</h1>
                <table id='terceraD'> 
                <tr>
                    <td>Posicion</td>
                    <td>Competidor</td>
                    <td>Tiempo</td>
                </tr>";
         $r = $this->filtro("SELECT * FROM tercera_division WHERE id_competencia='$this->id_competencia'");
        $rt =  $this->getNumRows();
        while ($row = $this->proximo($r)) {
              $str .= "<tr>
                            <td>$i</td>
                            <td>$row[0]</td>
                            <td>$row[1]</td>
                       </tr>";
              $i++;
           }
       $str .= "</table>";
       $this->cerrarConexion();
       return ($rt > 0) ? $str :0;
     }
     public function agregarTE(){
         if($this->becerros==0 || $this->tiempo==0){
            
             $sql1="select falla FROM ranking as rank,inscripcion as insc where insc.id_competencia='$this->id_competencia' AND insc.id_inscripcion='$this->id_inscripcion' AND rank.id_inscripcion=insc.id_inscripcion";
             $r = $this->filtro($sql1);
             $row = $this->proximo($r);
             $falla = $row[0] + 1;
             
             $a= $this->filtro("INSERT INTO ranking(id_inscripcion,salida,vuelta, tiempo,becerro) VALUES ($this->id_inscripcion,$this->salida,$this->ronda, $this->tiempo,$this->becerros)") ? true : false;
             
             $sql = "UPDATE ranking SET  falla=$falla  WHERE id_inscripcion='$this->id_inscripcion' ";
             $this->filtro($sql);
              if ($a!= 1){
                return 0;
            }else{
                $i = 1;
                $str = "<table id='ranking'> 
                            <tr>
                                <td>Posicion</td>
                                <td>Competidor</td>
                                <td>Tiempo</td>
                                <td>Becerros</td>
                            </tr>";
                $r = $this->filtro("SELECT * FROM ranking_encierro WHERE id_competencia = '$this->id_competencia'");
                $rt =  $this->getNumRows();
                    while ($row = $this->proximo($r)) {
                            $str .= "<tr>
                                        <td>$i</td>
                                        <td >$row[0]</td>
                                        <td >$row[2]</td>
                                        <td >$row[3]</td>
                                        </tr>";
                            $i++;                       }
                            $str .= "</table>";
        $this->cerrarConexion();
         return ($rt >0) ? $str :0;}
         }
         else{
             $sql1="select falla FROM ranking as rank,inscripcion as insc where insc.id_competencia='$this->id_competencia' AND insc.id_inscripcion='$this->id_inscripcion' AND rank.id_inscripcion=insc.id_inscripcion";
             $re = $this->filtro($sql1);
             $row = $this->proximo($re);
             $falla2 = $row[0];
             
             $a= $this->filtro("INSERT INTO ranking(id_inscripcion,salida,vuelta, tiempo,becerro) VALUES ($this->id_inscripcion,$this->salida,$this->ronda, $this->tiempo,$this->becerros)") ? true : false;
          
             $sql = "UPDATE ranking SET  falla=$falla2  WHERE id_inscripcion='$this->id_inscripcion'";
             $this->filtro($sql);
             
         if ($a!= 1){
                return 0;
            }else{
                $i = 1;
                $str = "<table id='ranking'> 
                            <tr>
                                <td>Posicion</td>
                                <td>Competidor</td>
                                <td>Tiempo</td>
                                <td>Becerros</td>
                            </tr>";
                $r = $this->filtro("SELECT * FROM ranking_encierro WHERE id_competencia = '$this->id_competencia'");
                $rt =  $this->getNumRows();
                    while ($row = $this->proximo($r)) {
                            $str .= "<tr>
                                        <td>$i</td>
                                        <td >$row[0]</td>
                                        <td >$row[2]</td>
                                        <td >$row[3]</td>
                                        </tr>";
                            $i++;                       }
                            $str .= "</table>";
        $this->cerrarConexion();
         return ($rt >0) ? $str :0;}}
     }
     public function nextRoundE(){
    $i = 1;
    $this->ronda= $this->ronda +1;
   
    
   if($this->ronda <= $this->total){
      
        $str = "<table id='competidores'> 
                                    <tr>
                                    <td>Equipo</td>
                                    <td>Vuelta</td>
                                    <td>Tiempo</td>
                                    <td>Becerros</td>
                                    <td><label>Ronda $this->ronda-$this->total&nbsp;&nbsp;</label><img id='flecha' src='../img/arrow455.png' width='25' height='25' title='Siguiente Ronda' onclick=\"nextRound($this->ronda,'$this->total','$this->id_competencia')\" ></td>
                                    </tr>";
                        $equipos = $this->filtro("SELECT * FROM equipos_aleatorios WHERE id_competencia='$this->id_competencia'");
                        $registros =  $this->getNumRows();
                            while ($equipo = $this->proximo($equipos)) {
                                    $str .= "<tr>
                                                <td>$equipo[1]</td>
                                                <td> $this->ronda</td>
                                                <td><input type='number' size='5' min='1' max='99.999' step='01.001'  id='tiempof$i' required/></td>
                                                <td><input type='number' size='1' min='1' max='5' step='1'  id='becerrof$i' required/></td>
                                                <td>
                                                    <img src='../img/notes7.png' width='25' height='25' id='agregarf$i' title='Agregar'  onclick=\"agregarTE(".$i.",'$equipo[0]','$equipo[2]','$this->ronda')\" >
                                                </td>
                                            </tr>";
                                    $i++;                                       }
                        $str .= "</table>";
                        $this->cerrarConexion();
                        return ($registros > 0) ? $str :0;}     }

     public function finCompetencia(){
        
        $update = "UPDATE competencia SET sts='FC' WHERE id_competencia='$this->id_competencia'";
        $this->filtro($update);
        $this->cerrarConexion();
        return 1;                   }
        
    public function ranking(){
        $i = 1;
                $str = "
                        <table id='ranking'> 
                        
                            <tr>
                                <td>Posicion</td>
                                <td>Competidor</td>
                                <td>Tiempo</td>
                            </tr>";
                $r = $this->filtro("select * from ranking_barriles_poste WHERE id_competencia = '$this->id_competencia'");
                $rt =  $this->getNumRows();
                    while ($row = $this->proximo($r)) {
                            $str .= "<tr>
                                        <td>$i</td>
                                        <td >$row[0]</td>
                                        <td >$row[1]</td>
                                        </tr>";
                            $i++;                       }
                            $str .= "</table>";
        $this->cerrarConexion();
        return ($rt >0) ? $str :0;
        
    }
               
            }//Fin de la Clase

?>

