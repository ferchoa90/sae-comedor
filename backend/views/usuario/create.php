<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Crear Trivia';
$this->params['breadcrumbs'][] = ['label' => 'Administración de Trivias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
    <input type="hidden" id="action" value="create">
    <input type="hidden" id="id" value="0">
    <div class="trivia-head-create">
        <div class="box-body">
            <a class="btn btn-success" id="btn_save"><i class="fa fa-save"></i>&nbsp; Guardar</a>
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
                                            <option selected="selected" value="ACTIVE">Activo</option>
                                            <option value="INACTIVE">Inactivo</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tipo de pregunta</label>
                                        <select class="form-control select2" style="width: 100%;" id="tipo">
                                            <option selected="selected" value="ABIERTO">Pregunta abierta</option>
                                            <option value="SIMPLE">Una sola respuesta (Simple)</option>
                                            <option value="MULTIPLE">Varias respuestas (Multiple)</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>De acceso premium</label>
                                        <select class="form-control select2" style="width: 100%;" id="acceso">
                                            <option selected="selected" value="SI">Si</option>
                                            <option value="NO">No</option>
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
                                    <input type="text" class="form-control pull-right" id="reservationtime">
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
                                    <input type="text" class="form-control pull-right" id="pregunta">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>


            <!-- Trivia Detalle -->

            <div class="row" id="opciones" style="display: none;">
                <div class="col-md-12 col-xs-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Opciones de respuesta</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-10 col-xs-8">
                                    <label>Opciones:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                        <input type="text" class="form-control pull-right opcion">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-2 col-xs-4">
                                    <label>Orden:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                        <input type="text" class="form-control pull-right orden">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <div class="row">
                                <div class="col-md-10  col-xs-8">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                        <input type="text" class="form-control pull-right opcion">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-2  col-xs-4">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                        <input type="text" class="form-control pull-right orden">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <div class="row">
                                <div class="col-md-10 col-xs-8">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                        <input type="text" class="form-control pull-right opcion">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-2 col-xs-4">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                        <input type="text" class="form-control pull-right orden">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <div class="row">
                                <div class="col-md-10 col-xs-8">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                        <input type="text" class="form-control pull-right opcion">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-2 col-xs-4">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-list-ol"></i></div>
                                        <input type="text" class="form-control pull-right orden">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
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
