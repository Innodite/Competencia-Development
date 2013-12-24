<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['opc'])){
    
    $out = "";
    include ("../modelos/clsGCompetencia.php");
    
    $desde   = isset($_POST['desde']) ? $_POST['desde'] : null;
    $hasta    = isset($_POST['hasta']) ? $_POST['hasta'] : null;
    $categ    = isset($_POST['categoria']) ? $_POST['categoria'] : null;
    $vuelta   = isset($_POST['vuelta']) ? $_POST['vuelta'] : null;
    $ronda    = isset($_POST['ronda']) ? $_POST['ronda'] : null;
    $time     = isset($_POST['time']) ? $_POST['time'] : null;
    $comp     = isset($_POST['competencia']) ? $_POST['competencia'] : null;
    $id    = isset($_POST['id']) ? $_POST['id'] : null;
    
    $p = array("desde"=>$desde,"hasta"=>$hasta,"categoria"=>$categ,"vuelta"=>$vuelta,"ronda"=>$ronda,"time"=>$time,"competencia"=>$comp,"id"=>$id);
    $ob = new clsGCompetencia($p);
    
    switch ($_POST['opc']) {
        case "ST": $out = $ob->setTime($p);            break;
        case "BSC": $out = $ob->getLsCompetencias($p); break;
        case "LSI": $out = $ob->getInscripciones(); break;
        default: break;
    }
    echo $out;
}else
    header("Location: ../index.php");
?>
