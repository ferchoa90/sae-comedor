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
use common\models\Ciudades;
use backend\models\User;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 13/03/21
 * Time: 14:55
 */

class General_Ciudades extends Component
{
    const MODULO='CIUDADES';

    public function getCiudades($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Ciudades::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Ciudades::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getCiudad($id,$condicion=NULL,$itemsret=NULL,$idprovincia=0,$idpais=1)
    {
        $result=array();
        if ($id){
            $result= Ciudades::find()->where(["id"=>$id,"idpais"=>$idpais])->one();
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
        $model= new Ciudades;
        $result=false;
        if ($data):
            //$data = $usuario;
            $model->nombre=$data['nombre'];
            $model->idpais=$data['pais'];
            $model->idprovincia=$data['provincia'];
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
            $log->Nuevo(self::MODULO." :: General_ciudades",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function getSelect()
    {
        $clientes = Ciudades::find()->where("isDeleted = 0")->orderBy(["nombre" => SORT_ASC])->all();
        //var_dump($clientes);
        $clientesArray=array();
        $cont=0;
        foreach ($clientes as $key => $value) {
            if ($cont==0){ $clientesArray[$cont]["value"]="Seleccione una ciudad"; $clientesArray[$cont]["id"]=-1; $cont++; }
            $clientesArray[$cont]["value"]=$value->nombre;
            $clientesArray[$cont]["id"]=$value->id;
            $cont++;
        }
        return $clientesArray;

    }

    public function Editar($data)
    {
        //$date = date("Y-m-d H:i:s");
        $id=0;
        $result=false;
        if ($data):
            //$data = $usuario;
            $model= Ciudades::find()->where(["id"=>$data['id']])->one();
            $model->nombre=$data['nombre'];
            $model->idpais=$data['pais'];
            $model->idprovincia=$data['provincia'];
            $model->usuarioact=Yii::$app->user->identity->id;
            $model->fechaact= date("Y-m-d H:i:s");
            if ($model->save()) {
                $error=false;
                return array("response" => true, "id" => $model->id, "mensaje"=> "Registro actualizado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizado el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: General_ciudades -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
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
            $dataModel= Ciudades::find()->where(["id"=>$id])->one();
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
            $log->Nuevo(self::MODULO." :: General_ciudades -> eliminar",$error,$observacion,0,Yii::$app->user->identity->id);
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