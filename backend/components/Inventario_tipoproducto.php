<?php
namespace backend\components;
use Yii;
use common\models\Configuracion;
use common\models\Tipoproducto;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Roles;
use common\models\Rolespermisos;
use backend\components\Log_errores;
use backend\models\User;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 21/03/21
 * Time: 10:42
 */

class Inventario_tipoproducto extends Component
{
    private const MODULO='INVENTARIO - TIPO PRODUCTO';

    public function getTipoproductoes($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $response= Tipoproducto::find()->where(["isDeleted"=>0])->all();
        }else{
            $response= Tipoproducto::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getTipoproducto($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Tipoproducto::find()->where(["id"=>$id])->one();
            if ($result)
            {
                //$result=$result["nombres"].' '.$result["apellidos"].')';
                return $result;
            }else{
                $result="NINGUNO";
            }
        }else{
            $result= false;
        }
        return $result;
    }

    public function getSelect()
    {
        $model = Tipoproducto::find()->where(["isDeleted" =>0,"estatus"=>"ACTIVO"])->orderBy(["nombre" => SORT_ASC])->all();
        //var_dump($model);
        $modelArray=array();
        $cont=0;
        foreach ($model as $key => $value) {
            if ($cont==0){ $modelArray[$cont]["value"]="Seleccione un tipo de producto"; $modelArray[$cont]["id"]=-1; $cont++; }
            $modelArray[$cont]["value"]=$value->nombre;
            $modelArray[$cont]["id"]=$value->id;
            $cont++;
        }
        return $modelArray;

    }

    public function Nuevo($data)
    {
        //$date = date("Y-m-d H:i:s");
        $id=0;
        $model= new Tipoproducto;
        $result=false;
        if ($data):
          
                //Model header
                $model->nombreproducto = $data['nombre'];
                $model->descripcion = $data['descripcion'];
                $model->imagen = $uploadFile["Nombrearchivo"];
                $model->idempresa = 1;
                $model->idproveedor = $data['proveedor'];
                $model->tipoproducto = $data['tipoproducto'];
                $model->marca = $data['marca'];
                $model->usuariocreacion = Yii::$app->user->identity->id;
                $model->modelo = 1;
                $model->color = 0;
                $model->isDeleted = 0;
                $model->estatus =  "ACTIVO";
                
                //var_dump($_POST);
                
                if ($model->save()) {
                    $return=array("success"=>true,"Mensaje"=>"OK","resp" => true, "id" => $model->id);
                }else{
                    //var_dump($model->errors);
                    $return=array("success"=>false,"Mensaje"=>"No se ha podido ingresar el producto.","resp" => false, "id" => "");
                }
           
            if ($dataModel->save()) {
                $id=$dataModel->id;
                $error=false;
                return array("response" => true, "id" => $dataModel->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$dataModel->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Inventario_productos",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Editar($data)
    {
        //$date = date("Y-m-d H:i:s");
        $id=0;
        $result=false;
        if ($data):
            //$data = $usuario;
            $dataModel= Tipoproducto::find()->where(["id"=>$data['id']])->one();
            $dataModel->nombre=$data['nombres'];
            $dataModel->usuarioact=Yii::$app->user->identity->id;
            $dataModel->fechaact= date("Y-m-d H:i:s");
            if ($dataModel->save()) {
                $error=false;
                return array("response" => true, "id" => $dataModel->id, "mensaje"=> "Registro actualizado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$dataModel->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizado el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Medico_consultorio -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizado el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizado el registro","tipo"=>"error", "success"=>false);
    }

    public function Eliminar($id)
    {
        //$date = date("Y-m-d H:i:s");
        $result=false;
        if ($id):
            //$data = $usuario;
            $dataModel= Tipoproducto::find()->where(["id"=>$id])->one();
            $dataModel->isDeleted=1;
            if ($dataModel->save()) {
                $error=false;
                return array("response" => true, "id" => $dataModel->id, "mensaje"=> "Registro eliminado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$dataModel->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO ID";
            $log->Nuevo(self::MODULO." :: Inventario_productos -> eliminar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
    }

    public function callback($tipo,$id,$error)
    {
        switch ($tipo) {
            case 1:
                $log= new Log_errores;
                $observacion="ID: ".$id;
                $log->Nuevo(self::MODULO." ",$error,$observacion,0,Yii::$app->user->identity->id);
                //return true;
                break;

            default:
                # code...
                break;
        }
    }



}