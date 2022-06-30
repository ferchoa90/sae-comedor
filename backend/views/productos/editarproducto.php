<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use backend\components\Contenido;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Editar Producto';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$urlpost='formeditarproducto';

$objeto= new Objetos;
$div= new Bloques;
$contenidoClass= new contenido;
$contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'oculto', 'nombre'=>'idproducto', 'id'=>'idproducto', 'valor'=>$model->id, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'proveedores', 'id'=>'proveedores', 'valor'=>$proveedores,'valordefecto'=>$model->idproveedor, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Proveedor: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'tipoproducto', 'id'=>'tipoproducto', 'valor'=>$tipoproducto, 'onchange'=>'','valordefecto'=>$model->tipoproducto, 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Tipo Producto: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'marca', 'id'=>'marca', 'valor'=>$marca,'valordefecto'=>$model->marca, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Marca: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'nombre', 'id'=>'nombre', 'valor'=>$model->nombreproducto, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Nombre: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'descripcion', 'id'=>'descripcion', 'valor'=>$model->descripcion, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Contenido: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'archivo', 'nombre'=>'imagen', 'id'=>'imagen', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Imagen: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
    ),true
);

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Actualizar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'regresar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

if ($model->estatus=="ACTIVO"){ $stylestatus="badge-success"; }else{ $stylestatus="badge-secondary" ; }
$estatus='<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;'.$model->estatus.'</span>';
$contenido2=$contenidoClass->getContenidoArrayr(
    array(
        array('tipo'=>'div','nombre'=>'nombre', 'id' => 'nombre', 'titulo'=>'Estatus:&nbsp;&nbsp;','contenido'=>$estatus, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'image','nombre'=>'preview', 'id' => 'preview', 'src'=>$model->imagen,'clase'=>'pb-3 pr-3', 'style'=>'border: 1px dashed #c6c6c6;', 'col'=>'col-12 col-md-12',  'etiqueta'=>' IMAGEN' ,  'adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'div','nombre'=>'fechac', 'id' => 'fechac', 'titulo'=>'F.C:','contenido'=>$model->fechacreacion, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'div','nombre'=>'usuarioc', 'id' => 'usuarioc', 'titulo'=>'Usuario C:','contenido'=>$model->usuariocreacion0->username, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'div','nombre'=>'fechaa', 'id' => 'fechaa', 'titulo'=>'F.M:','contenido'=>$model->fechaact, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'div','nombre'=>'usuarioa', 'id' => 'usuarioa', 'titulo'=>'Usuario M:','contenido'=>$model->usuarioactualizacion0->username, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
    )
);

//$form = ActiveForm::begin(['id'=>'frmDatos','options' => ['enctype' => 'multipart/form-data']]);
$form = ActiveForm::begin(['id'=>'frmDatos']);
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'','adicional'=>'','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),

    )
);
ActiveForm::end();
//var_dump($objeto);

?>
   

<script>
       $(document).ready(function(){
       
        $("#guardar").on('click', function() {
            $('#guardar').val("Procesando..");
            $('#guardar').prop('disabled', true);
            if (validardatos()==true){
                var form = document.getElementById('frmDatos');
                var data = new FormData(form);
                var archivo=document.getElementById('imagen').files;
                data.append('archivo',archivo);
                $.ajax({
                    url: '<?= $urlpost ?>',
                    async: 'false',
                    cache: 'false',
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    //data: form.serialize(),
                    dataType: 'text', //Get back from PHP
                    processData: false, //Don't process the files
                    contentType: false,
                    cache: false,
                    data: data,
                    success: function(response){
                    data=JSON.parse(response);
                    //console.log(response);
                    //console.log(data.success);
                    if ( data.success == true ) {
                        // ============================ Not here, this would be too late
                        notificacion(data.mensaje,data.tipo);
                        //$this.data().isSubmitted = true;
                        //$('#frmDatos')[0].reset();
                        $("#label-imagen").text("");
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
            $('#guardar').removeAttr('disabled');
            $('#guardar').val("Actualizar");
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
            if ($('#nombre').val()!=""){
                if ($('#proveedores').val()!=-1){
                            return true;
                }else{
                    $('#proveedores').focus();
                    return false;
                }
            }else{
                $('#nombre').focus();
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

