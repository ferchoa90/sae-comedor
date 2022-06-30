<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Roles;
use common\models\Rolespermisos;
use common\models\Rolesmodulo;
use common\models\Rolessubmodulo;
use backend\components\Log_errores;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/12/21
 * Time: 11:47
 */

class Usuarios_roles extends Component
{

    public function getRoles($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getPermiso($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Cuentas::find()->where(["codigoant"=>$id])->one();
            if ($result)
            {
                $result=$result["codigoant"].' ('.$result["nombre"].')';
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
        $idrol=0;
        $idmodulo=0;
        $modelRol= new Roles;
        $result=false;
        if ($data):
            $modelRol->nombre=$data["nombrerol"];
            $modelRol->descripcion=$data["descripcion"];
            $modelRol->usuariocreacion=Yii::$app->user->identity->id;
            //$modelRol->fechacreacion=$data->idfactura;
            $modelRol->isDeleted=0;
            $modelRol->estatus="ACTIVO";
            //var_dump($data);
            $error=false;
            if ($modelRol->save()):
                $idrol=$modelRol->id;
                $todosModulos=Rolesmodulo::find()->where(["isDeleted"=>0, "estatus"=>"ACTIVO"])->all();
                $todossubModulos=Rolessubmodulo::find()->where(["isDeleted"=>0, "estatus"=>"ACTIVO"])->all();

                foreach ($todosModulos as $key => $value) {

                    if (@$data[$value->nameint]=='on'){
                        $newRolpermiso=new Rolespermisos;
                        $newRolpermiso->idrol=$modelRol->id;
                        $newRolpermiso->idmodulo=$value->id;
                        $newRolpermiso->isDeleted=0;
                        $newRolpermiso->usuariocreacion=Yii::$app->user->identity->id;
                        $newRolpermiso->estatus='ACTIVO';
                        if (!$newRolpermiso->save()){
                            //var_dump($newRolpermiso->errors);
                        }
                    }else{}
                }
                //var_dump($todosModulos);
                //die();
                foreach ($todossubModulos as $key => $value) {
                    if (@$data[$value->nombreint]=='on'){
                        $newRolpermiso=new Rolespermisos;
                        $newRolpermiso->idrol=$modelRol->id;
                        $newRolpermiso->idmodulo=$value->idmodulo;
                        $newRolpermiso->idsubmodulo=$value->id;
                        $newRolpermiso->isDeleted=0;
                        $newRolpermiso->usuariocreacion=Yii::$app->user->identity->id;
                        $newRolpermiso->estatus='ACTIVO';
                        if (!$newRolpermiso->save()){
                            //var_dump($newRolpermiso->errors);
                        }
                    }else{}
                }
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
            $model= Roles::find()->where(["id"=>$data['id']])->one();
            if ($data['id']){
                //$model= Rolesmodulo::find()->where(["id"=>$data['id']])->one();
                $model->nombre=$data['nombrerol'];
                $model->descripcion=$data['descripcion'];
                $model->usuarioact=Yii::$app->user->identity->id;
                $model->fechaact= date("Y-m-d H:i:s");
                if ($model->save()) {
                    $delSubmodulo=$modelRolpermiso= Rolespermisos::deleteAll(["idrol"=>$model->id]);
                    $permisosSubmodulo=new Rolespermisos;
                    $todosModulos=Rolesmodulo::find()->where(["isDeleted"=>0, "estatus"=>"ACTIVO"])->all();
                    $todossubModulos=Rolessubmodulo::find()->where(["isDeleted"=>0, "estatus"=>"ACTIVO"])->all();
                    foreach ($todosModulos as $key => $value) {
                        if (@$data[$value->nameint]=='on'){
                            $newRolpermiso=new Rolespermisos;
                            $newRolpermiso->idrol=$model->id;
                            $newRolpermiso->idmodulo=$value->id;
                            $newRolpermiso->isDeleted=0;
                            $newRolpermiso->usuariocreacion=Yii::$app->user->identity->id;
                            $newRolpermiso->estatus='ACTIVO';
                            if (!$newRolpermiso->save()){
                                //var_dump($newRolpermiso->errors);
                            }
                        }
                    }

                    foreach ($todossubModulos as $key => $value) {
                        if (@$data[$value->nombreint]=='on'){
                            $newRolpermiso=new Rolespermisos;
                            $newRolpermiso->idrol=$model->id;
                            $newRolpermiso->idmodulo=$value->idmodulo;
                            $newRolpermiso->idsubmodulo=$value->id;
                            $newRolpermiso->isDeleted=0;
                            $newRolpermiso->usuariocreacion=Yii::$app->user->identity->id;
                            $newRolpermiso->estatus='ACTIVO';
                            if (!$newRolpermiso->save()){
                                //var_dump($newRolpermiso->errors);
                            }
                        }
                    }

                    $error=false;
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
                // callback para la función nuevo
                //$modelRolpermiso= Rolespermisos::deleteAll(["idrol"=>$id]);
                //$modelRolpermiso->delete();

                $modelRol= Roles::find()->where(["id"=>$id])->one();
                //$modelRol->delete();

                $log= new Log_errores;
                $observacion="ID: ".$id;
                $log->Nuevo("ROLES",$error,$observacion,0,Yii::$app->user->identity->id);

                return true;
                break;

            default:
                # code...
                break;
        }
    }



}