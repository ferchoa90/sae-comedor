<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Clasificacion;
use common\models\Empresa;
use backend\components\Log_errores;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 06/05/22
 * Time: 11:20
 */

class Inventario_clasificacion extends Component
{
    const MODULO='CLASIFICACIÓN';
    public function getClasificaciones($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Clasificacion::find()->where(["isDeleted"=>0])->orderBy(["nombre"=>SORT_DESC])->all();
        }else{
            $asiento= Clasificacion::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getClasificacion($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Clasificacion::find()->where(["id"=>$id])->one();
            if ($result)
            {
                $result=$result["id"].' ('.$result["nombre"].')';
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
        $model = Clasificacion::find()->where(["isDeleted"=>0,"estatus"=>"ACTIVO"])->orderBy(["nombre" => SORT_DESC])->all();
        //var_dump($model);
        $modelArray=array();
        $cont=0;
        foreach ($model as $key => $value) {
            if ($cont==0){ $modelArray[$cont]["value"]="Seleccione un color"; $modelArray[$cont]["id"]=-1; $cont++; }
            $modelArray[$cont]["value"]=$value->nombre;
            $modelArray[$cont]["id"]=$value->id;
            $cont++;
        }
        return $modelArray;

    }

    public function Nuevo($data)
    {
        //$date = date("Y-m-d H:i:s");
        $idrol=0;
        $idmodulo=0;
        $model= new Clasificacion;
        $result=false;
        if ($data):
            $model->idempresa=$data["empresa"];
            $model->nombre=$data["nombre"];
            $model->direccion=$data["direccion"];
            $model->usuariocreacion=Yii::$app->user->identity->id;
            //$modelRol->fechacreacion=$data->idfactura;
            $model->isDeleted=0;
            $model->estatus="ACTIVO";
            $error=false;
            if ($model->save()):
                $idrol=$model->id;
                return array("response" => true, "id" => $modelRol->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
            else:
                //var_dump($modelRol->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            endif;
        else:
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;
        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Editar($data)
    {
        $id=0;
        $result=false;
        if ($data):
            $model= Clasificacion::find()->where(["id"=>$data['id']])->one();
            if ($data['id']){
                //$model= Rolesmodulo::find()->where(["id"=>$data['id']])->one();
                $model->idempresa=$data["empresa"];
                $model->nombre=$data["nombre"];
                $model->direccion=$data["direccion"];
                $model->isDeleted=0;
                $model->usuarioact=Yii::$app->user->identity->id;
                $model->fechaact= date("Y-m-d H:i:s");
                if ($model->save()) {
                    return array("response" => true, "id" => $model->id, "mensaje"=> "Registro actualizado","tipo"=>"success", "success"=>true);


                } else {
                    $this->callback(1,$data['id'],$model->errors);
                    return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
                }
            }else{
                $this->callback(1,$data['id'],$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);

            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: configuraciones_rolesmodulo -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
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