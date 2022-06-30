<?php

namespace backend\models;

use yii\base\Model;
use common\models\User;

use Yii;
/**
 * This is the model class for table "contactenos".
 *
 * @property int $id
 * @property string $cedula
 * @property string $nombres
 * @property string $ciudad
 * @property string $agencia
 * @property string $direccion
 * @property string $celular
 * @property string $telefonoc
 * @property string $correo
 * @property resource $requerimiento
 * @property resource $detalle
 * @property resource $descripcion
 * @property resource $peticion
 * @property string $archivo
 * @property int $acepto
 * @property string $fechacreacion
 */
class Contactenos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contactenos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cedula', 'nombres', 'ciudad', 'agencia', 'direccion', 'celular', 'telefonoc', 'correo', 'requerimiento'], 'required', 'message'=> "Campo Obligatorio"],
            [['requerimiento', 'detalle', 'descripcion', 'peticion'], 'string'],
            [['acepto'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['cedula', 'celular'], 'string', 'max' => 10],
            [['nombres', 'archivo'], 'string', 'max' => 300],
            [['ciudad', 'agencia'], 'string', 'max' => 200],
            [['direccion'], 'string', 'max' => 400],
            [['telefonoc'], 'string', 'max' => 9],
            [['correo'], 'string', 'max' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cedula' => 'Número de Cédula',
            'nombres' => 'Nombres y apellidos',
            'ciudad' => 'Ciudad',
            'agencia' => 'Agencia',
            'direccion' => 'Dirección de su domicilio',
            'celular' => 'Celular',
            'telefonoc' => 'Teléfono Convencional',
            'correo' => 'Correo electrónico',
            'requerimiento' => 'Requerimiento',
            'detalle' => 'Detalle Otro',
            'descripcion' => 'Descripción de los hechos',
            'peticion' => 'Petición o sugerencia',
            'archivo' => 'Adjuntar documento',
            'acepto' => 'Acepto',
            'fechacreacion' => 'Fechacreacion',
        ];
    }
}
