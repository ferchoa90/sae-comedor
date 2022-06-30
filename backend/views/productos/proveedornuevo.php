<?php



use yii\helpers\Html;

use yii\helpers\Url;

use yii\web\View;
/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Crear Proveedor';
$this->params['breadcrumbs'][] = ['label' => 'Administración de Proveedor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
    <input type="hidden" id="action" value="nuevo">
    
    <input type="hidden" id="id" value="0">
    <div class="trivia-head-create">
        <div class="box-body">
            <a class="btn btn-success" id="btn_save"><i class="fa fa-save"></i>&nbsp; Guardar</a>
        </div>
        <div class="box-body" id="messages" style="display:none;"></div>
        <form class="" method="POST" id="formSlider" enctype="multipart/form-data">
        <div class="box-body">
            <div class="row">
                <div class="col-md-7 col-xs-7">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Configuración de Proveedor</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2" style="width: 100%;" id="estado">
                                            <option selected="selected" value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Tipo Proveedor</label>
                                        <select class="form-control select2" style="width: 100%;" name="persona" id="persona">
                                            <option>Seleccione tipo</option>
                                            <option value="PERSONA NATURAL">PERSONA NATURAL</option>
                                            <option value="JURÍDICA">JURÍDICA</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                </div>
                                
                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="box box-default">
                        <div class="box-body">
                            <!-- Date and time range -->
                            
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Ruc:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-tablet"></i>
                                    </div>
                                    <input type="text" placeholder="Ej: 0999999999001" class="form-control pull-right" id="ruc" name="ruc">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Nombre:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text"  placeholder="Ej: Mi Comisariato"  class="form-control pull-right" id="nombre" name="nombre">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Descripcion:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text"  placeholder="Ej: Proveedor principal"  class="form-control pull-right" id="descripcion" name="descripcion">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Contacto:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <input type="text"  placeholder="Ej: Pablo Pérez"  class="form-control pull-right" id="contacto" name="contacto">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->      
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Cargo:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <input type="text"  placeholder="Ej: Supervisor"  class="form-control pull-right" id="cargo" name="cargo">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->     
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Teléfono:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-fax"></i>
                                    </div>
                                    <input type="text"  placeholder="Ej: 0988866553"  class="form-control pull-right" id="telefono" name="telefono">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->         
                            <div class="form-group col-md-6 col-xs-6">
                                <!-- Date and time range -->
                                <label>Provincia:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-inbox"></i>
                                    </div>
                                    <select class="form-control select2" style="width: 100%;" id="provincia">
                                        <option >Seleccione la provincia</option>
                                        <?php foreach ($provincia as $key => $value) { ?>
                                            <option value="<?=$value->id ?>"><?=$value->nombre ?></option>
                                        <?php } ?>
                                    </select>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->    
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Ciudad:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-bars"></i>
                                    </div>
                                    <input type="text"  placeholder="Ej: Guayaquil"  class="form-control pull-right" id="ciudad" name="ciudad">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->     
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Dirección:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-building"></i>
                                    </div>
                                    <input type="text"  placeholder="Ej: Av Principal y secundaria."  class="form-control pull-right" id="direccion" name="direccion">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                            <div class="form-group col-md-6 col-xs-6">
                                <label>Correo:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="text"  placeholder="Ej: micorreo@correo.com"  class="form-control pull-right" id="correo" name="correo">
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                          
                            <input type="hidden" id="token" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">
                            
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
        </div>
        </form>
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

$this->registerJsFile(URL::base() . "/js/class/productosproveedorNew.js", [
    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]
]);



