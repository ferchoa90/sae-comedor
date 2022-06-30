<?php

$now = gmdate("D, d M Y H:i:s");
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
header("Last-Modified: {$now} GMT");

// force download
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");

// disposition / encoding on response body
header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header("Content-Disposition: attachment;filename={$filename}");
header("Content-Transfer-Encoding: binary");
/* $array2=array();
foreach ($data as $key => $value) {
    $array2[]= array("1"=>"2");
} */
setlocale(LC_ALL, 'es_ES.UTF8');
/* die(var_dump($array2)); */
echo mb_convert_encoding($array ,'UTF-16LE', 'UTF-8');
/* fputcsv($out,array("id","genero","edad","ocupacion","provincia","coop1","coop2","coop3","carac1","carac2","carac3",
"carac4","carac5","cuenta","nombre","reconoces","significado","escuchado","nombrecoop1","nombrecoop2",
"entidad","credito","p1","p2","p3","nombres","celular","fechacreacion"),"\t");

foreach ($data as $data2)
{
    //die($data2);
    fputcsv($out, $data2,"\t");
}
fclose($out); */