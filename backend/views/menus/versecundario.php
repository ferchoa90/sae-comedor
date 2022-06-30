<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\Globaldata;
use backend\models\Submenu;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */
$userData = GlobalData::getUserDataById($model->creado_por);
$flagDataMod = false;
if (!empty($model->modificado_por)) {
    $flagDataMod = true;
    $userDataMod = GlobalData::getUserDataById($model->modificado_por);
}

$this->title = "Ver Menú Secundario";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Menús', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trivia-head-view">
    <div class="row">

        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-info-circle"></i>
                    <h3 class="box-title">Información de Menú secundario</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Nombre</dt>
                        <dd><?=$model->nombre?></dd>
                        <hr>
                        <dt>Descripción</dt>
                        <dd><?=$model->descripcion?></dd>
                        <hr>
                        <dt>Menú</dt>
                        <dd><?=$model->menu->nombre?></dd>
                        <hr>
                        <dt>Parent</dt>
                        <dd><?php
                            if ($model->idparent==0){ echo 'Principal';}else{ 
                                $secundario= Submenu::find()->where(['id'=>$model->idparent,'isDeleted' => '0'])->one();
                                echo $secundario["nombre"];
                             }
                        ?></dd>
                        <hr>
                        <dt>Enlace</dt>
                        <dd><?=$model->link?></dd>
                        <hr>
                    </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-gear"></i>
                    <h3 class="box-title">Configuración del Menú secundario</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Orden:</dt>
                        <dd><?= $model->orden ?></dd>
                      
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>Estado:</dt>
                        <dd>
                            <?php if ($model->estado == 'Activo') { ?>
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
                        <dd><?= $userData['fullname'] ?></dd>
                        <dt>Fecha de Creación:</dt>
                        <dd><?= GlobalData::strToMysqlDateFormat($model->fechacreacion, "Y-m-d H:i:s", "d-m-Y H:i:s") ?></dd>
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