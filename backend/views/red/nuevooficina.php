<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Crear Cajero';
$this->params['breadcrumbs'][] = ['label' => 'Administración de Redes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
    <input type="hidden" id="action" value="nuevo">
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
                            <h3 class="box-title">Configuración de Cajero</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2" style="width: 100%;" id="estado">
                                            <option selected="selected" value="ACTIVO">Activo</option>
                                            <option value="INACTIVO">Inactivo</option>
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
                            <h3 class="box-title">Usuario</h3>
                        </div> 
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label>Creado por: </label>
                                <?= Yii::$app->user->identity->nombres.' '.Yii::$app->user->identity->apellidos ?>
                            </div> 
                        </div> 
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Provincia:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <select class="form-control select2" style="width: 100%;" id="provincia">
                                        <option >Seleccione la provincia</option>
                                        <?php foreach ($provincia as $key => $value) { ?>
                                            <option value="<?=$value->id ?>"><?=$value->nombre ?></option>
                                        <?php } ?>
                                    </select>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->
                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Nombre:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="nombre">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->
                        
                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Descripción:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="descripcion">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->

                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Dirección:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="direccion">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->

                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Ciudad:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="ciudad">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->

                        <div class="box-body box-int col-md-3 col-xs-3">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Latitud:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-reorder"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="latitud" value="">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->

                        <div class="box-body box-int col-md-3 col-xs-3">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Logitud:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-reorder"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="logitud" value="">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->
                        
                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Texto Horario 1:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="horario1">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->

                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Texto Horario 2:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="horario2">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->


                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Texto Horario 3:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="horario3">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->

                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Contenido Horario 1:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="chorario1">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->

                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Contenido Horario 2:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="ccchorario2">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->


                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Contenido Horario 3:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="chorario3">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->



                        <input type="hidden" id="token" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">
                </div>
                        
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
$this->registerJsFile(URL::base() . "/js/class/cajeroNew.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);
