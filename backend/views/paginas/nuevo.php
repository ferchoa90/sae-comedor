<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use backend\assets\AppAsset;
/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Crear Página';
$this->params['breadcrumbs'][] = ['label' => 'Administración de Páginas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
$(document).ready(function () {       
    jQuery(document).ready(function ($) {
        initSample();
    });
});
JS;
$this->registerJs($script, View::POS_END);
AppAsset::register($this);
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
                <div class="col-md-6 col-xs-6">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Configuración de Página</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2" style="width: 100%;" id="estado">
                                            <option selected="selected" value="Activo">Activo</option>
                                            <option value="Inactivo">Inactivo</option>
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
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Nombre:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="nombre" name="nombre">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Título:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="titulo" name="titulo">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Título Slider:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="titslider" name="titslider">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Texto Slider:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="textslider" name="textslider">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group  col-md-6 col-xs-6">
                                <label>Imagen:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <input type="file" class="form-control pull-right" id="imagen" name="imagen">
                                    
                                    <!-- value="QTZXVHFuMDUEAAUxSVZhYShwEzobL1NDFk5gYTUIWE1xDyADA0NRAQ==" -->
                                    <div class="input-group-addon">
                                        <span class="info-text">*Tamaño: 2000 x 665</span><br>
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
                                        <span class="info-text">*Tamaño: 800 x 800</span><br>
                                    </div>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Texto botón:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="textboton" name="textboton" value="">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <div class="form-group col-md-6 col-xs-6">
                                <label>Enlace botón:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-link"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="lboton" name="lboton" value="">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            
                            <div class="form-group col-md-12 col-xs-12">    
                                <label>Contenido:</label>
                                <div class="input-group">          
                                    <div class="adjoined-bottom">
                                        <div class="grid-container">
                                            <div class="grid-width-100">
                                                <div id="editor">
                                                <div class="row content-internas">
                                                      <h2>Nueva Página</h2>
                                                <div class="ul-secundario">
                                                    <ul>
                                                        <li>Lista1</li>
                                                        <li>Lista2</li>
                                                    </ul>
                                                </div>
                                                <div class="row row-buttons" style="margin-left:0px;">
                                                    <a href="#" target="_blank" class="btn btn-green"><img src="/frontend/web/images/download.svg" alt=""> Botón 1</a>
                                                    <a href="#" target="_blank" class="btn btn-green"><img src="/frontend/web/images/download.svg" alt="">Botón 2</a>
                                                    <a href="#" target="_blank" class="btn btn-green"><img src="/frontend/web/images/download.svg" alt="">Botón 3</a>
                                                </div>
                                                <div class="row content-products no-shadow">
                                                    <div class="col-12 d-flex content-buttons-products">
                                                        <div class="row row-requisitos">
                                                        <button onclick="javascript:activarPestania('1');" id="btnlist-1" class="btnlist active">Bloque1</button>
                                                        <button onclick="javascript:activarPestania('2');" id="btnlist-2" class="btnlist">Bloque2 </button>
                                                        <button onclick="javascript:activarPestania('3');" id="btnlist-3" class="btnlist">Bloque3 </button>
                                                        <button onclick="javascript:activarPestania('4');" id="btnlist-4" class="btnlist">Bloque4 </button>
                                                        <button onclick="javascript:activarPestania('5');" id="btnlist-4" class="btnlist">Bloque5</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 d-flex content-info-products">
                                                        <div class="ul-principal ul-requisitos" id="requisitos-1">
                                                        <ul>
                                                            <li>Lista 1</li>
                                                            <li>Lista 2</li>
                                                        </ul>
                                                        </div>
                                                        <div class="ul-principal ul-requisitos" id="requisitos-2" style="display:none;">
                                                        <ul>
                                                            <li>Lista 1</li>
                                                            <li>Lista 2</li>
                                                        </ul>
                                                        
                                                        <ul>
                                                            <li>Lista 1</li>
                                                            <li>Lista 2</li>
                                                        </ul>
                                                        </div>
                                                        <div class="ul-principal ul-requisitos" id="requisitos-3" style="display:none;">
                                                        <ul>
                                                            <li>Lista 1</li>
                                                            <li>Lista 2</li>
                                                        </ul>
                                                        </div>
                                                        <div class="ul-principal ul-requisitos" id="requisitos-4" style="display:none;">
                                                        <ul>
                                                            <li>Lista 1</li>
                                                            <li>Lista 2</li>              
                                                        </ul>
                                                        </div>
                                                        <div class="ul-principal ul-requisitos" id="requisitos-5" style="display:none;">
                                                        
                                                            <strong>Título</strong>
                                                        <ul>
                                                            <li>Lista 1</li>
                                                            <li>Lista 2</li>
                                                        </ul>
                                                        </div>
                                                    </div>
                                                    </div>
                                                 </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <div class="form-group col-md-6 col-xs-6">
                                <label>Tag:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="tag" name="tag">
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

$this->registerCssFile(URL::base() . "/css/chkeditor.css", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);

$this->registerJsFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);

$this->registerJsFile(URL::base() . "/js/class/paginaNew.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);

$this->registerJsFile(URL::base() . "/js/chkeditor.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);
$this->registerJsFile(URL::base() . "/js/chkeditor2.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);
?>


<style>

.adjoined-bottom .grid-width-100
{
    padding-left: 0%;
    padding-right: 0%;
}
.content ul, .content ol, .content pre, .content blockquote, .content textarea:not([class^="cke"]), .content .cke
{
    margin: 0;
}
.content hr {
    border: 0;
    border-top: 1px solid #D9D9D9;
    margin: 1.5em 0;
}

.content input[type="text"] {
    height: auto;
    line-height: 1.8em;
}
    </style>
