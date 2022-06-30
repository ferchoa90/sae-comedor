<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Administración de Descargas";
$this->params['breadcrumbs'][] = $this->title;

$flagIndex = 'false';

if (strpos($_SERVER[REQUEST_URI], 'index') !== false) {
    $flagIndex = 'true77888u';
}

$urls = explode("/", str_replace('/index', '', $_SERVER[REQUEST_URI]));
$partes = count($urls) - 1;

?>
    <!-- ========================================================================================================== -->
    <!-- Trvia box -->
    <input type="hidden" id="urlflag" value="<?= $flagIndex ?>">
    <input type="hidden" id="urlself" value="<?= $urls[$partes] ?>">
    <input type="hidden" id="token" value="<?= Yii::$app->request->getCsrfToken() ?>">
    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-plus']) . '&nbsp; Agregar Descarga', ['nuevadescarga'], ['class' => 'btn btn-primary']) ?>
<br>
<br>
    <div class="box">
        <div class="box-body">
            <div class="box-body">
                <table id="table_slider" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="tableheader">
                        <th style="width:40px">#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Página</th>
                        <th>Tipo</th>                      
                        <th>Vista</th>                      
                        <th>Superior</th>                                         
                        <th style="width:45px">Orden</th>
                        <th>Fecha Creación</th>
                        <th>Estado</th>
                        <th style="width:95px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
<?php
$this->registerJsFile(URL::base() . "/js/class/libreriaAdmin.js", ['depends' => [ \yii\bootstrap\BootstrapPluginAsset::className()]
]);







