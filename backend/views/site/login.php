<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('/frontend/web/images/loginnewsae.png');background-size: contain;background-repeat-x: no-repeat;"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bienvenido</h1>
                  </div>
                  <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                  <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                  <?= $form->field($model, 'password')->passwordInput() ?>

                  <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    
                  <div class="form-group">
                    <?= Html::submitButton('Iniciar sesión', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>
                </div>
                   <!--  <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>
                    <?php ActiveForm::end(); ?>
                  <hr> -->
                  <div style="color:#999;margin:1em 0; text-align:center; ">
                    Recuperar contraseña <?= Html::a('aquí', ['site/request-password-reset']) ?>.
                </div>
                <div style="color:#999;margin:1em 0; display:none;">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>
                  <!-- <div class="text-center">
                    <a class="small" href="register.html">Crear Cuenta</a>
                  </div> -->

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  
 