<?php
use yii\helpers\Url;
use backend\components\Menu_admin;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<a class="logo p-2" href="/backend/web/" style="background-color: transparent !important; border-bottom: 1px solid #4DA88A">
    <!--<span class="logo-lg">GLOBAL MED</span>-->
    <img src="/backend/web/images/logo_small.jpg" style="width:50%;" class="" alt=""/>
</a>
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="d-flex user-panel justify-content-center">
            <div class=" user-panel mt-2 mb-2  d-flex" style="border-bottom: none;">
                <div class="text-center image">
                    <img src="/backend/web/images/user2-160x160.png" class="img-circle" alt="User Image"/>
                </div>
                <div class="text-center info">
                    <p class="p-0"><?= Yii::$app->user->identity->nombres.' '.Yii::$app->user->identity->apellidos ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

                </div>
            </div>
        </div>

        <?php
          $menuadmin= New Menu_admin;
          $menuadmin= $menuadmin->getMenuadmin(0,$this->context->route);
        ?>
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="padding-left:0px;">
        <?= \hail812\adminlte\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $menuadmin,
                //'activateParents'=>true,
                /*'items' => [
                    ['label' => '', 'options' => ['class' => 'header']],
                    //['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    //['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    $menu,
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],*/
            ]
        ) ?>
        </ul>
</nav>
        <!-- /.sidebar-menu -->
    </section>

</aside>
<style>
 .logo {
    background-color: #007bff;
    color: #fff;
    border-bottom: 0 solid transparent;
    -webkit-transition: width .3s ease-in-out;
    -o-transition: width .3s ease-in-out;
    transition: width .3s ease-in-out;
    display: block;
    height: 100%;
    font-size: 13px;
    line-height: 50px;
    text-align: center;
    width: 100%;
    font-weight: 500;
    overflow: hidden;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";


}
    </style>
