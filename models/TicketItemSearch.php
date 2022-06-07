<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TicketItem;

/**
 * TicketItemSearch represents the model behind the search form of `app\models\TicketItem`.
 */
class TicketItemSearch extends TicketItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'state', 'ticite_quantity', 'ticite_fkticket', 'ticite_fkcatmenuitem'], 'integer'],
            [['ticite_itemname', 'created_date', 'created_delete', 'created_update'], 'safe'],
            [['ticite_price', 'ticite_subtotal'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TicketItem::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'state' => $this->state,
            'ticite_quantity' => $this->ticite_quantity,
            'ticite_price' => $this->ticite_price,
            'ticite_subtotal' => $this->ticite_subtotal,
            'ticite_fkticket' => $this->ticite_fkticket,
            'ticite_fkcatmenuitem' => $this->ticite_fkcatmenuitem,
            'created_date' => $this->created_date,
            'created_update' => $this->created_update,
        ]);

        $query->andFilterWhere(['like', 'ticite_itemname', $this->ticite_itemname])
            ->andFilterWhere(['like', 'created_delete', $this->created_delete]);

        return $dataProvider;
    }
}
