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
            $this->Cell(150, 5, "FACTURAS ANULADAS", 0,1, 'R', 0);      
            $this->SetFont('Arial','B',16);                                                    
            $this->Cell(190, 8,$_SESSION['empresa'], 0,1, 'C',0);                                
            $this->Image('../images/logo_empresa.jpg',5,8,35,28);
            $this->SetFont('Amble-Regular','',10);        
            $this->Cell(180, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
            $this->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
            $this->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
            $this->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
            $this->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
            $this->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);                                                                                                    
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(0.4);            
            $this->Line(1,50,210,50);            
            $this->SetFont('Arial','B',12);                                                                
            $this->Cell(90, 5, utf8_decode($_GET['inicio']),0,0, 'R',0);                                                                                        
            $this->Cell(40, 5, utf8_decode($_GET['fin']),0,1, 'C',0);                                                                                                    
            $this->Cell(190, 5, utf8_decode("RESUMEN DE FACTURAS ANULADAS"),0,1, 'C',0);                                                                                                                            
            $this->SetFont('Amble-Regular','',10);        
            $this->Ln(3);
            $this->SetFillColor(255,255,225);            
            $this->SetLineWidth(0.2);                                        
        }
        
        function Footer(){            
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
    $pdf->SetFont('Amble-Regular','',9); 
    $total=0;
    $sub=0;
    $desc=0;
    $ivaT=0;
    $t0 = 0;
    $pdf->SetX(1); 
    $pdf->Cell(22, 6, utf8_decode('Comprobante'),1,0, 'C',0);                                     
    $pdf->Cell(20, 6, utf8_decode('Fecha'),1,0, 'C',0);                                     
    $pdf->Cell(26, 6, utf8_decode('Nro Factura'),1,0, 'C',0);                                     
    $pdf->Cell(15, 6, utf8_decode('Subtotal'),1,0, 'C',0);                                     
    $pdf->Cell(17, 6, utf8_decode('Descuento'),1,0, 'C',0);                                     
    $pdf->Cell(16, 6, utf8_decode('Tarifa 0%'),1,0, 'C',0);                                     
    $pdf->Cell(17, 6, utf8_decode('Tarifa 12%'),1,0, 'C',0);                                     
    $pdf->Cell(15, 6, utf8_decode('Iva 12%'),1,0, 'C',0);                                     
    $pdf->Cell(15, 6, utf8_decode('Total'),1,0, 'C',0);                                     
    $pdf->Cell(25, 6, utf8_decode('Fecha Anulación'),1,0, 'C',0);                                     
    $pdf->Cell(20, 6, utf8_decode('Tipo Pago'),1,1, 'C',0);                                                                  
    $consulta=pg_query('select * from cliente order by id_cliente asc');
    while($row=pg_fetch_row($consulta)){        
        $consulta1=pg_query("select F.numero_serie,F.fecha_actual,F.hora_actual,F.fecha_anulacion,F.tipo_precio,F.id_forma_pago,F.tarifa0,F.tarifa12,F.iva,F.descuento,F.total,C.identificacion,C.nombres_completos, F.id_factura_venta from factura_venta F, cliente C, usuario U where F.id_cliente=C.id_cliente and U.id_usuario=F.id_usuario and F.id_cliente='$row[0]' and fecha_anulacion between '$_GET[inicio]' and '$_GET[fin]' and F.estado='Pasivo'order by F.id_factura_venta asc");        
        while($row1=pg_fetch_row($consulta1)){                                     
            $pdf->SetX(1); 
            $pdf->Cell(22, 6, utf8_decode($row1[14]),0,0, 'C',0);                                     
            $pdf->Cell(20, 6, utf8_decode($row1[1]),0,0, 'C',0);                    
            $pdf->Cell(26, 6, utf8_decode(substr($row1[0],8)),0,0, 'C',0);                                
            $sub=$sub+($row1[10]-$row1[8]-$row1[9]);
            $pdf->Cell(15, 6, ($row1[10]-$row1[8]-$row1[9]),0,0, 'C',0);                                    
            $desc=$desc+$row1[9];
            $pdf->Cell(17, 6, $row1[9],0,0, 'C',0);                    
            $pdf->Cell(16, 6, $row1[6],0,0, 'C',0);                    
            $pdf->Cell(17, 6, $row1[7],0,0, 'C',0);                                                    
            $ivaT=$ivaT+$row1[8];
            $pdf->Cell(15, 6, $row1[8],0,0, 'C',0);                                    
            $total=$total+$row1[10];
            $t0 = $row1[6];
            $pdf->Cell(15, 6, $row1[10],0,0, 'C',0);                    
            $pdf->Cell(25, 6, $row1[3],0,0, 'C',0);                    
            $pdf->Cell(20, 6, $row1[5],0,0, 'C',0);                         
            $pdf->Ln(6);                                                                                         
        }                       
    }                   
    $pdf->SetX(1);                                             
    $pdf->Cell(207, 0, utf8_decode(""),1,1, 'R',0);
    $pdf->Cell(68, 6, utf8_decode("Totales"),0,0, 'R',0);
    $pdf->Cell(15, 6, maxCaracter((number_format($sub,2,',','.')),20),0,0, 'C',0);                                    
    $pdf->Cell(17, 6, maxCaracter((number_format($desc,2,',','.')),20),0,0, 'C',0);                                    
    $pdf->Cell(17, 6, maxCaracter((number_format($t0,2,',','.')),20),0,0, 'C',0);                                    
    $pdf->Cell(16, 6, maxCaracter((number_format($sub,2,',','.')),20),0,0, 'C',0);                        
    $pdf->Cell(16, 6, maxCaracter((number_format($ivaT,2,',','.')),20),0,0, 'C',0);                        
    $pdf->Cell(14, 6, maxCaracter((number_format($total,2,',','.')),20),0,0, 'C',0);                        
    $pdf->Ln(8);           
    $pdf->Output();
?>