<?php

namespace app\models;

use Yii;
use yii\bootstrap4\Html;

/**
 * This is the model class for table "CAT_MENU".
 *
 * @property int $id ID
 * @property int $state Estado
 * @property string $catmen_name Nombre
 * @property string $catmen_description Descripción
 * @property string|null $catmen_image Imagen
 * @property int $catmen_fkrestaurant Restaurante
 *
 * @property CATMENUITEM[] $cATMENUITEMs
 * @property RESTAURANT $catmenFkrestaurant
 */
class CatMenu extends \yii\db\ActiveRecord
{

    public $img;

    public static function tableName()
    {
        return 'CAT_MENU';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'catmen_name', 'catmen_description', 'catmen_fkrestaurant'], 'required'],
            [['state', 'catmen_fkrestaurant'], 'integer'],
            [['catmen_description'], 'string'],
            [['img'], 'file', 'extensions'   => 'jpg, jpeg, png'],
            [['img'], 'file', 'maxSize'      => '500000'],
            [['catmen_name'], 'string', 'max' => 30],
            [['catmen_image'], 'string', 'max' => 100],
            [['catmen_fkrestaurant'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::className(), 'targetAttribute' => ['catmen_fkrestaurant' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'state' => 'Estado',
            'catmen_name' => 'Nombre',
            'catmen_description' => 'Descripción',
            'catmen_image' => 'Imagen',
            'img' => 'Imagen',
            'catmen_fkrestaurant' => 'Restaurante',
        ];
    }

    public function getCATMENUITEMs()
    {
        return $this->hasMany(CATMENUITEM::className(), ['catmenite_fkcatmenu' => 'id']);
    }

    public function getCatmenFkrestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['id' => 'catmen_fkrestaurant']);
    }

    public function getImageHtml($width = 30, $height = 30)
    {
        return Html::img($this->getImageUrl(), ['alt' => $this->catmen_name, 'width' => "{$width}%", 'height' => "{$height}%"]);
    }

    public function getImageUrl()
    {
        return (empty($this->catmen_image) ? "/upload/images/default/cat-menu.png" : "{$this->catmen_image}");
    }
}
