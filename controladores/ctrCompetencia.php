<?php
/* Desarrollado por www.innodite.com
    RIF:  J-40270256-6
    Contacto
        Javier Urbano     0416-583.38.09
        Anthony Filgueira 0426-594.00.45
  */

if (isset($_POST['opc'])){
    
    $out = "";
    include ("../modelos/clsCompetencia.php");
    
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
    $tip_comp = isset($_POST['tip_comp']) ? $_POST['tip_comp'] : null;
    $porcp = isset($_POST['porcp']) ? $_POST['porcp'] : null;
    $porcc = isset($_POST['porcc']) ? $_POST['porcc'] : null;
   $inscripcion = isset($_POST['inscripcion']) ? $_POST['inscripcion'] : null;
    $rondas = isset($_POST['rondas']) ? $_POST['rondas'] : null;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    
    $p = array("fecha"=>$fecha,"tip_comp"=>$tip_comp,"porcp"=>$porcp,"porcc"=>$porcc,"rondas"=>$rondas,"inscripcion"=>$inscripcion,"categoria"=>$categoria, "id"=>$id);
    $ob = new clsCompetencia($p);
    
    switch ($_POST['opc']) {
        case "IN": $out = $ob->insertar(); break;
        case "UP": $out = $ob->modificar($p); break;
        case "DL": $out = $ob->eliminar($p); break;
        case "LS": $out = $ob->listarTabla(); break;
        case "BS": $out = $ob->listarTabla($p); break;
        case "LST": $out = $ob->getCompetencias(); break;
        case "LSC": $out = $ob->getCategorias(); break;
        default: break;
    }
    echo $out;
}else
    header("Location: ../index.php");
?>