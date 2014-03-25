<?php
if (isset($_POST['opc'])){
    
   include("../modelos/clsInscripcion.php");
   $id_inscripcion = $_POST['id'] !=""   ? $_POST['id']         : 0;
   $cedula         = $_POST['cedula'] !=""   ? $_POST['cedula']         : 0;
   $nombre         = $_POST['nombre']     ? $_POST['nombre']            : null;
   $edad           = $_POST['edad']   !=""      ? $_POST['edad']        : 0;
   $competencia    = $_POST['competencia']!=""  ? $_POST['competencia'] : 0;
   $comp           = $_POST['comp']      !=""   ? $_POST['comp']        : 0;

   $competidor = array(
        'id_inscripcion'=>$id_inscripcion,
        'cedula'        =>$cedula,
        'nombre'        =>$nombre,
        'edad'          =>$edad,
        'competencia'   =>$competencia,
        'comp'          =>$comp   );
    
   $ic = new clsInscripcion($competidor);
   
   
   switch ($_POST['opc']) {
      
       case "CHK"    :   $out= $ic->buscarCompetidor();         break;
       case "LSTCI"  :   $out= $ic->listarCompetenciaInd();     break;
       case "IC"     :   $out= $ic->inscribirCompetidor();      break;
       case "LSTII"  :   $out= $ic->listarInscripcionesInd();   break;
       case "DEL"    :   $out= $ic->eliminarInscripcion();      break;
       default: break;
    }
    
    echo json_encode($out);
}else{
        header("Location: ../index.php");

}




?>
