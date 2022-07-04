
  <?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

$this->title = ' Pinturas';
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
    <h2 class="title-section"><?= Html::encode($this->title) ?></h2>
 <br>
    <div class="row">
        <?php foreach ($model as $key => $value) { ?>
        <div class="col-md-4 col-sm-6">
            <div class="product-grid6">
                <div class="product-image6">
                    <a href="#">
                        <img class="pic-1" src="<?= URL::base() ?>/images/<?= $value->imagen ?>">
                    </a>
                </div>
                <div class="product-content">
                    <h3 class="title"><strong style="color:#ECB964;font-size: 15px;">Tema:<strong> <a href="#"><?= $value->nombre ?></a></h3>
                    <?php $date= date_create($value->fecha); ?>
                    <h3 class="title"><strong style="color:#ECB964;font-size: 15px;">Fecha:<strong> <a href="#"><?= date_format($date,'d').' Septiembre' ?></a></h3>
                    <div class="price"><?= $value->valor ?>
                        <span>$<?= $value->valor+10 ?></span>
                    </div>
                </div>
                <ul class="social">
                    <li><a href="<?= URL::base() ?>/site/pintura?id=<?= $value->id ?>" data-tip="Ver más"><i class="fa fa-search"></i></a></li>
                    <!-- <li><a href="" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li> -->
                    <li><a href="<?= URL::base() ?>/site/pintura?id=<?= $value->id ?>" data-tip="Comprar"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<hr>
 
 
<style>
h3.h3{text-align:center;margin:1em;text-transform:capitalize;font-size:1.7em;}

 

/********************* Shopping Demo-6 **********************/
.product-grid6,.product-grid6 .product-image6{overflow:hidden}
.product-grid6{border: 1px solid #ccc; font-family:'Open Sans',sans-serif;text-align:center;position:relative;transition:all .5s ease 0s}
.product-grid6:hover{box-shadow:0 0 10px rgba(0,0,0,.3)}
.product-grid6 .product-image6 a{display:block}
.product-grid6 .product-image6 img{width:100%;height:auto;transition:all .5s ease 0s}
.product-grid6:hover .product-image6 img{transform:scale(1.1)}
.product-grid6 .product-content{padding:12px 12px 15px;transition:all .5s ease 0s}
.product-grid6:hover .product-content{opacity:0}
.product-grid6 .title{font-size:20px;font-weight:600;text-transform:capitalize;margin:0 0 10px;transition:all .3s ease 0s}
.product-grid6 .title a{color:#000}
.product-grid6 .title a:hover{color:#ECB964}
.product-grid6 .price{font-size:18px;font-weight:600;color:#ECB964}
.product-grid6 .price span{color:#999;font-size:15px;font-weight:400;text-decoration:line-through;margin-left:7px;display:inline-block}
.product-grid6 .social{background-color:#fff;width:100%;padding:0;margin:0;list-style:none;opacity:0;transform:translateX(-50%);position:absolute;bottom:-50%;left:50%;z-index:1;transition:all .5s ease 0s}
.product-grid6:hover .social{opacity:1;bottom:20px}
.product-grid6 .social li{display:inline-block}
.product-grid6 .social li a{color:#909090;font-size:16px;line-height:45px;text-align:center;height:45px;width:45px;margin:0 7px;border:1px solid #909090;border-radius:50px;display:block;position:relative;transition:all .3s ease-in-out}
.product-grid6 .social li a:hover{color:#fff;background-color:#ECB964;width:80px}
.product-grid6 .social li a:after,.product-grid6 .social li a:before{content:attr(data-tip);color:#fff;background-color:#ECB964;font-size:12px;letter-spacing:1px;line-height:20px;padding:1px 5px;border-radius:5px;white-space:nowrap;opacity:0;transform:translateX(-50%);position:absolute;left:50%;top:-30px}
.product-grid6 .social li a:after{content:'';height:15px;width:15px;border-radius:0;transform:translateX(-50%) rotate(45deg);top:-20px;z-index:-1}
.product-grid6 .social li a:hover:after,.product-grid6 .social li a:hover:before{opacity:1}
@media only screen and (max-width:990px){.product-grid6{margin-bottom:30px}
}
 

</style>