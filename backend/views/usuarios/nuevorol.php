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
 

//var_dump($roles);
$modulos=array();
$tabs=array();
$tabsfront=array();
$contenidoNom=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombrerol', 'id'=>'nombrerol', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'descripcion', 'id'=>'descripcion', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Descripción','leyenda'=>'Descripción del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
    ),true
);

$configtab=array('tipo'=>'config','nombre'=>'tabpermisos', 'id'=>'tabpermisos', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'');
array_push($tabs,$configtab);
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

$contenidotab=$nav->getNavsarray($tabs);

$modulosfront=array();
$data=array();
$configtabfront=array('tipo'=>'config','nombre'=>'tabpermisosfront', 'id'=>'tabpermisosfront', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'');
array_push($tabsfront,$configtabfront);
foreach ($rolesfront as $key => $value) {
    $contenidoRoles="";
    $contenidoRolessub=array();
    $data=array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>$value->nameint, 'id'=>$value->nameint, 'valor'=>$value->nombre, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-4 col-md-4', 'adicional'=>' data-width="80%" data-height="35"');
    array_push($modulosfront,$data);
    $dataSub=array();
    $dataSubF=array();
    foreach ($value->rolessubmodulos as $key => $valueRS) {
        $dataSub=array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>$valueRS->nombreint, 'id'=>$valueRS->nombreint, 'valor'=>$valueRS->nombre, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-4 col-md-4', 'adicional'=>' data-width="80%" data-height="35"');
        array_push($dataSubF,$dataSub);
    }
    
    $contenidoRoles=$objeto->getObjetosArray($dataSubF,true);
    $datanav=array('tipo'=>'tab','nombre'=>'tab-'.$value->nameint, 'id'=>'tab-'.$value->nameint, 'titulo'=>$value->nombre, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$contenidoRoles);
    array_push($tabsfront,$datanav);

}

$contenidotabfront=$nav->getNavsarray($tabsfront);

//var_dump($tabs);

// var_dump($contenidomodtab);
 $contenidomodtab=$objeto->getObjetosArray(
    $modulos,true
);
$contenidomodtabfront=$objeto->getObjetosArray(
    $modulosfront,true
);


$contenido=$nav->getNavsarray(
    array(
        array('tipo'=>'config','nombre'=>'tabmodpermisos', 'id'=>'tabmodpermisos', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'tab','nombre'=>'tabback', 'id'=>'tabback', 'titulo'=>'Backend', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$contenidomodtab.$contenidotab),
        array('tipo'=>'tab','nombre'=>'tabfront', 'id'=>'tabfront', 'titulo'=>'Frontend', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$contenidomodtabfront.$contenidotabfront),
        
    )

);
 
 $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));


 $contenido2='<div style="line-height:25px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ACTIVO</span><br>';
 $contenido2.='<hr style="color: #0056b2;">';
 $contenido2.='</div>';

//$contenido.=;
?>

<?php $form = ActiveForm::begin(['id'=>'frmDatos']); ?>
<?php
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenidoNom.$contenido.$botonC),
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
