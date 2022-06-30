<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

//dmstr\web\AdminLteAsset::register($this);

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

<head>

    <meta charset="<?= Yii::$app->charset ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <?= Html::csrfMetaTags() ?>

    

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="SAE - Sistema Administrativo Contable">

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="icon" href="<?= URL::base() ?>/images/favicon.ico" type="image/x-icon">

    <meta name="author" content="">



    <title>SAE - Sistema Administrativo Contable</title>



    <!-- Bootstrap core CSS -->

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,800" rel="stylesheet">



    <!-- Custom styles for this template -->

    <link href="/frontend/web/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 

    <script src="/frontend/web/js/jquery-1.12.4.min.js"></script>

    <script src="/frontend/web/js/jquery.mask.min.js"></script>

    <script src="/frontend/web/js/jquery-ui.js"></script>



    <script src="/frontend/web/vendor/bootstrap/js/bootstrap.bundle.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



  <!-- Custom fonts for this template-->

  <link href="/frontend/web/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">



  <!-- Custom styles for this template-->

  <link href="/frontend/web/css/sb-admin-2.min.css" rel="stylesheet">



  <link href="/frontend/web/css/styles.css" rel="stylesheet">

  <link href="/frontend/web/css/queriesnew2.css" rel="stylesheet">



    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-92085539-1"></script>

    <script>

      window.dataLayer = window.dataLayer || [];

      function gtag(){dataLayer.push(arguments);}

      gtag('js', new Date());



      gtag('config', 'UA-92085539-1');

    </script>





    <?php $this->head() ?>

</head>



<body>

 



<?php $this->beginBody() ?>



        

 <body id="page-top">

 

        <?= $content ?>





<?php $this->endBody() ?>



 <!-- Footer -->

 <footer>

          

    

</footer>

 

</body>

    

     

</html>

<?php $this->endPage() ?>

<script>

 