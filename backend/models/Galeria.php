<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "galeria".
 *
 * @property int $id
 * @property int $idcategoria
 * @property string $titulo
 * @property string $imagen
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property string $estatus
 */
class Galeria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'galeria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcategoria', 'titulo', 'imagen'], 'required'],
            [['idcategoria', 'isDeleted'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['estatus'], 'string'],
            [['titulo', 'imagen'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idcategoria' => 'Idcategoria',
            'titulo' => 'Titulo',
            'imagen' => 'Imagen',
            'isDeleted' => 'Is Deleted',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }
}
