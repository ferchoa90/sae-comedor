<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use backend\components\Objetos;
use backend\components\Botones;


use yii\bootstrap\ActiveForm;

//$productos= Productos::find()->where(['isDeleted' => '0',"estado"=>"ACTIVO"])->orderBy(["orden" => SORT_ASC])->limit(6)->all();
//$slider= Slider::find()->where(['isDeleted' => '0',"estatus"=>"Activo"])->orderBy(["orden" => SORT_ASC])->limit(7)->all();
//News::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_DESC])->limit(100)->all();
$this->title = 'SAE - Sistema Administrativo Contable';
$botones= new Botones;
$objeto= new Objetos;

?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Facturar</h1>
            <a href="javascript:location.reload();" class="  d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-refresh fa-sm text-white-50"></i> Recargar</a>
            <!--<a href="javascript:generarFactura();" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm d-none"><i class="fas fa-save fa-sm text-white-50"></i> Generar Factura</a>-->
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between align-middle d-none" style="display:none !important;">
                  <!-- <h6 class="m-0 font-weight-bold text-primary">Contenido</h6> -->

                  <h6 class="m-0 font-weight-bold text-primary col-5 col-xs-6 d-table-cell vertical-center  align-middle d-none" >
                        <div class="input-group vertical-center align-middle d-none">
                                                      <input id="cliente" type="number" class="form-control bg-light border-0 small d-none" placeholder="Cédula o Ruc del Cliente" aria-label="Search" aria-describedby="basic-addon1">

                          <div class=" vertical-center align-middle">
                                &nbsp;&nbsp;
                              <a id="agCliente" href="#" data-toggle="modal" data-target="#nuevoClienteModal" class="d-sm-inline-block btn btn-sm btn-success shadow-sm  "> + </a>
                              <a id="dlCliente" href="#" data-toggle="modal d-none" style="display:none;" onclick="javascript:resetCliente();" class=" btn btn-sm btn-danger shadow-sm  "> X </a>
&nbsp;&nbsp;
                                <span id="nCliente"  class="vertical-center align-middle"  style="color: #666!important; font-size: 15px;">....</span>
                          </div>
                            <div class="input-group-append align-middle">
                              <a class="btn btn-warning" id="btn-ok" style="display:none;"><i class="fa fa-check"></i></a>
                              <a class="btn btn-danger" id="btn-danger" style="display:none;"><i class="fa fa-times"></i></a>
                            </div>
                        </div>

                  </h6>
                  <h6 class="m-0 font-weight-bold text-primary col-5 col-xs-6">
                        <div class="input-group">
                           <!--<input id="codigobarras" type="text" class="form-control bg-light border-0 small" placeholder="#" aria-label="Search" aria-describedby="basic-addon1">-->

                            <!-- <input style="" id="producto" autocomplete="off" type="text" class="form-control bg-light border-0 small" placeholder="Item..." aria-label="Search" aria-describedby="basic-addon2">
                             --><div class="input-group-append">
                            <!-- <button class="btn btn-primary" type="button"  data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-sign-in-alt fa-sm"></i>
                            </button> -->
                            </div>
                        </div>
                  </h6>
                  </div>

                <!-- Card Body -->
                <div class="card-body">
                  <div class="row ">
                    <div class="col-12 col-sm-12 col-md-6 border border-primary">
                    <?php $cont=0; ?>
                        <div class="row p-3">
                            <?php foreach ($mesasb as $key => $value) { ?>
                            <div class="col-5 h-100 hc-<?=$value->tamanio?> image-mesa d-flex align-bottom align-text-bottom ">

                                <div class=" col-12 text-right align-self-end p-0">
                                  <div class=" align-top text-left">
                                    <b style="font-size: 15px; color: orange;"><?= $value->nombre ?></b>
                                  </div>
                                    <?php if ($value->estatusmesa=="LIBRE"){  ?>
                                    <a href="javascript:atenderMesa('<?=$value->seccion.$value->numero?>');" class=" d-sm-inline-block btn btn-sm btn-success shadow-sm mt-1" title="Atender"><i class="fa fa-cutlery fa-sm text-white-50"></i>&nbsp;</a>
                                    <br>
                                    <?php } ?>
                                    <?php if ($value->estatusmesa=="OCUPADA"){ $disable='';  ?>
                                          <?php if (@$value->ordenes->usuariocreacion == Yii::$app->user->identity->id){  ?>
                                      <a href="javascript:editarMesa('<?=$value->seccion.$value->numero?>');" class=" d-sm-inline-block btn btn-sm btn-success shadow-sm mt-1" title="Pedido"><i class="fa fa-list-alt fa-sm text-white-50"></i>&nbsp;</a>
                                          <br>
                                          <?php }else{ ?>
                                            <a href="#" disabled  class=" d-sm-inline-block btn btn-sm btn-secondary shadow-sm mt-1" title="Mesa Ocupada"><i class="fa fa-list-alt fa-sm text-white-50"></i>&nbsp;</a>
                                            <br>
                                          <?php } ?>
                                      <a href="javascript:cerrarMesa('<?=$value->seccion.$value->numero?>');" class=" d-sm-inline-block btn btn-sm btn-danger shadow-sm mt-1" title="Cerrar cuenta"><i class="fa fa-tasks fa-sm text-white-50"></i>&nbsp;</a>
                                    <?php } ?>

                                  <div class="p-1"></div>

                                </div>
                            </div>
                            <?php $cont++; ?>
                            <?php if ($cont==1){ echo '<div class="col-2"></div>';$cont=-1; } ?>
                            <?php if ($cont==0){ echo '<div class="p-2 col-12"></div>';} ?>



<div class="modal fade" id="nuevoPedidoModal-<?= $value->nombre ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php if (@$value->ordenes==NULL ||   @$value->ordenes->ordencerrada==1 ){ ?>Nueva Orden (MESA: <?= $value->nombre ?>)<?php }else{ ?> Orden # <?= $value->ordenes->id ?> , MESA: (<?= $value->nombre ?>)   <?php } ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-nuevopedido-<?= $value->nombre ?>"  method="post" >
          <input type="hidden" name="_csrf-frontend" value="<?=Yii::$app->request->getCsrfToken() ?>">
        <div class="row">
             <div class="col-11">
               <input style="" id="producto-<?= $value->nombre ?>" autocomplete="off" type="text" class="form-control bg-light border-0 small" placeholder="Item..." aria-label="Search" aria-describedby="basic-addon2">
              </div>

        <div class="col">
                 <a id="successprod-<?= $value->nombre ?>" href="#" data-toggle="modal d-none" style="display:none;" onclick="javascript:obtenerProducto($('#producto-<?= $value->nombre ?>').val());" class=" btn btn-sm btn-success shadow-sm  "> + </a>
        </div>
      </div>
          <div class="card-body  ">
                  <div class="">
                    <div class="tableFixHead" id="tableFixHead-<?= $value->nombre ?>">
                      <table class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">V. Unitario</th>
                            <th scope="col">V. Total</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody id="contenidoCompra-<?= $value->nombre ?>"  >
                        <!--
                          <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                          </tr> -->
                        </tbody>
                      </table>
                    </div>

                    <div class="pull-right" style=" display:none;">
                      <span style="font-size: 15px;font-weight: bold;" >SUBTOTAL: $</span>
                      <span  style="font-size: 18px;font-weight: bold; color:orange;" id="subtotalfin-<?= $value->nombre ?>">0.00</span>
                    </div>
                    <div class="pull-right " style="clear: both;"></div>
                    <div class="pull-right " style="clear: both; display:none;">
                      <span style="font-size: 15px;font-weight: bold;" >IVA (12%): $</span>
                      <span  style="font-size: 18px;font-weight: bold; color:orange;" id="ivafin-<?= $value->nombre ?>">0.00</span>
                    </div>
                    <div class="pull-right " style="clear: both;"></div>
                    <div class="pull-right " style="clear: both;">
                      <span style="font-size: 15px;font-weight: bold;" >TOTAL: $</span>
                      <span  style="font-size: 18px;font-weight: bold; color:orange;" id="total-<?= $value->nombre ?>">0.00</span>
                    </div>
                    <div class="pull-right " style="clear: both;"></div>
                      <div id="dvrecargo" class="pull-right " style="clear: both; display:none;">
                        <span style="font-size: 15px;font-weight: bold;" >RECARGO (10%): $</span>
                        <span  style="font-size: 18px;font-weight: bold; color:orange;" id="recargo-<?= $value->nombre ?>">0.00</span>
                      </div>
                    </div>
                  </div>
                </div>



          <div class="modal-footer row" class="p-2">
            <div class="col-12">
              <?php
                  $coment="";
                  if (@$value->ordenes->ordencerrada==0){ $coment=@$value->ordenes->comentario; }
              ?>
          <?=
             $contenido=$objeto->getObjetosArray(
              array(
                array('tipo'=>'input','subtipo'=>'oculto', 'nombre'=>'idorden-'.$value->nombre, 'id'=>'idorden-'.$value->nombre, 'valor'=>@$value->ordenes->id),
                array('tipo'=>'input','subtipo'=>'oculto', 'nombre'=>'idmesa-'.$value->nombre, 'id'=>'idmesa-'.$value->nombre, 'valor'=>$value->id),
                array('tipo'=>'input','subtipo'=>'textarea', 'nombre'=>'comentario-'.$value->nombre, 'id'=>'comentario-'.$value->nombre, 'valor'=>$coment, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Comentario: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
              ),true
          );
           ?>
           </div>
            <div class="form-group pr-3" style="  margin-bottom:0px;" >
            <?php //var_dump( @$value->ordenes) ?>
            <?php if (@$value->ordenes->ordencerrada==1 || @$value->ordenes == NULL){ ?>
              <button type="button" onclick="javascript:encerarPedido();" class=" d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-dismiss="modal">Cancelar pedido</button>
              <!--<button type="button" onclick="javascript:guardarPedido();" id="guardarpedido" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" name="save-button">Guardar pedido</button>         -->
              <button type="button" onclick="javascript:enviarPedido();" id="enviarpedido" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" name="save-button">Enviar pedido</button>
                <?php }else{   ?>
                  <button type="button" onclick="javascript:actualizarPedido();" id="actualizarpedido" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" name="save-button">Actualizar pedido</button>
                <?php } ?>

          </div>
          </div>
        </form>
      </div>
    </div>
  </div>


                            <?php } ?>

                        </div>



                    </div>
                    <div class="col-12 col-sm-12 col-md-6 border border-primary">

                        <div class="row p-3">
                            <div class="col-6 ">
                                <div class="col-12 p-3">

                                </div>

                                <?php $cont=0; ?>
                                <?php foreach ($mesasa1 as $key => $value) { ?>
                                  <div class="col-12 h-100 hc-<?=$value->tamanio?> image-mesa d-flex align-bottom align-text-bottom ">
                                    <div class=" col-12 text-right align-self-end p-0">
                                        <div class=" align-top text-left">
                                          <b style="font-size: 15px; color: orange;"><?= $value->nombre ?></b>
                                        </div>
                                        <?php if ($value->estatusmesa=="LIBRE"){  ?>
                                        <a href="javascript:atenderMesa('<?=$value->seccion.$value->numero?>');" class=" d-sm-inline-block btn btn-sm btn-success shadow-sm mt-1" title="Atender"><i class="fa fa-cutlery fa-sm text-white-50"></i>&nbsp;</a>
                                        <br>
                                        <?php } ?>
                                        <?php if ($value->estatusmesa=="OCUPADA"){  ?>
                                          <a href="javascript:editarMesa('<?=$value->seccion.$value->numero?>');" class=" d-sm-inline-block btn btn-sm btn-success shadow-sm mt-1" title="Pedido"><i class="fa fa-list-alt fa-sm text-white-50"></i>&nbsp;</a>
                                          <br>
                                          <a href="javascript:cerrarMesa('<?=$value->seccion.$value->numero?>');" class=" d-sm-inline-block btn btn-sm btn-danger shadow-sm mt-1" title="Cerrar cuenta"><i class="fa fa-tasks fa-sm text-white-50"></i>&nbsp;</a>
                                        <?php } ?>
                                        <div class="p-1"></div>

                                      </div>
                                  </div>
                                  <div class="col-12 p-2"></div>
                                  <?php $cont++;  ?>


<div class="modal fade" id="nuevoPedidoModal-<?= $value->nombre ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle"><?php if (@$value->ordenes==NULL ||   @$value->ordenes->ordencerrada==1 ){ ?>Nueva Orden (MESA: <?= $value->nombre ?>)<?php }else{ ?> Orden # <?= $value->ordenes->id ?> , MESA: (<?= $value->nombre ?>)   <?php } ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-nuevopedido-<?= $value->nombre ?>"  method="post" >
          <input type="hidden" name="_csrf-frontend" value="<?=Yii::$app->request->getCsrfToken() ?>">
        <div class="row">
             <div class="col-11">
               <input style="" id="producto-<?= $value->nombre ?>" autocomplete="off" type="text" class="form-control bg-light border-0 small" placeholder="Item..." aria-label="Search" aria-describedby="basic-addon2">
              </div>

        <div class="col">
                 <a id="successprod-<?= $value->nombre ?>" href="#" data-toggle="modal d-none" style="display:none;" onclick="javascript:obtenerProducto($('#producto-<?= $value->nombre ?>').val());" class=" btn btn-sm btn-success shadow-sm  "> + </a>
        </div>
      </div>
          <div class="card-body  ">
                  <div class="">
                    <div class="tableFixHead" id="tableFixHead-<?= $value->nombre ?>">
                      <table class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">V. Unitario</th>
                            <th scope="col">V. Total</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody id="contenidoCompra-<?= $value->nombre ?>"  >
                        <!--
                          <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                          </tr> -->
                        </tbody>
                      </table>
                    </div>

                    <div class="pull-right" style=" display:none;">
                      <span style="font-size: 15px;font-weight: bold;" >SUBTOTAL: $</span>
                      <span  style="font-size: 18px;font-weight: bold; color:orange;" id="subtotalfin-<?= $value->nombre ?>">0.00</span>
                    </div>
                    <div class="pull-right " style="clear: both;"></div>
                    <div class="pull-right " style="clear: both; display:none;">
                      <span style="font-size: 15px;font-weight: bold;" >IVA (12%): $</span>
                      <span  style="font-size: 18px;font-weight: bold; color:orange;" id="ivafin-<?= $value->nombre ?>">0.00</span>
                    </div>
                    <div class="pull-right " style="clear: both;"></div>
                    <div class="pull-right " style="clear: both;">
                      <span style="font-size: 15px;font-weight: bold;" >TOTAL: $</span>
                      <span  style="font-size: 18px;font-weight: bold; color:orange;" id="total-<?= $value->nombre ?>">0.00</span>
                    </div>
                    <div class="pull-right " style="clear: both;"></div>
                      <div id="dvrecargo" class="pull-right " style="clear: both; display:none;">
                        <span style="font-size: 15px;font-weight: bold;" >RECARGO (10%): $</span>
                        <span  style="font-size: 18px;font-weight: bold; color:orange;" id="recargo-<?= $value->nombre ?>">0.00</span>
                      </div>
                    </div>
                  </div>
                </div>



          <div class="modal-footer row" class="p-2">
            <div class="col-12">
            <?php
                  $coment="";
                  if (@$value->ordenes->ordencerrada==0){ $coment=@$value->ordenes->comentario; }
              ?>
          <?=
             $contenido=$objeto->getObjetosArray(
              array(array('tipo'=>'input','subtipo'=>'oculto', 'nombre'=>'idorden-'.$value->nombre, 'id'=>'idorden-'.$value->nombre, 'valor'=>@$value->ordenes->id),
                array('tipo'=>'input','subtipo'=>'oculto', 'nombre'=>'idmesa-'.$value->nombre, 'id'=>'idmesa-'.$value->nombre, 'valor'=>$value->id),
                array('tipo'=>'input','subtipo'=>'textarea', 'nombre'=>'comentario-'.$value->nombre, 'id'=>'comentario-'.$value->nombre, 'valor'=>@$coment, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Comentario: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
              ),true
          );
           ?>
           </div>
            <div class="form-group pr-3" style="  margin-bottom:0px;" >
            <?php if (@$value->ordenes->ordencerrada==1 || @$value->ordenes == NULL) {  ?>
              <button type="button" onclick="javascript:encerarPedido();" class=" d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-dismiss="modal">Cancelar pedido</button>
              <!--<button type="button" onclick="javascript:guardarPedido();" id="guardarpedido" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" name="save-button">Guardar pedido</button>         -->
              <button type="button" onclick="javascript:enviarPedido();" id="enviarpedido" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" name="save-button">Enviar pedido</button>
                <?php }else{   ?>
                  <button type="button" onclick="javascript:actualizarPedido();" id="actualizarpedido" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" name="save-button">Actualizar pedido</button>
                <?php } ?>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>


                                <?php }  ?>
                              </div>
                              <div class="col-6 ">


                                <?php $cont=0; ?>
                                <?php foreach ($mesasa2 as $key => $value) { ?>
                                  <div class="col-12 h-100 hc-<?=$value->tamanio?> image-mesa d-flex align-bottom align-text-bottom ">
                                    <div class=" col-12 text-right align-self-end p-0">
                                        <div class=" align-top text-left">
                                          <b style="font-size: 15px; color: orange;"><?= $value->nombre ?></b>
                                        </div>
                                        <?php if ($value->estatusmesa=="LIBRE"){  ?>
                                        <a href="javascript:atenderMesa('<?=$value->seccion.$value->numero?>');" class=" d-sm-inline-block btn btn-sm btn-success shadow-sm mt-1" title="Atender"><i class="fa fa-cutlery fa-sm text-white-50"></i>&nbsp;</a>
                                        <?php } ?>
                                        <?php if ($value->estatusmesa=="OCUPADA"){  ?>
                                          <a href="javascript:editarMesa('<?=$value->seccion.$value->numero?>');" class=" d-sm-inline-block btn btn-sm btn-success shadow-sm mt-1" title="Pedido"><i class="fa fa-list-alt fa-sm text-white-50"></i>&nbsp;</a>
                                          <br>
                                          <a href="javascript:cerrarMesa('<?=$value->seccion.$value->numero?>');" class=" d-sm-inline-block btn btn-sm btn-danger shadow-sm mt-1" title="Cerrar cuenta"><i class="fa fa-tasks fa-sm text-white-50"></i>&nbsp;</a>
                                        <?php } ?>
                                        <div class="p-1"></div>

                                      </div>
                                  </div>
                                  <div class="col-12 p-2"></div>
                                  <?php $cont++;  ?>


<div class="modal fade" id="nuevoPedidoModal-<?= $value->nombre ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle"><?php   if (@$value->ordenes==NULL ||   @$value->ordenes->ordencerrada==1 ){?>Nueva Orden (MESA: <?= $value->nombre ?>)<?php }else{ ?> Orden # <?= $value->ordenes->id ?> , MESA: (<?= $value->nombre ?>)   <?php } ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-nuevopedido-<?= $value->nombre ?>"  method="post" >
          <input type="hidden" name="_csrf-frontend" value="<?=Yii::$app->request->getCsrfToken() ?>">
        <div class="row">
             <div class="col-11">
               <input style="" id="producto-<?= $value->nombre ?>" autocomplete="off" type="text" class="form-control bg-light border-0 small" placeholder="Item..." aria-label="Search" aria-describedby="basic-addon2">
              </div>

        <div class="col">
                 <a id="successprod-<?= $value->nombre ?>" href="#" data-toggle="modal d-none" style="display:none;" onclick="javascript:obtenerProducto($('#producto-<?= $value->nombre ?>').val());" class=" btn btn-sm btn-success shadow-sm  "> + </a>
        </div>
      </div>
          <div class="card-body  ">
                  <div class="">
                    <div class="tableFixHead" id="tableFixHead-<?= $value->nombre ?>">
                      <table class="table table-hover table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">V. Unitario</th>
                            <th scope="col">V. Total</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody id="contenidoCompra-<?= $value->nombre ?>"  >
                        <!--
                          <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                          </tr> -->
                        </tbody>
                      </table>
                    </div>

                    <div class="pull-right" style=" display:none;">
                      <span style="font-size: 15px;font-weight: bold;" >SUBTOTAL: $</span>
                      <span  style="font-size: 18px;font-weight: bold; color:orange;" id="subtotalfin-<?= $value->nombre ?>">0.00</span>
                    </div>
                    <div class="pull-right " style="clear: both;"></div>
                    <div class="pull-right " style="clear: both; display:none;">
                      <span style="font-size: 15px;font-weight: bold;" >IVA (12%): $</span>
                      <span  style="font-size: 18px;font-weight: bold; color:orange;" id="ivafin-<?= $value->nombre ?>">0.00</span>
                    </div>
                    <div class="pull-right " style="clear: both;"></div>
                    <div class="pull-right " style="clear: both;">
                      <span style="font-size: 15px;font-weight: bold;" >TOTAL: $</span>
                      <span  style="font-size: 18px;font-weight: bold; color:orange;" id="total-<?= $value->nombre ?>">0.00</span>
                    </div>
                    <div class="pull-right " style="clear: both;"></div>
                      <div id="dvrecargo" class="pull-right " style="clear: both; display:none;">
                        <span style="font-size: 15px;font-weight: bold;" >RECARGO (10%): $</span>
                        <span  style="font-size: 18px;font-weight: bold; color:orange;" id="recargo-<?= $value->nombre ?>">0.00</span>
                      </div>
                    </div>
                  </div>
                </div>



          <div class="modal-footer row" class="p-2">
            <div class="col-12">
            <?php
                  $coment="";
                  if (@$value->ordenes->ordencerrada==0){ $coment=@$value->ordenes->comentario; }
              ?>
          <?=
             $contenido=$objeto->getObjetosArray(
              array(
                array('tipo'=>'input','subtipo'=>'oculto', 'nombre'=>'idorden-'.$value->nombre, 'id'=>'idorden-'.$value->nombre, 'valor'=>@$value->ordenes->id),
                array('tipo'=>'input','subtipo'=>'oculto', 'nombre'=>'idmesa-'.$value->nombre, 'id'=>'idmesa-'.$value->nombre, 'valor'=>$value->id),
                array('tipo'=>'input','subtipo'=>'textarea', 'nombre'=>'comentario-'.$value->nombre, 'id'=>'comentario-'.$value->nombre, 'valor'=>@$coment, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Comentario: ', 'col'=>'col-12 col-md-12', 'adicional'=>''),
              ),true
          );
           ?>
           </div>
            <div class="form-group pr-3" style="  margin-bottom:0px;" >
              <?php //var_dump(@$value->ordenes) ?>
              <?php if (@$value->ordenes->ordencerrada==1 ||  @$value->ordenes==NULL){ ?>
              <button type="button" onclick="javascript:encerarPedido();" class=" d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-dismiss="modal">Cancelar pedido</button>
              <!--<button type="button" onclick="javascript:guardarPedido();" id="guardarpedido" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" name="save-button">Guardar pedido</button>         -->
              <button type="button" onclick="javascript:enviarPedido();" id="enviarpedido" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" name="save-button">Enviar pedido</button>
                <?php }else{  ?>
                  <button type="button" onclick="javascript:actualizarPedido();" id="actualizarpedido" class="d-sm-inline-block btn btn-sm btn-success shadow-sm" name="save-button">Actualizar pedido</button>
                <?php } ?>
             </div>
          </div>
        </form>
      </div>
    </div>
  </div>



                                <?php }  ?>
                              </div>
                            </div>


                        </div>



                    </div>
                  </div>
                  <div class="p-3"></div>
                </div>


              </div>
            </div>


<!-- Modal -->





<!-- Modal -->
<div class="modal fade" id="nuevoClienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="form-clientes" action="/frontend/web/site/facturar" method="post">



          <input type="hidden" name="_csrf-frontend" value="<?=Yii::$app->request->getCsrfToken() ?>">
           <?=
             $contenido=$objeto->getObjetosArray(
              array(
                  array('tipo'=>'select','subtipo'=>'', 'nombre'=>'tipoident', 'id'=>'tipoident', 'valor'=>$tipoidentificacion, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Tipo Identificación: ', 'col'=>'col-6 col-md-6', 'adicional'=>''),
                  array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'identificacion', 'id'=>'identificacion', 'valor'=>'','etiqueta'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Identificación: ', 'col'=>'col-12 col-md-6', 'adicional'=>' onKeyPress="if(this.value.length==13) return false;"'),
                  array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'razonsocial', 'id'=>'razonsocial', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Razon Social: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
                  array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'razoncomercial', 'id'=>'razoncomercial', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Razon Comercial: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
                  array('tipo'=>'select','subtipo'=>'', 'nombre'=>'genero', 'id'=>'genero', 'valor'=>$genero, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Género: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
                  array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'direccion', 'id'=>'direccion', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Dirección: ', 'col'=>'col-12 col-md-8', 'adicional'=>''),
                  array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'correo', 'id'=>'correo', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'arroba','boxbody'=>false,'etiqueta'=>'Correo electrónico: ', 'col'=>'col-12 col-md-8', 'adicional'=>''),
                  array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'telefono', 'id'=>'telefono', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'telefono','boxbody'=>false,'etiqueta'=>'Teléfono: ', 'col'=>'col-6 col-md-4', 'adicional'=>' onKeyPress="if(this.value.length==10) return false;"'),
                  array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
                  array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'credito', 'id'=>'credito', 'valor'=>'Credito', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'Crédito', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
                  array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cupocredito', 'id'=>'cupocredito', 'valor'=>'0.00','etiqueta'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cupo crédito: ', 'col'=>'col-9 col-md-3', 'adicional'=>''),

              ),true
          );
           ?>

          <div class="modal-footer" style="padding-right:0px; padding-bottom:0px;">

            <div class="form-group" style="padding-right:0px; margin-bottom:0px;">
              <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-dismiss="modal">Cancelar</button>

              <button type="button" onclick="javascript:agregarCliente(this);" id="reservassave" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" name="save-button">Agregar</button>          </div>
          </div>


        </form>
      </div>

    </div>
  </div>
</div>

      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; ACEP SISTEMAS 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesión?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">¿Está seguro de cerrar la sesión actual?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= URL::base() ?>/site/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Button trigger modal -->
  <input type="hidden" id="token" name="_csrf-backend" value="<?= Yii::$app->request->getCsrfToken() ?>">
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Búsqueda de productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>




<?php
$this->registerJs("

var tipopago=0;
var selectMesa='';
function atenderMesa(id)
{
  selectMesa=id;
  $('#nuevoPedidoModal-'+id).modal('toggle')

}

function editarMesa(id)
{
  selectMesa=id;
  $('#nuevoPedidoModal-'+id).modal('toggle')

}



$(function() {
  $('#form-nuevopedido-A1,#form-nuevopedido-A2,#form-nuevopedido-A3,#form-nuevopedido-A4,#form-nuevopedido-A5,#form-nuevopedido-A6,#form-nuevopedido-A7,#form-nuevopedido-B1,#form-nuevopedido-B2,#form-nuevopedido-B3,#form-nuevopedido-B4,#form-nuevopedido-B5,#form-nuevopedido-B6').on('submit', function (event) {
             event.preventDefault();
  });
});

$(document).ready(function(){




    $('#producto-A2,#producto-A1,#producto-A3,#producto-A4,#producto-A5,#producto-A6,#producto-A7,#producto-B1,#producto-B2,#producto-B3,#producto-B4,#producto-B5,#producto-B6').typeahead({
      minLength: 1,
      hint: false,
      //autoSelect: false,.
      dynamic: true,
    delay: 500,
  highlight: true,
      rateLimitWait: 120,
      async: true,
      cache: true,
      selectFirst: false,
     source: function(query, result)
     {
     // var obj= $('#producto-A2,#producto-A1,#producto-A3,#producto-A4,#producto-A5,#producto-A6,#producto-A7,#producto-B1,#producto-B2,#producto-B3,#producto-B4,#producto-B5,#producto-B6').attr('id');
      //console.log(obj);
      //var col=obj.replace('producto-','');
      //console.log('#successprod-'+selectMesa);
      $('#successprod-'+selectMesa).fadeIn();

      $.ajax({
       url:\"productoskardex\",
       method:\"POST\",
       data:{query:query, '_csrf-frontend':'".Yii::$app->request->getCsrfToken()."'},
       dataType:\"json\",
       success:function(data)
       {
        result($.map(data, function(item){
            $('#successprod-'+selectMesa).fadeIn();

         return item;
        }));
       }
      })
     }, updater: function (item) {
      /* do whatever you want with the selected item */
     //alert('selected '+item);
     event.preventDefault();
     return item;
 },
    })

    $('#cliente').keypress(function(e) {
      var code = (e.keyCode ? e.keyCode : e.which);
      if(code==13){
          obtenerCliente(this.value);
      }
  });

  $('#producto-A2,#producto-A1,#producto-A3,#producto-A4,#producto-A5,#producto-A6,#producto-A7,#producto-B1,#producto-B2,#producto-B3,#producto-B4,#producto-B5,#producto-B6,#producto-B7').keypress(function(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if(code==13){
      obtenerProducto(this.value);
      $('#successprod-'+selectMesa).fadeOut();
    }
});

    $('#codigobarras').on('change',function(e){
      //alert('Changed!')
      obtenerProductoC(this.value);
     });
   });



   function obtenerProducto(nombre){
       console.log('obtenerP '+nombre)
       //$('#idproducto').val(0)
       $.ajax({
        url:\"productoindividual\",
        method:\"POST\",
        data:{nombrep:nombre,'_csrf-frontend':'".Yii::$app->request->getCsrfToken()."'},
        dataType:\"json\",
        success:function(data)
        {
         // console.log(data[0]);
          if (data[0].id)
          {
            $('#producto-'+selectMesa).val('');
            if (data[0].id){
              agregarProducto(data);
              alertify.success('Producto agregado');
              $('#successprod-'+selectMesa).fadeOut();
            }
          }else{
            alertify.error('Producto no existe');
            $('#producto-'+selectMesa).val('');
          }
          //  $('#btn-ok').hide();
           // $('#btn-danger').fadeIn();
           // $('#contenido').fadeIn();
           // $('#producto').prop('disabled', true);
        }
       })
   }

   function resetCliente()
   {
      $('#agCliente').show();
      $('#cliente').val('');
      $('#nCliente').html('');
      $('#cliente').prop('disabled', false);
      $('#cliente').focus();
      $('#dlCliente').hide();
   }

   function obtenerCliente(obj){
    //console.log('obtenerC '+obj)
    $('#dlCliente').hide()
    $('#agCliente').attr('style','display:none !important');

    $.ajax({
     url:\"obtenercliente\",
     method:\"POST\",
     data:{cedularuc:obj,'_csrf-frontend':'".Yii::$app->request->getCsrfToken()."'},
     dataType:\"json\",
     success:function(data)
     {
         if (data[0])
         {
           // console.log(data[0].nombres);
             $('#nCliente').html(data[0].razonsocial )
             $('#codigobarras').focus();
             $('#cliente').prop('disabled', true);
             $('#dlCliente').show()
         }else{
              $('#agCliente').attr('style','display: block ');
              $('#dlCliente').hide()

             //$('#idproducto').val(data[0].id)
             //$('#preview').attr ( 'src' ,'/frontend/web/images/articulos/'+data[0].imagen)
             //$('#presentacion').focus();
         }
         //$('#btn-ok').hide();
         //$('#btn-danger').fadeIn();
         //$('#contenido').fadeIn();
         //$('#cliente').prop('disabled', true);
     }
    })
  }

   function obtenerProductoC(codigo){
    //console.log('obtenerP '+codigo)
    //$('#idproducto').val(0)
    $.ajax({
     url:\"productoindividualc\",
     method:\"POST\",
     data:{codigo:codigo, '_csrf-frontend':'".Yii::$app->request->getCsrfToken()."'},
     dataType:\"json\",
     success:function(data)
     {
         //console.log(data[0].titulo);
         if (data[0].id)
            {
              $('#codigobarras').val('');
              if (data[0].id){
                agregarProducto(data);
                alertify.success('Producto agregado');
              }
            }else{
              alertify.error('Producto no existe');
              $('#codigobarras').val('');
            }
     }
    })
}

  var nproductos=0;
  function agregarProducto(data)
  {
    //console.log('Agregar Producto');
    recuperarDatafac();
    agregarItemFac(data)
    armarGrid();
  }

  function armarGrid()
  {
    var dataint = [];
    dataint = dataFactura;
    var html='';
    var total=0;

    for (var i = 0, l = dataint.length; i < l; i++) {
      var obj = dataint[i];
      //console.log(obj);
      nproductos=i+1;
      var idproducto=obj.id;
      var button='<a href=\"javascript:quitarItem('+i+');\" class=\"d-sm-inline-block btn btn-sm btn-danger shadow-sm\"><i class=\"fas fa-close fa-sm text-white-50\"></i></a>';
      var trini='<tr id=\"'+nproductos+'\" data-id=\"'+idproducto+'\" >';
      var trfin='</tr>';
      var thini='<th scope=\"row\">';
      var thfin='</th>';
      var tdini='<td>';
      var tdtini='<td id=\"preciot-'+nproductos+'\">';
      var tdfin='</td>';
      var step='';
      var input='<input  id=\"cant-'+nproductos+'\" value=\"'+obj.cantidad+'\" type=\"number\" min=\"1\" style=\"width: 30%;text-align: center;\" onchange=\"javascript:cambiarValor('+nproductos+',this)\" '+step+' />'
      var preciou=obj.valoru;
      var inputprecio='<input readonly onkeypress=\"javascript:cambiarPrecio('+nproductos+',this)\" onchange=\"javascript:cambiarPrecio('+nproductos+',this)\"  id=\"prec-'+nproductos+'\" step=\".01\" style=\" width: 35%;text-align: right;\"  type=\"number\" value=\"'+preciou+'\" >';
      var color=obj.color;
      var clasificacion=obj.clasificacion;
      preciou=(parseFloat(preciou)).toFixed(2);
      var cantidad=obj.cantidad;
      var preciot=obj.total;
      var imagen='<img style=\"width: 30px;\" src=\"/images/articulos/'+obj.imagen+'\" />';
      html=html+trini+tdini+input+tdfin+tdini+obj.nombre+' - '+ obj.descripcion+' '+tdfin+tdini+imagen+tdfin+tdini+inputprecio+tdfin+tdtini+preciot+tdfin+tdini+button+tdfin+trfin;
      total=parseFloat(total)+parseFloat(preciot);
    }
    console.log(total);
    subtotal=(total/1.12);
    $('#subtotalfin-'+selectMesa).html(subtotal.toFixed(2));
    $('#total-'+selectMesa).html(total.toFixed(2));
    $('#ivafin-'+selectMesa).html((total-subtotal).toFixed(2));
    calcularRecargo();
    $('#contenidoCompra-'+selectMesa).html(html);
    $('#tableFixHead-'+selectMesa).scrollTop($('#tableFixHead-'+selectMesa).prop('scrollHeight'));
  }

   function quitarItem(index)
   {
    recuperarDatafac();
      dataFactura.splice(index, 1);
      localStorage.setItem('listaFactura-'+selectMesa, JSON.stringify(dataFactura));
      armarGrid();
   }



  var dataFactura = [];
  var dataFacturaprod = [];
 function encerarPedido()
 {
  dataFactura = [];
  dataFacturaprod = [];
  localStorage.setItem('listaFactura-'+selectMesa, JSON.stringify(dataFactura));
  armarGrid();

 }

 function recuperarDatafac()
 {
    if(localStorage.getItem('listaFactura-'+selectMesa))
    {
      dataFactura = JSON.parse(localStorage.getItem('listaFactura-'+selectMesa));
    }
 }

  function inicializarFactura()
  {

        for (var i = 1; i < 8; i++) {
          if (localStorage.getItem('listaFactura-A'+i)) {
            if (localStorage.getItem('listaFactura-A'+i)==='[]'){


            }else{
              dataFactura = JSON.parse(localStorage.getItem('listaFactura-A'+i));
              selectMesa='A'+i;
              armarGrid();
              selectMesa='';

            }
        } else {
            if (!localStorage.getItem('listaFactura-A'+i)) {
                //listarFacturas();
                localStorage.setItem('listaFactura-A'+i, JSON.stringify(dataFactura));
                //console.log('DATA: A'+i+' :: Esta vacio');

            }
        }
      }

      for (var i = 1; i < 7; i++) {
        if (localStorage.getItem('listaFactura-B'+i)) {
          if (localStorage.getItem('listaFactura-B'+i)==='[]'){


          }else{
            dataFactura = JSON.parse(localStorage.getItem('listaFactura-B'+i));
            selectMesa='B'+i;
            armarGrid();
            selectMesa='';

          }
      } else {
          if (!localStorage.getItem('listaFactura-B'+i)) {
              //listarFacturas();
              localStorage.setItem('listaFactura-B'+i, JSON.stringify(dataFactura));
          }
      }
    }

  }

  function cambiarValor(pos,obj) {
    console.log(\"cambiar valor\");
    var total=0;
    for (var i = 0, l = dataFactura.length; i < l; i++) {
        if (i+1 == pos) {
            dataFactura[i].cantidad = obj.value;
            dataFactura[i].total = (parseFloat(dataFactura[i].valoru).toFixed(2)*parseFloat(obj.value)).toFixed(2);
            $('#preciot-'+pos).html((parseFloat(dataFactura[i].valoru).toFixed(2)*parseFloat(obj.value)).toFixed(2));
        }

      console.log(parseFloat(dataFactura[i].total));
      total=parseFloat(total)+parseFloat(dataFactura[i].total);
    }

    $('#total-'+selectMesa).html(total.toFixed(2));
    localStorage.setItem('listaFactura-'+selectMesa, JSON.stringify(dataFactura));
  }

  function cambiarPrecio(pos,obj) {
    console.log(\"cambiar precio\");
    var total=0;
    for (var i = 0, l = dataFactura.length; i < l; i++) {
        if (i+1 == pos) {
            dataFactura[i].valoru = obj.value;
            valor = obj.value;
            dataFactura[i].total = (parseFloat(valor).toFixed(2)*parseFloat(dataFactura[i].cantidad)).toFixed(2);
            $('#preciot-'+pos).html((parseFloat(valor).toFixed(2)*parseFloat(dataFactura[i].cantidad)).toFixed(2));
        }

      console.log(parseFloat(dataFactura[i].total));
        total=parseFloat(total)+parseFloat(dataFactura[i].total);
    }

    $('#total-'+selectMesa).html(total.toFixed(2));
    localStorage.setItem('listaFactura-'+selectMesa, JSON.stringify(dataFactura));
  }

  function agregarItemFac(data) {
    var itemsearch=false;
    var total=$('#total-'+selectMesa).html(total);
    if (dataFactura.length){
      //console.log('V: '+data[0].preciovp);
      var step=false;
      for (var i = 0, l = dataFactura.length; i < l; i++) {
        if (dataFactura[i].id == data[0].id && dataFactura[i].valoru == data[0].preciovp && step==false) {
            //console.log('Encontró');
            itemsearch=true;
            dataFactura[i].cantidad = parseFloat(dataFactura[i].cantidad)+1;
            dataFactura[i].total = (parseFloat(dataFactura[i].valoru).toFixed(2)*parseInt(dataFactura[i].cantidad)).toFixed(2);
            $('#preciot-'+(i+1)).html((parseFloat(dataFactura[i].valoru).toFixed(2)*parseInt(dataFactura[i].cantidad)).toFixed(2));
            total=parseFloat(total)+parseFloat(dataFactura[i].total);
        }
      }
      if (itemsearch==false){
        //console.log('nuevo');
        var dataFavNew;
        dataFavNew = {
          id: data[0].id,
          nombre: data[0].titulo,
          descripcion: data[0].descripcion,
          color: data[0].color,
          clasificacion: data[0].clasificacion,
          imagen: data[0].imagen,
          valoru: data[0].preciovp,
          codigobarras: data[0].codigobarras,
          cantidad: 1,
          total: data[0].preciovp,
          iva: true,
          estatus: true,
        };

        dataFactura.push(dataFavNew);
      }
    }else{
      //console.log('nuevo');
      var dataFavNew;
      dataFavNew = {
        id: data[0].id,
        nombre: data[0].titulo,
        descripcion: data[0].descripcion,
        color: data[0].color,
          clasificacion: data[0].clasificacion,
        imagen: data[0].imagen,
        valoru: data[0].preciovp,
        codigobarras: data[0].codigobarras,
        cantidad: 1,
        total: data[0].preciovp,
        iva: true,
        estatus: true,
      };

      total=data[0].preciovp;
      dataFactura.push(dataFavNew);
    }
    $('#total-'+selectMesa).html(total);
    localStorage.setItem('listaFactura-'+selectMesa, JSON.stringify(dataFactura));
  }


  inicializarFactura();
    $('#btn-ok').click(function() {
        if ($('#idproducto').val() > 0){
            $('#contenido').fadeIn();
            $('#btn-ok').fadeOut();
            $('#btn-danger').fadeIn();
        }else{
            showMessages('Error', 'Debe seleccionar un producto', 'warning');
        }
    });

    $('#btn-danger').click(function() {
        $('#contenido').fadeOut();
        $('#btn-danger').fadeOut();
        $('#btn-ok').fadeIn();
        $('#producto').prop('disabled', false)
    });

    function enviarPedido()
    {
      var dataFactura = JSON.parse(localStorage.getItem('listaFactura-'+selectMesa));
      var idfac=0;
      if (!$('#cliente').val()){
        $('#cliente').val('9999999999');
        obtenerCliente($('#cliente').val());
      }
      var cliente=$('#cliente').val();
      recuperarDatafac();
      var comentario= $('#comentario-'+selectMesa).val();
      var mesa= $('#idmesa-'+selectMesa).val();
      $.ajax({
          url:\"ingresarorden\",
          method:\"POST\",
          data: { data: dataFactura, cliente:cliente,comentario:comentario, mesa:mesa,'_csrf-frontend':'".Yii::$app->request->getCsrfToken()."' },
          //dataType:\"json\",
          success:function(data)
          {
            var data = jQuery.parseJSON(data);
            //loading(0);
            //console.log(data.success)
            if (data.success) {
                if (data.id)
                {
                  alertify.success('Pedido Enviado');
                  setInterval(location.reload(true),1000);
                  //imprimirFactura(data.id);
                }
            } else {
              alertify.error('El pedido no se ha podido enviar');
            }
          }
      });
    }

    function actualizarPedido()
    {
      var dataFactura = JSON.parse(localStorage.getItem('listaFactura-'+selectMesa));
      var idfac=0;
      if (!$('#cliente').val()){
        $('#cliente').val('9999999999');
        obtenerCliente($('#cliente').val());
      }
      var cliente=$('#cliente').val();
      recuperarDatafac();
      var idorden= $('#idorden-'+selectMesa).val();
      var comentario= $('#comentario-'+selectMesa).val();
      var mesa= $('#idmesa-'+selectMesa).val();
      $.ajax({
          url:\"actualizarorden\",
          method:\"POST\",
          data: { data: dataFactura, idorden:idorden, cliente:cliente,comentario:comentario, mesa:mesa,'_csrf-frontend':'".Yii::$app->request->getCsrfToken()."' },
          //dataType:\"json\",
          success:function(data)
          {
            var data = jQuery.parseJSON(data);
            //loading(0);
            //console.log(data.success)
            if (data.success) {
                if (data.id)
                {
                  alertify.success('Pedido Actualizado');
                  setInterval(location.reload(true),1000);
                  //imprimirFactura(data.id);
                }
            } else {
              alertify.error('El pedido no se ha podido actualizar');
            }
          }
      });
    }

    function cerrarMesa(id)
    {
      selectMesa=id;
      var dataFactura = JSON.parse(localStorage.getItem('listaFactura-'+selectMesa));
      var idfac=0;
      if (!$('#cliente').val()){
        $('#cliente').val('9999999999');
        obtenerCliente($('#cliente').val());
      }
      var cliente=$('#cliente').val();
      recuperarDatafac();
      var mesa= $('#idmesa-'+selectMesa).val();
      $.ajax({
          url:\"cerrarorden\",
          method:\"POST\",
          data: { data: dataFactura, cliente:cliente, mesa:mesa,'_csrf-frontend':'".Yii::$app->request->getCsrfToken()."' },
          //dataType:\"json\",
          success:function(data)
          {
            var data = jQuery.parseJSON(data);
            //loading(0);
            //console.log(data.success)
            if (data.success) {
                if (data.id)
                {
                  alertify.success('Mesa Liberada');
                  encerarPedido()
                  setInterval(location.reload(true),1000);
                  //imprimirFactura(data.id);
                }
            } else {
              alertify.error(data.mensaje);
            }
          }
      });
    }

    function imprimirFactura(id)
    {
       dataFactura = [];
      //printJS('facturaTexto', 'html')
      $('#cliente').prop('disabled', false);
      $('#cliente').val('');
      $('#nCliente').html('....');
      $('#contenidoCompra').html('');
      $('#total-'+selectMesa).html('0.00');
       dataFacturaprod = [];
       encerarPedido();
      localStorage.setItem('listaFactura-'+selectMesa, JSON.stringify(dataFactura));
      POP = window.open('facturaimpresora?token='+id+'&id='+id, 'thePopup', 'width=350,height=350');
      POP.print();
        //printJS({printable: myData, type: 'json', properties: ['prop1', 'prop2', 'prop3']});
    }
    $('#codigobarras').focus();
    alertify.set('notifier','position', 'bottom-right');
    alertify.set('notifier','delay', 1);

    function validardatos()
       {
           //console.log('validardatos');
           if ($('#tipoident').val()!=-1){
            if ($('#cedula').val()!=''){
              if ($('#nombres').val()!=''){
                if ($('#genero').val()!=-1){
                    if ($('#correo').val()!=''){
                              return true;
                            }else{
                                $('#correo').focus();
                                return false;
                            }
                        }else{
                            $('#genero').focus();
                            return false;
                        }
                    }else{
                        $('#razonsocial').focus();
                        return false;
                    }
                }else{
                    $('#identificacion').focus();
                    return false;
                }
            }else{
                $('#tipoidentificacion').focus();
                return false;
            }
            return false;
       }

function calcularRecargo()
{
  //$('#recargo').html(($('#total-'+selectMesa).html()*1.10).toFixed(2)); $('#dvrecargo').fadeIn();
}

       function mostrarTarjeta(objeto)
       {
         //console.log($(objeto).val())
        // if ($(objeto).val()==1){ calcularRecargo(); }else{  $('#dvrecargo').fadeOut();  }
         //tipopago=$(objeto).val();
       }
    function agregarCliente(val)
    {

        console.log('agregar cliente')
            $('#clientes-correo').change(function () {
                $(this).val($.trim($(this).val()));
            });
            var usuarioc = '".Yii::$app->user->identity->id. "';
            var cedula = $('#clientes-cedula').val();
            var nombres = $('#clientes-nombres').val();
            var direccion = $('#clientes-direccion').val();
            var telefono = $('#clientes-telefono').val();
            var correo = $('#clientes-correo').val();

            $.post('nuevocliente', {
                        usuarioc: usuarioc,
                        cedula: cedula,
                        nombres: nombres,
                        direccion: direccion,
                        telefono: telefono,
                        correo: correo,
                       '_csrf-frontend': '".Yii::$app->request->csrfToken."'
                    }).done(function (result) {
                        result = JSON.parse(result);
                        if (result.success) {
                          alertify.success('Cliente Agregado');
                          //$('#nuevoClienteModal').modal('toggle');
                          $('#nuevoClienteModal .close').click();
                          $('#nuevoClienteModal .close').click();
                          $('#form-clientes')[0].reset();
                          $('#cliente').val(cedula);
                          obtenerCliente(cedula);
                        } else {
                          alertify.error('Cliente ya existe');

                        }
                    });
    }

    ",

    View::POS_END,
    'subjects'
);

?>
<style>
.h5, h5
{
  font-size: 1.1em;
  font-weight:bold;
}

.close
{
  font-size: 1.30em;
}

.modal-backdrop {
  background-color: rgb(0,0,0,.3);
}
.modal-body{
  font-size:0.8em;
}

.modal-footer .form-group button{

}

.vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
  display: flex;
  align-items: center;
}

.tableFixHead          { overflow-y: auto; min-height: 200px; height: auto; }
.tableFixHead thead th { position: sticky; top: 0; }
/* Just common table stuff. Really. */

table  { border-collapse: collapse; width: 100%; }
th, td { padding: 8px 16px; }
th     { background:#eee; }

#cliente
{
  -moz-appearance:textfield;
  -webkit-appearance: none;
}

#cliente::-webkit-inner-spin-button,
#cliente::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
@media (min-width: 576px){
.modal-dialog {
    max-width: 50% !important;
    margin: 1.75rem auto;
}
}

.btn-light:not(:disabled):not(.disabled).active, .btn-light:not(:disabled):not(.disabled):active, .show>.btn-light.dropdown-toggle
{
  color: white;
    background-color: #358cd2;

}

.image-mesa
{
    background-image: url('/frontend/web/images/mesas/mesa.png');
    background-repeat: no-repeat;
    background-size: contain;
    background-position: center;
    border: 1px solid #cbd3e9 ;
}
.hc-100
{
    height: 100px !important;
}
.hc-75
{
    height: 75px !important;
}
.hc-50
{
    height: 50px !important;
}
.hc-125
{
    height: 125px !important;
}
  </style>
<script>


</script>
</body>
</html>