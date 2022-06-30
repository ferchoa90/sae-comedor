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
use backend\components\Sistema_sucursal;
use common\models\Roles;

use backend\models\User;


/**
 * Default controller for the `admin` module
 */
class UsuarioController extends Controller
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
    public function actionMiperfil()
    {
        $id=Yii::$app->user->identity->id;
        $model = User::find()->where(["isDeleted"=>"0","id"=>$id])->one();
        $sucursal = new Sistema_sucursal;
        $sucursal= $sucursal->getSelect();
        $roles = Roles::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_ASC])->all();
        $rolesArray=array();
        $cont=0;
        foreach ($roles as $key => $value) {
            if ($cont==0){ $rolesArray[$cont]["value"]="Seleccione un rol"; $rolesArray[$cont]["id"]=-1; $cont++; }
            $rolesArray[$cont]["value"]=$value->nombre;
            $rolesArray[$cont]["id"]=$value->id;
            $cont++;
        }
        return $this->render('miperfil', [
            'model' => $model,
            'sucursal' => $sucursal,
            'roles' => $rolesArray,
        ]);

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

        $model = User::find()->orderBy(["fecha_creacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;

        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $arrayResp[$key]['num'] = $count;
                if ($id == "id") {
                    $arrayResp[$key]['button'] = '<a href="' . URL::base() . '/admin/' . $page . '/view?id=' . $text . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '&nbsp;<!--<a href="' . URL::base() . '/admin/' . $page . '/update?id=' . $text . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>-->'
                        . '&nbsp;<!--<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $text . '" data-name="' . $id . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                        . '<i class="glyphicon glyphicon-trash"></i></button>-->';
                    //$arrayResp[$key]['button'] = '-';
                }

                if ($id == "fecha_nacimiento") {
                    if (!empty($text)) {
                        $fecha_nacimiento = GlobalData::strToMysqlDateFormat($text, "Y-m-d", "Y");
                        $fecha_actual = date("Y");
                        $arrayResp[$key]['edad'] = $fecha_actual - $fecha_nacimiento;
                    } else {
                        $arrayResp[$key]['edad'] = "-";
                    }
                }

                if ($id == "estado" and $text == 'ACTIVE') {
                    $arrayResp[$key][$id] = '<small class="label label-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estado" and $text == 'INACTIVE') {
                    $arrayResp[$key][$id] = '<small class="label label-default"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    $arrayResp[$key][$id] = $text;
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
