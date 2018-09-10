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
            $fecha = date('Y-m-d', time());
            $this->SetX(1);
            $this->SetY(1);
            $this->Cell(20, 5, $fecha, 0,0, 'C', 0);                         
            $this->Cell(150, 5, "CLIENTES DEUDORES", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8, $_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,30);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(180, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                        
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.5);
            $this->Line(1,43,210,43);
            $this->Ln(5);
            $this->SetX(1);
            $this->Cell(30, 5, utf8_decode("C:I."),1,0, 'C',0);
            $this->Cell(95, 5, utf8_decode("Nombres Completos"),1,0, 'C',0);
            $this->Cell(30, 5, utf8_decode("Teléfono"),1,0, 'C',0);        
            $this->Cell(30, 5, utf8_decode("Saldo"),1,1, 'C',0);     
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
    $sql = pg_query("SELECT * FROM detalle_pagos_venta WHERE CAST(fecha_pagos AS DATE) < now() AND estado = 'Activo'; ");
    while($row = pg_fetch_row($sql)) {
        $id_pagos_venta = $row[1];
        $cuota = $row[3];

        $sql2 = pg_query("SELECT id_factura_venta FROM pagos_venta WHERE id_pagos_venta = '$id_pagos_venta'");
        while($row2 = pg_fetch_row($sql2)) {
            $id_factura_venta = $row2[0];

            $sql3 = pg_query("SELECT id_cliente FROM factura_venta WHERE id_factura_venta = '$id_factura_venta'");
            while($row3 = pg_fetch_row($sql3)) {
                $id_cliente = $row3[0];

                $sql4 = pg_query("SELECT identificacion, nombres_completos, telefono2, direccion FROM cliente WHERE id_cliente ='$id_cliente'");
                $pdf->SetFont('Amble-Regular','',9);
                $pdf->SetX(5);
                while($row4 = pg_fetch_row($sql4)) {
                    $pdf->SetX(1);
                    $identificacion = $row4[0];
                    $nombres_completos = $row4[1];
                    $telefono2 = $row4[2];
                    $direccion = $row4[3];

                    $pdf->Cell(30, 5, utf8_decode($identificacion),0,0, 'L',0);
                    $pdf->Cell(95, 5, maxCaracter(utf8_decode($nombres_completos),50),0,0, 'L',0);
                    $pdf->Cell(30, 5, utf8_decode($telefono2),0,0, 'C',0);                        
                    $pdf->Cell(20, 5, utf8_decode($cuota),0,0, 'C',0);                         
                    $pdf->Ln(5);  
                } 
            } 
        }    
    }
                                              
    $pdf->Output();
?>