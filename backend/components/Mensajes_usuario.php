<?php
namespace backend\components;
use Yii;
use common\models\Configuracion;
use common\models\Mensajes;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 18/01/22
 * Time: 10:22
 */

class Mensajes_usuario extends Component
{
    public CONST ESTATUS="TODOS";
    public CONST NOTIFICADO="NOTIFICADO";
    public CONST LEIDO="LEIDO";
    public CONST NOLEIDO="NOLEIDO";
    public CONST BORRADOR="BORRADOR";
    public CONST NUEVO="NUEVO";

    public function getNotificacion($usuario=0,$destinatario,$estatus)
    {

    }

    public function getMensajes($usuario=0,$destinatario=0,$estatus='NUEVO')
    {
        $mensajes=Mensajes::find()->where(["estatus"=>"NUEVO"])->orderBy(["fechacreacion"=>SORT_DESC])->all();
        return $mensajes;
    }

    public function getNmensajes($usuario=0,$destinatario=0,$estatus='NUEVO')
    {
        $mensajes=Mensajes::find()->where(["estatus"=>"NUEVO"])->orderBy(["fechacreacion"=>SORT_DESC])->count();
        return $mensajes;
    }

    public function Nuevo($usuario=0,$destinatario,$mensaje,$estatus)
    {
        $this->ESTATUS=$this->NUEVO;
        //$date = date("Y-m-d H:i:s");
        $result;
        if ($destinatario && $mensaje):
            $modelmensaje= New Mensajes;
            $modelmensaje->mensaje=$mensaje;
            $modelmensaje->usuariocreacion=$usuario;
            $modelmensaje->usuarionot=$destinatario;
            $modelmensaje->isDeleted=0;
            $modelmensaje->estatus="ACTIVO";

            if ($modelmensaje->save()):
                return $modelmensaje->id;
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