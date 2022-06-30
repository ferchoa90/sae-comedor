<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "genero".
 *
 * @property int $id
 * @property string $nombre
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int $isDeleted
 * @property int|null $usuarioact
 * @property string|null $fechaact
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 */
class Genero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'usuariocreacion'], 'required'],
            [['usuariocreacion', 'isDeleted', 'usuarioact'], 'integer'],
            [['fechacreacion', 'fechaact'], 'safe'],
            [['estatus'], 'string'],
            [['nombre'], 'string', 'max' => 200],
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
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'isDeleted' => 'Is Deleted',
            'usuarioact' => 'Usuarioact',
            'fechaact' => 'Fechaact',
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
