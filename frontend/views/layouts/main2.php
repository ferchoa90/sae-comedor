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

$productos= Productos::find()->where(['isDeleted' => '0',"estado"=>"ACTIVO"])->orderBy(["orden" => SORT_ASC])->limit(6)->all();
$menuprincipal= Menuprincipal::find()->where(['estado' => 'ACTIVO'])->orderBy(["orden" => SORT_ASC])->limit(6)->all();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <?= Html::csrfMetaTags() ?>
    <!-- <title><?//= Html::encode($this->title) ?></title> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CPN">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= URL::base() ?>/images/favicon.ico" type="image/x-icon">
    <meta name="author" content="">

    <title>Cooperativa Policia Nacional</title>

    <!-- Bootstrap core CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,800" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
    
  <link href="<?= URL::base() ?>/css/styles.css" rel="stylesheet">
  <link href="<?= URL::base() ?>/css/queriesnew2.css" rel="stylesheet">
    <script src="<?= URL::base() ?>/js/jquery-1.12.4.min.js"></script>
    <script src="<?= URL::base() ?>/js/jquery.mask.min.js"></script>
    <script src="<?= URL::base() ?>/js/jquery-ui.js"></script>

    <script src="/vendor/bootstrap/js/bootstrap.bundle.js"></script>

    <?php $this->head() ?>
</head>

<body>
<!-- HEADER -->
<header class="container-fluid">
    <div class="row back-green header-green">
      <!-- <div class="btn-language"><a href="#">eng</a><a href="#" class="active">esp</a></div> -->
      <!--<div class="call-center">
        <span>call center</span><br/>1800 222 765
      </div>-->
      <div class="header-left">
        <div class="social-header">
          <a target="_blank" href="https://www.facebook.com/CoopPoliciaNacional/"><img src="<?= URL::base() ?>/images/ico_facebook_white.svg" alt=""></a>
          <!--<a target="_blank"  href="https://twitter.com/CPNECUADOR"><img src="<?= URL::base() ?>/images/ico_twitter_white.svg" alt=""></a>-->
          <a target="_blank"  href="https://www.instagram.com/cooppolicianacional/?hl=es-la"><img src="<?= URL::base() ?>/images/instagram_up.png" alt=""></a>

        </div>
        <div class="map-locator">
          <select id="ciudadSelect">
            <option value="AMBATO">AMBATO</option>
            <option value="AZOGUES">AZOGUES</option>
            <option value="BABAHOYO">BABAHOYO</option>
            <option value="COCA">COCA</option>
            <option value="CUENCA">CUENCA</option>
            <option value="ESMERALDAS">ESMERALDAS</option>
            <option value="GUARANDA">GUARANDA</option>
            <option value="GUAYAQUIL">GUAYAQUIL</option>
            <option value="IBARRA">IBARRA</option>
            <option value="LAGO">LAGO AGRIO</option>
            <option value="LATACUNGA">LATACUNGA</option>
            <option value="LOJA">LOJA</option>
            <option value="MACAS">MACAS</option>
            <option value="MACHALA">MACHALA</option>
            <option value="MANTA">MANTA</option>
            <option value="PORTOVIEJO">PORTOVIEJO</option>
            <option value="PUYO">PUYO</option>
            <option value="QUEVEDO">QUEVEDO</option>
            <option value="QUITO" selected="selected">QUITO</option>
            <option value="RIOBAMBA">RIOBAMBA</option>
            <option value="STA. ELENA">STA. ELENA</option>
            <option value="STO. DOMINGO">STO. DOMINGO</option>
            <option value="TENA">TENA</option>
            <option value="TULCAN">TULCAN</option>
            <option value="ZAMORA">ZAMORA</option>
          </select>
          <button class="btn"><a href="javascript:oficina();"><img src="<?= URL::base() ?>/images/ico_map.svg" alt="">Encuentra tu agencia</a></button>
        </div>
      </div>
      <div>
        <button class="btn btn-orange btn-direct"><a target="_blank" href="https://cooperativavirtual.cpn.fin.ec/">Cooperativa Virtual</a></button>
      </div>
    </div>
    <div class="row header-white justify-content-between">
      <div class="menu-header d-flex justify-content-start align-items-end">
        <div class="logo-cpn"><a href="/"><img src="<?= URL::base() ?>/images/logo_sae.png" alt=""></a></div>
        <div class="content-menu">
          <ul>
            <?php foreach ($menuprincipal as $menup) { ?>
                <li><a href="<?=$menup->link ?>" id="btn-products-<?=$menup->id ?>"><?=$menup->nombre ?></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <div class="content-buttons align-self-end">
        <!-- <button class="btn btn-green btn-direct">Abre tu cuenta</button> -->
        <button class="btn btn-green" id="btn-menu-mobile"><span></span></button>
      </div>
    </div>
    <nav id="submenu">
        <div class="row">
            <?php $cont=0;?>
            <?php foreach ($productos as $producto) { ?>
                <div>
                    <h3><?=$producto->nombre ?></h3>
                    <?php ?>

                    <?php $subproductos = $producto->subproductos;?>
                    <?php foreach($subproductos as $subProducto) { ?>
                    <ul>
                        <li><a href="<?= URL::base() ?>/site/<?=$subProducto->link ?>"><?=$subProducto->nombre ?></a></li>
                    </ul>
                    <?php } ?>
                    <?php if ($cont==2){ ?>
                       </div>
                       <div>
                           <h3>CAMPA&Ntilde;A </h3>
                           <ul><li><a href="/frontend/web/site/premiamos">Premiamos tu fidelidad</li></ul>
                       
                    <?php } ?>
                </div>
                <?php $cont++;?>
            <?php } ?>

        </div>
    </nav>
    <nav id="submenu2">

        <div class="row">
        <div>
        <h3>SERVICIOS</h3>
            <ul>
              <li><a href="/frontend/web/site/cpnsalud">CPNSalud</a></li>
              <li><a href="/frontend/web/site/chatbot">ChatBOT</a></li>
                            
<!-- <li><a href="http://www.bibliotecavirtual.cpn.fin.ec/">Biblioteca Virtual</a></li> -->
               <li><a href="/frontend/web/site/cpnmovil">CPN M&oacute;vil</a></li>

            </ul>
        </div>
        <div>
        <h3>PAGO DE SERVICIOS</h3>
            <ul>
              <li><a href="/frontend/web/site/puntomatico">Puntomático</a></li>
              <!-- <li><a href="/frontend/web/site/cooperativavirtual">Cooperativa Virtual</a></li> -->
            </ul>
        </div>
        <div>
        <!-- <h3>OTROS SERVICIOS</h3>
            <ul>
              <li><a href="/frontend/web/site/redcajeros">Red de Cajeros Automáticos</a></li>
              <li><a href="/frontend/web/site/transferenciasefectivo">Transferencias en efectivo</a></li>
              <li><a href="/frontend/web/site/redpagos">Red de Pagos CPN</a></li>
            </ul> -->
        </div>
      <!--   <div>
        <h3>AYUDA MUTUA</h3>
            <ul>
              <li><a href="/frontend/web/site/plandental">ayudapornacimiento</a></li>
              <li><a href="/frontend/web/site/ayudamutua">ayudapormortuoria</a></li>
            </ul>
        </div> -->
        </div>
    </nav>
   <!--  <nav id="submenu">
        <div class="row">
            <div>
        <h3>CAMPAÑAS</h3>
            <ul>
              <li><a href="/frontend/web/site/chiquiahorro">Campaña Chiqui Like</a></li>
              <li><a href="#">Crédito Consumo Plus</a></li>
            </ul>
            </div>
        </div>
    </nav> -->
    <nav id="submenu3">
    <div class="row">
            <div>
        <h3>CONTACTO</h3>
            <ul>
              <li><a href="/frontend/web/site/redoficinas">Red de Oficinas</a></li>
              <li><a href="/frontend/web/site/reddecajeros">Red de Cajeros</a></li>
              <li><a href="tel:1800222765">Contact Center (1800 - 222 765)</a></li>
            </ul>
            </div>
        </div>
    </nav>

  </header>
    <!-- /HEADER -->
<?php $this->beginBody() ?>
<!--
<div class="wrap">


    <div class="container">-->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
<!--    </div>
</div>
 -->

<?php $this->endBody() ?>

 <!-- Footer -->
 <footer>
 <section class="container-fluid info-bar back-green" id="asegura-seccion">
    <div class="row justify-content-center">
      <div id="mensaje1" class="content-tittle mensaje1">
       <!--  <h1>¡Asegura tu Futuro!</h1> -->
       <h1>¿Tienes Dudas?</h1>
      </div>
      <div id="mensaje2" class="content-tittle mensaje2">
        <!-- <span>¿Tienes</span>
        <h2>Dudas?</h2> -->
        <span>Llámanos</span>
        <h1><a href="tel:1800222765">1800 222 765</a></h1>
      </div>
      <div class="d-flex content-callcenter-bar">
        <!-- <span>Llámanos</span>
        <h1>1800 222 765</h1> -->
      </div>
    </div>
  </section>
    <!-- <div class="container-fluid back-green">
      <div class="row direct-links-footer"> -->
      <!--   <div><a href="#"><img src="<?= URL::base() ?>/images/ico_facturacion.svg" alt=""> Facturación Electrónica</a></div> -->
      <!--   <div><a href="<?= URL::base() ?>/site/contactenos"><img src="<?= URL::base() ?>/images/ico_reclamos.svg" alt=""> Reclamos y Sugerencias</a></div> -->
  <!--       <div><a href="http://www.bibliotecavirtual.cpn.fin.ec/"><img src="<?= URL::base() ?>/images/ico_biblioteca.svg" alt=""> Biblioteca Virtual</a></div> -->
        <!-- <div><a href="#"><img src="<?= URL::base() ?>/images/ico_trabaja.svg" alt=""> Trabaje con Nosotros</a></div> -->
      <!-- </div>
    </div> -->
    <div class="container-fluid back-gray-footer">
      <div class="container">
        <h3>Deberías conocer</h3>
        <p>La Cooperativa de Ahorro y Crédito Policía Nacional, conjuntamente con su equipo de trabajo, camina día a día a la excelencia para alcanzar los objetivos planteados, generando e innovando productos, servicios y beneficios para sus socios y clientes, satisfaciendo las necesidades financieras, mejorando su calidad de vida y crecimiento económico.</p>
      </div>
    </div>
    <div class="container-fluid back-black">
        <div class="row justify-content-center flex-wrap content-footer-row">
          <div class="logo-footer">
            <img src="<?= URL::base() ?>/images/logo_cpn_white.svg" alt="">
            <p>
              Matriz Quito,<br/>
              Voz Andes 309 y Av. América<br/>
              1800 222 765<br/>
              02 3 984 999
            </p>
          </div>
          <div class="links-nosotros align-self-center">
            <h4>Nosotros</h4>
            <div class="row">
              <div>
                <a href="<?= URL::base() ?>/site/estructuraorganizacional">Estructura Organizacional</a>
                <a href="<?= URL::base() ?>/site/gobiernocooperativo">Gobierno Cooperativo</a>
                <a href="<?= URL::base() ?>/site/quienessomos">Quienes Somos</a>
   		<a href="http://facturas.asistecooper.com.ec:75/public/index.php?numcopp=Ng==#">Facturaci&oacute;n Electr&oacute;nica</a>
              </div>
              <div>
                <a href="<?= URL::base() ?>/site/responsabilidadsocial" target="_blank">Responsabilidad Social</a>
                <a href="<?= URL::base() ?>/site/seguridad">Seguridad</a>
                <a href="<?= URL::base() ?>/site/transparencia">Transparencia</a>
              </div>
              <div>
                <a href="<?= URL::base() ?>/site/principios">Principios</a>
                <a href="<?= URL::base() ?>/site/informacionlegal">Información Legal</a>
                <a href="https://cpn.hiringroom.com/jobs" target="_blank">Trabaja con nosotros</a>
              </div>
            </div>
          </div>
          <!--<div class="links-social align-self-end">
          AIzaSyCMNyGwfCKdaeTzi5rZeHcvTM488UlxeJQ
            <a target="_blank" href="https://www.facebook.com/CoopPoliciaNacional/"><img src="<?= URL::base() ?>/images/ico_facebook.svg" alt=""></a>
            <a target="_blank"  href="https://twitter.com/CPNECUADOR"><img src="<?= URL::base() ?>/images/ico_twitter.svg" alt=""></a>
            <a target="_blank"  href="https://www.instagram.com/cooppolicianacional/?hl=es-la"><img src="<?= URL::base() ?>/images/instagram.png" alt=""></a>
          </div>-->
        </div>
    </div>
  </footer>
  <img src="<?= URL::base() ?>/images/chat_bot2019.png" id="button_chat" onclick="javascript:showChatClient();" />
  <div id="cht_cont" style="position:fixed;bottom:0px;z-index:9999;right: 4em;border: 0;display:none;">
    <iframe id="iframechat" sandbox="allow-same-origin allow-scripts allow-popups allow-forms allow-popups-to-escape-sandbox"
    src="https://cariai.com/cVhlaTdqekZaZkkyL1VZTCs5dDdMaFpwOEYxc29nPT0=" frameBorder="0" style="width: 600px !important; height: 600px; !important"></iframe>
  </div>
</body>
  <script>
   var btn_mobile = document.getElementById("btn-menu-mobile"),
      btn_products = document.getElementById('btn-products-1'),
      btn_products2 = document.getElementById('btn-products-2'),
      btn_products3 = document.getElementById('btn-products-6'),
   //   btn_products4 = document.getElementById('btn-products-4'),
      submenu_link = document.getElementById('submenu'),
      submenu_link2 = document.getElementById('submenu2'),
      submenu_link3 = document.getElementById('submenu3'),
     // submenu_link4 = document.getElementById('submenu4'),
      menu_mobile = document.querySelector(".content-menu");
   btn_mobile.addEventListener('click', function(){
     this.classList.toggle('active-mobile');
     menu_mobile.classList.toggle('active-menu-mobile');
     submenu_link.classList.remove('nav-active');
     submenu_link2.classList.remove('nav-active');
     submenu_link2.classList.remove('nav-active');
   });
   btn_products.addEventListener('click', function(){
     submenu_link3.classList.remove('nav-active');
     //submenu_link4.classList.remove('nav-active');

     submenu_link2.classList.remove('nav-active');
     submenu_link.classList.toggle('nav-active');

   });
   btn_products2.addEventListener('click', function(){
     submenu_link.classList.remove('nav-active');
     submenu_link3.classList.remove('nav-active');
     //submenu_link4.classList.remove('nav-active');

     submenu_link2.classList.toggle('nav-active');
   });
   btn_products3.addEventListener('click', function(){
    submenu_link.classList.remove('nav-active');
     submenu_link2.classList.remove('nav-active');
     //submenu_link4.classList.remove('nav-active');
     submenu_link3.classList.toggle('nav-active');
   });
 /*   btn_products4.addEventListener('click', function(){
    submenu_link.classList.remove('nav-active');
     submenu_link2.classList.remove('nav-active');
     submenu_link3.classList.remove('nav-active');
     submenu_link4.classList.toggle('nav-active');
   }); */
  </script>
  <script>
  function activarPestania(id)
  {
     var submenu_link = document.getElementById('requisitos-1'),
      submenu_link2 = document.getElementById('requisitos-2'),
      submenu_link3 = document.getElementById('requisitos-3'),
      submenu_link3 = document.getElementById('requisitos-4')

      var element=document.getElementsByClassName("btnlist");
		  var i;
			for (i = 0; i < element.length; i++) {
				element[i].classList.remove( "active" );
				//element[i].style="display:none;";
			}
      var elementB=document.getElementsByClassName("ul-requisitos");
		  var i;
			for (i = 0; i < elementB.length; i++) {
				elementB[i].style="display: none !important";
			}
			document.getElementById("requisitos-"+id).style="display: block!important;";
		  document.getElementById("btnlist-"+id).classList.add( "active" );

      //menu_mobile = document.querySelector(".ul-requisitos");

  }
  function oficina()
  {
    window.location.href='<?= URL::base() ?>/site/redoficinas?ciudad='+document.getElementById('ciudadSelect').value;
  }

</script>
<script>
var iframe = null;
var havemenu = null;
var isReady = false;
var doneInit = false;
var doneShow = false;
function showChatClient() {
showvar = setInterval(function () {
if(doneInit && !doneShow) {
document.getElementById('cht_cont').style.display = 'inline-block';
doneShow = true;
window.clearInterval(showvar);
}
}, 500);

};
window.addEventListener('message', function (event) {
var msg = new Object();
iframe = document.getElementById('iframechat');
if (event.data.type == 'click') {
if (event.data.obj == 'menu') {
havemenu = event.data.havemenu;
click = event.data.click;
if (havemenu != 0) {
msg.type = 'click';
iframe.contentWindow.postMessage(msg, '*');
if (screen.width > 480 && screen.width < 700) {
if (click == 0) {
document.getElementById('iframechat').style.setProperty("width", "297px", "important");
} else {
document.getElementById('iframechat').style.setProperty("width", "480px", "important");
}
} else if (screen.width > 700) {
if (click == 0) {
document.getElementById('iframechat').style.setProperty("width", "352px", "important");
} else {
document.getElementById('iframechat').style.setProperty("width", "600px", "important");
}
}
}
}
if (event.data.obj == 'bot') {
document.getElementById('cht_cont').style.display = 'none';
doneShow=false;
}
} else if (event.data.type == 'nomenu') {
document.getElementById('iframechat').style.width = "352px";
} else if (event.data.type == 'ready') {
isReady = true;
}
});
document.getElementById('iframechat').onload = function () {
initvar = setInterval(function () {
if (isReady && !doneInit) {
iframe = document.getElementById('iframechat');
var msg = new Object();
msg.type = 'css';
if (screen.width > 480 && screen.width < 700) {
document.getElementById('iframechat').style.setProperty("width", "480px", "important");
}
if (screen.width < 480) {
msg.movil = true;
document.getElementById('iframechat').style.setProperty("width", "100%", "important");
document.getElementById('iframechat').style.setProperty("height", "100%", "important");
iframe.contentWindow.postMessage(msg, '*');
} else {
document.getElementById('cht_cont').style.bottom = "0px";
msg.movil = false;
iframe.contentWindow.postMessage(msg, '*');
}
doneInit = true;
window.clearInterval(initvar);
}

}, 500);
};
</script>
</html>
<?php $this->endPage() ?>
