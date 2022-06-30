<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "marca".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 * @property Productos[] $productos
 */
class Marca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'required'],
            [['isDeleted', 'usuariocreacion'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['estatus'], 'string'],
            [['nombre'], 'string', 'max' => 150],
            [['descripcion'], 'string', 'max' => 250],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
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
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Productos::className(), ['marca' => 'id']);
    }
}
