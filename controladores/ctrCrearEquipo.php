<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['opc'])){
    $out = "";
    include ("../modelos/clsCrearEquipo.php");
    
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $cedu = isset($_POST['cedula']) ? $_POST['cedula'] : null;
    $comp = isset($_POST['competidor']) ? $_POST['competidor'] : null;
    $edad = isset($_POST['edad']) ? $_POST['edad'] : null;
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    
    $p = array("nombre"=>$name, "cedula"=> $cedu, "competidor"=>$comp, "edad"=> $edad, "id"=>$id);
    $ob = new clsCrearEquipo($p);
    
    switch ($_POST['opc']){
        case 'BSE': $out = $ob->buscaEquipo(); break;
        case 'IN':  $out = $ob->insertar();    break;
        case 'DL':  $out = $ob->eliminar();    break;
        default: break;
    }
    echo $out;
}else
    header("Location: ../index.php");

?>
