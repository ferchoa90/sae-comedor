<?php

use yii\helpers\Html;
use backend\components\Mensajes_usuario;
use backend\components\Notificaciones_usuario;

$nmensajes=New Mensajes_usuario;
$cmensajes=$nmensajes->getNmensajes();
$mensajes=$nmensajes->getMensajes();

if ($cmensajes==0){ $cmensajes=""; }

$nnotificaciones=New Notificaciones_usuario;
$cnotificaciones=$nnotificaciones->getNnotificaciones();
$notificaciones=$nnotificaciones->getNotificaciones();
//var_dump($mensajes);

if ($cnotificaciones==0){ $cnotificaciones=""; }
?>

 <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
       <!--  <li class="nav-item d-none d-sm-inline-block">
            <a href="<?//=\yii\helpers\Url::home()?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> -->
       <!--  <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="#" class="dropdown-item">Some action </a></li>
                <li><a href="#" class="dropdown-item">Some other action</a></li>
                <li><?//= Html::a('Sign out', ['site/logout'], ['data-method' => 'post', 'class' => 'dropdown-item']) ?></li>

                <li class="dropdown-divider"></li>


                <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                        <li>
                            <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                        </li>

                        <li class="dropdown-submenu">
                            <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                            <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item">3rd level</a></li>
                                <li><a href="#" class="dropdown-item">3rd level</a></li>
                            </ul>
                        </li>


                        <li><a href="#" class="dropdown-item">level 2</a></li>
                        <li><a href="#" class="dropdown-item">level 2</a></li>
                    </ul>
                </li>

            </ul>
        </li>-->
    </ul>

    <!-- SEARCH FORM -->
   <!--  <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
 -->
    <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
   <!--
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
 -->
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge"><?= $cmensajes ?></span>
            </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <?php foreach ($mensajes as $key => $value) {  ?>
                <a href="#" class="dropdown-item">

                    <div class="media">
                        <img src="/backend/web/images/user2-160x160.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                <?= $value->usuariocreacion0->nombres.' '.$value->usuariocreacion0->apellidos ?>
                                <!--<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>-->
                            </h3>
                            <p class="text-sm"><?= substr($value->mensaje,0,40).'...' ?></p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>Hace un momento</p>
                        </div>
                    </div>

                </a>
                <div class="dropdown-divider"></div>
                <?php } ?>

                 
                <div class="dropdown-divider"></div>
                <a href="/perfil/buzonmensajes" class="dropdown-item dropdown-footer">Buzón de mensajes</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"><?= $cnotificaciones ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!--<span class="dropdown-header"><?//= $cnotificaciones ?> Notificaciones</span>
                <div class="dropdown-divider"></div>-->
                <?php foreach ($notificaciones as $key => $value) {  ?>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?= $value->mensaje ?>
                    
                    <span class="float-right text-muted text-sm">Hace poco</span>
                </a>
                <!--<div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>-->
                <div class="dropdown-divider"></div>
                <?php } ?>
                <a href="#" class="dropdown-item dropdown-footer">Buzón de notificaciones</a>
            </div>
        </li>
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
       <!--  <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> -->
    </ul>
</nav>
<!-- /.navbar -->