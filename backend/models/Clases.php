<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "clases".
 *
 * @property int $id
 * @property string $nombre
 * @property string $fechainicio
 * @property string $fechafin
 * @property string $horainicio
 * @property string $horafin
 * @property int $isDeleted
 * @property string $valor
 * @property string $reserva
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property UserClases[] $userClases
 * @property User[] $usuarios
 * @property UserComprasDetalle[] $userComprasDetalles
 */
class Clases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'fechainicio', 'fechafin', 'horainicio', 'horafin', 'valor', 'reserva'], 'required'],
            [['fechainicio', 'fechafin', 'horainicio', 'horafin', 'fechacreacion'], 'safe'],
            [['isDeleted'], 'integer'],
            [['valor', 'reserva'], 'number'],
            [['estatus'], 'string'],
            [['nombre'], 'string', 'max' => 250],
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
            'fechainicio' => 'Fechainicio',
            'fechafin' => 'Fechafin',
            'horainicio' => 'Horainicio',
            'horafin' => 'Horafin',
            'isDeleted' => 'Is Deleted',
            'valor' => 'Valor',
            'reserva' => 'Reserva',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserClases()
    {
        return $this->hasMany(UserClases::className(), ['idclase' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(User::className(), ['id' => 'idusuario'])->viaTable('user_clases', ['idclase' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserComprasDetalles()
    {
        return $this->hasMany(UserComprasDetalle::className(), ['idarticulo' => 'id']);
    }
}
