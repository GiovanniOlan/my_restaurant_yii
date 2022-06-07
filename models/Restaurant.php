<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "RESTAURANT".
 *
 * @property int $id ID
 * @property int $state Estado
 * @property string $res_name Nombre
 * @property string $res_description Descripción
 * @property string|null $res_logo Logo
 * @property string $res_slogan Slogan
 * @property string|null $res_mainimage Imagen Principal
 * @property int $res_fkuserowner Dueño Del Restaurante
 *
 * @property CATMENU[] $cATMENUs
 * @property CLIENT[] $cLIENTs
 * @property EMPLEADO[] $eMPLEADOs
 * @property USEROWNER $resFkuserowner
 * @property TICKET[] $tICKETs
 */
class Restaurant extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'RESTAURANT';
    }




    public function rules()
    {
        return [
            [['state', 'res_name', 'res_description', 'res_slogan', 'res_fkuserowner'], 'required'],
            [['state', 'res_fkuserowner'], 'integer'],
            [['res_description'], 'string'],
            [['res_name'], 'string', 'max' => 30],
            [['res_logo', 'res_mainimage'], 'string', 'max' => 100],
            [['res_slogan'], 'string', 'max' => 50],
            [['res_fkuserowner'], 'exist', 'skipOnError' => true, 'targetClass' => UserOwner::className(), 'targetAttribute' => ['res_fkuserowner' => 'id']],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'state' => 'Estado',
            'res_name' => 'Nombre',
            'res_description' => 'Descripción',
            'res_logo' => 'Logo',
            'res_slogan' => 'Slogan',
            'res_mainimage' => 'Imagen Principal',
            'res_fkuserowner' => 'Dueño Del Restaurante',
        ];
    }

    /**
     * Gets query for [[CATMENUs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCATMENUs()
    {
        return $this->hasMany(CatMenu::className(), ['catmen_fkrestaurant' => 'id']);
    }

    /**
     * Gets query for [[CLIENTs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCLIENTs()
    {
        return $this->hasMany(Client::className(), ['cli_fkrestaurant' => 'id']);
    }

    /**
     * Gets query for [[EMPLEADOs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEMPLEADOs()
    {
        return $this->hasMany(Empleado::className(), ['emp_fkrestaurant' => 'id']);
    }

    /**
     * Gets query for [[ResFkuserowner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResFkuserowner()
    {
        return $this->hasOne(Userowner::className(), ['id' => 'res_fkuserowner']);
    }

    /**
     * Gets query for [[TICKETs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTICKETs()
    {
        return $this->hasMany(Ticket::className(), ['tic_fkrestaurant' => 'id']);
    }
}
