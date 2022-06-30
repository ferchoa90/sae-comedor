<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mesas".
 *
 * @property int $id
 * @property resource $nombre
 * @property resource|null $descripcion
 * @property string $seccion
 * @property int $numero
 * @property int $orden
 * @property string $tamanio
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string|null $fechaact
 * @property int|null $usuarioact
 * @property string $estatusmesa
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Mesas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mesas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'numero', 'usuariocreacion'], 'required'],
            [['nombre', 'descripcion', 'seccion', 'tamanio', 'estatusmesa', 'estatus'], 'string'],
            [['numero', 'orden', 'usuariocreacion', 'usuarioact'], 'integer'],
            [['fechacreacion', 'fechaact'], 'safe'],
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
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'seccion' => 'Seccion',
            'numero' => 'Numero',
            'orden' => 'Orden',
            'tamanio' => 'Tamanio',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'fechaact' => 'Fechaact',
            'usuarioact' => 'Usuarioact',
            'estatusmesa' => 'Estatusmesa',
            'estatus' => 'Estatus',
        ];
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
