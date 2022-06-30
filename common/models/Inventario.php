<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "inventario".
 *
 * @property int $id
 * @property int $idproducto
 * @property int $idpresentacion
 * @property int $cantidadini
 * @property int $cantidadcaja
 * @property int $stock
 * @property string $precioint
 * @property string $preciov1
 * @property string $preciov2
 * @property string $preciovp
 * @property int $idcolor
 * @property int $idcalidad
 * @property int $idsucursal
 * @property int $idclasificacion
 * @property string $codigobarras
 * @property string $codigocaja
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string $estatus
 *
 * @property Productos $producto
 * @property Presentacion $presentacion
 * @property User $usuariocreacion0
 * @property Color $color
 * @property Calidad $calidad
 * @property Sucursal $sucursal
 * @property Clasificacion $clasificacion
 */
class Inventario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproducto', 'cantidadini', 'cantidadcaja', 'stock', 'idcolor', 'idcalidad', 'idsucursal', 'idclasificacion', 'codigobarras', 'codigocaja', 'usuariocreacion'], 'required'],
            [['idproducto', 'idpresentacion', 'cantidadini', 'cantidadcaja', 'stock', 'idcolor', 'idcalidad', 'idsucursal', 'idclasificacion', 'isDeleted', 'usuariocreacion'], 'integer'],
            [['precioint', 'preciov1', 'preciov2', 'preciovp'], 'number'],
            [['fechacreacion'], 'safe'],
            [['estatus'], 'string'],
            [['codigobarras', 'codigocaja'], 'string', 'max' => 60],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['idproducto' => 'id']],
            [['idpresentacion'], 'exist', 'skipOnError' => true, 'targetClass' => Presentacion::className(), 'targetAttribute' => ['idpresentacion' => 'id']],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['idcolor'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['idcolor' => 'id']],
            [['idcalidad'], 'exist', 'skipOnError' => true, 'targetClass' => Calidad::className(), 'targetAttribute' => ['idcalidad' => 'id']],
            [['idsucursal'], 'exist', 'skipOnError' => true, 'targetClass' => Sucursal::className(), 'targetAttribute' => ['idsucursal' => 'id']],
            [['idclasificacion'], 'exist', 'skipOnError' => true, 'targetClass' => Clasificacion::className(), 'targetAttribute' => ['idclasificacion' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idproducto' => 'Idproducto',
            'idpresentacion' => 'Idpresentacion',
            'cantidadini' => 'Cantidadini',
            'cantidadcaja' => 'Cantidadcaja',
            'stock' => 'Stock',
            'precioint' => 'Precioint',
            'preciov1' => 'Preciov1',
            'preciov2' => 'Preciov2',
            'preciovp' => 'Preciovp',
            'idcolor' => 'Idcolor',
            'idcalidad' => 'Idcalidad',
            'idsucursal' => 'Idsucursal',
            'idclasificacion' => 'Idclasificacion',
            'codigobarras' => 'Codigobarras',
            'codigocaja' => 'Codigocaja',
            'isDeleted' => 'Is Deleted',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Productos::className(), ['id' => 'idproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentacion()
    {
        return $this->hasOne(Presentacion::className(), ['id' => 'idpresentacion']);
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
    public function getColor()
    {
        return $this->hasOne(Color::className(), ['id' => 'idcolor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalidad()
    {
        return $this->hasOne(Calidad::className(), ['id' => 'idcalidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSucursal()
    {
        return $this->hasOne(Sucursal::className(), ['id' => 'idsucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClasificacion()
    {
        return $this->hasOne(Clasificacion::className(), ['id' => 'idclasificacion']);
    }
}
