<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "menu_admin".
 *
 * @property int $id
 * @property int $idparent
 * @property string $nombre
 * @property string $icono
 * @property string $link
 * @property string $usuarioc
 * @property string $usuariom
 * @property string $fechacreacion
 * @property string $fechamod
 * @property int $orden
 * @property string $estatus
 */
class Menuadmin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idparent', 'nombre', 'icono', 'link', 'usuarioc', 'estatus'], 'required'],
            [['idparent', 'orden'], 'integer'],
            [['fechacreacion', 'fechamod'], 'safe'],
            [['estatus'], 'string'],
            [['nombre', 'icono'], 'string', 'max' => 80],
            [['link'], 'string', 'max' => 400],
            [['usuarioc', 'usuariom'], 'string', 'max' => 36],
            [['idparent', 'nombre'], 'unique', 'targetAttribute' => ['idparent', 'nombre']],
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
            'estatus' => 'Estatus',
        ];
    }
}
