<?php
namespace backend\components;
use Yii;
use yii\helpers\Url;
use backend\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Pedidos;
use common\models\Pedidosdetalle;
use common\models\Productos;
use common\models\Clientes;
use common\models\Roles;
use common\models\Rolespermisos;
use backend\components\Log_errores;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 15/03/22
 * Time: 07:40
 */

class Produccion_pedidos extends Component
{

    public $idusuariocontrol;
    public $idusuariosup;


    function __construct($usuariocontrol='',$usuariosup='')
    {
        $usuarioadmindef=1;
        $usuariosupdef = 55;

        $this->idusuariocontrol=$usuarioadmindef;
        $this->idusuariosup=$usuariosupdef;

    }

    public function getPedidos($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Pedidos::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Pedidos::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getSelect()
    {
        $clientes = Pedidos::find()->where(["isDeleted"=>0])->orderBy(["fechacreacion" => SORT_DESC])->all();
        //var_dump($clientes);
        $clientesArray=array();
        $cont=0;
        foreach ($clientes as $key => $value) {
            if ($cont==0){ $clientesArray[$cont]["value"]="Seleccione un pedido"; $clientesArray[$cont]["id"]=-1; $cont++; }
            $clientesArray[$cont]["value"]=$value->idcliente0->razonsocial;
            $clientesArray[$cont]["id"]=$value->id;
            $cont++;
        }
        return $clientesArray;

    }

    public function getPedido($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Pedidos::find()->where(["id"=>$id])->one();
            if ($result)
            {
                $result=$result["id"].' ('.$result["fechacreacion"].')';
            }else{
                $result="NINGUNO";
            }
        }else{
            $result= false;
        }
        return $result;
    }

    public function Nuevo($pedido)
    {
        //$date = date("Y-m-d H:i:s");
        $idmenu=0;
        $modelPedido= new Pedidos;
        $result=false;
        if ($pedido):
            $modelPedido->idcliente=$pedido["cliente"];
            $modelPedido->observacion=$pedido["observacion"];
            $cliente= Clientes::find()->where(["id"=>$pedido["cliente"]])->one();
            if ($cliente){
                $modelPedido->nombres=$cliente->razonsocial;
                $modelPedido->telefono=$cliente->telefono.'.';
                $modelPedido->subtotal=$pedido["subtotal"];
                $modelPedido->orden=$pedido["orden"];
                $modelPedido->iva=$pedido["iva"];
                $modelPedido->total=$pedido["totalpedido"];
                $modelPedido->imagen=$pedido["imagen"];
                $modelPedido->usuariocreacion=Yii::$app->user->identity->id;
                //$modelPedido->usuariom=Yii::$app->user->identity->id;

                $modelPedido->isDeleted=0;
                $modelPedido->estatuspedido="NUEVO";
                $modelPedido->estatus="ACTIVO";
                //var_dump($pedido);
                $error=false;
            }else{
                $error=true;
                $this->callback(1,0,"CLIENTE NO ENCONTRADO","Produccion_pedidos -> Nuevo");
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            }


            if ($modelPedido->save()):
                $error=false;
                $i=0;
                foreach ($pedido as $clave=>$valor):
                    if(substr($clave,0,8) == "cantidad"){
                        $i++;
                        $_POST['producto'.$valor];
                        $producto 	= $_POST['producto'.$i];
                        $cantidad 	= $_POST['cantidad'.$i];
                        $valor 	= $_POST['valor'.$i];
                        if ($cantidad !=0){
                            $modelDetalle= new Pedidosdetalle;
                            $modelDetalle->idpedido=$modelPedido->id;
                            $modelDetalle->idproducto=$producto;
                            $producton=Productos::find()->where(['id' => $producto])->one();
                            $modelDetalle->nombreprod=$producton->nombreproducto;
                            $modelDetalle->cantidad=$cantidad;
                            $modelDetalle->subtotal=$valor;
                            $modelDetalle->iva=$valor*0.12;
                            $modelDetalle->total=($valor*$cantidad)+(($valor*$cantidad)*0.12);
                            $modelDetalle->usuariocreacion=Yii::$app->user->identity->id;
                            $modelDetalle->estatus="ACTIVO";

                            //$this->callback(1,$idmenu,$modelDetalle,"Produccion_pedidos -> Nuevo");
                            if (!$modelDetalle->save())
                            {
                                $this->callback(1,$idmenu,$modelDetalle->errors,"Produccion_pedidos -> Nuevo");
                            }
                        }
                        /*if(!is_numeric($cant)){
                            $cant = 1;
                        }*/
                    }else{

                    }
                endforeach;
                return array("response" => true, "id" => $modelPedido->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
            else:
                $this->callback(1,$idmenu,$modelPedido->errors,"Produccion_pedidos -> Nuevo");
                //var_dump($modelRol->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            endif;
        else:
            $this->callback(1,0,"NO POST","Produccion_pedidos -> Nuevo");
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;
        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Actualizar($id,$pedido)
    {
        //$date = date("Y-m-d H:i:s");
        $idmenu=0;
        $modelPedido= Pedidos::find()->where(["id"=>$id])->one();
        $result=false;
        if ($pedido):
            $modelPedido->idcliente=$pedido["cliente"];
            $modelPedido->observacion=$pedido["observacion"];
            $cliente= Clientes::find()->where(["id"=>$pedido["cliente"]])->one();
            if ($cliente){
                $modelPedido->nombres=$cliente->razonsocial;
                $modelPedido->telefono=$cliente->telefono.'.';
                $modelPedido->subtotal=$pedido["subtotal"];
                $modelPedido->orden=$pedido["orden"];
                $modelPedido->iva=$pedido["iva"];
                $modelPedido->total=$pedido["totalpedido"];
                //$modelPedido->imagen=$pedido["imagen"];
                $modelPedido->usuarioact=Yii::$app->user->identity->id;
                $modelPedido->fechaact=date("Y-m-d h:i:s");
                //$modelPedido->usuariom=Yii::$app->user->identity->id;

                $modelPedido->isDeleted=0;
                $modelPedido->estatuspedido="ENVIADO";
                //$modelPedido->estatus="ACTIVO";
                //var_dump($pedido);
                $error=false;
            }else{
                $error=true;
                $this->callback(1,0,"CLIENTE NO ENCONTRADO","Produccion_pedidos -> Actualizar");
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            }


            if ($modelPedido->save()):
                $error=false;
                $i=0;
                foreach ($pedido as $clave=>$valor):
                    if(substr($clave,0,8) == "cantidad"){
                        $i++;
                        $_POST['producto'.$valor];
                        $producto 	= $_POST['producto'.$i];
                        $cantidad 	= $_POST['cantidad'.$i];
                        $valor 	= $_POST['valor'.$i];

                        if ($cantidad !=0){
                            $modelDetalle= new Pedidosdetalle;
                            if ($pedido["idpedidod".$i]>0){ $modelDetalle=Pedidosdetalle::find()->where(["id"=>$pedido["idpedidod".$i] ])->one();   }else{  }


                            $modelDetalle->idproducto=$producto;
                            $producton=Productos::find()->where(['id' => $producto])->one();
                            $modelDetalle->nombreprod=$producton->nombreproducto;
                            $modelDetalle->cantidad=$cantidad;
                            $modelDetalle->subtotal=$valor;
                            $modelDetalle->iva=$valor*0.12;
                            $modelDetalle->total=($valor*$cantidad)+(($valor*$cantidad)*0.12);
                            $modelDetalle->usuarioact=Yii::$app->user->identity->id;
                            $modelDetalle->fechaact=date("Y-m-d h:i:s");


                            //$this->callback(1,$idmenu,$modelDetalle,"Produccion_pedidos -> Nuevo");
                            if (!$modelDetalle->save())
                            {
                                $this->callback(1,$idmenu,$modelDetalle->errors,"Produccion_pedidos -> Actualizar");
                            }
                        }
                        /*if(!is_numeric($cant)){
                            $cant = 1;
                        }*/
                    }else{

                    }
                endforeach;
                return array("response" => true, "id" => $modelPedido->id, "mensaje"=> "Registro actualizado","tipo"=>"success", "success"=>true);
            else:
                $this->callback(1,$idmenu,$modelPedido->errors,"Produccion_pedidos -> Actualizar");
                //var_dump($modelRol->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
            endif;
        else:
            $this->callback(1,0,"NO POST","Produccion_pedidos -> Actualizar");
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
        endif;
        return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
    }

    public function eliminar($id)
    {
        $model = Pedidos::findOne($id);
        $model->isDeleted = 1;

        if ($model->save())
        {
            return true;
        }else{
            return false;
        }
    }

    public function estatus($estatus)
    {
        $style="";
        switch ($estatus) {
            case 'NUEVO':
                $style='badge-primary';
                break;

            case 'ENVIADO':
                    $style='badge-primary';
                    break;

                case 'AUTORIZADO':
                    $style='badge-success';
                    break;

            case 'REENVIADO':
                $style='badge-primary';
                break;

            case 'NO AUTORIZADO':
                $style='badge-danger';
                break;

            case 'POR APROBAR':
                $style='badge-secondary';
                break;

            case 'DEVUELTO':
                $style='badge-warning';
                break;

                case 'ANULADO':
                    $style='badge-danger';
                    break;

                    case 'ACEPTADO':
                        $style='badge-success';
                        break;

            default:
                # code...
                break;
        }
        return $style;
    }

    public function callback($tipo,$id,$error,$funcion)
    {
        switch ($tipo) {
            case 1:
                $log= new Log_errores;
                $observacion="ID: ".$id;
                $log->Nuevo("PRODUCCION",$error,$observacion,0,Yii::$app->user->identity->id);

                return true;
                break;

            default:
                # code...
                break;
        }
    }



}