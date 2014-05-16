<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'clsConexion.php';
include '../controladores/ctrPdf.php';
$comp = $_GET['comp'];


    $bd = new clsConexion();
    $heade = array('jose','1','2.134');
    $header = array('Competidor','Vuelta','Tiempo');
    $pdf = new ctrPdf();
    $pdf->SetFont('Arial','',10);
    $pdf->AddPage();
    $pdf->BasicTable($header);
    $sql = "select * from  ranking_barriles_poste WHERE id_competencia="."$comp";
    $datos = $bd->filtro($sql);
    $out = array();
        while($columna = $bd->proximo($datos)){
                     $out[] = array(
                         'id_inscripcion'=>$columna[0],
                         'cedula'=>$columna[1],
                         'nombre'=>$columna[2]); 
                      
                }
                $bd->cerrarFiltro($datos);
		$bd->cerrarConexion();
    $pdf->DinamicTable($out);
    $pdf->Output('exacto.pdf','I');
  
?>