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
use backend\models\Accesosdirectos;
use backend\models\User;

class AccesosdirectosController extends Controller
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

    public function actionViewpronostico($id)
    {
         if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        return $this->render('viewpronostico', ['model' => $this->findModel($id),
           // 'modelDetail' => TriviaDetail::find()->where(['id_header' => $id, "deleted" => 0])->orderBy(["orden" => SORT_ASC])->all(),
        ]);

    }

   
    public function actionRegistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "accesosdirectos";
        $model = Accesosdirectos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                $arrayResp[$key]['previmage'] = '<img style="width:70px;" src="/frontend/web/images/'.$data->imagen.'"/>';
            
                if ($id == "id") {
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/view?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'Activo') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'Inactivo') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "descripcion") || ($id == "link") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "orden") || ($id == "estatus") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        
        echo json_encode($arrayResp);
    }

    /**

     * Displays a single QuinielaHead model.

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
             
        ]);

    }
    /**

     * Creates a new QuinielaHead model.

     * If creation is successful, the browser will be redirected to the 'view' page.

     * @return mixed

     */
    private function subirImagen($imagen)
    {
        //$target_dir = '/xampp-new/htdocs/cpn2/frontend/web/images/';
        $target_dir = '/var/www/html/frontend/web/images/';
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
            $return=array("success"=>false,"Mensaje"=>"La imagen no se ha podido guardar.");
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

    public function actionNuevo()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        $flagHeader = false;
        $flagDetail = false;

        $model = new Accesosdirectos();
        if (isset($_POST) and !empty($_POST)) {
            $uploadFile= $this->subirImagen($_FILES["imagen"]);
         
            //die(var_dump($uploadFile));
            if ($uploadFile["success"])
            {
                //echo 'OK';
                $data = $_POST;
                //Model header
                $model = new Accesosdirectos();
                $model->nombre = $data['nombre'];
                $model->descripcion = $data['descripcion'];
                $model->link = $data['enlace'];
                $model->imagen = $uploadFile["Nombrearchivo"];
                $model->isDeleted = 0;
                $model->orden =  $data['orden'];
                $model->estatus =  $data['estado'];
                $saveModel=$model->save();
                //var_dump($_POST);
                $flagHeader = true;
                if ($saveModel) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el banner.","resp" => false, "id" => "");
                }
            }else{
                $return=array("success"=>false,"Mensaje"=>"Error al subir la imagen, verifique que la imagen no exista.","resp" => false, "id" => "");
            }
           
            echo json_encode($return);
        } else {
            return $this->render('nuevo');
        }
    }



    /**

     * Updates an existing QuinielaHead model.

     * If update is successful, the browser will be redirected to the 'view' page.

     * @param integer $id

     * @return mixed

     */

    public function actionUpdate($id)

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $model = new Accesosdirectos();
        if (isset($_POST) and !empty($_POST)) {
            $model = $this->findModel($id);
            if($_FILES["image"]["name"]){
                $uploadFile= $this->subirImagen($_FILES["image"]);
                if ($uploadFile["success"])
                {
                    $data = $_POST;
                    //Model header
                    $model->nombre = $data['nombre'];
                    $model->descripcion = $data['descripcion'];
                    $model->link = $data['enlace'];
                    $model->imagen = $uploadFile["Nombrearchivo"];
                    $model->isDeleted = 0;
                    $model->orden =  $data['orden'];
                    $model->estatus =  $data['estado'];
                    //var_dump($_POST);
                    $flagHeader = true;
                    if ($model->save()) {
                        $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                    }else{
                        $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el acceso directo.","resp" => false, "id" => "");
                    }
                }else{
                    $return=array("success"=>false,"Mensaje"=>"Error al subir la imagen, Mensaje: ".$uploadFile["Mensaje"],"resp" => false, "id" => "");
                }
            }else{
                    $data = $_POST;
                    $model->nombre = $data['nombre'];
                    $model->descripcion = $data['descripcion'];
                    $model->link = $data['enlace'];
                    $model->isDeleted = 0;
                    $model->orden =  $data['orden'];
                    $model->estatus =  $data['estado'];
                if ($model->save()) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido actualizar la página.","resp" => false, "id" => "");
                }
            // var_dump($model->errors);

            }
            echo json_encode($return);
        } else {
            $model = $this->findModel($id);
            $flagDetail = false;
            $modelDetail = array();

            return $this->render('update', [
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

    public function actionDelete($id)

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $model = $this->findModel($id);
        $model->isDeleted = 1;
        if ($model->save())
        {
            return $this->redirect(['index']);
        }else{
            var_dump($model->errors);
        }
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
        if (($model = Accesosdirectos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}



