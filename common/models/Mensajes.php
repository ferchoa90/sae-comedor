<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mensajes".
 *
 * @property int $id
 * @property resource $mensaje
 * @property int $usuariocreacion
 * @property int $usuarionot
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 * @property User $usuarionot0
 */
class Mensajes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mensajes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mensaje', 'usuariocreacion', 'usuarionot'], 'required'],
            [['mensaje', 'estatus'], 'string'],
            [['usuariocreacion', 'usuarionot', 'isDeleted'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['usuarionot'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuarionot' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mensaje' => 'Mensaje',
            'usuariocreacion' => 'Usuariocreacion',
            'usuarionot' => 'Usuarionot',
            'isDeleted' => 'Is Deleted',
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

    /**
     * Gets query for [[Usuarionot0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarionot0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuarionot']);
    }
}
