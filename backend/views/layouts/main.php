<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
//\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
//\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="<?= URL::base() ?>/js/alertify.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?= URL::base() ?>/css/alertify.rtl.css">
    <?php $this->head() ?>
    
</head>
<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <!-- Navbar -->
    <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->render('footer') ?>
</div>

<div id="loading" class="container h-100 col-12 text-center">
    <div class="row align-items-center h-100">
        <div class="col-12 mx-auto">
            <div class="spinner-border text-success" role="status">
                <span class="sr-only">Loading...</span>

            </div>
        </div>
    </div>
</div>





<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

<style>

#loading {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  text-align: center;
  opacity: 0.7;
  background-color: #000;
  z-index: 99;
}

#loading-image {
  position: absolute;
  top: 100px;
  left: 240px;
  z-index: 100;
}
    body{
        font-size: 0.9rem;

    }
.menu-is-opening .nav-treeview .nav-item .nav-link {
    border-bottom: 1px solid rgba(41,174,205,.3);
    background: rgba(41,174,205,.3);
}

.sidebar-menu a{
    
    background: rgba(41,174,205,.3);
}

.main-sidebar .sidebar {
    background-color: #222d32;
}

.user-panel>.image>img {
    width: 100%;
    max-width: 45px;
    height: auto;
}
.user-panel>.info>p {
    font-weight: 600;
    margin-bottom: 9px;
    margin: 0 0 10px;
}
.user-panel>.info>a {
    text-decoration: none;
    padding-right: 5px;
    margin-top: 3px;
    font-size: 11px;
}
.user-panel>.info>a
{
    color:white;
}

.user-panel>.info>p
{
    color:white;
}
.user-panel>.info>a>.fa, .user-panel>.info>a>.ion, .user-panel>.info>a>.glyphicon {
    margin-right: 3px;
}
.main-sidebar .sidebar-menu .nav-item a{
    padding: 8px 5px 8px 10px;
    display: block;
    border-left: 3px solid transparent;
}
.main-sidebar .sidebar-menu .nav-item a:hover{
    border-left-color: #007bff;
}
.main-sidebar .sidebar-menu
    {
        padding-left : 0px;
    }
    .nav-sidebar > li > a
    {
        padding: 8px 5px 8px 10px;
        display: block;
        border-left: 3px solid transparent;
    }
    .nav-sidebar > li > a:hover
    {
        border-left-color: #007bff;
    }
    .content-header h1 {
        font-size: 1.1rem !important;
        margin: 0;
    }
    .content-header {
        padding: 10px .5rem;
        padding-bottom: 0px;
    }
        </style>

<script src="<?= URL::base() ?>/js/plugins/bootstrap3-typeahead.min.js"></script>

