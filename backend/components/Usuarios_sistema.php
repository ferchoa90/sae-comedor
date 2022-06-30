<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Roles;
use common\models\Rolespermisos;
use common\models\Rolesusuario;
use backend\components\Log_errores;
use backend\models\User;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/12/21
 * Time: 11:47
 */

class Usuarios_sistema extends Component
{
    const MODULO='USUARIOS';
    public function getUsuarios($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= User::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= User::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getUsuario($id,$condicion=NULL,$itemsret=NULL)
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

    public function Nuevo($usuario)
    {
        //$date = date("Y-m-d H:i:s");
        $idusuario=0;
        $idmodulo=0;
        $modelUsuario= new User;
        $result=false;
        if ($usuario):
            $data = $usuario;
            $modelUsuario->password_hash=Yii::$app->getSecurity()->generatePasswordHash($data['clave']);
            $modelUsuario->nombres=$data['nombres'];
            $modelUsuario->apellidos=$data['apellidos'];
            $modelUsuario->username=$data['nombreusuario'];
            $modelUsuario->auth_key='qBsm2pBnvWqODXkw8497oMu6BCKknip-';
            $modelUsuario->email=$data['correo'];
            $modelUsuario->idsucursal=1;
            $modelUsuario->idrol=$data['rol'];
            $modelUsuario->cedula=$data['cedula'];
            //$modelUsuario->estatus="Activo";
            $modelUsuario->fotoperfil="user2-160x160.png";
            $modelUsuario->status=10;
            $modelUsuario->isDeleted=0;
            $modelUsuario->creado_por=Yii::$app->user->identity->id;
            $modelUsuario->created_at=Yii::$app->user->identity->id;
            $modelUsuario->updated_at=Yii::$app->user->identity->id;

            if ($modelUsuario->save()) {
                $rolusuario= new Rolesusuario;
                $rolusuario->idrol=$data['rol'];
                $rolusuario->isDeleted=0;
                $rolusuario->idusuario=$modelUsuario->id;
                $rolusuario->usuariocreacion=Yii::$app->user->identity->id;
                $idusuario=$modelUsuario->id;
                if ($rolusuario->save()){
                    $error=false;
                    //$this->callback(1,$idusuario,$modelUsuario->errors);
                    return array("response" => true, "id" => $modelUsuario->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
                }else{
                    $this->callback(1,$idusuario,$rolusuario->errors);
                    return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
                }

            } else {
                $this->callback(1,$idusuario,$modelUsuario->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Usuarios_sistema ",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Editar($data)
    {
        //$date = date("Y-m-d H:i:s");
        $idusuario=0;
        $idmodulo=0;
        $model= User::find()->where(["id"=>$data['id']])->one();
        $result=false;
        if ($data):
            if ($data['contra']){
                $model->password_hash=Yii::$app->getSecurity()->generatePasswordHash($data['contra']);
            }
            $model->nombres=$data['nombres'];
            $model->apellidos=$data['apellidos'];
            $model->username=$data['nusuario'];
            $model->auth_key='qBsm2pBnvWqODXkw8497oMu6BCKknip-';
            $model->email=$data['correo'];
            $model->idsucursal=$data['sucursal'];
            $model->idrol=$data['rol'];
            $model->cedula=$data['cedula'];
            //$model->estatus="Activo";
            $model->fotoperfil="user2-160x160.png";
            $model->status=10;
            $model->isDeleted=0;
            //$model->creado_por=Yii::$app->user->identity->id;
            //$model->created_at=Yii::$app->user->identity->id;
            $model->updated_at=Yii::$app->user->identity->id;

            if ($model->save()) {
                return array("response" => true, "id" => $model->id, "mensaje"=> "Registro actualizado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$idusuario,$model->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al actulizar el registro","tipo"=>"error", "success"=>false);
            }
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Usuarios_sistema ",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
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