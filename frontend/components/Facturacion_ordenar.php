<?php
namespace frontend\components;
use Yii;
use common\models\Configuracion;
use common\models\Ordenes;
use common\models\Ordenesdetalle;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Roles;
use common\models\Clientes;
use common\models\Rolespermisos;
use common\models\Inventario;
use backend\components\Log_errores;
use backend\models\User;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 21/03/21
 * Time: 10:42
 */

class Facturacion_ordenar extends Component
{
    private const MODULO='ORDENAR';

    public function getOrdeneses($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $response= Ordenes::find()->where(["isDeleted"=>0])->all();
        }else{
            $response= Ordenes::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getOrdenes($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Ordenes::find()->where(["id"=>$id])->one();
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
        $clientes = Ordenes::find()->where("isDeleted = 0")->orderBy(["nombre" => SORT_ASC])->all();
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

    function cerrarOrden($data)
    {
        $orden= Ordenes::find()->where(["idmesa"=>$data["mesa"],"ordencerrada"=>0,"impreso"=>1])->orderBy(["id"=>SORT_DESC])->one(); 
        $orden->ordencerrada=1;
        if ($orden->save())
        {
            return array("response" => true, "id" => $orden->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
        }else{
            $this->callback(1,$orden->id,$orden->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        }
    }

    public function Nuevo($data)
    {
        //$date = date("Y-m-d H:i:s");
        $id=0;
        $dataModel= new Ordenes;
        $result=false;
        if ($data):
            //$data = $usuario;
            $dataModel->idmesa=$data['mesa'];
            $dataModel->comentario=$data['comentario'];
            $cliente = Clientes::find()->where(['cedula' => $data["cliente"]])->orderBy(["fechacreacion" => SORT_DESC])->all();
            $dataModel->idcliente=$cliente[0]->id;
            $dataModel->isDeleted=0;
            $dataModel->usuariocreacion=Yii::$app->user->identity->id;
            $dataModel->estatus="ACTIVO";
            if ($dataModel->save()){ 
                foreach ($data["data"] as $key => $value) {
                    $subtotalI= number_format($value["valoru"]/1.12,2);
                    $ivaI= number_format($value["valoru"]-$subtotalI,2);
                    $ordenDetalle= new Ordenesdetalle();
                    $ordenDetalle->idorden=$dataModel->id;
                    $ordenDetalle->nombreprod=$value["nombre"];
                    $inventario = Inventario::find()->where(['id' => $value["id"]])->one();
                    $ordenDetalle->idproducto=$inventario->idproducto;
                    $ordenDetalle->idinventario=$value["id"];
                    $ordenDetalle->cantidad=$value["cantidad"];
                    $ordenDetalle->precio=$value["valoru"];
                    $ordenDetalle->usuariocreacion=Yii::$app->user->identity->id;
                    
                    
                    
                 //   $ordenDetalle->valort=number_format($value["valoru"]*$value["cantidad"],2);
                  //  $ordenDetalle->iva=$ivaI;
                  //  $ordenDetalle->civa=0;
                    $ordenDetalle->estatus='ACTIVO';
                    $ordenDetalle->save();
                    //var_dump($ordenDetalle->errors);
                }

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
            $log->Nuevo(self::MODULO." :: Facturacion_ordenar",$error,$observacion,0,Yii::$app->user->identity->id);
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
            $dataModel= Ordenes::find()->where(["id"=>$data['id']])->one();
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
            $dataModel= Ordenes::find()->where(["id"=>$id])->one();
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
            $log->Nuevo(self::MODULO." :: Facturacion_ordenar -> eliminar",$error,$observacion,0,Yii::$app->user->identity->id);
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