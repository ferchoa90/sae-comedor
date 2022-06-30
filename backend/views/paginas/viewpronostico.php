<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\GlobalData;
use app\themes\adminLTE\assets\ExportAsset;

/* @var $this yii\web\View */

$flagIndex = 'false';
if (strpos($_SERVER[REQUEST_URI], 'index') !== false) {
    $flagIndex = 'true';
}

$userData = GlobalData::getUserDataById($model->creado_por);
$flagDataMod = false;
if (!empty($model->modificado_por)) {
    $flagDataMod = true;
    $userDataMod = GlobalData::getUserDataById($model->modificado_por);
}

$this->title = "Interacción en Pronóstico";
$this->params['breadcrumbs'][] = ['label' => 'Resultados de Pronóstico', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

    <div class="trivia-head-view">
        <!-- ========================================================================================================== -->
        <!-- Trvia box -->
        <input type="hidden" id="urlflag" value="<?= $flagIndex ?>">
        <input type="hidden" id="urlself" value="<?= $urls[$partes] ?>">
        <input type="hidden" id="idtrivia" value="<?= $_GET['id'] ?>">
        <input type="hidden" id="token" value="<?= Yii::$app->request->csrfToken ?>">

        <div class="row">
            <div class="col-md-4 col-xs-12">
                <div class="box box-success">
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>Estado:</dt>
                            <dd>
                                <?php if ($model->status == 'ACTIVE') { ?>
                                    <span class="label label-success"><i class="fa fa-circle"></i>&nbsp; <?= $model->status ?></span>
                                <?php } else {
                                    ?>
                                    <span class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; <?= $model->status ?></span>
                                <?php } ?>
                            </dd>
                            <dt>&nbsp;</dt>
                            <dd>&nbsp;</dd>
                             
                            <dt>Acceso premium:</dt>
                           <!--  <dd><?//= $model->user_acceso ?></dd> -->
                        </dl>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- ./col -->
            <div class="col-md-4 col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>Fecha de Inicio:</dt>
                            <dd><?= GlobalData::strToMysqlDateFormat($model->fechainicio, "Y-m-d H:i:s", "d-m-Y H:i:s") ?></dd>
                            <dt>Fecha de Final:</dt>
                            <dd><?= GlobalData::strToMysqlDateFormat($model->fechafin, "Y-m-d H:i:s", "d-m-Y H:i:s") ?></dd>
                            <dt>Pronóstico:</dt>
                            <dd><?= $model->promo ?></dd>
                        </dl>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- ./col -->
            <div class="col-md-4 col-xs-12">
                <div class="box box-success">
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>Creado por:</dt>
                            <dd><?= $userData['fullname'] ?></dd>
                            <dt>Fecha de Creación:</dt>
                            <dd><?= GlobalData::strToMysqlDateFormat($model->fecha_creacion, "Y-m-d H:i:s", "d-m-Y H:i:s") ?></dd>
                            <dt>Modificado por:</dt>
                            <dd><?= ($flagDataMod) ? $userDataMod['fullname'] : " - "; ?></dd>
                            <dt>Fecha de Modificación:</dt>
                            <dd><?= ($flagDataMod) ? GlobalData::strToMysqlDateFormat($model->fecha_modificacion, "Y-m-d H:i:s", "d-m-Y H:i:s") : " - "; ?></dd>
                        </dl>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- ./col -->
        </div>

        <div class="box box-warning">
            <div class="box-body">

                <div class="box-body">
                    <table id="table_trivia" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="tableheader">
                            <th style="width:40px">#</th>
                            <th>Fecha Creación</th>
                            <th>Aciertos</th>
                            <th>Usuario</th>
                            <th>Cédula</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>&nbsp;</th>
                            <!--<th></th>-->
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

    </div>
<?php
ExportAsset::register($this);
$this->registerJsFile(URL::base() . "/js/class/pronosticoInteraccion.js", [
    'depends' => [
        \yii\bootstrap\BootstrapPluginAsset::className()
    ]
]);
?>
