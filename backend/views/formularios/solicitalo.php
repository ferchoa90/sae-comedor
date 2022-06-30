<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Visor de Formularios - Contáctenos";
$this->params['breadcrumbs'][] = $this->title;

$flagIndex = 'false';

if (strpos($_SERVER[REQUEST_URI], 'index') !== false) {
    $flagIndex = 'true';
}

$urls = explode("/", str_replace('/index', '', $_SERVER[REQUEST_URI]));
$partes = count($urls) - 1;

?>
    <!-- ========================================================================================================== -->
    <!-- Trvia box -->
    <input type="hidden" id="urlflag" value="<?= $flagIndex ?>">
    <input type="hidden" id="urlself" value="<?= $urls[$partes] ?>">
    <input type="hidden" id="token" value="<?= Yii::$app->request->getCsrfToken() ?>">
    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-file-excel-o']) . '&nbsp; Exportar a CSV', ['export?encuesta=solicitalo'], ['class' => 'btn btn-success']) ?>

   <br>
<br>
    <div class="box">
        <div class="box-body">
            <div class="box-body">
                <table id="table_formularios" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="tableheader">
                        <th style="width:40px">#</th>
                        <th>Nombres</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th>Provincia</th>
                        <th>id</th>
                        <th>Fecha Creación</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
<?php
$this->registerJsFile(URL::base() . "/js/class/solicitaloAdmin.js", ['depends' => [ \yii\bootstrap\BootstrapPluginAsset::className()]
]);







