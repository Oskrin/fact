<?php
    require('../fpdf/fpdf.php');
    require('../../../admin2/mysql.php');
    include_once('../../../admin2/funciones_generales.php');
    $class = new constante();

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
            $this->Cell(150, 5, "ESTABLECIMIENTOS MAS VISITADOS", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8, utf8_decode('Empresa Pública de Turismo'), 0,1, 'C',0);                                
            // $this->Image('logo_eptc.png',5,8,35,30);
            $this->SetFont('Amble-Regular','',10);        
            // $this->Cell(180, 5, "PROPIETARIO: JORGE MONTESDEOCA",0,1, 'C',0);                                
            // $this->Cell(80, 5, "TEL.: (+593 2) 290 3629",0,0, 'R',0);                                
            // $this->Cell(80, 5, "CEL.: (+593) 98 462 0846",0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: Cotacachi Mayormente cubierto Humedad: 100% Viento: ESE a 2 km/h",0,1, 'C',0);                                    
            $this->Cell(180, 5, "ECUADOR-COTACACHI",0,1, 'C',0);                                                                                        
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.5);
            $this->Line(1,43,210,43);
            $this->Ln(5);
            $this->SetX(1);
            $this->Cell(50, 5, utf8_decode("DESCRIPCIÓN"),1,0, 'C',0);
            $this->Cell(50, 5, utf8_decode("PROPIETARIO"),1,0, 'C',0);
            $this->Cell(50, 5, utf8_decode("DIRECCIÓN"),1,0, 'C',0);
            $this->Cell(30, 5, utf8_decode("CORREO"),1,0, 'C',0);
            $this->Cell(30, 5, utf8_decode("TOTAL VISITAS"),1,1, 'C',0);
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
    $resultado = $class->consulta("SELECT E.id, E.nombre, E.propietario, E.direccion, E.correo, COUNT(E.id) AS Total   FROM rutas_trazadas R , establecimientos E WHERE R.id_llegada = E.id AND R.fecha_creacion between '".$_GET['fecha_inicio']."' AND '".$_GET['fecha_fin']."' GROUP BY E.id, E.nombre, E.propietario, E.direccion, E.correo  ORDER BY COUNT(E.id) DESC");
    $pdf->SetFont('Amble-Regular','',9);   
    $pdf->SetX(5); 
    while ($row=$class->fetch_array($resultado)) {                  
        $pdf->SetX(1);                  
        $pdf->Cell(50, 5, maxCaracter(utf8_decode($row[1]),30),0,0, 'L',0);
        $pdf->Cell(50, 5, maxCaracter(utf8_decode($row[2]),30),0,0, 'L',0);
        $pdf->Cell(50, 5, maxCaracter(utf8_decode($row[3]),30),0,0, 'L',0);
        $pdf->Cell(30, 5, utf8_decode($row[4]),0,0, 'L',0);
        $pdf->Cell(30, 5, utf8_decode($row[5]),0,0, 'C',0);               
        $pdf->Ln(5);        
    }    
                                                     
    $pdf->Output();
?>