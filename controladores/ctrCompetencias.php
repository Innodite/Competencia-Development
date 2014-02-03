<?php
 
 
 if (isset($_POST['opc'])){
    
   
    include ("../modelos/clsCompetencias.php");
    
     $fecha =          isset($_POST['fecha'])           ? $_POST['fecha']           : null;
     $modalidad =      isset($_POST['modalidad'])       ? $_POST['modalidad']       : null;
     $id_competencia = isset($_POST['id_competencia'])  ? $_POST['id_competencia']  : null;
     $id_inscripcion = isset($_POST['id_inscripcion'])  ? $_POST['id_inscripcion']  : null;
     $tiempo =         isset($_POST['tiempo'])          ? $_POST['tiempo']          : null;
     $ronda =          isset($_POST['ronda'])           ? $_POST['ronda']           : null;
     $total =          isset($_POST['total'])           ? $_POST['total']           : null;
     $salida =         isset($_POST['salida'])          ? $_POST['salida']          : null;
     $becerros =       isset($_POST['becerros'])        ? $_POST['becerros']        : null;
    
      
     $arreglo = array("fecha"=>$fecha,"modalidad"=>$modalidad,"id_competencia"=>$id_competencia,"id_inscripcion"=>$id_inscripcion, "tiempo"=>$tiempo,"ronda"=>$ronda,"total"=>$total,"salida"=>$salida,"becerros"=>$becerros);
     $competencia = new clsCompetencias($arreglo);
     
     if($modalidad=='individual'){
            switch ($_POST['opc']) {
                    case "BC": $out = $competencia->cargarCompetencia(); break;
                    case "IC": $out = $competencia->iniciarCompetencia(); break;
                    case "AT": $out = $competencia->agregarTiempo(); break;
                    case "NR": $out = $competencia->nextRound(); break;
                    case "PD": $out = $competencia->primeraDivision(); break;
                    case "SD": $out = $competencia->segundaDivision(); break;
                    case "TD": $out = $competencia->terceraDivision(); break;
                    case "FC": $out = $competencia->finCompetencia(); break;
                    default: break;
                                    }
            echo $out;
                                }
     if($modalidad=='grupo'){
         switch ($_POST['opc']) {
                case "BC": $out = $competencia->cargarCompetencia();  break;
                case "IC": $out = $competencia->iniciarCompetencia(); break;
                case "AT": $out = $competencia->agregarTE(); break;
                case "NR": $out = $competencia->nextRoundE(); break;
                default: break;
                                }
        echo $out;
        }
    
           
   
 }else
   header("Location: ../index.php");
 
 ?>