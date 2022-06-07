<?php

namespace app\models;

use Yii;

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
    /**
     * {@inheritdoc}
     */
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
            [['catmen_name'], 'string', 'max' => 30],
            [['catmen_image'], 'string', 'max' => 100],
            [['catmen_fkrestaurant'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::className(), 'targetAttribute' => ['catmen_fkrestaurant' => 'id']],
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
            'catmen_name' => 'Nombre',
            'catmen_description' => 'Descripción',
            'catmen_image' => 'Imagen',
            'catmen_fkrestaurant' => 'Restaurante',
        ];
    }

    /**
     * Gets query for [[CATMENUITEMs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCATMENUITEMs()
    {
        return $this->hasMany(CATMENUITEM::className(), ['catmenite_fkcatmenu' => 'id']);
    }

    /**
     * Gets query for [[CatmenFkrestaurant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatmenFkrestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['id' => 'catmen_fkrestaurant']);
    }
}
