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


$this->title = 'SAE - Sistema Administrativo Contable';
?>


<?php


$grid= new Grid;
$botones= new Botones;



/* $botones->getBotongridArray(
  array(
    array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'#', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'pequeño', 'adicional'=>''),
    array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'#', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'pequeño', 'adicional'=>''),
    array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'#', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'pequeño', 'adicional'=>''),
  )
);*/

$columnas= array(
    array('columna'=>'# Orden', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Mesa', 'datareg' => 'mesa', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Valor', 'datareg' => 'total', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Mesero', 'datareg' => 'usuariocreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha Hora', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

?>

<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <div class="row w-100 d-flex ">
      <div class=" mr-auto p-2  ">
        <h1 class="h4 mb-0 text-gray-800">Órdenes</h1>
      </div>
    </div>
  </div>
</div>

<?php

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'ordenesreg')
        )
);

//var_dump($grid);

?>
 <style>
        .table
        {
            margin-bottom: 0rem !important;
        }
        .dataTables_length
        {
          display: inline-block;
        }
        .dataTables_filter
        {
          display: inline-block;
        }
        .btn .fas, .fa
        {
          color:white;
        }
    </style>
 
   <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
