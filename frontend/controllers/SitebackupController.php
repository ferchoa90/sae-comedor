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
use common\models\Productos;
use common\models\Inventario;
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
        return $this->render('index');
    }

    public function actionBonoestudiantilsierra()
    {
        $model = new Bonoestudiantil();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $postDatos=$_POST["Bonoestudiantil"];
            $model->nombresrep=$postDatos["nombresrep"];
            $model->cedularep=$postDatos["cedularep"];
            $model->provincia=$postDatos["provincia"];
            $model->direccion=$postDatos["direccion"];
            $model->celular=$postDatos["celular"];
            $model->telefono=$postDatos["telefono"];
            $model->correo=$postDatos["correo"];
            $model->nombrehijo=$postDatos["nombrehijo"];
            $model->cedulahijo=$postDatos["cedulahijo"];
            if ($postDatos["gradoac"]==""){ $model->gradoac="Pre-escolar";  }
            if ($postDatos["gradoac2"]==""){ $model->gradoac2="Pre-escolar";  }
            if ($postDatos["gradoac3"]==""){ $model->gradoac3="Pre-escolar";  }
            
            if ($model->save()){
                $bonoestudiantil= Bonoestudiantil::find()->where(["id"=>$model->id])->one();
                //die(var_dump($bonoestudiantil));
                $this->Sendemailbonos($model);
                //die();
                Yii::$app->session->setFlash('success', 'Gracias por escribirnos. Un asesor se contactará lo más pronto posible.');
            }else{
                Yii::$app->session->setFlash('error', 'Error al enviar la información.');
            }

            return $this->refresh();
        } else {
            return $this->render('bonoestudiantilsierra', [
                'model' => $model,
            ]);
        }
       // return $this->render('bonoestudiantilsierra');
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

    

    public function actionMicrocredito()
    {
        $model = new Solicitalo();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $postDatos=$_POST["Solicitalo"];
            $model->nombres=$postDatos["nombres"];
            $model->celular=$postDatos["celular"];
            $model->correo=$postDatos["correo"];
            $model->provincia=$postDatos["provincia"];
            if ($model->save()){
                Yii::$app->session->setFlash('success', 'Gracias por escribirnos. Un asesor se contactará lo más pronto posible.');
            }else{
                Yii::$app->session->setFlash('error', 'Error al enviar la información.');
            }

            return $this->refresh();
        } else {
            return $this->render('microcredito', [
                'model' => $model,
            ]);
        }
    }
 
    public function actionFacturar()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        return $this->render('facturar');
    }

    public function actionProductos()
    {
        return $this->render('productos');
    }

    public function actionCpnsalud()
    {
        $model= Centromedico::find()->where(["estatus"=>"ACTIVO"])->orderBy(["nombre"=>SORT_ASC])->all();
        $tipomedico= Tipomedico::find()->where(["estatus"=>"ACTIVO"])->orderBy(["nombre"=>SORT_ASC])->all();
        $provincia= Provincias::find()->where(["isDeleted"=>"0","estado"=>"ACTIVO"])->orderBy(["nombre"=>SORT_ASC])->all();
        $cont=0;
        foreach ($model as $key => $value) {
            $centros[$cont]["id"]= $value->id;
            $centros[$cont]["idprovincia"]= $value->idprovincia;
            $centros[$cont]["idtipo"]= $value->idtipo;
            $centros[$cont]["nombre"]= str_replace('""'," ",$value->nombre);
            $cont++;
        }
        return $this->render('cpnsalud', [
            'model' => $model,
            'provincia' => $provincia,
            'tipomedico' => $tipomedico,
            'centros' => $centros,
        ]);
    }

    
    public function actionComofunciona()
    {
        return $this->render('comofunciona');
    }

    public function actionPagina($tag)
    {
        //echo 'hola';

        $pagina= Paginas::find()->where(["tag"=>$tag])->one();
        return $this->render('pagina', [
            'model' => $pagina,
        ]);
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

    public function actionSolicitudtarjeta()
    {
        $model = new Solicitudtarjeta();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
            $postDatos=$_POST["Solicitudtarjeta"];
            $model->socio=$postDatos["socio"];
            $model->nombres=$postDatos["nombres"];
            $model->cedula=$postDatos["cedula"];
            $model->ciudad=$postDatos["ciudad"];
            $model->celular=$postDatos["celular"];
            $model->telefonoc=$postDatos["telefonoc"];
            $model->correo=$postDatos["correo"];
            $model->ingresos=$postDatos["ingresos"];
            if ($model->save()){
                Yii::$app->session->setFlash('success', 'Gracias por escribirnos. Un asesor se contactará lo más pronto posible.');
            }else{
                Yii::$app->session->setFlash('error', 'Error al enviar la información.');
            }
                //Yii::$app->session->setFlash('success', 'Gracias por escribirnos. Un asesor se contactará lo más pronto posible.');
            //} else {
            //    Yii::$app->session->setFlash('error', 'Error al enviar la información.');
            //}

            return $this->refresh();
        } else {
            
            return $this->render('solicitudtarjeta', [
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

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionClases()
    {
        $model=  Clases::find()->where(["estatus"=>"ACTIVO"])->andFilterWhere([">","id",1])->all();
        return $this->render('clases', [
            'model' => $model,
        ]);
    }

    public function actionPinturas()
    {
        $model=  Pinturas::find()->where(["estatus"=>"ACTIVO"])->andFilterWhere([">","id",1])->all();
        return $this->render('pinturas', [
            'model' => $model,
        ]);
    }

    public function actionPintura($id)
    {
        $model=  Pinturas::find()->where(["estatus"=>"ACTIVO"])->andFilterWhere(["id"=>$id])->one();
        return $this->render('pintura', [
            'model' => $model,
        ]);
    }

    public function actionClase($id)
    {
        $model=  Clases::find()->where(["estatus"=>"ACTIVO"])->andFilterWhere(["id"=>$id])->one();
        return $this->render('clase', [
            'model' => $model,
        ]);
    }

    public function actionTiendavirtual()
    {
        $sesion= htmlspecialchars($_COOKIE["sesion"]);
        $model=  Carrito::find()->where(["sesion"=>$sesion])->all();
        return $this->render('tiendavirtual', [
            'model' => $model,
        ]);
    }
 

    public function actionProductoindividual()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            //return $this->redirect(URL::base() . "/site/login");
        }
        $nombrep=$_REQUEST["nombrep"];
        $nombrep=explode(" -",$_REQUEST["nombrep"]);
        //$nombrep[0]="167";
        $page = "site";
        $model = Productos::find()->where(['id' => str_replace("-","",$nombrep[0]) ])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        
 

            $modelInventario = Inventario::find()->where(['idproducto' => $model[0]->id])->orderBy(["fechacreacion" => SORT_DESC])->all();
            //var_dump($modelInventario);
            if (!$modelInventario){
                $arrayResp[0]['id'] = $model[0]->id;
                $arrayResp[0]['imagen'] = $model[0]->imagen;
            }
            
            foreach ($modelInventario as $keyI => $dataI) {
            
                   
                    $arrayResp[$keyI]['titulo'] = $model[0]->nombreproducto;
                    $arrayResp[$keyI]['descripcion'] = $dataI->descripcion;
                    $arrayResp[$keyI]['imagen'] = '<img style="width:20px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
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
                    $arrayResp[$keyI]['usuariocreacion'] = $data->usuariocreacion0->username;
                    //$arrayResp[$keyI]['fechacreacion'] = "-";
                    $arrayResp[$keyI]['id'] = $model[0]->id;
                    $arrayResp[$keyI]['imagen'] = $model[0]->imagen;
                 
            
        
                $count++;       
            }

            
        
        
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
                $arrayResp[$key]['nombres'] = $data->nombres;
                $arrayResp[$key]['apellidos'] = $data->apellidos;
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

           //$factura->usuariocreacion=  Yii::$app->user->identity->id;
            $factura->usuariocreacion=  1;
            $factura->tipopago=1;
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

                    $facturaDetalle= new Facturadetalle();
                    $facturaDetalle->idfactura=$factura->id;
                    $facturaDetalle->cantidad=$value["cantidad"];
                    $facturaDetalle->idarticulo=$value["id"];
                    $facturaDetalle->narticulo=$value["nombre"];
                    $facturaDetalle->tarticulo=$value["descripcion"];
                    $facturaDetalle->imagen=$value["imagen"];
                    $facturaDetalle->valoru=$value["valoru"];
                    $facturaDetalle->valort=number_format($value["valoru"]*$value["cantidad"],2);
                    
                    $facturaDetalle->iva=$ivaI;
                    $facturaDetalle->civa=0;
                    $facturaDetalle->estatus='ACTIVO';
                    $facturaDetalle->save();

                    
                    if ($value["id"] != '2687' && $value["id"] != '2688' && $value["id"] != '2689' && $value["id"] != '2690' && $value["id"] != '2691' && $value["id"] != '2692' && $value["id"] != '2693' && $value["id"] != '2694' && $value["id"] != '2695' && $value["id"] != '2696' && $value["id"] != '2697' && $value["id"] != '2698' && $value["id"] != '2699' && $value["id"] != '2700' && $value["id"] != '2701' && $value["id"] != '2702' && $value["id"] != '2703')
                    {
                        $modelInventario = Inventario::find()->where(['idproducto'=>$value["id"]])->one();
                        $modelInventario->stock=$modelInventario->stock- $value["cantidad"];
                        $modelInventario->save();
                    }

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
    


    public function actionFacturaimpresora($id)
    {
        
        $this->layout = 'impresion';
        $factura = Factura::find()->where(['id' => $id])->one();
        return $this->render('facturaimpresora', [
            'factura' => $factura,
        ]);
    }
    
    public function actionAgregaritem()
    {
        if (isset($_POST) and !empty($_POST)) {
            $data = $_POST;
            
            if (Yii::$app->user->isGuest) {
                $idusuario=9999;
            }else{
                $idusuario=Yii::$app->user->identity->id;
            }
            //Model header
            $model= Carrito::find()->where(["idusuario"=>$idusuario,"idproducto"=>$data['idproducto'],"idclase"=>$data['idclase'],"idpintura"=>$data['idpinturas'],"sesion"=>$data['sesion']])->one();
            if ($data['cantidad']>0){
                if ($model)
                {
                    $accion="actualizado";
                    //$existencia->delete();
                    $model->tipocompra = $data['tipocompra'];
                    $model->cantidad = $data['cantidad'];
                }else{
                    $accion="nuevo";
                    $model = new Carrito();
                    $model->idusuario = $idusuario;
                    $model->idproducto = $data['idproducto'];
                    $model->idclase = $data['idclase'];
                    $model->idpintura = $data['idpinturas'];
                    $model->tipocompra = $data['tipocompra'];
                    $model->cantidad = $data['cantidad'];
                    $model->sesion = $data['sesion'];   
                }

                if ($model->save()) {
                    echo json_encode(array("success" => true, "id" => $model->id,"accion" => $accion));
                } else {
                    //var_dump($model->errors);
                    echo json_encode(array("success" => false, "id" => "", "Mensaje" => "Error al insertar el producto."));
                }
            }else{
                if ($model->delete()){
                    $action="eliminado";
                    echo json_encode(array("success" => true, "id" => $model->id,"accion" => $accion));
                }else{
                    echo json_encode(array("success" => false, "id" => "", "Mensaje" => "Error al eliminar el producto."));
                }
            }
            
            
            

        } else {
            return $this->render('nuevo');
        }
    }
 
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionRegistro()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('registro', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
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

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
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

    public function actionConfirm($success, $oid = null)
    {
        if ($oid == null) {
            $oid = array();
            $success = false;
        }
        if ($success && $oid != null) {
            $orden = UserCompras::find()->where(['id' => $oid])->one();
            if ($orden->estatus == 'PAGADO') {
                return $this->render('confirm', ['success' => $success,'model' => $orden]);
            } else {
                //Autorizacion y tokens de pago correctos
                $paymentId = $_GET['paymentId'];
                $payerId = $_GET['PayerID'];
                $token = $_GET['token'];

                //EJECUCION DEL PAGO CON LOS TOKENS
                $paypal = $this->getApiContext();
                $payment = Payment::get($paymentId, $paypal);
                $execute = new PaymentExecution();
                $execute->setPayerId($payerId);
                try {
                    $result = $payment->execute($execute, $paypal);

                    //Actualizar datos de paypal
                    $orden->estatus = 'PAGADO';
                    $orden->tokenpaypal = $token;
                    $orden->paymentid = $paymentId;
                    $orden->payerid = $payerId;
                    $orden->save();

                    //Limpiar Carrito de compras o Session de carrito


                    //Envio de correo
                    //self::Mailcompra($oid);

                    //return pagina de gracias
                    return $this->render('confirm', ['success' => $success, 'model' => $orden]);
                } catch (Exception $e) {
                    //Fallo el pago
                    $orden->tokenpaypal  = $token;
                    $orden->paymentid = $paymentId;
                    $orden->payerid = $payerId;
                    $orden->save();
                    return $this->render('confirm', ['success' => false]);
                }
            }
        } else {
            return $this->render('confirm', ['success' => $success]);
        }
    }

    public function actionProductoskardex()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            //return $this->redirect(URL::base() . "/site/login");
        }
        $page = "inventario";
        $model = Productos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($model as $key => $data) {
                    $arrayResp[] = $data->id.' - '.$data->nombreproducto.' - '.$data->marca0->nombre.' - '.$data->descripcion;
        }
        
        return json_encode($arrayResp);
    }

    public function actionCheckout(){
        //$productos= 
        $subtotal=0;
        $valiva=12;
        $iva=0;
        $domicilio=0;
        $total=0;
        $idusuario=0;

        $usercompras= New UserCompras();
        $usercomprasdetalle= New UserComprasDetalle();

        
        $sesion= htmlspecialchars($_COOKIE["sesion"]);
        $model=  Carrito::find()->where(["sesion"=>$sesion])->all();

        $prodDetail = array();
        $cont=0;
        $items = [];
        $subtotal=0;
        foreach ($model as $k => $productCart) {
            if (!$productCart->idproducto==0) { $item=Cuadros::find()->where(["id"=>$productCart->idproducto])->one();}
            if (!$productCart->idclase==0) { $item=Clases::find()->where(["id"=>$productCart->idclase])->one();}
            if (!$productCart->idpintura==0) { $item=Pinturas::find()->where(["id"=>$productCart->idpintura])->one();}
            
            $idusuario=$productCart->idusuario;
            //echo $productCart->idclase;
            $prodDetail[$cont]['prodId'] = $item->id;
            $prodDetail[$cont]['idproducto'] = $productCart->idproducto;
            $prodDetail[$cont]['idclase'] = $productCart->idclase;
            $prodDetail[$cont]['idpintura'] = $productCart->idpintura;
            $prodDetail[$cont]['prodNombre'] = $item->nombre;
            $prodDetail[$cont]['prodCant'] = $productCart->cantidad;


            //var_dump($productCart->name);
            $aux = [];

            $aux['name'] = $item->nombre;
            $aux['quantity'] = $productCart->cantidad;
            if ($productCart->tipocompra==1){
                $prodDetail[$cont]['prodPrice'] =$item->valor;
            }else{
                $prodDetail[$cont]['prodPrice'] =  $item->reseva;
            }
            
            $aux['price'] = $prodDetail[$cont]['prodPrice'];
            $aux['total'] = $prodDetail[$cont]['prodPrice'] * $productCart->cantidad;
            $subtotal += $prodDetail[$cont]['prodPrice'] * $productCart->cantidad;
            $return[$productCart->id] = $aux;
            $total += $prodDetail[$cont]['prodPrice'] * $productCart->cantidad;
            $item = new Item();
            $item->setName($aux['name'])
                ->setCurrency('USD')
                ->setQuantity($aux['quantity'])
                ->setPrice($aux['price']);
            $items[] = $item;
            $cont++;
        }

        //die(var_dump($items));
        $iva=number_format(($subtotal*1.12)-$subtotal,2);
        $total=number_format($subtotal+$iva,2);
        //die(var_dump($total));
        /*$cart = \Yii::$app->cart;*/


        $order = new UserCompras;
        /*$order->correo = $_POST['correo'];*/
        $order->iduser = $idusuario;
        $order->descuento = 0;
        $order->subtotal = $subtotal;
        $order->iva = $iva;
        $order->total = $total;
        $order->estatus = 'PENDIENTE';
        if (!$order->save())
        {
           die(var_dump($order->errors));
        }else{
            //var_dump($order->errors);
            //create Order Description
            foreach ($prodDetail as $item) {
                $idproducto= $item['idproducto'] == 0 ? 1 : $item['idproducto'] ;
                $idclase= $item['idclase'] == 0 ? 1 : $item['idclase'] ;
                $idpintura= $item['idpintura'] == 0 ? 1 : $item['idpintura'] ;
                $orderDetalle = new UserComprasDetalle();
                $orderDetalle->idcompra = $order->id;
                $orderDetalle->idcuadro = $idproducto;
                $orderDetalle->idarticulo = $idclase;
                $orderDetalle->idpintura = $idpintura;
                $orderDetalle->descripcion = $item['prodNombre'];
                $orderDetalle->cantidad = $item['prodCant'];
                $orderDetalle->valorunitario = $item['prodPrice'];
                
                if (!$orderDetalle->save())
                {
                   //die(var_dump($orderDetalle->errors));
                }
            }
        }

        

        
            
        $formattedAmount = number_format($amount,2);
                $payer = new Payer();
                $payer->setPaymentMethod('paypal');
      
               
                
        $itemList = new \PayPal\Api\Itemlist();
        $itemList->setItems($items);
      
                  $amountDetails = new Details();
                  $amountDetails->setSubtotal($subtotal);
                  $amountDetails->setTax($iva);
                  //$amountDetails->setTotal('35.84');
                // $amountDetails->setShipping('0.00');
        
                 $amount = new \PayPal\Api\Amount();
                $amount->setCurrency('USD');
                //$amount->setTotal(number_format((2*$formattedAmount),2));
                $amount->setTotal(number_format($total,2));
                $amount->setDetails($amountDetails);
        
                $transaction = new \PayPal\Api\Transaction();
                $transaction->setDescription("By Mon Atelier");
                $transaction->setItemList($itemList);
                $transaction->setAmount($amount);
        
                //$baseUrl = getBaseUrl();
                $baseUrl = Url::base(true);
                $redirectUrls = new \PayPal\Api\RedirectUrls();
                //$redirectUrls->setReturn_url("https://devtools-paypal.com/guide/pay_paypal/php?success=true");
                //$redirectUrls->setCancel_url("https://devtools-paypal.com/guide/pay_paypal/php?cancel=true");
                $redirectUrls->setReturnUrl("$baseUrl/site/confirm?success=true&oid=" . $order->id)
                //->setCancelUrl("$baseUrl/site/confirm?success=false");
                ->setCancelUrl("$baseUrl/site/checkout");

                $apiContext = $this->getApiContext();
                $payment = new \PayPal\Api\Payment();
                $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));
        
                try {
                    $payment->create($apiContext);
                } catch (Exception $ex) {
                    print_r($ex);
                    exit(1);
                }
    
                /* -- Link aprobado -- */
                $approvalUrl = $payment->getApprovalLink();
    
                //return $approvalUrl;
                $this->redirect($approvalUrl);
        
               /* return $payment->create($this->apiContext);*/
    }

    public function actionMakePayment(){
         // Setup order information array 
        $params = [
            'order'=>[
                'description'=>'Payment description',
                'subtotal'=>44,
                'shippingCost'=>0,
                'total'=>44,
                'currency'=>'USD',
            ]
        ];
      // In case of payment success this will return the payment object that contains all information about the order
      // In case of failure it will return Null
      return  Yii::$app->PayPalRestApi->processPayment($params);

    }

    private function getApiContext()
    {
        /* paypal */
        $estate = 'DEV';
 

        if ($estate == 'DEV') {
            /* Pruebas */
            $clientId = 'AXRGBb_0u8U0EDZnRr-r63_iRtlyiAsj3x9ERzfYEtf9k1MXGI656THWf6H9Tmct_kuFAwrlFJqyhdTq';
            $clientSecret = 'EAjWoJBCUx77r4DIaw_vwRjzOEUm1GpeJEaebYO0OzFCi3uJmiXW_SAXLPqBLWYczF83Lm7fAAdYrQmB';
            /* Fin Pruebas */

            $apiContext = new ApiContext(
                new OAuthTokenCredential(
                    $clientId,
                    $clientSecret
                )
            );

            //Sandbox
            $apiContext->setConfig(
                array(
                    'mode' => 'sandbox',
                    'log.LogEnabled' => true,
                    'log.FileName' => '../PayPal.log',
                    'log.LogLevel' => 'DEBUG', // PLEASE USE `FINE` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                    'validation.level' => 'log',
                    'cache.enabled' => true,
                    'http.CURLOPT_CONNECTTIMEOUT' => 0,
                    // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
                )
            );
            
            $apiContext->setConfig(array('http.CURLOPT_SSLVERSION' => CURL_SSLVERSION_TLSv1));

        } elseif ($estate == 'PRD') {
            /* Credenciales Producción */
            $clientId = 'AS4PtHoJPUWpyp0HttA39eCKf7XcJh-OZggiY0Pp50B9J9uQd1JiteVZDWh7CJ5KO9Q_5fAyWLOIIFED';
            $clientSecret = 'EF2Lqoi5vkAsvErRFmoFMl2OSA9oJ2YOFkw56kTuztyP-aOikcgNa5Mlxtdfl8b7_h3oKLwpxulh-22c';

            /* Fin Credenciales Producción */

            $apiContext = new ApiContext(
                new OAuthTokenCredential(
                    $clientId,
                    $clientSecret
                )
            );

            //LIVE
            $apiContext->setConfig(
                array(
                    'mode' => 'live',
                    'log.LogEnabled' => true,
                    'log.FileName' => '../PayPal.log',
                    'log.LogLevel' => 'FINE', // PLEASE USE `FINE` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                    'validation.level' => 'log',
                    'cache.enabled' => true,
                    'http.CURLOPT_CONNECTTIMEOUT' => 0,
                    // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
                )
            );

            $apiContext->setConfig(array('http.CURLOPT_SSLVERSION' => CURL_SSLVERSION_TLSv1));
        } else {
            return false;
        }

        return $apiContext;
    }

}
