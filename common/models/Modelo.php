<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "modelo".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Productos[] $productos
 */
class Modelo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modelo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nombre', 'descripcion'], 'required'],
            [['id'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['estatus'], 'string'],
            [['nombre'], 'string', 'max' => 150],
            [['descripcion'], 'string', 'max' => 250],
            [['id'], 'unique'],
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
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Productos::className(), ['modelo' => 'id']);
    }
}
