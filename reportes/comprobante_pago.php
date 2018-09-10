<?php
    //require('../fpdf/fpdf.php');
    include '../fpdf/rotation.php';
    include '../data/conexion.php';
    include '../procesos/funciones.php';

    conectarse();    
    date_default_timezone_set('America/Guayaquil'); 
    session_start()   ;
    class PDF extends PDF_Rotate {   
        var $widths;
        var $aligns;
        function SetWidths($w) {            
            $this->widths=$w;
        }    

        function RotatedText($x, $y, $txt, $angle) {
            //Text rotated around its origin
            $this->Rotate($angle, $x, $y);
            $this->Text($x, $y, $txt);
            $this->Rotate(0);
        }

        function RotatedImage($file, $x, $y, $w, $h, $angle) {
            //Image rotated around its upper-left corner
            $this->Rotate($angle, $x, $y);
            $this->Image($file, $x, $y, $w, $h);
            $this->Rotate(0);
        }                      
    }
    $pdf = new PDF('L','mm',array(200,210));
    //$pdf = new PDF('P','mm','a5');
    $pdf->AddPage();
    $pdf->SetMargins(0,0,0,0);
    $pdf->AliasNbPages();
    $pdf->AddFont('Amble-Regular','','Amble-Regular.php');
    $pdf->SetFont('Amble-Regular','',10);       
    // $pdf->SetFont('Arial','B',9);   
    // $pdf->SetX(5);    
    // $pdf->SetFont('Amble-Regular','',9);

    $fecha = date('Y-m-d', time());
    $pdf->SetX(1);
    $pdf->SetY(1);
    $pdf->Cell(20, 5, $fecha, 0,0, 'C', 0);                         
    $pdf->Cell(170, 5, "COMPROBANTE PAGO", 0,1, 'R', 0);                                                        
    $pdf->Cell(190, 8, "EMPRESA: ".$_SESSION['empresa'], 0,1, 'C',0);                                
    $pdf->Image('../images/logo_empresa.jpg',5,8,45,30);
    // $pdf->SetFont('Amble-Regular','',10);        
    $pdf->Cell(190, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
    $pdf->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
    $pdf->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
    $pdf->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
    // $pdf->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
    $pdf->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);

    $sql = pg_query("SELECT * FROM detalle_pagos_venta WHERE id_detalles_pagos_venta = '$_GET[id]'");
    while($row = pg_fetch_row($sql)){
        $id_pagos_venta = $row[1];
        $saldo = $row[4];

        $sql2 = pg_query("SELECT * FROM pagos_venta WHERE id_pagos_venta = '$id_pagos_venta'");
        while($row = pg_fetch_row($sql2)){
            $id_cliente = $row[1];

            $sql3 = pg_query("SELECT * FROM cliente WHERE id_cliente = '$id_cliente'");
            while($row = pg_fetch_row($sql3)){
                $nombres_completos = $row[3];
                $identificacion = $row[2];
                $telefono = $row[5];
                $direccion = $row[8];
            }
        }
    }      

    // $sql = pg_query("select F.id_factura_venta,F.numero_serie,F.fecha_actual, F.tarifa0,F.tarifa12,F.iva,F.descuento,F.total,C.id_cliente,C.identificacion,C.nombres_completos,C.direccion,C.telefono2,F.estado from factura_venta F,cliente C where id_factura_venta = '$_GET[id]' and F.id_cliente = C.id_cliente");
    // while($row = pg_fetch_row($sql)){
    //     $id_cliente = $row[8];
    //     $cliente = $row[10];
    //     $ci_ruc = $row[9];
    //     $direccion = $row[11];
    //     $telefono = $row[12];
    //     $fecha = $row[2];
    //     $nro_fac = substr($row[1],8);
    //     $iva0 = $row[3];
    //     $iva12 = $row[4];
    //     $iva_venta = $row[5];
    //     $descuento_venta = $row[6];
    //     $total_venta = $row[7];
    //     $estado = $row[13];
    // }        
    /////////header   
    $pdf->SetFont('Arial','B',10);        
            /////////medio
    $pdf->SetFont('Amble-Regular','',10);       
 //    $pdf->Text(10, 42, maxCaracter(utf8_decode('Nombres Completos:   '.$cliente),80),1,0, 'L',0);/////cliente
	// $pdf->Text(10, 48, maxCaracter(utf8_decode('Fecha:  '.$fecha),20),1,0, 'L',0);/////fecha
 //    $pdf->Text(10, 53, maxCaracter(utf8_decode('Dirección:  '.$direccion),35),1,0, 'L',0);////direccion
 //    $pdf->Text(145, 42, maxCaracter(utf8_decode('RUC/CI:  '.$ci_ruc),20),1,0, 'L',0);////ruc ci
 //    $pdf->Text(145, 48, maxCaracter(utf8_decode('Teléfono:  '.$telefono),20),1,0, 'L',0);////telefono

    $pdf->Text(10, 60, maxCaracter(utf8_decode('Nombres Completos:   '.$nombres_completos),80),1,0, 'L',0);/////cliente
    $pdf->Text(10, 65, maxCaracter(utf8_decode('Dirección:  '.$direccion),35),1,0, 'L',0);////direccion
    $pdf->Text(145, 60, maxCaracter(utf8_decode('RUC/CI:  '.$identificacion),20),1,0, 'L',0);////ruc ci
    $pdf->Text(145, 65, maxCaracter(utf8_decode('Teléfono:  '.$telefono),20),1,0, 'L',0);////telefono
        


    $pdf->Text(130, 100, 'TOTAL PAGADO:     '.$saldo,0,1, 'L',0);


    $pdf->Text(80, 150, 'RECIBI CONFORME',0,1, 'L',0);     
   

    $pdf->Output();
?>