<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = "Resultados de Pronóstico";
$this->params['breadcrumbs'][] = $this->title;

$flagIndex = 'false';
if (strpos($_SERVER[REQUEST_URI], 'interacciones') !== false) {
    $flagIndex = 'true';
}

//echo $_SERVER[REQUEST_URI];
$urls = explode("/", str_replace('/interacciones', '', $_SERVER[REQUEST_URI]));
$partes = count($urls) - 1;

?>

    <!-- ========================================================================================================== -->
    <!-- Trvia box -->
    <input type="hidden" id="urlflag" value="<?= $flagIndex ?>">
    <input type="hidden" id="urlself" value="<?= $urls[$partes] ?>">
    <input type="hidden" id="token" value="<?= Yii::$app->request->csrfToken ?>">

    <div class="box">
        <div class="box-body">
            <div class="box-body">
                <table id="table_trivia" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="tableheader">
                        <th style="width:40px">#</th>
                        <th>Estado</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Final</th>
                        <th>Promo</th>
                        <th>Jugadores</th>
                        <!-- <th>Acceso Pagado</th> -->
                        <th>Fecha Creación</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>


<?php
$this->registerJsFile(URL::base() . "/js/class/pronosticoResultados.js", [
    'depends' => [
        \yii\bootstrap\BootstrapPluginAsset::className()
    ]
]);

