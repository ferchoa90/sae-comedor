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
use backend\models\Oficinas;
use backend\models\Cajeros;
use backend\models\Provincias;
use backend\models\Tipomedico;
use backend\models\Centromedico;

use backend\models\User;

class RedController extends Controller
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

    public function actionOficinas()
    {
        return $this->render('oficinas');
    }

    public function actionCajeros()
    {
        return $this->render('cajeros');
    }

    public function actionCentrosmedicos()
    {
        return $this->render('centrosmedicos');
    }

    public function actionVercentro($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $model=  Centromedico::find()->where(['id' => $id])->one();
        return $this->render('vercentro', [
            'model' => $model,
             
        ]);
        //return $this->render('vercentro');
    }

    public function actionActualizaroficina($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $model = new Oficinas();
        if (isset($_POST) and !empty($_POST)) {
            $model=  Oficinas::find()->where(['id' => $id])->one();
            $data = $_POST;
            //Model header
            $model->nombre = $data['nombre'];
            $model->direccion = $data['direccion'];
            $model->idprovincia = $data['provincia'];
            $model->ciudad = $data['ciudad'];
            $model->lat = $data['lat'];
            $model->long = $data['long'];
            $model->estado = $data['estado'];
            $model->descripcion = "-";
            $model->usuariocreacion = "1";
            $model->isDeleted = 0;

            if ($model->save()) {
                $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
            }else{
                $return=array("success"=>false,"Mensaje"=>"No se ha podido actualizar la oficina.","resp" => false, "id" => "");
            }
           
            echo json_encode($return);
        } else {
            $model=  Oficinas::find()->where(['id' => $id])->one();
            $provincia=  Provincias::find()->where(['estado' => "ACTIVO"])->all();
            return $this->render('actualizaroficina', [
                'model' => $model,
                'provincia' => $provincia,
            ]);
        }
        
        //return $this->render('vercentro');
    }

    public function actionActualizarcajero($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $model = new Cajeros();
        if (isset($_POST) and !empty($_POST)) {
            $model=  Cajeros::find()->where(['id' => $id])->one();
            $data = $_POST;
            //Model header
            $model->nombre = $data['nombre'];
            $model->direccion = $data['direccion'];
            $model->idprovincia = $data['provincia'];
            $model->ciudad = $data['ciudad'];
            $model->lat = $data['lat'];
            $model->long = $data['long'];
            $model->descripcion = $data['telefono'];
            $model->estado = $data['estado'];
            $model->horario = $data['horario'];
            $model->horario2 = $data['horario2'];
            $model->horario3 = $data['horario3'];
            $model->tiempo = $data['tiempo'];
            $model->tiempo2 = $data['tiempo2'];
            $model->tiempo3 = $data['tiempo3'];
            $model->usuariocreacion = "1";
            $model->isDeleted = 0;

            if ($model->save()) {
                $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
            }else{
                $return=array("success"=>false,"Mensaje"=>"No se ha podido actualizar la oficina.","resp" => false, "id" => "");
            }
           
            echo json_encode($return);
        } else {
            $model=  Oficinas::find()->where(['id' => $id])->one();
            $provincia=  Provincias::find()->where(['estado' => "ACTIVO"])->all();
            return $this->render('actualizaroficina', [
                'model' => $model,
                'provincia' => $provincia,
            ]);
        }
        
        //return $this->render('vercentro');
    }

    public function actionVeroficina($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $model=  Oficinas::find()->where(['id' => $id])->one();
        return $this->render('veroficina', [
            'model' => $model,
             
        ]);
        //return $this->render('vercentro');
    }

    public function actionVercajero($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $model=  Cajeros::find()->where(['id' => $id])->one();
        $provincia=  Provincias::find()->where(['estado' => "ACTIVO"])->all();
        return $this->render('vercajero', [
            'model' => $model,
            'provincia' => $provincia,
             
        ]);
        //return $this->render('vercentro');
    }

    public function actionActualizarcentro($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $model = new Centromedico();
        if (isset($_POST) and !empty($_POST)) {
            $model=  Centromedico::find()->where(['id' => $id])->one();
            $data = $_POST;
            //Model header
            $model->nombre = $data['nombre'];
            $model->idtipo = $data['tipocentro'];
            $model->idprovincia = $data['provincia'];
            $model->estatus = $data['estado'];
            $model->orden =  $data['orden'];

            if ($model->save()) {
                $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
            }else{
                $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el centro médico.","resp" => false, "id" => "");
            }
           
            echo json_encode($return);
        } else {
            $model=  Centromedico::find()->where(['id' => $id])->one();
            $provincia=  Provincias::find()->where(['estado' => "ACTIVO"])->all();
            $tipocentro=  Tipomedico::find()->where(['estatus' => "ACTIVO"])->all();
            return $this->render('actualizarcentro', [
                'model' => $model,
                'provincia' => $provincia,
                'tipocentro' => $tipocentro,
                
            ]);
        }
        
        //return $this->render('vercentro');
    }

   
    public function actionOficinasregistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "red";
        $model = Oficinas::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        //die(var_dump($model));
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                
                //$arrayResp[$key]['previmage'] = '<img style="width:70px;" src="/frontend/web/images/'.$data->imagen.'"/>';
                if ($id == "idprovincia") {
                    $provincias=  Provincias::find()->where(['id' => $text])->one();
                    $arrayResp[$key]['provincia'] = $provincias->nombre;
                }
                if ($id == "id") {
                   
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/veroficina?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/actualizaroficina?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estado" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estado" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "descripcion") || ($id == "id") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "direccion") || ($id == "estado") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "lat") || ($id == "long") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") || ($id == "ciudad") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        
        echo json_encode($arrayResp);
    }

    public function actionCentrosmedicosregistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "red";
        $model = Centromedico::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        //die(var_dump($model));
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                
                //$arrayResp[$key]['previmage'] = '<img style="width:70px;" src="/frontend/web/images/'.$data->imagen.'"/>';
                if ($id == "idprovincia") {
                    $provincias=  Provincias::find()->where(['id' => $text])->one();
                    $arrayResp[$key]['provincia'] = $provincias->nombre;
                }
                if ($id == "idtipo") {
                    $tipomedico=  Tipomedico::find()->where(['id' => $text])->one();
                    $arrayResp[$key]['tipomedico'] = $tipomedico->nombre;
                }
                if ($id == "id") {
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/vercentro?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/actualizarcentro?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estatus" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "orden")  ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") || ($id == "estatus") || ($id == "provincia") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        
        echo json_encode($arrayResp);
    }

    public function actionCajerosregistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "red";
        $model = Cajeros::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        //die(var_dump($model));
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                
                //$arrayResp[$key]['previmage'] = '<img style="width:70px;" src="/frontend/web/images/'.$data->imagen.'"/>';
                if ($id == "idprovincia") {
                    $provincias=  Provincias::find()->where(['id' => $text])->one();
                    $arrayResp[$key]['provincia'] = $provincias->nombre;
                }
                if ($id == "id") {
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/vercajero?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/actualizarcajero?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }
                if ($id == "estado" && $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estado" && $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "descripcion") || ($id == "id") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "direccion") || ($id == "estado") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "lat") || ($id == "long") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "fechacreacion") || ($id == "ciudad") ) { $arrayResp[$key][$id] = $text; }
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
        $target_dir = '/xampp-new/htdocs/cpn2/frontend/web/images/';
        //$target_dir = '/home/futbolero/public_html/app/web/images/teams/';
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

    public function actionNuevocentro()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        
        $tipomedico= Tipomedico::find()->where(["estatus"=>"ACTIVO"])->orderBy(["nombre"=>SORT_ASC])->all();
        $provincia= Provincias::find()->where(["isDeleted"=>"0","estado"=>"ACTIVO"])->orderBy(["nombre"=>SORT_ASC])->all();

        $model = new Centromedico();
        if (isset($_POST) and !empty($_POST)) {
            echo json_encode($return);
        } else {
            return $this->render('nuevocentro', [
                'tipo' => $tipomedico,
                'provincia' => $provincia,
                'model' => $model,
            ]);
        }
    }

    public function actionNuevocajero()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        
        $provincia= Provincias::find()->where(["isDeleted"=>"0","estado"=>"ACTIVO"])->orderBy(["nombre"=>SORT_ASC])->all();

        $model = new Cajeros();
        if (isset($_POST) and !empty($_POST)) {
            echo json_encode($return);
        } else {
            return $this->render('nuevocajero', [
                'provincia' => $provincia,
                'model' => $model,
            ]);
        }
    }

    public function actionNuevooficina()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        
        $provincia= Provincias::find()->where(["isDeleted"=>"0","estado"=>"ACTIVO"])->orderBy(["nombre"=>SORT_ASC])->all();

        $model = new Oficinas();
        if (isset($_POST) and !empty($_POST)) {
            echo json_encode($return);
        } else {
            return $this->render('nuevooficina', [
                'provincia' => $provincia,
                'model' => $model,
            ]);
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
        if (($model = Accesosdirectos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}



