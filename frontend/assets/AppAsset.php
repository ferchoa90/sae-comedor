<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      //  'css/bootstrap.min.css',
      //  'css/slick.css',
      //  'css/slick-theme.css',
      //  'css/nouislider.min.css',
      //  'css/font-awesome.min.css',
     //   'css/style.css',
     '/backend/web/css/skins/_all-skins.min.css',
     '/backend/web/js/plugins/sweetalert/sweetalert.css',
     '/backend/web/js/plugins/datatables/dataTables.bootstrap.css',
     '/backend/web/js/plugins/datatables/buttons/buttons.dataTables.min.css',
     '//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css',
     '//cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css',
     '//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css',
     '//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css',
     '//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css',
     '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
     '/frontend/web/css/site.css',
     '/web/css/sb-admin-2.min.css',

      //'/backend/web/css/AdminLTE.min.css',
    ];
    public $js = [
      '/backend/web/js/app.min.js',
      '/backend/web/js/plugins/slimScroll/jquery.slimscroll.min.js',
      '/backend/web/js/plugins/sweetalert/sweetalert.min.js',
      '/backend/web/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
      '/backend/web/js/plugins/datatables/jquery.dataTables.min.js',
      '/backend/web/js/plugins/datatables/dataTables.bootstrap.min.js',
      '/backend/web/js/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js',
      '/backend/web/js/plugins/datatables/buttons/dataTables.buttons.min.js',
      '/backend/web/js/plugins/datatables/buttons/buttons.flash.min.js',
      '/backend/web/js/plugins/datatables/buttons/buttons.html5.min.js',
      '//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js',
      '/backend/web/js/scripts.js',
  
  
     /*    'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/slick.min.js',
        'js/nouislider.min.js',
        'js/jquery.zoom.min.js',
        'js/main.js', */
        
    ];
    public $depends = [
      /*   'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset', */
        
    ];
} 
