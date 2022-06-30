<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipopago".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $fechacreacion
 * @property string $usuariocreacion
 * @property string $estatus
 *
 * @property Factura[] $facturas
 */
class Tipopago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipopago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'usuariocreacion'], 'required'],
            [['fechacreacion'], 'safe'],
            [['estatus'], 'string'],
            [['nombre', 'descripcion', 'usuariocreacion'], 'string', 'max' => 200],
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
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['tipopago' => 'id']);
    }
}
