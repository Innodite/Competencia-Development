<?php
session_start();
require('../Pdf/fpdf.php');

class ctrPdf extends FPDF {
    
    public $nameReport = "Resultado Competencia";
    public $modalidad;
    public $fecha;
    public $nombre;
            

    function Header(){
        
        $user = isset($_SESSION['username']) ? $_SESSION['username'] : "";
        
        $this->Image('../img/weinsys-small.png',10,10,35);
        $this->SetFont('Arial','B',16);
        $this->Cell(80);
        $this->Cell(30,15,utf8_decode('Western Intelligent System Venezuela'),0,0,'C');
        
        $this->SetFont('Arial','B',8);
        $this->SetX(-45);
        $this->Cell(0,10,date("d-m-Y"),0,'R');
        
        $this->SetX(-45);
        $this->Cell(0,20,"User: $user",0,'R');
        $this->SetFont('Arial','B',12);
        $this->SetX(72);
        $this->Cell(0,30,"$this->nameReport $this->modalidad",0,'C');
        $this->Ln(20);
        $this->Cell(80);
        $this->Cell(30,10,utf8_decode($this->nombre." - ".$this->fecha),0,0,'C');
        $this->Ln(15);
        $this->SetFont('Arial','B',13); 
         
    }
    function titulo($texto,$x,$y,$cont){
        $this->SetXY($x,$y);
        $this->SetFont('Arial','B',13); 
        $this->Cell(0,30,utf8_decode($texto),0,0,'C');
        
    }
    
    function BasicTable($header,$x,$y){
        $this->SetXY($x,$y);
         $this->SetFont('Arial','',13); 
        $this->SetFillColor(176, 167, 167);
        foreach($header as $col){
            $this->Cell($this->modalidad =='Grupo' ? 25 : 37.5,7,$col,1,0,'C',true);
        }
        $this->Ln();
    }
    
    function DinamicTable($header,$x,$y,$cont){
    
        $this->SetXY($x,$y-13);
 
        foreach($header as $col){
           
            foreach ($col as $col2){ 
            $this->Cell($this->modalidad =='Grupo' ? 25 : 37.5,7,$col2,1,0,'C');
            
            }
            $this->SetXY($x,$y-6);
           $y = $y+7;
           $cont++;
           if($cont==22){
        $this->AddPage();
        $cont=0;
        $y=50;
        $this->SetXY(50,50);
           }
        }
         
        
            return array ($cont,$y);
        
    }
    function DinamicTable2($header,$x,$y,$cont){
       
        $this->SetXY($x,$y);
     
       
        foreach($header as $col){
            
            foreach ($col as $col2){
            $this->Cell($this->modalidad =='Grupo' ? 25 : 37.5,7,$col2,1,0,'C');
            }
           
            $this->Ln();
              //$this->Cell(20);
            $this->SetXY($x,$y+7);
           $y = $y+7;
           $cont++;
           if($cont==22){
        $this->AddPage();
        $cont=0;
        $y=50;
        $this->SetXY(50,50);
           }
        }
       
            return array ($cont,$y);
        
    }
    
    
    function Footer(){
        $this->SetY(-20);
        $this->SetFont('Arial','B',7);
        $this->Cell(20);
        $this->Cell(30,10,utf8_decode('Dirección: Edo-Bolívar Puerto Ordaz | Teléfono: 0424-9172244 / 0286-9224857 | Correo: bolivarwestern@gmail.com'),0,'C');
        $this->SetY(-15); 
        $this->SetFont('Arial','B',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
       
    }
    
}
 

?>
