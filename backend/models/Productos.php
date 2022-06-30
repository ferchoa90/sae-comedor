<?php

namespace backend\models;

use yii\base\Model;
use common\models\User;


use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $id
 * @property string $nombre
 * @property resource $descripcion
 * @property string $link
 * @property string $imagen
 * @property string $usuariocreacion
 * @property int $isDeleted
 * @property int $orden
 * @property string $estado
 *
 * @property ProductoImages[] $productoImages
 * @property Subproducto[] $subproductos
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'link', 'imagen'], 'required'],
            [['descripcion', 'estado'], 'string'],
            [['usuariocreacion'], 'safe'],
            [['isDeleted', 'orden'], 'integer'],
            [['nombre'], 'string', 'max' => 200],
            [['link', 'imagen'], 'string', 'max' => 250],
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
            'imagen' => 'Imagen',
            'usuariocreacion' => 'Usuariocreacion',
            'isDeleted' => 'Is Deleted',
            'orden' => 'Orden',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoImages()
    {
        return $this->hasMany(Productoimages::className(), ['idproducto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubproductos()
    {
        return $this->hasMany(Subproducto::className(), ['idproducto' => 'id']);
    }
}
