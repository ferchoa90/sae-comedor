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
use common\models\MenuFront;
use backend\components\Menu_admin;

//use backend\models\Menuadmin;

AppAsset::register($this);

//$productos= Productos::find()->where(['isDeleted' => '0',"estado"=>"ACTIVO"])->orderBy(["orden" => SORT_ASC])->limit(6)->all();
//$menuprincipal= Menuprincipal::find()->where(['estado' => 'ACTIVO'])->orderBy(["orden" => SORT_ASC])->limit(7)->all();

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

    <title>SAE - Sistema Empresarial</title>

    <!-- Bootstrap core CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,800" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!--<link href="<?= URL::base() ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    
     
    

    <script src="<?= URL::base() ?>/js/jquery-1.12.4.min.js"></script>
    <script src="<?= URL::base() ?>/js/jquery.mask.min.js"></script>
    <script src="<?= URL::base() ?>/js/jquery-ui.js"></script>



    <!-- include alertify script -->
    <script src="<?= URL::base() ?>/js/alertify.js"></script>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Custom fonts for this template-->
  <link href="<?= URL::base() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= URL::base() ?>/css/sb-admin-2.min.css" rel="stylesheet">

  <link href="<?= URL::base() ?>/css/styles.css" rel="stylesheet">
  <link href="<?= URL::base() ?>/css/queriesnew2.css" rel="stylesheet">

  <link rel="stylesheet" href="<?= URL::base() ?>/css/alertify.rtl.css">
    <link rel="stylesheet" href="<?= URL::base() ?>/css/themes/default.rtl.css">


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
<!--
<div class="wrap">


    <div class="container">-->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        
 <body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
<?php
          $menu= New Menu_admin;
          $menu= $menu->getMenufront(0,$this->context->route);
          //var_dump($menuadmin);
        ?>
        


  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SAE <sup>2020</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <li class="nav-item active">
        <a class="nav-link" href="/frontend/web">
          <i class="fas fa-fw fa-desktop"></i>
          <span>Escritorio</span></a>
      </li>
   
    <?php foreach ($menu as $key => $value) { ?>
      <hr class="sidebar-divider my-0">
      <?php if (!$value["parent"]==0) { ?>
      <li class="nav-item active">
        <a class="nav-link" href="<?= URL::base() ?><?= $value["link"] ?>">
          <i class=" <?= $value["icon"] ?>"></i>
          <span><?= $value["label"] ?></span></a>
      </li>
      <?php }else{ ?>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="sidebar-heading">
          <?= $value["label"] ?>
        </div>
        
      <?php }  ?>
      <?php if (@$value["items"]){ foreach ($value["items"] as $keyS => $valueS) { ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL::base() ?><?= $valueS["url"] ?>">
            <i class=" <?= $valueS["icon"] ?>"></i>
            <span><?= $valueS["label"] ?></span></a>
            
        </li>
      <?php } ?>
    <?php }  ?>
    <?php }  ?>
 
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
       <!--  <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
          <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form> -->
               <!-- Topbar Navbar -->
               <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter">0</span>
          </a>
          <!-- Dropdown - Alerts -->
          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
              Alertas
            </h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="mr-3">
                <div class="icon-circle bg-primary">
                  <i class="fas fa-file-alt text-white"></i>
                </div>
              </div>
              <div>
                <div class="small text-gray-500">Diciembre 12, 2019</div>
                <span class="font-weight-bold">A new monthly report is ready to download!</span>
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="mr-3">
                <div class="icon-circle bg-success">
                  <i class="fas fa-donate text-white"></i>
                </div>
              </div>
              <div>
                <div class="small text-gray-500">Diciembre 7, 2019</div>
                $290.29 has been deposited into your account!
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="mr-3">
                <div class="icon-circle bg-warning">
                  <i class="fas fa-exclamation-triangle text-white"></i>
                </div>
              </div>
              <div>
                <div class="small text-gray-500">Diciembre 2, 2019</div>
                Spending Alert: We've noticed unusually high spending for your account.
              </div>
            </a>
            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
          </div>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <!-- Counter - Messages -->
            <span class="badge badge-danger badge-counter">0</span>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">
              Bandeja de Entrada
            </h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                <div class="status-indicator bg-success"></div>
              </div>
              <div class="font-weight-bold">
                <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                <div class="small text-gray-500">Emily Fowler · 58m</div>
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                <div class="status-indicator"></div>
              </div>
              <div>
                <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                <div class="small text-gray-500">Jae Chun · 1d</div>
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                <div class="status-indicator bg-warning"></div>
              </div>
              <div>
                <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
              </div>
            </a>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                <div class="status-indicator bg-success"></div>
              </div>
              <div>
                <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                <div class="small text-gray-500">Chicken the Dog · 2w</div>
              </div>
            </a>
            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
          </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?= Yii::$app->user->identity->nombres.' '.Yii::$app->user->identity->apellidos ?></span>
            <img class="img-profile rounded-circle" src="<?= URL::base() ?>/images/perfil/<?= Yii::$app->user->identity->fotoperfil ?>">
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Perfil
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Configuración
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
              Log de Actividad
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Cerrar Sesión
            </a>
          </div>
        </li>

        </ul>

        </nav>
        <!-- End of Topbar -->
        <?= $content ?>
<!--    </div>
</div>
 -->
 <script src="/frontend/web/js/sb-admin-2.min.js"></script>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 <script src="<?= URL::base() ?>/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="<?= URL::base() ?>/js/plugins/bootstrap3-typeahead.min.js"></script>
<?php $this->endBody() ?>
<ul class="breadcrumb b-init" style="    margin-bottom: 0px;display:none;"> 
 
</ul>
 <!-- Footer -->
 <footer>
          
    
</footer>
 
</body>
    
     
</html>
<?php $this->endPage() ?>
<script>
if (getCookie('sesion')){
  console.log("Cookie Detectada "+getCookie('sesion'));
}else{
  var d = new Date()
  var cookie= setCookie("sesion",d.getDate()+d.getTime()+'-'+Math.floor(Math.random() * 100000000),"1");
  console.log("Cookie Nueva "+getCookie('sesion'));

}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function agregarItem(idproducto, idclase, idpinturas, tipocompra,cantidad,redirect)
{
  console.log("ID PR: "+idproducto+ " | "+"ID CL: "+idclase+ " | "+"ID PINT: "+idpinturas+ " | "+"TIPO C: "+tipocompra+ " | "+"ID CANT: "+cantidad)
  var datos= {
    idproducto : idproducto,
    idclase : idclase,
    idpinturas : idpinturas,
    tipocompra : tipocompra,
    cantidad : cantidad,
    sesion : getCookie('sesion'),
    '_csrf-frontend' : '<?= Yii::$app->request->getCsrfToken() ?>',
  };
  $.ajax(
    {
        url: "agregaritem",
        type: "POST",
        data: datos,
        success: function (data, textStatus, jqXHR) {
            var data = jQuery.parseJSON(data);
           // loading(0);
            if (data.success) {
                /*loading(1);*/
                //$.notify('Se ha agregado el menú');
                if (data.id)
                {
                    //window.location.href = "view?id=" + data.id;
                }
                if (redirect)
                {
                  window.location.href = "<?= URL::base() ?>/site/tiendavirtual";
                }
            } else {
                /*loading(0);*/
                //$.notify(data.Mensaje);
                console.log("error");
                //swal("Error", "Can't delete customer data, error : " + data.error, "error");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $.notify("Error, no se han podido guardar los datos.");
        }
    });
}
</script>
