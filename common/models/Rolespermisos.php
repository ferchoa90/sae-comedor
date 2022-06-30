<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rolespermisos".
 *
 * @property int $id
 * @property int $idrol
 * @property int $idmodulo
 * @property resource $descripcion
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Rolesmodulo $idmodulo0
 * @property Roles $idrol0
 * @property User $usuariocreacion0
 */
class Rolespermisos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rolespermisos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idrol', 'idmodulo', 'usuariocreacion'], 'required'],
            [['idrol', 'idmodulo', 'usuariocreacion'], 'integer'],
            [['descripcion', 'estatus'], 'string'],
            [['fechacreacion'], 'safe'],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['idmodulo'], 'exist', 'skipOnError' => true, 'targetClass' => Rolesmodulo::className(), 'targetAttribute' => ['idmodulo' => 'id']],
            [['idrol'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['idrol' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrol' => 'Idrol',
            'idmodulo' => 'Idmodulo',
            'descripcion' => 'Descripcion',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Idmodulo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdmodulo0()
    {
        return $this->hasMany(Rolesmodulo::className(), ['id' => 'idmodulo']);
    }


    public function getIdsubmodulo0()
    {
        return $this->hasMany(Rolessubmodulo::className(), ['id' => 'idsubmodulo']);
    }

    /**
     * Gets query for [[Idrol0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdrol0()
    {
        return $this->hasOne(Roles::className(), ['id' => 'idrol']);
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
