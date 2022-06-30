<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Ver Paciente";
$this->params['breadcrumbs'][] = ['label' => 'Pacientes', 'url' => ['pacientes']];
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
       // array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$contenido='<div style="line-height:30px;" class="row"><div class="col-6 col-md-6"><b># Paciente:  </b>'.$paciente->id.'<br></div>';
$contenido.='<div class="col-6 col-md-6"><b># H. Clínica:  </b>'.$paciente->idhistorialc.'<br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-9"><b>Nombres:</b>&nbsp; '.$paciente->apellidos.' '.$paciente->nombres.'</span><br></div>';
$contenido.='<div class="col-12 col-md-3"><b>Tipo de Sangre:</b>&nbsp; '.$paciente->tiposangre.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Dirección:</b>&nbsp; '.$paciente->direccion.'</span><br></div>';
$contenido.='<div class="col-12 col-md-6"><b>Correo:</b>&nbsp; '.$paciente->correo.'</span><br></div>';
$contenido.='<div class="col-12 col-md-6"><b>Teléfono:</b>&nbsp; '.$paciente->telefono.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-12"><b>Antecedentes Personales:</b>&nbsp; '.$paciente->antecedentesp.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Antecedentes Oculares:</b>&nbsp; '.$paciente->antecedenteso.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Antecedentes Familiares:</b>&nbsp; '.$paciente->antecedentesf.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><b>Enfermedad Actual:</b>&nbsp; '.$paciente->enfermedada.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-6"><b>Contacto Emer.:</b>&nbsp; '.$paciente->nombresemer.'</span><br></div>';
$contenido.='<div class="col-12 col-md-6"><b>Direccion Emer.:</b>&nbsp; '.$paciente->direccionemer.'</span><br></div>';
$contenido.='<div class="col-12 col-md-6"><b>Teléfono Emer.:</b>&nbsp; '.$paciente->telefonoemer.'</span><br></div>';
$contenido.='<div class="col-12 col-md-12"><hr style="color: #0056b2;"></div>';
$contenido.='<div class="col-12 col-md-6"><b>Detalle Historia C.:</b>&nbsp; '.''.'</span><br></div>';
$contenido.='</div>';

 if ($paciente->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
 $contenido2='<div style="line-height:30px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$paciente->estatus.'</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha C.:</b>&nbsp; '.$paciente->fechacreacion.'</span><br>';
 $contenido2.='<b>Usuario C.:</b>&nbsp; '.$paciente->usuariocreacion0->username. '</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='<b>Fecha M.:</b>&nbsp; - </span><br>';
 $contenido2.='<b>Usuario M.:</b>&nbsp; - </span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

 $tabla='';



 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
    )
);

//var_dump($objeto);
?>
