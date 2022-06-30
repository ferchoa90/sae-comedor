<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\Globaldata;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$iconNone = "https://www.gstatic.com/onebox/sports/logos/inverse-crest.svg";
$this->title = "Ver Registro";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="trivia-head-view">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Perfil de Usuario</h3>
                </div>
                <div class="card-body">
                    <dl class="dl-horizontal">
                        <dt>Fecha de Creación:</dt>
                        <dd><?= GlobalData::strToMysqlDateFormat($model->fechacreacion, "Y-m-d H:i:s", "d-m-Y H:i:s") ?></dd>
                        <dt>Perfil de Usuario:</dt>
                        <dd><strong style="color: #0062cc;"><?= $model->tipo; ?></strong></dd>                  
                        <dt>Estado:</dt>
                        <dd>
                            <?php if ($model->estatus == 'Activo') { ?>
                                <span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; <?= $model->estatus ?></span>
                            <?php } else {
                                ?>
                                <span class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; <?= $model->estatus ?></span>
                            <?php } ?>
                        </dd>
                        <hr>                       
                    </dl>
                    <hr>
                    <dl class="dl-horizontal" style="line-height: 25px;">
                        <dt>Identificación: <span style="font-weight:normal"><?= $model->cedula ?></span></dt>
                        
                        <dt>Nombres:  <span style="font-weight:normal"><?= $model->nombres ?></span></dt>
                        <dt>Apellidos: <span style="font-weight:normal"><?= $model->apellidos ?></dt>
                        <dt>Correo: <span style="font-weight:normal"><?= $model->email ?></dt>
                        <dt>Usuario: <span style="font-weight:normal"><?= $model->username ?></dt>
                        <dt>Password: <span style="font-weight:normal">*****</dt>
                        <dt>Sucursal: <span style="font-weight:normal"><?= $model->sucursal->nombre ?></dt>
                    </dl>
                    <hr>
                    <dl class="dl-horizontal">
                       
                    </dl>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->
        <div class="col-md-4">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Ultimos movimientos</h3>
                </div>
              
                <div class="card-body">
                 No se encuentran registros
               </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- ./col -->
    </div>
</div>

