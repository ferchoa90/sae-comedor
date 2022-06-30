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
use backend\models\Paginas;
use backend\models\Productoimages;


/**
 * Default controller for the `admin` module
 */
class PaginasController extends Controller
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


    public function actionContenido()
    {
        return $this->render('contenido');
    }

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
            $return=array("success"=>false,"Mensaje"=>"El archivo debe se una imagen válida. Extensión: ".$imageFileTypes);
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


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionRegistros()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $page = "paginas";

        $model = Paginas::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                if ($id=="idcategoria"){
                    if ($text==2){ $arrayResp[$key]['categoria']="Ahorros"; }
                    if ($text==3){ $arrayResp[$key]['categoria']="Crédito"; }
                    if ($text==0){ $arrayResp[$key]['categoria']="Principal"; }
                    if ($text==4){ $arrayResp[$key]['categoria']="Inversiones"; }
                }
                $arrayResp[$key]['previmage'] = '<img style="width:70px;" src="/frontend/web/images/'.$data->imagen.'"/>';
                $arrayResp[$key]['previmageres'] = '<img style="width:70px;" src="/frontend/web/images/'.$data->imagenresponsive.'"/>';

                if ($id == "id") {
                    
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/view?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }

               
                if ($id == "estatus" and $text == 'Activo') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" and $text == 'Inactivo') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "descripcion") || ($id == "titulo") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "tituloslider") || ($id == "textoslider") || ($id == "botontexto") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "linkboton") || ($id == "tag")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "id") || ($id == "fechacreacion")) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }

        echo json_encode($arrayResp);
    }

    public function actionContenidoregistros()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $page = "menus";

        $model = Paginas::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                if ($id=="idcategoria"){
                    if ($text==2){ $arrayResp[$key]['categoria']="Ahorros"; }
                    if ($text==3){ $arrayResp[$key]['categoria']="Crédito"; }
                    if ($text==0){ $arrayResp[$key]['categoria']="Principal"; }
                    if ($text==4){ $arrayResp[$key]['categoria']="Inversiones"; }
                }
                $arrayResp[$key]['previmage'] = '<img style="width:70px;" src="/frontend/web/images/'.$data->imagen.'"/>';
                $arrayResp[$key]['previmageres'] = '<img style="width:70px;" src="/frontend/web/images/'.$data->imagenresponsive.'"/>';

                if ($id == "id") {
                    
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/view?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';
                    //$arrayResp[$key]['button'] = '-';
                }

               
                if ($id == "estatus" and $text == 'Activo') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" and $text == 'Inactivo') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "descripcion") || ($id == "titulo") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "tituloslider") || ($id == "textoslider") || ($id == "botontexto") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "linkboton") || ($id == "tag")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "id") || ($id == "fechacreacion")) { $arrayResp[$key][$id] = $text; }
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
        $model = new Paginas();
        if (isset($_POST) and !empty($_POST)) {
            
            //(var_dump($model));
            if($_FILES["imagen"]["name"]){
                $uploadFile= $this->subirImagen($_FILES["imagen"]);
                $uploadFileM= $this->subirImagen($_FILES["imagenmobile"]);
                if ($uploadFile["success"] && $uploadFileM["success"])
                {
                    $data = $_POST;
                    $model->idcategoria= 0;
                    $model->nombre = $data['nombre'];
                    $model->titulo = $data['titulo'];
                    $model->tituloslider =  $data['titslider'];
                    $model->textoslider =  $data['textslider'];
                    $model->imagen = $uploadFile["Nombrearchivo"];
                    $model->imagenresponsive = $uploadFileM["Nombrearchivo"];
                    $model->botontexto = $data['textboton'];
                    $model->linkboton =  $data['lboton'];
                    $model->tag =  $data['tag'];
                    $model->contenido =  $data['contenido'];
                    $model->isDeleted =  0;
                    $model->estatus =  $data['estado'];
                    if ($model->save()) {
                        $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                    }else{
                        $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar la página.","resp" => false, "id" => "");
                    }
                    //var_dump($model->errors);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"Error al subir la imagen, Mensaje: ".$uploadFileM["Mensaje"],"resp" => false, "id" => "");
                }
            }else{
                    $data = $_POST;
                    $model->idcategoria= 0;
                    $model->nombre = $data['nombre'];
                    $model->titulo = $data['titulo'];
                    $model->tituloslider =  $data['titslider'];
                    $model->textoslider =  $data['textslider'];
                    $model->botontexto = $data['textboton'];
                    $model->linkboton =  $data['lboton'];
                    $model->tag =  $data['tag'];
                    $model->contenido =  $data['contenido'];
                    $model->isDeleted =  0;
                    $model->estatus =  $data['estado'];
                if ($model->save()) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido crear la página.","resp" => false, "id" => "");
                }
               

            }
           
            echo json_encode($return);
        } else {
            
            return $this->render('nuevo', [
                'model' => $model,
            ]);
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
        $model = new Paginas();
        if (isset($_POST) and !empty($_POST)) {
            $model = $this->findModel($id);
            $uploadFile= $this->subirImagen($_FILES["imagen"]);
            $uploadFileM= $this->subirImagen($_FILES["imagenmobile"]);
            //(var_dump($model));
            if($_FILES["image"]["name"]){
                $uploadFile= $this->subirImagen($_FILES["image"]);
                $uploadFileM= $this->subirImagen($_FILES["imageresponsive"]);
                if ($uploadFile["success"] && $uploadFileM["success"])
                {
                    $data = $_POST;
                    $model->idcategoria= 0;
                    $model->nombre = $data['nombre'];
                    $model->titulo = $data['titulo'];
                    $model->tituloslider =  $data['titslider'];
                    $model->textoslider =  $data['textslider'];
                    $model->imagen = $uploadFile["Nombrearchivo"];
                    $model->imagenresponsive = $uploadFileM["Nombrearchivo"];
                    $model->botontexto = $data['textboton'];
                    $model->linkboton =  $data['lboton'];
                    $model->tag =  $data['tag'];
                    $model->contenido =  $data['contenido'];
                    $model->isDeleted =  0;
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
                    $model->idcategoria= 0;
                    $model->nombre = $data['nombre'];
                    $model->titulo = $data['titulo'];
                    $model->tituloslider =  $data['titslider'];
                    $model->textoslider =  $data['textslider'];
                    $model->botontexto = $data['textboton'];
                    $model->linkboton =  $data['lboton'];
                    $model->tag =  $data['tag'];
                    $model->contenido =  $data['contenido'];
                    $model->isDeleted =  0;
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
            return $this->render('update', [
                'model' => $model,
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
        if (($model = Paginas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

