<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "inventariotransfer".
 *
 * @property int $id
 * @property int $idproducto
 * @property int $idinventario
 * @property int $stock
 * @property string $precioint
 * @property string $preciov1
 * @property string $preciov2
 * @property string $preciovp
 * @property int $idcolor
 * @property int $idcalidad
 * @property int $idpresentacion
 * @property int $idclasificacion
 * @property int $idsucursalo
 * @property int $idsucursald
 * @property string $codigobarras
 * @property string $codigocaja
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property int $usuariorec
 * @property string $estatus
 *
 * @property Productos $producto
 * @property User $usuariorec0
 * @property Inventario $inventario
 * @property User $usuariocreacion0
 * @property Color $color
 * @property Calidad $calidad
 * @property Sucursal $sucursalo
 * @property Sucursal $sucursald
 * @property Clasificacion $clasificacion
 * @property Presentacion $presentacion
 */
class Inventariotransfer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventariotransfer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproducto', 'idinventario', 'stock', 'precioint', 'preciov1', 'preciov2', 'preciovp', 'idcolor', 'idcalidad', 'idpresentacion', 'idclasificacion', 'idsucursalo', 'idsucursald', 'codigobarras', 'codigocaja', 'usuariocreacion'], 'required'],
            [['idproducto', 'idinventario', 'stock', 'idcolor', 'idcalidad', 'idpresentacion', 'idclasificacion', 'idsucursalo', 'idsucursald', 'usuariocreacion', 'usuariorec'], 'integer'],
            [['precioint', 'preciov1', 'preciov2', 'preciovp'], 'number'],
            [['fechacreacion'], 'safe'],
            [['estatus'], 'string'],
            [['codigobarras', 'codigocaja'], 'string', 'max' => 60],
            [['idproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['idproducto' => 'id']],
            [['usuariorec'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariorec' => 'id']],
            [['idinventario'], 'exist', 'skipOnError' => true, 'targetClass' => Inventario::className(), 'targetAttribute' => ['idinventario' => 'id']],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['idcolor'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['idcolor' => 'id']],
            [['idcalidad'], 'exist', 'skipOnError' => true, 'targetClass' => Calidad::className(), 'targetAttribute' => ['idcalidad' => 'id']],
            [['idsucursalo'], 'exist', 'skipOnError' => true, 'targetClass' => Sucursal::className(), 'targetAttribute' => ['idsucursalo' => 'id']],
            [['idsucursald'], 'exist', 'skipOnError' => true, 'targetClass' => Sucursal::className(), 'targetAttribute' => ['idsucursald' => 'id']],
            [['idclasificacion'], 'exist', 'skipOnError' => true, 'targetClass' => Clasificacion::className(), 'targetAttribute' => ['idclasificacion' => 'id']],
            [['idpresentacion'], 'exist', 'skipOnError' => true, 'targetClass' => Presentacion::className(), 'targetAttribute' => ['idpresentacion' => 'id']],
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
            'idinventario' => 'Idinventario',
            'stock' => 'Stock',
            'precioint' => 'Precioint',
            'preciov1' => 'Preciov1',
            'preciov2' => 'Preciov2',
            'preciovp' => 'Preciovp',
            'idcolor' => 'Idcolor',
            'idcalidad' => 'Idcalidad',
            'idpresentacion' => 'Idpresentacion',
            'idclasificacion' => 'Idclasificacion',
            'idsucursalo' => 'Idsucursalo',
            'idsucursald' => 'Idsucursald',
            'codigobarras' => 'Codigobarras',
            'codigocaja' => 'Codigocaja',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'usuariorec' => 'Usuariorec',
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
    public function getUsuariorec0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariorec']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventario()
    {
        return $this->hasOne(Inventario::className(), ['id' => 'idinventario']);
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
    public function getSucursalo()
    {
        return $this->hasOne(Sucursal::className(), ['id' => 'idsucursalo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSucursald()
    {
        return $this->hasOne(Sucursal::className(), ['id' => 'idsucursald']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClasificacion()
    {
        return $this->hasOne(Clasificacion::className(), ['id' => 'idclasificacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentacion()
    {
        return $this->hasOne(Presentacion::className(), ['id' => 'idpresentacion']);
    }
}
