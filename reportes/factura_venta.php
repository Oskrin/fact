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
    $pdf->Cell(170, 5, "FACTURA VENTA", 0,1, 'R', 0);                                                        
    $pdf->Cell(190, 8, "EMPRESA: ".$_SESSION['empresa'], 0,1, 'C',0);                                
    $pdf->Image('../images/logo_empresa.jpg',5,8,45,30);
    // $pdf->SetFont('Amble-Regular','',10);        
    $pdf->Cell(190, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
    $pdf->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
    $pdf->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
    $pdf->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
    // $pdf->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
    $pdf->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);     

    $sql = pg_query("select F.id_factura_venta,F.numero_serie,F.fecha_actual, F.tarifa0,F.tarifa12,F.iva,F.descuento,F.total,C.id_cliente,C.identificacion,C.nombres_completos,C.direccion,C.telefono2,F.estado from factura_venta F,cliente C where id_factura_venta = '$_GET[id]' and F.id_cliente = C.id_cliente");
    while($row = pg_fetch_row($sql)){
        $id_cliente = $row[8];
        $cliente = $row[10];
        $ci_ruc = $row[9];
        $direccion = $row[11];
        $telefono = $row[12];
        $fecha = $row[2];
        $nro_fac = substr($row[1],8);
        $iva0 = $row[3];
        $iva12 = $row[4];
        $iva_venta = $row[5];
        $descuento_venta = $row[6];
        $total_venta = $row[7];
        $estado = $row[13];
    }        
    /////////header   
    $pdf->SetFont('Arial','B',10);        
            /////////medio
    $pdf->SetFont('Amble-Regular','',10);       
    $pdf->Text(10, 42, maxCaracter(utf8_decode('Nombres Completos:   '.$cliente),80),1,0, 'L',0);/////cliente
	$pdf->Text(10, 48, maxCaracter(utf8_decode('Fecha:  '.$fecha),20),1,0, 'L',0);/////fecha
    $pdf->Text(10, 53, maxCaracter(utf8_decode('Dirección:  '.$direccion),35),1,0, 'L',0);////direccion
    $pdf->Text(145, 42, maxCaracter(utf8_decode('RUC/CI:  '.$ci_ruc),20),1,0, 'L',0);////ruc ci
    $pdf->Text(145, 48, maxCaracter(utf8_decode('Teléfono:  '.$telefono),20),1,0, 'L',0);////telefono
        
    if($estado == 'Pasivo') {        
        $pdf->SetTextColor(249,33,33);
        $pdf->RotatedImage('../images/circle.png', 110, 42, 30, 10, 45);        
        $pdf->RotatedText(120,41, 'ANULADO!', 45);        

        // $pdf->RotatedImage('../images/circle.png', 260, 42, 30, 10, 45);
        // $pdf->RotatedText(269,41, 'ANULADO!', 45);        
    }
    ////////detalles

    $sql = pg_query("select D.cantidad,P.descripcion,D.precio,D.total from  detalle_factura_venta D, productos P where id_factura_venta = '$_GET[id]' and D.id_productos = P.id_productos and P.incluye_iva= 'Si'");
    $yy = 66;
    $iva_base = 1.12;    
    $pdf->SetTextColor(0,0,0);
    while($row = pg_fetch_row($sql)){
        $total_si = 0;
        $total_sit = 0;
        $total_si = $row[3] / $iva_base;
        $total_sit = $total_si / $row[0];
        $total_si = truncateFloat($total_si,2);
        $total_sit = truncateFloat($total_sit,2);

        $pdf->Text(5, $yy, maxCaracter(utf8_decode($row[0]),3),0,1, 'L',0);            
        
        $array = ceil_caracter($row[1],35);
        if(sizeof($array) > 1){
            $zz = $yy;
            for($i = 0; $i < sizeof($array); $i++){
                $pdf->Text(20, $zz, utf8_decode($array[$i]),0,0, 'J',0);                               
                        $zz = $zz + 3;
            }
            $yy = $yy + 4;
        } else {
            $pdf->Text(20, $yy, maxCaracter(utf8_decode($row[1]),30),0,0, 'L',0);                           
        }                            

        $pdf->Text(150, $yy, maxCaracter(number_format($total_sit,2,',','.'),6),0,0, 'L',0);            
        $pdf->Text(180, $yy, maxCaracter(number_format($total_si,2,',','.'),6),0,0, 'L',0);                                    
        $yy = $yy + 4;    
    }

    $sql = pg_query("select D.cantidad,P.descripcion,D.precio,D.total from  detalle_factura_venta D, productos P where id_factura_venta = '$_GET[id]' and D.id_productos = P.id_productos and P.incluye_iva= 'No'");    
    $pdf->SetTextColor(0,0,0);
    while($row = pg_fetch_row($sql)){
        $temp_1 =  number_format($row[3],2,',','.');        
        $pdf->Text(5, $yy, maxCaracter(utf8_decode($row[0]),3),0,1, 'L',0);                                                    
        
        $array = ceil_caracter($row[1],35);
        if(sizeof($array) > 1){
            $zz = $yy;
            for($i = 0; $i < sizeof($array); $i++){
                $pdf->Text(20, $zz, utf8_decode($array[$i]),0,0, 'J',0);                               
                        $zz = $zz + 3;
            }
            $yy = $yy + 4;
        } else {
            $pdf->Text(20, $yy, maxCaracter(utf8_decode($row[1]),30),0,0, 'L',0);                           
        }    
        $pdf->Text(150, $yy, maxCaracter(utf8_decode($row[2]),6),0,0, 'L',0);    
                
        $pdf->Text(180, $yy, maxCaracter($temp_1,6),0,0, 'L',0);                                    
        $yy = $yy + 4;                                                
        
    }
    /////////pie        
    $subtotal = truncateFloat($iva12,2);
    $descuento_venta = truncateFloat($descuento_venta,2);
    $iva_venta = truncateFloat($iva_venta,2);
    $iva0 = truncateFloat($iva0,2);
    $total_venta = truncateFloat($total_venta,2);


    $pdf->Text(170, 177, 'Subtotal:      '. maxCaracter($subtotal,5),0,1, 'L',0);    
    $pdf->Text(170, 182, 'Descuento:   '.maxCaracter($iva0,5),0,1, 'L',0);     
    $pdf->Text(170, 187, 'Iva:                  '.maxCaracter($iva_venta,5),0,1, 'L',0);    
//    $pdf->Text(180, 192, maxCaracter($descuento_venta,5),0,1, 'L',0);    
    $pdf->Text(170, 192, 'Total:              '.maxCaracter($total_venta,10),0,1, 'L',0);    

    $pdf->Output();
?>