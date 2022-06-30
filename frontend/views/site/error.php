<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
$name="ERROR";
$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger text-center">
        <?php if (nl2br(Html::encode($message))=="Page not found."){
            echo "Página no encontrada.";
        }else{
            echo nl2br(Html::encode($message));
        }
        
        ?>
    </div>

</div>
