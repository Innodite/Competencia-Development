<?php
 
 
 if (isset($_POST['opc'])){
    
    $out = "";
    include ("../modelos/clsReportes.php");
    
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
    $competencia = isset($_POST['competencia']) ? $_POST['competencia'] : null;
    
   $p = array("fecha"=>$fecha,"competencia"=>$competencia);
   $ob = new clsReportes($p);
     
    switch ($_POST['opc']) {
     
         case "BC": $out = $ob->buscarCompetencia(); break;
        default: break;
    }
    echo $out;
 }else
   header("Location: ../index.php");
 
 ?>
