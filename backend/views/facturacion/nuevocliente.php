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

$this->title = "Nuevo Cliente";
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;
$nav= new Navs;
$urlpost='formnuevocliente';
 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'tipoident', 'id'=>'tipoident', 'valor'=>$tipoidentificacion, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Tipo Identificación: ', 'col'=>'col-6 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'identificacion', 'id'=>'identificacion', 'valor'=>'','etiqueta'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Identificación: ', 'col'=>'col-12 col-md-6', 'adicional'=>' onKeyPress="if(this.value.length==13) return false;"'),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'razonsocial', 'id'=>'razonsocial', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Razon Social: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'razoncomercial', 'id'=>'razoncomercial', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Razon Comercial: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'genero', 'id'=>'genero', 'valor'=>$genero, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Género: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'direccion', 'id'=>'direccion', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Dirección: ', 'col'=>'col-12 col-md-8', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'correo', 'id'=>'correo', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'arroba','boxbody'=>false,'etiqueta'=>'Correo electrónico: ', 'col'=>'col-12 col-md-8', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'telefono', 'id'=>'telefono', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'telefono','boxbody'=>false,'etiqueta'=>'Teléfono: ', 'col'=>'col-6 col-md-4', 'adicional'=>' onKeyPress="if(this.value.length==10) return false;"'),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'credito', 'id'=>'credito', 'valor'=>'Credito', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'Crédito', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cupocredito', 'id'=>'cupocredito', 'valor'=>'0.00','etiqueta'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cupo crédito: ', 'col'=>'col-9 col-md-3', 'adicional'=>''),
        
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
                var form    = $('#frmDatos');
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
                    //console.log(data.success);
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
                    }
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
