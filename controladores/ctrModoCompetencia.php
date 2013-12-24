<?php

if (isset($_POST['opc'])){
    
    $out = "";
    include ("../modelos/clsModoCompetencia.php");
    
    $name = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $id   = isset($_POST['id'])     ? $_POST['id']     : null;
    
    $p = array("nombre"=>$name,"id"=>$id);
    $ob = new clsModoCompetencia($name);
    
    switch ($_POST['opc']) {
        case "IN": $out = $ob->insertar();      break;
        case "UP": $out = $ob->modificar($p);   break;
        case "DL": $out = $ob->eliminar($p);    break;
        case "LS": $out = $ob->listarTabla();   break;
        case "BS": $out = $ob->listarTabla($p); break;
        default: break;
    }
    echo $out;
}else
    header("Location: ../index.php");
?>
