<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ciudad".
 *
 * @property int $id
 * @property resource $nombre
 * @property string|null $sufijo
 * @property int|null $idpais
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string $estatus
 */
class Ciudad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ciudad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'usuariocreacion'], 'required'],
            [['nombre', 'estatus'], 'string'],
            [['idpais', 'usuariocreacion'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['sufijo'], 'string', 'max' => 10],
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
            'sufijo' => 'Sufijo',
            'idpais' => 'Idpais',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'estatus' => 'Estatus',
        ];
    }
}
