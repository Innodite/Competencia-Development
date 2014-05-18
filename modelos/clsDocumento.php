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
    $pdf = new ctrPdf();
    $pdf->modalidad = ucfirst(strtolower($modalidad));
    $pdf->fecha      = clsUtils::setFormatFecha($fecha);
    $pdf->nombre     = $nombre;
    $pdf->SetFont('Arial','',10);
    $pdf->AddPage();
    $pdf->BasicTable($header);
    
    $sql = "SELECT nombre,tiempo,vuelta,salida,id_competencia
            FROM ranking rank,inscripcion insc,competidor compe 
            WHERE rank.id_inscripcion = insc.id_inscripcion 
            AND insc.cedula = compe.cedula AND insc.id_competencia=$comp";
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
		$bd->cerrarConexion();
    $pdf->DinamicTable($out);
    $pdf->Output('exacto.pdf','I');
  
?>