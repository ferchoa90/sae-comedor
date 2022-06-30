<?php
namespace backend\components;
use Yii;
use backend\models\Configuracion;
use common\models\Usuariorol;
use common\models\Roles;
use common\models\Rolesmodulo;
use common\models\Rolespermisos;
use common\models\Rolessubmodulo;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Created by VSCODE.
 * User: Mario Aguilar
 * Date: 01/12/21
 * Time: 19:40
 */

class Roles_usuario extends Component
{
    public function getPermisousuario($idusuario,$modulo,$submodulo=0)
    {
        switch ($submodulo) {
            case 0:
                # code...
                break;

            case 0:
                # code...
                break;

            default:
                # code...
                break;
        }
    }

    public function getListapedidos($idpedido,$tipo)
    {
        switch ($tipo) {
            case 'grid':
                return $this->consultarPedidos();
                break;

            default:
                # code...
                break;
        }
    }


}