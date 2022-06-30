<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "clasificacion".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string $fechamod
 * @property string $estatus
 */
class Clasificacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clasificacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'usuariocreacion'], 'required'],
            [['isDeleted', 'usuariocreacion'], 'integer'],
            [['fechacreacion', 'fechamod'], 'safe'],
            [['estatus'], 'string'],
            [['nombre'], 'string', 'max' => 150],
            [['descripcion'], 'string', 'max' => 200],
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
            'isDeleted' => 'Is Deleted',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'fechamod' => 'Fechamod',
            'estatus' => 'Estatus',
        ];
    }
}
