<?php
namespace backend\components;
use Yii;
use common\models\Clientes;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 21/12/21
 * Time: 12:08
 */

class Contabilidad_clientes extends Component
{

    public function getCuentasporcobrar($objetos)
    {


    }

    public function getSelect()
    {
        $clientes = Clientes::find()->where("isDeleted = 0")->orderBy(["razonsocial" => SORT_ASC])->all();
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

    public function Nuevo($cliente)
    {
        //$date = date("Y-m-d H:i:s");
        $result;
        if ($cliente):
            $model= New Cuentasporcobrar;
            $model->cedula=$cliente->idfactura;
            $model->razonsocial=$cliente->idfactura;
            $model->direccion=$cliente->idfactura;
            $model->telefono=$cliente->idfactura;
            $model->correo=$cliente->idfactura;
            $model->tipo=$cliente->idfactura;
            $model->usuariocreacion=$cliente->idfactura;

            $model->saldo=$cliente->idfactura;
            $model->concepto=$cliente->idfactura;
            $model->diario=$cliente->idfactura;
            $model->dias=$cliente->idfactura;

            $model->isDeleted=0;
            $model->estatus="ACTIVO";

            if ($model->save()):
                return $model->id;
            else:

            endif;
        else:
            $result=false;
        endif;
        return $date;
    }

    public function auditoria(){

    }
}
