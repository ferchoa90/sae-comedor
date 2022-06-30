<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "carrito".
 *
 * @property int $id
 * @property int $idusuario
 * @property int $idproducto
 * @property int $idclase
 * @property int $idpintura
 * @property int $tipocompra
 * @property int $cantidad
 * @property string $sesion
 * @property string $fechacreacion
 */
class Carrito extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carrito';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idusuario', 'idproducto', 'idclase', 'idpintura', 'cantidad', 'sesion'], 'required'],
            [['idusuario', 'idproducto', 'idclase', 'idpintura', 'tipocompra', 'cantidad'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['sesion'], 'string', 'max' => 100],
            [['idusuario', 'idproducto', 'idclase', 'idpintura', 'fechacreacion'], 'unique', 'targetAttribute' => ['idusuario', 'idproducto', 'idclase', 'idpintura', 'fechacreacion']],
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
            'idproducto' => 'Idproducto',
            'idclase' => 'Idclase',
            'idpintura' => 'Idpintura',
            'tipocompra' => 'Tipocompra',
            'cantidad' => 'Cantidad',
            'sesion' => 'Sesion',
            'fechacreacion' => 'Fechacreacion',
        ];
    }
}
