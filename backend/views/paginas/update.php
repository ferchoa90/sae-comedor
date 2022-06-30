<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use backend\assets\AppAsset;
use app\components\GlobalData;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Actualizar Página';
$this->params['breadcrumbs'][] = ['label' => 'Administración de Páginas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Combos
$active = "";
$inactive = "";
if ($model->estatus == 'Activo') {
    $active = ' selected="selected" ';
} else {
    $inactive = ' selected="selected" ';
}

$script = <<< JS
$(document).ready(function () {       
    jQuery(document).ready(function ($) {
        
        initSample();
          



    });
});
JS;
$this->registerJs($script, View::POS_END);
AppAsset::register($this);
// fechas
//$fullDate = GlobalData::strToMysqlDateFormat($model->fechacreacion, "Y-m-d H:i:s", "d/m/Y h:i A") . " - " . GlobalData::strToMysqlDateFormat($model->fechafin, "Y-m-d H:i:s", "d/m/Y h:i A");
?>
    <input type="hidden" id="action" value="update?id=<?= $model->id ?>">
    <div class="trivia-head-create">
        <div class="box-body">
            <a class="btn btn-success" id="btn_update"><i class="fa fa-save"></i>&nbsp; Guardar</a>
        </div>
        <div class="box-body" id="messages" style="display:none;"></div>
        <div class="box-body">
            <div class="row">
                <form class="" method="POST" id="formSlider" enctype="multipart/form-data">
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
                                            <option <?=$active ?> value="Activo">Activo</option>
                                            <option <?=$inactive ?> value="Inactivo">Inactivo</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                        <div class="box-body">
                            <!-- Date and time range -->
                            
                            <div class="form-group">
                                <label>Nombre:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="nombre" name="nombre" value="<?=$model->nombre?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group">
                                <label>Título:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="titulo" name="titulo" value="<?=$model->titulo?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group">
                                <label>Título Slider:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="titslider" name="titslider" value="<?=$model->tituloslider?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group">
                                <label>Texto Slider:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="textslider" name="textslider" value="<?=$model->textoslider?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            
                            <div class="form-group">
                                <label>Imagen:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <input type="file" class="form-control pull-right" id="image" name="image"    accept="image/png, image/jpeg">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group">
                                <label>Imagen Responsive:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <input type="file" class="form-control pull-right" id="imageresponsive" name="imageresponsive"  accept="image/png, image/jpeg">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group">
                                <label>Botón Texto:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="textboton" name="textboton" value="<?=$model->botontexto?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            

                            <div class="form-group">
                                <label>Link botón:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="lboton" name="lboton" value="<?=$model->linkboton?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group">
                                <label>Tag:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="tag" name="tag" value="<?=$model->tag?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group">    
                                <label>Contenido:</label>
                                <div class="input-group">          
                                    <div class="adjoined-bottom">
                                        <div class="grid-container">
                                            <div class="grid-width-100">
                                                <div id="editor">
                                                    <?= $model->contenido ?>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            
                            <input type="hidden" id="token" value="<?= Yii::$app->request->getCsrfToken() ?>">
                           
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                <div class="col-md-6 col-xs-6">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <i class="fa fa-info-circle"></i>
                            <h3 class="box-title">Información de Página</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <dl class="dl-horizontal">
                            <dt>Nombre</dt>
                        <dd><?=$model->nombre?></dd>
                        <hr>
                        <dt>Título</dt>
                        <dd><?=$model->titulo?></dd>
                        <hr>
                        
                        <dt>Título Slider</dt>
                        <dd><?=$model->tituloslider?></dd>
                        <hr>
                        <dt>Texto Slider</dt>
                        <dd><?=$model->textoslider?></dd>
                        <hr>
                        <dt>Imagen</dt>
                        <dd><img class="slider-web" src="/frontend/web/images/<?=$model->imagen ?>" /></dd>
                        <hr>
                        <dt>Imagen Móvil</dt>
                        <dd><img class="slider-movil" src="/frontend/web/images/<?=$model->imagenresponsive ?>" /></dd>
                        <hr>
                        <dt>Botón</dt>
                        <dd><?=$model->botontexto?></dd>
                        <hr>
                        <dt>Link Botón</dt>
                        <dd><?=$model->linkboton?></dd>
                        <hr>

                        <dt>Tag</dt>
                        <dd><?=$model->tag?></dd>
                        <hr>
                                <dt>Estado:</dt>
                                <dd>
                                    <?php if ($model->estatus == 'Activo') { ?>
                                        <span class="label label-success"><i class="fa fa-circle"></i>&nbsp; <?= $model->estatus ?></span>
                                    <?php } else {
                                        ?>
                                        <span class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; <?= $model->estatus ?></span>
                                    <?php } ?>
                                </dd>
                      
      
                            </dl>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div> 
                </form>
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
.input-group
{
    width: 100%;
}
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