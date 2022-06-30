<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipotarjeta".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $bancoemisor
 * @property float $interes
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property string $estatus
 *
 * @property Bancos $bancoemisor0
 * @property User $usuariocreacion0
 */
class Tipotarjeta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipotarjeta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'bancoemisor', 'usuariocreacion'], 'required'],
            [['bancoemisor', 'isDeleted', 'usuariocreacion', 'usuarioact'], 'integer'],
            [['interes'], 'number'],
            [['fechacreacion', 'fechaact'], 'safe'],
            [['estatus'], 'string'],
            [['nombre', 'descripcion'], 'string', 'max' => 200],
            [['bancoemisor'], 'exist', 'skipOnError' => true, 'targetClass' => Bancos::className(), 'targetAttribute' => ['bancoemisor' => 'id']],
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
            'bancoemisor' => 'Bancoemisor',
            'interes' => 'Interes',
            'isDeleted' => 'Is Deleted',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Bancoemisor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBancoemisor0()
    {
        return $this->hasOne(Bancos::className(), ['id' => 'bancoemisor']);
    }

    /**
     * Gets query for [[Usuariocreacion0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }
}
