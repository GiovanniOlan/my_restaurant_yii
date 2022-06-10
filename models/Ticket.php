<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TICKET".
 *
 * @property int $id ID
 * @property int $state Estado
 * @property string $created_date Dia De Creación
 * @property string $delete_date Dia De Eliminación
 * @property string $update_date Dia De Actualización
 * @property float $tic_total Total
 * @property string $tic_clientname Nombre Del Cliente
 * @property string $tic_file PDF
 * @property int $tic_fkclient Cliente
 * @property int $tic_fkrestaurant Restaurant
 *
 * @property COMPRA[] $cOMPRAs
 * @property TICKETITEM[] $tICKETITEMs
 * @property CLIENT $ticFkclient
 * @property RESTAURANT $ticFkrestaurant
 */
class Ticket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TICKET';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'created_date', 'delete_date', 'update_date', 'tic_total', 'tic_clientname', 'tic_file', 'tic_fkclient', 'tic_fkrestaurant'], 'required'],
            [['state', 'tic_fkclient', 'tic_fkrestaurant'], 'integer'],
            [['created_date', 'delete_date', 'update_date'], 'safe'],
            [['tic_total'], 'number'],
            [['tic_clientname'], 'string', 'max' => 50],
            [['tic_file'], 'string', 'max' => 150],
            [['tic_fkclient'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['tic_fkclient' => 'id']],
            [['tic_fkrestaurant'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::className(), 'targetAttribute' => ['tic_fkrestaurant' => 'id']],
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
            'delete_date' => 'Dia De Eliminación',
            'update_date' => 'Dia De Actualización',
            'tic_total' => 'Total',
            'tic_clientname' => 'Nombre Del Cliente',
            'tic_file' => 'PDF',
            'tic_fkclient' => 'Cliente',
            'tic_fkrestaurant' => 'Restaurant',
        ];
    }

    /**
     * Gets query for [[COMPRAs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCOMPRAs()
    {
        return $this->hasMany(Compra::className(), ['com_fkticket' => 'id']);
    }

    /**
     * Gets query for [[TICKETITEMs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicketItems()
    {
        return $this->hasMany(TicketItem::className(), ['ticite_fkticket' => 'id']);
    }

    /**
     * Gets query for [[TicFkclient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicFkclient()
    {
        return $this->hasOne(Client::className(), ['id' => 'tic_fkclient']);
    }

    /**
     * Gets query for [[TicFkrestaurant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicFkrestaurant()
    {
        return $this->hasOne(Client::className(), ['id' => 'tic_fkrestaurant']);
    }

    public function getStringState()
    {
        if ($this->state == 0) {
            return 'Cancelado';
        } else if ($this->state == 1) {
            return 'En Proceso';
        } else {
            return 'Aceptada';
        }
    }
}
