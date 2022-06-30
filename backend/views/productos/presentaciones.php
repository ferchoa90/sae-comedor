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

$this->title = "Presentaciones";
$this->params['breadcrumbs'][] = $this->title;
 

$botones= new Botones;
$this->title = "Presentaciones";
?>
<div class="row col-12 p-2" >
<?php
echo $botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'presentacionnueva', 'id' => 'new', 'titulo'=>' Agregar Presentación', 'link'=>'presentacionnueva', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));

?>
</div>
<?php
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;


$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'NOMBRE', 'datareg' => 'nombre', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'DESCRIPCION', 'datareg' => 'descripcion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'FECHACREACION', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'USU. CREACIÓN', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'ESTATUS', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'presentacionesregistros')
        )
);

?>










