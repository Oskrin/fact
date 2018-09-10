<?php

session_start();

include '../conexion.php';
conectarse();
error_reporting(0);
$id = $_GET['com'];
$arr_data = array();

$consulta = pg_query("SELECT * FROM formulario_101 where id_formualrio101 ='" . $id . "'");
while ($row = pg_fetch_row($consulta)) {
        $arr_data[] = $row[1];
        $arr_data[] = $row[2];
        $arr_data[] = $row[3];
        $arr_data[] = $row[4];
        $arr_data[] = $row[5];
        $arr_data[] = $row[6];
        $arr_data[] = $row[7];
        $arr_data[] = $row[8];
        $arr_data[] = $row[9];
        $arr_data[] = $row[10];
        $arr_data[] = $row[11];
        $arr_data[] = $row[12];
        $arr_data[] = $row[13];
        $arr_data[] = $row[14];
        $arr_data[] = $row[15];
        $arr_data[] = $row[16];
        $arr_data[] = $row[17];
        $arr_data[] = $row[18];
        $arr_data[] = $row[19];
        $arr_data[] = $row[20];
        $arr_data[] = $row[21];
        $arr_data[] = $row[22];
        $arr_data[] = $row[23];
        $arr_data[] = $row[24];
        $arr_data[] = $row[25];
        $arr_data[] = $row[26];
        $arr_data[] = $row[27];
        $arr_data[] = $row[28];
        $arr_data[] = $row[29];
        $arr_data[] = $row[30];
        $arr_data[] = $row[31];
        $arr_data[] = $row[32];
        $arr_data[] = $row[33];
        $arr_data[] = $row[34];
        $arr_data[] = $row[35];
        $arr_data[] = $row[36];
        $arr_data[] = $row[37];
        $arr_data[] = $row[38];
        $arr_data[] = $row[39];
        $arr_data[] = $row[40];
        $arr_data[] = $row[41];
        $arr_data[] = $row[42];
        $arr_data[] = $row[43];
        $arr_data[] = $row[44];
}

echo json_encode($arr_data);
?>
