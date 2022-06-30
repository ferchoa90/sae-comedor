<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "paginas".
 *
 * @property int $id
 * @property string $nombre
 * @property string $titulo
 * @property string $tituloslider
 * @property string $textoslider
 * @property string $imagen
 * @property string $imagenresponsive
 * @property string $tag
 * @property string $fechacreacion
 * @property string $creador_por
 * @property string $modificado_por
 * @property string $estatus
 *
 * @property Contenido[] $contenidos
 */
class Paginas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paginas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'titulo', 'tag'], 'required'],
            [['id'], 'safe'],
            [['id'], 'integer'],
            [['textoslider', 'estatus','contenido'], 'string'],
            [['fechacreacion'], 'safe'],
            [['nombre'], 'string', 'max' => 120],
            [['titulo', 'tituloslider'], 'string', 'max' => 200],
            [['imagen', 'imagenresponsive'], 'string', 'max' => 250],
            [['tag'], 'string', 'max' => 80],
            [['creador_por', 'modificado_por'], 'string', 'max' => 55],
            [['id'], 'unique'],
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
            'titulo' => 'Titulo',
            'tituloslider' => 'Tituloslider',
            'textoslider' => 'Textoslider',
            'imagen' => 'Imagen',
            'imagenresponsive' => 'Imagenresponsive',
            'tag' => 'Tag',
            'fechacreacion' => 'Fechacreacion',
            'creador_por' => 'Creador Por',
            'modificado_por' => 'Modificado Por',
            'estatus' => 'Estatus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContenidos()
    {
        return $this->hasMany(Contenido::className(), ['idpagina' => 'id']);
    }
}
