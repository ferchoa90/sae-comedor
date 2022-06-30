<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use common\models\Cuentas;
use yii\base\Component;
use yii\base\InvalidConfigException;

use common\models\Log;



/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/12/21
 * Time: 11:47
 */

class Log_errores extends Component
{


    public function getLog($tipo,$array=true,$orderby,$limit,$all=true)
    {
        if ($all){
            //$asiento= Cuentas::find()->where(["isDeleted"=>0])->all();
        }else{                       
            //$asiento= Cuentas::find()->where(["isDeleted"=>0])->one();
        }
    }
 
    public function Nuevo($modulo,$error,$observacion='',$codigo=0,$usuario)
    {
        //$date = date("Y-m-d H:i:s");
        $idlog=0;
        $idmodulo=0;
        $modellog= new Log;
        $result=false;
        //echo 'SSS: '.json_encode($error);
        if ($modulo && $usuario):
            $modellog->modulo=$modulo;
            $modellog->descripcion=json_encode($error);
            $modellog->observacion="$observacion";
            $modellog->codigo="$codigo";
            $modellog->usuariocreacion=Yii::$app->user->identity->id;
            //$modellog->fechacreacion=$roles->idfactura;
            $modellog->estatus="ACTIVO";
            $modellog->save();
            //var_dump($modellog);
            //var_dump($modellog->errors);
            //var_dump($roles);
            $error=false;
            $result=true;
        else:
            $result=false;
        endif;
        return $result;
    }

    public function callback($tipo,$id)
    {
        switch ($tipo) {
            case 1:
                //$modelRol= Roles::find()->where(["id"=>$id])->one();
                return true;
                break;
            
            default:
                # code...
                break;
        }
    }
    


}