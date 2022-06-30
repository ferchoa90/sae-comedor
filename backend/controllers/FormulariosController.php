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
use backend\models\Contactenos;
use frontend\models\Solicitalo;
use frontend\models\Solicitudtarjeta;
use frontend\models\Bonoestudiantil;
use backend\models\Submenu;
use backend\models\Productoimages;


/**
 * Default controller for the `admin` module
 */
class FormulariosController extends Controller
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

    public function actionContactenos()
    {
        return $this->render('contactenos');
    }

    public function actionSolicitalo()
    {
        return $this->render('solicitalo');
    }

    public function actionTarjeta()
    {
        return $this->render('tarjeta');
    }


    public function actionSecundario()
    {
        return $this->render('secundario');
    }

    public function actionBonoestudiantil()
    {
        return $this->render('bonoestudiantil');
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

    public function actionExport($encuesta)
    {
        if ($encuesta=="contactenos"){
            $query = "SELECT id, cedula, nombres, ciudad, agencia, direccion, celular, 
            telefonoc, correo, requerimiento, detalle, descripcion, peticion, archivo, 
            documento, acepto, fechacreacion from contactenos";
        }
        if ($encuesta=="solicitalo"){
            $query = "SELECT nombres,celular,correo, provincia from solicitalo";
        }
        if ($encuesta=="tarjeta"){
            $query = "SELECT id, cedula, nombres, socio, celular, telefonoc, ciudad, correo, 
            ingresos, fechacreacion from solicitudtarjeta";
        }
        if ($encuesta=="bono"){
            $query = "SELECT id, nombresrep, cedularep, nombresocio, cedulasocio, provincia, 
            direccion, celular, telefono, correo, nombrehijo, cedulahijo, nombrehijo2, cedulahijo2, 
            nombrehijo3, cedulahijo3, gradoac, gradoac2, gradoac3, fechacreacion from bonoestudiantil";
        }
        $data = Yii::$app->db->createCommand($query)->queryAll();
        $array = $this->array2csv($data);

        $this->layout = 'exportar';
        //die(var_dump($data));
        return $this->render('exportar', [
            'data' => $data,
            'array' => $array,
            'filename' => "data_export_" . date("Y-m-d H:i:s").'-form-'.$encuesta . ".csv"
        ]);

    }
   
    private function array2csv(array &$array)
    {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }



    public function actionContactenosregistros()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $page = "formularios";

        $model = Contactenos::find()->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                if ($id == "id") {
                    /*$arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/view?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';*/
                    $arrayResp[$key]['button'] = '-';
                }

               
                if ($id == "estado" and $text == 'Activo') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estado" and $text == 'Inactivo') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "cedula") || ($id == "nombres") || ($id == "ciudad") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "agencia") || ($id == "direccion") || ($id == "celular") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "telefonoc") || ($id == "correo") || ($id == "requerimiento") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "detalle") || ($id == "peticion") || ($id == "archivo") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "documento") || ($id == "fechacreacion") || ($id == "id") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }

        echo json_encode($arrayResp);
    }


    public function actionSolicitaloregistros()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $page = "formularios";

        $model = Solicitalo::find()->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                if ($id == "id") {
                    /*$arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/view?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';*/
                    //$arrayResp[$key]['button'] = '-';
                }

               
                if ($id == "estado" and $text == 'Activo') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estado" and $text == 'Inactivo') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "id") || ($id == "nombres") || ($id == "celular") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "correo") || ($id == "fechacreacion") || ($id == "provincia") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }

        echo json_encode($arrayResp);
    }

    public function actionBonoestudiantilregistros()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $page = "formularios";

        $model = Bonoestudiantil::find()->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                $arrayResp[$key]['provincia'] = $data->provincia0->nombre;
                if ($id == "id") {
                    /*$arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/view?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';*/
                    //$arrayResp[$key]['button'] = '-';
                }

               
                if ($id == "estado" and $text == 'Activo') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estado" and $text == 'Inactivo') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "id") || ($id == "nombresrep") || ($id == "cedularep") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "nombresocio") || ($id == "cedulasocio") || ($id == "provincia") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "direccion") || ($id == "celular") || ($id == "telefono") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "correo") || ($id == "nombrehijo") || ($id == "cedulahijo") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "nombrehijo2") || ($id == "cedulahijo2") || ($id == "nombrehijo3") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "cedulahijo3") || ($id == "gradoac") || ($id == "gradoac2") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "gradoac3") || ($id == "fechacreacion")  ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }

        echo json_encode($arrayResp);
    }

    
    public function actionTarjetaregistros()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $page = "formularios";

        $model = Solicitudtarjeta::find()->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                if ($id == "id") {
                    /*$arrayResp[$key]['button'] = '<a href="' . URL::base() . '/' . $page . '/view?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                        . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>';*/
                    //$arrayResp[$key]['button'] = '-';
                }

               
                if ($id == "estado" and $text == 'Activo') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estado" and $text == 'Inactivo') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "id") || ($id == "nombres") || ($id == "celular") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "cedula") || ($id == "socio") || ($id == "telefonoc") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "ciudad") || ($id == "ingresos")) { $arrayResp[$key][$id] = $text; }
                    if (($id == "correo") || ($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
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

}

