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

$this->title = "Administración de Entregas";
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;
$botones= new Botones;

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Factura', 'datareg' => 'nfactura', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha', 'datareg' => 'fecha', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Hora', 'datareg' => 'hora', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Guia R', 'datareg' => 'guiaremision', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Observacion', 'datareg' => 'notas', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Fecha IT', 'datareg' => 'fechaintraslado', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha FT', 'datareg' => 'fechafintraslado', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Punto Salida', 'datareg' => 'puntopartida', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Punto Llegada', 'datareg' => 'puntollegada', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Usuario Creación', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Fecha Creación', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'entregasreg')
        )
);

?>
