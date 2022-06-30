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
/* @var $model app\models\TriviaHead */

$this->title = 'Mi perfil';
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$urlpost='formusuario';

$objeto= new Objetos;
$nav= new Navs;
$div= new Bloques;

$this->title = "Mi perfil";
$botones= new Botones;


?>


    <?php


 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombres', 'id'=>'nombres', 'valor'=>$model->nombres, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre: ','leyenda'=>'Nombre del usuario ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'apellidos', 'id'=>'apellidos', 'valor'=>$model->apellidos, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Apellido: ','leyenda'=>'Apellido del usuario ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombreusuario', 'id'=>'nombreusuario', 'valor'=>$model->username, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'arroba','boxbody'=>false,'etiqueta'=>'Nombre de usuario: ','leyenda'=>'Nombre de usuario ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'clave', 'nombre'=>'clave', 'id'=>'clave', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'llave','boxbody'=>false,'etiqueta'=>'Contraseña: ','leyenda'=>'Contraseña ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'rol', 'id'=>'rol', 'valor'=>$roles,'valordefecto'=>$model->idrol, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Tipo: ', 'col'=>'col-6 col-md-6', 'adicional'=>' disabled '),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'cedula', 'id'=>'cedula', 'valor'=>$model->cedula, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'tarjeta','boxbody'=>false,'etiqueta'=>'Cédula: ','leyenda'=>'Cédula de usuario ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'correo', 'id'=>'correo', 'valor'=>$model->email, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'carta','boxbody'=>false,'etiqueta'=>'Correo: ','leyenda'=>'Correo de usuario ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
       // array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
    ),true
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
?>

<?php $form = ActiveForm::begin(['id'=>'frmDatos']); ?>
<?php
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Mi perfil','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$contenidotab.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),
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
                var form    = $('#frmDatos'),
                nombre   = $('#nombrerol').val(),
                descripcion   = $('#descripcion').val();
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
           console.log("validardatos");
            if ($('#nombres').val()!=""){
                if ($('#apellidos').val()!=""){
                    if ($('#nombreusuario').val()!=""){
                        if ($('#cedula').val()!=""){
                            if ($('#rol').attr('selected', 'selected').val()!="-1"){
                                if ($('#correo').val()!=""){
                                    if ($('#clave').val()!=""){
                                        return true;
                                    }else{
                                        $('#clave').focus();
                                        return false;
                                    }
                                }else{
                                    $('#correo').focus();
                                    return false;
                                }
                            }else{
                                $('#rol').focus();
                                return false;
                            }
                        }else{
                            $('#cedula').focus();
                            return false;
                        }
                    }else{
                        $('#nombreusuario').focus();
                        return false;
                    }

                }else{
                    $('#apellidos').focus();
                    return false;
                }
            }else{
                $('#nombres').focus();
                return false;
            }
       }
  </script>
