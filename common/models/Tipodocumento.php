<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipodocumento".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Factura[] $facturas
 */
class Tipodocumento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipodocumento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'usuariocreacion'], 'required'],
            [['usuariocreacion'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['estatus'], 'string'],
            [['nombre', 'descripcion'], 'string', 'max' => 200],
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
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['tipo' => 'id']);
    }
}
