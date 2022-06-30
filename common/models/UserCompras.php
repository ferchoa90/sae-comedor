<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_compras".
 *
 * @property int $id
 * @property int $iduser
 * @property string $descuento
 * @property string $subtotal
 * @property string $iva
 * @property string $total
 * @property string $paymentid
 * @property string $payerId
 * @property string $tokenpaypal
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property User $user
 * @property UserComprasDetalle[] $userComprasDetalles
 */
class UserCompras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_compras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iduser', 'subtotal', 'iva', 'total'], 'required'],
            [['id', 'iduser'], 'integer'],
            [['descuento', 'subtotal', 'iva', 'total'], 'number'],
            [['fechacreacion'], 'safe'],
            [['estatus'], 'string'],
            [['paymentid', 'payerid'], 'string', 'max' => 300],
            [['tokenpaypal'], 'string', 'max' => 150],
            [['id'], 'unique'],
            [['iduser'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['iduser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iduser' => 'Iduser',
            'descuento' => 'Descuento',
            'subtotal' => 'Subtotal',
            'iva' => 'Iva',
            'total' => 'Total',
            'paymentid' => 'Paymentid',
            'payerId' => 'Payer ID',
            'tokenpaypal' => 'Tokenpaypal',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'iduser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserComprasDetalles()
    {
        return $this->hasMany(UserComprasDetalle::className(), ['idcompra' => 'id']);
    }
}
