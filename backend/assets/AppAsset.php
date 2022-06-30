<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css',
        'js/plugins/sweetalert/sweetalert.css',
        'js/plugins/datatables/dataTables.bootstrap.css',
        'js/plugins/datatables/buttons/buttons.dataTables.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/app.min.js',
        'js/plugins/slimScroll/jquery.slimscroll.min.js',
        'js/plugins/sweetalert/sweetalert.min.js',
        'js/plugins/bootstrap-notify/bootstrap-notify.min.js',
        'js/plugins/datatables/jquery.dataTables.min.js',
        'js/plugins/datatables/dataTables.bootstrap.min.js',
        'js/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js',
        'js/plugins/datatables/buttons/dataTables.buttons.min.js',
        'js/plugins/datatables/buttons/buttons.flash.min.js',
        'js/plugins/datatables/buttons/buttons.html5.min.js',
        'js/scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
