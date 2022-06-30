<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rolesmodulo".
 *
 * @property int $id
 * @property resource $nombre
 * @property resource|null $descripcion
 * @property resource|null $nameint
 * @property int $idmenu
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property int $isDeleted
 * @property string $estatus
 *
 * @property Menuadmin $idmenu0
 * @property Rolespermisos[] $rolespermisos
 * @property Rolessubmodulo[] $rolessubmodulos
 * @property User $usuariocreacion0
 */
class Rolesmodulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rolesmodulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'idmenu', 'usuariocreacion'], 'required'],
            [['nombre', 'descripcion', 'nameint', 'estatus'], 'string'],
            [['idmenu', 'usuariocreacion', 'isDeleted'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['idmenu'], 'exist', 'skipOnError' => true, 'targetClass' => Menuadmin::className(), 'targetAttribute' => ['idmenu' => 'id']],
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
            'nameint' => 'Nameint',
            'idmenu' => 'Idmenu',
            'usuariocreacion' => 'Usuariocreacion',
            'fechacreacion' => 'Fechacreacion',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Idmenu0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdmenu0()
    {
        return $this->hasOne(Menuadmin::className(), ['id' => 'idmenu']);
    }

    /**
     * Gets query for [[Rolespermisos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRolespermisos()
    {
        return $this->hasMany(Rolespermisos::className(), ['idmodulo' => 'id'])->onCondition(['estatus' => "ACTIVO"]);
    }

    /**
     * Gets query for [[Rolessubmodulos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRolessubmodulos()
    {
        return $this->hasMany(Rolessubmodulo::className(), ['idmodulo' => 'id'])->onCondition(['estatus' => "ACTIVO"]);
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
