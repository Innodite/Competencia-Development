<?php
/*Desarrollado por www.innodite.com
    RIF:  J-40270256-6
    Contacto
        Javier Urbano     0416-583.38.09
        Anthony Filgueira 0426-594.00.45
*/
if (isset($_POST['opc'])){
    sleep(1);
    $out = "";
    include ("../modelos/clsCategoria.php");
    
    $nombre     = isset($_POST['nombre'])       ? $_POST['nombre']      : null;
    $edadMin    = isset($_POST['edadMin'])      ? $_POST['edadMin']     : null;
    $edadMax    = isset($_POST['edadMax'])      ? $_POST['edadMax']     : null;
    $id         = isset($_POST['id'])           ? $_POST['id']          : null;
    $operacion  = isset($_POST['opc'])          ? $_POST['opc']         : null;
    
    $arreglo = array("nombre"=>$nombre,"edadMin"=>$edadMin,"edadMax"=>$edadMax, "operacion"=>$operacion, "id"=>$id);
    $categoria  = new clsCategoria($arreglo);
    
    switch ($_POST['opc']) {
        case "IC": $out = $categoria->insertarCategoria();          break;
        case "AC": $out = $categoria->actualizarCategoria();        break;
        case "EC": $out = $categoria->eliminarCategoria();          break;
        case "LS": $out = $categoria->listarTabla();                break;
        case "BS": $out = $categoria->listarTabla($p);              break;
        default: break;
    }
    echo $out;
}else
    header("Location: ../index.php");

?>