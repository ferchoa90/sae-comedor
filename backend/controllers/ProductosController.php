<?php
namespace backend\controllers;
use backend\components\Globaldata;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\db\Query;
use common\models\Inventario;
use common\models\Marca;
use common\models\Presentacion;
use common\models\Proveedores;
use common\models\Productos;
use common\models\Provincias;
use common\models\Tipoproducto;
use backend\models\User;
use backend\components\Botones;
use backend\components\Sistema_proveedores;
use backend\components\Inventario_tipoproducto;
use backend\components\Inventario_marca;
use backend\components\Inventario_productos;


class ProductosController extends Controller
{
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
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

   public function actionInteracciones()
    {
        return $this->render('interacciones');
    }
 
   
    public function actionProductosreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "productos";
        $model = Productos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        $botones= new Botones;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                //$arrayResp[$key]['num'] = $count;
                $arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                $arrayResp[$key]['proveedor'] = $data->proveedor->nombre;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $view='producto';
                if ($id == "id") {
                    $arrayResp[$key]['num'] = $text;

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
                    if (($id == "nombreproducto") || ($id == "descripcion") || ($id == "idproveedor") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "imagen") || ($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        
        return json_encode($arrayResp);
    }

    public function actionProveedorregistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "productos";
        $model = Proveedores::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        $botones= new Botones;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                //$arrayResp[$key]['num'] = $count;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $arrayResp[$key]['tipo'] = "";
                $view='presentacion';
                if ($id == "id") {
                    $arrayResp[$key]['num'] = $text;

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
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {   
                    if (($id == "nombre")  || ($id == "ruc") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "contacto") || ($id == "telefono") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "cargocontacto") || ($id == "descripcion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "provincia") || ($id == "ciudad") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "direccion") || ($id == "correo") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "persona") || ($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        
        return json_encode($arrayResp);
    }

    public function actionMarcasregistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "productos";
        $model = Marca::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                //$arrayResp[$key]['num'] = $count;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                if ($id == "id") {
                    $arrayResp[$key]['num'] = $text;

                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/verproducto?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre")  || ($id == "descripcion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "persona") || ($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        
        return json_encode($arrayResp);
    }

    public function actionPresentacionesregistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "presentacion";
        $model = Presentacion::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        $botones= new Botones;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                //$arrayResp[$key]['num'] = $count;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                $view='presentacion';
                if ($id == "id") {
                    $arrayResp[$key]['num'] = $text;

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
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {   
                    if (($id == "nombre")  || ($id == "descripcion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "persona") || ($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        
        return json_encode($arrayResp);
    }

    public function actionTiposregistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "productos";
        $model = Tipoproducto::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                //$arrayResp[$key]['num'] = $count;
                //$arrayResp[$key]['imagen'] = '<img style="width:30px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                //$arrayResp[$key]['proveedor'] = $data->proveedor->nombre;
                $arrayResp[$key]['usuariocreacion'] = $data->usuariocreacion0->username;
                if ($id == "id") {
                    $arrayResp[$key]['num'] = $text;

                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/verproducto?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre")  || ($id == "descripcion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "persona") || ($id == "usuariocreacion") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        
        return json_encode($arrayResp);
    }


     public function actionEditarproducto($id)

    {
        
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        $model = Productos::find()->where(["id"=>$id])->one();
        $proveedores = new Sistema_proveedores();
        $proveedores = $proveedores->getSelect();
        $tipoproducto = new Inventario_tipoproducto();
        $tipoproducto = $tipoproducto->getSelect();
        $marca = new Inventario_marca();
        $marca = $marca->getSelect();
        
            return $this->render('editarproducto', [
                'marca' => $marca,
                'proveedores' => $proveedores,
                'tipoproducto' => $tipoproducto,
                'model' => $model,
            ]);
    }
    /**

     * Displays a single QuinielaHead model.

     * @param integer $id

     * @return mixed

     */

    public function actionVerproducto($id)

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        return $this->render('verproducto', [
            'model' => $this->findModel($id),
            'modelTeam' => Productos::find()->all(),
        ]);

    }

    public function actionVertipo($id)

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        return $this->render('vertipo', [
            'model' =>  Tipoproducto::find()->where(['id'=>$id])->one()
        ]);

    }

    public function actionVermarca($id)

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        return $this->render('vermarca', [
            'model' =>  Marca::find()->where(['id'=>$id])->one()
          
        ]);

    }

    public function actionVerpresentacion($id)

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        return $this->render('verpresentacion', [
            'model' =>  Presentacion::find()->where(['id'=>$id])->one()
          
        ]);

    }


    public function actionVerproveedor($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        return $this->render('verproveedor', [
            'model' =>  Proveedores::find()->where(['id'=>$id])->one()
          
        ]);

    }
    /**

     * Creates a new QuinielaHead model.

     * If creation is successful, the browser will be redirected to the 'view' page.

     * @return mixed

     */
 
    public function actionNuevo()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        $model = new Productos();
        $marca = Marca::find()->where(['isDeleted'=>0])->orderBy(["nombre" => SORT_ASC])->all();
        $proveedores = new Sistema_proveedores();
        $proveedores = $proveedores->getSelect();
        $tipoproducto = new Inventario_tipoproducto();
        $tipoproducto = $tipoproducto->getSelect();
        $marca = new Inventario_marca();
        $marca = $marca->getSelect();
        
            return $this->render('nuevo', [
                'marca' => $marca,
                'proveedores' => $proveedores,
                'tipoproducto' => $tipoproducto,
                'model' => $model,
            ]);
    }

    public function actionFormnuevoproducto()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        //die(var_dump($_FILES));
        $data= new Inventario_productos;
        $data= $data->Nuevo($_POST,$_FILES);
        $response=$data;
        return json_encode($response);

    }

    public function actionFormeditarproducto()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        //die(var_dump($_FILES));
        $data= new Inventario_productos;
        $data= $data->Editar($_POST,$_FILES);
        $response=$data;
        return json_encode($response);

    }

    public function actionMarcanueva()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        $model = new Marca();
        $marca = Marca::find()->where(['isDeleted'=>0])->all();
        if (isset($_POST) and !empty($_POST)) {
            
                //echo 'OK';
                $data = $_POST;
                //Model header
                $model = new Marca();
                $model->nombre = $data['nombre'];
                $model->descripcion = $data['descripcion'].'.';
                $model->usuariocreacion = Yii::$app->user->identity->id;
                $model->isDeleted = 0;
                $model->estatus =  $data['estado'];
                $saveModel=$model->save();
                //var_dump($_POST);
                
                $flagHeader = true;
                if ($saveModel) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el producto.","resp" => false, "id" => "");
                }
            return json_encode($return);
        } else {
            return $this->render('marcanueva', [
                'model' => $model,
            ]);
        }
    }

    public function actionPresentacionnueva()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        $model = new Presentacion();
        $marca = Presentacion::find()->where(['isDeleted'=>0])->all();
        if (isset($_POST) and !empty($_POST)) {
            
                //echo 'OK';
                $data = $_POST;
                //Model header
                $model = new Presentacion();
                $model->nombre = $data['nombre'];
                $model->descripcion = $data['descripcion'].'.';
                $model->usuariocreacion = Yii::$app->user->identity->id;
                $model->isDeleted = 0;
                $model->estatus =  $data['estado'];
                $saveModel=$model->save();
                //var_dump($_POST);
                $flagHeader = true;
                if ($saveModel) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el producto.","resp" => false, "id" => "");
                }
            return json_encode($return);
        } else {
            return $this->render('presentacionnueva', [
                'model' => $model,
            ]);
        }
    }

    public function actionTiposnuevo()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        $model = new Tipoproducto();
        $marca = Tipoproducto::find()->where(['isDeleted'=>0])->all();
        if (isset($_POST) and !empty($_POST)) {
            
                //echo 'OK';
                $data = $_POST;
                //Model header
                $model = new Tipoproducto();
                $model->nombre = $data['nombre'];
                $model->descripcion = $data['descripcion'].'.';
                $model->usuariocreacion = Yii::$app->user->identity->id;
                $model->isDeleted = 0;
                $model->estatus =  $data['estado'];
                $saveModel=$model->save();
                //var_dump($_POST);
                $flagHeader = true;
                if ($saveModel) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el producto.","resp" => false, "id" => "");
                }
            return json_encode($return);
        } else {
            return $this->render('tiposnuevo', [
                'model' => $model,
            ]);
        }
    }

    public function actionProveedornuevo()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        $model = new Proveedores();
        $marca = Proveedores::find()->where(['isDeleted'=>0])->all();
        $provincia=  Provincias::find()->where(['estado' => "ACTIVO"])->all();
        if (isset($_POST) and !empty($_POST)) {
            
                //echo 'OK';
                $data = $_POST;
                //Model header
                $model = new Proveedores();
                $model->nombre = $data['nombre'];
                $model->descripcion = $data['descripcion'].'.';
                $model->ruc = $data['ruc'];
                $model->contacto = $data['contacto'];
                $model->cargocontacto = $data['cargo'];
                $model->telefono = $data['telefono'];
                $model->provincia = $data['provincia'];
                $model->ciudad = $data['ciudad'];
                $model->direccion = $data['direccion'];
                $model->correo = $data['correo'];
                $model->persona =  $data['persona'];
                $model->credito = 0;
                $model->usuariocreacion = Yii::$app->user->identity->id;
                $model->isDeleted = 0;
                $model->estatus =  $data['estado'];
                $saveModel=$model->save();
                //var_dump($_POST);
                $flagHeader = true;
                if ($saveModel) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    var_dump($model->errors);
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el proveedor.","resp" => false, "id" => "");
                }
            return json_encode($return);
        } else {
            return $this->render('proveedornuevo', [
                'provincia' => $provincia,
                'model' => $model,
            ]);
        }
    }

    public function actionCategorias()
    {
        return $this->render('categorias');
    }

    public function actionProveedor()
    {
        return $this->render('proveedor');
    }

    public function actionMarcas()
    {
        return $this->render('marcas');
    }

    public function actionPresentaciones()
    {
        return $this->render('presentaciones');
    }

    public function actionTipos()
    {
        return $this->render('tipos');
    }



    /**

     * Updates an existing QuinielaHead model.

     * If update is successful, the browser will be redirected to the 'view' page.

     * @param integer $id

     * @return mixed

     */

    public function actionActualizar($id)

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $model = new Productos();
        if (isset($_POST) and !empty($_POST)) {
            $model = $this->findModel($id);
            //$uploadFile= $this->subirImagen($_FILES["imagen"]);
            //$uploadFileM= $this->subirImagen($_FILES["imagenmobile"]);
            //(var_dump($model));
            if($_FILES["image"]["name"]){
                $uploadFile= $this->subirImagen($_FILES["image"]);
                $uploadFileM= $this->subirImagen($_FILES["imageresponsive"]);
                if ($uploadFile["success"] && $uploadFileM["success"])
                {
                    $data = $_POST;
                    $model->nombreproducto = $data['nombreproducto'];
                    $model->descripcion = $data['descripcion'];
                    $model->image = $uploadFile["Nombrearchivo"];
                    $model->imageresponsive = $uploadFileM["Nombrearchivo"];
                    $model->link = $data['enlace'];
                    $model->orden =  $data['orden'];
                    $model->estatus =  $data['estado'];
                    if ($model->save()) {
                        $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                    }else{
                        $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el banner.","resp" => false, "id" => "");
                    }
                }else{
                    $return=array("success"=>false,"Mensaje"=>"Error al subir la imagen, Mensaje: ".$uploadFile["Mensaje"],"resp" => false, "id" => "");
                }
            }else{
                $data = $_POST;
                $model->titulo = $data['nombre'];
                $model->descripcion = $data['descripcion'];
                $model->link = $data['enlace'];
                $model->orden =  $data['orden'];
                $model->estatus =  $data['estado'];
                if ($model->save()) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el banner.","resp" => false, "id" => "");
                }

            }
           
           
            echo json_encode($return);
        } else {
            $model = $this->findModel($id);
            $flagDetail = false;
            $modelDetail = array();

            return $this->render('actualizar', [
                'flagDetail' => $flagDetail,
                'model' => $model,
                'modelDetail' => $modelDetail,
            ]);
        }
    }

    /**
     * Deletes an existing QuinielaHead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionEliminar($id)

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $model= new Inventario_productos();
        $model= $model->Eliminar($id);
        return json_encode($model);
    }

    /**
     * Finds the QuinielaHead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuinielaHead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}



