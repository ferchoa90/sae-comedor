<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menuadmin".
 *
 * @property int $id
 * @property int $idparent
 * @property string $nombre
 * @property string $icono
 * @property string $link
 * @property int $usuarioc
 * @property int $usuariom
 * @property string $fechacreacion
 * @property string|null $fechamod
 * @property int $orden
 * @property string $tipo
 * @property string $estatus
 *
 * @property Rolesmodulo[] $rolesmodulos
 * @property User $usuarioc0
 */
class Menuadmin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menuadmin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idparent', 'nombre', 'icono', 'link', 'usuarioc', 'usuariom'], 'required'],
            [['idparent', 'usuarioc', 'usuariom', 'orden'], 'integer'],
            [['fechacreacion', 'fechamod'], 'safe'],
            [['tipo', 'estatus'], 'string'],
            [['nombre', 'icono'], 'string', 'max' => 80],
            [['link'], 'string', 'max' => 400],
            [['idparent', 'nombre'], 'unique', 'targetAttribute' => ['idparent', 'nombre']],
            [['usuarioc'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuarioc' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idparent' => 'Idparent',
            'nombre' => 'Nombre',
            'icono' => 'Icono',
            'link' => 'Link',
            'usuarioc' => 'Usuarioc',
            'usuariom' => 'Usuariom',
            'fechacreacion' => 'Fechacreacion',
            'fechamod' => 'Fechamod',
            'orden' => 'Orden',
            'tipo' => 'Tipo',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * Gets query for [[Rolesmodulos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRolesmodulos()
    {
        return $this->hasMany(Rolesmodulo::className(), ['idmenu' => 'id']);
    }

    /**
     * Gets query for [[Usuarioc0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuarioc']);
    }
}
