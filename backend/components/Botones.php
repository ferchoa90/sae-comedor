<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;
use backend\components\Iconos;


/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/09/21
 * Time: 16:16
 */

class Botones extends Component
{

    public function getBotongridArray($objetos)
    {

        $result;
        $return="";
        foreach($objetos as $obj):


            switch ($obj['tipo']) {
                case 'link':
                    $return.=$this->getBoton($obj['subtipo'],$obj['nombre'],$obj['id'],$obj['titulo'],$obj['link'],$obj['onclick'],$obj['clase'],$obj['style'],$obj['col'],$obj['tipocolor'],$obj['icono'],$obj['tamanio'],$obj['target'],$obj['adicional']).'&nbsp;';
                    break;

                case 'separador':
                    $return.=$this->getSeparador($obj['clase'],$obj['estilo'], $obj['color']);
                    break;
                default:

                    break;
            }
        endforeach;
        return $return;
    }

    public function getBotones($tipo='',$nombre='', $id='', $titulo='', $link='', $onclick='', $clase='', $style='', $col='',$tipocolor='',$icono='',$tamanio='', $adicional )
    {
        //$date = date("Y-m-d H:i:s");

        $tipo='bloquediv';
        switch ($tipo) {
            case 'bloquediv':
                return $this->getBoton($subtipo,$nombre, $id, $titulo, $link,$onclick ,$clase, $style, $col,$tipocolor,$icono,$tamanio='',$target='', $adicional);
                break;

            default:
                return "Debe indicar un tipo de bloque";
                break;
        }
        return $date;
    }

    private function getBoton($tipo, $nombre='', $id='', $titulo='', $link='', $onclick='', $clase='', $style='', $col='',$tipocolor='',$icono='',$tamanio='',$target='', $adicional)
    {
        $classdefault=' ';
        $tipocolordefault='btn bg-gradient-primary';
        $tamaniodefault='btn-sm';
        $onclickdefault='';
        $linkdefault='';

        ($tamanio=='') ? $tamanio=$tamaniodefault : '' ;
        ($tamanio=='pequeño') ? $tamanio='btn-sm' : '' ;
        ($tamanio=='superp') ? $tamanio='btn-xs' : '' ;
        ($tamanio=='grande') ? $tamanio='btn-large' : '' ;
        ($tamanio=='completo') ? $tamanio='btn-block' : '' ;

        ($tipo=='submit') ? $tipoboton='submit' : $tipoboton='button' ;



        ($link=='') ? $link=$linkdefault : $link='href="'.$link.'"' ;

        ($onclick=='') ? $onclick=$onclickdefault : $onclick='javascript:'.$onclick.';' ;
        ($onclick=='') ? $onclick=$onclickdefault : $link='' ;

        $icon = new Iconos;
        $icono= $icon->getIconos($icono,'','','','','','','');


        switch ($tipocolor) {
            case 'azul':
                $tipocolor='btn bg-gradient-primary btnedit';
                break;

            case 'verde':
                $tipocolor='btn bg-gradient-success btnedit';
                break;

            case 'rojo':
                $tipocolor='btn bg-gradient-danger btnedit';
                break;

            case 'verdesuave':
                $tipocolor='btn bg-gradient-info btnedit';
                break;

            case 'amarillo':
                $tipocolor='btn bg-gradient-warning btnedit';
                break;

            case 'plomo':
                $tipocolor='btn bg-gradient-secondary btnedit';
                break;

            case 'negro':
                $tipocolor='btn bg-gradient-dark btnedit';
                break;

            case 'naranja':
                $tipocolor='btn bg-gradient-warning btnedit';
                break;

            default:
                $tipocolor=$tipocolordefault;
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

        switch ($target) {
            case 'blank':
                $target=' target="_blank" ';
                break;

            default:
                # code...
                break;
        }

        $div='
         <a  '.$link.'  class="'.$clase.'" onclick="'.$onclick.'"  '.$target.'>
                    <button type="'.$tipoboton.'" id="'.$id.'" name="'.$nombre.'" alt="'.$titulo.'" title="'.$titulo.'" onclick="" class="'.$tipocolor.' '.$tamanio.'">
                    '.$icono.$titulo.'
                    </button>
        </a>
        ';
        $resultado=$div;
        return $resultado;
    }

    public function getSeparador($clase='',$estilo='', $color='')
    {
        switch ($color) {
            case !'':
                return '<hr style="color: '.$color.'" />';
                break;

            default:
                return '<hr style="color: #0056b2;" />';
                break;
        }
    }


}