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


/**
 * Default controller for the `admin` module
 */
class UsuariosController extends Controller
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

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionRegistros()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $page = "usuarios";

        $model = User::find()->orderBy(["fechacreacion" => SORT_DESC])->all();
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

               
                if ($id == "estatus" and $text == 'Activo') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" and $text == 'Inactivo') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombres") || ($id == "apellidos") || ($id == "username") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "tipo") || ($id == "fechacreacion") || ($id == "correo") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "id")  || ($id == "email")) { $arrayResp[$key][$id] = $text; }
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

        $modelDetail = User::find()->where(['id' => $id])->one();
        $modelEquipos = UsuarioEquipos::find()->where(['user_id' => $modelDetail->id])->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelDetail' => $modelDetail,
            'modelEquipos' => $modelEquipos,
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
            $data = $_POST['data'];
            $fechaSplit = explode(' - ', $data['dateRange']);

            //Model header
            $model = new TriviaHead();
            $model->fecha_inicio = GlobalData::strToMysqlDateFormat($fechaSplit[0]);
            $model->fecha_final = GlobalData::strToMysqlDateFormat($fechaSplit[1]);
            $model->estado = $data['estado'];
            $model->tipo_pregunta = $data['tipo'];
            $model->user_acceso = $data['acceso'];
            $model->pregunta = $data['pregunta'];
            $model->save();
            $flagHeader = true;

            //Model descripcion
            if ($data['opcion'] == "true") {
                foreach ($data['respuestas'] as $elem) {
                    $modelDetail = new TriviaDetail();
                    $modelDetail->id_header = $model->id;
                    $modelDetail->respuesta = $elem['opcion'];
                    $modelDetail->orden = $elem['orden'];
                    $modelDetail->save();
                }
                $flagDetail = true;
            } else {
                $flagDetail = true;
            }

            if ($flagHeader and $flagDetail) {
                echo json_encode(array("resp" => true, "id" => $model->id));
            } else {
                echo json_encode(array("resp" => false, "id" => ""));
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
            $data = $_POST['data'];
            $fechaSplit = explode(' - ', $data['dateRange']);
            //Model header
            $model = $this->findModel($id);
            $model->fecha_inicio = GlobalData::strToMysqlDateFormat($fechaSplit[0]);
            $model->fecha_final = GlobalData::strToMysqlDateFormat($fechaSplit[1]);
            $model->estado = $data['estado'];
            $model->tipo_pregunta = $data['tipo'];
            $model->user_acceso = $data['acceso'];
            $model->pregunta = $data['pregunta'];
            $model->save();
            $flagHeader = true;

            //Model descripcion
            if ($data['opcion'] == "true") {
                $cont = 0;
                $modelDetOld = TriviaDetail::find()->where(["id_header" => $model->id, "deleted" => 0])->orderBy(["orden" => SORT_ASC])->all();
                foreach ($data['respuestas'] as $elem) {
                    $modelDetail = TriviaDetail::find()->where(["id" => $modelDetOld[$cont]->id, "deleted" => 0])->one();
                    $modelDetail->respuesta = $elem['opcion'];
                    $modelDetail->orden = $elem['orden'];
                    $modelDetail->save();
                    $cont++;
                }
                $flagDetail = true;
            } else {
                $flagDetail = true;
            }

            if ($flagHeader and $flagDetail) {
                echo json_encode(array("resp" => true, "id" => $model->id));
            } else {
                echo json_encode(array("resp" => false, "id" => ""));
            }

        } else {
            $model = $this->findModel($id);
            $flagDetail = false;
            $modelDetail = array();
            if ($model->tipo_pregunta != 'ABIERTO') {
                $flagDetail = true;
                $modelDetail = TriviaDetail::find()->where(['id_header' => $id, "deleted" => 0])->orderBy(["orden" => SORT_ASC])->all();
            }

            return $this->render('update', [
                'flagDetail' => $flagDetail,
                'model' => $model,
                'modelDetail' => $modelDetail,
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
        $model->deleted = 1;
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
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

