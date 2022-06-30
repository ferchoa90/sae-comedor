<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver Entrega";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Entregas', 'url' => ['entregas']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>Entrega:  </b>'.$entregas->id.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Fecha / Hora:  </b>'.$entregas->fecha.' '.$entregas->hora.'<br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-6 col-md-6"><b>Factura:</b>&nbsp; '.$entregas->nfactura.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Guía de Remisión:</b>&nbsp; '.$entregas->guiaremision.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cliente:</b>&nbsp; '.$entregas->cliente0->razonsocial.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Punto de Partida:</b>&nbsp; '.$entregas->puntopartida.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Punto de Llegada:</b>&nbsp; '.$entregas->puntollegada.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Transportista:</b>&nbsp; '.$entregas->transporte0->nombre.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Bultos:</b>&nbsp; '.$entregas->bultos.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Notas:</b>&nbsp; '.$entregas->notas.'</span><br></div>';
//$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

 if ($entregas->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$entregas->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$entregas->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$entregas->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp;'.$entregas->usuarioactualizacion0->username. '</span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp;'.$entregas->fechaact. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

 $tabla='';



 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
