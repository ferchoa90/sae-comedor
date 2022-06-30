<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pinturas".
 *
 * @property int $id
 * @property string $nombre
 * @property string $fecha
 * @property string $horainicio
 * @property string $horafin
 * @property int $dificultad
 * @property int $isDeleted
 * @property string $valor
 * @property string $reserva
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property UserComprasDetalle[] $userComprasDetalles
 */
class Pinturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pinturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'fecha', 'horainicio', 'horafin', 'valor', 'reserva'], 'required'],
            [['fecha', 'horainicio', 'horafin', 'fechacreacion'], 'safe'],
            [['dificultad', 'isDeleted'], 'integer'],
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
            'fecha' => 'Fecha',
            'horainicio' => 'Horainicio',
            'horafin' => 'Horafin',
            'dificultad' => 'Dificultad',
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
    public function getUserComprasDetalles()
    {
        return $this->hasMany(UserComprasDetalle::className(), ['idcuadro' => 'id']);
    }
}
