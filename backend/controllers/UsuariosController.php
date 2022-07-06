<?php

namespace backend\controllers;

use backend\components\GlobalData;
use backend\components\Usuarios_roles;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\db\Query;
use backend\components\Botones;
use backend\models\User;
use common\models\Sucursal;
use common\models\Roles;
use common\models\Rolespermisos;
use backend\components\Sistema_sucursal;
use backend\components\Usuarios_sistema;
use backend\components\Usuarios_permisos;

use backend\components\Configuraciones_rolesmodulo;

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
                'only' => ['create', 'update', 'view', 'delete', 'index','nuevorol'],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'view', 'delete', 'index','nuevorol'],
                        'allow' => true,
                        'roles' => ['@'],

                        'matchCallback' => function ($rule, $action) {
                            if (Usuarios_permisos::isPermisos(Yii::$app->user->identity->username))
                            {
                                return true;
                            }else{
                                return $this->redirect('/backend/web/site/denegado');
                               //return false;
                            }
                            //return $this->render('index');
                        },

                        /*'denyCallback' => function($rule, $action) {
                            //redirection here
                            return $this->render('roles');
                       }*/

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

    public function actionEditarrol($id)
    {
        //die($id);
        $nuevorol= new Configuraciones_rolesmodulo;
        $nuevorol= $nuevorol->getDataID();
        //$roldata=={}
        return $this->render('editarrol', [
            'data' => Roles::find()->where(['id' => $id, "isDeleted" => 0, "estatus" => "ACTIVO"])->one(),
            'datapermiso' => Rolespermisos::find()->where(['idrol' => $id, "isDeleted" => 0, "estatus" => "ACTIVO"])->all(),
            'roles' => $nuevorol,

        ]);
    }



    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUsuarios()
    {
        return $this->render('usuarios');
    }

    public function actionVerusuario($id)
    {
        $usuario= User::find()->where(["id"=>$id])->one();
        return $this->render('verusuario', [
            'data' => $usuario,
        ]);
    }

    public function actionRoles()
    {
        return $this->render('roles');
    }

    public function actionFormrol()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        $rol= new Usuarios_Roles;
        $rol= $rol->Nuevo($_POST);
        //var_dump($rol);
        //die(var_dump($rol));
        if ($rol)
        {
            $response=$rol;
        }else{
            $response=array("response" => true, "id" => $model->id, "mensaje"=> "Error al agregar el registro","success"=>false);
        }
        //return $this->render('formrol');
        return json_encode($response);

    }

    public function actionNuevorol()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $nuevorol= new Configuraciones_rolesmodulo;
        $nuevoroladmin= $nuevorol->getData(1);
        $nuevorolfront= $nuevorol->getData(2);
        return $this->render('nuevorol', [
            'roles' => $nuevoroladmin,
            'rolesfront' => $nuevorolfront,
        ]);
    }

    public function actionFormeditarrol()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        $data= new Usuarios_roles;
        $data= $data->Editar($_POST);
        $response=$data;
        return json_encode($response);

    }

    public function actionFormeditarusuario()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        $data= new Usuarios_sistema;
        $data= $data->Editar($_POST);
        $response=$data;
        return json_encode($response);

    }

    public function actionFormeditartipoexamen()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        $data= new Usuarios_roles;
        $data= $data->Editar($_POST);
        $response=$data;
        return json_encode($response);

    }




    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionRolesreg()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $model = Roles::find()->where(["isDeleted"=>"0"])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count =0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                //$arrayResp[$key]['num'] = $count;
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $view='rol';
                if ($id == "id") {
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

                if ($id == "estatus" and $text == 'ACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" and $text == 'INACTIVO') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombre") || ($id == "descripcion") || ($id == "fechacreacion") ) { $arrayResp[$key][$id] = $text; }
                }
            }
            $count++;
        }
        return json_encode($arrayResp);
    }


    public function actionUsuariosreg()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "usuarios";
        $model = User::find()->where(["isDeleted"=>"0"])->andfilterWhere(["<>","id","1"])->orderBy(["nombres" => SORT_ASC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            foreach ($data as $id => $text) {
                $botones= new Botones;
                $arrayResp[$key]['num'] = $count+1;
                $arrayResp[$key]['perfil'] = $data->rol->nombre;
                $view='usuario';
                if ($id == "id") {
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

                if ($id == "estatus" and $text == 'Activo') {
                    $arrayResp[$key][$id] = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $text . '</small>';
                } elseif ($id == "estatus" and $text == 'Inactivo') {
                    $arrayResp[$key][$id] = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $text . '</small>';
                } else {
                    if (($id == "nombres") || ($id == "apellidos") || ($id == "username") ) { $arrayResp[$key][$id] = $text; }
                    if (($id == "cedula") || ($id == "fechacreacion") || ($id == "email") ) { $arrayResp[$key][$id] = $text; }

                }
            }
            $count++;
        }
        return json_encode($arrayResp);
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

        ]);
    }

    /**
     * Creates a new TriviaHead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNuevousuario()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $sucursal = Sucursal::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_ASC])->all();
        $roles = Roles::find()->where(['isDeleted' => '0'])->andWhere(['<>','nombre', 'SuperAdmin'])->orderBy(["id" => SORT_ASC])->all();
        $rolesArray=array();
        $cont=0;
        foreach ($roles as $key => $value) {
            if ($cont==0){ $rolesArray[$cont]["value"]="Seleccione un rol"; $rolesArray[$cont]["id"]=-1; $cont++; }
            $rolesArray[$cont]["value"]=$value->nombre;
            $rolesArray[$cont]["id"]=$value->id;
            $cont++;
        }

        return $this->render('nuevousuario', [
            'sucursal' => $sucursal,
            'roles' => $rolesArray,
        ]);
    }

    public function actionFormusuario()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        $usuario= new Usuarios_sistema;
        $usuario= $usuario->Nuevo($_POST);
        //die(var_dump($_POST));
        $response=$usuario;

        //return $this->render('formrol');
        return json_encode($response);

    }

    /**
     * Updates an existing TriviaHead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEditarusuario($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $sucursal = new Sistema_sucursal;
        $sucursal= $sucursal->getSelect();
        $roles = Roles::find()->where(['isDeleted' => '0'])->andWhere(['<>','nombre', 'SuperAdmin'])->orderBy(["id" => SORT_ASC])->all();
        $rolesArray=array();
        $cont=0;
        foreach ($roles as $key => $value) {
            if ($cont==0){ $rolesArray[$cont]["value"]="Seleccione un rol"; $rolesArray[$cont]["id"]=-1; $cont++; }
            $rolesArray[$cont]["value"]=$value->nombre;
            $rolesArray[$cont]["id"]=$value->id;
            $cont++;
        }
        $model = $this->findModel($id);
        if (isset($_POST) and !empty($_POST)) {
            $data = $_POST;

            //Model header
            if ($data['password'])
            {
                $model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($data['password']);
            }
                $model->nombres=$data['nombres'];
                $model->username=$data['nombreu'];
                $model->apellidos=$data['apellidos'];
                $model->email=$data['correo'];
                $model->idsucursal=$data['sucursal'];
                $model->tipo=$data['tipo'];
                $model->cedula=$data['cedula'];
                $model->estatus=$data['estado'];

            if ($model->save()) {
                echo json_encode(array("resp" => true, "id" => $model->id, "mensaje" => "Usuario actualizado correctamente"));
            } else {
                echo json_encode(array("resp" => false, "id" => "", "mensaje" => "Error al actualizar el usuario"));
            }

        } else {
            return $this->render('editarusuario', [
                'model' => $model,
                'sucursal' => $sucursal,
                'roles' => $rolesArray,
            ]);
        }
    }

    /**
     * Deletes an existing TriviaHead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUsuarioseliminar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $model = User::findOne($id);
        $model->isDeleted = 1;

        if ($model->save())
        {
            return true;
        }else{
            return false;
        }
        //return $this->redirect(['index']);
    }

    public function actionRoleseliminar($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }

        $model = Roles::findOne($id);
        $model->isDeleted = 1;

        if ($model->save())
        {
            return true;
        }else{
            return false;
        }
        //return $this->redirect(['index']);
    }

    public function actionVerrol($id)
    {
        $rol= Roles::find()->where(['id' => $id, "isDeleted" => 0])->one();

        return $this->render('verrol', [
            'rol' =>$rol,
            'rolpermisos' => Rolespermisos::find()->where(['idrol' => $rol->id])->all(),
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
