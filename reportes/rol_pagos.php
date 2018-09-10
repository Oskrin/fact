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
    $pdf->Cell(170, 5, "ROL PAGOS", 0,1, 'R', 0);                                                        
    $pdf->Cell(190, 8, "EMPRESA: ".$_SESSION['empresa'], 0,1, 'C',0);                                
    $pdf->Image('../images/logo_empresa.jpg',5,8,45,30);
    // $pdf->SetFont('Amble-Regular','',10);        
    $pdf->Cell(190, 5, "PROPIETARIO: ".utf8_decode($_SESSION['propietario']),0,1, 'C',0);                                
    $pdf->Cell(80, 5, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
    $pdf->Cell(80, 5, "CEL.: ".utf8_decode($_SESSION['celular']),0,1, 'C',0);                                
    $pdf->Cell(180, 5, "DIR.: ".utf8_decode($_SESSION['direccion']),0,1, 'C',0);                                
    // $pdf->Cell(180, 5, "SLOGAN.: ".utf8_decode($_SESSION['slogan']),0,1, 'C',0);                                
    $pdf->Cell(180, 5, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'C',0);

    $mes_dia = date("m"); // Mes actual

    $sql = pg_query("SELECT * FROM nomina N, empleado E WHERE N.id_empleado = E.id_empleado AND N.id_nomina = '$_GET[id]'");
    while($row = pg_fetch_row($sql)){
        $cedula = $row[21];
        $nombres = $row[22];
        $fecha = $row[2];
        $mes = $row[3];
        $acumulable = $row[4];
        $horas_extras = $row[6];
        $laborados = $row[7];
        $no_laborados = $row[8];
        $sueldo = $row[9];
        $total_extras = $row[10];
        $decimo_tercero = $row[11];
        $decimo_cuarto = $row[12];
        $total_ingresos = $row[13];
        $descuento = $row[14];
        $total_descuentos = $row[16];
        $pagar = $row[17];
    }        
    /////////header   
    $pdf->SetFont('Arial','B',10);        
            /////////medio
    $pdf->SetFont('Amble-Regular','',10);       
    $pdf->Text(10, 42, maxCaracter(utf8_decode('Nombres Completos:   '.$nombres),80),1,0, 'L',0);/////cliente
    $pdf->Text(10, 48, maxCaracter(utf8_decode('Fecha:  '.$fecha),20),1,0, 'L',0);/////fecha
    $pdf->Text(10, 53, maxCaracter(utf8_decode('Sueldo:  '.$sueldo),35),1,0, 'L',0);////direccion
    $pdf->Text(145, 42, maxCaracter(utf8_decode('CI:  '.$cedula),20),1,0, 'L',0);////ruc ci
    $pdf->Text(145, 48, maxCaracter(utf8_decode('Mes:  '.$mes),20),1,0, 'L',0);////telefono
    $pdf->Text(145, 53, maxCaracter(utf8_decode('Horas Extras:  '.$horas_extras),35),1,0, 'L',0);////direccion

    $pdf->Text(10, 58, utf8_decode('Dias Laborados:  '.$laborados),1,0, 'L',0);////telefono
    if ($acumulable == 'SI') {
        if ($mes_dia == '08') {
            $tercero = '375.00';
            $pdf->Text(10, 63, utf8_decode('Total Extas:  '.$total_extras),1,0, 'L',0);////telefono
            $pdf->Text(10, 68, utf8_decode('Decimo Tercero: '.$tercero),1,0, 'L',0);////telefono
            $pdf->Text(10, 73, utf8_decode('Decimo Cuarto:  0.00'),1,0, 'L',0);////telefono
            $pdf->Text(10, 78, utf8_decode('Total Ingresos:  '.$total_ingresos),1,0, 'L',0);////telefono
            $neto = $sueldo + $total_extras + $tercero - $total_descuentos;
            $pdf->Text(80,83, utf8_decode('Neto Pagar:  '.number_format($neto, 2, '.', '')),1,0, 'L',0);////telefono    
        } else {
            if ($mes_dia == '12') {
                $cuarto = $sueldo;
                $pdf->Text(10, 63, utf8_decode('Total Extas:  '.$total_extras),1,0, 'L',0);////telefono
                $pdf->Text(10, 68, utf8_decode('Decimo Tercero:  0.00'),1,0, 'L',0);////telefono
                $pdf->Text(10, 73, utf8_decode('Decimo Cuarto:  '.$cuarto),1,0, 'L',0);////telefono
                $pdf->Text(10, 78, utf8_decode('Total Ingresos:  '.$total_ingresos),1,0, 'L',0);////telefono
                $neto = $sueldo + $total_extras + $cuarto - $total_descuentos;
                $pdf->Text(80,83, utf8_decode('Neto Pagar:  '.$neto),1,0, 'L',0);////telefono
            } else {
                $pdf->Text(10, 63, utf8_decode('Total Extas:  '.$total_extras),1,0, 'L',0);
                $pdf->Text(10, 68, utf8_decode('Decimo Tercero:  0.00'.$mes_dia),1,0, 'L',0);
                $pdf->Text(10, 73, utf8_decode('Decimo Cuarto:  0.00'),1,0, 'L',0);
                $pdf->Text(10, 78, utf8_decode('Total Ingresos:  '.$total_ingresos),1,0, 'L',0);
                $pdf->Text(80,83, utf8_decode('Neto Pagar:  '.$pagar),1,0, 'L',0);   
            }
            
        }
    } else {
        $pdf->Text(10, 63, utf8_decode('Total Extas:  '.$total_extras),1,0, 'L',0);////telefono
        $pdf->Text(10, 68, utf8_decode('Decimo Tercero:  '.$decimo_tercero),1,0, 'L',0);////telefono
        $pdf->Text(10, 73, utf8_decode('Decimo Cuarto:  '.$decimo_cuarto),1,0, 'L',0);////telefono
        $pdf->Text(10, 78, utf8_decode('Total Ingresos:  '.$total_ingresos),1,0, 'L',0);////telefono
        $pdf->Text(80,83, utf8_decode('Neto Pagar:  '.$pagar),1,0, 'L',0);////telefono 
    }
    
    $pdf->Text(130, 58, utf8_decode('Dias no Laborados:  '.$no_laborados),1,0, 'L',0);////telefono
    $pdf->Text(130,63, utf8_decode('Descuentos:  '.$descuento),1,0, 'L',0);////telefono
    $pdf->Text(130,78, utf8_decode('Total Descuentos:  '.$total_descuentos),1,0, 'L',0);////telefono

    $pdf->Output();
?>