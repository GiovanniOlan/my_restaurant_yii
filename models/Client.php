<?php

namespace app\models;

use Yii;

class Client extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'CLIENT';
    }

    public static function getClientLogged()
    {
        $user_custom = UserCustom::getUserCustom(Yii::$app->user->id);
        return $user_custom->clients[0];
    }


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
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['car_fkclient' => 'id'])->where(['state' => 1]);
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
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['tic_fkclient' => 'id'])->orderBy(['created_date' => SORT_DESC]);
    }
}
