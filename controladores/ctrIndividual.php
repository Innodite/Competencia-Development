<?php
if (isset($_POST['opc'])){
    
   include("../modelos/clsInscripcion.php");
   $id_inscripcion = $_POST['id'] !=""   ? $_POST['id']                    : 0;
   $cedula         = $_POST['cedula'] !=""   ? $_POST['cedula']            : 0;
   $nombre         = $_POST['nombre']     ? $_POST['nombre']               : null;
   $edad           = $_POST['edad']   !=""      ? $_POST['edad']           : 0;
   $competencia    = $_POST['competencia']!=""  ? $_POST['competencia']    : 0;
   $comp           = $_POST['comp']      !=""   ? $_POST['comp']           : 0;
   $nombreEquipo   = $_POST['nombreEquipo']     ? $_POST['nombreEquipo']   : null;
   $idEquipo       = $_POST['idEquipo']     ? $_POST['idEquipo']   : null;

   $competidor = array(
        'id_inscripcion'=>$id_inscripcion,
        'cedula'        =>$cedula,
        'nombre'        =>$nombre,
        'edad'          =>$edad,
        'competencia'   =>$competencia,
        'comp'          =>$comp,
        'nombreEquipo'  =>$nombreEquipo,
        'idEquipo'      =>$idEquipo);
    
   $ic = new clsInscripcion($competidor);
   
   
   switch ($_POST['opc']) {
      
       case "CHK"    :   $out= $ic->buscarCompetidor();         break;
       case "IC"     :   $out= $ic->inscribirCompetidor();      break;
       case "IE"     :   $out= $ic->inscribirEquipo();          break;
       case "LSTII"  :   $out= $ic->listarInscripcionesInd();   break;
       case "LSTIE"  :   $out= $ic->listarInscripcionesEquip(); break;
       case "DEL"    :   $out= $ic->eliminarInscripcion();      break;
       case "DELE"   :   $out= $ic->eliminarInscripcionEquip(); break;
       case "LSTE"   :   $out= $ic->listarEquipo();             break;
       case "LSTCE"  :   $out= $ic->listarCompetenciaEquip();   break;
       case "LSTCI"  :   $out= $ic->listarCompetenciaInd();     break;
       default: break;
    }
    
    echo json_encode($out);
}else{
        header("Location: ../index.php");

}




?>
