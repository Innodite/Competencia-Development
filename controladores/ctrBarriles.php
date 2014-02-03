<?php
 
 
 if (isset($_POST['opc'])){
    
    $out = "";
    include ("../modelos/clsBarriles.php");
    
     $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
     $competencia = isset($_POST['competencia']) ? $_POST['competencia'] : null;
     $id_inscripcion = isset($_POST['id_inscripcion']) ? $_POST['id_inscripcion'] : null;
     $tiempo = isset($_POST['tiempo']) ? $_POST['tiempo'] : null;
     $ronda = isset($_POST['ronda']) ? $_POST['ronda'] : null;
     $total = isset($_POST['total']) ? $_POST['total'] : null;
     $salida = isset($_POST['salida']) ? $_POST['salida'] : null;
   $p = array("fecha"=>$fecha,"competencia"=>$competencia,"id_inscripcion"=>$id_inscripcion, "tiempo"=>$tiempo,"ronda"=>$ronda,"total"=>$total,"salida"=>$salida);
   $ob = new clsBarriles($p);
     
    switch ($_POST['opc']) {
         case "BC": $out = $ob->cargarCompetencia(); break;
         case "IC": $out = $ob->iniciarCompetencia(); break;
         case "AT": $out = $ob->agregarTiempo(); break;
         case "NR": $out = $ob->nextRound(); break;
         case "RG": $out = $ob->rankGeneral(); break;
         case "FC": $out = $ob->finCompetencia(); break;
        default: break;
    }
    echo $out;
 }else
   header("Location: ../index.php");
 
 ?>