<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\GlobalData;
use app\models\QuinielaGames;
use app\models\QuinielaTeam;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$userData = GlobalData::getUserDataById($model->creado_por);
$flagDataMod = false;
if (!empty($model->modificado_por)) {
    $flagDataMod = true;
    $userDataMod = GlobalData::getUserDataById($model->modificado_por);
}

$this->title = "Ver Partidos";
$this->params['breadcrumbs'][] = ['label' => 'Vista Individual Pronóstico', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="trivia-head-view">

   

    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-gear"></i>
                    <h3 class="box-title">Configuración Pronóstico</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Estado:</dt>
                        <dd>
                            <?php if ($model->status == 'ACTIVE') { ?>
                                <span class="label label-success"><i class="fa fa-circle"></i>&nbsp; <?= $model->status ?></span>
                            <?php } else {
                                ?>
                                <span class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; <?= $model->status ?></span>
                            <?php } ?>
                        </dd>
                       
                        <dt>Acceso premium:</dt>
                        <!-- <dd><?//= $model->user_acceso ?></dd> -->
                    </dl>
                    <hr>
                    <dl class="dl-horizontal">
                        <dt>Creado por:</dt>
                        <dd><?= $userData['fullname'] ?></dd>
                        <dt>Fecha de Creación:</dt>
                        <dd><?= GlobalData::strToMysqlDateFormat($model->fecha_creacion, "Y-m-d H:i:s", "d-m-Y H:i:s") ?></dd>
                        <dt>Modificado por:</dt>
                        <dd><?= ($flagDataMod) ? $userDataMod['fullname'] : " - "; ?></dd>
                        <dt>Fecha de Modificación:</dt>
                        <dd><?= ($flagDataMod) ? GlobalData::strToMysqlDateFormat($model->fecha_modificacion, "Y-m-d H:i:s", "d-m-Y H:i:s") : " - "; ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-info-circle"></i>
                    <h3 class="box-title">Información de Pronóstico</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Fecha de incio:</dt>
                        <dd><?= GlobalData::strToMysqlDateFormat($model->fechainicio, "Y-m-d H:i:s", "d-m-Y H:i:s") ?></dd>
                        <dt>Fecha final:</dt>
                        <dd><?= GlobalData::strToMysqlDateFormat($model->fechafin, "Y-m-d H:i:s", "d-m-Y H:i:s") ?></dd>
                        <hr>
                        <dt>Mensaje y premio:</dt>
                        <dd><?= $model->mensaje1 ?></dd>
                        <hr>
                        <dt>Nombre:</dt>
                        <dd><?= $model->promo ?></dd>
                    
                         
                    </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->

        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-info-circle"></i>
                    <h3 class="box-title">Partidos &nbsp; &nbsp; &nbsp; <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <?php foreach ($partidosDetail as $key => $value) { ?>
                            <?php $team = QuinielaTeam::find()->where(["id"=>$value->idteam,"status"=>"ACTIVE"])->one(); ?>
                            <?php $team2 = QuinielaTeam::find()->where(["id"=>$value->idteam2,"status"=>"ACTIVE"])->one(); ?>
                            
                            <div class="col-md-3" style="padding-bottom:10px;padding-top:10px; border: 1px dashed #3c8dbc;     min-height: 111px;">
                                <div class="col-md-5" style="text-align:center;">
                                    <img src="<?=URL::base().'/images/teams/'.$team->img ?>" width="48px"  alt=""/> 
                                    <div style="text-align:center;"><?=$team->team?></div>
                                </div>
                                <div class="col-md-1" style="text-align:center;"> <span style="vertical-align: middle;"><b>VS</b></span> </div>
                                <div class="col-md-5" style="text-align:center;">                                
                                    <img src="<?=URL::base().'/images/teams/'.$team2->img ?>" width="48px"  alt=""/>
                                    <div style="text-align:center;"><?=$team2->team?></div>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <!-- partidosDetail -->
                            
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