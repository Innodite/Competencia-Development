<?php
/*  Desarrollado por Innodite 
    RIF:  J-40270256-6
    Contacto
        Javier Urbano     0416-583.38.09
        Anthony Filgueira 0426-594.00.45
*/
if (isset($_POST['opc'])){
    
    $out = "";
    include("../modelos/clsInscripcion.php");
    $id_inscripcion   = isset($_POST['id']) ? $_POST['id'] : null;
    $clCedula  = isset($_POST['txtCedula']) ? $_POST['txtCedula'] : null;
    $clCompetencia  = isset($_POST['txtCompetencia']) ? $_POST['txtCompetencia'] : null;
    $nombre       = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $edad       = isset($_POST['edad']) ? $_POST['edad'] : null;
    $swper       = isset($_POST['swper']) ? $_POST['swper'] : null;
    
    $p = array("id"=>$id_inscripcion,"txtCedula"=>$clCedula,"txtCompetencia"=>$clCompetencia,"nombre"=>$nombre,"edad"=>$edad,"swper"=>$swper);
    $ob = new clsInscripcion($p);
    
    switch ($_POST['opc']) {
        case "BS": $out = $ob->listarTabla($p); break;
        case "CHK": $out = $ob->chkCi(); break;
        case "IN": $out = $ob->insertar($p); break;
        case "LST":  $out = $ob->getCompetencias($p); break;
        case "LS": $out = $ob->listarTabla();   break;
        case "DL":  $out = $ob->eliminar($p); break;
        default: break;
    }
    
    
    echo $out;
}else
    header("Location: ../index.php");

?>

