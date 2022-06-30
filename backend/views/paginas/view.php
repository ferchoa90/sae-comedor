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
  //  $userDataMod = GlobalData::getUserDataById($model->modificado_por);
}

$this->title = "Ver Página";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Página', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trivia-head-view">
    <div class="row">

        <div class="col-md-6">
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
                        
                    </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-gear"></i>
                    <h3 class="box-title">Configuración del Slider</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                   
                    <dl class="dl-horizontal">
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
    
                        <dt>Link</dt>
                        <dd><?php if ($model->id>29){ ?><a target="_blank" href="http://cpn.fin.ec/frontend/web/site/pagina?tag=<?=$model->tag?>">Ver Página </a> <?php  } else{  ?><a target="_blank" href="http://cpn.fin.ec/frontend/web/site/<?=$model->tag?>"> Ver Página</a> <?php   } ?></dd>
                        
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