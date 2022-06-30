<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property int $id
 * @property string $nombre
 * @property resource $descripcion
 * @property int $usuariocreacion
 * @property int $frontend
 * @property int $backend
 * @property string $fechacreacion
 * @property string $fechamod
 * @property int $isDeleted
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 * @property Rolespermisos[] $rolespermisos
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'usuariocreacion'], 'required'],
            [['descripcion', 'estatus'], 'string'],
            [['usuariocreacion','isDeleted'], 'integer'],
            [['fechacreacion', 'fechamod'], 'safe'],
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
            'descripcion' => 'Descripcion',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'fechamod' => 'Fechamod',
            'isDeleted' => 'Is Deleted',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolespermisos()
    {
        return $this->hasMany(Rolespermisos::className(), ['idrol' => 'id']);
    }

    
}
