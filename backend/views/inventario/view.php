<?php
use backend\components\Globaldata;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/* @var $this yii\web\View */
/* @var $model app\models\TriviaHead */

$this->title = 'Ver Stock';
$this->params['breadcrumbs'][] = ['label' => 'Administración de Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  



    <input type="hidden" id="action" value="nuevo">
    
    <input type="hidden" id="id" value="0">
    <div class="trivia-head-create">
        
        <div class="box-body" id="messages" style="display:none;"></div>
        <form class="" method="POST" id="formSlider" enctype="multipart/form-data">
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-xs-8">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Producto</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">                              
                                    <div class="col-md-9">
                                        <dt>
                                            <dd><?=$model->producto->nombreproducto?></dd>    
                                        <dt>
                                        <hr>
                                    
                                    </div>
                                    <div class="col-md-2">
                                        <a class="btn btn-info" id="btn-ok" style="display:none;"><i class="fa fa-check"></i></a>
                                        <a class="btn btn-danger" id="btn-danger" style="display:none;"><i class="fa fa-times"></i></a>
                                    </div>
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                               
              <div style="height:50px;"></div>    
                <div class="col-md-12 col-xs-12" id="contenido" >
                    <div class="box box-default">
                        <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>Presentación:</dt>
                            <dd><?= $model->presentacion->nombre; ?></dd>
                            <hr>
                            <dt>Cantidad Inicial:</dt>
                            <dd><?= $model->cantidadini; ?></dd>
                            
                            <dt>Unidades por Caja:</dt>
                            <dd><?= $model->cantidadcaja; ?></dd>
                            
                            <dt>Stock Actual:</dt>
                            <dd><?= $model->stock; ?></dd>
                            
                            <dt>Costo:</dt>
                            <dd><?= $model->precioint; ?></dd>
                            
                            <dt>Precio al por Mayor:</dt>
                            <dd><?= $model->preciov1; ?></dd>

                            <dt>Precio al por Menor:</dt>
                            <dd><?= $model->preciov2; ?></dd>

                            <dt>Precio de V. al Público:</dt>
                            <dd><?= $model->preciovp; ?></dd>
                            
                            <dt>Código de Barras:</dt>
                            <dd><?= $model->codigobarras; ?></dd>

                            <dt>Código de Barras Caja:</dt>
                            <dd><?= $model->codigocaja; ?></dd>

                            <hr>
                            <dt>Fecha de Creación:</dt>
                            <dd><?= GlobalData::strToMysqlDateFormat($model->fechacreacion, "Y-m-d H:i:s", "d-m-Y H:i:s") ?></dd>
                            
                            <dt>Modificado por:</dt>
                            <dd><?= ($flagDataMod) ? $userDataMod['fullname'] : " - "; ?></dd>
                            
                            </dl>                            
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
                            <dl class="">
                            <dt>Imagen</dt>
                                
                            </dl>
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



