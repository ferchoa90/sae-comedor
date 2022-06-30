<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "datospersonales".
 *
 * @property int $id
 * @property string $cedula
 * @property string $numerofactura
 * @property string $establecimiento
 * @property string $fechacreacion
 */
class Datospersonales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'datospersonales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cedula', 'numerofactura', 'establecimiento'], 'required','message' => "{attribute} es Obligatorio"],
            [['fechacreacion'], 'safe'],
            [['cedula', 'numerofactura'], 'string', 'max' => 100],
            [['establecimiento'], 'string', 'max' => 300],
            [['cedula', 'numerofactura'], 'unique', 'targetAttribute' => ['cedula', 'numerofactura'],'message' => "La cédula con el número de factura ingresados ya existen."],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cedula' => 'Cédula',
            'numerofactura' => 'Número de factura',
            'establecimiento' => 'Establecimiento',
            'fechacreacion' => 'Fechacreacion',
        ];
    }
}
