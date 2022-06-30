<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_compras_detalle".
 *
 * @property int $id
 * @property int $idcompra
 * @property int $idarticulo
 * @property int $idcuadro
 * @property int $idpintura
 * @property string $descripcion
 * @property string $valorunitario
 * @property int $cantidad
 * @property string $fechacreacion
 *
 * @property UserCompras $compra
 * @property Cuadros $cuadro
 * @property Clases $articulo
 * @property Pinturas $cuadro0
 */
class UserComprasDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_compras_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcompra', 'idarticulo', 'idcuadro', 'idpintura', 'descripcion', 'valorunitario', 'cantidad'], 'required'],
            [['idcompra', 'idarticulo', 'idcuadro', 'idpintura', 'cantidad'], 'integer'],
            [['valorunitario'], 'number'],
            [['fechacreacion'], 'safe'],
            [['descripcion'], 'string', 'max' => 200],
            [['idcompra', 'idarticulo', 'idcuadro', 'idpintura'], 'unique', 'targetAttribute' => ['idcompra', 'idarticulo', 'idcuadro', 'idpintura']],
            [['idcompra'], 'exist', 'skipOnError' => true, 'targetClass' => UserCompras::className(), 'targetAttribute' => ['idcompra' => 'id']],
            [['idcuadro'], 'exist', 'skipOnError' => true, 'targetClass' => Cuadros::className(), 'targetAttribute' => ['idcuadro' => 'id']],
            [['idarticulo'], 'exist', 'skipOnError' => true, 'targetClass' => Clases::className(), 'targetAttribute' => ['idarticulo' => 'id']],
            [['idcuadro'], 'exist', 'skipOnError' => true, 'targetClass' => Pinturas::className(), 'targetAttribute' => ['idcuadro' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idcompra' => 'Idcompra',
            'idarticulo' => 'Idarticulo',
            'idcuadro' => 'Idcuadro',
            'idpintura' => 'Idpintura',
            'descripcion' => 'Descripcion',
            'valorunitario' => 'Valorunitario',
            'cantidad' => 'Cantidad',
            'fechacreacion' => 'Fechacreacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompra()
    {
        return $this->hasOne(UserCompras::className(), ['id' => 'idcompra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro()
    {
        return $this->hasOne(Cuadros::className(), ['id' => 'idcuadro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo()
    {
        return $this->hasOne(Clases::className(), ['id' => 'idarticulo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuadro0()
    {
        return $this->hasOne(Pinturas::className(), ['id' => 'idcuadro']);
    }
}
