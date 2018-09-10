<?php
    require('../fpdf/fpdf.php');
    include '../conexion.php';
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
            $fecha = date('Y-m-d', time());
            $this->SetX(1);
            $this->SetY(1);
            $this->Cell(20, 5, $fecha, 0,0, 'C', 0);                         
            $this->Cell(150, 5, "USUARIOS", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8, 'ECOMONTESTOUR', 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,30);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(180, 5, "PROPIETARIO: JORGE MONTESDEOCA",0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: (+593 2) 290 3629",0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: (+593) 98 462 0846",0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: Juan León Mera N24-91 & Mariscal Foch",0,1, 'C',0);                                
            $this->Cell(180, 5, "SLOGAN.: ",0,1, 'C',0);                                
            $this->Cell(180, 5, "ECUADOR",0,1, 'C',0);                                                                                        
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.5);
            $this->Line(1,43,210,43);
            $this->Ln(5);
            $this->SetX(1);
            $this->Cell(30, 5, utf8_decode("IDENTIFICACIÓN"),1,0, 'C',0);
            $this->Cell(45, 5, utf8_decode("NOMBRES"),1,0, 'C',0);
            $this->Cell(45, 5, utf8_decode("APELLIDOS"),1,0, 'C',0);        
            $this->Cell(22, 5, utf8_decode("TELÉFONO"),1,0, 'C',0);
            $this->Cell(65, 5, utf8_decode("DIRECCIÓN"),1,1, 'C',0);    
            // $this->Cell(17, 5, utf8_decode("IMAGEN"),1,1, 'C',0);   
        }
        function Footer() {            
            $this->SetY(-15);            
            $this->SetFont('Arial','I',8);            
            $this->Cell(0,10,'Pag. '.$this->PageNo().'/{nb}',0,0,'C');
        }               
    }
    $pdf = new PDF('P','mm','a4');
    $pdf->AddPage();
    $pdf->SetMargins(0,0,0,0);
    $pdf->AliasNbPages();
    $pdf->AddFont('Amble-Regular','','Amble-Regular.php');
    $pdf->SetFont('Amble-Regular','',10);       
    $pdf->SetFont('Arial','B',9);   
    $pdf->SetX(5);
    $sql = pg_query("SELECT * FROM usuarios order by id_usuario ");       
    $pdf->SetFont('Amble-Regular','',9);   
    $pdf->SetX(5);    
    while($row = pg_fetch_row($sql)) {                
        $pdf->SetX(1);                  
        $pdf->Cell(30, 5, utf8_decode($row[1]),0,0, 'L',0);
        $pdf->Cell(45, 5, utf8_decode($row[2]),0,0, 'L',0);
        $pdf->Cell(45, 5, utf8_decode($row[3]),0,0, 'L',0);        
        $pdf->Cell(22, 5, utf8_decode($row[5]),0,0, 'L',0);                         
        $pdf->Cell(65, 5, utf8_decode($row[7]),0,0, 'L',0); 
        // $pdf->Cell(17, 5, utf8_decode($row[6]),0,0, 'C',0);                        
        $pdf->Ln(5);        
    }    
                                                     
    $pdf->Output();
?>