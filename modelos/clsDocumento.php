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
    $titulo = 'Listado General';
    $titulo2 = 'Ranking';
    $pdf->titulo($titulo, 20, 27);
    $pdf->BasicTable($header,30,45);
    if($modalidad == INDIVIDUAL){
       
    $sql = "SELECT nombre,tiempo,vuelta,salida,id_competencia
            FROM ranking rank,inscripcion insc,competidor compe 
            WHERE rank.id_inscripcion = insc.id_inscripcion 
            AND insc.cedula = compe.cedula AND insc.id_competencia=$comp"."ORDER BY 3,4";
    $datos = $bd->filtro($sql);
    $out = array();
        while($columna = $bd->proximo($datos)){
                     $out[] = array(
                         'nombre'=>$columna[0],
                         'tiempo'=>$columna[1],
                         'vuelta'=>$columna[2],
                         'salida'=>$columna[3]); 
                      
                }
     $bd->cerrarFiltro($datos);
    
    $contador =  $pdf->DinamicTable($out,30,65);
    $pdf->titulo($titulo2, 20, $contador-22);
  //$pdf->Cell(0,195,'numero de registros '.$contador.'',0,0,'C');
    $pdf->BasicTable($header2,50,$contador-3);
     $i = 1;
                
                $r = $bd->filtro("select * from ranking_barriles_poste WHERE id_competencia = '$comp'");
                 $out2 = array();
        while($columna2 = $bd->proximo($r)){
                     $out2[] = array(
                         'nombre'=>$columna2[0],
                         'tiempo'=>$columna2[1],
                         'vuelta'=>$columna2[2]); 
                      
                }
         $bd->cerrarFiltro($r);
         $bd->cerrarConexion();    
         $pdf->DinamicTable2($out2,50,$contador+4);
    }
     if($modalidad == GRUPO){
         
         
     }
 
    $pdf->AliasNbPages();
    $pdf->Output('exacto.pdf','I');
  
?>