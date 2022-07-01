<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ordenesdetalle".
 *
 * @property int $id
 * @property int $idorden
 * @property int $idproducto
 * @property resource $nombreprod
 * @property float $cantidad
 * @property float $precio
 * @property int $impreso
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property string $estatus
 */
class Ordenesdetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordenesdetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idorden', 'idproducto', 'nombreprod', 'usuariocreacion'], 'required'],
            [['idorden', 'idproducto', 'impreso', 'usuariocreacion', 'usuarioact'], 'integer'],
            [['nombreprod', 'estatus'], 'string'],
            [['cantidad', 'precio'], 'number'],
            [['fechacreacion', 'fechaact'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idorden' => 'Idorden',
            'idproducto' => 'Idproducto',
            'nombreprod' => 'Nombreprod',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'impreso' => 'Impreso',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
            'estatus' => 'Estatus',
        ];
    }
}
