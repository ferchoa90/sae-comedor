<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;

$imgG1;
$imgG2;
$imgG3;
$imgG4;
$imgG5;
$imgG6;
$imgG7;
$imgG8;
$imgG9;
$imgG10;
$imgG11;
$imgG12;

$img1;
$img2;
$img3;
$img4;
$img5;
$img6;
$img7;
$img8;

$equipoG1=$model->team1;
$equipoG2=$model->team2;
$equipoG3=$model->team3;
$equipoG4=$model->team4;
$equipoG5=$model->team5;
$equipoG6=$model->team6;
$equipoG7=$model->team7;
$equipoG8=$model->team8;
$equipoG9=$model->team9;
$equipoG10=$model->team10;
$equipoG11=$model->team11;
$equipoG12=$model->team12;
$terceroG1=$model->tercero1;
$terceroG2=$model->tercero2;

$imgG1= imagenes($model->team1);
$imgG2= imagenes($model->team2);
$imgG3= imagenes($model->team3);
$imgG4= imagenes($model->team4);
$imgG5= imagenes($model->team5);
$imgG6= imagenes($model->team6);
$imgG7= imagenes($model->team7);
$imgG8= imagenes($model->team8);
$imgG9= imagenes($model->team9);
$imgG10= imagenes($model->team10);
$imgG11= imagenes($model->team11);
$imgG12= imagenes($model->team12);
$imgTerG1= imagenes($model->tercero1);
$imgTerG2= imagenes($model->tercero2);

$equipo1=$model->team1;
$equipo2=$model->tercero2;
$equipo3=$model->team2;
$equipo4=$model->team6;
$equipo5=$model->team5;
$equipo6=$model->team10;
$equipo7=$model->team9;
$equipo8=$model->tercero1;

//var_dump($modelFinal);
$img1= imagenes($model->team1);
$img2= imagenes($model->tercero2);
$img3= imagenes($model->team2);
$img4= imagenes($model->team6);
$img5= imagenes($model->team5);
$img6= imagenes($model->team10);
$img7= imagenes($model->team9);
$img8= imagenes($model->tercero1);

$imgSemi1= imagenes($modelFinal->semifinal1);
$imgSemi2= imagenes($modelFinal->semifinal2);
$imgSemi3= imagenes($modelFinal->semifinal3);
$imgSemi4= imagenes($modelFinal->semifinal4);
$imgFinal1= imagenes($modelFinal->final1);
$imgFinal2= imagenes($modelFinal->final2);
$imgcampeon= imagenes($modelFinal->campeon);
$imgvicecampeon= imagenes($modelFinal->vicecampeon);

$semifinal1=$modelFinal->semifinal1;
$semifinal2=$modelFinal->semifinal2;
$semifinal3=$modelFinal->semifinal3;
$semifinal4=$modelFinal->semifinal4;
$final1=$modelFinal->final1;
$final2=$modelFinal->final2;
$campeon=$modelFinal->campeon;
$vicecampeon=$modelFinal->vicecampeon;


function imagenes($equipo)
{
  $data="";
  switch ($equipo) {
    case 'Brasil': $data="brasil.png"; break;
    case 'Bolivia': $data="bolivia.png"; break;
    case 'Venezuela': $data="venezuela.png"; break;
    case 'Perú': $data="peru.png"; break;
    case 'Argentina': $data="argentina.png"; break;
    case 'Colombia': $data="colombia.png"; break;
    case 'Paraguay': $data="paraguay.png"; break;
    case 'Catar': $data="catar.png"; break;
    case 'Uruguay': $data="uruguay.png"; break;
    case 'Ecuador': $data="ecuador.png"; break;
    case 'Japón': $data="japon.png"; break;
    case 'Chile': $data="chile.png"; break;
  }
  return $data;
}



?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<section class="container grupos-container">
    <div class="row">
      <div class="col-12 content-intern">
        <!--<div id="logo-copa"><img src="<?= URL::base() ?>/images/copa_america.png" alt=""/></div>-->
        <div class="col-12 row">
          <h2>FASE DE GRUPOS</h2>
          <div class="col-12 group-content">
            <!-- -->
            <div class="group">
              <h3>Grupo A</h3>
              <div class="teams-positions">
                <section class="btn-team team-1">
                  <div id="team-1" class="name-team"><img src="<?= URL::base() ?>/images/<?=$imgG1 ?>" alt=""/><span><?=$equipoG1 ?></span></div>
                </section>
                <section class="btn-team team-2" >
                  <div id="team-2" class="name-team"><img src="<?= URL::base() ?>/images/<?=$imgG2 ?>" alt=""/><span><?=$equipoG2 ?></span></div>
                </section>
                <section class="btn-team team-3" >
                  <div id="team-3" class="name-team"><img src="<?= URL::base() ?>/images/<?=$imgG3 ?>" alt=""/><span><?=$equipoG3 ?></span></div>
                </section>
                <section class="btn-team team-4" >
                  <div id="team-4" class="name-team" ><img src="<?= URL::base() ?>/images/<?=$imgG4 ?>" alt=""/><span><?=$equipoG4 ?></span></div>
                </section>
              </div>
            </div>
            <!-- -->
            <div class="group">
              <h3>Grupo B</h3>
              <div class="teams-positions">
                <section class="btn-team teamb-1">
                  <div id="teamb-1" class="name-team" ><img src="<?= URL::base() ?>/images/<?=$imgG5 ?>" alt=""/><span><?=$equipoG5 ?></span></div>
                </section>
                <section class="btn-team teamb-2">
                  <div id="teamb-2" class="name-team"><img src="<?= URL::base() ?>/images/<?=$imgG6 ?>" alt=""/><span><?=$equipoG6 ?></span></div>
                </section>
                <section class="btn-team teamb-3 third-group">
                  <div id="teamb-3" class="name-team"><img src="<?= URL::base() ?>/images/<?=$imgG7 ?>" alt=""/><span><?=$equipoG7 ?></span></div>
                </section>
                <section class="btn-team teamb-4">
                  <div id="teamb-4" class="name-team"><img src="<?= URL::base() ?>/images/<?=$imgG8 ?>" alt=""/><span><?=$equipoG8 ?></span></div>
                </section>
              </div>
            </div>
            <!-- -->
            <div class="group">
              <h3>Grupo C</h3>
              <div class="teams-positions">
                <section class="btn-team  teamc-1">
                  <div id="teamc-1" class="name-team"><img src="<?= URL::base() ?>/images/<?=$imgG9 ?>" alt=""/><span><?=$equipoG9 ?></span></div>
                </section>
                <section class="btn-team  teamc-2">
                  <div id="teamc-2" class="name-team"><img src="<?= URL::base() ?>/images/<?=$imgG10 ?>" alt=""/><span><?=$equipoG10 ?></span></div>
                </section>
                <section class="btn-team  teamc-3 third-group">
                  <div id="teamc-3" class="name-team"><img src="<?= URL::base() ?>/images/<?=$imgG11 ?>" alt=""/><span><?=$equipoG11 ?></span></div>
                </section>
                <section class="btn-team  teamc-4">
                  <div id="teamc-4" class="name-team"><img src="<?= URL::base() ?>/images/<?=$imgG12 ?>" alt=""/><span><?=$equipoG12 ?></span></div>
                </section>
              </div>
            </div>
            <!-- -->
          </div>
          <div class="col-12 action-interna">
            <div>
              <span class="team-clasif">Clasificado</span>
              <span class="team-third">Mejor Tercero</span>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <div class="row w-100 fase-final-llaves">
      <div class="col-12 content-intern">
        <!-- <div id="logo-copa"><img src="<?= URL::base() ?>/images/copa_america.png" alt=""/></div> -->
        <div class="w-100">
          <h2>FASES FINALES</h2>
          <div class="col-12 fase-final">
            <h3>OCTAVOS DE FINAL</h3>
            <div class="col-12 container-fase">
              <div class="container-game">
                <div id="team1" class="name-team" onclick=""><img src="<?= URL::base() ?>/images/<?=$img1?>" alt=""/><span><?=$equipo1?></span></div>
                <div class="vs-container">VS</div>
                <div id="team2" class="name-team"><img src="<?= URL::base() ?>/images/<?=$img2?>" alt=""/><span><?=$equipo2?></span></div>
              </div>
              <div class="container-game">
                <div id="team3" class="name-team"><img src="<?= URL::base() ?>/images/<?=$img3?>" alt=""/><span><?=$equipo3?></span></div>
                <div class="vs-container">VS</div>
                <div id="team4" class="name-team"><img src="<?= URL::base() ?>/images/<?=$img4?>" alt=""/><span><?=$equipo4?></span></div>
              </div>
              <div class="container-game">
                <div id="team5" class="name-team"><img src="<?= URL::base() ?>/images/<?=$img5?>" alt=""/><span><?=$equipo5?></span></div>
                <div class="vs-container">VS</div>
                <div id="team6" class="name-team"><img src="<?= URL::base() ?>/images/<?=$img6?>" alt=""/><span><?=$equipo6?></span></div>
              </div>
              <div class="container-game">
                <div id="team7" class="name-team"><img src="<?= URL::base() ?>/images/<?=$img7?>" alt=""/><span><?=$equipo7?></span></div>
                <div class="vs-container">VS</div>
                <div id="team8" class="name-team"><img src="<?= URL::base() ?>/images/<?=$img8?>" alt=""/><span><?=$equipo8?></span></div>
              </div>
            </div>
          </div>
          <div class="col-12 fase-final" id="div-semifinal">
            <h3>Semifinal</h3>
            <div class="col-12 container-fase">
              <div class="container-game">
                <div class="name-team" id="semifinal1"><img src="<?= URL::base() ?>/images/<?=$imgSemi1?>" alt=""/><span><?=$semifinal1 ?></span></div>
                <div class="vs-container">VS</div>
                <div class="name-team" id="semifinal2"><img src="<?= URL::base() ?>/images/<?=$imgSemi2?>" alt=""/><span><?=$semifinal2 ?></span></div>
              </div>
              <div class="container-game">
                <div class="name-team" id="semifinal3"><img src="<?= URL::base() ?>/images/<?=$imgSemi3?>" alt=""/><span><?=$semifinal3 ?></span></div>
                <div class="vs-container">VS</div>
                <div class="name-team" id="semifinal4"><img src="<?= URL::base() ?>/images/<?=$imgSemi4?>" alt=""/><span><?=$semifinal4 ?></span></div>
              </div>
            </div>
          </div>
          <div class="col-12 fase-final"  id="div-final">
            <h3>Final</h3>
            <div class="col-12 container-fase fina-copa">
              <div class="container-game">
                <div class="name-team"  id="final1"><img src="<?= URL::base() ?>/images/<?=$imgFinal1 ?>" alt=""/><span><?=$final1 ?></span></div>
                <div class="vs-container">VS</div>
                <div class="name-team"  id="final2"><img src="<?= URL::base() ?>/images/<?=$imgFinal2 ?>" alt=""/><span><?=$final2 ?></span></div>
              </div>
              <div class="col-12 final-result"  id="div-campeon">
                <h1>CAMPEÓN<h1>
                <div class="name-team name-champion" id="campeon"><img src="<?= URL::base() ?>/images/<?=$imgcampeon ?>" alt=""/><span><?=$campeon ?></span></div>
                <h5>Subcampeón</h5>
                <div class="name-team second-place" id="vicecampeon"><img src="<?= URL::base() ?>/images/<?=$imgvicecampeon ?>" alt=""/><span><?=$vicecampeon ?></span></div>
              </div>
            </div>
          </div>
          <div class="col-12 action-interna">
            <div>
              <span class="team-clasif">Ganador del partido</span>
            </div>
            <div><button class="btn btn-nivea"  onclick="javascript:window.location.href='<?= URL::base() ?>/site/listapronosticos?d='+'<?= $_GET['d'] ?>'">ANTERIOR</button></div>
          </div>
        </div>
      </div>
      
    </div>

  </section>
  <div id="legal-back">* No induce irritación, determinado por un estudio de compatibilidad dermatológica Beiersdorf AG.</div>
