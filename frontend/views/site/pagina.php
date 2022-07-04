<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use backend\models\Paginas;
 

//News::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_DESC])->limit(100)->all();
$this->title = $model->titulo.' | Cooperativa de la Policía Nacional';
?>
<section class="container-fluid">
  <div class="row content-slider">
  <?php if ($model->imagen){ ?>
        <picture>
          <source media="(max-width: 780px)" srcset="<?= URL::base() ?>/images/<?= $model->imagenresponsive ?>">
          <img src="<?= URL::base() ?>/images/<?= $model->imagen ?>" alt="">
        </picture>
      
      <div class="info-slider">
        <span>Ahorros</span>
        <h1><?= $model->tituloslider ?></h1>
        <p><?= $model->textoslider ?></p>
        <?php if ($model->botontexto){ ?>
           <button class="btn btn-green" ><a target="_blank" href="<?= $model->linkboton ?>"><?= $model->botontexto ?></a></button> 
        <?php } ?>
      </div>
      <?php } ?>
  </div>
  <div class="row content-breadcumbs">
      <a href="#">Inicio</a><a href="#">Productos</a><a href="#">Ahorros </a><span><?= $model->titulo ?></span>
    </div>
  </section>

  <!-- INFORMACION INTERNAS -->
  <section class="container">
    <?= $model->contenido ?>
  </section>
 