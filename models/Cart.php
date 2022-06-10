<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "CART".
 *
 * @property int $id ID
 * @property int $state Estado
 * @property int $car_fkcatmenuitem
 * @property int $car_quantity Cantidad
 * @property float $car_subtotal Cantidad
 * @property int $car_fkclient
 *
 * @property CATMENUITEM $carFkcatmenuitem
 * @property CLIENT $carFkclient
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CART';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'car_fkcatmenuitem', 'car_quantity', 'car_subtotal', 'car_fkclient'], 'required'],
            [['state', 'car_fkcatmenuitem', 'car_quantity', 'car_fkclient'], 'integer'],
            [['car_subtotal'], 'number'],
            [['car_fkclient'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['car_fkclient' => 'id']],
            [['car_fkcatmenuitem'], 'exist', 'skipOnError' => true, 'targetClass' => CatMenuItem::className(), 'targetAttribute' => ['car_fkcatmenuitem' => 'id']],
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
            'car_fkcatmenuitem' => 'Car Fkcatmenuitem',
            'car_quantity' => 'Cantidad',
            'car_subtotal' => 'Cantidad',
            'car_fkclient' => 'Car Fkclient',
        ];
    }

    /**
     * Gets query for [[CarFkcatmenuitem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarFkcatmenuitem()
    {
        return $this->hasOne(CatMenuItem::className(), ['id' => 'car_fkcatmenuitem']);
    }

    /**
     * Gets query for [[CarFkclient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarFkclient()
    {
        return $this->hasOne(Client::className(), ['id' => 'car_fkclient']);
    }
}
