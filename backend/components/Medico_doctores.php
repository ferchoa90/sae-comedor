<?php
namespace backend\components;
use Yii;
use common\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Roles;
use common\models\Rolespermisos;
use backend\components\Log_errores;
use common\models\Doctores;
use backend\models\User;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 13/03/21
 * Time: 14:55
 */

class Medico_doctores extends Component
{
    const MODULO='DOCTORES';

    public function getDoctores($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Doctores::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Doctores::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getDoctor($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Doctores::find()->where(["id"=>$id])->one();
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
        $idusuario=0;
        $idmodulo=0;
        $model= new Doctores;
        $result=false;
        if ($data):
            //$data = $usuario;
            $model->cedula=$data['cedula'];
            $model->apellidos=$data['apellidos'];
            $model->nombres=$data['nombres'];
            $model->direccion=$data['direccion'];
            $model->fechanac=$data['fechanac'];
            $model->tiposangre=$data['tiposangre'];
            $model->idprofesion=$data['profesion'];
            $model->correo=$data['correo'];
            $model->isDeleted=0;
            $model->idususistem=0;
            $model->usuariocreacion=Yii::$app->user->identity->id;
            $model->estatus='ACTIVO';


            if ($model->save()) {
                $idusuario=$model->id;
                $error=false;
                //$this->callback(1,$idusuario,$model->errors);
                return array("response" => true, "id" => $model->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Medico_doctores",$error,$observacion,0,Yii::$app->user->identity->id);
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
            $model= Doctores::find()->where(["id"=>$data['id']])->one();
            $model->cedula=$data['cedula'];
            $model->apellidos=$data['apellidos'];
            $model->nombres=$data['nombres'];
            $model->idprofesion=$data['profesion'];
            $model->direccion=$data['direccion'];
            $model->fechanac=$data['fechanac'];
            $model->tiposangre=$data['tiposangre'];
            $model->correo=$data['correo'];
            $model->usuarioact=Yii::$app->user->identity->id;
            $model->fechaact= date("Y-m-d H:i:s");
            if ($model->save()) {
                $error=false;
                return array("response" => true, "id" => $model->id, "mensaje"=> "Registro actualizado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Medico_doctores -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
    }

    public function Eliminar($id)
    {
        //$date = date("Y-m-d H:i:s");
        $result=false;
        if ($id):
            //$data = $usuario;
            $dataModel= Doctores::find()->where(["id"=>$id])->one();
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
            $log->Nuevo(self::MODULO." :: Medico_doctores -> eliminar",$error,$observacion,0,Yii::$app->user->identity->id);
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