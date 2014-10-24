<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['opc'])){
    
    $out = "";
    include("../modelos/clsResultado.php");
    $id_competencia   = isset($_POST['id']) ? $_POST['id'] : null;
   
    
    $p = array("id"=>$id_competencia);
    $ob = new clsResultado(array("id"=>5));
    
    switch ($_POST['opc']) {
        case "MR": $out = $ob->listarResultados(); break;
        default: break;
    }
    
    
    echo json_encode($out);
}else
    header("Location: ../index.php");

?>