<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $id
 * @property resource $modulo
 * @property resource $descripcion
 * @property resource $observacion
 * @property resource $codigo
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['modulo', 'descripcion', 'observacion', 'codigo', 'usuariocreacion'], 'required'],
            [['modulo', 'descripcion', 'observacion', 'codigo', 'estatus'], 'string'],
            [['usuariocreacion'], 'integer'],
            [['fechacreacion'], 'safe'],
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
            'modulo' => 'Modulo',
            'descripcion' => 'Descripcion',
            'observacion' => 'Observacion',
            'codigo' => 'Codigo',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
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
