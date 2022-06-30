<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "factura".
 *
 * @property int $id
 * @property int $nfactura
 * @property int $idcliente
 * @property string $nombres
 * @property string $ruc
 * @property string $subtotal
 * @property string $total
 * @property string $iva
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property int $tipopago
 * @property int $tipodoc
 * @property string $facturae
 * @property string $estatus
 *
 * @property User $usuariocreacion0
 * @property Tipodocumento $tipodoc0
 * @property Tipopago $tipopago0
 * @property Clientes $cliente
 * @property Facturadetalle[] $facturadetalles
 */
class Factura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'factura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nfactura', 'idcliente', 'nombre', 'ruc', 'subtotal', 'total', 'iva', 'usuariocreacion'], 'required'],
            [['nfactura', 'idcliente', 'usuariocreacion', 'tipopago', 'tipodoc'], 'integer'],
            [['subtotal', 'total', 'iva'], 'number'],
            [['fechacreacion'], 'safe'],
            [['facturae', 'estatus'], 'string'],
            [['nombre'], 'string', 'max' => 350],
            [['ruc'], 'string', 'max' => 300],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
            [['tipodoc'], 'exist', 'skipOnError' => true, 'targetClass' => Tipodocumento::className(), 'targetAttribute' => ['tipodoc' => 'id']],
            [['tipopago'], 'exist', 'skipOnError' => true, 'targetClass' => Tipopago::className(), 'targetAttribute' => ['tipopago' => 'id']],
            [['idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['idcliente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nfactura' => 'Nfactura',
            'idcliente' => 'Idcliente',
            'nombre' => 'Nombre',
            'ruc' => 'Ruc',
            'subtotal' => 'Subtotal',
            'total' => 'Total',
            'iva' => 'Iva',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'tipopago' => 'Tipopago',
            'tipodoc' => 'Tipodoc',
            'facturae' => 'Facturae',
            'estatus' => 'Estatus',
        ];
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
    public function getTipodoc0()
    {
        return $this->hasOne(Tipodocumento::className(), ['id' => 'tipodoc']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipopago0()
    {
        return $this->hasOne(Tipopago::className(), ['id' => 'tipopago']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'idcliente']);
    }

    public function getTipotarjetapago()
    {
        return $this->hasOne(Tipotarjeta::className(), ['id' => 'tipotarjeta']);
    }

    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturadetalle()
    {
        return $this->hasMany(Facturadetalle::className(), ['idfactura' => 'id']);
    }

    public function getFacturadetalles()
    {
        return $this->hasMany(Facturadetalle::className(), ['idfactura' => 'id']);
    }

    public function getUsuarioactualizacion0()
    {
        $response=$this->hasOne(User::className(), ['id' => 'usuarioact']);
        if (!$this->usuarioact){ $response=(object) $array; $response->username="No registra";}
        return $response;
    }
}
