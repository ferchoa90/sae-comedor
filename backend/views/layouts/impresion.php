<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use backend\models\Menuprincipal;
AppAsset::register($this);
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