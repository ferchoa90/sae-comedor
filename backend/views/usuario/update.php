<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use app\components\GlobalData;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Actualizar Trivia';
$this->params['breadcrumbs'][] = ['label' => 'Administración de Trivias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Combos
$active = "";
$inactive = "";
if ($model->estado == 'ACTIVE') {
    $active = ' selected="selected" ';
} else {
    $inactive = ' selected="selected" ';
}
$simple = "";
$abierto = "";
$multiple = "";
$display = "";
switch ($model->tipo_pregunta) {
    case "ABIERTO":
        $abierto = ' selected="selected" ';
        $display = ' style="display:none" ';
        break;
    case "SIMPLE":
        $simple = ' selected="selected" ';
        break;
    case "MULTIPLE":
        $multiple = ' selected="selected" ';
        break;
}
$premiumSi = "";
$premiumNo = "";
if ($model->user_acceso == 'SI') {
    $premiumSi = ' selected="selected" ';
} else {
    $premiumNo = ' selected="selected" ';
}

$flagLabels = true;

// fechas
$fullDate = GlobalData::strToMysqlDateFormat($model->fecha_inicio, "Y-m-d H:i:s", "d/m/Y h:i A") . " - " . GlobalData::strToMysqlDateFormat($model->fecha_final, "Y-m-d H:i:s", "d/m/Y h:i A");

?>
    <input type="hidden" id="action" value="update?id=<?= $model->id ?>">
    <div class="trivia-head-create">
        <div class="box-body">
            <a class="btn btn-success" id="btn_save"><i class="fa fa-save"></i>&nbsp; Actualizar</a>
        </div>
        <div class="box-body" id="messages" style="display:none;"></div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-9 col-xs-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Configuración de Trivia</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2" style="width: 100%;" id="estado">
                                            <option <?= $active ?> value="ACTIVE">Activo</option>
                                            <option <?= $inactive ?> value="INACTIVE">Inactivo</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tipo de pregunta</label>
                                        <select class="form-control select2" style="width: 100%;" id="tipo">
                                            <option <?= $abierto ?> value="ABIERTO">Pregunta abierta</option>
                                            <option <?= $simple ?> value="SIMPLE">Una sola respuesta (Simple)</option>
                                            <option <?= $multiple ?> value="MULTIPLE">Varias respuestas (Multiple)</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>De acceso premium</label>
                                        <select class="form-control select2" style="width: 100%;" id="acceso">
                                            <option <?= $premiumSi ?> value="SI">Si</option>
                                            <option <?= $premiumNo ?> value="NO">No</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Período de vigencia</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Fecha de inicio - Fecha final:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="reservationtime" value="<?= $fullDate ?>">
                                    <input type="hidden" id="f_ini">
                                    <input type="hidden" id="f_fin">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="box box-default">
                        <div class="box-body">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Pregunta:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="pregunta" value="<?= $model->pregunta ?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>

            <!-- Trivia Detalle -->

            <div class="row" id="opciones" <?= $display ?> >
                <div class="col-md-12 col-xs-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Opciones de respuesta</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php foreach ($modelDetail as $item): ?>
                                <div class="row">
                                    <div class="col-md-10 col-xs-8">
                                        <?php if ($flagLabels): ?>
                                            <label>Opciones:</label>
                                        <?php endif; ?>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                            <input type="text" class="form-control pull-right opcion" value="<?= $item['respuesta'] ?>">
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                    <div class="col-md-2 col-xs-4">
                                        <?php if ($flagLabels): ?>
                                            <label>Orden:</label>
                                        <?php endif; ?>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                            <input type="text" class="form-control pull-right orden" value="<?= $item['orden'] ?>">
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                                <?php
                                $flagLabels = false;
                            endforeach;
                            ?>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
        </div>
        <!--<div class="box-body">
            <a class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Guardar</a>
        </div>-->
    </div>

<?php
$this->registerCssFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker-bs3.css", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);
$this->registerJsFile(URL::base() . "/js/plugins/moment.min.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);
$this->registerJsFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);
$this->registerJsFile(URL::base() . "/js/class/triviaCreate.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);
