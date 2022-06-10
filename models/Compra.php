<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "COMPRA".
 *
 * @property int $id ID
 * @property string|null $state Estado
 * @property string|null $created_date Dia De Creación
 * @property string|null $update_date Dia De Actualización
 * @property string|null $delete_date Dia De Eliminación
 * @property int|null $com_fkempleado Atendio
 * @property int|null $com_fkticket Ticket
 *
 * @property EMPLEADO $comFkempleado
 * @property TICKET $comFkticket
 */
class Compra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'COMPRA';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_date', 'update_date', 'delete_date'], 'safe'],
            [['state', 'com_fkempleado', 'com_fkticket'], 'integer'],
            [['com_fkempleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['com_fkempleado' => 'id']],
            [['com_fkticket'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['com_fkticket' => 'id']],
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
            'created_date' => 'Dia De Creación',
            'update_date' => 'Dia De Actualización',
            'delete_date' => 'Dia De Eliminación',
            'com_fkempleado' => 'Atendio',
            'com_fkticket' => 'Ticket',
        ];
    }

    /**
     * Gets query for [[ComFkempleado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComFkempleado()
    {
        return $this->hasOne(Empleado::className(), ['id' => 'com_fkempleado']);
    }

    /**
     * Gets query for [[ComFkticket]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComFkticket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'com_fkticket']);
    }
}
