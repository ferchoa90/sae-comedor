<?php

namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Contactenos;
use common\models\Mesas;
use common\models\Productos;
use common\models\Inventario;
use common\models\Ordenes;
use common\models\Ordenesdetalle;
use common\models\Factura;
use common\models\Facturadetalle;
use common\models\Tipodocumento;
use common\models\Tipopago;
use common\models\Clientes;
use common\models\Paginas;
use frontend\models\Provincias;
use common\models\Carrito;
use common\models\Clases;
use common\models\Pinturas;
use common\models\Cuadros;
use common\models\UserCompras;
use common\models\UserComprasDetalle;
use backend\components\Facturacion_tipoident;
use backend\components\Facturacion_cliente;
use backend\components\Sistema_genero;
use backend\components\Botones;
use frontend\components\Facturacion_ordenar;
use frontend\components\Facturacion_mesas;


/*
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
*/


/**

 * Site controller

 */

class SiteController extends Controller

{

    /**

     * {@inheritdoc}

     */

    public function behaviors()

    {

        return [

            'access' => [

                'class' => AccessControl::className(),

                'only' => ['logout', 'signup'],

                'rules' => [

                    [

                        'actions' => ['signup'],

                        'allow' => true,

                        'roles' => ['?'],

                    ],

                    [

                        'actions' => ['logout'],

                        'allow' => true,

                        'roles' => ['@'],

                    ],

                ],

            ],

            'verbs' => [

                'class' => VerbFilter::className(),

                'actions' => [

                  //  'logout' => ['post'],

                ],

            ],

        ];

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

            'captcha' => [

                'class' => 'yii\captcha\CaptchaAction',

                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,

            ],

        ];

    }



    /**

     * Displays homepage.

     *

     * @return mixed

     */

    public function actionIndex()

    {

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        return $this->render('index');

    }

    public function actionEliminarfactura()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        return $this->render('eliminarfactura');
    }

    public function actionOrdenes()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        return $this->render('ordenes');
    }

    public function actionCierredecaja()

    {

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        return $this->render('cierredecaja');

    }



    public function actionBuzon()

    {

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        return $this->render('buzon');

    }



    public function actionReportes()

    {

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        return $this->render('reportes');

    }



    public function actionNotificaciones()

    {

        if (Yii::$app->user->isGuest) {

            return $this->redirect(URL::base() . "/site/login");

        }

        return $this->render('notificaciones');

    }



    public function actionEstadisticas()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        return $this->render('estadisticas');
    }

    protected function Sendemailbonos($bonos)

    {
        set_time_limit(0);
        $email = Yii::$app->mailer->compose('layouts/mailbonos', [

            'model' => $bonos,

        ])->setFrom('cpn_paginaweb@cpn.fin.ec')
            ->setTo("marlene.espinoza@cpn.fin.ec")
            ->setCc("mario.aguilar@fcbandfire.com")
            //->setTo("mario.aguilar@fcbandfire.com")
            ->setSubject("Nueva solicitud de Bono Estudiantil #" . $bonos->id)
            ->send();
    }

    public function actionFacturasreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "eliminarfactura";
        $model = Factura::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        //var_dump($model);
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                //($arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                //$arrayResp[$key]['departamento'] = $data->iddepartamento0->nombre;
                if ($id == "id") {
                    $botonC=$botones->getBotongridArray(
                        array(
                         // array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'verfactura?='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'pequeño',  'adicional'=>''),
                         // array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarfactura?='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'pequeño', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'pequeño', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = $botonC ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    //$arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    //$arrayResp[$key][$id] = '<small class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "total")|| ($id == "ruc") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }


    public function actionOrdenesreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "eliminarfactura";
        $model = Ordenes::find()->where(['isDeleted' => '0','facturada' => '0',"ordencerrada"=>1])->orderBy(["fechacreacion" => SORT_ASC])->all();
        //var_dump($model);
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $arrayResp[$key]['mesa'] = $data->idmesa0->nombre;
                if ($id == "id") {
                    $arrayResp[$key]['num'] = $text;
                    $detalle= Ordenesdetalle::find()->where(["idorden"=>$text])->all();
                    $valortotal=0;
                    foreach ($detalle as $keyD => $value) {
                        $valortotal+=($value->cantidadfinal*$value->precio);
                    }
                    $arrayResp[$key]['total'] = number_format($valortotal,2);

                    $botonC=$botones->getBotongridArray(
                        array(
                          array('tipo'=>'link','nombre'=>'facturar', 'id' => 'facturar', 'titulo'=>'', 'link'=>'generarfactura?id='.$text, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verde', 'icono'=>'pdf','tamanio'=>'pequeño',  'adicional'=>''),
                         // array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'editarfactura?='.$text, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'pequeño', 'adicional'=>''),
                          array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$text. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'pequeño', 'adicional'=>''),
                        )
                      );
                    $arrayResp[$key]['acciones'] = $botonC ;
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    //$arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    //$arrayResp[$key][$id] = '<small class="badge badge-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "usuariocreacion")|| ($id == "ruc") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }

    public function actionGenerarfactura($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $orden=Ordenes::find()->where(["id"=>$id])->one();
        $ordendetalle=Ordenesdetalle::find()->where(["idorden"=>$id])->all();

        $tipoident = new Facturacion_tipoident();
        $tipoident = $tipoident->getSelect();
        $genero = new Sistema_genero();
        $genero = $genero->getSelect();
        $clientes = new Clientes;

        return $this->render('generarfactura', [
            'tipoidentificacion' => $tipoident,
            'genero' => $genero,
            'clientes' => $clientes,
            'orden' => $orden,
            'ordendetalle' => $ordendetalle,
            'idorden' => $id,
        ]);

    }

    public function actionFacturar()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $tipoident = new Facturacion_tipoident();
        $tipoident = $tipoident->getSelect();
        $genero = new Sistema_genero();
        $genero = $genero->getSelect();
        $clientes = new Clientes;

        return $this->render('facturar', [
            'tipoidentificacion' => $tipoident,
            'genero' => $genero,
            'clientes' => $clientes,
        ]);

    }

    public function actionFacturarmesas()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $tipoident = new Facturacion_tipoident();
        $tipoident = $tipoident->getSelect();
        $genero = new Sistema_genero();
        $genero = $genero->getSelect();
        $clientes = new Clientes;
        $mesasA1 = Mesas::find()->where(['seccion' => "A"])->orderBy(["orden" => SORT_ASC])->limit(3,4)->all();
        $mesasA2 = Mesas::find()->where(['seccion' => "A"])->orderBy(["orden" => SORT_DESC])->limit(4,7)->all();
        $mesasB = Mesas::find()->where(['seccion' => "B"])->orderBy(["orden" => SORT_ASC])->all();

        return $this->render('facturarmesas', [
            'tipoidentificacion' => $tipoident,
            'genero' => $genero,
            'clientes' => $clientes,
            'mesasa1' => $mesasA1,
            'mesasa2' => $mesasA2,
            'mesasb' => $mesasB,
        ]);

    }

    public function actionProductos()
    {
        return $this->render('productos');
    }


    public function actionBusqueda()
    {
        $s=$_GET["s"];
        $query = "SELECT * FROM `subproducto` where `nombre` LIKE '%".$s."%' ";
        $result = Subproducto::findBySql($query)->all();
        //var_dump($result);
        return $this->render('busqueda', [
            'result' => $result,
        ]);
    }

    public function actionContactenos()
    {
        $model = new Contactenos();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $postDatos=$_POST["Contactenos"];
            $model->cedula=$postDatos["cedula"];
            $model->nombres=$postDatos["nombres"];
            $model->ciudad=$postDatos["ciudad"];
            $model->agencia=$postDatos["agencia"];
            $model->direccion=$postDatos["direccion"];
            $model->celular=$postDatos["celular"];
            $model->telefonoc=$postDatos["telefonoc"];
            $model->correo=$postDatos["correo"];
            $model->requerimiento=$postDatos["requerimiento"];
            $model->detalle=$postDatos["detalle"];
            $model->descripcion=$postDatos["descripcion"];
            $model->peticion=$postDatos["peticion"];
            $model->archivo="-";
            $model->verifyCode="OK";
            $model->acepto=1;
            $model->documento="-";
            if ($model->save()){
                Yii::$app->session->setFlash('success', 'Gracias por escribirnos. Un asesor se contactará lo más pronto posible.');
            }else{
                Yii::$app->session->setFlash('error', 'Error al enviar la información.');
            }
            return $this->refresh();
        } else {
            return $this->render('contactenos', [
                'model' => $model,
            ]);
        }
    }





    /**

     * Logs in a user.

     *

     * @return mixed

     */

    public function actionLogin()
    {
        $this->layout = 'mainlogin';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);

        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
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
        //die(var_dump($model));
            //$modelInventario = Productos::find()->where(['id' => str_replace("-","",$nombrep[0]) ])->orderBy(["fechacreacion" => SORT_DESC])->all();


            $model =  Inventario::find()->where(['id' =>  str_replace("-","",$nombrep[0])])->orderBy(["fechacreacion" => SORT_DESC])->all();
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

    public function actionProductoid()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $id=$_REQUEST["id"];
        $orden=Ordenes::find()->where(["id"=>$id])->one();
        $ordendetalle=Ordenesdetalle::find()->where(["idorden"=>$id])->all();
        $page = "site";
               $arrayResp = array();
        $count = 1;
        //die(var_dump($model));
            //$modelInventario = Productos::find()->where(['id' => str_replace("-","",$nombrep[0]) ])->orderBy(["fechacreacion" => SORT_DESC])->all();
            $cont=0;

           foreach ($ordendetalle as $key => $valuedet) {
            $model =  Inventario::find()->where(['idproducto' =>  $valuedet->idproducto])->orderBy(["fechacreacion" => SORT_DESC])->all();

            /* if (!$modelInventario){
                 $arrayResp[0]['id'] = $model->id;
                 $arrayResp[0]['imagen'] = $model>imagen;
             }*/

             foreach ($model as $keyI => $dataI) {
                 $arrayResp[$cont]['cantidad'] = $valuedet->cantidadfinal;
                 $arrayResp[$cont]['titulo'] = $dataI->producto->nombreproducto;
                 $arrayResp[$cont]['descripcion'] = $dataI->producto->descripcion;
                 $arrayResp[$cont]['color'] = $dataI->color->nombre;
                 $arrayResp[$cont]['clasificacion'] = $dataI->clasificacion->nombre;
                 $arrayResp[$cont]['imagen'] = '<img style="width:20px;" src="/frontend/web/images/articulos/'.$dataI->producto->imagen.'"/>';
                 //$arrayResp[$cont]['imagen'] = '-';
                 $arrayResp[$cont]['stock'] = $dataI->stock;
                 $arrayResp[$cont]['cantidadini'] = $dataI->cantidadini;
                 $arrayResp[$cont]['cantidadcaja'] = $dataI->cantidadcaja;
                 $arrayResp[$cont]['precioint'] = $dataI->precioint;
                 $arrayResp[$cont]['preciov1'] = $dataI->preciov1;
                 $arrayResp[$cont]['preciov2'] = $dataI->preciov2;
                 $arrayResp[$cont]['preciovp'] = $dataI->preciovp;
                 $arrayResp[$cont]['codigobarras'] = $dataI->codigobarras;
                 $arrayResp[$cont]['codigocaja'] = $dataI->codigocaja;
                 $arrayResp[$cont]['usuariocreacion'] = $dataI->producto->usuariocreacion0->username;
                 //$arrayResp[$cont]['fechacreacion'] = "-";
                 $arrayResp[$cont]['id'] = $dataI->id;
                 $arrayResp[$cont]['imagen'] = $dataI->producto->imagen;
                 $cont++;
                 $count++;
             }
             $cont++;
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
                $arrayResp[$key]['razonsocial'] = $data->razonsocial;
                $arrayResp[$key]['direccion'] = $data->direccion;
                $arrayResp[$key]['telefono'] = $data->telefono;
                $arrayResp[$key]['correo'] = $data->correo;
                $arrayResp[$key]['tipo'] = $data->tipo;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $count++;
            }

        return json_encode($arrayResp);

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
        $count = 1;
        foreach ($modelI as $key => $data) {
                    $arrayResp[] = $data->id.' - '.$data->producto->nombreproducto.' '.$data->producto->descripcion;
        }
       //  die(var_dump($arrayResp));
        return json_encode($arrayResp);
    }


    public function actionNuevocliente()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        if (isset($_POST) and !empty($_POST)) {
            $data = $_POST;
            //echo $data["cliente"];
            $cliente=Clientes::find()->Where(["cedula" => $data['cedula']])->one();
            //var_dump($factant);
            if (!$cliente)
            {
                $cliente= new Clientes();
                $cliente->cedula=$data['cedula'];
                $cliente->nombres=$data['nombres'];
                $cliente->direccion=$data['direccion'];
                $cliente->telefono=$data['telefono'];
                $cliente->correo=$data['correo'];
                $cliente->usuariocreacion=  Yii::$app->user->identity->id;
                $cliente->estatus='ACTIVO';
                if ($cliente->save()){
                        $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $cliente->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el cliente.","resp" => false, "id" => "");
                }
            }else{
                $return=array("success"=>false,"existe"=>true,"Mensaje"=>"OK","resp" => true, "id" => "");
            }
             //var_dump($factura->errors);
            //var_dump($data["data"][0]);
            return json_encode($return);
        }
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
            $factura->nombre=$cliente[0]->razonsocial;
            $factura->ruc=$cliente[0]->cedula;
            $factura->usuariocreacion=  Yii::$app->user->identity->id;
            //$factura->usuariocreacion=  1;
            $factura->tipopago=$data["tipopago"];
            $factura->tipodoc=1;
            $factura->facturae='PENDIENTE';
            $factura->estatus='ACTIVO';
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
           // die(var_dump($factura));
            if ($factura->save()){
                foreach ($data["data"] as $key => $value) {
                    //$value["id"];
                    $subtotalI= number_format($value["valoru"]/1.12,2);
                    $ivaI= number_format($value["valoru"]-$subtotalI,2);
                    $modelI =  Productos::find()->where(['id' => $value["id"]])->one();
                    $descripcion=$value["descripcion"];
                    if ($value["color"]!="N/A"){ $descripcion.=' '.$value["color"]; }
                    if ($value["clasificacion"]!="N/A"){ $descripcion.=' '.$value["clasificacion"]; }
                    $facturaDetalle= new Facturadetalle();
                    $facturaDetalle->idfactura=$factura->id;
                    $facturaDetalle->cantidad=$value["cantidad"];
                    $facturaDetalle->idarticulo=1;
                    $facturaDetalle->idinventario=$value["id"];
                    $facturaDetalle->narticulo=$value["nombre"];
                    $facturaDetalle->tarticulo=$descripcion.'.';
                    //$facturaDetalle->tarticulo=$value["descripcion"];
                    $facturaDetalle->imagen=$value["imagen"];
                    $facturaDetalle->valoru=$value["valoru"];
                    $facturaDetalle->valort=number_format($value["valoru"]*$value["cantidad"],2);
                    $facturaDetalle->iva=$ivaI;
                    $facturaDetalle->civa=0;
                    $facturaDetalle->estatus='ACTIVO';
                    $facturaDetalle->save();
                     //die(var_dump($facturaDetalle));
                        //$modelI->stock=$modelInventario->stock- $value["cantidad"];
                        //$modelI->save();
                    //var_dump($facturaDetalle->errors);
                }
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $factura->id);

            }else{
               // var_dump($factura->errors);
                $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el banner.","resp" => false, "id" => "");
            }
             //var_dump($factura->errors);
            //var_dump($data["data"][0]);
            return json_encode($return);
        }
    }

    public function actionIngresarfacturapedido()
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
            $factura->nombre=$cliente[0]->razonsocial;
            $factura->ruc=$cliente[0]->cedula;
            $factura->usuariocreacion=  Yii::$app->user->identity->id;
            //$factura->usuariocreacion=  1;
            $factura->tipopago=$data["tipopago"];
            $factura->tipodoc=1;
            $factura->facturae='PENDIENTE';
            $factura->estatus='ACTIVO';
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
            $factura->idorden=$data["idorden"];
           // die(var_dump($factura));
            if ($factura->save()){

                $pedido=  Ordenes::find()->where(['id' => $data["idorden"]])->one();
                $pedido->facturada=1;
                $pedido->save();

                foreach ($data["data"] as $key => $value) {
                    //$value["id"];
                    $subtotalI= number_format($value["valoru"]/1.12,2);
                    $ivaI= number_format($value["valoru"]-$subtotalI,2);
                    $modelI =  Productos::find()->where(['id' => $value["id"]])->one();
                    $descripcion=$value["descripcion"];
                    if ($value["color"]!="N/A"){ $descripcion.=' '.$value["color"]; }
                    if ($value["clasificacion"]!="N/A"){ $descripcion.=' '.$value["clasificacion"]; }
                    $facturaDetalle= new Facturadetalle();
                    $facturaDetalle->idfactura=$factura->id;
                    $facturaDetalle->cantidad=$value["cantidad"];
                    $facturaDetalle->idarticulo=1;
                    $facturaDetalle->idinventario=$value["id"];
                    $facturaDetalle->narticulo=$value["nombre"];
                    $facturaDetalle->tarticulo=$descripcion.'.';
                    //$facturaDetalle->tarticulo=$value["descripcion"];
                    $facturaDetalle->imagen=$value["imagen"];
                    $facturaDetalle->valoru=$value["valoru"];
                    $facturaDetalle->valort=number_format($value["valoru"]*$value["cantidad"],2);
                    $facturaDetalle->iva=$ivaI;
                    $facturaDetalle->civa=0;
                    $facturaDetalle->estatus='ACTIVO';
                    $facturaDetalle->save();
                     //die(var_dump($facturaDetalle));
                        //$modelI->stock=$modelInventario->stock- $value["cantidad"];
                        //$modelI->save();
                    //var_dump($facturaDetalle->errors);
                }
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $factura->id);

            }else{
               // var_dump($factura->errors);
                $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el banner.","resp" => false, "id" => "");
            }
             //var_dump($factura->errors);
            //var_dump($data["data"][0]);
            return json_encode($return);
        }
    }


    public function actionIngresarorden()
    {

         if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        $data= new Facturacion_ordenar;
        $data= $data->Nuevo($_POST);
        if ($data["success"]){
            $estatus= new Facturacion_mesas;
            $estatus= $estatus->setStatus($_POST["mesa"],"OCUPADA");
        }
        $response=$data;
        return json_encode($response);
    }

    public function actionActualizarorden()
    {

         if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        $data= new Facturacion_ordenar;
        $data= $data->Editar($_POST);

        if ($data["success"]){
            $estatus= new Facturacion_mesas;
            $estatus= $estatus->setStatus($_POST["mesa"],"OCUPADA");
        }
        $response=$data;
        return json_encode($response);
    }


    public function actionCerrarorden()
    {

         if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        $data= new Facturacion_ordenar;
        $data= $data->cerrarorden($_POST);

        if ($data["success"]){
            $estatus= new Facturacion_mesas;
            $estatus= $estatus->setStatus($_POST["mesa"],"LIBRE");
        }
        $response=$data;

        return json_encode($response);
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

    function actionEliminarfacturaeliminar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $model = Factura::findOne($id);
        $model->isDeleted = 1;

        if ($model->save())
        {
            return true;
        }else{
            return false;
        }
    }


    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }


    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }



        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);

    }

}
