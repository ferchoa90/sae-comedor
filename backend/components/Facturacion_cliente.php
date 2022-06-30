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
use common\models\Clientes;
use common\models\Consultamedica;
use common\models\Citasmedicas;
use backend\models\User;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 13/03/21
 * Time: 14:55
 */

class Facturacion_cliente extends Component
{
    const MODULO='CLIENTE';

    public function getClientes($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Clientes::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Clientes::find()->where(["isDeleted"=>0])->one();
        }
    }
 
    public function getSelect()
    {
        $clientes = Clientes::find()->where(["isDeleted" => 0])->orderBy(["razonsocial" => SORT_ASC])->all();
        //var_dump($clientes);
        $clientesArray=array();
        $cont=0;
        foreach ($clientes as $key => $value) {
            if ($cont==0){ $clientesArray[$cont]["value"]="Seleccione un cliente"; $clientesArray[$cont]["id"]=-1; $cont++; }
            $clientesArray[$cont]["value"]=$value->razonsocial;
            $clientesArray[$cont]["id"]=$value->id;
            $cont++;
        }
        return $clientesArray;

    }

    public function Validacion($data)
    {
        $model = Clientes::find()->where(["cedula" => $data["identificacion"] ])->one();
        if ($model){ return array("response" => true, "id" => $model->id, "mensaje"=> "Ya existe la cédula ingresada","tipo"=>"error", "success"=>false); }
        $model = Clientes::find()->where(["correo" => $data["correo"] ])->one();
        if ($model){ return array("response" => true, "id" => $model->id, "mensaje"=> "Ya existe el correo ingresado","tipo"=>"error", "success"=>false); }
        
        return array("response" => true, "id" => 0, "mensaje"=> "OK","tipo"=>"error", "success"=>true);
    }

    public function Nuevo($data)
    {
        //$date = date("Y-m-d H:i:s");
        $idusuario=0;
        $idmodulo=0;
        $model= new Clientes;
        $result=false;
        if ($data):
            if ($data['tipoident']==1){ $model->tipo="N"; }else{ $model->tipo="R";}
            $model->tipoidentificacion=$data['tipoident'];
            $model->cedula=$data['identificacion'];
            $model->razonsocial=$data['razonsocial'];
            $model->razoncomercial=$data['razoncomercial'];
            $model->direccion=$data['direccion'];
            $model->genero=$data['genero'];
            $model->credito=0;
            if (@$data['credito']=='on'){ $model->credito=1; }
            $model->cupocredito=$data['cupocredito'];
            $model->correo=$data['correo'];
            $model->usuariocreacion=Yii::$app->user->identity->id;
            $model->estatus="ACTIVO";
            $model->isDeleted=0;

            $validacion=$this->Validacion($data);
            //die(var_dump($validacion));
            if ($validacion["success"]){
                if ($model->save()) {
                    $idusuario=$model->id;
                    $error=false;
                    //$this->callback(1,$idusuario,$model->errors);
                    return array("response" => true, "id" => $model->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
                } else {
                    $this->callback(1,$idusuario,$model->errors);
                    return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
                }
            }else{
                return array("response" => true, "id" => $validacion["id"], "mensaje"=> $validacion["mensaje"],"tipo"=>"error", "success"=>false);    
            }
            
        else:
            $log= new Log_errores;
            $observacion="ID: 0";
            $error="NO POST";
            $log->Nuevo(self::MODULO." :: Factura_cliente ",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Editar($data)
    {
        $id=0;
        $result=false;
        if ($data):
            $model= Clientes::find()->where(["id"=>$data['id']])->one();
            if ($data['tipoident']==1){ $model->tipo="N"; }else{ $model->tipo="R";}
            $model->tipoidentificacion=$data['tipoident'];
            $model->cedula=$data['identificacion'];
            $model->razonsocial=$data['razonsocial'];
            $model->razoncomercial=$data['razoncomercial'];
            $model->direccion=$data['direccion'];
            $model->genero=$data['genero'];
            $model->credito=0;
            if ($data['credito']=='on'){ $model->credito=1; }
            $model->cupocredito=$data['cupocredito'];
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
            $log->Nuevo(self::MODULO." :: Factura_cliente -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
        endif;

        return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
    }

    public function Editarantecedentes($data)
    {
        $id=0;
        $result=false;
        if ($data):
            $model= Clientes::find()->where(["id"=>$data['idpaciente']])->one();
            $model->antecedentesp=$data['antecedentesp'];
            $model->antecedenteso=$data['antecedenteso'];
            $model->antecedentesf=$data['antecedentesf'];
            $model->enfermedada=$data['enfermedada'];
            $model->antecedentesf=$data['antecedentesf'];
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
            $log->Nuevo(self::MODULO." :: Factura_cliente -> editar",$error,$observacion,0,Yii::$app->user->identity->id);
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
            $data= Clientes::find()->where(["id"=>$id])->one();
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
            $log->Nuevo(self::MODULO." :: Factura_cliente -> eliminar",$error,$observacion,0,Yii::$app->user->identity->id);
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
                $log->Nuevo("USUARIO ",$error,$observacion,0,Yii::$app->user->identity->id);
                //return true;
                break;

            default:
                # code...
                break;
        }
    }



}