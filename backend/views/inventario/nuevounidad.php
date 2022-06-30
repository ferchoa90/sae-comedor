<?php







use yii\helpers\Html;



use yii\helpers\Url;



use yii\web\View;

/* @var $this yii\web\View */

/* @var $model app\models\TriviaHead */



$this->title = 'Agregar Stock Unidad';

$this->params['breadcrumbs'][] = ['label' => 'Administración de Inventario', 'url' => ['index']];

$this->params['breadcrumbs'][] = $this->title;



?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  







    <input type="hidden" id="action" value="nuevo">

    

    <input type="hidden" id="id" value="0">

    <div class="trivia-head-create">

        <div class="box-body">

            <a class="btn btn-success" id="btn_save"><i class="fa fa-save"></i>&nbsp; Guardar</a>

            

        </div>

        <div class="box-body" id="messages" style="display:none;"></div>

        <form class="" method="POST" id="formSlider" enctype="multipart/form-data">

        <div class="box-body">

            <div class="row">

                <div class="col-md-8 col-xs-8">

                    <div class="box box-success">

                        <div class="box-header with-border">

                            <h3 class="box-title">Seleccione el producto</h3>

                        </div><!-- /.box-header -->

                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">                              

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

                <div class="col-md-12 col-xs-12" id="contenido" style="display:none;">

                    <div class="box box-default">

                        <div class="box-body">

                            <!-- Date and time range -->

                            

                            <div class="form-group col-md-4 col-xs-4" >

                                <label>Presentación:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <select class="form-control select2" style="width: 100%;" id="presentacion">

                                        <option >seleccione...</option>

                                        <?php foreach ($presentaciones as $key => $value) { ?>

                                            <option <?php if($value->id==7){ echo 'selected="selected"'; } ?> value="<?=$value->id ?>"><?=$value->nombre ?></option>

                                        <?php } ?>

                                    </select>

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4"  style="display:none;">

                                <label>Stock Inicial:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="number" class="form-control pull-right" id="stocki" name="stocki" min=1 value="1">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4"  style="display:none;">

                                <label>Unidades por Caja:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="number" class="form-control pull-right" id="stockf" name="stockf" min=1 value="1">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4" style="display:none;">

                                <label>Stock Actual:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="number" class="form-control pull-right" id="stock" name="stock" min=1 value="1">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4"  style="display:none;">

                                <label>Costo:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="currency" class="form-control pull-right" id="precioi" name="precioi" value="0,00">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4"  style="display:none;">

                                <label>Precio V1 (x mayor):</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="currency" class="form-control pull-right" id="preciov1" name="preciov1" value="0,00">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4"  style="display:none;">

                                <label>Precio V2 (x menor):</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="currency" class="form-control pull-right" id="preciov2" name="preciov2" value="0,00">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">

                                <label>Precio VP:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="currency" class="form-control pull-right" id="preciovp" name="preciovp" value="0,00">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">

                                <label>Código Barras Unidad:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="number" class="form-control pull-right" id="codigob" name="codigob">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->



                            <div class="form-group col-md-4 col-xs-4"  style="display:none;">

                                <label>Código Barras Caja:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="number" class="form-control pull-right" id="codigoc" name="codigoc">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            

                           

                            

                            <input type="hidden" id="idproducto" name="idproducto" value="">

                            <input type="hidden" id="token" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">

                            

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->

                </div>



                            </div><!-- /.row -->

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->

                </div>



                <div class="col-md-4 col-xs-4">

                    <div class="box box-info">

                        <div class="box-header with-border">

                            <h3 class="box-title">Información</h3>

                        </div><!-- /.box-header -->

                        <div class="box-body">

                            <dl class="dl-horizontal">

                                <dt>Imagen</dt>

                                

                            </dl>

                            <div class="col-md-12 col-xs-12">

                            <img id="preview" src="" style="max-width: 99%;" />

                            </div>

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->

                </div>

            </div>

            <div class="row" style="display:none;"  >

                

            </div>

        </div>

        </form>

        <!--<div class="box-body">

            <a class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Guardar</a>

        </div>-->

    </div>



    <script>

 var currencyInput = document.querySelector('input[type="currency"]');

 var currencyInput2 = document.querySelector('input[id="preciov1"]');

 var currencyInput3 = document.querySelector('input[id="preciov2"]');

 var currencyInput4 = document.querySelector('input[id="preciovp"]');

 

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

 

<?php

$this->registerJs(

    "

    var subjects = [

        \"Where's My Stuff?\",

        \"Cancel Items or Orders\",

        \"Returns & Refunds\",

        \"Shipping Rates & Information\",

        \"Change Your Payment Method\",

        \"Manage Your Account Information\",

        \"About Two-Step Verification\",

        \"Cancel Items or Orders\",

        \"Change Your Order Information\",

        \"Contact Third-Party Sellers\",

        \"More in Managing Your Orders\"

        ];   

      

        

$(document).ready(function(){

 

    loading(1);

    $.ajax({

        url:\"inventariokardex\",

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

                    url:\"inventariokardex\",

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

        //no recuerdo la fuente pero lo recomiendan para

        //mayor compatibilidad entre navegadores.

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

        url:\"productoindividuale\",

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

            $('#contenido').fadeIn(); 

            $('#producto').prop('disabled', true);

        }

       })

   }

     

    $('#btn-ok').click(function() { 

        if ($('#idproducto').val() > 0){

            $('#contenido').fadeIn(); 

            $('#btn-ok').fadeOut(); 

            $('#btn-danger').fadeIn(); 

        }else{

            showMessages('Error', 'Debe seleccionar un producto', 'warning');

        }

        

    }); 



    $('#btn-danger').click(function() { 

        $('#contenido').fadeOut(); 

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



$this->registerJs(

    ''//'$("document").ready(function(){ alert("hi"); });'

);

 

$this->registerJsFile(URL::base() . "/js/plugins/bootstrap3-typeahead.min.js", [

    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]

]);



$this->registerCssFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker-bs3.css", [

    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]

]);



$this->registerJsFile(URL::base() . "/js/plugins/moment.min.js", [

    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]

]);





$this->registerJsFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker.js", [

    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]



]);



$this->registerJsFile(URL::base() . "/js/class/inventariouNew.js", [

    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]

]);







