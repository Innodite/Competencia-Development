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
    $header2 = array('Competidor','Tiempo','Posicion');   
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
    $pdf->titulo('Ranking'.$cont, 20, $contador-22);
    $pdf->BasicTable($header2,50,$contador-3);
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
         
          list($cont2,$contador2) = $pdf->DinamicTable2($out2,50,$contador+4,$cont);
        //Primera Division
         $pdf->titulo('Primera Division'.$cont2, 20, $contador2-10);
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
        //Segunda Division/*
         $pdf->titulo('Segunda Division'.$cont3, 20, $contador3-10);
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
         $bd->cerrarConexion();    
        list($cont4,$contador4) = $pdf->DinamicTable2($out4,50,$contador3+15,$cont3);
    }
     if($modalidad == GRUPO){
         
         
     }
 
    $pdf->AliasNbPages();
    $pdf->Output('exacto.pdf','I');
  
?>