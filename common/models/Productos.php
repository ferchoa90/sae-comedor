<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $id
 * @property string $nombreproducto
 * @property string $descripcion
 * @property int $idempresa
 * @property int $idproveedor
 * @property int $tipoproducto
 * @property int $marca
 * @property int $modelo
 * @property int $color
 * @property string $imagen
 * @property int $isDeleted
 * @property string $fechacreacion
 * @property int $usuariocreacion
 * @property string $estatus
 *
 * @property Inventario[] $inventarios
 * @property Tipoproducto $tipoproducto0
 * @property Empresa $empresa
 * @property Proveedores $proveedor
 * @property Marca $marca0
 * @property Modelo $modelo0
 * @property User $usuariocreacion0
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombreproducto', 'idempresa', 'tipoproducto'], 'required'],
            [['idempresa', 'idproveedor', 'tipoproducto', 'marca', 'modelo', 'color', 'isDeleted', 'usuariocreacion'], 'integer'],
            [['fechacreacion'], 'safe'],
            [['estatus'], 'string'],
            [['nombreproducto', 'descripcion'], 'string', 'max' => 200],
            [['imagen'], 'string', 'max' => 100],
            [['tipoproducto'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoproducto::className(), 'targetAttribute' => ['tipoproducto' => 'id']],
            [['idempresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['idempresa' => 'id']],
            [['idproveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedores::className(), 'targetAttribute' => ['idproveedor' => 'id']],
            [['marca'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['marca' => 'id']],
            [['modelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['modelo' => 'id']],
            [['usuariocreacion'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuariocreacion' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombreproducto' => 'Nombreproducto',
            'descripcion' => 'Descripcion',
            'idempresa' => 'Idempresa',
            'idproveedor' => 'Idproveedor',
            'tipoproducto' => 'Tipoproducto',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'color' => 'Color',
            'imagen' => 'Imagen',
            'isDeleted' => 'Is Deleted',
            'fechacreacion' => 'Fechacreacion',
            'usuariocreacion' => 'Usuariocreacion',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['idproducto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoproducto0()
    {
        return $this->hasOne(Tipoproducto::className(), ['id' => 'tipoproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'idempresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedores::className(), ['id' => 'idproveedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarca0()
    {
        return $this->hasOne(Marca::className(), ['id' => 'marca']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelo0()
    {
        return $this->hasOne(Modelo::className(), ['id' => 'modelo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariocreacion0()
    {
        return $this->hasOne(User::className(), ['id' => 'usuariocreacion']);
    }

    public function getUsuarioactualizacion0()
    {
        $response=$this->hasOne(User::className(), ['id' => 'usuarioact']);
        if (!$this->usuarioact){ $response=(object) $array; $response->username="No registra";}
        return $response;
    }
}
