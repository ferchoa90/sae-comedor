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

$this->title = "Editar rol";
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$urlpost='formeditarrol';

$objeto= new Objetos;
$nav= new Navs;
$div= new Bloques;

$this->title = "Administración de Roles";
$botones= new Botones;



//var_dump($roles);
$modulos=array();
$tabs=array();

$id=array('tipo'=>'input','subtipo'=>'oculto', 'nombre'=>'id', 'id'=>'id', 'valor'=>$data->id, 'adicional'=>'');
$nombre=  array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombrerol', 'id'=>'nombrerol', 'valor'=>$data->nombre, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'');
$descripcion=array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'descripcion', 'id'=>'descripcion', 'valor'=>$data->descripcion, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Descripción','leyenda'=>'Descripción del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'');
$configtab=array('tipo'=>'config','nombre'=>'tabpermisos', 'id'=>'tabpermisos', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'');
array_push($modulos,$id);array_push($modulos,$nombre); array_push($modulos,$descripcion); array_push($tabs,$configtab);
 
//var_dump($roles);

foreach ($roles as $key => $value) {
    $contenidoRoles="";
    $contenidoRolessub=array();
    $checked='OFF';


 
    foreach ($datapermiso as $key => $valueVR) {
        //echo ' | '.$value->id.' => '.$valueVR->idmodulo.' <br>'; 
        if ($value->id==$valueVR->idmodulo){$checked='ON';}
    }
    
  
        //var_dump($datapermiso);
        $data=array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>$value->nameint, 'id'=>$value->nameint, 'valor'=>$value->nombre, 'valordefecto'=>$checked, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'dinero','boxbody'=>false,'etiqueta'=>'Módulo: ', 'col'=>'col-4 col-md-4', 'adicional'=>' data-width="80%" data-height="35"');
        array_push($modulos,$data);
        
  
        $dataSub=array();
        $dataSubF=array();


        foreach ($value->rolessubmodulos as $key => $valueRS) {
            $checkedsub='OFF';
            foreach ($datapermiso as $key => $valueVR) {
                if ($valueRS->id==$valueVR->idsubmodulo){$checkedsub='ON';}
            }
            $dataSub=array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>$valueRS->nombreint, 'id'=>$valueRS->nombreint, 'valor'=>$valueRS->nombre,'valordefecto'=>$checkedsub, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'', 'col'=>'col-4 col-md-4', 'adicional'=>' data-width="80%" data-height="35"');
            array_push($dataSubF,$dataSub);
        }

        $contenidoRoles=$objeto->getObjetosArray($dataSubF,true);
    
        $datanav=array('tipo'=>'tab','nombre'=>'tab-'.$value->nameint, 'id'=>'tab-'.$value->nameint, 'titulo'=>$value->nombre, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$contenidoRoles);
        array_push($tabs,$datanav);
    

}


 
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
        var globalVars = {unloaded:false};
            $(window).bind('beforeunload', function(){
                globalVars.unloaded = true;
            });
        //$("#frmDatos").find(':input').each(function() {
        // var elemento= this;
         //console.log("elemento.id="+ elemento.id + ", elemento.value=" + elemento.value);
        //});

        $("#guardar").on('click', function() {
            if (validardatos()==true){
                var form    = $('#frmDatos'),
                nombre   = $('#nombrerol').val(),
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
                            notificacion(data.mensaje,data.tipo);
                            //$this.data().isSubmitted = true;
                            $('#frmDatos')[0].reset();
                            loading(0);

                            return true;
                        }else{
                            loading(0);
                            notificacion(data.mensaje,data.tipo);
                            return false;
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
