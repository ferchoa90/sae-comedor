<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "facturadetalle".
 *
 * @property int $id
 * @property int $idfactura
 * @property int $cantidad
 * @property int $idarticulo
 * @property string $narticulo
 * @property string $tarticulo
 * @property string $valoru
 * @property string $valort
 * @property string $iva
 * @property int $civa
 * @property string $fechacreacion
 * @property string $estatus
 *
 * @property Inventario $articulo
 * @property Factura $factura
 */
class Facturadetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facturadetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfactura', 'cantidad', 'idarticulo', 'narticulo', 'tarticulo', 'valoru', 'valort', 'iva', 'civa'], 'required'],
            [['idfactura',  'idarticulo', 'civa'], 'integer'],
            [['valoru', 'valort', 'cantidad','iva' ], 'number'],
            [['fechacreacion'], 'safe'],
            [['estatus'], 'string'],
            [['narticulo'], 'string', 'max' => 350],
            [['tarticulo'], 'string', 'max' => 200],
            [['idarticulo'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::className(), 'targetAttribute' => ['idarticulo' => 'id']],
            [['idfactura'], 'exist', 'skipOnError' => true, 'targetClass' => Factura::className(), 'targetAttribute' => ['idfactura' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idfactura' => 'Idfactura',
            'cantidad' => 'Cantidad',
            'idarticulo' => 'Idarticulo',
            'narticulo' => 'Narticulo',
            'tarticulo' => 'Tarticulo',
            'valoru' => 'Valoru',
            'valort' => 'Valort',
            'iva' => 'Iva',
            'civa' => 'Civa',
            'fechacreacion' => 'Fechacreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo()
    {
        return $this->hasOne(Inventario::className(), ['id' => 'idarticulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFactura()
    {
        return $this->hasOne(Factura::className(), ['id' => 'idfactura']);
    }
}
