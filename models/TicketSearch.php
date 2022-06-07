<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ticket;

/**
 * TicketSearch represents the model behind the search form of `app\models\Ticket`.
 */
class TicketSearch extends Ticket
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'state', 'tic_fkclient', 'tic_fkrestaurant'], 'integer'],
            [['created_date', 'delete_date', 'update_date', 'tic_clientname', 'tic_file'], 'safe'],
            [['tic_total'], 'number'],
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
        $query = Ticket::find();

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
            'created_date' => $this->created_date,
            'delete_date' => $this->delete_date,
            'update_date' => $this->update_date,
            'tic_total' => $this->tic_total,
            'tic_fkclient' => $this->tic_fkclient,
            'tic_fkrestaurant' => $this->tic_fkrestaurant,
        ]);

        $query->andFilterWhere(['like', 'tic_clientname', $this->tic_clientname])
            ->andFilterWhere(['like', 'tic_file', $this->tic_file]);

        return $dataProvider;
    }
}
