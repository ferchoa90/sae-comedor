<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\Globaldata;
use backend\models\Slider;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */
//$userData = GlobalData::getUserDataById($model->creado_por);
$flagDataMod = false;
if (!empty($model->modificado_por)) {
    $flagDataMod = true;
    $userDataMod = GlobalData::getUserDataById($model->modificado_por);
}

$this->title = "Ver Cajero";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Cajero', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trivia-head-view">
    <div class="row">

        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-info-circle"></i>
                    <h3 class="box-title">Información de la Cajero</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Nombre</dt>
                        <dd><?=$model->nombre?></dd>
                        <hr>
                        <dt>Provincia</dt>
                        <dd><?=$model->provincia->nombre?></dd>
                        <hr>
                        <dt>Direccion</dt>
                        <dd><?=$model->direccion?></dd>
                        <hr>
                        <dt>Ciudad</dt>
                        <dd><?=$model->ciudad?></dd>
                        <hr>
                        <dt>Teléfono</dt>
                        <dd><?=$model->descripcion?></dd>
                        <hr>
                        <dt>Lat</dt>
                        <dd><?=$model->lat?></dd>
                        <hr>
                        <dt>Long</dt>
                        <dd><?=$model->long?></dd>
                        <hr>
                        
                    </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-gear"></i>
                    <h3 class="box-title">Configuración de la Cajero</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        
                        <dt>Texto Horario 1</dt>
                        <dd><?=$model->horario?></dd>
                        <hr>
                        <dt>Texto Horario 2</dt>
                        <dd><?=$model->horario2?></dd>
                        <hr>
                        <dt>Texto Horario 3</dt>
                        <dd><?=$model->horario3?></dd>
                        <hr>
                        <dt>Tiempo</dt>
                        <dd><?=$model->tiempo?></dd>
                        <hr>
                        <dt>Tiempo 2</dt>
                        <dd><?=$model->tiempo2?></dd>
                        <hr>
                        <dt>Tiempo 3</dt>
                        <dd><?=$model->tiempo3?></dd>
                        <hr>

                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Estado:</dt>
                        <dd>
                            <?php if ($model->estado == 'ACTIVO') { ?>
                                <span class="label label-success"><i class="fa fa-circle"></i>&nbsp; <?= $model->estado ?></span>
                            <?php } else {
                                ?>
                                <span class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; <?= $model->estado ?></span>
                            <?php } ?>
                        </dd>
                      
                    </dl>
                    <hr>
                    <dl class="dl-horizontal">
                        <dt>Creado por:</dt>
                        <dd> </dd>
                        <dt>Fecha de Creación:</dt>
                        <dd><?= $model->fechacreacion ?></dd>
                        <dt>Modificado por:</dt>
                        <dd><?= ($flagDataMod) ? $userDataMod['fullname'] : " - "; ?></dd>
                        <dt>Fecha de Modificación:</dt>
                        <dd><?= ($flagDataMod) ? GlobalData::strToMysqlDateFormat($model->fecha_modificacion, "Y-m-d H:i:s", "d-m-Y H:i:s") : " - "; ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box --> 
        </div><!-- ./col -->
        
    </div>
</div>
<style>
.btn-primary
{
    padding-top: 2px;
    padding-bottom: 2px;
}
</style>