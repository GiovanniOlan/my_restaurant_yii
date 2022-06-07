<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TICKET_ITEM".
 *
 * @property int $id ID
 * @property int $state Estado
 * @property string $ticite_itemname Nombre del platillo
 * @property int $ticite_quantity Cantidad
 * @property float $ticite_price Precio
 * @property float $ticite_subtotal Subtotal
 * @property int $ticite_fkticket Ticket
 * @property int $ticite_fkcatmenuitem Plantillo Del Menu
 * @property string|null $created_date Dia De Creación
 * @property string|null $created_delete Dia De Eliminación
 * @property string|null $created_update Dia De Actualización
 *
 * @property CATMENUITEM $ticiteFkcatmenuitem
 * @property TICKET $ticiteFkticket
 */
class TicketItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TICKET_ITEM';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state', 'ticite_itemname', 'ticite_quantity', 'ticite_price', 'ticite_subtotal', 'ticite_fkticket', 'ticite_fkcatmenuitem'], 'required'],
            [['state', 'ticite_quantity', 'ticite_fkticket', 'ticite_fkcatmenuitem'], 'integer'],
            [['ticite_price', 'ticite_subtotal'], 'number'],
            [['created_date', 'created_update'], 'safe'],
            [['ticite_itemname'], 'string', 'max' => 150],
            [['created_delete'], 'string', 'max' => 255],
            [['ticite_fkticket'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['ticite_fkticket' => 'id']],
            [['ticite_fkcatmenuitem'], 'exist', 'skipOnError' => true, 'targetClass' => CatMenuItem::className(), 'targetAttribute' => ['ticite_fkcatmenuitem' => 'id']],
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
            'ticite_itemname' => 'Nombre del platillo',
            'ticite_quantity' => 'Cantidad',
            'ticite_price' => 'Precio',
            'ticite_subtotal' => 'Subtotal',
            'ticite_fkticket' => 'Ticket',
            'ticite_fkcatmenuitem' => 'Plantillo Del Menu',
            'created_date' => 'Dia De Creación',
            'created_delete' => 'Dia De Eliminación',
            'created_update' => 'Dia De Actualización',
        ];
    }

    /**
     * Gets query for [[TiciteFkcatmenuitem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiciteFkcatmenuitem()
    {
        return $this->hasOne(CatMenuItem::className(), ['id' => 'ticite_fkcatmenuitem']);
    }

    /**
     * Gets query for [[TiciteFkticket]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiciteFkticket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticite_fkticket']);
    }
}
