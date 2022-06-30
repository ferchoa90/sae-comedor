<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;

use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property string $id
 * @property string $titulo
 * @property string $descripcion
 * @property string $link
 * @property string $image
 * @property string $imageresponsive
 * @property int $orden
 */
class Slider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link', 'imageresponsive', 'image', 'orden'], 'required'],
            [['orden'], 'integer'],
            [['titulo', 'descripcion', 'link', 'image', 'imageresponsive'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'link' => 'Link',
            'image' => 'Image',
            'imageresponsive' => 'Imageresponsive',
            'orden' => 'Orden',
        ];
    }
}
