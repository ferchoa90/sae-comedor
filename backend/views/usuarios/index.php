<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = "Administración de Usuarios";
$this->params['breadcrumbs'][] = $this->title;

$flagIndex = 'false';
if (strpos($_SERVER['REQUEST_URI'], 'index') !== false) {
    $flagIndex = 'true';
}

$urls = explode("/", str_replace('/index', '', $_SERVER['REQUEST_URI']));
$partes = count($urls) - 1;

?>
    <!-- ========================================================================================================== -->
    <!-- Trvia box -->
    <input type="hidden" id="urlflag" value="<?= $flagIndex ?>">
    <input type="hidden" id="urlself" value="<?= $urls[$partes] ?>">
    <input type="hidden" id="token" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->getCsrfToken() ?>">
    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-plus']) . ' ', ['nuevo'], ['class' => 'btn btn-primary', "title" => "Agregar Usuario"]) ?>
    <br>
    <br>
    <div class="card">

            <div class="card-body">
                <table id="table_usuarios" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="tableheader">
                        <th style="width:40px">#</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Nombre Usuario</th>
                        <th>Correo</th>
                        <th>Perfil</th>
                        <th>Fecha Creación</th>
                        <th>Estado</th>
                        <th>&nbsp;Acciones&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div><!-- /.box-body -->

    </div>
<?php
$this->registerJsFile(URL::base() . "/js/class/usuariosAdmin.js", [
    'depends' => [ // \yii\bootstrap\BootstrapPluginAsset::className()
    ]
]);