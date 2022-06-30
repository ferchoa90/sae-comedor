<?php
namespace backend\components;
use Yii;
use common\models\Configuracion;
use common\models\Notificaciones;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 18/01/22
 * Time: 10:00
 */

class Notificaciones_usuario extends Component
{
    public CONST ESTATUS="TODOS";
    public CONST NOTIFICADO="NOTIFICADO";
    public CONST LEIDO="LEIDO";
    public CONST NOLEIDO="NOLEIDO";


    public function getNotificaciones($usuario=0,$destinatario=0,$estatus='NUEVO')
    {
        $mensajes=Notificaciones::find()->where(["estatusnot"=>"NO LEIDO"])->orderBy(["fechacreacion"=>SORT_DESC])->all();
        return $mensajes;
    }

    public function getNnotificaciones($usuario=0,$destinatario=0,$estatus='NUEVO')
    {
        $mensajes=Notificaciones::find()->where(["estatusnot"=>"NO LEIDO"])->orderBy(["fechacreacion"=>SORT_DESC])->count();
        return $mensajes;
    }

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