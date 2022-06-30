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
use common\models\Citasmedicas;
use backend\models\User;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 13/03/21
 * Time: 14:55
 */

class Medico_citas extends Component
{
    const MODULO='CITAS';

    public function getCitas($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Citasmedicas::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Citasmedicas::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getCitamedica($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Citasmedicas::find()->where(["id"=>$id])->one();
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
        $model= new Citasmedicas;
        $result=false;
        if ($data):
            $model->idusuario=$data['paciente'];
            $model->fechacita=$data['fecha'];
            $model->horacita=$data['hora'];
            $model->iddoctor=$data['doctor'];
            $model->observacion=$data['observacion'];
            $model->idoptometrista=$data['optometrista'];
            $model->tipocita=$data['tipocita'];
            $model->usuariocreacion=Yii::$app->user->identity->id;
            $model->estatuscita="AGENDADA";
            $model->estatus="ACTIVO";
            $model->isDeleted=0;
            if ($model->save()) {
                $idusuario=$model->id;
                $error=false;
                //$this->callback(1,$idusuario,$model->errors);
                return array("response" => true, "id" => $model->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$idusuario,$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Medico_citas ",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Editar($data)
    {
        $id=0;
        $result=false;
        //var_dump($data);
        if ($data):
            $model = Citasmedicas::find()->where(["id"=>$data['idcita']])->one();
            $model->idusuario=$data['paciente'];
            $model->fechacita=$data['fecha'];
            $model->horacita=$data['hora'];
            $model->iddoctor=$data['doctor'];
            $model->tipocita=$data['tipocita'];
            $model->idoptometrista=$data['optometrista'];
            $model->observacion=$data['observacion'];
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
            $log->Nuevo(self::MODULO." :: Medico_citas -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
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
            $data= Citasmedicas::find()->where(["id"=>$id])->one();
            $data->isDeleted=1;
            if ($data->save()) {
                $error=false;
                return array("response" => true, "id" => $data->id, "mensaje"=> "Registro eliminado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$data->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO ID";
            $log->Nuevo(self::MODULO." :: Medico_citas -> eliminar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al eliminar el registro","tipo"=>"error", "success"=>false);
    }

    public function estatus($estatus)
    {
        $style="";

        switch ($estatus) {
            case 'AGENDADA':
                $stylestatuscit='badge-primary';
                break;

            case 'CONFIRMADA':
                $stylestatuscit='badge-success';
                break;

            case 'REENVIADO':
                $stylestatuscit='badge-primary';
                break;

            case 'CANCELADA':
                $stylestatuscit='badge-danger';
                break;

            case 'ATENDIDA':
                $stylestatuscit='badge-secondary';
                break;

            case 'EN ATENCIÓN':
                $stylestatuscit='badge-info';
                break;

            case 'REAGENDADA':
                $stylestatuscit='badge-info';
                break;

            default:
                # code...
                break;
        }
        return $style;
    }

    public function callback($tipo,$id,$error)
    {
        switch ($tipo) {
            case 1:
                $log= new Log_errores;
                $observacion="ID: ".$id;
                $log->Nuevo(self::MODULO,$error,$observacion,0,Yii::$app->user->identity->id);
                //return true;
                break;

            default:
                # code...
                break;
        }
    }



}