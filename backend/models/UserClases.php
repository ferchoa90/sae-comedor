<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_clases".
 *
 * @property int $id
 * @property int $idusuario
 * @property int $idclase
 * @property int $isDeleted
 * @property string $suscripcion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property User $usuario
 * @property Clases $clase
 */
class UserClases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_clases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idusuario', 'idclase', 'isDeleted', 'estatus'], 'required'],
            [['idusuario', 'idclase', 'isDeleted'], 'integer'],
            [['suscripcion', 'estatus'], 'string'],
            [['fechacreacion'], 'safe'],
            [['idusuario', 'idclase'], 'unique', 'targetAttribute' => ['idusuario', 'idclase']],
            [['idusuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idusuario' => 'id']],
            [['idclase'], 'exist', 'skipOnError' => true, 'targetClass' => Clases::className(), 'targetAttribute' => ['idclase' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idusuario' => 'Idusuario',
            'idclase' => 'Idclase',
            'isDeleted' => 'Is Deleted',
            'suscripcion' => 'Suscripcion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'idusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClase()
    {
        return $this->hasOne(Clases::className(), ['id' => 'idclase']);
    }
}
