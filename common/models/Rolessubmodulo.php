<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rolessubmodulo".
 *
 * @property int $id
 * @property int $idmodulo
 * @property int|null $idmenu
 * @property resource|null $nombreint
 * @property resource $nombre
 * @property resource|null $descripcion
 * @property int $usuariocreacion
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Rolesmodulo $idmodulo0
 * @property User $usuariocreacion0
 */
class Rolessubmodulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rolessubmodulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmodulo', 'nombre', 'usuariocreacion'], 'required'],
            [['idmodulo', 'idmenu', 'usuariocreacion'], 'integer'],
            [['nombreint', 'nombre', 'descripcion', 'estatus'], 'string'],
            [['fechacreacion'], 'safe'],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['idmodulo'], 'exist', 'skipOnError' => true, 'targetClass' => Rolesmodulo::className(), 'targetAttribute' => ['idmodulo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idmodulo' => 'Idmodulo',
            'idmenu' => 'Idmenu',
            'nombreint' => 'Nombreint',
            'nombre' => 'Nombre',
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
        return $this->hasOne(Rolesmodulo::className(), ['id' => 'idmodulo']);
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
