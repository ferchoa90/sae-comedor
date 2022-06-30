<?php
use backend\components\Objetos;
use backend\components\Botones;
use backend\components\Bloques;
use backend\components\Grid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use backend\assets\AppAsset;
/* @var $this yii\web\View */

$botones= new Botones;
$this->title = "Administración de Usuarios";
?>
<div class="row col-12 p-2" >
<?php
echo $botones->getBotongridArray(
    array(array('tipo'=>'link','nombre'=>'ver', 'id' => 'new', 'titulo'=>' Agregar', 'link'=>'nuevousuario', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'nuevo','tamanio'=>'pequeño',  'adicional'=>'')));

?>
</div>
<?php
$this->params['breadcrumbs'][] = $this->title;

$grid= new Grid;

$columnas= array(
    array('columna'=>'#', 'datareg' => 'num', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Nombre', 'datareg' => 'nombres', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Apellidos', 'datareg' => 'apellidos', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'N. Usuario', 'datareg' => 'username', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Perfil', 'datareg' => 'perfil', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Correo', 'datareg' => 'email', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Cédula', 'datareg' => 'cedula', 'clase'=>'', 'estilo'=>'', 'ancho'=>''),
    array('columna'=>'Fecha C.', 'datareg' => 'fechacreacion', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Estatus', 'datareg' => 'estatus', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
    array('columna'=>'Acciones', 'datareg' => 'acciones', 'clase'=>'', 'estilo'=>'', 'ancho'=>'')  ,
);

echo $grid->getGrid(
        array(
            array('tipo'=>'datagrid','nombre'=>'table','id'=>'table','columnas'=>$columnas,'clase'=>'','style'=>'','col'=>'','adicional'=>'','url'=>'usuariosreg')
        )
);
?>