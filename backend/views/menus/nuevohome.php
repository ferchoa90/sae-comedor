<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

use backend\models\Productos;
/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Crear Menú Home';
$this->params['breadcrumbs'][] = ['label' => 'Administración de Menús', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$productos = Productos::find()->where(['isDeleted' => '0','estado' => 'ACTIVO'])->orderBy(["fechacreacion" => SORT_DESC])->all();
?>
    <input type="hidden" id="action" value="nuevohome">
    
    <input type="hidden" id="id" value="0">
    <div class="trivia-head-create">
        <div class="box-body">
            <a class="btn btn-success" id="btn_save"><i class="fa fa-save"></i>&nbsp; Guardar</a>
        </div>
        <div class="box-body" id="messages" style="display:none;"></div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Configuración de Menú Home</h3>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Producto</label>
                                        <select class="form-control select2" style="width: 100%;" id="producto">
                                            <?php foreach ($productos as $key => $value) { ?>
                                                <option  value="<?=$value->id ?>"><?=$value->nombre ?></option>
                                            <?php } ?>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Información</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <dl class="dl-horizontal">
                                <dt>Imagen</dt>
                                <dd><!-- <img src="/app/web/images/teams/default.png" /> --></dd>
                            </dl>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="box box-default"> 
                        <div class="box-body">
                            <!-- Date and time range -->
                            <form class="" method="POST" id="formSlider" enctype="multipart/form-data">
                            
                            <div class="form-group  col-md-6 col-xs-6">
                                <label>Imagen:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <input type="file" class="form-control pull-right" id="imagen" name="imagen">
                                    
                                    <!-- value="QTZXVHFuMDUEAAUxSVZhYShwEzobL1NDFk5gYTUIWE1xDyADA0NRAQ==" -->
                                    <div class="input-group-addon">
                                        <span class="info-text">*Tamaño: 750 x 462</span><br>
                                    </div>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group  col-md-6 col-xs-6">
                                <label>Imagen Mobile:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <input type="file" class="form-control pull-right" id="imagenmobile" name="imagenmobile">
                                    
                                    <div class="input-group-addon">
                                        <span class="info-text">*Tamaño: 300 x 300</span><br>
                                    </div>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Enlace:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="enlace" name="enlace" value="#">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                             
                            <input type="hidden" id="token" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">
                            </form>
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

$this->registerJsFile(URL::base() . "/js/class/menuhomeNew.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);



