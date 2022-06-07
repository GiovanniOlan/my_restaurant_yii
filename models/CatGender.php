<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "CAT_GENDER".
 *
 * @property int $id ID
 * @property int $state Estado
 * @property string $catgen_name Nombre
 * @property string $catgen_description Descripción
 *
 * @property USERCUSTOM[] $uSERCUSTOMs
 */
class CatGender extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CAT_GENDER';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'catgen_name', 'catgen_description'], 'required'],
            [['state'], 'integer'],
            [['catgen_name'], 'string', 'max' => 30],
            [['catgen_description'], 'string', 'max' => 50],
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
            'catgen_name' => 'Nombre',
            'catgen_description' => 'Descripción',
        ];
    }

    /**
     * Gets query for [[USERCUSTOMs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUSERCUSTOMs()
    {
        return $this->hasMany(UserCustom::className(), ['usu_fkgender' => 'id']);
    }
}
