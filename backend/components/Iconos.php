<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 27/09/21
 * Time: 16:16
 */

class Iconos extends Component
{
    public function getIconos($tipo,$nombre='', $id='', $titulo='', $clase='', $style='', $col='',$adicional )
    {

        return $this->getIcono($tipo,$nombre, $id, $titulo, $clase, $style, $col,$adicional);
    }

    public function getIconofa($icono)
    {
        return $this->getFaicono($icono);
    }

    private function getFaicono($icono='')
    {

        switch ($icono) {
            case 'archivo':
                $tipo='fa fa-file-code-o';
                break;

            case 'llave':
                $tipo='fas fa-key';
                break;

            case 'diagnostico':
                $tipo='fa fa-medkit';
                break;

            case 'lista':
                $tipo='fa fa-list-alt';
                break;

            case 'pdf':
                $tipo='file-pdf-o';
                break;

            case 'lapiz':
                $tipo='fas fa-pencil-alt';
                break;

            case 'telefono':
                $tipo='fa fa-phone';
                break;

            case 'ver':
                $tipo='fas fa-eye';
                break;

            case 'tacho':
                $tipo='fas fa-trash';
                break;

            case 'eliminar':
                $tipo='fas fa-trash';
                break;

            case 'editar':
                $tipo='fas fa-pencil-alt';
                break;

            case 'ojo':
                $tipo='fas fa-eye';
                break;

            case 'nuevo':
                $tipo='fa fa-plus';
                break;

            case 'guardar':
                $tipo='fa fa-save';
                break;

            case 'regresar':
                $tipo='fa fa-chevron-left';
                break;

            case 'calendario':
                $tipo='fa fa-calendar';
                break;

            case 'carta':
                $tipo='fa fa-envelope';
                break;

            case 'tarjeta':
                $tipo='fas fa-id-card';
                break;

            case 'arroba' || 'correo':
                $tipo='fa fa-at';
                break;

            case 'valor':
                $tipo='fa fa-usd';
                break;

            case 'dolar':
                $tipo='fa fa-usd';
                break;

            case 'aceptar':
                $tipo='fa fa-check-circle-o';
                break;

            case 'cancelar':
                $tipo='fa fa-reply';
                break;

            case 'citamedica':
                $tipo='fa fa-stethoscope';
                break;

            default:
                $tipo=$tipodefault;
                break;
        }

        return $tipo;
    }

    private static function getIcono($tipo,$nombre='', $id='', $titulo='', $clase='', $style='', $col='', $adicional)
    {
        $classdefault='';
        $tipodefault='fas fa-pencil-alt';
        $tamaniodefault='';
        switch ($tipo) {

            case 'citamedica':
                $tipo='fa fa-stethoscope';
                break;

            case 'diagnostico':
                $tipo='fa fa-medkit';
                break;

            case 'llave':
                $tipo='fas fa-key';
                break;

            case 'lista':
                $tipo='fa fa-list-alt';
                break;

            case 'archivo':
                $tipo='fa fa-file-code-o';
                break;

            case 'aceptar':
                $tipo='fa fa-check-circle-o';
                break;

            case 'cancelar':
                $tipo='fa fa-reply';
                break;

            case 'pdf':
                $tipo='fa fa-file-pdf-o';
                break;
            case 'lapiz':
                $tipo='fas fa-pencil-alt';
                break;

            case 'ver':
                $tipo='fas fa-eye';
                break;

            case 'tacho':
                $tipo='fas fa-trash';
                break;

            case 'eliminar':
                $tipo='fas fa-trash';
                break;

            case 'editar':
                $tipo='fas fa-pencil-alt';
                break;

            case 'ojo':
                $tipo='fas fa-eye';
                break;

            case 'nuevo':
                $tipo='fa fa-plus';
                break;

            case 'guardar':
                $tipo='fa fa-save';
                break;

            case 'regresar':
                $tipo='fa fa-chevron-left';
                break;

            case 'calendario':
                $tipo='fa fa-calendar';
                break;

            case 'filtro':
                $tipo='fa fa-filter';
                break;

            case 'ninguno':
                $tipo='';
                break;

            case 'valor' || 'dolar':
                $tipo='fa fa-usd';
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

        $div='
            <i id="'.$id.'" name="'.$nombre.'" alt="'.$titulo.'" title="'.$titulo.'" class="'.$clase.' '.$tipo.'"></i>
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