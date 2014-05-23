<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'clsConexion.php';
include './clsUtils.php';
include '../controladores/ctrPdf.php';

$comp      = isset($_GET['comp'])      ? $_GET['comp']      : "";
$fecha     = isset($_GET['fecha'])     ? $_GET['fecha']     : "";
$nombre    = isset($_GET['nombre'])    ? $_GET['nombre']    : "";
$modalidad = isset($_GET['modalidad']) ? $_GET['modalidad'] : "";


    $bd = new clsConexion();
    $header = ($modalidad == 'INDIVIDUAL') ? array('Competidor','Tiempo','Vuelta','Salida')
                                      : array('Equipo','Tiempo','Becerros','Vuelta','Salida');
    $header2 = ($modalidad == 'INDIVIDUAL') ? array('Competidor','Tiempo','Posicion')
                                      : array('Competidor','Tiempo','Becerros', 'Posicion');
    $pdf = new ctrPdf();
    $pdf->modalidad = ucfirst(strtolower($modalidad));
    $pdf->fecha      = clsUtils::setFormatFecha($fecha);
    $pdf->nombre     = $nombre;
    $pdf->SetFont('Arial','',10);
    $pdf->AddPage();
    
    $pdf->titulo('Listado General', 20, 27);
    $pdf->BasicTable($header,30,45);
    if($modalidad == INDIVIDUAL){
        
    //Listado General 
    $sql = "SELECT nombre,tiempo,vuelta,salida,id_competencia
            FROM ranking rank,inscripcion insc,competidor compe 
            WHERE rank.id_inscripcion = insc.id_inscripcion 
            AND insc.cedula = compe.cedula AND insc.id_competencia=$comp"."ORDER BY 3,4";
    $datos = $bd->filtro($sql);
    $out = array();
    $registro =$bd->getNumRows();
        while($columna = $bd->proximo($datos)){
                     $out[] = array(
                         'nombre'=>$columna[0],
                         'tiempo'=>$columna[1],
                         'vuelta'=>$columna[2],
                         'salida'=>$columna[3]); 
                      
                }
     $bd->cerrarFiltro($datos);
     
     list($cont,$contador)= $pdf->DinamicTable($out,30,65,0);
     
    //Ranking
    $pdf->titulo('Ranking', 20, $contador-17);
    $pdf->BasicTable($header2,50,$contador+2);
    $i = 1;
                
                $datos2 = $bd->filtro("select * from ranking_barriles_poste WHERE id_competencia = '$comp'");
                 $out2 = array();
        while($columna2 = $bd->proximo($datos2)){
                     $out2[] = array(
                         'nombre'=>$columna2[0],
                         'tiempo'=>$columna2[1],
                         'posicion'=>$i); 
                       $i++; 
                }
         $bd->cerrarFiltro($datos2);
         
          list($cont2,$contador2) = $pdf->DinamicTable2($out2,50,$contador+9,$cont);
        //Primera Division
         $pdf->titulo('Primera Division', 20, $contador2-10);
         $pdf->BasicTable($header2,50,$contador2+8);
         $j = 1;
         $datos3 = $bd->filtro("select * from primera_division WHERE id_competencia = '$comp'");
         $out3 = array();
            while($columna3 = $bd->proximo($datos3)){
                     $out3[] = array(
                         'nombre'=>$columna3[0],
                         'tiempo'=>$columna3[1],
                         'posicion'=>$j); 
                       $j++; 
                }
         $bd->cerrarFiltro($datos3);
          
         list($cont3,$contador3) = $pdf->DinamicTable2($out3,50,$contador2+15,$cont2);
        //Segunda Division
         $pdf->titulo('Segunda Division', 20, $contador3-10);
         $pdf->BasicTable($header2,50,$contador3+8);
         $q = 1;
         $datos4 = $bd->filtro("select * from segunda_division WHERE id_competencia = '$comp'");
         $out4 = array();
            while($columna4 = $bd->proximo($datos4)){
                     $out4[] = array(
                         'nombre'=>$columna4[0],
                         'tiempo'=>$columna4[1],
                         'posicion'=>$q); 
                       $q++; 
                }
         $bd->cerrarFiltro($datos4);
           
        list($cont4,$contador4) = $pdf->DinamicTable2($out4,50,$contador3+15,$cont3);
        //tercera division
        $pdf->titulo('Tercera Division', 20, $contador4-10);
         $pdf->BasicTable($header2,50,$contador4+8);
         $q = 1;
         $datos5 = $bd->filtro("select * from tercera_division WHERE id_competencia = '$comp'");
         $out5 = array();
            while($columna5 = $bd->proximo($datos5)){
                     $out5[] = array(
                         'nombre'=>$columna5[0],
                         'tiempo'=>$columna5[1],
                         'posicion'=>$q); 
                       $q++; 
                }
         $bd->cerrarFiltro($datos5);
           
        list($cont5,$contador5) = $pdf->DinamicTable2($out5,50,$contador4+15,$cont4);
        //No Clasificados
        $pdf->titulo('No Clasificados', 20, $contador5-10);
         $pdf->BasicTable($header2,50,$contador5+8);
         $f = 1;
         $datos6 = $bd->filtro("select * from no_clasificados WHERE id_competencia = '$comp'");
         $out6 = array();
            while($columna6 = $bd->proximo($datos6)){
                     $out6[] = array(
                         'nombre'=>$columna6[0],
                         'tiempo'=>$columna6[1],
                         'posicion'=>$f); 
                       $f++; 
                }
         $bd->cerrarFiltro($datos6);
         $bd->cerrarConexion();    
        list($cont6,$contador6) = $pdf->DinamicTable2($out6,50,$contador5+15,$cont5);
    }
     if($modalidad == GRUPO){
         
         //Listado General 
    $sql = "select eq.nombre,tiempo,becerro,vuelta,salida from ranking rank,inscripcion insc,equipo eq
where rank.id_inscripcion = insc.id_inscripcion 
AND insc.id_equipo = eq.id_equipo ORDER BY 4,5";
    $datos = $bd->filtro($sql);
    $out = array();
    $registro =$bd->getNumRows();
        while($columna = $bd->proximo($datos)){
                     $out[] = array(
                         'nombre'=>$columna[0],
                         'tiempo'=>$columna[1],
                         'becerro'=>$columna[2],
                         'vuelta'=>$columna[3],
                         'salida'=>$columna[4]); 
                      
                }
     $bd->cerrarFiltro($datos);
     
     list($cont,$contador)= $pdf->DinamicTable($out,30,65,0);
     
     //Ranking
    $pdf->titulo('Ranking', 20, $contador-17);
    $pdf->BasicTable($header2,50,$contador+2);
    $i = 1;
                
                $datos2 = $bd->filtro("select * from ranking_encierro WHERE id_competencia = '$comp'");
                 $out2 = array();
        while($columna2 = $bd->proximo($datos2)){
                     $out2[] = array(
                         'nombre'=>$columna2[0],
                         'tiempo'=>$columna2[1],
                         'becerro'=>$columna2[3],
                         'posicion'=>$i); 
                       $i++; 
                }
         $bd->cerrarFiltro($datos2);
         
          list($cont2,$contador2) = $pdf->DinamicTable2($out2,50,$contador+9,$cont);
     }
 
    $pdf->AliasNbPages();
    $pdf->Output('exacto.pdf','I');
  
?>