<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use backend\models\Productos;
use backend\models\Subproducto;
use backend\models\Menuprincipal;

AppAsset::register($this);
 
//$productos= Productos::find()->where(['isDeleted' => '0',"estado"=>"ACTIVO"])->orderBy(["orden" => SORT_ASC])->limit(6)->all();
//$menuprincipal= Menuprincipal::find()->where(['estado' => 'ACTIVO'])->orderBy(["orden" => SORT_ASC])->limit(7)->all();

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<link href="<?= URL::base() ?>/css/print.min.css" rel="stylesheet">
<?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<?= $content ?>
<?php //$this->endBody() ?>
<?php $this->endPage() ?>