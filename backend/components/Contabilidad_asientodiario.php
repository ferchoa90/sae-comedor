<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use backend\models\Diario;
use backend\models\Diariodetalle;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 21/12/21
 * Time: 12:08
 */

class Contabilidad_asientodiario extends Component
{

    public function getAsientodiario($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Diario::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Diario::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function Nuevo($asiento,$tipo)
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

            else:

            endif;
        else:
            $result=false;
        endif;
        return $date;
    }

    private function numeracionAsiento($tipo){
        $result;
        switch ($tipo) {
            case 'nuevo':

                break;

            default:

                break;
        }
        return $result;
    }


}