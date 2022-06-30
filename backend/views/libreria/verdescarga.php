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
    //$userDataMod = GlobalData::getUserDataById($model->modificado_por);
}

$this->title = "Ver Descarga";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Slider', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trivia-head-view">
    <div class="row">

        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-info-circle"></i>
                    <h3 class="box-title">Información de Descargable</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Nombre</dt>
                        <dd><?=$model->nombre?></dd>
                        <hr>
                        <dt>Archivo</dt>
                        <dd><?=$model->archivo?></dd>
                        <hr>
                        <dt>Página</dt>
                        <dd>Tranparencia</dd>
                        <hr>
                        <dt>Tipo</dt>
                        <dd><?=$model->tipo?></dd>
                        <hr>
                        <dt>Vista</dt>
                        <dd><?=$model->vista?></dd>
                        <hr>
                        <dt>Superior</dt>
                        <dd><?=$model->superior?></dd>
                        <hr>
                       
                    </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-gear"></i>
                    <h3 class="box-title">Configuración de la Descarga</h3>
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
                        <dd><?//= $userData['fullname'] ?></dd>
                        <dt>Fecha de Creación:</dt>
                        <dd><?= GlobalData::strToMysqlDateFormat($model->fechacreacion, "Y-m-d H:i:s", "d-m-Y H:i:s") ?></dd>
                        <dt>Modificado por:</dt>
                        <dd><?= ($flagDataMod) ? $userDataMod['fullname'] : " - "; ?></dd>
                        <dt>Fecha de Modificación:</dt>
                        <dd><?= ($flagDataMod) ? GlobalData::strToMysqlDateFormat($model->fecha_modificacion, "Y-m-d H:i:s", "d-m-Y H:i:s") : " - "; ?></dd>
                        <dt>Link</dt>
                        <dd><?= '<a target="_blank" href="http://cpn.fin.ec/frontend/web/pdf/'.$model->archivo.'">Ver / Descargar Archivo </a>'; ?></dd>

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