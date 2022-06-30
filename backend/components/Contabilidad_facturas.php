<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use backend\models\Factura;
use backend\models\Facturadetalle;
use common\models\Cuentas;
use common\models\Diario;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 29/12/21
 * Time: 00:10
 */

class Contabilidad_facturas extends Component
{

    public function getFacturas($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Factura::find()->where(["isDeleted"=>0])->all();
        }else{
            $asiento= Factura::find()->where(["isDeleted"=>0])->one();
        }
    }

    public function getFacturaseliminadas($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            $asiento= Factura::find()->where(["isDeleted"=>1])->all();
        }else{
            $asiento= Factura::find()->where(["isDeleted"=>1])->one();
        }
    }

    public function getFactura($id,$condicion=NULL,$itemsret=NULL)
    {
        $result=array();
        if ($id){
            $result= Factura::find()->where(["nfactura"=>$id])->one();
            if ($result)
            {
                $result=$result["nfactura"];
            }else{
                $result="NINGUNO";
            }
        }else{
            $result= false;
        }
        return $result;
    }

    public function Nuevo($factura,$detalle)
    {
        //$date = date("Y-m-d H:i:s");
        $result;
        if ($cuentaporcobrar):
            $model= New Factura;
            $model->nfactura=$cuentaporcobrar->idfactura;
            $model->canal=$cuentaporcobrar->idfactura;
            $model->tipomov=$cuentaporcobrar->idfactura;
            $model->fecha=$cuentaporcobrar->idfactura;
            $model->hora=$cuentaporcobrar->idfactura;
            $model->tipoprecio=$cuentaporcobrar->idfactura;
            $model->idcliente=$cuentaporcobrar->idfactura;
            $model->diasplazo=$cuentaporcobrar->idfactura;
            $model->firma=$cuentaporcobrar->idfactura;
            $model->condiciones=$cuentaporcobrar->idfactura;
            $model->entrega=$cuentaporcobrar->idfactura;
            $model->nombre=$cuentaporcobrar->idfactura;
            $model->ruc=$cuentaporcobrar->idfactura;
            $model->costo=$cuentaporcobrar->idfactura;
            $model->subtotal=$cuentaporcobrar->idfactura;
            $model->total=$cuentaporcobrar->idfactura;
            $model->tipopago=$cuentaporcobrar->idfactura;
            $model->cancela=$cuentaporcobrar->idfactura;
            $model->descuento=$cuentaporcobrar->idfactura;
            $model->iva=$cuentaporcobrar->idfactura;
            $model->transporte=$cuentaporcobrar->idfactura;
            $model->vencimiento=$cuentaporcobrar->idfactura;
            $model->notas=$cuentaporcobrar->idfactura;
            $model->vendedor=$cuentaporcobrar->idfactura;
            $model->bodegaorigen=$cuentaporcobrar->idfactura;
            $model->bodegadestino=$cuentaporcobrar->idfactura;
            $model->cartera=$cuentaporcobrar->idfactura;
            $model->autorizacion=$cuentaporcobrar->idfactura;
            $model->validez=$cuentaporcobrar->idfactura;
            $model->retencion=$cuentaporcobrar->idfactura;
            $model->diario=$cuentaporcobrar->idfactura;
            $model->cuotas=$cuentaporcobrar->idfactura;
            $model->notascredito=$cuentaporcobrar->idfactura;
            $model->ivavalor=$cuentaporcobrar->idfactura;
            $model->totalivagravado=$cuentaporcobrar->idfactura;
            $model->totalivaice=$cuentaporcobrar->idfactura;
            $model->asignardetalles=$cuentaporcobrar->idfactura;
            $model->notasalpie=$cuentaporcobrar->idfactura;
            $model->motivoanul=$cuentaporcobrar->idfactura;
            $model->declaracionmov=$cuentaporcobrar->idfactura;
            $model->autorizacionfac=$cuentaporcobrar->idfactura;
            $model->fechadeclaracion=$cuentaporcobrar->idfactura;
            $model->guiaremision=$cuentaporcobrar->idfactura;
            $model->usuarioguia=$cuentaporcobrar->idfactura;
            $model->fechaguiarem=$cuentaporcobrar->idfactura;
            $model->numeroentrega=$cuentaporcobrar->idfactura;
            $model->usuarioimp=$cuentaporcobrar->idfactura;
            $model->fechaimpresion=$cuentaporcobrar->idfactura;
            $model->tipodoc=$cuentaporcobrar->idfactura;
            $model->usuariocreacion=1;
            $model->fechae="PENDIENTE";
            $model->isDeleted=0;
            $model->estatus="ACTIVO";

            if ($model->save()):
                $detallefac= New Facturadetalle;
                foreach ($detalle as $key => $value) {
                    $detallefac->idfactura=$model->id;
                    $detallefac->tipomov=$detalle->tipomov;
                    $detallefac->canal=$detalle->canal;
                    $detallefac->item=$detalle->item;
                    
                    $detallefac->estatus="ACTIVO";

                }
            else:
                $result=false;
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