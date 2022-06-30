<?php
namespace backend\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use backend\components\Log_errores;




/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 26/06/22
 * Time: 14:20
 */

class Facturacion_tipoident extends Component
{
    const MODULO='FUNCIONES';

    public function vuelto($valorpago,$valorrecibido=0)
    {
        $valoraprox=0;
        $vuelto=0;
        $valoraprox=$valorrecibido;
        if ($valorrecibido!=0){
            $vuelto=$valorrecibido-$valoraprox;
        }else{
            if ($valorrecibido>0 && $valorrecibido<=5 )
            {
                $valoraprox=5;
            }
            if ($valorrecibido>5 && $valorrecibido<=10 )
                $valoraprox=10;
            {
                
            }

            if ($valorrecibido>10 && $valorrecibido<=15 )
            {
                $valoraprox=15;
                
            }

            if ($valorrecibido>15 && $valorrecibido<=20 )
            {
                $valoraprox=20;
                
            }

            if ($valorrecibido>20 && $valorrecibido<=25 )
            {
                $valoraprox=25;
                
            }

            if ($valorrecibido>25 && $valorrecibido<=30 )
            {
                $valoraprox=30;
                
            }

            if ($valorrecibido>30 && $valorrecibido<=35 )
            {
                $valoraprox=35;
                
            }

            if ($valorrecibido>35 && $valorrecibido<=40 )
            {
                $valoraprox=40;
                
            }
        }
        return $vuelto;
    }

    public function callback($tipo,$id,$error)
    {
        switch ($tipo) {
            case 1:


                $log= new Log_errores;
                $observacion="ID: ".$id;
                $log->Nuevo("USUARIO ",$error,$observacion,0,Yii::$app->user->identity->id);
                //return true;
                break;

            default:
                # code...
                break;
        }
    }



}