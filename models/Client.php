<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "CLIENT".
 *
 * @property int $id ID
 * @property int $state Estado
 * @property int $cli_fkrestaurant Restaurant
 * @property int $cli_fkusercustom User Custom
 *
 * @property CART[] $cARTs
 * @property RESTAURANT $cliFkrestaurant
 * @property USERCUSTOM $cliFkusercustom
 * @property TICKET[] $tICKETs
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CLIENT';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'cli_fkrestaurant', 'cli_fkusercustom'], 'required'],
            [['state', 'cli_fkrestaurant', 'cli_fkusercustom'], 'integer'],
            [['cli_fkrestaurant'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::className(), 'targetAttribute' => ['cli_fkrestaurant' => 'id']],
            [['cli_fkusercustom'], 'exist', 'skipOnError' => true, 'targetClass' => UserCustom::className(), 'targetAttribute' => ['cli_fkusercustom' => 'id']],
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
            'cli_fkrestaurant' => 'Restaurant',
            'cli_fkusercustom' => 'User Custom',
        ];
    }

    /**
     * Gets query for [[CARTs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCARTs()
    {
        return $this->hasMany(Cart::className(), ['car_fkclient' => 'id']);
    }

    /**
     * Gets query for [[CliFkrestaurant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliFkrestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['id' => 'cli_fkrestaurant']);
    }

    /**
     * Gets query for [[CliFkusercustom]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliFkusercustom()
    {
        return $this->hasOne(UserCustom::className(), ['id' => 'cli_fkusercustom']);
    }

    /**
     * Gets query for [[TICKETs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTICKETs()
    {
        return $this->hasMany(Ticket::className(), ['tic_fkclient' => 'id']);
    }
}
