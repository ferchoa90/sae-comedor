
  <?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use common\models\Clases;
use common\models\Pinturas;
use common\models\Cuadros;


$this->title = ' Tienda virtual';
$this->params['breadcrumbs'][] = $this->title;


$script = <<< JS
$(document).ready(function () {       
    jQuery(document).ready(function ($) {
  
    });
});
JS;
$this->registerJs($script, View::POS_END);

?>
 
<script src="https://use.fontawesome.com/c560c025cf.js"></script>
<div class="container"  style="padding-bottom: 20px; padding-top: 10px;">
   <div class="card shopping-cart">
            <div class="card-header bg-dark text-light">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Carrito de compras
                <a href="<?= URL::base() ?>/site/clases" class="btn btn-outline-info btn-sm pull-right">Continuar navegando</a>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">
                    <!-- PRODUCT -->
                    <?php $valortotal=0; ?>
                    <?php foreach ($model as $key => $value) { ?>
                    <?php if (!$value->idproducto==0) { $item=Cuadros::find()->where(["id"=>$value->idproducto])->one();} ?>
                    <?php if (!$value->idclase==0) { $item=Clases::find()->where(["id"=>$value->idclase])->one();} ?>
                    <?php if (!$value->idpintura==0) { $item=Pinturas::find()->where(["id"=>$value->idpintura])->one();} ?>
                    <?php if ($value->tipocompra==1) { $valor=$item->valor;}else{  $valor=$item->reserva; } ?>
                    <?php $valor=number_format(($valor*$value->cantidad),2); ?>
                    <?php $valortotal+=$valor; ?>
                    <div class="row">
                        <input type="hidden" id="clase-<?= $value->id ?>" value="<?=$value->idclase?>">
                        <input type="hidden" id="producto-<?= $value->id ?>" value="<?=$value->idproducto?>">
                        <input type="hidden" id="pintura-<?= $value->id ?>" value="<?=$value->idpintura?>">
                        <input type="hidden" id="tipo-<?= $value->id ?>" value="<?=$value->tipocompra?>">
                        <div class="col-12 col-sm-12 col-md-2 text-center">
                                <img class="img-responsive" src="<?= URL::base() ?>/images/<?= $item->imagen ?>" alt="prewiew" width="90" height="100">
                        </div>
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                            <h4 class="product-name"><strong>Producto:</strong></h4>
                            <h4>
                                <small><?= $item->nombre ?><?php if ($value->tipocompra==2){ echo ' (Reserva)'; } ?></small>
                            </h4>
                        </div>
                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                                <h4><strong><?= $valor ?> <span class="text-muted"></span></strong></h4>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4">
                                <div class="quantity">
                                    <input type="button" onclick="javascript: enviarItem('<?=$value->tipocompra?>','+','<?= $value->id ?>');" value="+" class="plus">
                                    <input id="cantidad-<?= $value->id ?>"  onchange="javascript: enviarItem('<?=$value->tipocompra?>','','<?= $value->id ?>');" name="cantidad-<?= $value->id ?>" type="number" step="1" max="5" min="1" value="<?= $value->cantidad ?>" title="Qty" class="qty"
                                           size="4">
                                    <input type="button" onclick="javascript: enviarItem('<?=$value->tipocompra?>','-','<?= $value->id ?>');" value="-" class="minus">
                                </div>
                            </div>
                            <div class="col-2 col-sm-2 col-md-2 text-right">
                                <button onclick="javascript: enviarItem('<?=$value->tipocompra?>','x','<?= $value->id ?>');" type="button" class="btn btn-outline-danger btn-xs">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php } ?>
                    <!-- END PRODUCT -->
                    <!-- PRODUCT -->
                    <!-- <div class="row">
                        <div class="col-12 col-sm-12 col-md-2 text-center">
                                <img class="img-responsive" src="http://placehold.it/120x80" alt="prewiew" width="120" height="80">
                        </div>
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                            <h4 class="product-name"><strong>Product Name</strong></h4>
                            <h4>
                                <small>Product description</small>
                            </h4>
                        </div>
                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                                <h6><strong>25.00 <span class="text-muted">x</span></strong></h6>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4">
                                <div class="quantity">
                                    <input type="button" value="+" class="plus">
                                    <input type="number" step="1" max="99" min="1" value="1" title="Qty" class="qty"
                                           size="4">
                                    <input type="button" value="-" class="minus">
                                </div>
                            </div>
                            <div class="col-2 col-sm-2 col-md-2 text-right">
                                <button type="button" class="btn btn-outline-danger btn-xs">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr> -->
                    <!-- END PRODUCT -->
                <div class="pull-right">
                    <!-- <a href="" class="btn btn-outline-secondary pull-right">
                        Actualizar carrito
                    </a> -->
                    <div class="pull-right" style="margin: 5px; color: black;text-align: right; padding-right:10px;">
                        <b>Subtotal: </b>$ <?= number_format($valortotal,2); ?><br/>
                        <b>Iva: </b>$ <?= number_format(($valortotal*1.12)-$valortotal,2); ?><br/>
                        <b>Total: </b>$ <?= number_format($valortotal*1.12,2); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="coupon col-md-5 col-sm-5 no-padding-left pull-left">
                   <!--  <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="cupone code">
                        </div>
                        <div class="col-6">
                            <input type="submit" class="btn btn-default" value="Use cupone">
                        </div>
                    </div> -->
                </div>
                <div class="pull-right" style="margin: 10px">
                    
                    <a href="" class="btn btn-monatelier btn-orange pull-right">Checkout</a>
                </div>
            </div>
        </div>
</div>
<style>

.quantity {
    float: left;
    margin-right: 15px;
    background-color: #eee;
    position: relative;
    width: 80px;
    overflow: hidden
}

.quantity input {
    margin: 0;
    text-align: center;
    width: 15px;
    height: 15px;
    padding: 0;
    float: right;
    color: #000;
    font-size: 20px;
    border: 0;
    outline: 0;
    background-color: #F6F6F6
}

.quantity input.qty {
    position: relative;
    border: 0;
    width: 100%;
    height: 40px;
    padding: 10px 25px 10px 10px;
    text-align: center;
    font-weight: 400;
    font-size: 15px;
    border-radius: 0;
    background-clip: padding-box
}

.quantity .minus, .quantity .plus {
    line-height: 0;
    background-clip: padding-box;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    -webkit-background-size: 6px 30px;
    -moz-background-size: 6px 30px;
    color: #bbb;
    font-size: 20px;
    position: absolute;
    height: 50%;
    border: 0;
    right: 0;
    padding: 0;
    width: 25px;
    z-index: 3
}

.quantity .minus:hover, .quantity .plus:hover {
    background-color: #dad8da
}

.quantity .minus {
    bottom: 0
}
.shopping-cart {
    margin-top: 20px;
}
.card-body
{
    color: black;
}
</style>

<script>
function enviarItem(tipo,operador,id)
{
    var eliminar=false;
    var idproducto=document.getElementById('producto-'+id).value;
    var idclase=document.getElementById('clase-'+id).value;
    var idpinturas=document.getElementById('pintura-'+id).value;
    var tipocompra=document.getElementById('tipo-'+id).value;
    var cantidad=document.getElementById('cantidad-'+id).value;
    if (operador=='+'){ cantidad=parseInt(cantidad)+1; }
    if (operador=='-'){ cantidad=parseInt(cantidad)-1; }
    if (operador=='x'){ cantidad=0; eliminar=true; }
    if (operador==''){ cantidad= document.getElementById('cantidad-'+id).value; }
    if (cantidad==0 && eliminar==false){ cantidad=1;}
    if (cantidad<0 && eliminar==false){ cantidad=1;}
    
    agregarItem(idproducto, idclase, idpinturas, tipocompra,cantidad,1);
}
</script>