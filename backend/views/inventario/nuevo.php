<?php
use backend\components\Objetos;
use backend\components\Bloques;
use backend\components\Botones;
use backend\components\Iconos;
use backend\components\Contenido;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\View;

$this->title = 'Agregar Stock';
$this->params['breadcrumbs'][] = ['label' => 'Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$urlpost='formnuevostock';

$objeto= new Objetos;
$contenidoClass= new contenido;
$div= new Bloques;
 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  



    <input type="hidden" id="action" value="nuevo">
    
    <input type="hidden" id="id" value="0">
    <div class="trivia-head-create">
 
        <div class="box-body" id="messages" style="display:none;"></div>
        
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-xs-8">
                    <div class="box box-success">
                       
                        <div class="box-body mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row form-group">                              
                                    <div class="col-md-9">
                                        <input type="text" name="producto" id="producto" class="form-control pull-right" autocomplete="off" placeholder="Seleccione el producto" />
                                    </div>
                                    <div class="col-md-2">
                                        <a class="btn btn-info" id="btn-ok" style="display:none;"><i class="fa fa-check"></i></a>
                                        <a class="btn btn-danger" id="btn-danger" style="display:none;"><i class="fa fa-times"></i></a>
                                    </div>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                               
              <div style="height:50px;"></div>    
                 

                            </div><!-- /.row -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>

                 
            </div>
            <div class="row" style="display:none;"  >
                
            </div>
        </div>
     
        <!--<div class="box-body">
            <a class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Guardar</a>
        </div>-->
    </div>

 
 
<?php



$this->registerJs(
    "
    var subjects = [
    
        ];   
 
        
function inicializarProductos() {
    if (localStorage.getItem('listaProductos')) {
        dataProductos = JSON.parse(localStorage.getItem('listaProductos'));
        cargarProductos();    
    } else {
        if (!localStorage.getItem('listaProductos')) {
            //listarFacturas();
            localStorage.setItem('listaProductos', JSON.stringify(dataProductos));
        }
    }
}

var productosItem=false;
      
        
$(document).ready(function(){
    loading(1);
    $.ajax({
        url:\"productoskardex\",
        method:\"POST\",
        
        dataType:\"json\",
        success:function(data)
        {
            localStorage.setItem('listaProductos', JSON.stringify(data));
            productosItem=true;
            loading(0);

        }
    });

    $('#producto').dblclick(function(){
        $('#producto').val('');
    });
 
    $('#producto').typeahead({
        source: function(query, result)
        {
            if ($('#producto').val().length>0){
            if (localStorage.getItem('listaProductos') || productosItem) {
            
               dataProductos = JSON.parse(localStorage.getItem('listaProductos'));
               result($.map(dataProductos, function(item){
                   $('#btn-ok').fadeIn(); 
                   return item;
               }));
           } else {
               if (!localStorage.getItem('listaProductos')) {
            
                   $.ajax({
                       url:\"productoskardex\",
                       method:\"POST\",
                       data:{query:query},
                       dataType:\"json\",
                       success:function(data)
                       {
                           localStorage.setItem('listaProductos', JSON.stringify(data));
                           productosItem=true;
                           result($.map(data, function(item){
                               $('#btn-ok').fadeIn(); 
                           return item;
                           }));
                       }
                   })
                   
               }
           }
       }
        }
       });
   

    $('#producto').keypress(function(e) {

        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){
            obtenerProducto(this.value);
            
        }
    });
    
   });

   function obtenerProducto(nombre){
       //console.log('obtenerP '+nombre)
       $('#idproducto').val(0)
       $.ajax({
        url:\"productoindividual\",
        method:\"POST\",
        data:{nombrep:nombre},
        dataType:\"json\",
        success:function(data)
        {
            console.log(data[0].titulo);
            if (data)
            {
                $('#idproducto').val(data[0].id)
                $('#preview').attr('src' ,'/frontend/web/images/articulos/'+data[0].imagen)
                $('#presentacion').focus();

            }else{
                $('#idproducto').val(data[0].id)
                $('#preview').attr ( 'src' ,'/frontend/web/images/articulos/'+data[0].imagen)
                $('#presentacion').focus();
            }
            $('#btn-ok').hide(); 
            $('#btn-danger').fadeIn(); 
            $('#div1').fadeIn(); 
            $('#div2').fadeIn(); 
            $('#producto').prop('disabled', true);
        }
       })
   }
     
    $('#btn-ok').click(function() { 
        obtenerProducto( $('#producto').val());
        if ($('#idproducto').val() > 0){
            $('#div1').fadeIn(); 
            $('#div2').fadeIn(); 
            $('#btn-ok').fadeOut(); 
            $('#btn-danger').fadeIn(); 
        }else{
            showMessages('Error', 'Debe seleccionar un producto', 'warning');
        }
        
    }); 

    $('#btn-danger').click(function() { 
        
        $('#div1').fadeOut(); 
        $('#div2').fadeOut(); 
        $('#btn-danger').fadeOut(); 
        
        $('#producto').prop('disabled', false);
        $('#producto').val('');
        $('#producto').focus();

    }); 

    $('#producto').focus();

    ",
    View::POS_END,
    'subjects'
);

 


$contenido=$objeto->getObjetosArray(
    array(
        array('tipo'=>'input','subtipo'=>'oculto', 'nombre'=>'idproducto', 'id'=>'idproducto', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'sucursal', 'id'=>'sucursal', 'valor'=>$sucursal,'valordefecto'=>1, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Sucursal: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'presentacion', 'id'=>'presentacion', 'valor'=>$presentacion,'valordefecto'=>1, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Presentación: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'color', 'id'=>'color', 'valor'=>$color, 'onchange'=>'','valordefecto'=>1, 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Color: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'select','subtipo'=>'', 'nombre'=>'clasificacion', 'id'=>'clasificacion', 'valor'=>$clasificacion,'valordefecto'=>1, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Clasificación: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'stockinicial', 'id'=>'stockinicial', 'valor'=>'1', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Stock Inicial: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'unidadescaja', 'id'=>'unidadescaja', 'valor'=>'1', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Unidades Caja: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'stockactual', 'id'=>'stockactual', 'valor'=>'1', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Stock: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'costo', 'id'=>'costo', 'valor'=>'0,00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Costo: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'pvpfinal', 'id'=>'pvpfinal', 'valor'=>'0,00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'PVP FINAL: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'pvp1', 'id'=>'pvp1', 'valor'=>'0,00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'PVP1: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'moneda', 'nombre'=>'pvp2', 'id'=>'pvp2', 'valor'=>'0,00', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'PVP2: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'codigobarras', 'id'=>'codigobarras', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Código de Barras: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
        
    ),true
);

 $botones= new Botones; $botonC=$botones->getBotongridArray(
    array(
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'link','nombre'=>'guardar', 'id' => 'guardar', 'titulo'=>'&nbsp;Guardar', 'link'=>'', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'nuevounidad', 'id' => 'nuevounidad', 'titulo'=>'&nbsp;Agregar Unidad', 'link'=>'nuevounidad', 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'guardar','tamanio'=>'pequeño',  'adicional'=>''),
        array('tipo'=>'link','nombre'=>'regresar', 'id' => 'regresar', 'titulo'=>'&nbsp;Regresar', 'link'=>'', 'onclick'=>'history.back()' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','tamanio'=>'pequeño',  'adicional'=>'')

));

$contenidoClass= new contenido;
$stylestatus="badge-success";
$estatus='<span class="badge '.$stylestatus.'"><i class="fa fa-circle"></i>&nbsp;&nbsp;ACTIVO</span>';
$contenido2=$contenidoClass->getContenidoArrayr(
    array(
              array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
    )
);

$contenido2=$contenidoClass->getContenidoArrayr(
    array(
        array('tipo'=>'div','nombre'=>'estatus', 'id' => 'estatus', 'titulo'=>'Estatus:&nbsp;&nbsp;','contenido'=>$estatus, 'col'=>'col-12 col-md-9','clase'=>'', 'style'=>'', 'tipocolor'=>'azul', 'icono'=>'regresar','adicional'=>''),
        array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
        array('tipo'=>'image','nombre'=>'preview', 'id' => 'preview', 'src'=>'defalut.png','clase'=>'pb-3 pr-3', 'style'=>'border: 1px dashed #c6c6c6;', 'col'=>'col-12 col-md-12',  'etiqueta'=>' IMAGEN' ,  'adicional'=>''),
        
        
    ),true
);


//$form = ActiveForm::begin(['id'=>'frmDatos','options' => ['enctype' => 'multipart/form-data']]);
$form = ActiveForm::begin(['id'=>'frmDatos']);
 echo $div->getBloqueArray(
    array(
        array('tipo'=>'bloquediv','nombre'=>'div1','id'=>'div1','titulo'=>'Datos','clase'=>'col-md-9 col-xs-12 ','style'=>'display:none;','col'=>'','tipocolor'=>'','adicional'=>' ','contenido'=>$contenido.$botonC),
        array('tipo'=>'bloquediv','nombre'=>'div2','id'=>'div2','titulo'=>'Información','clase'=>'col-md-3 col-xs-12 ','style'=>'display:none;','col'=>'','tipocolor'=>'gris','adicional'=>'','contenido'=>$contenido2),

    )
);
ActiveForm::end();
//var_dump($objeto);

?>
   

<script>
       $(document).ready(function(){
        $("#guardar").on('click', function() {
            if (validardatos()==true){
                var form = document.getElementById('frmDatos');
                var data = new FormData(form);
                loading(1);
                
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
                        loading(0);
                        //$this.data().isSubmitted = true;
                        $('#frmDatos')[0].reset();
                        $("#label-imagen").text("");
                        $("#btn-danger").click();
                        notificacion(data.mensaje,data.tipo);
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


       var currencyInput = document.querySelector('input[id="costo"]');
 var currencyInput2 = document.querySelector('input[id="pvpfinal"]');
 var currencyInput3 = document.querySelector('input[id="pvp1"]');
 var currencyInput4 = document.querySelector('input[id="pvp2"]');
 
var currency = 'USD'; // https://www.currency-iso.org/dam/downloads/lists/list_one.xml

currencyInput.addEventListener('focus', onFocus);
currencyInput.addEventListener('blur', onBlur);
currencyInput2.addEventListener('focus', onFocus);
currencyInput2.addEventListener('blur', onBlur);
currencyInput3.addEventListener('focus', onFocus);
currencyInput3.addEventListener('blur', onBlur);
currencyInput4.addEventListener('focus', onFocus);
currencyInput4.addEventListener('blur', onBlur);


function localStringToNumber( s ){
    s=String(s).replace("00","")
    s=String(s).replace(",",".")
    return Number(String(s).replace(/[^0-9.-]+/g,""));
}

function onFocus(e){
    //e.target.value=String(s).replace(",",".")
  var value = e.target.value;

  e.target.value = value ? localStringToNumber(value) : '';
}

function onBlur(e){
  var value = e.target.value;

  const options = {
      maximumFractionDigits : 2,
      currency              : currency,
      //style                 : "currency",
      //currencyDisplay       : "symbol"
  }
  
  e.target.value = value 
    ? localStringToNumber(value).toLocaleString(undefined, options)
    : ''
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

