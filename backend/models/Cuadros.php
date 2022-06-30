<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cuadros".
 *
 * @property int $id
 * @property string $titulo
 * @property resource $descripcion
 * @property string $precio
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property UserComprasDetalle[] $userComprasDetalles
 */
class Cuadros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cuadros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion'], 'required'],
            [['descripcion', 'estatus'], 'string'],
            [['precio'], 'number'],
            [['isDeleted'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['titulo'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'precio' => 'Precio',
            'isDeleted' => 'Is Deleted',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserComprasDetalles()
    {
        return $this->hasMany(UserComprasDetalle::className(), ['idcuadro' => 'id']);
    }
}
