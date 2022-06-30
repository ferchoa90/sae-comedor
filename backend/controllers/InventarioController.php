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
use common\models\Inventariotransfer;
use common\models\Factura;
use common\models\Presentacion;
use common\models\Color;
use common\models\Calidad;
use common\models\Clasificacion;
use common\models\Sucursal;
use common\models\Productos;
use backend\models\User;
use backend\components\Botones;
use backend\components\Sistema_sucursal;
use backend\components\Inventario_colores;
use backend\components\Inventario_presentacion;
use backend\components\Inventario_calidad;
use backend\components\Inventario_clasificacion;
use backend\components\Inventario_stock;

class InventarioController extends Controller
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
    public function actionAgregarstockex()
    {
        $sucursal = new Sistema_sucursal();
        $sucursal = $sucursal->getSelect();
        $clasificacion = new Inventario_clasificacion();
        $clasificacion = $clasificacion->getSelect();
        $calidad = new Inventario_calidad();
        $calidad = $calidad->getSelect();
        $color = new Inventario_colores();
        $color = $color->getSelect();
        $presentacion = new Inventario_presentacion();
        $presentacion = $presentacion->getSelect();
        
        $model = new Inventario();
        
            return $this->render('agregarstockex', [
                'presentacion' => $presentacion,
                'color' => $color,
                'calidad' => $calidad,
                'sucursal' => $sucursal,
                'clasificacion' => $clasificacion,
                //'flagDetail' => $flagDetail,
            ]);
         
    }
    public function actionNuevatransferencia()
    {
        $sucursalactual=Yii::$app->user->identity->idsucursal;
        $usuario = User::find()->where(['estatus' => 'Activo'])->andWhere(["<>","id","10002"])->orderBy(["username" => SORT_ASC])->all();
           
        //die(var_dump($sucursalactual));
        $sucursal = Sucursal::find()->where(['isDeleted' => '0'])->andWhere(["<> ","id",$sucursalactual])->orderBy(["nombre" => SORT_ASC])->all();
        return $this->render('nuevatransferencia', [
            'sucursal' => $sucursal,
            'usuario' => $usuario,
        ]);
   
    }
    
    public function actionTransferencia()
    {
        return $this->render('transferencia');
    }

    public function actionProductoindividualc()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            //return $this->redirect(URL::base() . "/site/login");
        }
        $codigo=$_REQUEST["codigo"];
        //$nombrep=explode(" -",$_REQUEST["nombrep"]);
        //$nombrep[0]="167";
        $page = "site";
        $model = Inventario::find()->where(['codigobarras' => $codigo])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        
        
            $modelInventario = Productos::find()->where(['id' => $model[0]->idproducto ])->orderBy(["fechacreacion" => SORT_DESC])->all();
            //var_dump($modelInventario);
            if (!$modelInventario){
                $arrayResp[0]['id'] = $model[0]->id;
                $arrayResp[0]['imagen'] = $model[0]->imagen;
            }
            
            foreach ($modelInventario as $keyI => $dataI) {
            
                   
                $arrayResp[$keyI]['titulo'] = $dataI->nombreproducto;
                $arrayResp[$keyI]['descripcion'] = $dataI->descripcion;
                $arrayResp[$keyI]['imagen'] = '<img style="width:20px;" src="/frontend/web/images/articulos/'.$dataI->imagen.'"/>';
                //$arrayResp[$keyI]['imagen'] = '-';
                $arrayResp[$keyI]['stock'] = $model[0]->stock;
                $arrayResp[$keyI]['cantidadini'] = $model[0]->cantidadini;
                $arrayResp[$keyI]['cantidadcaja'] = $model[0]->cantidadcaja;
                $arrayResp[$keyI]['precioint'] = $model[0]->precioint;
                $arrayResp[$keyI]['preciov1'] = $model[0]->preciov1;
                $arrayResp[$keyI]['preciov2'] = $model[0]->preciov2;
                $arrayResp[$keyI]['preciovp'] = $model[0]->preciovp;
                $arrayResp[$keyI]['codigobarras'] = $model[0]->codigobarras;
                $arrayResp[$keyI]['codigocaja'] = $model[0]->codigocaja;
                $arrayResp[$keyI]['usuariocreacion'] = $dataI->usuariocreacion0->username;
                //$arrayResp[$keyI]['fechacreacion'] = "-";
                $arrayResp[$keyI]['id'] = $model[0]->id;
                $arrayResp[$keyI]['imagen'] = $dataI->imagen;
                 
            
        
                $count++;       
            }
            
        
        
        return json_encode($arrayResp);
    }

   public function actionInteracciones()
    {
        return $this->render('interacciones');
    }

    public function actionProductoskardex()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "inventario";
        $modelI = Productos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
       // $modelI =  Inventario::find()->where(['isDeleted' => 0,'idsucursal' => Yii::$app->user->identity->idsucursal ])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($modelI as $key => $data) {
            $arrayResp[] = $data->id.' - '.$data->nombreproducto.' - '.$data->marca0->nombre.' '.$data->color->nombre.' '.$data->descripcion;
        }
       //  die(var_dump($arrayResp));
        return json_encode($arrayResp);
    }
    public function actionInventariokardex()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "inventario";
        //$model = Productos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $modelI =  Inventario::find()->where(['isDeleted' => 0,'idsucursal' => Yii::$app->user->identity->idsucursal ])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 1;
        foreach ($modelI as $key => $data) {
            $arrayResp[] = $data->id.' - '.$data->producto->nombreproducto.' - '.$data->producto->marca0->nombre.' '.$data->color->nombre.' '.$data->clasificacion->nombre.' - '.$data->producto->descripcion;
        }
       //  die(var_dump($arrayResp));
        return json_encode($arrayResp);
    }

    public function actionProductoindividual()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
     
        $nombrep=$_REQUEST["nombrep"];
        $nombrep=explode(" -",$_REQUEST["nombrep"]);
        //$nombrep[0]="167";
        $page = "site";
               $arrayResp = array();
        $count = 1;
        
        //die(var_dump($model));
 
            $model = Productos::find()->where(['id' => str_replace("-","",$nombrep[0]) ])->orderBy(["fechacreacion" => SORT_DESC])->all();
            //$model =  Inventario::find()->where(['id' =>  str_replace("-","",$nombrep[0])])->orderBy(["fechacreacion" => SORT_DESC])->all();
            //var_dump($modelInventario);
           /* if (!$modelInventario){
                $arrayResp[0]['id'] = $model->id;
                $arrayResp[0]['imagen'] = $model>imagen;
            }*/
              
            foreach ($model as $keyI => $dataI) {
            
                $arrayResp[$keyI]['titulo'] = $dataI->nombreproducto;
                $arrayResp[$keyI]['descripcion'] = $dataI->descripcion;
                //$arrayResp[$keyI]['color'] = $dataI->color->nombre;
                //$arrayResp[$keyI]['clasificacion'] = $dataI->clasificacion->nombre;
                $arrayResp[$keyI]['imagen'] = '<img style="width:20px;" src="/frontend/web/images/articulos/'.$dataI->imagen.'"/>';
                //$arrayResp[$keyI]['imagen'] = '-';
 
                $arrayResp[$keyI]['usuariocreacion'] = $dataI->usuariocreacion0->username;
                //$arrayResp[$keyI]['fechacreacion'] = "-";
                $arrayResp[$keyI]['id'] = $dataI->id;
                $arrayResp[$keyI]['imagen'] = $dataI->imagen;
            
        
                $count++;       
            }
            
        //die(var_dump($arrayResp));
        
        return json_encode($arrayResp);
    }

    public function actionProductoindividuale()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
     
        $nombrep=$_REQUEST["nombrep"];
        $nombrep=explode(" -",$_REQUEST["nombrep"]);
        //$nombrep[0]="167";
        $page = "site";
               $arrayResp = array();
        $count = 1;
        
        //die(var_dump($model));
 
            //$modelInventario = Productos::find()->where(['id' => str_replace("-","",$nombrep[0]) ])->orderBy(["fechacreacion" => SORT_DESC])->all();
            $model =  Inventario::find()->where(['id' =>  str_replace("-","",$nombrep[0])])->orderBy(["fechacreacion" => SORT_DESC])->all();
            //var_dump($modelInventario);
           /* if (!$modelInventario){
                $arrayResp[0]['id'] = $model->id;
                $arrayResp[0]['imagen'] = $model>imagen;
            }*/
              
            foreach ($model as $keyI => $dataI) {
            
                $arrayResp[$keyI]['titulo'] = $dataI->producto->nombreproducto;
                $arrayResp[$keyI]['descripcion'] = $dataI->producto->descripcion;
                $arrayResp[$keyI]['color'] = $dataI->color->nombre;
                $arrayResp[$keyI]['clasificacion'] = $dataI->clasificacion->nombre;
                $arrayResp[$keyI]['imagen'] = '<img style="width:20px;" src="/frontend/web/images/articulos/'.$dataI->producto->imagen.'"/>';
                //$arrayResp[$keyI]['imagen'] = '-';
                $arrayResp[$keyI]['stock'] = $dataI->stock;
                $arrayResp[$keyI]['cantidadini'] = $dataI->cantidadini;
                $arrayResp[$keyI]['cantidadcaja'] = $dataI->cantidadcaja;
                $arrayResp[$keyI]['precioint'] = $dataI->precioint;
                $arrayResp[$keyI]['preciov1'] = $dataI->preciov1;
                $arrayResp[$keyI]['preciov2'] = $dataI->preciov2;
                $arrayResp[$keyI]['preciovp'] = $dataI->preciovp;
                $arrayResp[$keyI]['codigobarras'] = $dataI->codigobarras;
                $arrayResp[$keyI]['codigocaja'] = $dataI->codigocaja;
                $arrayResp[$keyI]['usuariocreacion'] = $dataI->producto->usuariocreacion0->username;
                //$arrayResp[$keyI]['fechacreacion'] = "-";
                $arrayResp[$keyI]['id'] = $dataI->id;
                $arrayResp[$keyI]['imagen'] = $dataI->producto->imagen;
            
        
                $count++;       
            }
            
        //die(var_dump($arrayResp));
        
        return json_encode($arrayResp);
    }

    public function actionInventarioindividual()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $nombrep=$_REQUEST["nombrep"];
        $nombrep=explode(" -",$_REQUEST["nombrep"]);
        //$nombrep[0]="167";
        $page = "site";
               $arrayResp = array();
        $count = 1;
        //die(var_dump($model));
            //$modelInventario = Productos::find()->where(['id' => str_replace("-","",$nombrep[0]) ])->orderBy(["fechacreacion" => SORT_DESC])->all();
            $model =  Inventario::find()->where(['id' =>  str_replace("-","",$nombrep[0])])->orderBy(["fechacreacion" => SORT_DESC])->all();
            //var_dump($modelInventario);
           /* if (!$modelInventario){
                $arrayResp[0]['id'] = $model->id;
                $arrayResp[0]['imagen'] = $model>imagen;
            }*/
            foreach ($model as $keyI => $dataI) {
                $arrayResp[$keyI]['titulo'] = $dataI->producto->nombreproducto;
                $arrayResp[$keyI]['descripcion'] = $dataI->producto->descripcion;
                $arrayResp[$keyI]['color'] = $dataI->color->nombre;
                $arrayResp[$keyI]['clasificacion'] = $dataI->clasificacion->nombre;
                $arrayResp[$keyI]['sucursal'] = $dataI->sucursal->nombre;
                $arrayResp[$keyI]['imagen'] = '<img style="width:20px;" src="/frontend/web/images/articulos/'.$dataI->producto->imagen.'"/>';
                //$arrayResp[$keyI]['imagen'] = '-';
                $arrayResp[$keyI]['stock'] = $dataI->stock;
                $arrayResp[$keyI]['cantidadini'] = $dataI->cantidadini;
                $arrayResp[$keyI]['cantidadcaja'] = $dataI->cantidadcaja;
                $arrayResp[$keyI]['precioint'] = $dataI->precioint;
                $arrayResp[$keyI]['preciov1'] = $dataI->preciov1;
                $arrayResp[$keyI]['preciov2'] = $dataI->preciov2;
                $arrayResp[$keyI]['preciovp'] = $dataI->preciovp;
                $arrayResp[$keyI]['codigobarras'] = $dataI->codigobarras;
                $arrayResp[$keyI]['codigocaja'] = $dataI->codigocaja;
                $arrayResp[$keyI]['usuariocreacion'] = $dataI->producto->usuariocreacion0->username;
                //$arrayResp[$keyI]['fechacreacion'] = "-";
                $arrayResp[$keyI]['id'] = $dataI->id;
                $arrayResp[$keyI]['imagen'] = $dataI->producto->imagen;
                $count++;       
            }
        //die(var_dump($arrayResp));
        return json_encode($arrayResp);
    }
     
    public function actionFormeditarstock()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        //die(var_dump($_FILES));
        $data= new Inventario_stock;
        $data= $data->Editar($_POST);
        $response=$data;
        return json_encode($response);
    }

    public function actionStock2()
    {
        //echo 1;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=[];
        $model = new Inventario();
        if (isset($_POST) and !empty($_POST)) {
            $model = $this->findModel($_POST["id"]);
 
            
                    $data = $_POST;
                    $model->stock =$model->stock+ $data['stock'];
    
                    if ($model->save()) {
                        $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                    }else{
                        $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el registro.","resp" => false, "id" => "");
                    }
     
                    
        }  else{
            $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el registro.","resp" => false, "id" => "");
        }
        return json_encode($return); 
    }

    public function actionInventarioreg()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "inventario";
        $model = Productos::find()->where(['isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
        $arrayResp = array();
        $count = 0;
        foreach ($model as $key => $data) {
            $idProducto=0;
            $contProd=0;
           
            $modelInventario = Inventario::find()->where(['idproducto' => $data->id,'isDeleted' => '0'])->orderBy(["fechacreacion" => SORT_DESC])->all();
            foreach ($modelInventario as $keyI => $dataI) {
            
                    $arrayResp[$count]['num'] = $count+1;
                    $arrayResp[$count]['producto'] = $data->nombreproducto;
                    $arrayResp[$count]['imagen'] = '<img style="width:20px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                    //$arrayResp[$count]['imagen'] = '-';
                    $arrayResp[$count]['stock'] = $dataI->stock;
                    $arrayResp[$count]['pvp'] = $dataI->preciovp;
                    //$arrayResp[$count]['preciov2'] = $dataI->preciov2;
                    $arrayResp[$count]['codigo'] = $dataI->codigobarras;
                    $arrayResp[$count]['sucursal'] = $dataI->sucursal->nombre;
                    $arrayResp[$count]['tipo'] = $dataI->clasificacion->nombre;
                    //$arrayResp[$count]['presentacion'] = $dataI->presentacion->nombre;
                    //$arrayResp[$count]['color'] = $dataI->color->nombre;
                    //$arrayResp[$count]['calidad'] = $dataI->calidad->nombre;
                    $arrayResp[$count]['usuariocreacion'] = $dataI->usuariocreacion0->username;
                    $arrayResp[$count]['fechacreacion'] = $dataI->fechacreacion;
                    if ( $dataI->estatus  == 'ACTIVO') {
                       $arrayResp[$count]["estatus"]  = '<small class="badge badge-success"><i class="fa fa-circle"></i>&nbsp; ' . $dataI->estatus . '</small>';
                    } else{
                       $arrayResp[$count]["estatus"]  = '<small class="badge badge-secondary"><i class="fa fa-circle-thin"></i>&nbsp; ' . $dataI->estatus . '</small>';

                  }
             
                  $botones= new Botones;
                  $botonC=$botones->getBotongridArray(
                    array(
                      array('tipo'=>'link','nombre'=>'ver', 'id' => 'editar', 'titulo'=>'', 'link'=>'view'.$view.'?id='.$dataI->id, 'onclick'=>'' , 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'azul', 'icono'=>'ver','tamanio'=>'superp',  'adicional'=>''),
                      array('tipo'=>'link','nombre'=>'editar', 'id' => 'editar', 'titulo'=>'', 'link'=>'update'.$view.'?id='.$dataI->id, 'onclick'=>'', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'verdesuave', 'icono'=>'editar','tamanio'=>'superp', 'adicional'=>''),
                      array('tipo'=>'link','nombre'=>'eliminar', 'id' => 'editar', 'titulo'=>'', 'link'=>'','onclick'=>'deleteReg('.$dataI->id. ')', 'clase'=>'', 'style'=>'', 'col'=>'', 'tipocolor'=>'rojo', 'icono'=>'eliminar','tamanio'=>'superp', 'adicional'=>''),
                    )
                  );
                $arrayResp[$count]['acciones'] = '<div style="display:flex;">'.$botonC.'</div>' ;
        
        
                $count++;       
            }
            
        }
        
        return json_encode($arrayResp);
    }
    public function actionTransferenciaregistros()
    {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $page = "inventario";
    
            $modelInventario = Inventariotransfer::find()->orderBy(["fechacreacion" => SORT_DESC])->all();
            foreach ($modelInventario as $keyI => $dataI) {
                    $arrayResp[$keyI]['num'] = $count+1;
                    $arrayResp[$keyI]['titulo'] = $dataI->producto->nombreproducto;
                    //$arrayResp[$keyI]['imagen'] = '<img style="width:20px;" src="/frontend/web/images/articulos/'.$data->imagen.'"/>';
                    $arrayResp[$keyI]['imagen'] = '-';
                     
                    $arrayResp[$keyI]['sucursalo'] = $dataI->sucursalo->nombre;
                    $arrayResp[$keyI]['sucursald'] = $dataI->sucursald->nombre;
                    
                    $arrayResp[$keyI]['usuariocreacion'] = $dataI->usuariocreacion0->username;
                    $arrayResp[$keyI]['usuariorec'] = $dataI->usuariorec0->username;
                    $arrayResp[$keyI]['fechacreacion'] = $dataI->fechacreacion;
  
                    //$arrayResp[$keyI]['button'] = '<a href="' . URL::base() . '/' . $page . '/view?id=' . $dataI->id . '" title="Ver" class="btn btn-xs btn-primary btnedit"><i class="glyphicon glyphicon-eye-open"></i></a>'
                      //  . '&nbsp;<a href="' . URL::base() . '/' . $page . '/update?id=' . $dataI->id . '" title="Actualizar" class="btn btn-xs btn-info btnedit"><span class="glyphicon glyphicon-pencil"></span></a>'
                       // . '&nbsp;<button type="submit" alt="Eliminar" title="Eliminar" data-id="' . $dataI->id . '" data-name="' . $data->nombreproducto . '" onclick="deleteReg(this)" class="btn btn-xs btn-danger btnhapus">'
                       // . '<i class="glyphicon glyphicon-trash"></i></button>';
                    $arrayResp[$keyI]['button'] = '-';
                $count++;       
            }
        
        return json_encode($arrayResp);
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
    public function actionNuevo()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
 
        $sucursal = new Sistema_sucursal();
        $sucursal = $sucursal->getSelect();
        $clasificacion = new Inventario_clasificacion();
        $clasificacion = $clasificacion->getSelect();
        $calidad = new Inventario_calidad();
        $calidad = $calidad->getSelect();
        $color = new Inventario_colores();
        $color = $color->getSelect();
        $presentacion = new Inventario_presentacion();
        $presentacion = $presentacion->getSelect();
        
        $model = new Inventario();
        
            return $this->render('nuevo', [
                'presentacion' => $presentacion,
                'color' => $color,
                'calidad' => $calidad,
                'sucursal' => $sucursal,
                'clasificacion' => $clasificacion,
                //'flagDetail' => $flagDetail,
            ]);
        
    }
    public function actionNuevounidad()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $return=array();
        $presentaciones = Presentacion::find()->where(['isDeleted' => '0'])->orderBy(["nombre" => SORT_ASC])->all();
        $model = new Inventario();
        if (isset($_POST) and !empty($_POST)) {
         
                //echo 'OK';
                $data = $_POST;
                //Model header
                $model = new Inventario();
                $model->idproducto = $data['producto'];
                $model->idpresentacion = $data['presentacion'];
                $model->cantidadini = $data['stocki'];
                $model->cantidadcaja =  $data['stockf'];
                $model->stock =   $data['stock'];
                $model->precioint =  str_replace("$","",str_replace(",",".", $data['precioi'])); 
                $model->preciov1 =  str_replace("$","",str_replace(",",".",$data['preciov1'])); 
                $model->preciov2 =  str_replace("$","",str_replace(",",".",$data['preciov2'])); 
                $model->preciovp =  str_replace("$","",str_replace(",",".", $data['preciovp'])); 
                
                    
                    
                    
                $model->codigobarras =  $data['codigob'];
                $model->codigocaja =  $data['codigoc'];
                $model->usuariocreacion =   Yii::$app->user->identity->id;
                $saveModel=$model->save();
                //var_dump($_POST);
                $flagHeader = true;
                if ($saveModel) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el registro.","resp" => false, "id" => "");
                }
           
           
            return json_encode($return);
        } else {
            return $this->render('nuevounidad', [
                'presentaciones' => $presentaciones,
                //'flagDetail' => $flagDetail,
            ]);
        }
    }
    /**
     * Updates an existing QuinielaHead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionFormnuevostock()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        extract($_POST);
        //die(var_dump($_FILES));
        $data= new Inventario_stock;
        $data= $data->Nuevo($_POST);
        $response=$data;
        return json_encode($response);

    }


    public function actionInventariotransfer()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $sucursal = Sucursal::find()->where(['isDeleted' => '0'])->orderBy(["nombre" => SORT_ASC])->all();
                  
        if (isset($_POST) and !empty($_POST)) {
            $model = $this->findModel($_POST['producto']);
            $data = $_POST;
            if ($model->stock==$data['stock'])
            {
                $sucursalo=$model->idsucursal;
                $model->idsucursal=$data['sucursal'];
                if ($model->save()) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                    $modelNew= New inventariotransfer();
                    $modelNew->idinventario =$data['producto'];
                    $modelNew->idproducto =$model->idproducto;
                    $modelNew->idpresentacion =$model->idpresentacion;
                    $modelNew->idcolor =$model->idcolor;
                    $modelNew->idsucursalo =$sucursalo;
                    $modelNew->idsucursald =$data['sucursal'];
                    $modelNew->idcalidad =$model->idcalidad;
                    $modelNew->idclasificacion =$model->idclasificacion;
                    $modelNew->stock =$model->stock;
                    $modelNew->precioint =$model->precioint;
                    $modelNew->preciov1 =$model->preciov1;
                    $modelNew->preciov2 =$model->preciov2;
                    $modelNew->preciovp =$model->preciovp;
                    $modelNew->codigobarras =$model->codigobarras;
                    $modelNew->codigocaja =$model->codigocaja;
                    $modelNew->usuariocreacion =Yii::$app->user->identity->id;
                    $modelNew->usuariorec =$data['usuario'];
                    $saveModel=$modelNew->save();
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido transferir el registro.","resp" => false, "id" => "");
                }
            }else{
                $model->stock=$model->stock-$data['stock'];
                $sucursalini=$model->idsucursal;
                $saveI=$model->save();
                $model = $this->findModel($_POST['producto']);
                if ($saveI){
                    $modelNew= New inventario();
                    $modelNew->idproducto =$model->idproducto;
                    $modelNew->idpresentacion =$model->idpresentacion;
                    $modelNew->idcolor =$model->idcolor;
                    $modelNew->idsucursal =$data['sucursal'];
                    $modelNew->idcalidad =$model->idcalidad;
                    $modelNew->idclasificacion =$model->idclasificacion;
                    $modelNew->cantidadini =$model->cantidadini;
                    $modelNew->cantidadcaja =$model->cantidadcaja;
                    $modelNew->stock =$data['stock'];
                    $modelNew->precioint =$model->precioint;
                    $modelNew->preciov1 =$model->preciov1;
                    $modelNew->preciov2 =$model->preciov2;
                    $modelNew->preciovp =$model->preciovp;
                    $modelNew->codigobarras =$model->codigobarras;
                    $modelNew->codigocaja =$model->codigocaja;
                    $modelNew->usuariocreacion =$model->usuariocreacion;
                    $saveModel=$modelNew->save();
                    //die(var_dump($modelNew->id));
                    //$flagHeader = true;
                    if ($saveModel) {
                        $model = $this->findModel($modelNew->id);
                        $modelNewI= New inventariotransfer();
                        $modelNewI->idinventario =$data['producto'];
                        $modelNewI->idproducto =$model->idproducto;
                        $modelNewI->idpresentacion =$model->idpresentacion;
                        $modelNewI->idcolor =$model->idcolor;
                        $modelNewI->idsucursalo =$sucursalini;
                        $modelNewI->idsucursald =$data['sucursal'];
                        $modelNewI->idcalidad =$model->idcalidad;
                        $modelNewI->idclasificacion =$model->idclasificacion;
                        $modelNewI->stock =$model->stock;
                        $modelNewI->precioint =$model->precioint;
                        $modelNewI->preciov1 =$model->preciov1;
                        $modelNewI->preciov2 =$model->preciov2;
                        $modelNewI->preciovp =$model->preciovp;
                        $modelNewI->codigobarras =$model->codigobarras;
                        $modelNewI->codigocaja =$model->codigocaja;
                        $modelNewI->usuariocreacion =Yii::$app->user->identity->id;
                        $modelNewI->usuariorec =$data['usuario'];
                        $saveModel=$modelNewI->save();
                        $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                        //die(var_dump($modelNewI->errors));
                        // die(var_dump($modelNew->errors));
                    }else{
                        $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el registro.","resp" => false, "id" => "");
                    }
                }else{
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el registro.","resp" => false, "id" => "");
                }
                
            }
            
            
             return json_encode($return);
        } else {
            $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el registro.","resp" => false, "id" => "");
           return json_encode($return);
        }
    }
     
    public function actionUpdate($id)
    {
        
        if (Yii::$app->user->isGuest) {
            return $this->redirect(URL::base() . "/site/login");
        }
        $presentaciones = Presentacion::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_ASC])->all();
        $color = Color::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_ASC])->all();
        $calidad = Calidad::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_ASC])->all();
        $sucursal = Sucursal::find()->where(['isDeleted' => '0'])->orderBy(["nombre" => SORT_ASC])->all();
        $clasificacion = Clasificacion::find()->where(['isDeleted' => '0'])->orderBy(["id" => SORT_ASC])->all();
        $model = new Inventario();
        if (isset($_POST) and !empty($_POST)) {
            $model = $this->findModel($id);
 
            
                    $data = $_POST;
                    
                    
                $model->idpresentacion = $data['presentacion'];
                $model->idcalidad = $data['calidad'];
                $model->idclasificacion = $data['clasificacion'];
                $model->idcolor = $data['color'];
                $model->idsucursal = $data['sucursal'];
                $model->cantidadini = $data['stocki'];
                $model->cantidadcaja =  $data['stockf'];
                $model->stock =   $data['stock'];
                $model->precioint =  str_replace("$","",str_replace(",",".", $data['precioi'])); 
                $model->preciov1 =  str_replace("$","",str_replace(",",".",$data['preciov1'])); 
                $model->preciov2 =  str_replace("$","",str_replace(",",".",$data['preciov2'])); 
                $model->preciovp =  str_replace("$","",str_replace(",",".", $data['preciovp'])); 
                
                    
                    
                    
                $model->codigobarras =  $data['codigob'];
                $model->codigocaja =  $data['codigoc'];
                    
                    $model->estatus =  $data['estado'];
                    if ($model->save()) {
                        $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                    }else{
                        $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el registro.","resp" => false, "id" => "");
                    }
     
             return json_encode($return);
        } else {
            $model = $this->findModel($id);
            $flagDetail = false;
            $modelDetail = array();
            return $this->render('update', [
                 
                'model' => $model,
                'presentaciones' => $presentaciones,
                'color' => $color,
                'calidad' => $calidad,
                'sucursal' => $sucursal,
                'clasificacion' => $clasificacion,
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
        if (($model = Inventario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
