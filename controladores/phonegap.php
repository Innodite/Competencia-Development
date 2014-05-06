<?php
$cars = array("Honde", "BMW", "Ferrari");

include ("../modelos/clsCompetencias.php");
$arreglo = array("id_competencia"=>1);

$competencia = new clsCompetencias($arreglo);





$choice =$_POST['button'];




if($choice == "cars"){
print json_encode($cars);}

else {
    $bikes = $competencia->ranking();
   print json_encode(array("rtable"=>$bikes));
}
 ?>

