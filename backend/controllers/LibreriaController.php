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
use backend\models\Descargables;
use backend\models\Paginas;
use backend\models\User;

class LibreriaController extends Controller
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
        $page = "libreria";
        $model = Descargables::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $pagina = Paginas::find()->where(['id' => $data->pagina,'isDeleted' => '0'])->one();
                $arrayResp[$key]['num'] = $count;
                $arrayResp[$key]['archivo'] = '<a   src="/frontend/web/images/'.$data->archivo.'"/>'.$data->archivo.'</a>';
                $arrayResp[$key]['pagina']="-";
                if ($pagina){ $arrayResp[$key]['pagina']=$pagina["nombre"]; }
                if ($id == "id") {
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/verdescarga?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/actualizardescarga?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "tipo") || ($id == "link") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "vista") || ($id == "superior") ) { $arrayResp[$key][$id] = $text; }
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

    public function actionVerdescarga($id)

    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        return $this->render('verdescarga', [
            'model' => $this->findModel($id),
           
        ]);

    }
    /**

     * Creates a new QuinielaHead model.

     * If creation is successful, the browser will be redirected to the 'view' page.

     * @return mixed

     */
    private function subirArchivo($imagen)
    {
        //$target_dir = '/xampp-new/htdocs/cpn2/frontend/web/pdf/';
        $target_dir = '/var/www/html/frontend/web/pdf/';
        $target_file = $target_dir . basename($imagen["name"]);
        $nombreArchivo=basename($imagen["name"]);
        $uploadOk = 1;
        $imageFileType = $imagen['type'];
        // Check if image file is a actual image or fake image
           /*  $check = getimagesize($imagen["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $return=array("success"=>false,"Mensaje"=>"El archivo no es una imagen.");
                $uploadOk = 0;
            } */
        // Check if file already exists
        if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
            $return=array("success"=>false,"Mensaje"=>"La imagen ya existe en el repositorio.");
            $uploadOk = 0;
        }
        // Check file size
        if ($imagen["size"] > 5000000) {
            $return=array("success"=>false,"Mensaje"=>"El archivo subida excede el límite de tamaño. Tamaño: ".$imagen["size"]);
            //echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "application/vnd.ms-excel" && $imageFileType != "application/pdf" && $imageFileType != "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
        && $imageFileType != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) {
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $return=array("success"=>false,"Mensaje"=>"El archivo debe se un archivo permitido. Tipo: ".$imageFileType);
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $return=array("success"=>false,"Mensaje"=>$return["Mensaje"]);
            //echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            //echo move_uploaded_file($imagen["tmp_name"], $target_file);
            if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
                $return=array("success"=>true,"Mensaje"=>"Archivo subido.","Nombrearchivo"=>$nombreArchivo);
                //$return=array("success"=>"true","Mensaje"=>"OK");
                //echo json_encode($return);
                //echo "The file ". basename( $imagen["name"]). " has been uploaded.";
            } else {
                $return=array("success"=>false,"Mensaje"=>"La imagen no se ha podido guardar.");
            }
        }
        return $return;
    }

    public function actionNuevadescarga()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        $flagHeader = false;
        $flagDetail = false;
        $pagina = Paginas::find()->where(['isDeleted' => '0'])->all();
        $model = new Descargables();
        if (isset($_POST) and !empty($_POST)) {
            $uploadFile= $this->subirArchivo($_FILES["imagen"]);
            //die(var_dump($uploadFile));
            if ($uploadFile["success"])
            {
                //echo 'OK';
                $data = $_POST;
                //Model header
                 
                $model->nombre = $data['nombre'];
                $model->archivo = $uploadFile["Nombrearchivo"];
                $model->pagina = $data['tipo'];
                $model->vista = $data['vista'];
                $model->superior = $data['superior'];
                $model->isDeleted = 0;
                $model->orden =  $data['orden'];
                $model->estatus =  $data['estado'];
                $saveModel=$model->save();
                //var_dump($_POST);
                $flagHeader = true;
                if ($saveModel) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar ela descarga.","resp" => false, "id" => "");
                }
                //var_dump($model->errors);
            }else{
                $return=array("success"=>false,"Mensaje"=>$uploadFile["Mensaje"],"resp" => false, "id" => "");
            }
           
            echo json_encode($return);
        } else {
            return $this->render('nuevadescarga', [
                'model' => $model,
                'pagina' => $pagina,
            ]);
            return $this->render('nuevadescarga');
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
        $model = new Slider();
        if (isset($_POST) and !empty($_POST)) {
            $model = $this->findModel($id);
            //$uploadFile= $this->subirImagen($_FILES["imagen"]);
            //$uploadFileM= $this->subirImagen($_FILES["imagenmobile"]);
            //die(var_dump($uploadFile));
            //if ($uploadFile["success"] && $uploadFileM["success"])
            //{
                //echo 'OK';
            $data = $_POST;
            //Model header
            $model->titulo = $data['nombre'];
            $model->descripcion = $data['descripcion'];
            $model->link = $data['enlace'];
            //$model->image = $uploadFile["Nombrearchivo"];
            //$model->imageresponsive = $uploadFileM["Nombrearchivo"];
            //$model->isDeleted = 0;
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
            //}else{
            //    $return=array("success"=>false,"Mensaje"=>"Error al subir la imagen, verifique que la imagen no exista.","resp" => false, "id" => "");
            //}
           
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
        if (($model = Descargables::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}



