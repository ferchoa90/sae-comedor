
  <?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

$this->title = ' Galería';
$this->params['breadcrumbs'][] = $this->title;


$script = <<< JS
$(document).ready(function () {       
    $(function() {
    var selectedClass = "";
    $(".filter").click(function(){
    selectedClass = $(this).attr("data-rel");
    $("#gallery").fadeTo(100, 0.1);
    $("#gallery div").not("."+selectedClass).fadeOut().removeClass('animation');
    setTimeout(function() {
    $("."+selectedClass).fadeIn().addClass('animation');
    $("#gallery").fadeTo(300, 1);
    }, 300);
    });
    });
});
JS;
$this->registerJs($script, View::POS_END);

?>
 
<section>
 <!-- Grid row -->
<div class="row">

<!-- Grid column -->
<div class="col-md-12  justify-content-center ">

  <div class="row text-center justify-content-center" style="padding-top:20px;padding-bottom:20px" >
    <div class=" col-md-1" style="padding: 0px; padding-right:10px;"><button type="button" class="filter btn btn-monatelier btn-orange col-md-12" data-rel="all">Todos</button></div>
    <!-- <div class=" col-md-1" style="padding: 0px; padding-right:10px;"><button type="button" class="btn btn-monatelier btn-orange col-md-12" data-rel="1">Galeria</button></div> -->
    <div class=" col-md-1" style="padding: 0px; padding-right:10px;"><button type="button" class="filter btn btn-monatelier btn-orange col-md-12" data-rel="2">Eventos</button></div>
  </div>
 
</div>
<!-- Grid column -->


<!-- Grid row -->

<!-- Grid row -->
<div class="gallery col-md-12" id="gallery">

<!-- Grid column -->
<div class="mb-3 pics animation all 2">
  <img class="img-fluid" src="<?= URL::base() ?>/images/salonazul.jpg" alt="Card image cap">
</div>
<!-- Grid column -->

<!-- Grid column -->
<div class="mb-3 pics animation all">
  <img class="img-fluid" src="<?= URL::base() ?>/images/pareja1.jpg" alt="Card image cap">
</div>
<!-- Grid column -->

<!-- Grid column -->
<div class="mb-3 pics animation all">
  <img class="img-fluid" src="<?= URL::base() ?>/images/pinturaninos.jpg" alt="Card image cap">
</div>
<!-- Grid column -->

<!-- Grid column -->
<div class="mb-3 pics animation all 2">
  <img class="img-fluid" src="<?= URL::base() ?>/images/salon2.jpg" alt="Card image cap">
</div>
<!-- Grid column -->

 
</div>
<!-- Grid row -->

</section>

<style>
.gallery {
-webkit-column-count: 3;
-moz-column-count: 3;
column-count: 3;
-webkit-column-width: 33%;
-moz-column-width: 33%;
column-width: 33%; }
.gallery .pics {
-webkit-transition: all 350ms ease;
transition: all 350ms ease; }
.gallery .animation {
-webkit-transform: scale(1);
-ms-transform: scale(1);
transform: scale(1); }

@media (max-width: 450px) {
.gallery {
-webkit-column-count: 1;
-moz-column-count: 1;
column-count: 1;
-webkit-column-width: 100%;
-moz-column-width: 100%;
column-width: 100%;
}
}

@media (max-width: 400px) {
.btn.filter {
padding-left: 1.1rem;
padding-right: 1.1rem;
}
}
    </style>