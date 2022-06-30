<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use backend\components\Contenido;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver producto";
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['/']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;
$div2= new Bloques;

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')
));


$contenidoClass= new contenido;
$contenido=$contenidoClass->getContenidoArrayr(
        array(
            array('tipo'=>'div','nombre'=>'id', 'id' => 'id', 'titulo'=>'ID:','contenido'=>$model->id,'clase'=>'', 'style'=>'', 'col'=>'col-12 col-md-12', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
            array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
            array('tipo'=>'div','nombre'=>'nombre', 'id' => 'nombre', 'titulo'=>'Nombre:','contenido'=>$model->nombreproducto, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
            array('tipo'=>'div','nombre'=>'desc', 'id' => 'desc', 'titulo'=>'Descripción:','contenido'=>$model->descripcion, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        )
    );

if ($model->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
$estatus='<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$model->estatus.'</span>';
$contenido2=$contenidoClass->getContenidoArrayr(
    array(
        array('tipo'=>'div','nombre'=>'nombre', 'id' => 'nombre', 'titulo'=>'Estatus:&nbsp;&nbsp;','contenido'=>$estatus, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'image','nombre'=>'preview', 'id' => 'preview', 'src'=>$model->imagen,'clase'=>'pb-3 pr-3', 'style'=>'border: 1px dashed #c6c6c6;', 'col'=>'col-12 col-md-12',  'etiqueta'=>' IMAGEN' ,  'adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'div','nombre'=>'fechac', 'id' => 'fechac', 'titulo'=>'Fecha C:','contenido'=>$model->fechacreacion, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'div','nombre'=>'usuarioc', 'id' => 'usuarioc', 'titulo'=>'Usuario C:','contenido'=>$model->usuariocreacion0->username, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'div','nombre'=>'fechaa', 'id' => 'fechaa', 'titulo'=>'Fecha M:','contenido'=>$model->fechaact, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'div','nombre'=>'usuarioa', 'id' => 'usuarioa', 'titulo'=>'Usuario M:','contenido'=>$model->usuarioactualizacion0->username, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
    )
);

 $tabla='';

 $bloque1=$div->getBloqueArr(
    array(
        array('tipo'=>'bloquediv','nombre'=>'bloque1','id'=>'bloque1','titulo'=>'Datos','clase'=>'col-md-12 col-xs-12 p-0 mb-3','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido),
        array('tipo'=>'bloquediv','nombre'=>'bloque2','id'=>'bloque2','titulo'=>'Inventario','clase'=>'col-md-12 col-xs-12 p-0 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>''),
    )
);
 
echo '<div class="row">';
 $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'dvcontent','id'=>'dvcontent','titulo'=>'','clase'=>'col-md-8 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','cardbody'=>'NONE','shadows'=>'NONE','contenido'=>$bloque1.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'dvcontent2','id'=>'dvcontent2','titulo'=>'Información','clase'=>'col-md-4 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
        //array('tipo'=>'bloquediv','nombre'=>'dvcontent3','id'=>'dvcontent3','titulo'=>'Datos','clase'=>'col-md-8 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido),
    )
);
echo '</div>';
//var_dump($objeto);
?>