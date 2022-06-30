<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "calidad".
 *
 * @property int $id
 * @property string $nombre
 * @property int $isDeleted
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $fechamod
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Calidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calidad';
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
            [['nombre'], 'string', 'max' => 200],
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
            'isDeleted' => 'Is Deleted',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'fechamod' => 'Fechamod',
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
}
