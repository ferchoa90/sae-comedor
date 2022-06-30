<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Registro';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="section-registro">
  <div class="row">
    <div class="container col-md-6  justify-content-center " style="padding: 0px; margin: 0px;">
      <img src="<?= URL::base() ?>/images/registro.jpg" />
    </div>
    <div class="row container col-md-6  justify-content-center ">
      <div class="row text-center justify-content-center container col-md-12" >
        
        
        <div class="row justify-content-center col-md-12">
          <div class=" text-left registro-content  align-self-center d-flex col-md-12 ">
              <h1 class="title-section"><?= Html::encode($this->title) ?></h1>
              <br><p>Por favor, llene los datos para su registro:</p>
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'nombres')->textInput() ?>

                    <?= $form->field($model, 'apellidos')->textInput() ?>

                    <?= $form->field($model, 'cedula')->textInput() ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>



                    <div class="form-group">
                        <?= Html::submitButton('Registrarse', ['class' => 'btn  btn-monatelier btn-orange', 'name' => 'signup-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
          </div>
      </div>
    </div>
    
  </div>
</section>
