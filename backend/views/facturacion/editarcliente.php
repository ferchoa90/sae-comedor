<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use backend\components\Navs;
use yii\widgets\ActiveForm;

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = "Editar Cliente";
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;
$nav= new Navs;
$urlpost='formeditarcliente';
$checked='OFF';
if ($model->credito){$checked='ON';}
 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'oculto', 'nombre'=>'id', 'id'=>'id', 'valor'=>$model->id, 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'tipoident', 'id'=>'tipoident', 'valor'=>$tipoidentificacion,'valordefecto'=>$model->tipoidentificacion, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Tipo Identificación: ', 'col'=>'col-6 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'identificacion', 'id'=>'identificacion', 'valor'=>$model->cedula,'etiqueta'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Identificación: ', 'col'=>'col-12 col-md-6', 'adicional'=>' onKeyPress="if(this.value.length==13) return false;"'),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'razonsocial', 'id'=>'razonsocial', 'valor'=>$model->razonsocial, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Razon Social: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'razoncomercial', 'id'=>'razoncomercial', 'valor'=>$model->razoncomercial, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Razon Comercial: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'genero', 'id'=>'genero', 'valor'=>$genero,'valordefecto'=>$model->genero, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Género: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'direccion', 'id'=>'direccion', 'valor'=>$model->direccion, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Dirección: ', 'col'=>'col-12 col-md-8', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'correo', 'id'=>'correo', 'valor'=>$model->correo, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'arroba','boxbody'=>false,'etiqueta'=>'Correo electrónico: ', 'col'=>'col-12 col-md-8', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'telefono', 'id'=>'telefono', 'valor'=>$model->telefono, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'telefono','boxbody'=>false,'etiqueta'=>'Teléfono: ', 'col'=>'col-6 col-md-4', 'adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'credito', 'id'=>'credito', 'valor'=>'Credito', 'valordefecto'=>$checked,'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'Crédito', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cupocredito', 'id'=>'cupocredito', 'valor'=>$model->cupocredito, 'etiqueta'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cupo crédito: ', 'col'=>'col-9 col-md-3', 'adicional'=>''),
        
    ),true
);

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));
  
 $contenido2='<div style="line-height:25px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ACTIVO</span><br>';
 $contenido2.='<hr style="color: #0056b2;"></div>';
 $form = ActiveForm::begin(['id'=>'frmDatos']);
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos Cliente','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$contenidotab.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),

    )
);
ActiveForm::end();
//var_dump($objeto);
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>

      /*  $('#fechanac').datepicker({
            //language: "es-ES",
            todayHighlight: true,
            dateFormat: 'yyyy-mm-dd',
            format: 'yyyy-mm-dd',
            autoclose: true,
            autoclose: true,
            changeMonth: true,
            changeYear: false,
            clearBtn: true,
            endDate: new Date()
        })*/
       $(document).ready(function(){
        $("#guardar").on('click', function() {
            if (validardatos()==true){
                loading(1);
                var form    = $('#frmDatos');
                $.ajax({
                    url: '<?= $urlpost ?>',
                    async: 'false',
                    cache: 'false',
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response){
                    data=JSON.parse(response);
                    //console.log(response);
                    //console.log(data.success);
                    if ( data.success == true ) {
                        // ============================ Not here, this would be too late
                        notificacion(data.mensaje,data.tipo);
                        //$this.data().isSubmitted = true;
                        $('#frmDatos')[0].reset();
                        return true;
                    }else{
                        notificacion(data.mensaje,data.tipo);
                    }
                }
            });
            loading(0);
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
           //console.log("validardatos");
           if ($('#tipoident').val()!=-1){
            if ($('#identificacion').val()!=""){
              if ($('#razonsocial').val()!=""){
                if ($('#genero').val()!=-1){
                    if ($('#correo').val()!=""){
                              return true;
                            }else{
                                $('#correo').focus();
                                return false;
                            }
                        }else{
                            $('#genero').focus();
                            return false;
                        }
                    }else{
                        $('#razonsocial').focus();
                        return false;
                    }
                }else{
                    $('#identificacion').focus();
                    return false;
                }
            }else{
                $('#tipoidentificacion').focus();
                return false;
            }
            return false;
       }
  </script>
<style>
    input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] { -moz-appearance:textfield; }
</style>
