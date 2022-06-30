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

$this->title = "Nuevo Paciente";
$this->params['breadcrumbs'][] = $this->title;


$objeto= new Objetos;
$div= new Bloques;
$nav= new Navs;
$urlpost='formnuevopaciente';
 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'apellidos', 'id'=>'apellidos', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Apellidos: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombres', 'id'=>'nombres', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombres: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cedula', 'id'=>'cedula', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cédula: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'genero', 'id'=>'genero', 'valor'=>$sexo, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Género: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'ciudad', 'id'=>'ciudad', 'valor'=>$ciudades, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Ciudad: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'direccion', 'id'=>'direccion', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Dirección: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'correo', 'id'=>'correo', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'arroba','boxbody'=>false,'etiqueta'=>'Correo electrónico: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'profesion', 'id'=>'profesion', 'valor'=>$profesiones, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Profesión: ', 'col'=>'col-12 col-md-7', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'telefono', 'id'=>'telefono', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'telefono','boxbody'=>false,'etiqueta'=>'Teléfono: ', 'col'=>'col-6 col-md-5', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'fechanac', 'id'=>'fechanac', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'calendario','boxbody'=>false,'etiqueta'=>'Fecha nacimiento: ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'tiposangre', 'id'=>'tiposangre', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'telefono','boxbody'=>false,'etiqueta'=>'Tipo de Sangre: ', 'col'=>'col-6 col-md-3', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'alerta', 'id'=>'alerta', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'telefono','boxbody'=>false,'etiqueta'=>'Alerta: ', 'col'=>'col-6 col-md-6', 'adicional'=>''),
    ),true
);

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'guardar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$contenidoHC=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'textarea', 'nombre'=>'antecedentesp', 'id'=>'antecedentesp', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Antecedentes Personales: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'textarea', 'nombre'=>'antecedenteso', 'id'=>'antecedenteso', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Antecedentes Oculares: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'textarea', 'nombre'=>'antecedentesf', 'id'=>'antecedentesf', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Antecedentes Familiares: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'textarea', 'nombre'=>'enfermedada', 'id'=>'enfermedada', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Enfermedad Actual: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
    ),true
);

$contenidoN1=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombresemer', 'id'=>'nombresemer', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Contacto emergencia: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'direccionemer', 'id'=>'direccionemer', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Dirección emergencia: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'telefonoemer', 'id'=>'telefonoemer', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Teléfono emergencia: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
    ),true
);

$contenidotab=$nav->getNavsarray(
    array(
        array('tipo'=>'config','nombre'=>'tabpermisos', 'id'=>'tabpermisos', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'tab','nombre'=>'tabdiario', 'id'=>'tabdiario', 'titulo'=>'Antecedentes', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$contenidoHC),
        array('tipo'=>'tab','nombre'=>'tabfactura', 'id'=>'tabfactura', 'titulo'=>'Información', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del rol ', 'col'=>'col-12 col-md-6', 'adicional'=>'', 'contenido'=>$contenidoN1),
    )
  );

 $contenido2='<div style="line-height:25px;"><b>Estatus:</b>&nbsp;&nbsp;&nbsp;<span class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ACTIVO</span><br>';
 $contenido2.='<hr style="color: #0056b2;"></div>';
 $form = ActiveForm::begin(['id'=>'frmDatos']);
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos del paciente','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$contenidotab.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),

    )
);
ActiveForm::end();
//var_dump($objeto);
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>

        $('#fechanac').datepicker({
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
        })
       $(document).ready(function(){
        $("#guardar").on('click', function() {
            if (validardatos()==true){
                var form    = $('#frmDatos');
                $.ajax({
                    url: '<?= $urlpost ?>',
                    async: 'false',
                    cache: 'false',
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response){
                    data=JSON.parse(response);
                    console.log(response);
                    console.log(data.success);
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
            if ($('#apellidos').val()!=""){
                if ($('#nombres').val()!=""){
                    if ($('#cedula').val()!=""){
                        if ($('#genero').val()!=-1){
                            if ($('#ciudad').val()!=-1){
                                if ($('#correo').val()!=""){
                                    if ($('#profesion').val()!=-1){
                                        return true;
                                    }else{
                                        $('#profesion').focus();
                                        return false;
                                    }
                                }else{
                                    $('#correo').focus();
                                    return false;
                                }
                            }else{
                                $('#ciudad').focus();
                                return false;
                            }
                        }else{
                            $('#genero').focus();
                            return false;
                        }
                    }else{
                        $('#cedula').focus();
                        return false;
                    }
                }else{
                    $('#nombres').focus();
                    return false;
                }
            }else{
                $('#apellidos').focus();
                return false;
            }
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
