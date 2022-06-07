<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "EMPLEADO".
 *
 * @property int $id ID
 * @property int $state Estado
 * @property string $emp_description Descripción
 * @property string $emp_curp Curp
 * @property string $emp_rfc RFC
 * @property int $emp_fkrestaurant Restaurante
 * @property int $emp_fkusercustom User Custom
 *
 * @property COMPRA[] $cOMPRAs
 * @property RESTAURANT $empFkrestaurant
 * @property USERCUSTOM $empFkusercustom
 */
class Empleado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'EMPLEADO';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'emp_description', 'emp_curp', 'emp_rfc', 'emp_fkrestaurant', 'emp_fkusercustom'], 'required'],
            [['state', 'emp_fkrestaurant', 'emp_fkusercustom'], 'integer'],
            [['emp_description'], 'string'],
            [['emp_curp', 'emp_rfc'], 'string', 'max' => 100],
            [['emp_fkrestaurant'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::className(), 'targetAttribute' => ['emp_fkrestaurant' => 'id']],
            [['emp_fkusercustom'], 'exist', 'skipOnError' => true, 'targetClass' => UserCustom::className(), 'targetAttribute' => ['emp_fkusercustom' => 'id']],
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
            'emp_description' => 'Descripción',
            'emp_curp' => 'Curp',
            'emp_rfc' => 'RFC',
            'emp_fkrestaurant' => 'Restaurante',
            'emp_fkusercustom' => 'User Custom',
        ];
    }

    /**
     * Gets query for [[COMPRAs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCOMPRAs()
    {
        return $this->hasMany(Compra::className(), ['com_fkempleado' => 'id']);
    }

    /**
     * Gets query for [[EmpFkrestaurant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpFkrestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['id' => 'emp_fkrestaurant']);
    }

    /**
     * Gets query for [[EmpFkusercustom]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpFkusercustom()
    {
        return $this->hasOne(USERCUSTOM::className(), ['id' => 'emp_fkusercustom']);
    }
}
