<?php







use yii\helpers\Html;



use yii\helpers\Url;



use yii\web\View;

/* @var $this yii\web\View */

/* @var $model app\models\TriviaHead */



$this->title = 'Editar Stock';

$this->params['breadcrumbs'][] = ['label' => 'Administración de Inventario', 'url' => ['index']];

$this->params['breadcrumbs'][] = $this->title;



$active = "";

$inactive = "";

if ($model->estatus == 'ACTIVO') {

    $active = ' selected="selected" ';

} else {

    $inactive = ' selected="selected" ';

}





?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  







    <input type="hidden" id="action" value="update?id=<?= $model->id ?>">

    

    <input type="hidden" id="id" value="0">

    <div class="trivia-head-create">

        <div class="box-body">

            <a class="btn btn-success" id="btn_update"><i class="fa fa-save"></i>&nbsp; Actualizar</a>

        </div>

        <div class="box-body" id="messages" style="display:none;"></div>

        <form class="" method="POST" id="formSlider" enctype="multipart/form-data">

        <div class="box-body">

            <div class="row">

                <div class="col-md-8 col-xs-8">

                    <div class="box box-success">

                        <div class="box-header with-border">

                            

                            <h3 class="box-title">Configuración del Stock</h3>

                        </div><!-- /.box-header -->

                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">                              

                                    <div class="col-md-4 col-xs-6">

                                        <label>Nombre del Producto</label>

                                        <dt>

                                            <dd><?=$model->producto->nombreproducto.' '.$model->producto->descripcion?></dd>    

                                        <dt>

                                    </div>

                                    <div class="col-md-4 col-xs-6">

                                        <label>Estado</label>

                                        <select class="form-control select2" style="width: 100%;" id="estado">

                                            <option <?=$active ?> value="ACTIVO">ACTIVO</option>

                                            <option <?=$inactive ?> value="INACTIVO">INACTIVO</option>

                                        </select>

                                    </div>



                                    



                                  

                                    </div><!-- /.form-group -->

                                </div><!-- /.col -->

                               

              <div style="height:70px;"></div>    

                <div class="col-md-12 col-xs-12" id="contenido" >

                    <div class="box box-default">

                        <div class="box-body">

                            <!-- Date and time range -->

                            <div class="form-group col-md-4 col-xs-4">
                                <label>Sucursal:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <select class="form-control select2" style="width: 100%;" id="sucursal" name="sucursal">
                                        <option >seleccione...</option>
                                        <?php $cont=0; foreach ($sucursal as $key => $value) { ?>
                                            <option value="<?=$value->id ?>" <?php if ($value->id==$model->idsucursal){ echo 'selected="selected"'; } ?>   ><?=$value->nombre ?></option>
                                        <?php $cont++; } ?>
                                    </select>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">

                                <label>Presentación:</label> 

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <select class="form-control select2" style="width: 100%;" id="presentacion" name="presentacion">

                                        <option >seleccione...</option>

                                        <?php foreach ($presentaciones as $key => $value) { ?>

                                            <option <?php if ($value->id==$model->idpresentacion){ echo 'selected="selected"'; } ?> value="<?=$value->id ?>"><?=$value->nombre ?></option>

                                        <?php } ?>

                                    </select>

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">
                                <label>Color:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <select class="form-control select2" style="width: 100%;" id="color" name="color">
                                        <option >seleccione...</option>
                                        <?php $cont=0; foreach ($color as $key => $value) { ?>
                                            <option value="<?=$value->id ?>" <?php if ($value->id==$model->idcolor){ echo 'selected="selected"'; } ?>  ><?=$value->nombre ?></option>
                                        <?php $cont++; } ?>
                                    </select>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">
                                <label>Calidad:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <select class="form-control select2" style="width: 100%;" id="calidad" name="calidad">
                                        <option >seleccione...</option>
                                        <?php $cont=0; foreach ($calidad as $key => $value) { ?>
                                            <option value="<?=$value->id ?>" <?php if ($value->id==$model->idcalidad){ echo 'selected="selected"'; } ?>  ><?=$value->nombre ?></option>
                                        <?php $cont++; } ?>
                                    </select>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">
                                <label>Tipo D:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <select class="form-control select2" style="width: 100%;" id="clasificacion" name="clasificacion">
                                        <option >seleccione...</option>
                                        <?php $cont=0; foreach ($clasificacion as $key => $value) { ?>
                                            <option value="<?=$value->id ?>"  <?php if ($value->id==$model->idclasificacion){ echo 'selected="selected"'; } ?>  ><?=$value->nombre ?></option>
                                        <?php $cont++; } ?>
                                    </select>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">

                                <label>Stock Inicial:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="number" class="form-control pull-right" id="stocki" name="stocki" min=1 value="<?=$model->cantidadini ?>">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">

                                <label>Unidades por Caja:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="number" class="form-control pull-right" id="stockf" name="stockf" min=1 value="<?=$model->cantidadcaja ?>">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">

                                <label>Stock Actual:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="number" class="form-control pull-right" id="stock" name="stock" min=1 value="<?=$model->stock ?>">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">

                                <label>Costo:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="currency" class="form-control pull-right" id="precioi" name="precioi" value="<?=$model->precioint ?>">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">

                                <label>Precio V1 (x mayor):</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="currency" class="form-control pull-right" id="preciov1" name="preciov1" value="<?=$model->preciov1 ?>">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">

                                <label>Precio V2 (x menor):</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="currency" class="form-control pull-right" id="preciov2" name="preciov2" value="<?=$model->preciov2 ?>">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">

                                <label>Precio VP:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="currency" class="form-control pull-right" id="preciovp" name="preciovp" value="<?=$model->preciovp ?>">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            <div class="form-group col-md-4 col-xs-4">

                                <label>Código Barras Unidad:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="number" class="form-control pull-right" id="codigob" name="codigob" value="<?=$model->codigobarras ?>">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->



                            <div class="form-group col-md-4 col-xs-4">

                                <label>Código Barras Caja:</label>

                                <div class="input-group">

                                    <div class="input-group-addon">

                                        <i class="fa fa-pencil"></i>

                                    </div>

                                    <input type="number" class="form-control pull-right" id="codigoc" name="codigoc" value="<?=$model->codigocaja ?>">

                                </div><!-- /.input group -->

                            </div><!-- /.form group -->

                            

                           

                            

                            <input type="hidden" id="idproducto" name="idproducto" value="<?=$model->id ?>">

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

                            <div class="col-md-12 col-xs-12">

                            <img id="preview" src="/frontend/web/images/articulos/<?=$model->producto->imagen?>" style="max-width: 97%;" />

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

        \"More in Managing Your Orders\"

        ];   

      

        

$(document).ready(function(){

  

    $('#btn-ok').click(function() { 

       

    }); 



    $('#btn-danger').click(function() { 

      

    }); 



   // $('#producto').focus();



});

    ",

    View::POS_END,

    'subjects'

);



$this->registerJs(

    ''//'$("document").ready(function(){ alert("hi"); });'

);

 





$this->registerCssFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker-bs3.css", [

    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]

]);



$this->registerJsFile(URL::base() . "/js/plugins/moment.min.js", [

    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]

]);





$this->registerJsFile(URL::base() . "/js/plugins/daterangepicker/daterangepicker.js", [

    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]



]);



$this->registerJsFile(URL::base() . "/js/class/inventarioNew.js", [

    'depends' => [\yii\bootstrap\BootstrapPluginAsset::className()]

]);







