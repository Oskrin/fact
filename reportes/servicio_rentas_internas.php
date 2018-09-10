<?php
    require('../fpdf/fpdf.php');
    include '../data/conexion.php';
    include '../procesos/funciones.php';
    conectarse();    
    date_default_timezone_set('America/Guayaquil'); 
    session_start();

    class PDF extends FPDF {   
        var $widths;
        var $aligns;

        function SetWidths($w) {            
            $this->widths=$w;
        }       

        function Header() {             
            $this->AddFont('Amble-Regular','','Amble-Regular.php');
            $this->SetFont('Amble-Regular','',10);        

        }
        //function Footer() {            
        //    $this->SetY(-15);            
        //    $this->SetFont('Arial','I',8);            
            //$this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'C');
        //}               
    }
    $pdf = new PDF('P','mm','a4');
    $pdf->AddPage();
    $pdf->SetMargins(10,0,0,0);        
    $pdf->AliasNbPages();
    $pdf->SetAutoPageBreak(true, 10);
    $pdf->AddFont('Amble-Regular','','Amble-Regular.php');
    $pdf->SetFont('Amble-Regular','',10);       
    
    $pdf->Rect(25, 25, 165, 40 , 'D');////3 INFO TRIBUTARIA
    $pdf->SetY(33);
    $pdf->SetX(85);
    $pdf->multiCell(180, 6, utf8_decode('SERVICIO RENTAS INTERNAS'),0 );//NOMBRE cliente 
    $pdf->Text(60, 45, utf8_decode('RUC: '));//ruc cliente
    $pdf->Text(42, 50, utf8_decode('RAZON SOCIAL: '));//ruc cliente
    $pdf->Text(48, 55, utf8_decode('IMPUESTOL: '));//ruc cliente
    $pdf->Text(40, 60, utf8_decode('PERIODO FISCAL: '));//ruc cliente

    $pdf->Rect(25, 65, 165, 10 , 'D');////3 INFO TRIBUTARIA
    $pdf->SetY(67);
    $pdf->SetX(25);
    $pdf->multiCell(130, 6, utf8_decode('CAMPO'),0 );//NOMBRE cliente 
    $pdf->Text(70, 71, utf8_decode('DESCRIPCIÓN'));//ruc cliente
    $pdf->Text(170, 71, utf8_decode('VALOR' ));//fecha de emision cliente

    $pdf->Rect(25, 75, 165, 10 , 'D');////3 INFO TRIBUTARIA
    $pdf->SetY(77);
    $pdf->SetX(25);
    $pdf->multiCell(130, 6, utf8_decode('31'),0 );//NOMBRE cliente 
    $pdf->Text(40, 81, utf8_decode('ORIGINAL-SUSTITUTUIVA'));//ruc cliente
    $pdf->Text(170, 81, utf8_decode('Original' ));//fecha de emision cliente

    $pdf->Rect(25, 85, 165, 10 , 'D');////3 INFO TRIBUTARIA
    $pdf->SetY(87);
    $pdf->SetX(25);
    $pdf->multiCell(130, 6, utf8_decode('102'),0 );//NOMBRE cliente 
    $pdf->Text(40, 91, utf8_decode('AÑO FISCAL'));//ruc cliente
    $pdf->Text(170, 91, utf8_decode('2016' ));//fecha de emision cliente

    $pdf->Rect(25, 95, 165, 10 , 'D');////3 INFO TRIBUTARIA
    $pdf->SetY(97);
    $pdf->SetX(25);
    $pdf->multiCell(130, 6, utf8_decode('201'),0 );//NOMBRE cliente 
    $pdf->Text(40, 101, utf8_decode('RUC'));//ruc cliente
    $pdf->Text(170, 101, utf8_decode('1002910345001' ));//fecha de emision cliente

    $pdf->Rect(25, 105, 165, 10 , 'D');////3 INFO TRIBUTARIA
    $pdf->SetY(107);
    $pdf->SetX(25);
    $pdf->multiCell(130, 6, utf8_decode('202'),0 );//NOMBRE cliente 
    $pdf->Text(40, 111, utf8_decode('RAZÓN O DENOMUNACIÓN SOCIAL'));//ruc cliente
    $pdf->Text(170, 111, utf8_decode('NELTEX' ));//fecha de emision cliente

    $pdf->Rect(25, 115, 165, 10 , 'D');////3 INFO TRIBUTARIA
    $pdf->SetY(117);
    $pdf->SetX(25);
    $pdf->multiCell(130, 6, utf8_decode('17'),0 );//NOMBRE cliente 
    $pdf->Text(40, 121, utf8_decode('Interrogante: Sujeto pasivo excento de aplicacion del regimen '));//ruc cliente
    $pdf->Text(170, 121, utf8_decode('2' ));//fecha de emision cliente

    $pdf->Rect(25, 125, 165, 10 , 'D');////3 INFO TRIBUTARIA
    $pdf->SetY(127);
    $pdf->SetX(25);
    $pdf->multiCell(130, 6, utf8_decode('496'),0 );//NOMBRE cliente 
    $pdf->Text(40, 131, utf8_decode('Activo por reinversion de utilidades'));//ruc cliente
    $pdf->Text(170, 131, utf8_decode('2' ));//fecha de emision cliente

    //$pdf->Rect(25, 135, 165, 10 , 'D');////3 INFO TRIBUTARIA
    //$pdf->SetY(137);
    //$pdf->SetX(25);
    //$pdf->multiCell(130, 6, utf8_decode('496'),0 );//NOMBRE cliente 
    //$pdf->Text(40, 141, utf8_decode('Activo por reinversion de utilidades'));//ruc cliente
    //$pdf->Text(170, 141, utf8_decode('2' ));//fecha de emision cliente

    //////////////////detalles /////////////
                                          
    $pdf->Output();
?>