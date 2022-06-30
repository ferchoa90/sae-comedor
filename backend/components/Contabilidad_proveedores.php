<?php
namespace backend\components;
use Yii;
use common\models\Proveedores;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 23/02/22
 * Time: 12:08
 */

class Contabilidad_proveedores extends Component
{

    public function getProveedores($objetos)
    {


    }

    public function getSelect()
    {
        $proveedores = Proveedores::find()->where("isDeleted = 0")->orderBy(["nombre" => SORT_ASC])->all();
        //var_dump($proveedores);
        $proveedoresArray=array();
        $cont=0;
        foreach ($proveedores as $key => $value) {
            if ($cont==0){ $proveedoresArray[$cont]["value"]="Seleccione un proveedor"; $proveedoresArray[$cont]["id"]=-1; $cont++; }
            $proveedoresArray[$cont]["value"]=$value->nombre;
            $proveedoresArray[$cont]["id"]=$value->id;
            $cont++;
        }
        return $proveedoresArray;

    }

    public function Nuevo($proveedor)
    {
        //$date = date("Y-m-d H:i:s");
        $result;
        if ($proveedor):
            $model= New Cuentasporcobrar;
            $model->cedula=$proveedor->idfactura;
            $model->razonsocial=$proveedor->idfactura;
            $model->direccion=$proveedor->idfactura;
            $model->telefono=$proveedor->idfactura;
            $model->correo=$proveedor->idfactura;
            $model->tipo=$proveedor->idfactura;
            $model->usuariocreacion=$proveedor->idfactura;

            $model->saldo=$proveedor->idfactura;
            $model->concepto=$proveedor->idfactura;
            $model->diario=$proveedor->idfactura;
            $model->dias=$proveedor->idfactura;

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
