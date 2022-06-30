<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use backend\models\Diario;
use backend\models\Diariodetalle;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/12/21
 * Time: 11:47
 */

class Contabilidad_cuentas extends Component
{

    public function getCuentas($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Cuentas::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getCuenta($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Cuentas::find()->where(["codigoant"=>$id])->one();
            if ($result)
            {
                $result=$result["codigoant"].' ('.$result["nombre"].')';
            }else{
                $result="NINGUNO";
            }
        }else{
            $result= false;
        }
        return $result;
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