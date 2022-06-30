<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use yii\base\Component;
use yii\web\View;
use backend\assets\AppAsset;
use yii\base\InvalidConfigException;

/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 10/12/21
 * Time: 01:07
 */

class Modal extends Component
{
    public function getModal($tipo,$nombre='', $id='', $titulo='', $content='', $clase='', $style='', $col='',$stylemodal='',$boton1='', $boton2='',$adicional )
    {
                return $this->getWinmodal($tipo,$nombre, $id, $titulo, $content, $clase, $style, $col,$stylemodal,$boton1, $boton2,$adicional);
    }

    public function getWinmodal($tipo,$nombre='', $id='', $titulo='',$content='', $clase='', $style='', $col='',$stylemodal='', $boton1='', $boton2='',$adicional)
    {
        $this->getWrite($nombre,$id,$tipo);
        $classdefault='';
        $tipodefault='fas fa-pencil-alt';
        $tamaniodefault='';
        $input="";
        if ($stylemodal==""){ $styleModal="width: 60%;"; }else{ $styleModal=$stylemodal; }
        switch ($tipo) {
            case 'okcancel':
                $tipo='fas fa-pencil-alt';
                $botones='<div class="modal-footer">
                  <button type="button" onclick="javascript:'.$boton1.';" class="btn bg-gradient-primary  btn-xs p-2" data-dismiss="modal">Aceptar</button>
                  <button type="button" onclick="javascript:'.$boton2.';" class="btn bg-gradient-danger  btn-xs p-2">Cancelar</button>
                </div>';
                break;

            case 'okcancelinput':
              $tipo='fas fa-pencil-alt';
              $botones='<div class="modal-footer">
                <button type="button" onclick="javascript:'.$boton1.';" class="btn bg-gradient-primary  btn-xs p-2" data-dismiss="modal">Aceptar</button>
                <button type="button" onclick="javascript:'.$boton2.';" class="btn bg-gradient-danger  btn-xs p-2">Cancelar</button>
              </div>';
              $input='<div class="p-2 col-12"><textarea name="mensaje" id="mensaje" class="col-12" rows="3"></textarea></div>';
              break;

              case 'okcancelhtml':
                $tipo='fas fa-pencil-alt';
                $botones='<div class="modal-footer">
                  <button type="button" onclick="javascript:'.$boton1.';" class="btn bg-gradient-primary  btn-xs p-2" data-dismiss="modal">Aceptar</button>
                  <button type="button" onclick="javascript:'.$boton2.';" class="btn bg-gradient-danger  btn-xs p-2">Cancelar</button>
                </div>';
                $input='';
                break;

            case 'sino':
                $tipo='fas fa-pencil-alt';
                $botones='<div class="modal-footer">
                <button type="button" onclick="javascript:'.$boton1.';" class="btn bg-gradient-primary  btn-xs p-2" data-dismiss="modal">Si</button>
                <button type="button" onclick="javascript:'.$boton2.';" class="btn bg-gradient-danger  btn-xs p-2">No</button>
                </div>';
                break;


                case 'ok':
                $tipo='fas fa-eye';
                $botones='<div class="modal-footer"><button type="button" class="btn bg-gradient-danger  btn-xs p-2" data-dismiss="modal">Close</button></div>';
                break;

            case 'savecancel':
                $tipo='fas fa-eye';
                break;

            default:
                $tipo=$tipodefault;
                break;
        }



        switch ($clase) {
            case !'':
                $clase=$clase;
                break;

            default:
                $clase=$classdefault;
                break;
        }

        if (!$nombre){ $nombre='modalDefault'; }
        if (!$id){ $id='modalDefault'; }



        $div='
        <!-- Modal -->
<div class="modal fade" name="'.$nombre.'"  id="'.$nombre.'" tabindex="-1" role="dialog" aria-labelledby="'.$nombre.'" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">'.$titulo.'</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">'.$content.$input.'</div>
      '.$botones.'
    </div>
  </div>
</div>
<style>
.modal-content {
  '.$styleModal.'
}
</style>

        ';

       /* $div='
            <i id="'.$id.'" name="'.$nombre.'" alt="'.$titulo.'" title="'.$titulo.'" class="'.$clase.' '.$tipo.'"></i>
        ';*/
        $resultado=$div;


        //return true;
        return $resultado;
    }

    public function getWrite($name='',$id='', $tipo='')
    {


        $script = <<< JS
            //alert('hola');
            console.log("Prueba");
            function prueba()
            {
            //alert('hola');

            }


JS;



        Yii::$app->getView()->registerJs($script, \yii\web\View::POS_END);

    }
}