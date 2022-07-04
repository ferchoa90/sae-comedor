
  <?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use common\models\Clases;
use common\models\Pintura;
use common\models\Cuadros;


$this->title = 'Confirmación de transacción';
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
<?php if ($success == true): ?>
        
        <div class="row col-md-12">
            <div class="alert alert-success text-center col-md-12" >
                <strong><span class="carrito-tit">Gracias</span></strong>, El pago se realizó exitosamente
                
            </div>

        </div>
        <div class="row col-md-12" style=" color:black; line-height: 30px;">
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-6"><strong>Pedido # </strong> <?=$model->id?> </div>
            <div class="col-md-3">&nbsp;</div>
            
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-6"><strong>Pago Paypal ID: </strong> <?=$model->paymentid?> </div>
            <div class="col-md-3">&nbsp;</div>
            
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-6"><strong>Valor: </strong> <?=$model->total?> </div>
            <div class="col-md-3">&nbsp;</div>
            
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-6"><strong>Fecha: </strong> <?=$model->fechacreacion?></div>
            <div class="col-md-3">&nbsp;</div>

        </div>
        <br>
        <div class="row col-md-12" style=" color:black; ">
            <div class=" text-center col-md-12" >
            Pronto nos contactaremos contigo y te daremos indicaciones de tu reserva / compra. No olvides tener a la mano tu número de pedido.
            <br>
            <br>
               <img src="<?= URL::base() ?>/images/LogoMonAtelier.png" alt="" style="width: 200px">
            <br/>
            <br/>
            </div>
        </div>
 

    <?php else: ?>
        <div style="text-align: center;">
            <div class="alert alert-warning  text-center col-md-12">
            <strong><span class="carrito-tit">Pago Fallido</span></strong>, Ha ocurrido un error al procesar su pago, intente nuevamente más tarde.
           
            </div>
        </div>
        <br>
        <div class="row col-md-12  text-center " style=" color:black; ">
            <div class=" text-center col-md-12" >
            En caso de persistir el problema, revisa tu cuenta <strong>PAYPAL</strong> que posea una tarjeta, y que sea válida. Tambien puedes contactarte con tu entidad financiera y consultar sobre el problema de autorización.
            <br><br/>
            <span>Puedes optar por hacer una transferencia a los siguientes datos:</span>
            <br/>
            <span><strong>Banco:</strong> Banco del Pacífico</span><br/>
            <span><strong>Cuenta:</strong> 1048379042</span><br/>
            <span><strong>Tipo:</strong> Ahorros</span><br/>
            <span><strong>Nombre:</strong> José Naranjo</span><br/>
            <span><strong>Cédula:</strong> 1719148742</span><br/>
            <br/><br/>
            <span>No olvides enviar una captura de pantalla o comprobante del depósito / transferencia donde indique la fecha y monto realizado.</span></dd>

            <br>
<br>
            
               <img src="<?= URL::base() ?>/images/LogoMonAtelier.png" alt="" style="width: 200px">
            <br/>
            <br/>
            </div>
        </div>
    <?php endif; ?>
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

 