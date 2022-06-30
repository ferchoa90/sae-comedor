<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use backend\components\Contenido;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver doctor";
$this->params['breadcrumbs'][] = ['label' => 'Consultorios', 'url' => ['consultorios']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')
));


$contenidoClass= new contenido;
$contenido=$contenidoClass->getContenidoArrayr(
        array(
            array('tipo'=>'div','nombre'=>'id', 'id' => 'id', 'titulo'=>'ID:','contenido'=>$data->id,'clase'=>'', 'style'=>'', 'col'=>'col-12 col-md-12', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
            array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
            array('tipo'=>'div','nombre'=>'cedula', 'id' => 'cedula', 'titulo'=>'Cédula:','contenido'=>$data->cedula, 'col'=>'col-12 col-md-12','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
            array('tipo'=>'div','nombre'=>'apellidos', 'id' => 'apellidos', 'titulo'=>'Apellidos:','contenido'=>$data->apellidos, 'col'=>'col-12 col-md-6','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
            array('tipo'=>'div','nombre'=>'nombres', 'id' => 'nombres', 'titulo'=>'Nombres:','contenido'=>$data->nombres, 'col'=>'col-12 col-md-6','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
            array('tipo'=>'div','nombre'=>'direccion', 'id' => 'direccion', 'titulo'=>'Dirección:','contenido'=>$data->direccion, 'col'=>'col-12 col-md-12','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
            array('tipo'=>'div','nombre'=>'profesion', 'id' => 'profesion', 'titulo'=>'Profesión:','contenido'=>$data->idprofesion0->nombre, 'col'=>'col-12 col-md-6','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
            array('tipo'=>'div','nombre'=>'telefono', 'id' => 'telefono', 'titulo'=>'Teléfono:','contenido'=>$data->telefono, 'col'=>'col-12 col-md-6','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
            array('tipo'=>'div','nombre'=>'correo', 'id' => 'correo', 'titulo'=>'Correo:','contenido'=>$data->correo, 'col'=>'col-12 col-md-12','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
            array('tipo'=>'div','nombre'=>'tiposangre', 'id' => 'tiposangre', 'titulo'=>'Tipo de Sangre:','contenido'=>$data->tiposangre, 'col'=>'col-12 col-md-6','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        )
    );

if ($data->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
$estatus='<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$data->estatus.'</span>';
$contenido2=$contenidoClass->getContenidoArrayr(
    array(
        array('tipo'=>'div','nombre'=>'nombre', 'id' => 'nombre', 'titulo'=>'Estatus:&nbsp;&nbsp;','contenido'=>$estatus, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'div','nombre'=>'fechac', 'id' => 'fechac', 'titulo'=>'Fecha C:','contenido'=>$data->fechacreacion, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'div','nombre'=>'usuarioc', 'id' => 'usuarioc', 'titulo'=>'Usuario C:','contenido'=>$data->usuariocreacion0->username, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'div','nombre'=>'fechaa', 'id' => 'fechaa', 'titulo'=>'Fecha M:','contenido'=>$data->fechaact, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'div','nombre'=>'usuarioa', 'id' => 'usuarioa', 'titulo'=>'Usuario M:','contenido'=>$data->usuarioactualizacion0->username, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
    )
);

 $tabla='';

 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'dvcontent','id'=>'dvcontent','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'dvcontent','id'=>'dvcontent','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
