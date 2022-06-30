<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Editar usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
    <input type="hidden" id="action" value="update?id=<?= $model->id ?>">
    <input type="hidden" id="id" value="0">
    <div class="trivia-head-create">
        <div class="box-body">
            <a class="btn btn-success" id="btn_update"><i class="fa fa-save"></i>&nbsp; Actualizar</a>
        </div>
        <div class="box-body" id="messages" style="display:none;"></div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-9 col-xs-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Configuración de Usuario</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2" style="width: 100%;" id="estado">
                                            <option  <?php if ($model->estatus=="Activo"){ echo 'selected="selected"'; } ?>  value="Activo">Activo</option>
                                            <option  <?php if ($model->estatus=="Inactivo"){ echo 'selected="selected"'; } ?> value="Inactivo">Inactivo</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Perfil de Usuario</label>
                                        <select class="form-control select2" style="width: 100%;" id="tipo">
                                                <option <?php if ($model->tipo=="Administrador"){ echo 'selected="selected"'; } ?> value="Administrador">Administrador</option>
                                                <option <?php if ($model->tipo=="Usuario"){ echo 'selected="selected"'; } ?>  value="Usuario">Cliente</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sucursal</label>
                                        <select class="form-control select2" style="width: 100%;" id="sucursal">
                                            <option >seleccione...</option>
                                            <?php $cont=0; foreach ($sucursal as $key => $value) { ?>
                                                <option value="<?=$value->id ?>" <?php if($model->idsucursal==$value->id){ echo 'selected="selected" ';  } ?>  ><?=$value->nombre ?></option>
                                            <?php $cont++; } ?>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Usuario</h3>
                        </div> 
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label>Creado por: </label>
                                <?= Yii::$app->user->identity->nombres.' '.Yii::$app->user->identity->apellidos ?>
                            </div> 
                        </div> 
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <div class="box box-primary">
                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Nombres:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="nombres" value="<?= $model->nombres ?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->
                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Apellidos:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right"  value="<?= $model->apellidos ?>" id="apellidos">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->
                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Nombre de Usuario:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="nusuario"  value="<?= $model->username ?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->
                        <div class="box-body box-int col-md-6 col-xs-6">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Contraseña:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input type="password" class="form-control pull-right" id="contrasenia"  value="">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Correo:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-at"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="correo"  value="<?= $model->email ?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->

                        <div class="box-body">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <label>Cédula:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="hidden" id="token" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">
                                    <input type="text" class="form-control pull-right" id="cedula"  value="<?= $model->cedula ?>">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    
                </div>
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
$this->registerJsFile(URL::base() . "/js/class/usuariosNew.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);
