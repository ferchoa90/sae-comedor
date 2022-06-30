<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Productos;
use common\models\Factura;
use common\models\Facturadetalle;
use common\models\Tipopreciofactura;
use common\models\Vendedores;
use common\models\Formaspago;
use common\models\Inventario;
use backend\components\Botones;
use backend\components\Facturacion_tipoident;
use backend\components\Facturacion_cliente;
use backend\components\Sistema_genero;
use common\models\Clientes;
use common\models\Entregas;


/**
 * Site controller
 */
class FacturacionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'view', 'delete', 'index'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'view', 'delete', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionFacturacionelectronica()
    {
        return $this->render('facturacionelectronica');
    }

    public function actionVerentregas($id)
    {
        $entregas= Entregas::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('verentregas', [
            'entregas' =>$entregas,
           // 'entregasdetalle' => Diariodetalle::find()->where(['diario' => $entregas->diario, "isDeleted" => 0])->all(),
        ]);

    }

    public function actionVerfactura($id)
    {
        $factura= Factura::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('verfactura', [
            'factura' =>$factura,
           // 'entregasdetalle' => Diariodetalle::find()->where(['diario' => $entregas->diario, "isDeleted" => 0])->all(),
        ]);

    }

    public function actionVervendedor($id)
    {
        $vendedor= Vendedores::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('vervendedor', [
            'vendedor' =>$vendedor,
           // 'entregasdetalle' => Diariodetalle::find()->where(['diario' => $entregas->diario, "isDeleted" => 0])->all(),
        ]);

    }

    public function actionObtenercliente()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            //return $this->redirect(URL::base() . "/site/login");
        }
        $cedularuc=$_REQUEST["cedularuc"];
        //$nombrep=explode(" -",$_REQUEST["nombrep"]);
        //$nombrep[0]="167";
        $page = "site";
        $model = Clientes::find()->where(['cedula' => $cedularuc])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
            foreach ($model as $key => $data) {
                $arrayResp[$key]['id'] = $data->id;
                $arrayResp[$key]['cedula'] = $data->cedula;
                $arrayResp[$key]['nombres'] = $data->nombres;
                if ($data->apellidos){  $arrayResp[$key]['apellidos'] = $data->apellidos; }else{  $arrayResp[$key]['apellidos'] = ""; }
                $arrayResp[$key]['direccion'] = $data->direccion;
                $arrayResp[$key]['telefono'] = $data->telefono;
                $arrayResp[$key]['correo'] = $data->correo;
                $arrayResp[$key]['tipo'] = $data->tipo;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $count++;
            }
        return json_encode($arrayResp);
    }

    public function actionIngresarfactura()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        if (isset($_POST) and !empty($_POST)) {
            $data = $_POST;
            //echo $data["cliente"];
            $factant=Factura::find()->orderBy(["fechacreacion" => SORT_DESC])->one();
            //var_dump($factant);
            $facturan=$factant->nfactura+1;
            $cliente = Clientes::find()->where(['cedula' => $data["cliente"]])->orderBy(["fechacreacion" => SORT_DESC])->all();
            $factura= new Factura();
            $factura->nfactura=$facturan;
            $factura->idcliente=$cliente[0]->id;
            $factura->nombres=$cliente[0]->nombres.' '.$cliente[0]->apellidos;
            $factura->ruc=$cliente[0]->cedula;
            $factura->usuariocreacion=  Yii::$app->user->identity->id;
            //$factura->usuariocreacion=  1;
            $factura->tipopago= ($data["formapago"]=='efectivo')? 1 : 5;
            $factura->tipodoc=1;
            $factura->facturae='PENDIENTE';
            $factura->estatus='ACTIVA';
            $valortotal=0;
            $iva=0;
            $subtotal=0;
            foreach ($data["data"] as $key => $value) {
                //$value["id"];
                $valortotal=$valortotal+($value["valoru"]*$value["cantidad"]);
            }
            $valortotal= number_format($valortotal, 2);
            $subtotal= number_format($valortotal/1.12,2);
            $iva= number_format($valortotal-$subtotal,2);
            $factura->subtotal=$subtotal;
            $factura->iva=$iva;
            $factura->total=$valortotal;
            if ($factura->save()){
                foreach ($data["data"] as $key => $value) {
                    //$value["id"];
                    $subtotalI= number_format($value["valoru"]/1.12,2);
                    $ivaI= number_format($value["valoru"]-$subtotalI,2);
                    $modelI =  Inventario::find()->where(['id' => $value["id"]])->one();
                    $descripcion=$value["descripcion"];
                    if ($value["color"]!="N/A"){ $descripcion.=' '.$value["color"]; }
                    if ($value["clasificacion"]!="N/A"){ $descripcion.=' '.$value["clasificacion"]; }
                    $facturaDetalle= new Facturadetalle();
                    $facturaDetalle->idfactura=$factura->id;
                    $facturaDetalle->cantidad=$value["cantidad"];
                    $facturaDetalle->idarticulo=$modelI->id;
                    $facturaDetalle->idinventario=$value["id"];
                    $facturaDetalle->narticulo=$value["nombre"];
                    $facturaDetalle->tarticulo=$descripcion;
                    $facturaDetalle->tarticulo=$value["descripcion"].".";
                    $facturaDetalle->imagen=$value["imagen"];
                    $facturaDetalle->valoru=$value["valoru"];
                    $facturaDetalle->valort=number_format($value["valoru"]*$value["cantidad"],2);
                    $facturaDetalle->iva=$ivaI;
                    $facturaDetalle->civa=0;
                    $facturaDetalle->estatus='ACTIVO';
                    $facturaDetalle->save();
                        $modelI->stock=$modelInventario->stock- $value["cantidad"];
                        $modelI->save();
                    //var_dump($facturaDetalle->errors);
                }
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $factura->id);
            }else{
                $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el banner.","resp" => false, "id" => "");
            }
             //var_dump($factura->errors);
            //var_dump($data["data"][0]);
            return json_encode($return);
        }
    }

    public function actionProductoindividual()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $nombrep=$_REQUEST["nombrep"];
        $nombrep=explode(" -",$_REQUEST["nombrep"]);
        //$nombrep[0]="167";
        $page = "site";
               $arrayResp = array();
        $count = 1;
            //$modelInventario = Productos::find()->where(['id' => str_replace("-","",$nombrep[0]) ])->orderBy(["fechacreacion" => SORT_DESC])->all();
            $model =  Inventario::find()->where(['id' =>  str_replace("-","",$nombrep[0])])->orderBy(["fechacreacion" => SORT_DESC])->all();
 //die(var_dump($nombrep[0]));
            //var_dump($modelInventario);
           /* if (!$modelInventario){
                $arrayResp[0]['id'] = $model->id;
                $arrayResp[0]['imagen'] = $model>imagen;
            }*/
            foreach ($model as $keyI => $dataI) {
                $arrayResp[$keyI]['titulo'] = $dataI->producto->nombreproducto;
                $arrayResp[$keyI]['descripcion'] = $dataI->producto->descripcion;
                $arrayResp[$keyI]['color'] = $dataI->color->nombre;
                $arrayResp[$keyI]['clasificacion'] = $dataI->clasificacion->nombre;
                $arrayResp[$keyI]['imagen'] = '<img style="width:20px;" src="/frontend/web/images/articulos/'.$dataI->producto->imagen.'"/>';
                //$arrayResp[$keyI]['imagen'] = '-';
                $arrayResp[$keyI]['stock'] = $dataI->stock;
                $arrayResp[$keyI]['cantidadini'] = $dataI->cantidadini;
                $arrayResp[$keyI]['cantidadcaja'] = $dataI->cantidadcaja;
                $arrayResp[$keyI]['precioint'] = $dataI->precioint;
                $arrayResp[$keyI]['preciov1'] = $dataI->preciov1;
                $arrayResp[$keyI]['preciov2'] = $dataI->preciov2;
                $arrayResp[$keyI]['preciovp'] = $dataI->preciovp;
                $arrayResp[$keyI]['codigobarras'] = $dataI->codigobarras;
                $arrayResp[$keyI]['codigocaja'] = $dataI->codigocaja;
                $arrayResp[$keyI]['usuariocreacion'] = $dataI->producto->usuariocreacion0->username;
                //$arrayResp[$keyI]['fechacreacion'] = "-";
                $arrayResp[$keyI]['id'] = $dataI->id;
                $arrayResp[$keyI]['imagen'] = $dataI->producto->imagen;
                $count++;
            }
        //die(var_dump($arrayResp));
        return json_encode($arrayResp);
    }

    public function actionProductoindividualc()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            //return $this->redirect(URL::base() . "/site/login");
        }
        $codigo=$_REQUEST["codigo"];
        //$nombrep=explode(" -",$_REQUEST["nombrep"]);
        //$nombrep[0]="167";
        $page = "site";
        $model = Inventario::find()->where(['codigobarras' => $codigo])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
            $modelInventario = Productos::find()->where(['id' => $model[0]->idproducto ])->orderBy(["fechacreacion" => SORT_DESC])->all();
            //var_dump($modelInventario);
            if (!$modelInventario){
                $arrayResp[0]['id'] = $model[0]->id;
                $arrayResp[0]['imagen'] = $model[0]->imagen;
            }
            foreach ($modelInventario as $keyI => $dataI) {
                $arrayResp[$keyI]['titulo'] = $dataI->nombreproducto;
                $arrayResp[$keyI]['descripcion'] = $dataI->descripcion;
                $arrayResp[$keyI]['imagen'] = '<img style="width:20px;" src="/frontend/web/images/articulos/'.$dataI->imagen.'"/>';
                //$arrayResp[$keyI]['imagen'] = '-';
                $arrayResp[$keyI]['stock'] = $model[0]->stock;
                $arrayResp[$keyI]['cantidadini'] = $model[0]->cantidadini;
                $arrayResp[$keyI]['cantidadcaja'] = $model[0]->cantidadcaja;
                $arrayResp[$keyI]['precioint'] = $model[0]->precioint;
                $arrayResp[$keyI]['preciov1'] = $model[0]->preciov1;
                $arrayResp[$keyI]['preciov2'] = $model[0]->preciov2;
                $arrayResp[$keyI]['preciovp'] = $model[0]->preciovp;
                $arrayResp[$keyI]['codigobarras'] = $model[0]->codigobarras;
                $arrayResp[$keyI]['codigocaja'] = $model[0]->codigocaja;
                $arrayResp[$keyI]['usuariocreacion'] = $dataI->usuariocreacion0->username;
                //$arrayResp[$keyI]['fechacreacion'] = "-";
                $arrayResp[$keyI]['id'] = $dataI->id;
                $arrayResp[$keyI]['imagen'] = $dataI->imagen;
                $count++;
            }
        return json_encode($arrayResp);
    }

    public function actionFacturaimpresora($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $this->layout = 'impresion';
        $factura = Factura::find()->where(['id' => $id])->one();
        return $this->render('facturaimpresora', [
            'factura' => $factura,
        ]);
    }


    public function actionProductoskardex()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "inventario";
        //$model = Productos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $modelI =  Inventario::find()->where(['isDeleted' => 0,'idsucursal' => Yii::$app->user->identity->idsucursal ])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        //die(var_dump($modelI));
        $count = 1;
        foreach ($modelI as $key => $data) {
            //$arrayResp[] = $data->id.' - '.$data->producto->nombreproducto.' - '.$data->producto->marca0->nombre.' '.$data->color->nombre.' '.$data->clasificacion->nombre.' - '.$data->producto->descripcion;
            $arrayResp[] = $data->id.' - '.$data->producto->nombreproducto;
        }
       //  die(var_dump($arrayResp));
        return json_encode($arrayResp);
    }

    public function actionNuevocliente()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $tipoident = new Facturacion_tipoident();
        $tipoident = $tipoident->getSelect();
        $genero = new Sistema_genero();
        $genero = $genero->getSelect();

        return $this->render('nuevocliente', [
            'tipoidentificacion' => $tipoident,
            'genero' => $genero,
        ]);
    }

    public function actionEditarcliente($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $cliente = Clientes::find()->where(['id' => $id])->one();
        $tipoident = new Facturacion_tipoident();
        $tipoident = $tipoident->getSelect();
        $genero = new Sistema_genero();
        $genero = $genero->getSelect();

        return $this->render('editarcliente', [
            'tipoidentificacion' => $tipoident,
            'genero' => $genero,
            'model' => $cliente,
        ]);
    }

    public function actionVercliente($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        return $this->render('vercliente', [
            'cliente' => Clientes::find()->where(['id'=>$id])->one(),
            //'modelTeam' => Productos::find()->all(),
        ]);

    }

    public function actionFormnuevocliente()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        $data= new Facturacion_cliente;
        $data= $data->Nuevo($_POST);
        $response=$data;
        return json_encode($response);

    }

    public function actionFormeditarcliente()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        $data= new Facturacion_cliente;
        $data= $data->Editar($_POST);
        $response=$data;
        return json_encode($response);

    }

    public function actionClientes()
    {
        return $this->render('clientes');
    }

    public function actionClientesreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "Clientes";
        $model = Clientes::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
              //  $arrayResp[$key]['cliente'] = $data->cliente->nombres;
                $view='cliente';
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "cedula") || ($id == "razonsocial")  || ($id == "razoncomercial") ) { $arrayResp[$key][$id] = $text; }
                    if (  ($id == "direccion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "correo") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "telefono") || ($id == "usuariocreacion")  || ($id == "codigo")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionFacturasreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "facturacion";
        $model = Factura::find()->where(['isDeleted' => '0'])->orderBy(["fecha" => SORT_DESC])->limit(1000)->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {

            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;

                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                $arrayResp[$key]['formapago'] = $data->tipopago0->nombre;
                $arrayResp[$key]['tipotarjeta'] = $data->tipotarjetapago->nombre;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                //$arrayResp[$key]['cliente'] = $data->cliente->razonsocial;
                $arrayResp[$key]['cliente'] = $data->nombre;
                $view='factura';
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                         // array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                         // array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nfactura") || ($id == "subtotal") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "total") || ($id == "descuento") || ($id == "fecha") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "iva") || ($id == "usuariocreacion")  || ($id == "codigo")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }

            $count++;

        }



        return json_encode($arrayResp);

    }


    public function actionEntregasreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }   
        $page = "entregas";
        $model = Entregas::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;

                $view='entregas';
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'ver'.$view.'?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          //array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editar'.$view.'?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nfactura") || ($id == "fecha") || ($id == "hora") || ($id == "guiaremision")  || ($id == "notas") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechaintraslado") || ($id == "fechafintraslado") || ($id == "puntopartida") || ($id == "puntollegada") ) { $arrayResp[$key][$id] = $text; }
                    if (  ($id == "fechacreacion")) { $arrayResp[$key][$id] = $text; }


                }

            }

            $count++;

        }



        return json_encode($arrayResp);

    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index3');
    }

    public function actionModaltest()
    {
        return $this->render('modaltest');
    }

    public function actionVendedores()
    {
        return $this->render('vendedores');
    }

    



    public function actionNuevafactura()
    {
        $clientes = new Clientes;
        $tipofactura = Tipopreciofactura::find()->where(['isDeleted' => '0'])->orderBy(["nombre" => SORT_ASC])->all();
        $tipofacturaArray=array();
        $cont=0;
        foreach ($tipofactura as $key => $value) {
            //if ($cont==0){ $tipofacturaArray[$cont]["value"]="Seleccione / Ninguno"; $tipofacturaArray[$cont]["id"]=0; $cont++; }
            $tipofacturaArray[$cont]["value"]=$value->nombre;
            $tipofacturaArray[$cont]["id"]=$value->id;
            $cont++;
        }
        $formaspago = Formaspago::find()->where(['isDeleted' => '0'])->orderBy(["nombre" => SORT_ASC])->all();
        $formaspagoArray=array();
        $cont=0;
        foreach ($formaspago as $key => $value) {
            $formaspagoArray[$cont]["value"]=$value->nombre;
            $formaspagoArray[$cont]["id"]=$value->id;
            $cont++;
        }
        $vendedores = Vendedores::find()->where(['isDeleted' => '0'])->orderBy(["nombre" => SORT_ASC])->all();
        $vendedoresArray=array();
        $cont=0;
        foreach ($vendedores as $key => $value) {
            $vendedoresArray[$cont]["value"]=$value->nombre;
            $vendedoresArray[$cont]["id"]=$value->id;
            $cont++;
        }
        return $this->render('nuevafactura', [
            'clientes' => $clientes,
            'tiproprecio' => $tipofacturaArray,
            'formaspago' => $formaspagoArray,
            'vendedores' => $vendedoresArray,
        ]);

    }

    public function actionVendedoresreg()
    {

        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "vendedores";
        $model = Vendedores::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->limit(1000)->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;

                //$arrayResp[$key]['departamento'] = $data->iddepartamento0->nombre;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'vervendedor?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarvendedor?id='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                        )
                      );
                      $arrayResp[$key]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
                      //$arrayResp[$key]['acciones'] = '' ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                    //$arrayResp[$key][$id] = '';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                    //$arrayResp[$key][$id] = '';
                } else {
                   //if  ($id == "nombre"){ echo $text;}
                    if (($id == "nombre") || ($id == "ingreso") || ($id == "direccion")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") || ($id == "telefono")  || ($id == "correo")   ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechanac") || ($id == "identificacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionFacturas()
    {
        return $this->render('facturas');
    }

    public function actionEntregas()
    {
        return $this->render('entregas');
    }



    /**
     * Login action.
     *
     * @return string
     */

}
