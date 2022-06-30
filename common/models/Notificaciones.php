<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notificaciones".
 *
 * @property int $id
 * @property resource $titulo
 * @property resource $mensaje
 * @property int $destinatario
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string $estatusnot
 * @property string $estatus
 *
 * @property User $destinatario0
 * @property User $usuariocreacion0
 */
class Notificaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notificaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'mensaje', 'destinatario', 'usuariocreacion'], 'required'],
            [['titulo', 'mensaje', 'estatusnot', 'estatus'], 'string'],
            [['destinatario', 'usuariocreacion'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['destinatario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['destinatario' => 'id']],
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
            'mensaje' => 'Mensaje',
            'destinatario' => 'Destinatario',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'estatusnot' => 'Estatusnot',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Destinatario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDestinatario0()
    {
        return $this->hasOne(User::className(), ['id' => 'destinatario']);
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
