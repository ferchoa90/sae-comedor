<?php
namespace backend\components;
use Yii;
use common\models\Configuracion;
use common\models\Productos;
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

class Inventario_productos extends Component
{
    private const MODULO='INVENTARIO - PRODUCTOS';

    public function getProductoses($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $response= Productos::find()->where(["isDeleted"=>0])->all();
        }else{
            $response= Productos::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getProductos($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Productos::find()->where(["id"=>$id])->one();
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
        $clientes = Productos::find()->where("isDeleted = 0")->orderBy(["nombre" => SORT_ASC])->all();
        //var_dump($clientes);
        $clientesArray=array();
        $cont=0;
        foreach ($clientes as $key => $value) {
            if ($cont==0){ $clientesArray[$cont]["value"]="Seleccione una profesión"; $clientesArray[$cont]["id"]=-1; $cont++; }
            $clientesArray[$cont]["value"]=$value->nombre;
            $clientesArray[$cont]["id"]=$value->id;
            $cont++;
        }
        return $clientesArray;

    }

    public function Nuevo($data,$imagen)
    {
        //$date = date("Y-m-d H:i:s");
        $id=0;
        $model= new Productos;
        $result=false;
        if ($data):
            $subir=new Archivos();
            $subirArchivo= $subir->Subirarchivo($imagen["imagen"]);
            if ($subirArchivo["success"])
            {
                $model->nombreproducto = $data['nombre'];
                $model->descripcion = $data['descripcion'];
                $model->imagen = $imagen["imagen"]["name"];
                $model->idempresa = 1;
                $model->idproveedor = $data['proveedores'];
                $model->tipoproducto = $data['tipoproducto'];
                $model->marca = $data['marca'];
                $model->usuariocreacion = Yii::$app->user->identity->id;
                $model->modelo = 1;
                $model->color = 0;
                $model->isDeleted = 0;
                $model->estatus =  "ACTIVO";
                
                //var_dump($model->save());
                
                if ($model->save()) {
                    return array("response"=>true,"mensaje"=>"Registro agregado","tipo"=>"success", "success"=>true, "id" => $model->id);
                    
                }else{
                    //var_dump($model->errors);
                    return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
                    

                }
            }else{
                return array("response"=>false,"mensaje"=>"Error al subir la imagen, Mensaje: ".$subirArchivo["Mensaje"],"success" => false,"tipo"=>"error", "id" => "");
                

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

    public function Editar($data,$imagen)
    {
        $date = date("Y-m-d H:i:s");
        $id=0;
        $result=false;
        if ($data):
            $model= Productos::find()->where(["id"=>$data['idproducto']])->one();
            if ($data['imagen'])
            {
                $subir=new Archivos();
                $subirArchivo= $subir->Subirarchivo($imagen["imagen"]);
                if ($subirArchivo["success"])
                {
                    $model->imagen = $imagen["imagen"]["name"];
                }else{
                    return array("response"=>false,"mensaje"=>"Error al subir la imagen, Mensaje: ".$subirArchivo["Mensaje"],"success" => false,"tipo"=>"error", "id" => "");
                }
            }
                $model->nombreproducto = $data['nombre'];
                $model->descripcion = $data['descripcion'];
                $model->idempresa = 1;
                $model->idproveedor = $data['proveedores'];
                $model->tipoproducto = $data['tipoproducto'];
                $model->marca = $data['marca'];
                $model->usuarioact = Yii::$app->user->identity->id;
                $model->fechaact = $date;
                $model->modelo = 1;
                $model->color = 0;
                $model->estatus =  "ACTIVO";
                
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
            $log->Nuevo(self::MODULO." :: Inventario_productos -> Editar",$error,$observacion,0,Yii::$app->user->identity->id);
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
            $model= Productos::find()->where(["id"=>$id])->one();
            $model->isDeleted=1;
            if ($model->save()) {
                $error=false;
                return array("response" => true, "id" => $model->id, "mensaje"=> "Registro eliminado","tipo"=>"success", "success"=>true);
            } else {
                $this->callback(1,$id,$model->errors);
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