<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sucursal".
 *
 * @property int $id
 * @property int $idempresa
 * @property string $nombre
 * @property resource $direccion
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $fechamod
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Sucursal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sucursal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idempresa', 'nombre', 'direccion', 'usuariocreacion'], 'required'],
            [['idempresa', 'usuariocreacion'], 'integer'],
            [['direccion', 'estatus'], 'string'],
            [['fechacreacion', 'fechamod'], 'safe'],
            [['nombre'], 'string', 'max' => 150],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idempresa' => 'Idempresa',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'fechamod' => 'Fechamod',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }
}
