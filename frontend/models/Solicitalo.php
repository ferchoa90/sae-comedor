<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "solicitalo".
 *
 * @property int $id
 * @property string $nombres
 * @property string $celular
 * @property string $correo
 * @property string $provincia
 * @property string $fechacreacion
 */
class Solicitalo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'solicitalo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombres', 'celular', 'correo', 'provincia'], 'required' ,'message' => "Este es un campo obligatorio"],
            [['fechacreacion'], 'safe'],
            [['nombres'], 'string', 'max' => 50],
            [['celular'], 'string', 'max' => 10],
            [['correo'], 'email','message' => "Ingrese un correo válido"],
            [['correo'], 'string', 'max' => 50],
            [['provincia'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombres' => 'Nombres y Apellidos',
            'celular' => 'Celular',
            'correo' => 'Correo electrónico',
            'provincia' => 'Provincia',
            'fechacreacion' => 'Fechacreacion',
        ];
    }
}
