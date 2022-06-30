<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use backend\models\Cuentasporcobrar;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 29/12/21
 * Time: 23:29
 */

class Auditoria_usuario extends Component
{


    public function Nuevo($modulo,$proceso,$cadena,$usuario)
    {
        //$date = date("Y-m-d H:i:s");
        $result;
        if ($cuentaporcobrar):
            $model= New Cuentasporcobrar;
            $model->idfactura=$cuentaporcobrar->idfactura;
            $model->tipopago=$cuentaporcobrar->idfactura;
            $model->idcliente=$cuentaporcobrar->idfactura;
            $model->tipo=$cuentaporcobrar->idfactura;
            $model->fecha=$cuentaporcobrar->idfactura;
            $model->valor=$cuentaporcobrar->idfactura;
            $model->abono=$cuentaporcobrar->idfactura;
            $model->saldo=$cuentaporcobrar->idfactura;
            $model->concepto=$cuentaporcobrar->idfactura;
            $model->diario=$cuentaporcobrar->idfactura;
            $model->dias=$cuentaporcobrar->idfactura;
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