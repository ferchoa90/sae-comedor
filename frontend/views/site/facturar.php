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
            <a href="javascript:encerarFactura();" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-close fa-sm text-white-50"></i> Limpiar</a>
            <a href="javascript:generarFactura();" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-save fa-sm text-white-50"></i> Generar Factura</a>
          </div>
          <!-- Content Row -->
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between align-middle">
                  <!-- <h6 class="m-0 font-weight-bold text-primary">Contenido</h6> -->

                  <h6 class="m-0 font-weight-bold text-primary col-5 col-xs-6 d-table-cell vertical-center  align-middle">
                        <div class="input-group vertical-center align-middle">
                                                      <input id="cliente" type="number" class="form-control bg-light border-0 small" placeholder="C??dula o Ruc del Cliente" aria-label="Search" aria-describedby="basic-addon1">

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

                            <input style="" id="producto" autocomplete="off" type="text" class="form-control bg-light border-0 small" placeholder="Item..." aria-label="Search" aria-describedby="basic-addon2">
                            <!--<div class="input-group-append">
                            <!-- <button class="btn btn-primary" type="button"  data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-sign-in-alt fa-sm"></i>
                            </button> -->
                            </div>
                        </div>
                  </h6>
                  </div>
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between align-middle">
                  <h6 class="m-0 font-weight-bold text-primary col-5 col-xs-6">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <label style="border-color: #cbd3e9;font-size: 11px;" class="btn btn-light active">
                        <input type="radio" name="tipopago" id="option1" onchange="javascript:mostrarTarjeta(this);" autocomplete="off" checked value="1"> Efectivo
                      </label>
                      <label style="border-color: #cbd3e9;font-size: 11px;" class="btn btn-light">
                        <input type="radio" onchange="javascript:mostrarTarjeta(this);" name="tipopago" value="2" id="option2"   autocomplete="off"> Tarjeta Cr??dito
                      </label>
                      <label style="border-color: #cbd3e9;font-size: 11px;" class="btn btn-light">
                        <input type="radio" onchange="javascript:mostrarTarjeta(this);" name="tipopago" value="3" id="option3"   autocomplete="off"> Cheque
                      </label>
                      <label style="border-color: #cbd3e9;font-size: 11px;" class="btn btn-light">
                        <input type="radio" onchange="javascript:mostrarTarjeta(this);" name="tipopago" value="5" id="option3"   autocomplete="off"> Cr??dito
                      </label>
                      <label style="border-color: #cbd3e9;font-size: 11px;" class="btn btn-light">
                        <input type="radio" onchange="javascript:mostrarTarjeta(this);" name="tipopago" value="6" id="option3"   autocomplete="off"> Transferencia
                      </label>
                    </div>
                  </h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                  <div class="tableFixHead" id="tableFixHead">
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
                    <tbody id="contenidoCompra"  >
                    <!--
                      <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                      </tr> -->
                    </tbody>
                  </table>
                  </div>

                  <div class="pull-right">
                    <span style="font-size: 15px;font-weight: bold;" >SUBTOTAL: $</span>
                    <span  style="font-size: 18px;font-weight: bold; color:orange;" id="subtotalfin">0.00</span>
                  </div>
                  <div class="pull-right " style="clear: both;"></div>
                  <div class="pull-right " style="clear: both;">
                    <span style="font-size: 15px;font-weight: bold;" >IVA (12%): $</span>
                    <span  style="font-size: 18px;font-weight: bold; color:orange;" id="ivafin">0.00</span>
                  </div>
                  <div class="pull-right " style="clear: both;"></div>
                  <div class="pull-right " style="clear: both;">
                    <span style="font-size: 15px;font-weight: bold;" >TOTAL: $</span>
                    <span  style="font-size: 18px;font-weight: bold; color:orange;" id="total">0.00</span>
                  </div>
                  <div class="pull-right " style="clear: both;"></div>
                  <div id="dvrecargo" class="pull-right " style="clear: both; display:none;">
                    <span style="font-size: 15px;font-weight: bold;" >RECARGO (10%): $</span>
                    <span  style="font-size: 18px;font-weight: bold; color:orange;" id="recargo">0.00</span>
                  </div>
                  </div>



                </div>
              </div>
            </div>
          </div>

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
                  array('tipo'=>'select','subtipo'=>'', 'nombre'=>'tipoident', 'id'=>'tipoident', 'valor'=>$tipoidentificacion, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Tipo Identificaci??n: ', 'col'=>'col-6 col-md-6', 'adicional'=>''),
                  array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'identificacion', 'id'=>'identificacion', 'valor'=>'','etiqueta'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Identificaci??n: ', 'col'=>'col-12 col-md-6', 'adicional'=>' onKeyPress="if(this.value.length==13) return false;"'),
                  array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'razonsocial', 'id'=>'razonsocial', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Razon Social: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
                  array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'razoncomercial', 'id'=>'razoncomercial', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Razon Comercial: ', 'col'=>'col-12 col-md-6', 'adicional'=>''),
                  array('tipo'=>'select','subtipo'=>'', 'nombre'=>'genero', 'id'=>'genero', 'valor'=>$genero, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'G??nero: ', 'col'=>'col-12 col-md-4', 'adicional'=>''),
                  array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'direccion', 'id'=>'direccion', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Direcci??n: ', 'col'=>'col-12 col-md-8', 'adicional'=>''),
                  array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'correo', 'id'=>'correo', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'arroba','boxbody'=>false,'etiqueta'=>'Correo electr??nico: ', 'col'=>'col-12 col-md-8', 'adicional'=>''),
                  array('tipo'=>'input','subtipo'=>'cajatexto', 'nombre'=>'telefono', 'id'=>'telefono', 'valor'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'telefono','boxbody'=>false,'etiqueta'=>'Tel??fono: ', 'col'=>'col-6 col-md-4', 'adicional'=>' onKeyPress="if(this.value.length==10) return false;"'),
                  array('tipo'=>'separador','clase'=>'', 'estilo'=>'', 'color'=>''),
                  array('tipo'=>'input','subtipo'=>'onoff', 'nombre'=>'credito', 'id'=>'credito', 'valor'=>'Credito', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'','boxbody'=>false,'etiqueta'=>'Cr??dito', 'col'=>'col-3 col-md-3',  'adicional'=>' data-width="80%" data-height="35"'),
                  array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'cupocredito', 'id'=>'cupocredito', 'valor'=>'0.00','etiqueta'=>'', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Cupo cr??dito: ', 'col'=>'col-9 col-md-3', 'adicional'=>''),

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
          <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesi??n?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>
        </div>
        <div class="modal-body">??Est?? seguro de cerrar la sesi??n actual?</div>
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
        <h5 class="modal-title" id="exampleModalLabel">B??squeda de productos</h5>
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

var tipopago=1;
$(document).ready(function(){




    $('#producto').typeahead({
      minLength: 1,
      hint: false,
      //autoSelect: false,.
      dynamic: true,
????????delay: 500,
  highlight: true,
      rateLimitWait: 120,
      async: true,
      cache: true,
      selectFirst: false,
     source: function(query, result)
     {
      $.ajax({
       url:\"productoskardex\",
       method:\"POST\",
       data:{query:query, '_csrf-frontend':'".Yii::$app->request->getCsrfToken()."'},
       dataType:\"json\",
       success:function(data)
       {
        result($.map(data, function(item){
            //$('#btn-ok').fadeIn();
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

  $('#producto').keypress(function(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if(code==13){
      obtenerProducto(this.value);
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
            $('#producto').val('');
            if (data[0].id){
              agregarProducto(data);
              alertify.success('Producto agregado');
            }
          }else{
            alertify.error('Producto no existe');
            $('#producto').val('');
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
      var button='<a href=\"javascript:quitarItem('+i+');\" class=\"d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm\"><i class=\"fas fa-close fa-sm text-white-50\"></i></a>';
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
      var inputprecio='<input onkeypress=\"javascript:cambiarPrecio('+nproductos+',this)\" onchange=\"javascript:cambiarPrecio('+nproductos+',this)\"  id=\"prec-'+nproductos+'\" step=\".01\" style=\" width: 35%;text-align: right;\"  type=\"number\" value=\"'+preciou+'\" >';
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
    $('#subtotalfin').html(subtotal.toFixed(2));
    $('#total').html(total.toFixed(2));
    $('#ivafin').html((total-subtotal).toFixed(2));
    calcularRecargo();
    $('#contenidoCompra').html(html);
    $(\"#tableFixHead\").scrollTop($(\"#tableFixHead\").prop(\"scrollHeight\"));
  }

   function quitarItem(index)
   {
      dataFactura.splice(index, 1);
      localStorage.setItem('listaFactura', JSON.stringify(dataFactura));
      armarGrid();
   }



  var dataFactura = [];
  var dataFacturaprod = [];
 function encerarFactura()
 {
  dataFactura = [];
  dataFacturaprod = [];
  localStorage.setItem('listaFactura', JSON.stringify(dataFactura));
  armarGrid();
  $('#codigobarras').focus();
 }

  function inicializarFactura()
  {
      if (localStorage.getItem('listaFactura')) {
          dataFactura = JSON.parse(localStorage.getItem('listaFactura'));
          armarGrid();
      } else {
          if (!localStorage.getItem('listaFactura')) {
              //listarFacturas();
              localStorage.setItem('listaFactura', JSON.stringify(dataFactura));
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

    $('#total').html(total.toFixed(2));
    localStorage.setItem('listaFactura', JSON.stringify(dataFactura));
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

    $('#total').html(total.toFixed(2));
    localStorage.setItem('listaFactura', JSON.stringify(dataFactura));
  }

  function agregarItemFac(data) {
    var itemsearch=false;
    var total=$('#total').html(total);
    if (dataFactura.length){
      //console.log('V: '+data[0].preciovp);
      var step=false;
      for (var i = 0, l = dataFactura.length; i < l; i++) {
        if (dataFactura[i].id == data[0].id && dataFactura[i].valoru == data[0].preciovp && step==false) {
            //console.log('Encontr??');
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
    $('#total').html(total);
    localStorage.setItem('listaFactura', JSON.stringify(dataFactura));
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

    function generarFactura()
    {
      var dataFactura = JSON.parse(localStorage.getItem('listaFactura'));
      var idfac=0;
      if (!$('#cliente').val()){
        $('#cliente').val('9999999999');
        obtenerCliente($('#cliente').val());
      }
      var cliente=$('#cliente').val();

      $.ajax({
          url:\"ingresarfactura\",
          method:\"POST\",
          data: { data: dataFactura, cliente:cliente, tipopago: tipopago,'_csrf-frontend':'".Yii::$app->request->getCsrfToken()."' },
          //dataType:\"json\",
          success:function(data)
          {
            var data = jQuery.parseJSON(data);
            //loading(0);
            //console.log(data.success)
            if (data.success) {
                if (data.id)
                {
                  imprimirFactura(data.id);
                }
            } else {
                 alert('No se ha podido guardar la factura');
                //$.notify(data.Mensaje);
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
      $('#total').html('0.00');
       dataFacturaprod = [];
       encerarFactura();
      localStorage.setItem('listaFactura', JSON.stringify(dataFactura));
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
  $('#recargo').html(($('#total').html()*1.10).toFixed(2)); $('#dvrecargo').fadeIn();
}

       function mostrarTarjeta(objeto)
       {
         //console.log($(objeto).val())
         if ($(objeto).val()==1){ calcularRecargo(); }else{  $('#dvrecargo').fadeOut();  }
         tipopago=$(objeto).val();
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

.tableFixHead          { overflow-y: auto; height: 400px; }
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
  </style>
<script>


</script>
</body>
</html>