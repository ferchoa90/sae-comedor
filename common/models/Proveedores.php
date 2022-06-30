<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "proveedores".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $ruc
 * @property string $contacto
 * @property string $cargocontacto
 * @property string $telefono
 * @property int $provincia
 * @property string $ciudad
 * @property string $direccion
 * @property string $correo
 * @property int $credito
 * @property string $persona
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property int $isDeleted
 * @property string $estatus
 *
 * @property Productos[] $productos
 * @property Provincias $provincia0
 */
class Proveedores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nombre', 'descripcion', 'ruc', 'contacto', 'cargocontacto', 'telefono', 'provincia', 'ciudad', 'direccion', 'correo', 'persona'], 'required'],
            [['id', 'provincia', 'credito', 'usuariocreacion', 'isDeleted'], 'integer'],
            [['persona', 'estatus'], 'string'],
            [['fechacreacion'], 'safe'],
            [['nombre', 'descripcion', 'contacto', 'cargocontacto', 'direccion', 'correo'], 'string', 'max' => 200],
            [['ruc'], 'string', 'max' => 13],
            [['telefono'], 'string', 'max' => 20],
            [['ciudad'], 'string', 'max' => 50],
            [['id'], 'unique'],
            [['provincia'], 'exist', 'skipOnError' => true, 'targetClass' => Provincias::className(), 'targetAttribute' => ['provincia' => 'id']],
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
            'ruc' => 'Ruc',
            'contacto' => 'Contacto',
            'cargocontacto' => 'Cargocontacto',
            'telefono' => 'Telefono',
            'provincia' => 'Provincia',
            'ciudad' => 'Ciudad',
            'direccion' => 'Direccion',
            'correo' => 'Correo',
            'credito' => 'Credito',
            'persona' => 'Persona',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'isDeleted' => 'Is Deleted',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Productos::className(), ['idproveedor' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia0()
    {
        return $this->hasOne(Provincias::className(), ['id' => 'provincia']);
    }

    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }
}
