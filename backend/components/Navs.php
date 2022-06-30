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

class Navs extends Component
{
    var $active=true;
    public function getNavsArray($objetos)
    {

        $result;
        $return="";
        $tabuse=false;
        $this->active=true;
        foreach($objetos as $obj):

            switch ($obj['tipo']) {
                case 'config':
                    $return.=$this->getconfig($obj['nombre'],$obj['id'],$obj['titulo'],$obj['link'],$obj['onclick'],$obj['clase'],$obj['style'],$obj['col'],$obj['tipocolor'],$obj['icono'],$obj['tamanio'],$obj['adicional'],$obj['contenido']);
                    break;

                case 'tab':
                    $tabuse=true;
                    $return.=$this->getTab($obj['nombre'],$obj['id'],$obj['titulo'],$obj['link'],$obj['onclick'],$obj['clase'],$obj['style'],$obj['col'],$obj['tipocolor'],$obj['icono'],$obj['tamanio'],$obj['adicional'],$obj['contenido']);
                    break;

                case 'separador':
                    $return.=$this->getSeparador($obj['clase'],$obj['estilo'], $obj['color']);
                    break;
                default:

                    break;
            }
        endforeach;
        if ($tabuse)
        {
            $this->active=true;

            $return.='</ul>';
            foreach($objetos as $obj):

                switch ($obj['tipo']) {
                    case 'config':
                        $return.=$this->getConfigtabcontent($obj['nombre'],$obj['id'],$obj['titulo'],$obj['link'],$obj['onclick'],$obj['clase'],$obj['style'],$obj['col'],$obj['tipocolor'],$obj['icono'],$obj['tamanio'],$obj['adicional'],$obj['contenido']);
                        break;

                    case 'tab':
                        $return.=$this->getTabcontent($obj['nombre'],$obj['id'],$obj['titulo'],$obj['link'],$obj['onclick'],$obj['clase'],$obj['style'],$obj['col'],$obj['tipocolor'],$obj['icono'],$obj['tamanio'],$obj['adicional'],$obj['contenido']);
                        break;
                }
            endforeach;
            $return.='</div></p>';
        }


        return $return;
    }

    private function getConfig($nombre='', $id='', $titulo='', $link='', $onclick='', $clase='', $style='', $col='',$tipocolor='',$icono='',$tamanio='', $adicional, $contenido='' )
    {
        $return=' <ul class="nav nav-tabs" id="'.$id.'" name="'.$nombre.'" role="tablist"> ';
        return $return;
    }

    private function getConfigtabcontent($nombre='', $id='', $titulo='', $link='', $onclick='', $clase='', $style='', $col='',$tipocolor='',$icono='',$tamanio='', $adicional, $contenido='' )
    {
        $return='<div class="tab-content" id="nav-tabContent">';
        return $return;
    }

    public function getTab($nombre='', $id='', $titulo='', $link='', $onclick='', $clase='', $style='', $col='',$tipocolor='',$icono='',$tamanio='', $adicional, $contenido='' )
    {


        //$date = date("Y-m-d H:i:s");
        $classdefault=' ';
        $onclickdefault='';
        $linkdefault='';

        ($link=='') ? $link=$linkdefault : $link='href="'.$link.'"' ;

        ($onclick=='') ? $onclick=$onclickdefault : $onclick='javascript:'.$onclick.';' ;
        ($onclick=='') ? $onclick=$onclickdefault : $link='' ;

        $icon = new Iconos;
        //var_dump($icono);
        $icono= $icon->getIconos($icono,'','','','','','','');

        switch ($clase) {
            case !'':
                $clase=$clase;
                break;

            default:
                $clase=$classdefault;
                break;
        }


        if ($this->active){ $activecont="active"; }else{ $activecont="";}
        $div='
            <li class="nav-item">
                <a class="nav-link '.$activecont.' " id="'.$id.'" name="'.$nombre.'" data-toggle="tab" href="#dv-'.$nombre.'" role="tab" aria-controls="home" aria-selected="true">'.$titulo.'</a>
            </li>
        ';
        $this->active=false;
        /*$div='
         <a  '.$link.'  class="'.$clase.'" onclick="'.$onclick.'">
                    <button type="submit" id="'.$id.'" name="'.$nombre.'" alt="'.$titulo.'" title="'.$titulo.'" onclick="" class="'.$tipocolor.' '.$tamanio.'">
                    '.$icono.$titulo.'
                    </button>
        </a>
        ';*/
        $resultado=$div;
        return $resultado;

    }

    public function getTabcontent($nombre='', $id='', $titulo='', $link='', $onclick='', $clase='', $style='', $col='',$tipocolor='',$icono='',$tamanio='', $adicional, $contenido='' )
    {
        //$date = date("Y-m-d H:i:s");
        $classdefault=' ';
        $onclickdefault='';
        $linkdefault='';

        ($link=='') ? $link=$linkdefault : $link='href="'.$link.'"' ;

        ($onclick=='') ? $onclick=$onclickdefault : $onclick='javascript:'.$onclick.';' ;
        ($onclick=='') ? $onclick=$onclickdefault : $link='' ;

        $icon = new Iconos;
        //var_dump($icono);
        $icono= $icon->getIconos($icono,'','','','','','','');

        switch ($clase) {
            case !'':
                $clase=$clase;
                break;

            default:
                $clase=$classdefault;
                break;
        }

        if ($this->active){ $activecont="active"; }else{ $activecont="";}
        $div='<div class="tab-pane fade show '.$activecont.' p-3  " id="dv-'.$id.'"  name="dv-'.$nombre.'" role="tabpanel" aria-labelledby="nav-home-tab">'.$contenido.'</div>';

        $this->active=false;

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
