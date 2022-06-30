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
$this->title = 'Crear Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Administración de Usuarios', 'url' => ['usuarios']];
$this->params['breadcrumbs'][] = $this->title;

$urlpost='formusuario';

$objeto= new Objetos;
$nav= new Navs;
$div= new Bloques;

$this->title = "Administración de Usuarios";
$botones= new Botones;
//var_dump($clientes);
//$contenidotab='';
 $contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombres', 'id'=>'nombres', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre','leyenda'=>'Nombre del usuario ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'apellidos', 'id'=>'apellidos', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Apellido','leyenda'=>'Apellido del usuario ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombreusuario', 'id'=>'nombreusuario', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre de usuario','leyenda'=>'Nombre de usuario ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cedula', 'id'=>'cedula', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'tarjeta','boxbody'=>false,'etiqueta'=>'Cédula de usuario','leyenda'=>'Cédula de usuario ', 'col'=>'col-12 col-md-6', 'adicional'=>'max="9999999999"  maxlength="10" onKeyPress="if(this.value.length==10) return false;" '),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'rol', 'id'=>'rol', 'valor'=>$roles, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Tipo de usuario: ', 'col'=>'col-6 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'correo', 'id'=>'correo', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'carta','boxbody'=>false,'etiqueta'=>'Correo de usuario','leyenda'=>'Correo de usuario ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'clave', 'nombre'=>'clave', 'id'=>'clave', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'llave','boxbody'=>false,'etiqueta'=>'Contraseña','leyenda'=>'Contraseña ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
       // array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
    ),true
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
        array('tipo'=>'bloquediv','nombre'=>'rr','id'=>'ee','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$contenidotab.$botonC),
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
            loading(1);
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
                        loading(0);

                        $('#frmDatos')[0].reset();
                        return true;
                    }else{
                        notificacion(data.mensaje,data.tipo);
                        loading(0);
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
<style>
    input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] { -moz-appearance:textfield; }
</style>