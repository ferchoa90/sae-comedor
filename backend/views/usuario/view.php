<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\GlobalData;
use app\models\ConfigEquipos;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$iconNone = "https://www.gstatic.com/onebox/sports/logos/inverse-crest.svg";

$this->title = "Ver Registro";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="trivia-head-view">

    <p>
 
    </p>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-body">
                <div class="box-header with-border">
                    <i class="fa fa-gear"></i>
                    <h3 class="box-title">Perfil de Usuario</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt>Fecha de Creación:</dt>
                        <dd><?= GlobalData::strToMysqlDateFormat($model->fecha_creacion, "Y-m-d H:i:s", "d-m-Y H:i:s") ?></dd>
                        <dt>Perfil de Usuario:</dt>
                        <dd><strong style="color: #0062cc;"><?= $model->type; ?></strong></dd>
                        <dt>Usuario Premium:</dt>
                        <dd><strong style="color: #0062cc;"><?= $model->suscripcion; ?></strong></dd>
                        <dt>Estado:</dt>
                        <dd>
                            <?php if ($model->estado == 'ACTIVO') { ?>
                                <span class="label label-success"><i class="fa fa-circle"></i>&nbsp; <?= $model->estado ?></span>
                            <?php } else {
                                ?>
                                <span class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; <?= $model->estado ?></span>
                            <?php } ?>
                        </dd>
                        <hr>
                        <dt>Notificaciones:</dt>
                        <dd>
                            <?php if (!empty($model->notificaciones)) { ?>
                                <span class="label label-success"><i class="fa fa-circle"></i>&nbsp;ACTIVADO</span>
                            <?php } else { ?>
                                <span class="label label-warning"><i class="fa fa-circle-thin"></i>&nbsp;INACTIVO</span> -
                                <span class="label label-default">El dispositivo no autorizó las notificaciones.</span>
                            <?php } ?>
                        </dd>
                    </dl>
                    <hr>
                    <dl class="dl-horizontal">
                        <dt>Identificación:</dt>
                        <dd><?= $model->identificacion ?></dd>
                        <dt>Nombre Completo:</dt>
                        <dd><?= $model->fullname ?></dd>
                        <dt>Username:</dt>
                        <dd><?= $model->username ?></dd>
                        <dt>Teléfono:</dt>
                        <dd><?= $model->phone_number ?></dd>
                        <dt>Uid:</dt>
                        <dd><?= $model->uid ?></dd>
                    </dl>
                    <hr>
                    <dl class="dl-horizontal">
                        <dt>Fecha Nacimiento:</dt>
                        <dd><?= GlobalData::strToMysqlDateFormat($model->fecha_nacimiento, "Y-m-d", "d-m-Y") ?></dd>
                        <dt>Edad:</dt>
                        <dd>
                            <?php
                            $fecha_nacimiento = GlobalData::strToMysqlDateFormat($model->fecha_nacimiento, "Y-m-d", "Y");
                            $fecha_actual = date("Y");

                            echo $fecha_actual - $fecha_nacimiento;
                            ?>
                        </dd>
                    </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-info-circle"></i>
                    <h3 class="box-title">Configuración de equipos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php foreach ($modelEquipos as $key => $value): ?>
                        <div class="col-xs-12 col-sm-6" style="text-align: center;">
                            <?php $equipos = ConfigEquipos::find()->where(["id" => $value->id_equipo])->one(); ?>
                            <span style="white-space: nowrap;"><?= $value->name ?></span>
                            <div class="team-left">
                                <img style="width: 61px;" src="<?= URL::base() ?>/images/teams/<?= $equipos->img_local ?>">
                            </div>
                        <br>
                        </div>
                    <?php endforeach; ?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->
    </div>

</div>
