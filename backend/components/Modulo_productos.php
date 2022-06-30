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
use backend\components\Log_errores;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/12/21
 * Time: 11:47
 */

class Modulo_productos extends Component
{

    public function getProductos($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getProducto($rol=0,$context='')
    {
        if ($all){
            
        }else{
            
        }
        //$menu=['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest];
        $productoModel= Productos::find()->where(["tipo"=>"WEB","idparent"=>"0","estatus"=>"ACTIVO","isDeleted"=>0])->orderBy(["orden"=>SORT_ASC])->all();
       
        return $productoModel;
    }

    public function Nuevo($producto)
    {
        //$date = date("Y-m-d H:i:s");
        $idmenu=0;
        $modelProducto= new Productos;
        $result=false;
        if ($producto):
            $modelProducto->nombreproducto=$producto["descripcion"];
            $modelProducto->codigo=$producto["codigo"];
            $modelProducto->codigonew=$producto["codigon"];
            $modelProducto->tipo=$producto["tipo"];
            $modelProducto->idpresentacion=$producto["tipounidad"];   
            $modelProducto->codigoprov=$producto["codigop"];
            $modelProducto->tipoproducto=$producto["tipolinea"];   
            $modelProducto->unibulto=$producto["unidades"];
            $modelProducto->descuento=$producto["descuento"];
            $modelProducto->costofob=$producto["costofob"];
            $modelProducto->costoini=$producto["costou"];
            $modelProducto->costo=$producto["costou"];
            $modelProducto->preciomayor=$producto["costopm"];
            $modelProducto->precio=$producto["costodis"];
            $modelProducto->preciodist2=$producto["costodis1"];
            $modelProducto->preciodist3=$producto["costodis2"];
            $modelProducto->preciopvp=$producto["costopvp"];
            $modelProducto->porfacturacost=$producto["descuentocosto"];
            $modelProducto->caracteristica=$producto["caracteristica"];
            $modelProducto->idpresentacionsec=$producto["unidadsec"];
            $modelProducto->coeficiente=$producto["unidadesfactura"];
            $modelProducto->marca=$producto["marca"];
            $modelProducto->color=$producto["color"];
            $modelProducto->usuariocreacion=Yii::$app->user->identity->id;
            $modelProducto->usuarioact=0;
            $modelProducto->idempresa=1;
            //$modelProducto->fechacreacion=$producto->idfactura;
            $modelProducto->isDeleted=0;
            $modelProducto->estatus="ACTIVO";
            //var_dump($producto);
            $error=false;
            if ($modelProducto->save()):
                $error=false;
                return array("response" => true, "id" => $modelProducto->id, "mensaje"=> "Registro agregado","tipo"=>"success", "success"=>true);
            else:
                $this->callback(1,$idmenu,$modelProducto->errors,"Productos -> Nuevo");
                //var_dump($modelRol->errors);
                return array("response" => true, "id" => 0, "mensaje"=> "Error al agregar el registro","tipo"=>"error", "success"=>false);
            endif;
        else:
            $this->callback(1,0,"NO POST","Productos -> Nuevo");
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
                    $this->callback(1,$idmenu,$modelMenu->errors,"Productos -> Actualizar");
                    //var_dump($modelRol->errors);
                    return array("response" => true, "id" => 0, "mensaje"=> "Error al actualizar el registro","tipo"=>"error", "success"=>false);
                endif;
            else:

            endif;
        else:
            $this->callback(1,0,"NO POST","Productos -> Actualizar");
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
                $log->Nuevo("PRODUCTOS",$error,$observacion,0,Yii::$app->user->identity->id);

                return true;
                break;
            
            default:
                # code...
                break;
        }
    }
 


}