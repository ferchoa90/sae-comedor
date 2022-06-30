<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use common\models\Menuadmin;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver proveedor";
$this->params['breadcrumbs'][] = ['label' => 'Mantenimientos', 'url' => ['proveedores']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));
 
 
$tipo= ($proveedor->natural=0)?'SI' : 'NO';
$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>ID: </b>'.$proveedor->id.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Ruc:</b>&nbsp; '.$proveedor->identificacion.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Tipo:</b>&nbsp; '.$tipo.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Cuenta Contable:</b>&nbsp; '.$proveedor->cuentacontable.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Cuenta Anticipo:</b>&nbsp; '.$proveedor->cuentaanticipo.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Débito:</b>&nbsp; '.number_format($proveedor->debito,2).'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Crédito:</b>&nbsp; '.number_format($proveedor->credito,2).'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>Nombres:</b>&nbsp; '.$proveedor->nombre.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Dirección:</b>&nbsp; '.$proveedor->direccion.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Correo:</b>&nbsp; '.$proveedor->correo.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Notas:</b>&nbsp; '.$proveedor->notas.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Contacto:</b>&nbsp; '.$proveedor->contacto.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Fax:</b>&nbsp; '.$proveedor->fax.'</span><br></div>';
$contenido.='<div class="col-6 col-md-12"><b>Teléfono:</b>&nbsp; '.$proveedor->telefono.'</span><br></div>';
//$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='</div>';

 if ($proveedor->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$proveedor->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$proveedor->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$proveedor->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp; '.$proveedor->fechaact.' </span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp; '.$proveedor->usuarioactualizacion0->username. '</span><br>';
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
