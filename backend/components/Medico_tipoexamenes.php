<?php
namespace backend\components;
use Yii;
use common\models\Configuracion;
use common\models\Tipoexamenes;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Roles;
use common\models\Rolespermisos;
use backend\components\Log_errores;
use backend\models\User;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 20/03/21
 * Time: 18:19
 */

class Medico_tipoexamenes extends Component
{

    public function getTipoexamenes($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $response= Tipoexamenes::find()->where(["isDeleted"=>0])->all();
        }else{
            $response= Tipoexamenes::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getTipoexamen($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Tipoexamenes::find()->where(["id"=>$id])->one();
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

    public function Nuevo($data)
    {
        //$date = date("Y-m-d H:i:s");
        $id=0;
        $dataModel= new Tipoexamenes;
        $result=false;
        if ($data):
            //$data = $usuario;
            $dataModel->nombre=$data['nombres'];
            $dataModel->descripcion=$data['descripcion'];
            $dataModel->valor=$data['valor'];
            $dataModel->isDeleted=0;
            $dataModel->usuariocreacion=Yii::$app->user->identity->id;
            $dataModel->estatus="ACTIVO";
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
            $log->Nuevo("TIPOS EXAMENES :: Medico_tipoexamenes",$error,$observacion,0,Yii::$app->user->identity->id);
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
            $dataModel= Tipoexamenes::find()->where(["id"=>$data['id']])->one();
            $dataModel->nombre=$data['nombres'];
            $dataModel->descripcion=$data['descripcion'];
            $dataModel->valor=$data['valor'];
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
            $log->Nuevo("TIPOS EXAMENES :: Medico_tipoexamenes -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizado el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizado el registro","tipo"=>"error", "success"=>false);
    }

    public function callback($tipo,$id,$error)
    {
        switch ($tipo) {
            case 1:
                $log= new Log_errores;
                $observacion="ID: ".$id;
                $log->Nuevo("TIPOS EXAMENES ",$error,$observacion,0,Yii::$app->user->identity->id);
                //return true;
                break;

            default:
                # code...
                break;
        }
    }



}