<?php
if (isset($_POST['opc'])){
    
   include("../modelos/clsInscripcion.php");
    $cedula = $_POST['cedula']? $_POST['cedula'] : null;
    $nombre = $_POST['nombre']? $_POST['nombre'] : null;
    $edad = $_POST['edad']? $_POST['edad'] : null;
    $competencia = $_POST['competencia']? $_POST['competencia'] : null;
    $comp       = isset($_POST['comp']) ? $_POST['comp'] : null;

    $competidor = array('cedula'=>$cedula,'nombre'=>$nombre,'edad'=>$edad,'competencia'=>$competencia,'comp'=>$comp);
    $ic = new clsInscripcion($competidor);
   
   
   switch ($_POST['opc']) {
      
       case "CHK"   :   $out= $ic->buscarCompetidor();      break;
       case "LSTCI"  :  $out= $ic->listarCompetenciaInd();     break;
       case "IC"    :   $out= $ic->inscribirCompetidor();   break;
       default: break;
    }
    
    echo json_encode($out);
}else{
        header("Location: ../index.php");

}




?>
