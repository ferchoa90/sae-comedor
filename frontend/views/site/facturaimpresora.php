<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use common\models\UserComprasDetalle;

$this->title = 'SAE - Sistema Administrativo Contable';

?>

<body style="text-align:center;">

    <div>

        <img style="width:100px;    vertical-align: middle;" src="<?= URL::base()?>/images/logotodosvuelven.png" />

        

    </div>

    <div class="center-titulos">

        <span> <strong>SEYOURY AYOUB HISHAM KHADER</strong></span>

        <br> <?= Yii::$app->user->identity->sucursal->nombre; ?>

        <br><strong>RUC: </strong>0965174618001

    </div>



    <div class="left-titulos">

         

        <br><strong>COMPROBANTE ELECTRÓNICO:  </strong>001 - 001 - <?= str_pad($factura->nfactura, 3, '0', STR_PAD_LEFT); ?>

        <br><strong>Fecha:  </strong><?=date('d', strtotime(str_replace('-', '/', $factura->fechacreacion)));   ?> Julio del 2022

        <br><strong>Cliente:  </strong><?=$factura->cliente->razonsocial ?>

        <br><strong>Ruc / Ci:  </strong><?=$factura->cliente->cedula ?>

        

    </div>

    <hr>

     <div class="left-titulos">

     <table class="table table-hover">

        <thead>

            <tr>

            <th scope="col">CANT</th>

            <th scope="col">PRODUCTO</th>

            

            <th scope="col">V UNI</th>

            <th scope="col">TOTAL</th>

            

            </tr>

        </thead>

        

        <tbody id="contenidoCompra">

            <?php foreach ($factura->facturadetalles as $key => $value) { ?>

                

                <tr style="    text-align: center;" >

                    <td><?=$value->cantidad?></td>

                    <td><?=$value->narticulo.' - '.$value->tarticulo ?></td> 
                    <td><?=number_format($value->valoru,2)?></td><td id="preciot-1"><?=number_format($value->valort ,2)?></td>

                </tr>



            <?php } ?>

            <tr style="    text-align: center;display:none;" >

                    <td> </td>

                    <td> </td>
                    

                    <th scope="col">Subtotal</th>

                    <th scope=" "><?=$factura->subtotal?></th>


                </tr>

                <tr style="    text-align: center;display:none;" >

                    <td> </td>

                    <td> </td>
               

                    <th scope="col">Iva (12%)</th>

                    <th scope=" "><?=$factura->iva?></th>


                </tr>

                <tr style="    text-align: center;" >

                                    <td> </td>

                                    <td> </td>
                                   
                                    <th scope="col">Total</th>

                                    <th scope=" "><?=$factura->total?></th>


                                </tr>
                

        </tbody>

    </table>



  

   
        

    </div>

    <hr>

    <div class="left-titulos">

         

        <br><strong>Pago:  </strong>Efectivo
        <br>Emitida la factura, no se aceptan devoluciones ni cambios
        <br>Documento sin valor tributario, puede encontrar su factura electrónica en la web.

        <br>Horario de Atención:  </strong>Lunes a Sábado de 14:00 a 22:30, 
        <br><strong>Cajero:  <?= Yii::$app->user->identity->username; ?></strong>
       

         

        

    </div>

    <div class="center-titulos">

    Impreso por el sistema SAE, ACEP SISTEMAS 2022, todos los derechos reservados

    </div>



    <hr>



    <div class="center-titulos">

        <span> <strong>GRACIAS POR SU COMPRA</strong></span><br>

        <span> GUAYAQUIL / ECUADOR</span><br>

        <span> ORIGINAL - ADQUIRIENTE</strong></span>

 

    </div>



    <div class="left-titulos">

   <br><br><br><br><br><br><br><br><br><br><br><br>  <br> <br> <br>  <br>  <br>  <br>       &nbsp;<br>    &nbsp;<br>    &nbsp;<br>       &nbsp;<br>       &nbsp;<br>       &nbsp;

    </div>
    <hr>




</body>

<style>

body

    {

        font-family: Arial, sans-serif;

        font-size : 9px;

        line-height:15px;

    }

.center-titulos{

    padding:2px;

    padding-top:10px;

    text-align:center;

}



.left-titulos{

    padding:2px;

    text-align:left;

}





</style>