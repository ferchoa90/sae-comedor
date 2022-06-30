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
use common\models\Factura;
use common\models\Presentacion;
use common\models\Productos;
use backend\models\User;

class ReportesController extends Controller
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

    public function actionVentasd()
    {
        return $this->render('ventasd');
    }

    public function actionVentasdiarias()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "reportes";

        $model = Factura::find()
        ->select(['DAY(fechacreacion) AS fechacreacion,SUM(total) AS total,MONTH(fechacreacion) AS nfactura,YEAR(fechacreacion) AS idcliente'])
        ->where("estatus = 'ACTIVO'")
        ->groupBy(['DAY(fechacreacion)'])
        ->all();
        //var_dump($model);
        //$model = Productos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($model as $key => $data) {
                    $arrayResp[$key]["mes"] = $data->nfactura;
                    $arrayResp[$key]["anio"] = $data->idcliente;
                    $arrayResp[$key]["fecha"] = $data->fechacreacion;
                    $arrayResp[$key]["total"] = $data->total;
        }
        
        return json_encode($arrayResp);
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
        if (($model = Inventario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}



