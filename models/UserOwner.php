<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "USER_OWNER".
 *
 * @property int $id ID
 * @property int $state Estado
 * @property int $usu_premium ¿Es Premium?
 * @property int $usu_fkusercustom User Custom
 *
 * @property RESTAURANT[] $rESTAURANTs
 * @property USERCUSTOM $usuFkusercustom
 */
class UserOwner extends \yii\db\ActiveRecord
{

    public static function getUserOwnerLogged()
    {
        $user_custom = UserCustom::getUserCustom(Yii::$app->user->id);
        return $user_custom->userOwners[0];
    }

    public static function tableName()
    {
        return 'USER_OWNER';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'usu_premium', 'usu_fkusercustom'], 'required'],
            [['state', 'usu_premium', 'usu_fkusercustom'], 'integer'],
            [['usu_fkusercustom'], 'exist', 'skipOnError' => true, 'targetClass' => UserCustom::className(), 'targetAttribute' => ['usu_fkusercustom' => 'id']],
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
            'usu_premium' => '¿Es Premium?',
            'usu_fkusercustom' => 'User Custom',
        ];
    }

    /**
     * Gets query for [[RESTAURANTs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurants()
    {
        return $this->hasMany(Restaurant::className(), ['res_fkuserowner' => 'id'])->where(['state' => 1]);
    }

    /**
     * Gets query for [[UsuFkusercustom]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuFkusercustom()
    {
        return $this->hasOne(userCustom::className(), ['id' => 'usu_fkusercustom']);
    }
}
