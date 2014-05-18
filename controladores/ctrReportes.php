<?php
/*
    Desarrollado por Innodite 
    RIF:  J-40270256-6
    Contacto
        Javier Urbano     0416-583.38.09
        Anthony Filgueira 0426-594.00.45
*/ 
 
 if (isset($_POST['opc'])){
    
    $out = "";
    include ("../modelos/clsReportes.php");
    $opcion = isset($_POST['opc']) ? $_POST['opc'] : null;
    $fecha1 = isset($_POST['fecha1']) ? $_POST['fecha1'] : null;
    $fecha2 = isset($_POST['fecha2']) ? $_POST['fecha2'] : null;
    $sts = isset($_POST['sts']) ? $_POST['sts'] : null;
    $tcomp = isset($_POST['tcomp']) ? $_POST['tcomp'] : null;
    $competencia = isset($_POST['competencia']) ? $_POST['competencia'] : null;
    
   $p = array("fecha1"=>$fecha1,"fecha2"=>$fecha2,"competencia"=>$competencia,"sts"=>$sts,"tcomp"=>$tcomp,"opcion"=>$opcion);
   $ob = new clsReportes($p);
     
    switch ($_POST['opc']) {
         case "BC": $out = $ob->buscarCompetencia(); break;
        default: break;
    }
    
    echo $out;
  
 }else
   header("Location: ../index.php");
 
 ?>
