<?php
use backend\components\Objetos;
use backend\components\Botones;
use backend\components\Bloques;
use backend\components\Grid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use backend\assets\AppAsset;
/* @var $this yii\web\View */

$botones= new Botones;
$this->title = "Facturas";
?>
<div class="row col-12 p-2" >
<?php
 $botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'ver', 'id' => 'new', 'titulo'=>' Agregar', 'link'=>'nuevafactura', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));

?>
</div>
<?php
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;


$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'NF.', 'datareg' => 'nfactura', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Cliente', 'datareg' => 'cliente', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha F.', 'datareg' => 'fecha', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Subtotal', 'datareg' => 'subtotal', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Iva', 'datareg' => 'iva', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Total', 'datareg' => 'total', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Forma P.', 'datareg' => 'formapago', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Tipo T.', 'datareg' => 'tipotarjeta', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha C.', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Usuario C.', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'facturasreg')
        )
);

?>
