<?php

namespace app\models;

use Yii;
use yii\bootstrap4\Html;

/**
 * This is the model class for table "CAT_MENU_ITEM".
 *
 * @property int $id ID
 * @property int $state Estado
 * @property string $catmenite_name Nombre
 * @property string $catmenite_description Descripción
 * @property int $catmenite_for Total De Personas
 * @property string|null $catmenite_image Imagen
 * @property float $catmenite_price Precio
 * @property int $catmenite_fkcatmenu Categoria
 *
 * @property CART[] $cARTs
 * @property CATMENU $catmeniteFkcatmenu
 * @property TICKETITEM[] $tICKETITEMs
 */
class CatMenuItem extends \yii\db\ActiveRecord
{
    public $img;
    public static function tableName()
    {
        return 'CAT_MENU_ITEM';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'catmenite_name', 'catmenite_description', 'catmenite_for', 'catmenite_price', 'catmenite_fkcatmenu'], 'required'],
            [['state', 'catmenite_for', 'catmenite_fkcatmenu'], 'integer'],
            [['catmenite_description'], 'string'],
            [['catmenite_price'], 'number'],
            [['catmenite_name'], 'string', 'max' => 30],
            [['catmenite_image'], 'string', 'max' => 100],
            [['img'], 'file', 'extensions'   => 'jpg, jpeg, png'],
            [['img'], 'file', 'maxSize'      => '500000'],
            [['catmenite_fkcatmenu'], 'exist', 'skipOnError' => true, 'targetClass' => CatMenu::className(), 'targetAttribute' => ['catmenite_fkcatmenu' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'state' => 'Estado',
            'catmenite_name' => 'Nombre',
            'catmenite_description' => 'Descripción',
            'catmenite_for' => 'Total De Personas',
            'img' => 'Imagen',
            'catmenite_image' => 'Imagen',
            'catmenite_price' => 'Precio',
            'catmenite_fkcatmenu' => 'Categoria',
        ];
    }

    /**
     * Gets query for [[CARTs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCARTs()
    {
        return $this->hasMany(Cart::className(), ['car_fkcatmenuitem' => 'id']);
    }

    /**
     * Gets query for [[CatmeniteFkcatmenu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatmeniteFkcatmenu()
    {
        return $this->hasOne(CatMenu::className(), ['id' => 'catmenite_fkcatmenu']);
    }

    public function getTICKETITEMs()
    {
        return $this->hasMany(TicketItem::className(), ['ticite_fkcatmenuitem' => 'id']);
    }

    public function getImageHtml($width = 30, $height = 30)
    {
        return Html::img($this->getImageUrl(), ['alt' => $this->catmenite_name, 'width' => "{$width}%", 'height' => "{$height}%"]);
    }

    public function getImageUrl()
    {
        return (empty($this->catmenite_image) ? "/upload/images/default/cat-menu.png" : "{$this->catmenite_image}");
    }
}
