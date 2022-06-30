<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use app\components\GlobalData;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Actualizar Producto';
$this->params['breadcrumbs'][] = ['label' => 'Administración de Slider', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Combos
$active = "";
$inactive = "";
if ($model->estatus == 'ACTIVO') {
    $active = ' selected="selected" ';
} else {
    $inactive = ' selected="selected" ';
}

$flagLabels = true;
// fechas
//$fullDate = GlobalData::strToMysqlDateFormat($model->fechacreacion, "Y-m-d H:i:s", "d/m/Y h:i A") . " - " . GlobalData::strToMysqlDateFormat($model->fechafin, "Y-m-d H:i:s", "d/m/Y h:i A");
?>
    <input type="hidden" id="action" value="actualizar?id=<?= $model->id ?>">
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
                            <h3 class="box-title">Configuración de Producto</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2" style="width: 100%;" id="estado">
                                            <option <?=$active ?> value="ACTIVO">ACTIVO</option>
                                            <option <?=$inactive ?> value="INACTIVO">INACTIVO</option>
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
                                    <input type="text" class="form-control pull-right" id="nombre" name="nombre" value="<?=$model->nombreproducto?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group">
                                <label>Descripcion:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="descripcion" name="descripcion" value="<?=$model->descripcion?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                           
                            <div class="form-group">
                                <label>Imagen:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <input type="file" class="form-control pull-right" id="image" name="image"  value="<?=$model->imagen?>"  accept="image/png, image/jpeg">
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
                            <h3 class="box-title">Información de Producto</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <dl class="dl-horizontal">
                                <dt>Nombre</dt>
                                <dd><?=$model->nombreproducto?></dd>
                                <hr>
                                <dt>Descripción</dt>
                                <dd><?=$model->descripcion?></dd>
                                 
                                <hr>
                                <dt>Imagen</dt>
                                <dd><img  class="slider-web"  src="/frontend/web/images/articulos/<?=$model->imagen ?>" /></dd>
                                <hr>
                                
                                
                                <dt>Estado:</dt>
                                <dd>
                                    <?php if ($model->estatus == 'ACTIVO') { ?>
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

$this->registerJsFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);

$this->registerJsFile(URL::base() . "/js/class/sliderNew.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);



