<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "datosregistro".
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $correo
 * @property string $celular
 * @property string $fechacreacion
 */
class Datosregistro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'datosregistro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'correo', 'celular'], 'required','message' => "{attribute} es Obligatorio"],
            [['fechacreacion'], 'safe'],
            [['nombres', 'apellidos'], 'string', 'max' => 100],
            [['correo'], 'email','message' => "Debe ingresar un correo válido"],
            [['correo'], 'string', 'max' => 300],
            [['celular'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'correo' => 'Correo electrónico',
            'celular' => 'Celular',
            'fechacreacion' => 'Fechacreacion',
        ];
    }
}
