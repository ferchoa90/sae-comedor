<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Modal;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Test";
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;
$modal= new Modal;

$contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cedula', 'id'=>'cedula', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cédula: ', 'col'=>'col-8', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'razonsocial', 'id'=>'razonsocial', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Razón social: ', 'col'=>'col-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'textarea', 'nombre'=>'direccion', 'id'=>'direccion', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Dirección: ', 'col'=>'col-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'checkbox', 'nombre'=>'contribuyente', 'id'=>'contribuyente', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'Cont. Especial: ', 'col'=>'col-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'descripcion', 'id'=>'descripcion', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Descipcion: ', 'col'=>'col-11', 'adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
    ),true,true,'form-clientes','post','/frontend/web/site/facturar'
);
$botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'float-right p-1', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'float-right p-1', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));
$content='
<div class="form-group field-clientes-cedula required">
<label class="control-label" for="clientes-cedula">Cedula</label>
<input type="text" id="clientes-cedula" class="form-control" name="cedula" autocomplete="nope" placeholder="Cédula O  Ruc" aria-required="true">
<p class="help-block help-block-error"></p>
</div>
        <div class="form-group field-clientes-nombres required">
<label class="control-label" for="clientes-nombres">Nombres</label>
<input type="text" id="clientes-nombres" class="form-control" name="nombres" placeholder="Nombres O  Razón Social" aria-required="true">
<p class="help-block help-block-error"></p>
</div>
        <div class="form-group field-clientes-nombres required">
<label class="control-label" for="clientes-nombres">Apellidos</label>
<input type="text" id="clientes-apellidos" class="form-control" name="apellidos" placeholder="Apellidos" value="" aria-required="true">
<p class="help-block help-block-error"></p>
</div>
        <div class="form-group field-clientes-direccion">
<label class="control-label" for="clientes-direccion">Direccion</label>
<input type="text" id="clientes-direccion" class="form-control" name="direccion" placeholder="Dirección">
<p class="help-block help-block-error"></p>
</div>
        <div class="form-group field-clientes-telefono">
<label class="control-label" for="clientes-telefono">Telefono</label>
<input type="text" id="clientes-telefono" class="form-control" name="telefono" placeholder="Teléfono">
<p class="help-block help-block-error"></p>
</div>
        <div class="form-group field-clientes-correo required">
<label class="control-label" for="clientes-correo">Correo</label>
<input type="text" id="clientes-correo" class="form-control" name="correo" placeholder="Correo Electrónico" aria-required="true">
<p class="help-block help-block-error"></p>
</div>
<div class="modal-footer" style="padding-right:0px; padding-bottom:0px;">
  <div class="form-group" style="padding-right:0px; margin-bottom:0px;">
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-dismiss="modal">Cancelar</button>
    <button type="button" onclick="javascript:agregarCliente(this);" id="reservassave" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" name="save-button">Agregar</button>          </div>
</div>';


echo $modal->getModal('','clientes', 'clientes', 'clientes', $contenido.$botonC, $clase, $style, $col,$adicional);



?>
<a id="agCliente" href="#" data-toggle="modal" data-target="#nuevoClienteModal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"> + </a>
