<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Navs;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;
use yii\web\View;
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = "Nuevo rol";
$this->params['breadcrumbs'][] = ['label' => 'Administración de Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$urlpost='formrol';

$objeto= new Objetos;
$nav= new Navs;
$div= new Bloques;

$this->title = "Administración de Roles";
$botones= new Botones;

//var_dump($clientes);
//$contenidotab='';
$modulousuario=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agusuario', 'id'=>'agusuario', 'valor'=>'Agregar Usu', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edusuario', 'id'=>'edusuario', 'valor'=>'Editar Usu', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eliusuario', 'id'=>'eliusuario', 'valor'=>'Eliminar Usu', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agroles', 'id'=>'agroles', 'valor'=>'Agregar Rol', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edroles', 'id'=>'edroles', 'valor'=>'Editar Rol', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eliroles', 'id'=>'eliroles', 'valor'=>'Eliminar Rol', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        //array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'repusuario', 'id'=>'repusuario', 'valor'=>'Reportes', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
    ),true
);

$modulocontabilidad=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agcxc', 'id'=>'agcxc', 'valor'=>'Agregar CXC', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edcxc', 'id'=>'edcxc', 'valor'=>'Editar CXC', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elicxc', 'id'=>'elicxc', 'valor'=>'Eliminar CXC', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agcxp', 'id'=>'agcxp', 'valor'=>'Agregar CPC', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edcxp', 'id'=>'edcxp', 'valor'=>'Editar CPC', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elicxp', 'id'=>'elicxp', 'valor'=>'Eliminar CPC', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agdiario', 'id'=>'agdiario', 'valor'=>'Agregar Diario', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eddiario', 'id'=>'eddiario', 'valor'=>'Editar Diario', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elidiario', 'id'=>'elidiario', 'valor'=>'Eliminar Diario', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agperiodo', 'id'=>'agperiodo', 'valor'=>'Agregar Periodo', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edperiodo', 'id'=>'edperiodo', 'valor'=>'Editar Periodo', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eliperiodo', 'id'=>'eliperiodo', 'valor'=>'Eliminar Periodo', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elidiario', 'id'=>'elidiario', 'valor'=>'Eliminar Diario', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agdeclaraciones', 'id'=>'agdeclaraciones', 'valor'=>'Agregar Declaraciones', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eddeclaraciones', 'id'=>'eddeclaraciones', 'valor'=>'Editar Declaraciones', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elideclaraciones', 'id'=>'elideclaraciones', 'valor'=>'Eliminar Declaraciones', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),

    ),true
);

$modulofacturacion=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agfacturacion', 'id'=>'agfacturacion', 'valor'=>'Agregar Factura', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edfacturacion', 'id'=>'edfacturacion', 'valor'=>'Editar Factura', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elifacturacion', 'id'=>'elifacturacion', 'valor'=>'Eliminar Factura', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agentrega', 'id'=>'agentrega', 'valor'=>'Agregar Entrega', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edentrega', 'id'=>'edentrega', 'valor'=>'Editar Entrega', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elientrega', 'id'=>'elientrega', 'valor'=>'Eliminar Entrega', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
    ),true
);

$moduloinventario=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agfacturacion', 'id'=>'agfacturacion', 'valor'=>'Agregar Inv.', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edfacturacion', 'id'=>'edfacturacion', 'valor'=>'Editar Inv.', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elifacturacion', 'id'=>'elifacturacion', 'valor'=>'Eliminar Inv.', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),

    ),true
);

$modulorecursosh=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agempleado', 'id'=>'agempleado', 'valor'=>'Agregar Empl.', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edempleado', 'id'=>'edempleado', 'valor'=>'Editar Empl.', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eliempleado', 'id'=>'eliempleado', 'valor'=>'Eliminar Empl.', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agdepartamento', 'id'=>'agdepartamento', 'valor'=>'Agregar Dep.', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eddepartamento', 'id'=>'eddepartamento', 'valor'=>'Editar Dep.', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elidepartamento', 'id'=>'elidepartamento', 'valor'=>'Eliminar Dep.', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agrolpagos', 'id'=>'agrolpagos', 'valor'=>'Agregar Rol p.', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edrolpagos', 'id'=>'edrolpagos', 'valor'=>'Editar Rol p.', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elirolpagos', 'id'=>'elirolpagos', 'valor'=>'Eliminar Rol p.', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
    ),true
);

$moduloreportes=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agreportes', 'id'=>'agreportes', 'valor'=>'Agregar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edreportes', 'id'=>'edreportes', 'valor'=>'Editar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elireportes', 'id'=>'elireportes', 'valor'=>'Eliminar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'repreportes', 'id'=>'repreportes', 'valor'=>'Reportes', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
    ),true
);

$modulomantenimiento=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agclientes', 'id'=>'agclientes', 'valor'=>'Agregar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edclientes', 'id'=>'edclientes', 'valor'=>'Editar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eliclientes', 'id'=>'eliclientes', 'valor'=>'Eliminar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agproveedores', 'id'=>'agproveedores', 'valor'=>'Agregar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edproveedores', 'id'=>'edproveedores', 'valor'=>'Editar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'eliproveedores', 'id'=>'eliproveedores', 'valor'=>'Eliminar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'agsocios', 'id'=>'agsocios', 'valor'=>'Agregar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'edsocios', 'id'=>'edsocios', 'valor'=>'Editar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'elisocios', 'id'=>'elisocios', 'valor'=>'Eliminar', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3', 'adicional'=>' data-width="80%" data-height="35"'),
    ),true
);

$moduloauditoria=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'verauditoria', 'id'=>'verauditoria', 'valor'=>'Ver registros', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
    ),true
);




//var_dump($roles);
$modulos=array();
$tabs=array();
$nombre=  array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombrerol', 'id'=>'nombrerol', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'');
$descripcion=array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'descripcion', 'id'=>'descripcion', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Descripción','leyenda'=>'Descripción del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'');
$configtab=array('tipo'=>'config','nombre'=>'tabpermisos', 'id'=>'tabpermisos', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'');
array_push($modulos,$nombre); array_push($modulos,$descripcion); array_push($tabs,$configtab);
foreach ($roles as $key => $value) {
    $contenidoRoles="";
    $contenidoRolessub=array();
    $data=array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>$value->nameint, 'id'=>$value->nameint, 'valor'=>$value->nombre, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-4 col-md-4', 'adicional'=>' data-width="80%" data-height="35"');
    array_push($modulos,$data);
    $dataSub=array();
    $dataSubF=array();
    foreach ($value->rolessubmodulos as $key => $valueRS) {
        $dataSub=array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>$valueRS->nombreint, 'id'=>$valueRS->nombreint, 'valor'=>$valueRS->nombre, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-4 col-md-4', 'adicional'=>' data-width="80%" data-height="35"');
        array_push($dataSubF,$dataSub);
    }
    
    $contenidoRoles=$objeto->getObjetosArray($dataSubF,true);
    $datanav=array('tipo'=>'tab','nombre'=>'tab-'.$value->nameint, 'id'=>'tab-'.$value->nameint, 'titulo'=>$value->nombre, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$contenidoRoles);
    array_push($tabs,$datanav);

}


/*
array(
    array('tipo'=>'config','nombre'=>'tabpermisos', 'id'=>'tabpermisos', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
    array('tipo'=>'tab','nombre'=>'tabusuarios', 'id'=>'tabusuarios', 'titulo'=>'Usuarios', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$modulousuario),
    array('tipo'=>'tab','nombre'=>'tabcontabilidad', 'id'=>'tabcontabilidad', 'titulo'=>'Contabilidad', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$modulocontabilidad),
    array('tipo'=>'tab','nombre'=>'tabfacturacion', 'id'=>'tabfacturacion', 'titulo'=>'Facturacion', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$modulofacturacion),
    array('tipo'=>'tab','nombre'=>'tabinventario', 'id'=>'tabinventario', 'titulo'=>'Inventario', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$moduloinventario),
    array('tipo'=>'tab','nombre'=>'tabrecursosh', 'id'=>'tabrecursosh', 'titulo'=>'R. Humanos', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$modulorecursosh),
    array('tipo'=>'tab','nombre'=>'tabmantenimientos', 'id'=>'tabmantenimientos', 'titulo'=>'Mantenimientos', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$modulomantenimiento),
    array('tipo'=>'tab','nombre'=>'tabauditoria', 'id'=>'tabauditoria', 'titulo'=>'Auditoria', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$moduloauditoria),
)
*/
$contenidotab=$nav->getNavsarray($tabs);

//var_dump($tabs);


 $contenido=$objeto->getObjetosArray(
    $modulos,true
);
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-9 col-xs-12 ','','','','');
 //echo $div->getBloque('bloquediv','rr','ee','PRUEBA','col-md-3 col-xs-12 ','','','','');
 //echo $contenido;
 $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));


 $contenido2='<div style="line-height:25px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ACTIVO</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';
?>

<?php $form = ActiveForm::begin(['id'=>'frmDatos']); ?>
<?php
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$contenidotab.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);
?>
<?php ActiveForm::end(); ?>

<script>
       $(document).ready(function(){
        //$("#frmDatos").find(':input').each(function() {
        // var elemento= this;
         //console.log("elemento.id="+ elemento.id + ", elemento.value=" + elemento.value);
        //});

        $("#guardar").on('click', function() {
            if (validardatos()==true){
                var form    = $('#frmDatos');
                nombre   = $('#nombrerol').val();
                descripcion   = $('#descripcion').val();
                loading(1);
                $.ajax({
                    url: '<?= $urlpost ?>',
                    async: 'false',
                    cache: 'false',
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response){
                    data=JSON.parse(response);
                    //console.log(response);
                    console.log(data.success);
                    if ( data.success == true ) {
                        // ============================ Not here, this would be too late
                        loading(0);
                        notificacion(data.mensaje,data.tipo);
                        //$this.data().isSubmitted = true;
                        $('#frmDatos')[0].reset();
                        return true;
                    }else{
                        loading(0);
                        notificacion(data.mensaje,data.tipo);
                    }
                },
                    fail:function( ){
                        loading(0);
                        return false;
                    },
                    error: function(jqXHR,status,error){
                        if (globalVars.unloaded)
                            loading(0);
                            return false;
                    }
            });
            }else{

                notificacion("Faltan campos obligatorios","error");
                //e.preventDefault(); // <=================== Here
                return false;
            }
  });

        $('#frmDatos').on('submit', function(e){
            e.preventDefault(); // <=================== Here
            $this = $(this);
            if ($this.data().isSubmitted) {
                return false;
            }


        });


       });

       function validardatos()
       {
           console.log("validardatos");
            if ($('#nombrerol').val()!=""){
                if ($('#descripcion').val()!=""){
                    return true;
                }else{
                    $('#descripcion').focus();
                    return false;
                }
            }else{
                $('#nombrerol').focus();
                return false;
            }
       }
  </script>
