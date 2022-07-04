
  <?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

$superior = 'Clase';
$this->title = $model->nombre ;
$this->params['breadcrumbs'][] = ['label'=>$superior, 'url'=>['site/clases',]];
$this->params['breadcrumbs'][] = $this->title;


$script = <<< JS
$(document).ready(function () {       
    jQuery(document).ready(function ($) {
  
    });
});
JS;
$this->registerJs($script, View::POS_END);

?>
 
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />


 <div class="container" style="padding-bottom: 20px; padding-top: 10px;">
 

	
<div class="card">
	<div class="row">
		<aside class="col-sm-5 border-right">
<article class="gallery-wrap"> 
<div class="img-big-wrap">
  <div> <!-- <a href="#"> --><img src="<?= URL::base() ?>/images/<?= $model->imagen ?>"><!-- </a> --></div>
</div> <!-- slider-product.// -->
<!-- <div class="img-small-wrap">
  <div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div>
  <div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div>
  <div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div>
  <div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div>
</div> --> <!-- slider-nav.// -->
</article> <!-- gallery-wrap .end// -->
		</aside>
		<aside class="col-sm-7">
<article class="card-body p-5">
	<h3 class="title mb-3 title-section"><?= $model->nombre ?> </h3>

<p class="price-detail-wrap"> 
	<span class="price h3 text-warning"> 
		<span class="currency" style="color: black;">$ </span><span class="num"  style="color: black; font-family: 'Montserrat-Light';"><?= $model->valor ?></span><br/>
		<span class="currency" style="color: black;">Reserva: </span><span class="num"  style="color: black; font-family: 'Montserrat-Light';"><?= $model->reserva ?> (50%)</span><br/>
	</span> 
 <br/>
</p> <!-- price-detail-wrap .// -->
<dl class="item-property">
<?= $model->descripcion ?>
</dl>
 
<hr>
	<div class="row">
		<div class="col-sm-5">
			<dl class="param param-inline">
			  <dt>Quantity: </dt>
			  <dd>
			  	<select id="cantidad" name="cantidad" class="form-control form-control-md form-control-sm" style="width:70px;">
			  		<option value="1"> 1 </option>
			  		<option value="2"> 2 </option>
			  		<option value="3"> 3 </option>
			  		<option value="4"> 4 </option>
			  		<option value="5"> 5 </option>
			  	</select>
			  </dd>
			</dl>  <!-- item-property .// -->
		</div> <!-- col.// -->
		 
	</div> <!-- row.// -->
	<hr>
	<a href="javascript: enviarItem(1)" class="btn  btn-monatelier btn-lg btn-primary  "> <i class="fa fa-shopping-cart"></i> Comprar </a>
	<a href="javascript: enviarItem(2)" class="btn  btn-monatelier btn-lg btn-outline-primary "> <i class="fa fa-shopping-cart"></i> Reservar </a>
	<!-- <a href="#" class="btn  btn-monatelier btn-lg btn-outline-primary text-uppercase"> <i class="fas fa-shopping-cart"></i> Add to cart </a> -->
</article> <!-- card-body.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</div> <!-- card.// -->


</div>
<!--container.//-->
<script>
function enviarItem(tipo)
{
    var idproducto=0;
    var idclase='<?=$model->id?>';
    var idpinturas=0;
    var tipocompra=tipo;
    var cantidad=document.getElementById('cantidad').value;
    
    agregarItem(idproducto, idclase, idpinturas, tipocompra,cantidad,1);
}
</script>

<style>
.gallery-wrap .img-big-wrap img {
    height: 100%;
    width: 100%;
    display: inline-block;
    cursor: default;
}


.gallery-wrap .img-small-wrap .item-gallery {
    width: 60px;
    height: 60px;
    border: 1px solid #ddd;
    margin: 7px 2px;
    display: inline-block;
    overflow: hidden;
}

.gallery-wrap .img-small-wrap {
    text-align: center;
}
.gallery-wrap .img-small-wrap img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
    border-radius: 4px;
    cursor: zoom-in;
}
.btn-primary  
{
    color: white;
}
.btn-primary:hover
{
    color: black;
}
.form-control-md
{
    font-size:1em;
}
.item-property
{
    color: black;
}
</style>