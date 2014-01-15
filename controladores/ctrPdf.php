<?php
require('../Pdf/fpdf.php');

class ctrPdf extends FPDF {

    function Header(){
        
        $this->Image('../img/caballos.jpg',10,10,35);
        $this->SetFont('Arial','B',16);
        $this->Cell(80);
        $this->Cell(30,10,utf8_decode('Fundacion Bolivar Western'),0,0,'C');
        $this->Ln(20);
        $this->Cell(80);
        $this->Cell(30,10,utf8_decode('Anthony Filgueira'),0,0,'C');
        $this->Ln(10);
        $this->SetFont('Arial','B',13);
       
        $fecha = date("d-m-Y");
        $this->Cell(0,20,utf8_decode('Fecha: ').$fecha.'',0,'C');
         $this->Ln(20);
    }
    function BasicTable($header){
        $this->Cell(40);
        foreach($header as $col){
           
            $this->Cell(37.5,7,$col,1,0,'C');
           
        }
    }
    function Footer(){
        $this->SetY(-40);
        $this->SetFont('Arial','B',12);
        $this->Cell(60);
        $this->Cell(30,10,utf8_decode('Direccion Edo Bolivar Puerto Ordaz'),0,'C');
        $this->Ln(4);
         $this->Cell(55);
        $this->Cell(30,10,utf8_decode('Telefono: 0424-9172244 / 0286-9224857'),0,'C');
        $this->Ln(4);
         $this->Cell(60);
        $this->Cell(30,10,utf8_decode('Correo: bolivarwestern@gmail.com'),0,'C');
        $this->Ln(4);
        
        $this->SetY(-15);
        $this->SetFont('Arial','B',8);
        $this->Cell(30,10,utf8_decode('Pagina ').$this->PageNo().'',0,0,'C');
    }
}
$header = array('Competidor','Vuelta','Tiempo');
$pdf = new ctrPdf();
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
$pdf->BasicTable($header);
$pdf->Output();
?>
