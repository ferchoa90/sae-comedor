<?php
use backend\components\Objetos;
use backend\components\Botones;
use backend\components\Bloques;
use backend\components\Grid;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use backend\assets\AppAsset;
/* @var $this yii\web\View */

$botones= new Botones;
$this->title = "Nueva Factura";
?>

<!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="row w-100 d-flex ">

              <div class=" p-1 ">
                <a href="javascript:encerarFactura();" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-close fa-sm text-white-50"></i> Limpiar</a>
              </div>
              <div class=" p-1">
                <a href="javascript:generarFactura();" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-credit-card fa-sm text-white-50"></i> Generar Factura</a>
              </div>
              <div class=" p-1">
                <a href="javascript:;" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-save fa-sm text-white-50"></i> Datos factura</a>
              </div>
            </div>
          </div>
          <!-- Content Row -->
          <?php 
            $objeto= new Objetos;
            $div= new Bloques;
            
              $contenido=$objeto->getObjetosArray(
                array(
                    array('tipo'=>'select','subtipo'=>'', 'nombre'=>'tipoprecio', 'id'=>'tipoprecio', 'valor'=>$tiproprecio, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Precio: ', 'col'=>'col-12 col-md-2', 'adicional'=>''),
                    array('tipo'=>'select','subtipo'=>'', 'nombre'=>'formapago', 'id'=>'formapago', 'valor'=>$formaspago, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Forma de pago: ', 'col'=>'col-12 col-md-3', 'adicional'=>''),
                    array('tipo'=>'select','subtipo'=>'', 'nombre'=>'vendedor', 'id'=>'vendedor', 'valor'=>$vendedores, 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Vendedor: ', 'col'=>'col-12 col-md-3', 'adicional'=>''),
                    array('tipo'=>'input','subtipo'=>'numero', 'nombre'=>'vencimiento', 'id'=>'vencimiento', 'valor'=> '', 'onchange'=>'', 'clase'=>'', 'style'=>'', 'icono'=>'lapiz','boxbody'=>false,'etiqueta'=>'Vencimiento: ', 'col'=>'col-12 col-md-2', 'adicional'=>' min="1" max="30" '),
                ),true
            );
          ?>

          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                
                <div class="row card-header d-flex flex-row align-items-center justify-content-between align-middle col-12" style="border-bottom: none;">
                  
                  <h6 class="m-0 font-weight-bold text-primary col-5 col-xs-5 d-table-cell vertical-center  align-middle">
                        <div class="input-group vertical-center align-middle">
                                                      <input id="cliente" type="number" class="form-control bg-light border-0 small" placeholder="Cédula o Ruc del Cliente" aria-label="Search" aria-describedby="basic-addon1">
                          <div class=" vertical-center align-middle">
                                &nbsp;&nbsp;
                              <a id="agCliente" href="#" data-toggle="modal" data-target="#nuevoClienteModal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"> + </a>
&nbsp;&nbsp;
                                <span id="nCliente"  class="vertical-center align-middle"  style="color: #666!important; font-size: 15px;">....</span>
                          </div>
                            <div class="input-group-append align-middle">
                              <a class="btn btn-warning" id="btn-ok" style="display:none;"><i class="fa fa-check"></i></a>
                              <a class="btn btn-danger" id="btn-danger" style="display:none;"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                  </h6>
                  <h6 class="m-0 font-weight-bold text-primary col-7 col-xs-7">
                        <div class="input-group">

                            <input style="" id="producto" data-provide="typeahead" autocomplete="off" type="text" class="form-control bg-light border-0 small" placeholder="Item..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                            <!-- <button class="btn btn-primary" type="button"  data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-sign-in-alt fa-sm"></i>
                            </button> -->
                            </div>
                        </div>
                  </h6>
                  <div class=" card-header align-items-center justify-content-between align-middle col-12">
                    <?= $contenido; ?>
                </div>
                 
                </div>
                
                
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                  <div class="tableFixHead" id="tableFixHead">
                  <table class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Producto</th>
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
                  <div class="pull-left "  style="padding-left: 15px;">
                    <div class="row ">
                    <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio" value="efectivo" checked>
                            <label for="customRadio1" style="font-size: 13px;font-weight: bold;"  class="custom-control-label">Efectivo</label>
                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio"  value="credito">
                        <label for="customRadio2" style="font-size: 13px;font-weight: bold;"  class="custom-control-label">Crédito</label>
                    </div>
                    </div>
                  </div>
                  <div class="pull-right ">
                    <span style="font-size: 15px;font-weight: bold;" >TOTAL: $</span>
                    <span  style="font-size: 18px;font-weight: bold; color:orange;" id="total">0.00</span>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>

<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->


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
$(document).ready(function(){
    $('#producto').typeahead({
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
      $.ajax({
       url:\"productoskardex\",
       method:\"POST\",
       data:{query:query, '_csrf-backend':'".Yii::$app->request->getCsrfToken()."'},
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
        data:{nombrep:nombre,'_csrf-backend':'".Yii::$app->request->getCsrfToken()."'},
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
   function obtenerCliente(obj){
    //console.log('obtenerC '+obj)
    $('#agCliente').attr('style','display:none !important');
    $.ajax({
     url:\"obtenercliente\",
     method:\"POST\",
     data:{cedularuc:obj,'_csrf-backend':'".Yii::$app->request->getCsrfToken()."'},
     dataType:\"json\",
     success:function(data)
     {
         if (data[0])
         {
           // console.log(data[0].nombres);
             $('#nCliente').html(data[0].nombres+' '+data[0].apellidos )
             $('#codigobarras').focus();
             $('#cliente').prop('disabled', true);
         }else{
              $('#agCliente').attr('style','display: block ');
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
      //html=html+trini+tdini+input+tdfin+tdini+obj.nombre+' - '+ obj.descripcion+' '+obj.color+' '+obj.clasificacion+tdfin+tdini+imagen+tdfin+tdini+inputprecio+tdfin+tdtini+preciot+tdfin+tdini+button+tdfin+trfin;
      html=html+trini+tdini+input+tdfin+tdini+obj.nombre+' - '+ obj.descripcion+tdfin+tdini+imagen+tdfin+tdini+inputprecio+tdfin+tdtini+preciot+tdfin+tdini+button+tdfin+trfin;
      total=parseFloat(total)+parseFloat(preciot);
    }
    //console.log(total);
    $('#total').html(total.toFixed(2));
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
      var formapago=document.querySelector('input[name=\"customRadio\"]:checked').value;
      $.ajax({
          url:\"ingresarfactura\",
          method:\"POST\",
          data: { data: dataFactura, cliente:cliente,'_csrf-backend':'".Yii::$app->request->getCsrfToken()."', formapago:formapago },
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
    function agregarCliente(val)
    {
        console.log('agregar cliente')
            $('#clientes-correo').change(function () {
                $(this).val($.trim($(this).val()));
            });
            var usuarioc = '".Yii::$app->user->identity->id. "';
            var cedula = $('#clientes-cedula').val();
            var nombres = $('#clientes-nombres').val();
            var apellidos = $('#clientes-apellidos').val();
            var direccion = $('#clientes-direccion').val();
            var telefono = $('#clientes-telefono').val();
            var correo = $('#clientes-correo').val();
            $.post('nuevocliente', {
                        usuarioc: usuarioc,
                        cedula: cedula,
                        nombres: nombres,
                        apellidos: apellidos,
                        direccion: direccion,
                        telefono: telefono,
                        correo: correo,
                       '_csrf-backend': '".Yii::$app->request->csrfToken."'
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
  </style>