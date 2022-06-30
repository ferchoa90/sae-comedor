<?php
namespace backend\components;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;

use backend\assets\AppAsset;
use yii\base\Component;
use backend\models\User;
use backend\models\Configuracion;
use backend\components\Iconos;
use backend\components\Botones;
use backend\components\Contenido;

/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 06/09/21
 * Time: 22:22
 */

class Objetos extends Component
{

    public function getObjetosArray($objetos,$return=false,$form=false,$id='',$method='',$url='')
    {
        $resultado;

        foreach($objetos as $obj):
          //  var_dump($objetos);

            switch ($obj['tipo']) {
            case 'input':
                    $resultado.= $this->getInput($obj['subtipo'],$obj['nombre'], $obj['id'], $obj['valor'], $obj['onchange'], $obj['clase'], $obj['estilo'], $obj['icono'],$obj['boxbody'],$obj['etiqueta'],$obj['leyenda'], $obj['col'], $obj['adicional'], $obj['valordefecto'], $obj['textoon'], $obj['textooff']);
                    break;



            case 'box':
                if (!$obj['contenido']){ $obj['contenido']="&nbsp;"; };
                $resultado.= '<div class="'.$obj['col'].'" '.$obj['adicional'].'>'.$obj['contenido'].'</div>';
                break;

            case 'select':
                $resultado.= $this->getSelect($obj['subtipo'],$obj['nombre'], $obj['id'], $obj['valor'], $obj['valordefecto'], $obj['onchange'], $obj['clase'], $obj['estilo'], $obj['icono'],$obj['boxbody'],$obj['etiqueta'],$obj['leyenda'], $obj['col'], $obj['adicional']);
                break;

            case 'separador':
                $resultado.= $this->getSeparador($obj['clase'],$obj['estilo'], $obj['color']);
                break;

            case 'div':
                $contenidoClass= new contenido;
                $contenido=$contenidoClass->getContenidoArrayr(
                    array(
                        array('tipo'=>'div','nombre'=>$obj['nombre'], 'id' => $obj['id'], 'titulo'=>$obj['titulo'],'contenido'=>$obj['contenido'], 'col'=>$obj['col'],'clase'=>$obj['clase'], 'style'=>$obj['style'], 'tipocolor'=>$obj['tipocolor'], 'icono'=>$obj['icono'],'adicional'=>$obj['adicional']),
                    ));
                $resultado.='<div class="col-12 mb-3 mt-3">'. $contenido.'</div>';
                break;

            default:

                break;

            case 'boton':
                //echo $obj['link'];
                $botones= new Botones; $botonC=$botones->getBotones(
                    $obj['tipo'],$obj['nombre'],$obj['id'],$obj['titulo'],$obj['link'],$obj['onclick'],$obj['clase'],$obj['style'],$obj['col'],$obj['tipocolor'],$obj['icono'],$obj['tamanio'],$obj['adicional']);
                //echo $botonC;
                    $resultado.= '<div class="col-4 col-md-4 align-self-center"><div class="form-group"><label>&nbsp;</label><br>'.$botonC.'</div></div>';
                break;
            }


        endforeach;
        if ($form){
            $token='<input type="hidden" name="_csrf-frontend" value="F3IuJ0WqAIDRbOjq1RlBFIpaxB7lSZJhS5T5otDBKLc6MXFeM9Iw0atVvIOhLSl24CiwLJcc8A0-2JT2oIxx8w==">';
            $resultado='<form class="col-12 col-md-12" id="'.$id.'" method="'.$method.'" action="'.$url.'">'.$resultado.$token.'</form>';
        }
        if ($return)
        {
            $boxrow='<div class="row">';
            $endrow='</div>';
            return $boxrow.$resultado.$endrow;
        }else{
            echo $resultado;
        }
    }

    public function getInput($tipo, $nombre='', $id='', $valor='', $onchange='', $clase='', $style='', $icono='',$boxbody=false,$etiqueta='',$leyenda='', $col='', $adicional,$valordefecto='',$textoon='',$textooff='')
    {
        //$date = date("Y-m-d H:i:s");
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        switch ($tipo) {
            case 'cajatexto':
                return $this->getInputText($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional);
                break;

            case 'clave':
                return $this->getInputPassword($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional);
                break;

            case 'numero':
                return $this->getInputNumber($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional);
                break;

            case 'moneda':
                return $this->getInputMoney($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional);
                break;

            case 'fecha':
                return $this->getInputDate($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional);
                break;

            case 'checkbox':
                return $this->getInputCheckbox($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional,$textoon,$textooff);
                break;

            case 'oculto':
                return $this->getInputOculto($nombre, $id, $valor,$adicional);
                break;


            case 'textarea':
                return $this->getInputTextarea($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional);
                break;

            case 'onoff':
                return $this->getInputOnoff($nombre, $id, $valor,$valordefecto, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional,$textoon,$textooff);
                break;

            case 'archivo':
                return $this->getInputArchivo($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda, $col, $adicional);
                break;

            default:
                return "Debe indicar un tipo de Input";
                break;
        }
        return $date;
    }
    public function getSelect($tipo, $nombre='', $id='', $valor=NULL, $valordefecto=NULL, $onchange='', $clase='', $style='', $icono='',$boxbody=false,$etiqueta='',$leyenda='', $col='', $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$clase;
                break;
        }



        switch ($etiqueta) {
            case '':
                $select='<select class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" '.$adicional.'>';
                break;

                default:
                $select='<select class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$etiqueta.'"  '.$adicional.'>';
                break;
        }
        $selectvalue+='<option>'.$etiqueta.'</option>';

      foreach ($valor as $key => $value) {
        if($valordefecto!=NULL && $value["id"]==$valordefecto){$selected=' selected="selected" '; }
          $selectvalue.='<option value="'.$value["id"].'" '.$selected.'>'.$value["value"].'</option>';
          $selected="";
      }

        $resultado='
        <div class="'.$col.'">
            <div class="form-group">
                <label>'.$etiqueta.'</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                    </div>
                    '.$select.$selectvalue.'</select>
                </div>
            </div>
        </div>
       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

private function getInputCheckbox($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$clase;
                break;
        }

        $input=' <input type="checkbox" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'"  checked data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-danger">';



        $resultado='
        <div class="'.$col.'">
            <div class="form-group">
                <div class="input-group mb-3">

                    '.$input.'
                </div>
            </div>
        </div>

        <script>
  $(function() {
    $("#'.$id.'").bootstrapToggle({
      on: "Enabled",
      off: "Disabled"
    });
  })
</script>


       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }


    private static function getInputText($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$clase;
                break;
        }

        switch ($leyenda) {
            case '':
                $input='<input type="text" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" '.$adicional.'>';
                break;

                default:
                $input='<input type="text" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$leyenda.'" '.$adicional.'>';
                break;
        }



        $resultado='
        <div class="'.$col.'">
            <div class="form-group">
                <label>'.$etiqueta.'</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                    </div>
                    '.$input.'
                </div>
            </div>
        </div>
       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

    private static function getInputOculto($nombre, $id, $valor,$adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$clase;
                break;
        }

        switch ($leyenda) {
            case '':
                $input='<input type="hidden" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" '.$adicional.'>';
                break;

                default:
                $input='<input type="hidden" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" '.$adicional.'>';
                break;
        }



        $resultado='
        <div class="'.$col.'" style="display:none;">
                    '.$input.'
        </div>
       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

    private static function getInputArchivo($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$clase;
                break;
        }

        switch ($leyenda) {
            case '':
                $input='<input type="file" ref="'.$id.'" class="custom-file-input '.$clase.'" id="'.$id.'" name="'.$nombre.'" aria-describedby="inputGroupFileAddon01" accept="image/*">';
                break;

                default:
                $input='<input type="file" ref="'.$id.'" class="custom-file-input '.$clase.'" id="'.$id.'" name="'.$nombre.'" placeholder="'.$leyenda.'" aria-describedby="inputGroupFileAddon01" accept="image/*">';
                break;
        }


        $resultado='
        <div class="'.$col.' mb-3 mt-2">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="font-size:13px; font-weight:600;" id="inputGroupFileAddon01">'.$etiqueta.'</span>
                </div>
                <div class="custom-file">
                     '.$input.'
                    <label class="custom-file-label" id="label-'.$id.'" for="inputGroupFile01">Elegir</label>
                </div>
            </div>
        </div>
        <script>
            $("#'.$id.'").change(function(){
                $("#label-'.$id.'").text(this.files[0].name);
            });
        </script>
       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

    private static function getInputPassword($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$clase;
                break;
        }

        switch ($leyenda) {
            case '':
                $input='<input type="password" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'">';
                break;

                default:
                $input='<input type="password" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$leyenda.'">';
                break;
        }



        $resultado='
        <div class="'.$col.'">
            <div class="form-group">
                <label>'.$etiqueta.'</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                    </div>
                    '.$input.'
                </div>
            </div>
        </div>
       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

    private static function getInputNumber($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$classdefault .' '.$clase;
                break;
        }

        switch ($leyenda) {
            case '':
                $input='<input type="number" onchange="javascript:'.$onchange.';"  class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'"  '.$adicional.'>';
                break;

                default:
                $input='<input type="number" onchange="javascript:'.$onchange.';" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$leyenda.'"  '.$adicional.'>';
                break;
        }

        $resultado='
        <div class="'.$col.'">
            <div class="form-group">
                <label>'.$etiqueta.'</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                    </div>
                    '.$input.'
                </div>
            </div>
        </div>
       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

    private static function getInputMoney($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$clase;
                break;
        }

        switch ($leyenda) {
            case '':
                $input='<input type="currency"  min="0" step="0.01" data-number-to-fixed="2" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'">';
                break;

                default:
                $input='<input type="currency" min="0" step="0.01" data-number-to-fixed="2" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$leyenda.'">';
                break;
        }

        $resultado='
        <div class="'.$col.'">
            <div class="form-group">
                <label>'.$etiqueta.'</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                    </div>
                    '.$input.'
                </div>
            </div>
        </div>
       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

    private static function getInputTextarea($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
        {
            $iconfa=new Iconos;
            $iconfa= $iconfa->getIconofa($icono);
            $input='';
            $classdefault='form-control pull-right';
            $boxbodydefault='<div class="box-body">';
            $enddiv='</div>';

            switch ($clase) {
                case '':
                    $clase=$classdefault;
                    break;

                default:
                    $clase=$clase;
                    break;
            }

            switch ($leyenda) {
                case '':
                    $input='<textarea class="'.$clase.'"  id="'.$id.'" name="'.$nombre.'"  rows="3">'.$valor.'</textarea>';
                    break;

                    default:
                    $input='<textarea class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$leyenda.'">'.$valor.'</textarea>';
                    break;
            }

            $resultado='
            <div class="'.$col.'">
                <div class="form-group">
                    <label>'.$etiqueta.'</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                        </div>
                        '.$input.'
                    </div>
                </div>
            </div>
        ';
            if ($boxbody):
                $resultado=$boxbodydefault.$resultado.$enddiv;
            else:
                //$resultado=$bo$resultado.$enddiv;
            endif;
            return $resultado;

        }

        private function getInputOnoff($nombre, $id, $valor, $valordefecto='OFF', $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional,$textoon='', $textooff='')
        {
            $iconfa=new Iconos;
            $iconfa= $iconfa->getIconofa($icono);
            $input='';
            $classdefault='form-control pull-right';
            $boxbodydefault='<div class="box-body">';
            $enddiv='</div>';
            $valordefectodefault=($valordefecto=='ON')? 'checked="checked"' : '' ;

            switch ($clase) {
                case '':
                    $clase=$classdefault;
                    break;

                default:
                    $clase=$clase;
                    break;
            }



            switch ($leyenda) {
                case '':
                    if ($textoon){
                        $input='<input type="checkbox"  '.$valordefectodefault.' id="'.$id.'" name="'.$nombre.'"   class="'.$clase.'"  data-on="'.$textoon.'" data-off="'.$textooff.'" data-toggle="toggle" data-onstyle="outline-info" data-offstyle="outline-danger" '.$adicional.' />';
                    }else{
                        $input='<input type="checkbox"  '.$valordefectodefault.' id="'.$id.'" name="'.$nombre.'"   class="'.$clase.'"  data-on="'.$valor.'" data-off="'.$valor.'" data-toggle="toggle" data-onstyle="outline-info" data-offstyle="outline-danger" '.$adicional.' />';
                    }
                    break;

                    default:
                    $input='<input type="checkbox" '.$valordefectodefault.' id="'.$id.'" name="'.$nombre.'"   class="'.$clase.'"  data-on="'.$valor.'" data-off="'.$leyenda.'" data-toggle="toggle" data-onstyle="outline-info" data-offstyle="outline-danger" '.$adicional.' />';
                    break;
            }

            $resultado='
            <div class="'.$col.'">
                <div class="form-group">
                    <label>'.$etiqueta.'</label>
                    <div class="input-group mb-3">

                        '.$input.'
                    </div>
                </div>
            </div>
        ';

     //   Yii::$app->getView()->registerJsFile("https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js", \yii\web\View::POS_END);
      //  Yii::$app->getView()->registerCssFile("https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css", \yii\web\View::POS_END);

            if ($boxbody):
                $resultado=$boxbodydefault.$resultado.$enddiv;
            else:
                //$resultado=$bo$resultado.$enddiv;
            endif;
            return $resultado;

        }

        public function getRegistrarJS($nombre,$url,$datareg)
        {
            $this->registerJsFile('@web/js/core.js',['depends'=>['backend\assets\AppAsset']]);

        }


    private static function getInputDate($nombre, $id, $valor, $onchange, $clase, $estilo, $icono,$boxbody,$etiqueta,$leyenda='', $col, $adicional)
    {
        $iconfa=new Iconos;
        $iconfa= $iconfa->getIconofa($icono);
        $input='';
        $classdefault='form-control pull-right';
        $boxbodydefault='<div class="box-body">';
        $enddiv='</div>';

        switch ($clase) {
            case '':
                $clase=$classdefault;
                break;

            default:
                $clase=$clase;
                break;
        }

        switch ($leyenda) {
            case '':
                $input='<input type="date" data-provide="datepicker" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" '.$adicional.'>';
                break;

                default:
                $input='<input type="date" data-provide="datepicker" class="'.$clase.'" id="'.$id.'" name="'.$nombre.'" value="'.$valor.'" placeholder="'.$leyenda.'" '.$adicional.'>';
                break;
        }

        $resultado='
        <div class="'.$col.'">
            <div class="form-group">
                <label>'.$etiqueta.'</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="'.$iconfa.'"></i></span>
                    </div>
                    '.$input.'
                </div>
            </div>
        </div>



       ';
        if ($boxbody):
            $resultado=$boxbodydefault.$resultado.$enddiv;
        else:
            //$resultado=$bo$resultado.$enddiv;
        endif;
        return $resultado;

    }

    public function getSeparador($clase='',$estilo='', $color='')
    {
        switch ($color) {
            case !'':
                return '<div class="col-12"><hr style="color: '.$color.'" /></div>';
                break;

            default:
                return '<div class="col-12"><hr style="color: #0056b2;" /></div>';
                break;
        }

    }


}