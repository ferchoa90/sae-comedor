<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ordenes".
 *
 * @property int $id
 * @property int $idmesa
 * @property resource|null $comentario
 * @property int $idcliente
 * @property int $isDeleted
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property string $estatus
 *
 * @property Clientes $idcliente0
 * @property Mesas $idmesa0
 * @property User $usuariocreacion0
 */
class Ordenes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordenes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmesa', 'idcliente', 'usuariocreacion'], 'required'],
            [['idmesa', 'idcliente', 'isDeleted', 'usuariocreacion', 'usuarioact'], 'integer'],
            [['comentario', 'estatus'], 'string'],
            [['fechacreacion', 'fechaact'], 'safe'],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['idmesa'], 'exist', 'skipOnError' => true, 'targetClass' => Mesas::className(), 'targetAttribute' => ['idmesa' => 'id']],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['idcliente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idmesa' => 'Idmesa',
            'comentario' => 'Comentario',
            'idcliente' => 'Idcliente',
            'isDeleted' => 'Is Deleted',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Idcliente0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcliente0()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'idcliente']);
    }

    /**
     * Gets query for [[Idmesa0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdmesa0()
    {
        return $this->hasOne(Mesas::className(), ['id' => 'idmesa']);
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
