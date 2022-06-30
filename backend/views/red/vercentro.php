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

$this->title = "Ver Centro Médico";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Centros Médicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trivia-head-view">
    <div class="row">

        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-info-circle"></i>
                    <h3 class="box-title">Información del Centro médico</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Nombre</dt>
                        <dd><?=$model->nombre?></dd>
                        <hr>
                        <dt>Provincia</dt>
                        <dd><?=$model->provincia->nombre?></dd>
                        <hr>
                        <dt>Tipo</dt>
                        <dd><?=$model->tipo->nombre?></dd>
                        <hr>
                    </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-gear"></i>
                    <h3 class="box-title">Configuración del Centro Médico</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Orden:</dt>
                        <dd><?= $model->orden ?></dd>
                      
                    </dl>
                    <dl class="dl-horizontal">
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