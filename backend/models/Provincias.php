<?php

namespace backend\models;

use yii\base\Model;
use common\models\User;

use Yii;


/**
 * This is the model class for table "provincias".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $isDeleted
 * @property string $usuariocreacion
 * @property string $fechacreacion
 * @property string $estado
 *
 * @property Oficinas[] $oficinas
 */
class Provincias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provincias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'usuariocreacion', 'estado'], 'required'],
            [['isDeleted'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['estado'], 'string'],
            [['nombre'], 'string', 'max' => 300],
            [['descripcion'], 'string', 'max' => 150],
            [['usuariocreacion'], 'string', 'max' => 50],
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
            'isDeleted' => 'Is Deleted',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOficinas()
    {
        return $this->hasMany(Oficinas::className(), ['idprovincia' => 'id']);
    }
}
