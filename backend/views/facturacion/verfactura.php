<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use common\models\Menuadmin;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver facturacion";
$this->params['breadcrumbs'][] = ['label' => 'Facturacion', 'url' => ['facturas']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

//var_dump($factura->tipoprecio0->nombre);
//$tipo= ($factura->natural=0)?'SI' : 'NO';
$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>ID: </b>'.$factura->nfactura.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Fecha:</b>&nbsp; '.$factura->fecha.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Nombres:</b>&nbsp; '.$factura->cliente->razonsocial.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Dirección:</b>&nbsp; '.$factura->cliente->direccion.'</span><br></div>';
$contenido.='<div class="col-12 col-md-6"><b>Correo:</b>&nbsp; '.$factura->cliente->correo.'</span><br></div>';
$contenido.='<div class="col-12 col-md-6"><b>Teléfono:</b>&nbsp; '.$factura->cliente->telefono.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Forma de Pago:</b>&nbsp; '.$factura->tipopago0->nombre.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Tarjeta:</b>&nbsp; '.$factura->tipotarjetapago->nombre.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

 if ($factura->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 if ($factura->facturae=="PENDIENTE"){ $stylestatusfe="badge-warning"; }else{ $stylestatusfe="badge-success" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$factura->estatus.'</span><br>';
 $contenido2.='<div style="line-height:30px;"><b>F. Electrónica:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatusfe.'" style="color:white"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$factura->facturae.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$factura->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$factura->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp; '.$factura->fechaact.' </span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp; '.$factura->usuarioactualizacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

 $tabla='<div class="col-12" style="width: 100%;overflow-x: scroll;">
 <table class="table table-striped">
 <thead>
   <tr>
     <th scope="col">Cant.</th>
     <th scope="col">Item</th>
     <th scope="col" class="text-center">Valor U.</th>
     <th scope="col" class="text-center">Valor T.</th>
     
   </tr>
 </thead>
 <tbody>';
$cont=0; $cont2=1; $tdescuento=0; $tiva=0; $tcantidad=0;$tsubtotal=0;
 foreach ($factura->facturadetalle as $key => $value) {
    $scope= ($con==1)? $scope='scope="row"' : $scope='';
    $tcantidad+=$value->cantidad;
    $tsubtotal+=$value->valoru;
    $tiva+=$value->iva;
    $tdescuento+=$value->valordes;
   // if ($value->debito==0){ $debe=$value->valor; $sumdebe+=$value->valor; $haber=0; }else{  $haber=$value->valor;  $sumhaber+=$value->valor; $debe=0;     }
    $tabla.=' <tr><td '.$scope.'>'.number_format($value->cantidad,2).'</td><td>'.$value->narticulo.'</td><td class="text-right">'.number_format($value->valoru/1.12,2).'</td>';
    $tabla.='<td class="text-right">'.number_format(($value->valoru-$value->iva)*($value->cantidad),2).'</td></tr>';
    $cont++; $cont2++;
    ($con==2)? $cont=0 : $cont=$cont;
 }
$tabla.='</tbody></table><table class="table"> <tbody><tr>';
$tabla.='<td class="text-right"><span style="padding-right: 3%;"><b>Subtotal: </span></b>'.number_format($factura->subtotal,2).'</td></tr><tr><td class="text-right"><span style="padding-right: 3%;"><b>T. Iva: </span></b>'.number_format($factura->iva,2).'</td></tr><tr><td class="text-right"><span style="padding-right: 3%;"><b>Total: </span></b>'.number_format($factura->total,2).'</td> </tr>';

   $tabla.='</tbody></table></div>';

    $contenido.=$tabla;


 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'dvcontent','id'=>'dvcontent','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'dvcontent2','id'=>'dvcontent2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
