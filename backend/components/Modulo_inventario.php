<?php
namespace backend\components;
use Yii;
use yii\helpers\Url;
use backend\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;
use common\models\Menuadmin;
use common\models\Productos;
use common\models\Inventario;
use backend\components\Log_errores;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/12/21
 * Time: 11:47
 */

class Modulo_inventario extends Component
{

    public function getInventario($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $inventario= Inventario::find()->where(["isDeleted"=>0])->all();
        }else{
            $inventario= Inventario::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getInvent($rol=0,$context='')
    {
        if ($all){
            
        }else{
            
        }
        //$menu=['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest];
        $productoModel= Inventario::find()->where(["estatus"=>"ACTIVO","isDeleted"=>0])->orderBy(["orden"=>SORT_ASC])->all();
        return $productoModel;
    }

    public function Nuevo($inventario)
    {
        //$date = date("Y-m-d H:i:s");
        $idmenu=0;
        $modelInventario= new Productos;
        $result=false;
        if ($inventario):
            $modelInventario->nombreproducto=$producto["descripcion"];
            $modelInventario->codigo=$producto["codigo"];
            $modelInventario->codigonew=$producto["codigon"];
            $modelInventario->tipo=$producto["tipo"];
            $modelInventario->idpresentacion=$producto["tipounidad"];   
            $modelInventario->codigoprov=$producto["codigop"];
            $modelInventario->tipoproducto=$producto["tipolinea"];   
            $modelInventario->unibulto=$producto["unidades"];
            $modelInventario->descuento=$producto["descuento"];
            $modelInventario->costofob=$producto["costofob"];
            $modelInventario->costoini=$producto["costou"];
            $modelInventario->costo=$producto["costou"];
            $modelInventario->preciomayor=$producto["costopm"];
            $modelInventario->precio=$producto["costodis"];
            $modelInventario->preciodist2=$producto["costodis1"];
            $modelInventario->preciodist3=$producto["costodis2"];
            $modelInventario->preciopvp=$producto["costopvp"];
            $modelInventario->porfacturacost=$producto["descuentocosto"];
            $modelInventario->caracteristica=$producto["caracteristica"];
            $modelInventario->idpresentacionsec=$producto["unidadsec"];
            $modelInventario->coeficiente=$producto["unidadesfactura"];
            $modelInventario->marca=$producto["marca"];
            $modelInventario->color=$producto["color"];
            $modelInventario->usuariocreacion=Yii::$app->user->identity->id;
            $modelInventario->usuarioact=0;
            $modelInventario->idempresa=1;
            //$modelInventario->fechacreacion=$producto->idfactura;
            $modelInventario->isDeleted=0;
            $modelInventario->estatus="ACTIVO";
            //var_dump($producto);
            $error=false;
            if ($modelInventario->save()):
                $error=false;
                return array("response" => true, "id" => $modelInventario->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
            else:
                $this->callback(1,$idmenu,$modelInventario->errors,"Inventario -> Nuevo");
                //var_dump($modelRol->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            endif;
        else:
            $this->callback(1,0,"NO POST","Inventario -> Nuevo");
            return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
        endif;
        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function Actualizar($id,$roles)
    {
        //$date = date("Y-m-d H:i:s");
        $idmenu=0;
        $modelMenu= Menuadmin::find()->where(["id"=>$id])->one();
        $result=false;
        if ($roles):
            if ($modelMenu):
                $modelMenu->nombre=$roles["nombre"];
                $modelMenu->icono=$roles["icono"];
                $modelMenu->link=$roles["link"];
                $modelMenu->orden=$roles["orden"];
                $modelMenu->idparent=$roles["superior"];
                $modelMenu->usuariom=Yii::$app->user->identity->id;
                //$modelMenu->fechacreacion=$roles->idfactura;
                //var_dump($roles);
                $error=false;
                if ($modelMenu->save()):
                    $error=false;
                    return array("response" => true, "id" => $modelMenu->id, "mensaje"=> "Registro actualizado","tipo"=>"success", "success"=>true);
                else:
                    $this->callback(1,$idmenu,$modelMenu->errors,"Inventario -> Actualizar");
                    //var_dump($modelRol->errors);
                    return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
                endif;
            else:

            endif;
        else:
            $this->callback(1,0,"NO POST","Inventario -> Actualizar");
            return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
        endif;
        return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
    }

    public function callback($tipo,$id,$error,$funcion)
    {
        switch ($tipo) {
            case 1:
                $log= new Log_errores;
                $observacion="ID: ".$id;
                $log->Nuevo("INVENTARIO",$error,$observacion,0,Yii::$app->user->identity->id);

                return true;
                break;
            
            default:
                # code...
                break;
        }
    }
 


}