<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver Rol";
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;
$permitido='<span class="badge badge-success">Permitido </span>';
$nopermitido='<span class="badge badge-danger">No permitido </span>';
$rolusuarios=$nopermitido; $rolcontabilidad=$nopermitido; $rolfacturacion=$nopermitido; $rolinventario=$nopermitido;
$rolrecursosh=$nopermitido; $rolreportes=$nopermitido; $rolmantenimiento=$nopermitido; $rolauditoria=$nopermitido;

foreach ($rolpermisos as $key => $value) {
    if ($value->idmodulo==1){ $rolusuarios=$permitido;  }
    if ($value->idmodulo==2){ $rolcontabilidad=$permitido;  }
    if ($value->idmodulo==3){ $rolfacturacion=$permitido;  }
    if ($value->idmodulo==4){ $rolinventario=$permitido;  }
    if ($value->idmodulo==5){ $rolrecursosh=$permitido;  }
    if ($value->idmodulo==6){ $rolreportes=$permitido;  }
    if ($value->idmodulo==7){ $rolmantenimiento=$permitido;  }
    if ($value->idmodulo==8){ $rolauditoria=$permitido;  }
}

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b>Rol # </b>'.$rol->id.'<br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>Nombre:</b>&nbsp; '.$rol->nombre.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Descripción:</b>&nbsp; '.$rol->descripcion.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-6 col-md-6"><b>Módulo Usuarios:</b>&nbsp; '.$rolusuarios.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Módulo Contabilidad:</b>&nbsp; '.$rolcontabilidad.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Módulo Facturación:</b>&nbsp; '.$rolfacturacion.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Módulo Inventario:</b>&nbsp; '.$rolinventario.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Módulo R. Humanos:</b>&nbsp; '.$rolrecursosh.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Módulo Reportes:</b>&nbsp; '.$rolmantenimiento.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Módulo Mantenimiento:</b>&nbsp; '.$rolmantenimiento.'</span><br></div>';
$contenido.='<div class="col-6 col-md-6"><b>Módulo Auditoria:</b>&nbsp; '.$rolauditoria.'</span><br></div>';
$contenido.='</div>';

 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ACTIVO</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$rol->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$rol->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp; - </span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp; - </span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

 $tabla='';
 
 

 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
