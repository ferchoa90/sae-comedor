<?php

namespace backend\controllers;

use app\components\GlobalData;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\db\Query;

use backend\models\User;
use backend\models\Menuprincipal;
use backend\models\Submenu;
use backend\models\Productoimages;


/**
 * Default controller for the `admin` module
 */
class MenusController extends Controller
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


    public function actionSecundario()
    {
        return $this->render('secundario');
    }

    public function actionHome()
    {
        return $this->render('home');
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionRegistros()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $page = "menus";

        $model = Menuprincipal::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                //$arrayResp[$key]['num'] = $count;
                if ($id == "id") {
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/view?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }

               
                if ($id == "estado" and $text == 'Activo') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estado" and $text == 'Inactivo') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "descripcion") || ($id == "link") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "id") || ($id == "fechacreacion") || ($id == "orden") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }

        echo json_encode($arrayResp);
    }

    public function actionSecundarioregistros()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $page = "menus";

        $model = Submenu::find()->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                //$arrayResp[$key]['num'] = $count;
                if ($id == "id") {
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/versecundario?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/updatesubmenu?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if (($id == "idmenu") ){$arrayResp[$key]['descripcion']=$data->menu->nombre;}
                //if (($id == "idmenu")&&($text == "2") ){$arrayResp[$key]['descripcion']="Productos";}
                //if (($id == "idmenu")&&($text == "3") ){$arrayResp[$key]['descripcion']="Productos";}
               
                if ($id == "estado" and $text == 'Activo') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estado" and $text == 'Inactivo') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "menu") || ($id == "link") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "id") || ($id == "fechacreacion") || ($id == "orden") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }

        echo json_encode($arrayResp);
    }

    public function actionHomeregistros()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $page = "menus";

        $model = Productoimages::find()->orderBy(["idproducto" => SORT_DESC,"fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                //$arrayResp[$key]['num'] = $count;
                $arrayResp[$key]['previmage'] = '<img style="width:70px;" src="/frontend/web/images/'.$data->imagen.'"/>';
                $arrayResp[$key]['previmageres'] = '<img style="width:70px;" src="/frontend/web/images/'.$data->imagenresponsive.'"/>';

                if ($id == "id") {
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/view?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if (($id == "idproducto")&&($text == "1") ){$arrayResp[$key]['nombre']="Ahorros";}
                if (($id == "idproducto")&&($text == "2") ){$arrayResp[$key]['nombre']="Crédito";}
                if (($id == "idproducto")&&($text == "3") ){$arrayResp[$key]['nombre']="Tarjetas";}
                if (($id == "idproducto")&&($text == "4") ){$arrayResp[$key]['nombre']="Inversiones";}
               
                if ($id == "estatus" and $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" and $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "link") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "id") || ($id == "fechacreacion") || ($id == "orden") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }

        echo json_encode($arrayResp);
    }

    /**
     * Displays a single TriviaHead model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            //'modelTeam' => Slider::find()->all(),
        ]);
    }

    public function actionVersecundario($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $secundario= Submenu::find()->where(['id'=>$id,'isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->one();
        return $this->render('versecundario', [
            'model' => $secundario,
            //'modelTeam' => Slider::find()->all(),
        ]);
    }

    public function actionVermenuhome($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $model= Productoimages::find()->where(['id'=>$id,'isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->one();
        return $this->render('vermenuhome', [
            'model' => $model,
            //'modelTeam' => Slider::find()->all(),
        ]);
    }

    /**
     * Creates a new TriviaHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNuevo()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $flagHeader = false;
        $flagDetail = false;

        if (isset($_POST) and !empty($_POST)) {
            $data = $_POST;
            $fechaSplit = explode(' - ', $data['dateRange']);

            //Model header
            $model = new Menuprincipal();
            $model->nombre = $data['nombre'];
            $model->descripcion = $data['descripcion'];
            $model->link = $data['enlace'];
            $model->orden = $data['orden'];
            $model->estado = $data['estado'];
            $model->isDeleted = 0;
            $model->usuariocreacion = " ";
            
            //var_dump($model->errors);
            //$flagHeader = true;
            //Model descripcion
            if ($model->save()) {
                echo json_encode(array("success" => true, "id" => $model->id));
            } else {
                echo json_encode(array("success" => false, "id" => "", "Mensaje" => "Error al insertar el menú."));
            }

        } else {
            return $this->render('nuevo');
        }

    }

    private function subirImagen($imagen)
    {
        $target_dir = '/xampp-new/htdocs/cpn2/frontend/web/images/';
        //$target_dir = '/var/www/html/frontend/web/images/';
        $target_file = $target_dir . basename($imagen["name"]);
        $nombreArchivo=basename($imagen["name"]);
        $uploadOk = 0;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
            $check = getimagesize($imagen["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $return=array("success"=>false,"Mensaje"=>"El archivo no es una imagen.");
                $uploadOk = 0;
            }
        // Check if file already exists
        if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
            $return=array("success"=>false,"Mensaje"=>"La imagen ya existe en el repositorio.");
            $uploadOk = 0;
        }
        // Check file size
        if ($imagen["size"] > 5000000) {
            $return=array("success"=>false,"Mensaje"=>"La imagen subida excede el límite de tamaño.");
            //echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $return=array("success"=>false,"Mensaje"=>"El archivo debe se una imagen válida.");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $return=array("success"=>false,"Mensaje"=> $return["Mensaje"]);
            //echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            //echo move_uploaded_file($imagen["tmp_name"], $target_file);
            if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
                $return=array("success"=>true,"Mensaje"=>"Imagen subida.","Nombrearchivo"=>$nombreArchivo);
                //$return=array("success"=>"true","Mensaje"=>"OK");
                //echo json_encode($return);
                //echo "The file ". basename( $imagen["name"]). " has been uploaded.";
            } else {
                $return=array("success"=>false,"Mensaje"=>"La imagen no se ha podido guardar.");
            }
        }
        return $return;
    }

    public function actionNuevohome()
    {
        $model = new Productoimages();
        if (isset($_POST) and !empty($_POST)) {
           
            if($_FILES["imagen"]["name"]){
                $uploadFile= $this->subirImagen($_FILES["imagen"]);
                $uploadFileM= $this->subirImagen($_FILES["imagenmobile"]);
                if ($uploadFile["success"] && $uploadFileM["success"] )
                {
                    $data = $_POST;            
                    $model = new Productoimages();
                    $model->estatus = $data['estado'];
                    $model->idproducto = $data['tipo'];
                    $model->isDeleted = 0;
                    $model->imagen = $uploadFile["Nombrearchivo"];
                    $model->imagenresponsive = $uploadFileM["Nombrearchivo"];
                    $model->link = $data['enlace'];
                    $model->usuariocreacion = "1";
                    if ($model->save()) {
                        $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                    }else{
                        $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el menu home.","resp" => false, "id" => "");
                    }
                    //var_dump($model->errors);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"Error al subir la imagen, Mensaje: ".$uploadFile["Mensaje"],"resp" => false, "id" => "");
                }
            }else{
                $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el menu home.","resp" => false, "id" => "");
            } 
            echo json_encode($return);
        } else {
            
            return $this->render('nuevohome', [
                'model' => $model,
            ]);
        }

    }

    public function actionNuevosubmenu()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $flagHeader = false;
        $flagDetail = false;

        if (isset($_POST) and !empty($_POST)) {
            $data = $_POST;
            $fechaSplit = explode(' - ', $data['dateRange']);

            //Model header
            $model = new Submenu();
            $model->nombre = $data['nombre'];
            $model->descripcion = $data['descripcion'];
            $model->link = $data['enlace'];
            $model->orden = $data['orden'];
            $model->estado = $data['estado'];
            $model->idparent = 0;
            $model->idmenu = $data['menuprincipal'];
            $model->isDeleted = 0;
            $model->usuariocreacion = " ";
            //$model->save();
            //var_dump($model->errors);
            //var_dump($model->errors);
            //$flagHeader = true;
            //Model descripcion
            if ($model->save()) {
                echo json_encode(array("success" => true, "id" => $model->id));
            } else {
                echo json_encode(array("success" => false, "id" => "", "Mensaje" => "Error al insertar el menú."));
            }

        } else {
            return $this->render('nuevosubmenu');
        }

    }

    /**
     * Updates an existing TriviaHead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $flagHeader = false;
        $flagDetail = false;

        if (isset($_POST) and !empty($_POST)) {
            $data = $_POST;
            $fechaSplit = explode(' - ', $data['dateRange']);
            //Model header
            $model = $this->findModel($id);
            $data = $_POST;
            $fechaSplit = explode(' - ', $data['dateRange']);

            //Model header
            $model->nombre = $data['nombre'];
            $model->descripcion = $data['descripcion'];
            $model->link = $data['enlace'];
            $model->orden = $data['orden'];
            $model->estado = $data['estado'];
            
            //var_dump($model->errors);
            //$flagHeader = true;
            //Model descripcion
            if ($model->save()) {
                echo json_encode(array("success" => true, "id" => $model->id));
            } else {
                echo json_encode(array("success" => false, "id" => "", "Mensaje" => "Error al insertar el menú."));
            }

        } else {
            $model = $this->findModel($id);
            return $this->render('update', [
                //'flagDetail' => $flagDetail,
                'model' => $model,
                //'modelDetail' => $modelDetail,
            ]);
        }
    }

    public function actionUpdatesubmenu($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $flagHeader = false;
        $flagDetail = false;

        if (isset($_POST) and !empty($_POST)) {
            $data = $_POST;
            
            //Model header
            $model = $this->findModelsubmenu($id);
            $data = $_POST;
             

            //Model header
            $model->nombre = $data['nombre'];
            $model->descripcion = $data['descripcion'];
            $model->idmenu = $data['menu'];
            $model->idparent = $data['parent'];
            $model->link = $data['enlace'];
            $model->orden = $data['orden'];
            $model->estado = $data['estado'];
            
            //var_dump($model->errors);
            //$flagHeader = true;
            //Model descripcion
            if ($model->save()) {
                echo json_encode(array("success" => true, "id" => $model->id));
            } else {
                echo json_encode(array("success" => false, "id" => "", "Mensaje" => "Error al insertar el menú."));
            }

        } else {
            $model = Submenu::find()->where(['id'=>$id,'isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->one();
            $menu = Menuprincipal::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
            $superior = Submenu::find()->where(['idparent'=>0,'isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
            return $this->render('updatesubmenu', [
                'superior' => $superior,
                'menu' => $menu,
                'model' => $model,
                //'modelDetail' => $modelDetail,
            ]);
        }
    }

    /**
     * Deletes an existing TriviaHead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $model = $this->findModel($id);
        $model->isDeleted = 1;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TriviaHead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TriviaHead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menuprincipal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelsubmenu($id)
    {
        if (($model = Submenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

