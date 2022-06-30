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

        <img style="width:100px;    vertical-align: middle;" src="<?= URL::base()?>/images/logo_bagsacorp.png" />   

    </div>

    <div class="center-titulos">

        <span> <strong><?php echo 'BAGSACORP'; ?></strong></span>

        <br>DURÁN - Brizas de Santay, Mz. F, solar 117-118 Durán-Ecuador?>

        <br><strong>RUC: </strong>0992638273001 

    </div>

    <div class="left-titulos">

        <br><strong>COMPROBANTE ELECTRÓNICO:  </strong>001 - 001 - <?= str_pad($factura->nfactura, 3, '0', STR_PAD_LEFT); ?>

        <br><strong>Fecha:  </strong><?=date('d', strtotime(str_replace('-', '/', $factura->fechacreacion)));   ?> Septiembre del 2021

        <br><strong>Cliente:  </strong><?=$factura->cliente->nombres.' '.$factura->cliente->apellidos ?>

        <br><strong>Ruc / Ci:  </strong><?=$factura->cliente->cedula ?>  

    </div>

    <hr>

     <div class="left-titulos">

     <table class="table table-hover">

        <thead>

            <tr>

            <th scope="col">Cantidad</th>

            <th scope="col">Producto</th>

            <th scope="col"></th>

            <th scope="col">V. Unitario</th>

            <th scope="col">V. Total</th>

            </tr>

        </thead>

        <tbody id="contenidoCompra">

            <?php foreach ($factura->facturadetalles as $key => $value) { ?>

                <tr style="    text-align: center;" >

                    <td><?=$value->cantidad?></td>

                    <td><?=$value->narticulo.' - '.$value->tarticulo ?></td>

                    <td><img style="width: 15px;" src="/images/articulos/<?=$value->imagen?>"></td>

                    <td><?=$value->valoru?></td><td id="preciot-1"><?=$value->valort?></td>

                </tr>

            <?php } ?>

            <tr style="    text-align: center;" >

                    <td> </td>

                    <td> </td>

                    <td> </td>

                    <th scope="col">Total</th>

                    <th scope=" "><?=$factura->total?></th>

                </tr>

        </tbody>

    </table>

    <!-- <table class="table table-hover">

        <thead>

            <tr>

            <th scope="col"style="    width: 208px;"> </th>

            <th scope="col">Subtotal</th>

            <th scope=" "><?//=$factura->subtotal?></th>

            </tr>

        </thead>

    </table>   -->

    <!-- <table class="table table-hover">

        <thead>

            <tr>

            <th scope="col"style="    width: 203px;"> </th>

            <th scope="col">Iva (12%)</th>

            <th scope=" "><?//=$factura->iva?></th>

            </tr>

        </thead>

    </table>   -->

    </div>

    <hr>

    <div class="left-titulos">

        <br><strong>Pago:  </strong>Efectivo

        <br>Documento sin valor tributario.

        <br>Horario de Atención:  </strong>Lunes a Sábado de 12:00 a 15:00

        <br><strong>Cajero:  <?= Yii::$app->user->identity->username; ?></strong>

        <br><strong>Caja:  </strong>Caja Principal



    </div>

    <div class="center-titulos">

    Impreso por el sistema SAE, ACEP SISTEMAS 2020, todos los derechos reservados

    </div>

    <hr>

    <div class="center-titulos">

        <span> <strong>GRACIAS POR SU COMPRA, QUE TENGA BUEN PROVECHO</strong></span><br>

        <span> GUAYAQUIL / ECUADOR</span><br>

        <span> ORIGINAL - ADQUIRIENTE</strong></span>

    </div>

    <div class="left-titulos">

       &nbsp;

    </div>

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