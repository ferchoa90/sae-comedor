<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu_front".
 *
 * @property int $id
 * @property int $idparent
 * @property string $nombre
 * @property string $icono
 * @property string $link
 * @property int $usuarioc
 * @property int $usuariom
 * @property string $fechacreacion
 * @property string $fechamod
 * @property int $orden
 * @property string $tipo
 * @property string $estatus
 *
 * @property User $usuarioc0
 */
class MenuFront extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_front';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idparent', 'nombre', 'icono', 'link', 'usuarioc', 'estatus'], 'required'],
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
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioc0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuarioc']);
    }
}
