<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use common\models\Menuadmin;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver Cliente";
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['clientes']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));
 
 

$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>ID: </b>'.$cliente->id.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Tipo Iden.: </b>'.$cliente->tipoidentificacion->nombre.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Cédula: </b>'.$cliente->cedula.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Cta. Contable:</b>&nbsp; '.($cliente->cuentacontable).'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Cta. Anticipo:</b>&nbsp; '.$cliente->cuentaanticipo.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Crédito:</b>&nbsp; '.number_format($cliente->credito,2).'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Débito:</b>&nbsp; '.number_format($cliente->debito,2).'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Cupo Crédito:</b>&nbsp; '.$cliente->cupocredito.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-6 col-md-6"><b>Razón Comercial:</b>&nbsp; '.$cliente->razoncomercial.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Nombres:</b>&nbsp; '.$cliente->razonsocial.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Dirección:</b>&nbsp; '.$cliente->correo.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Contacto:</b>&nbsp; '.$cliente->contacto.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Notas:</b>&nbsp; '.$cliente->notas.'</span><br></div>';
//$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

 if ($cliente->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$cliente->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$cliente->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$cliente->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp; - </span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp; - </span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

 $tabla='';



 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'dvcontent','id'=>'dvcontent','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'dvcontent','id'=>'dvcontent','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
