<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\Globaldata;
 
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */
$userData = GlobalData::getUserDataById($model->usuariocreacion);
$flagDataMod = false;
 

$this->title = "Ver Proveedor";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trivia-head-view">
    <div class="row">

        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-info-circle"></i>
                    <h3 class="box-title">Información de Proveedor</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Nombre</dt>
                        <dd><?=$model->nombre?></dd>
                        <hr>
                        <dt>Descripción</dt>
                        <dd><?=$model->descripcion?></dd>
                        <hr>
                        <dt>Ruc</dt>
                        <dd><?=$model->ruc?></dd>
                        <hr>
                        <dt>Cargo</dt>
                        <dd><?=$model->cargocontacto?></dd>
                        <hr>
                        <dt>Teléfono</dt>
                        <dd><?=$model->telefono?></dd>
                        <hr>
                        <dt>Provincia</dt>
                        <dd><?=$model->provincia0->nombre?></dd>
                        <hr>
                        <dt>Ciudad</dt>
                        <dd><?=$model->ciudad?></dd>
                        <hr>
                        <dt>Dirección</dt>
                        <dd><?=$model->direccion?></dd>
                        <hr>
                        <dt>Correo</dt>
                        <dd><?=$model->correo?></dd>
                        <hr>
    
                       
                    </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-gear"></i>
                    <h3 class="box-title">Configuración del Proveedor</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
              
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
                        <hr>
                        <dt>Tipo Proveedor:</dt>
                            <dd><?= $model->persona ?></dd>
                      
                    </dl>
                    <hr>
                    <dl class="dl-horizontal">
                        <dt>Creado por:</dt>
                        <dd><?= $userData['nombres'] ?></dd>
                        <dt>Fecha de Creación:</dt>
                        <dd><?= GlobalData::strToMysqlDateFormat($model->fechacreacion, "Y-m-d H:i:s", "d-m-Y H:i:s") ?></dd>
          
                       
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