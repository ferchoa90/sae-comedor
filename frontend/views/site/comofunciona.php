<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = '¿Cómo funciona?';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<section class="section-registro">
  <div class="row">
    
    
    <div class="container col-md-6  justify-content-center " style="padding: 0px; margin: 0px;">
      <img src="<?= URL::base() ?>/images/comofunciona.jpg" />
    </div>
    <div class="row container col-md-6  justify-content-center ">
      <div class="row text-center justify-content-center container col-md-12" >
        
        
        <div class="row justify-content-center col-md-12">
          <div class=" text-left registro-content  align-self-center d-flex col-md-12  ">
          <h1 class="title-section"><?= Html::encode($this->title) ?></h1>
          <ul class=" " style="font-family:'Montserrat-Light'; line-height: 30px;">
                <dd>Cada día pintamos un cuadro.</dd>
                <dd>Tu obra estará terminada en 2 horas de mucha diversión.</dd>
                <dd>No necesitas tener experiencia previa, nuestro instructor te guiará paso a paso.</dd>
                <dd>Mira nuestro calendario de obras y elige el día que quieras venir.</dd>
                <dd>
                    Haz una reserva a través de estos links:
                    <div class="btn-group btn-xs">
                        <a href="javascript:void(0)" onclick="window.open('https://api.whatsapp.com/send?phone=+593996437788&amp;text=Hola, deseo más información')" class="btn btn-success btn-xs">
                            <i class="icon fa fa-whatsapp"></i>
                        </a>
                        <a href="javascript:void(0)" style="color: #343a40" onclick="window.open('mailto:monatelierquito@gmail.com')" class="btn btn-default btn-xs">
                            <i class="icon fa fa-envelope-o"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="window.open('tel:+593996437788')" class="btn btn-secondary btn-xs">
                            <i class="icon fa fa-phone"></i>
                        </a>
                    </div>
                    o comunicándote al 099 6 437 788.
                    <p>
             Costo por persona: $35. Incluye todos los materiales y una copa de vino.
             <br>
             PAQUETES
<br>
             VIP. Para dos personas. Incluye todos los materiales, una botella de vino, una tabla vip de tapas y jamones para dos personas, enmarcación para los cuadros. Costo por pareja $150,00. 
<br>
            PREMIUM. Para dos personas. Incluye todos los materiales, dos copas de vino cada uno y una tabla standar de tapas y jamones para dos personas. Costo por pareja $90,00.
<br>

            ACEPTAMOS TODAS LAS TARJETAS DE CRÉDITO   

        </p>
                </dd>
            </ul>


            </div>
        </div>
      </div>
    </div>
  </div>
</section>
 