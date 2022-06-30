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

$this->title = "Doctores";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;
?>
<div class="row col-12 p-2" >
<?php
echo $botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'ver', 'id' => 'new', 'titulo'=>' Agregar', 'link'=>'nuevodoctor', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));

?>
</div>
<?php

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Identificacion', 'datareg' => 'cedula', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Apellidos', 'datareg' => 'apellidos', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Nombres', 'datareg' => 'nombres', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Profesión', 'datareg' => 'profesion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Correo', 'datareg' => 'correo', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Tipo S.', 'datareg' => 'tiposangre', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Dirección', 'datareg' => 'direccion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Teléfono', 'datareg' => 'telefono', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Usuario C.', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Fecha C.', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'doctoresreg')
        )
);

?>
