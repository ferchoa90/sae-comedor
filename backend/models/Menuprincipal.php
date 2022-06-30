<?php

namespace backend\models;

use yii\base\Model;
use common\models\User;

use Yii;

/**
 * This is the model class for table "menuprincipal".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $link
 * @property string $fechacreacion
 * @property string $usuariocreacion
 * @property int $orden
 * @property string $estado
 */
class Menuprincipal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menuprincipal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'link', 'orden'], 'required'],
            [['fechacreacion'], 'safe'],
            [['orden'], 'integer'],
            [['estado'], 'string'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion', 'link'], 'string', 'max' => 300],
            [['usuariocreacion'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'link' => 'Link',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'orden' => 'Orden',
            'estado' => 'Estado',
        ];
    }
}
