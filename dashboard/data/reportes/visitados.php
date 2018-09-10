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
            $this->Cell(150, 5, "SITIOS MAS VISITADOS ", 0,1, 'R', 0);      
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
            $this->Cell(20, 5, utf8_decode("ID"),1,0, 'C',0);
            $this->Cell(70, 5, utf8_decode("LUGAR"),1,0, 'C',0);
            $this->Cell(70, 5, utf8_decode("UBICACIÓN"),1,1, 'C',0);        
            // $this->Cell(45, 5, utf8_decode("IMAGEN"),1,1, 'C',0);   
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
    $sql = pg_query("SELECT R.id_punto, M.titulo, M.ubicacion, M.imagen, COUNT(R.id_punto) AS TotalVentas
            FROM registro R, MAPAS M where R.id_punto = M.id_punto
            GROUP BY R.id_punto, M.titulo, M.ubicacion, M.imagen
            ORDER BY COUNT(R.id_punto) DESC
            LIMIT 30");       
    $pdf->SetFont('Amble-Regular','',9);   
    $pdf->SetX(5);    
    while($row = pg_fetch_row($sql)) {                
        $pdf->SetX(1);                  
        $pdf->Cell(20, 5, utf8_decode($row[0]),0,0, 'L',0);
        $pdf->Cell(70, 5, utf8_decode($row[1]),0,0, 'L',0);
        $pdf->Cell(70, 5, utf8_decode($row[2]),0,0, 'L',0);   
        // $this->Image('../images/logo_empresa.jpg',5,8,35,30);     
        // $pdf->Cell(50, 5, utf8_decode("<img src=dsfadsf>".$row[3]),0,0, 'L',0);                        
        $pdf->Ln(5);        
    }    
                                                     
    $pdf->Output();
?>